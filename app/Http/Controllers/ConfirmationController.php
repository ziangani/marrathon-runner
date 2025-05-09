<?php

namespace App\Http\Controllers;

use App\Models\Runner;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Barryvdh\DomPDF\Facade\Pdf;

class ConfirmationController extends Controller
{
    /**
     * Display the confirmation page.
     *
     * @param  string  $reference
     * @return \Illuminate\View\View|\Illuminate\Http\RedirectResponse
     */
    public function show($reference)
    {
        // Find the runner by reference
        $registration = Runner::where('reference', $reference)->first();

        // Check if the registration exists
        if (!$registration) {
            return redirect()->route('register')
                ->with('error', 'Registration not found.');
        }

        // Check if the registration is paid
        if (!$registration->hasPaid()) {
            return redirect()->route('payment.show', $registration->reference)
                ->with('error', 'Your registration is not yet paid. Please complete the payment.');
        }

        return view('pages.confirmation', compact('registration'));
    }

    /**
     * Download the registration PDF.
     *
     * @param  string  $reference
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function download($reference)
    {
        // Find the runner by reference
        $registration = Runner::where('reference', $reference)->first();

        // Check if the registration exists
        if (!$registration) {
            return redirect()->route('register')
                ->with('error', 'Registration not found.');
        }

        // Check if the registration is paid
        if (!$registration->hasPaid()) {
            return redirect()->route('payment.show', $registration->reference)
                ->with('error', 'Your registration is not yet paid. Please complete the payment.');
        }

        try {
            // Generate PDF
            $pdf = PDF::loadView('pdf.registration', [
                'registration' => $registration,
                'event_name' => config('marathon.name'),
                'event_date' => config('marathon.date'),
                'event_time' => config('marathon.time'),
                'event_location' => config('marathon.location'),
            ]);

            // Set PDF options
            $pdf->setPaper('a4', 'portrait');

            // Return the PDF for download
            return $pdf->download("registration-{$registration->reference}.pdf");
        } catch (\Exception $e) {
            // Log the error
            Log::error('PDF generation failed', [
                'reference' => $reference,
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString(),
            ]);

            return redirect()->route('confirmation.show', $registration->reference)
                ->with('error', 'Failed to generate PDF. Please try again.');
        }
    }

    /**
     * Share the registration.
     *
     * @param  string  $reference
     * @return \Illuminate\View\View|\Illuminate\Http\RedirectResponse
     */
    public function share($reference)
    {
        // Find the runner by reference
        $registration = Runner::where('reference', $reference)->first();

        // Check if the registration exists
        if (!$registration) {
            return redirect()->route('register')
                ->with('error', 'Registration not found.');
        }

        // Check if the registration is paid
        if (!$registration->hasPaid()) {
            return redirect()->route('payment.show', $registration->reference)
                ->with('error', 'This registration is not yet paid.');
        }

        // Show a public sharing page
        return view('pages.share', compact('registration'));
    }
}
