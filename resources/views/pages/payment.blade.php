@extends('layouts.app')

@section('title', 'Payment')

@section('content')
    <div class="bg-background py-12">
        <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="bg-white shadow-xl rounded-lg overflow-hidden">
                <!-- Payment Header -->
                <div class="bg-primary px-6 py-4">
                    <h2 class="text-2xl font-bold text-white">
                        Complete Your Payment
                    </h2>
                    <p class="text-white opacity-80">
                        Secure payment processing via TechPay
                    </p>
                </div>


                @include('partials.session-messages')
                <div class="p-6">

                    <!-- Registration Summary -->
                    <div class="mb-8">

                        <h3 class="text-lg font-medium text-gray-900 mb-4">Registration Summary</h3>

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
                                    <p class="text-sm text-gray-500">T-Shirt Size</p>
                                    <p class="font-medium">{{ $registration->t_shirt_size }}</p>
                                </div>
                                <div>
                                    <p class="text-sm text-gray-500">Package</p>
                                    <p class="font-medium">{{ config('marathon.packages.'.$registration->package.'.name') }}</p>
                                </div>
                            </div>

                            <div class="mt-4 pt-4 border-t border-gray-200">
                                <div class="flex justify-between items-center">
                                    <span class="font-bold text-lg">Total Amount:</span>
                                    <span class="font-bold text-xl text-primary">K{{ number_format(config('marathon.packages.'.$registration->package.'.price'), 2) }}</span>
                                </div>
                            </div>
                        </div>
                    </div>

                   <!-- Payment Options -->
                   <div class="mb-8">
                       <h3 class="text-lg font-medium text-gray-900 mb-4">Payment Method</h3>

                       <div class="space-y-4">
                           <div class="border border-gray-200 rounded-lg p-4">
                               <div class="flex items-center">
                                   <input id="payment-techpay" name="payment-method" type="radio" checked class="h-4 w-4 text-primary focus:ring-primary border-gray-300">
                                   <label for="payment-techpay" class="ml-3 block text-sm font-medium text-gray-700">
                                       Pay with Mobile Money or Card
                                   </label>
                               </div>
                               <div class="mt-2 pl-7">
                                   <p class="text-sm text-gray-500">Use your mobile money account or credit/debit card to complete the payment securely.</p>
                               </div>
                           </div>
                       </div>
                   </div>

                    <!-- Payment Button -->
                    <div>
                        <form id="payment-form" action="{{ route('payment.process', $registration->reference) }}" method="POST">
                            @csrf
                            <button type="submit" id="payment-button" class="w-full bg-primary text-white px-4 py-3 rounded-md hover:bg-primary-dark focus:outline-none focus:ring-2 focus:ring-primary focus:ring-opacity-50 flex items-center justify-center">
                                <span id="button-text">Proceed to Payment</span>
                                <span id="button-loading" class="hidden">
                                    <svg class="animate-spin -ml-1 mr-3 h-5 w-5 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                        <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                        <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                                    </svg>
                                    Processing...
                                </span>
                            </button>
                        </form>
                    </div>

                    <!-- Security Notice -->
                    <div class="mt-6 text-center">
                        <p class="text-sm text-gray-500 flex items-center justify-center">
                            <svg class="h-4 w-4 text-gray-400 mr-1" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                            </svg>
                            Secure payment processing. Your payment information is encrypted and secure.
                        </p>
                    </div>
                </div>
            </div>

            <!-- Back to Registration -->
            <div class="mt-4 text-center">
                <a href="{{ route('register') }}" class="text-primary hover:text-primary-dark">
                    &larr; Back to Registration
                </a>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const form = document.getElementById('payment-form');
            const button = document.getElementById('payment-button');
            const buttonText = document.getElementById('button-text');
            const buttonLoading = document.getElementById('button-loading');

            form.addEventListener('submit', function(e) {
                // Disable the button and show loading state
                button.disabled = true;
                buttonText.classList.add('hidden');
                buttonLoading.classList.remove('hidden');
            });
        });
    </script>
@endsection
