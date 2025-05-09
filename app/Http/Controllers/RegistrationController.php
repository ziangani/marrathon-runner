<?php

namespace App\Http\Controllers;

use App\Models\Runner;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;

class RegistrationController extends Controller
{
    /**
     * Display the registration form.
     *
     * @return \Illuminate\View\View
     */
    public function showForm()
    {
        return view('pages.register');
    }

    /**
     * Store a new registration.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // Validate the request
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255',
            'phone' => 'required|string|max:20',
            'age' => 'required|string|max:50',
            'gender' => 'required|string|in:Male,Female',
            'emergency_contact_name' => 'required|string|max:255',
            'emergency_contact_phone' => 'required|string|max:20',
            't_shirt_size' => 'required|string|in:XS,S,M,L,XL,XXL,XXXL',
            'race_category' => 'required|string|max:255',
            'health_condition' => 'required|string|in:Yes,No',
            'health_condition_specify' => 'nullable|string|max:255|required_if:health_condition,Yes',
            'how_did_you_hear_about_us' => 'required|string|max:255',
            'exhibiting' => 'required|string|in:Yes,No,Maybe',
            'package' => 'required|string|max:50',
            'terms' => 'required|accepted',
        ]);

        if ($validator->fails()) {
            if ($request->ajax() || $request->wantsJson()) {
                return response()->json([
                    'success' => false,
                    'errors' => $validator->errors()
                ], 422);
            }
            
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        try {
            // Start a database transaction
            DB::beginTransaction();

            // Get the package amount from config
            $packageKey = $request->input('package');
            $packageAmount = config("marathon.packages.{$packageKey}.price", 0);

            // Determine race category key
            $raceCategoryKey = null;
            $raceCategory = $request->input('race_category');
            foreach (config('marathon.categories') as $key => $category) {
                if ($category['name'] === $raceCategory) {
                    $raceCategoryKey = $key;
                    break;
                }
            }

            // Create the runner record
            $runner = Runner::create([
                'name' => $request->input('name'),
                'email' => $request->input('email'),
                'phone' => $request->input('phone'),
                'age' => $request->input('age'),
                'gender' => $request->input('gender'),
                'emergency_contact_name' => $request->input('emergency_contact_name'),
                'emergency_contact_phone' => $request->input('emergency_contact_phone'),
                't_shirt_size' => $request->input('t_shirt_size'),
                'race_category' => $request->input('race_category'),
                'race_category_key' => $raceCategoryKey,
                'health_condition' => $request->input('health_condition'),
                'health_condition_specify' => $request->input('health_condition_specify'),
                'how_did_you_hear_about_us' => $request->input('how_did_you_hear_about_us'),
                'exhibiting' => $request->input('exhibiting'),
                'package' => $packageKey,
                'package_amount' => $packageAmount,
                'status' => 'PENDING',
            ]);

            // Commit the transaction
            DB::commit();

            // Return appropriate response based on request type
            if ($request->ajax() || $request->wantsJson()) {
                return response()->json([
                    'success' => true,
                    'message' => 'Registration successful!',
                    'redirect' => route('payment.show', $runner->reference)
                ]);
            }
            
            // Redirect to payment page for non-AJAX requests
            return redirect()->route('payment.show', $runner->reference);
        } catch (\Exception $e) {
            // Rollback the transaction in case of an error
            DB::rollBack();

            // Log the error
            Log::error('Registration failed', [
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString(),
                'data' => $request->except(['terms']),
            ]);

            // Return appropriate error response based on request type
            if ($request->ajax() || $request->wantsJson()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Registration failed. Please try again.'
                ], 500);
            }
            
            // Redirect back with error for non-AJAX requests
            return redirect()->back()
                ->with('error', 'Registration failed. Please try again.')
                ->withInput();
        }
    }
}
