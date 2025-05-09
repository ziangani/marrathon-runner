@extends('layouts.app')

@section('title', 'Payment Processing')

@section('content')
    <div class="bg-background py-12">
        <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="bg-white shadow-xl rounded-lg overflow-hidden">
                <!-- Payment Header -->
                <div class="bg-yellow-500 px-6 py-4">
                    <div class="flex items-center justify-center">
                        <svg class="h-12 w-12 text-white animate-spin" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15" />
                        </svg>
                    </div>
                    <h2 class="text-2xl font-bold text-white text-center mt-2">
                        Payment Processing
                    </h2>
                    <p class="text-white opacity-80 text-center">
                        Please wait while we confirm your payment
                    </p>
                </div>

                <div class="p-6">
                    <!-- Session Messages -->
                    @include('partials.session-messages')
                    
                    <!-- Processing Message -->
                    <div class="mb-8 text-center">
                        <div class="bg-yellow-50 rounded-lg p-6">
                            <h3 class="text-lg font-medium text-gray-900 mb-2">Your payment is being processed</h3>
                            <p class="text-gray-600 mb-4">
                                Your payment is currently being processed by our payment provider. 
                                This page will automatically refresh to check the status of your payment.
                            </p>
                            <div class="flex justify-center">
                                <div class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md text-yellow-700 bg-yellow-100">
                                    <svg class="animate-spin -ml-1 mr-3 h-5 w-5 text-yellow-500" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                        <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                        <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                                    </svg>
                                    Checking payment status...
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Registration Details -->
                    <div class="mb-8">
                        <h3 class="text-lg font-medium text-gray-900 mb-4">Registration Details</h3>
                        
                        <div class="bg-gray-50 rounded-lg p-4">
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                <div>
                                    <p class="text-sm text-gray-500">Name</p>
                                    <p class="font-medium">{{ $registration->name }}</p>
                                </div>
                                <div>
                                    <p class="text-sm text-gray-500">Email</p>
                                    <p class="font-medium">{{ $registration->email }}</p>
                                </div>
                                <div>
                                    <p class="text-sm text-gray-500">Phone</p>
                                    <p class="font-medium">{{ $registration->phone }}</p>
                                </div>
                                <div>
                                    <p class="text-sm text-gray-500">Race Category</p>
                                    <p class="font-medium">{{ $registration->race_category }}</p>
                                </div>
                                <div>
                                    <p class="text-sm text-gray-500">Reference Number</p>
                                    <p class="font-medium">{{ $registration->reference }}</p>
                                </div>
                                <div>
                                    <p class="text-sm text-gray-500">Package</p>
                                    <p class="font-medium">{{ config('marathon.packages.'.$registration->package.'.name') }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <!-- What to Expect -->
                    <div class="mb-8">
                        <h3 class="text-lg font-medium text-gray-900 mb-4">What to Expect</h3>
                        
                        <div class="bg-gray-50 rounded-lg p-4">
                            <ul class="space-y-2 text-sm text-gray-600">
                                <li class="flex items-start">
                                    <svg class="h-5 w-5 text-green-500 mr-2 flex-shrink-0" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                    <span>This page will automatically refresh to check your payment status.</span>
                                </li>
                                <li class="flex items-start">
                                    <svg class="h-5 w-5 text-green-500 mr-2 flex-shrink-0" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                    <span>Once your payment is confirmed, you'll be redirected to the confirmation page.</span>
                                </li>
                                <li class="flex items-start">
                                    <svg class="h-5 w-5 text-green-500 mr-2 flex-shrink-0" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                    <span>If there's an issue with your payment, you'll be able to retry.</span>
                                </li>
                            </ul>
                        </div>
                    </div>
                    
                    <!-- Manual Refresh Button -->
                    <div class="flex justify-center">
                        <a href="{{ route('payment.check-status', $registration->reference) }}" class="inline-flex items-center px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-primary hover:bg-primary-dark focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary">
                            <svg class="-ml-1 mr-2 h-5 w-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15" />
                            </svg>
                            Check Status Now
                        </a>
                    </div>
                </div>
            </div>
            
            <!-- Return to Home -->
            <div class="mt-8 text-center">
                <a href="{{ route('home') }}" class="inline-flex items-center text-primary hover:text-primary-dark">
                    <svg class="-ml-1 mr-1 h-5 w-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                    </svg>
                    Return to Home
                </a>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const statusCheckUrl = "{{ route('payment.check-status', $registration->reference) }}";
            const statusElement = document.querySelector('.inline-flex.items-center.px-4.py-2.border.border-transparent.text-sm.font-medium.rounded-md.text-yellow-700.bg-yellow-100');
            
            // Function to check payment status via AJAX
            function checkPaymentStatus() {
                fetch(statusCheckUrl, {
                    method: 'GET',
                    headers: {
                        'Accept': 'application/json',
                        'X-Requested-With': 'XMLHttpRequest'
                    }
                })
                .then(response => response.json())
                .then(data => {
                    if (data.status === 'COMPLETE' || data.status === 'PAID') {
                        // Payment successful, redirect to confirmation page
                        statusElement.innerHTML = '<svg class="h-5 w-5 text-green-500 mr-2" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" /></svg> Payment successful! Redirecting...';
                        window.location.href = data.redirect_url;
                    } else if (data.status === 'FAILED') {
                        // Payment failed, show retry button
                        statusElement.innerHTML = '<svg class="h-5 w-5 text-red-500 mr-2" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" /></svg> Payment failed. Please retry.';
                        window.location.href = data.redirect_url;
                    } else {
                        // Payment still pending, check again in 5 seconds
                        setTimeout(checkPaymentStatus, 5000);
                    }
                })
                .catch(error => {
                    console.error('Error checking payment status:', error);
                    // If there's an error, try again in 10 seconds
                    setTimeout(checkPaymentStatus, 10000);
                });
            }
            
            // Start checking payment status
            checkPaymentStatus();
            
            // Update the manual check button to use AJAX instead of page reload
            const checkButton = document.querySelector('a[href="{{ route('payment.check-status', $registration->reference) }}"]');
            if (checkButton) {
                checkButton.addEventListener('click', function(e) {
                    e.preventDefault();
                    statusElement.innerHTML = '<svg class="animate-spin -ml-1 mr-3 h-5 w-5 text-yellow-500" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"><circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle><path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path></svg> Checking payment status...';
                    checkPaymentStatus();
                });
            }
        });
    </script>
@endsection
