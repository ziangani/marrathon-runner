<?php

namespace App\Http\Controllers;

use App\Integrations\TechPay\HostedCheckOut;
use App\Models\Runner;
use App\Models\Transactions;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class PaymentController extends Controller
{
    /**
     * The TechPay service instance.
     *
     * @var \App\Integrations\TechPay\HostedCheckOut
     */
    protected $techpay;

    /**
     * Create a new controller instance.
     *
     * @param  \App\Integrations\TechPay\HostedCheckOut  $techpay
     * @return void
     */
    public function __construct(HostedCheckOut $techpay)
    {
        $this->techpay = $techpay;
    }

    /**
     * Display the payment page.
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

        // Check if the registration is already paid
        if ($registration->hasPaid()) {
            return redirect()->route('confirmation.show', $registration->reference)
                ->with('info', 'Your registration has already been paid.');
        }

        // Check if the registration is cancelled
        if ($registration->isCancelled()) {
            return redirect()->route('register')
                ->with('error', 'This registration has been cancelled. Please register again.');
        }

        return view('pages.payment', compact('registration'));
    }

    /**
     * Process the payment.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  string  $reference
     * @return \Illuminate\Http\RedirectResponse
     */
    public function process(Request $request, $reference)
    {
        // Find the runner by reference
        $registration = Runner::where('reference', $reference)->first();

        // Check if the registration exists
        if (!$registration) {
            return redirect()->route('register')
                ->with('error', 'Registration not found.');
        }

        // Check if the registration is already paid
        if ($registration->hasPaid()) {
            return redirect()->route('confirmation.show', $registration->reference)
                ->with('info', 'Your registration has already been paid.');
        }

        // Check if the registration is cancelled
        if ($registration->isCancelled()) {
            return redirect()->route('register')
                ->with('error', 'This registration has been cancelled. Please register again.');
        }

        try {
            // Prepare payment data
            $paymentData = [
                'amount' => $registration->package_amount,
                'currency' => 'ZMW',
                'reference' => $registration->reference,
                'description' => config('marathon.name') . ' Registration - ' . $registration->package_name,
                'customer_email' => $registration->email,
                'customer_name' => $registration->name,
                'customer_phone' => $registration->phone,
                'return_url' => route('payment.callback'),
                'cancel_url' => route('payment.show', $registration->reference),
            ];

            // Create a transaction record
            $transaction = Transactions::create([
                'reference' => $registration->reference,
                'amount' => $registration->package_amount,
                'currency' => 'ZMW',
                'status' => 'PENDING',
                'provider' => 'techpay',
                'description' => config('marathon.name') . ' Registration - ' . $registration->package_name,
                'metadata' => json_encode([
                    'runner_id' => $registration->id,
                    'package' => $registration->package,
                    'package_name' => $registration->package_name,
                ]),
            ]);

            // Get token from TechPay
            $token = $this->techpay->getToken(
                $registration->package_amount,
                $registration->reference,
                $paymentData['description'],
                route('payment.callback')
            );

            // Update the transaction with the token
            $transaction->update([
                'provider_reference' => $token,
            ]);

            // Redirect to the TechPay hosted checkout page
            $paymentUrl = $this->techpay->getEndpoint() . '/hc/pay/' . $token;
            return redirect()->away($paymentUrl);
        } catch (\Exception $e) {
            // Log the error
            Log::error('Payment processing failed', [
                'reference' => $registration->reference,
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString(),
            ]);

            return redirect()->route('payment.show', $registration->reference)
                ->with('error', 'An error occurred while processing your payment. Please try again.');
        }
    }

    /**
     * Handle the payment callback.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function callback(Request $request)
    {
        // Get the payment reference from the request
        $reference = $request->input('reference');
        $paymentId = $request->input('payment_id');
        $status = $request->input('status');

        // Log the callback data
        Log::info('Payment callback received', [
            'reference' => $reference,
            'payment_id' => $paymentId,
            'status' => $status,
            'data' => $request->all(),
        ]);

        // Find the runner by reference
        $registration = Runner::where('reference', $reference)->first();

        // Check if the registration exists
        if (!$registration) {
            return redirect()->route('register')
                ->with('error', 'Registration not found.');
        }

        // Find the transaction
        $transaction = Transactions::where('reference', $reference)->first();

        // Check if the transaction exists
        if (!$transaction) {
            Log::error('Transaction not found for callback', [
                'reference' => $reference,
                'payment_id' => $paymentId,
            ]);

            return redirect()->route('payment.show', $reference)
                ->with('error', 'Transaction not found. Please try again.');
        }

        try {
            // Verify the payment status with TechPay
            $paymentStatus = $this->techpay->getTransactionStatus($paymentId);

            // Check if the payment was successful
            if ($paymentStatus->data->status === 'PAID') {
                // Update the transaction status
                $transaction->update([
                    'status' => 'PAID',
                    'provider_reference' => $paymentId,
                    'provider_response' => json_encode($paymentStatus),
                    'paid_at' => now(),
                ]);

                // Mark the registration as paid
                $registration->markAsPaid($transaction->id, 'techpay', $paymentId);

                // Redirect to the confirmation page
                return redirect()->route('confirmation.show', $registration->reference)
                    ->with('success', 'Payment successful! Your registration is now complete.');
            } else {
                // Update the transaction status
                $transaction->update([
                    'status' => 'FAILED',
                    'provider_reference' => $paymentId,
                    'provider_response' => json_encode($paymentStatus),
                ]);

                // Redirect back to the payment page
                return redirect()->route('payment.show', $reference)
                    ->with('error', 'Payment failed. Please try again.');
            }
        } catch (\Exception $e) {
            // Log the error
            Log::error('Payment verification failed', [
                'reference' => $reference,
                'payment_id' => $paymentId,
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString(),
            ]);

            return redirect()->route('payment.show', $reference)
                ->with('error', 'An error occurred while verifying your payment. Please contact support.');
        }
    }
}
