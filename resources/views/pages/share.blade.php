@extends('layouts.app')

@section('title', 'Share Registration')

@section('content')
    <div class="bg-background py-12">
        <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="bg-white shadow-xl rounded-lg overflow-hidden">
                <!-- Share Header -->
                <div class="bg-primary px-6 py-4">
                    <h2 class="text-2xl font-bold text-white">
                        {{ $registration->name }} is Running!
                    </h2>
                    <p class="text-white opacity-80">
                        Support {{ $registration->name }} at {{ config('marathon.name') }}
                    </p>
                </div>

                <div class="p-6">
                    <div class="text-center mb-8">
                        <div class="inline-block bg-gray-50 rounded-lg p-6">
                            <div class="text-5xl font-bold text-primary">{{ $registration->race_number }}</div>
                            <div class="mt-2 text-gray-500">Race Number</div>
                        </div>
                    </div>
                    
                    <div class="mb-8">
                        <h3 class="text-lg font-medium text-gray-900 mb-4">Event Details</h3>
                        
                        <div class="bg-gray-50 rounded-lg p-4">
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                <div>
                                    <p class="text-sm text-gray-500">Event</p>
                                    <p class="font-medium">{{ config('marathon.name') }}</p>
                                </div>
                                <div>
                                    <p class="text-sm text-gray-500">Date</p>
                                    <p class="font-medium">{{ config('marathon.date') }}</p>
                                </div>
                                <div>
                                    <p class="text-sm text-gray-500">Location</p>
                                    <p class="font-medium">{{ config('marathon.location') }}</p>
                                </div>
                                <div>
                                    <p class="text-sm text-gray-500">Race Category</p>
                                    <p class="font-medium">{{ $registration->race_category }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="mb-8">
                        <h3 class="text-lg font-medium text-gray-900 mb-4">About {{ config('marathon.name') }}</h3>
                        <p class="text-gray-600">
                            {{ config('marathon.description') }}
                        </p>
                    </div>
                    
                    <div class="mb-8">
                        <h3 class="text-lg font-medium text-gray-900 mb-4">Join the Run!</h3>
                        <p class="text-gray-600 mb-4">
                            Want to join {{ $registration->name }} at {{ config('marathon.name') }}? Register now and be part of this amazing event!
                        </p>
                        <div class="flex justify-center">
                            <a href="{{ route('register') }}" class="inline-flex items-center justify-center px-5 py-3 border border-transparent text-base font-medium rounded-md text-white bg-primary hover:bg-primary-dark">
                                Register Now
                            </a>
                        </div>
                    </div>
                    
                    <div class="border-t border-gray-200 pt-6">
                        <h3 class="text-lg font-medium text-gray-900 mb-4">Share This</h3>
                        <div class="flex justify-center space-x-4">
                            <a href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode(route('confirmation.share', $registration->reference)) }}" target="_blank" class="text-blue-600 hover:text-blue-800">
                                <span class="sr-only">Facebook</span>
                                <svg class="h-8 w-8" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                                    <path fill-rule="evenodd" d="M22 12c0-5.523-4.477-10-10-10S2 6.477 2 12c0 4.991 3.657 9.128 8.438 9.878v-6.987h-2.54V12h2.54V9.797c0-2.506 1.492-3.89 3.777-3.89 1.094 0 2.238.195 2.238.195v2.46h-1.26c-1.243 0-1.63.771-1.63 1.562V12h2.773l-.443 2.89h-2.33v6.988C18.343 21.128 22 16.991 22 12z" clip-rule="evenodd" />
                                </svg>
                            </a>
                            <a href="https://twitter.com/intent/tweet?text={{ urlencode($registration->name . ' is running in ' . config('marathon.name') . '! Join them on ' . config('marathon.date') . '. #LuWSIRun') }}&url={{ urlencode(route('confirmation.share', $registration->reference)) }}" target="_blank" class="text-blue-400 hover:text-blue-600">
                                <span class="sr-only">Twitter</span>
                                <svg class="h-8 w-8" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                                    <path d="M8.29 20.251c7.547 0 11.675-6.253 11.675-11.675 0-.178 0-.355-.012-.53A8.348 8.348 0 0022 5.92a8.19 8.19 0 01-2.357.646 4.118 4.118 0 001.804-2.27 8.224 8.224 0 01-2.605.996 4.107 4.107 0 00-6.993 3.743 11.65 11.65 0 01-8.457-4.287 4.106 4.106 0 001.27 5.477A4.072 4.072 0 012.8 9.713v.052a4.105 4.105 0 003.292 4.022 4.095 4.095 0 01-1.853.07 4.108 4.108 0 003.834 2.85A8.233 8.233 0 012 18.407a11.616 11.616 0 006.29 1.84" />
                                </svg>
                            </a>
                            <a href="https://wa.me/?text={{ urlencode($registration->name . ' is running in ' . config('marathon.name') . '! Join them on ' . config('marathon.date') . '. Register here: ' . route('home')) }}" target="_blank" class="text-green-500 hover:text-green-700">
                                <span class="sr-only">WhatsApp</span>
                                <svg class="h-8 w-8" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                                    <path fill-rule="evenodd" d="M12.031 6.172c-3.181 0-5.767 2.586-5.768 5.766-.001 1.298.38 2.27 1.019 3.287l-.582 2.128 2.182-.573c.978.58 1.911.928 3.145.929 3.178 0 5.767-2.587 5.768-5.766.001-3.187-2.575-5.77-5.764-5.771zm3.392 8.244c-.144.405-.837.774-1.17.824-.299.045-.677.063-1.092-.069-.252-.08-.575-.187-.988-.365-1.739-.751-2.874-2.502-2.961-2.617-.087-.116-.708-.94-.708-1.793s.448-1.273.607-1.446c.159-.173.346-.217.462-.217l.332.006c.106.005.249-.04.39.298.144.347.491 1.2.534 1.287.043.087.072.188.014.304-.058.116-.087.188-.173.289l-.26.304c-.087.086-.177.18-.076.354.101.174.449.741.964 1.201.662.591 1.221.774 1.394.86s.274.072.376-.043c.101-.116.433-.506.549-.68.116-.173.231-.145.39-.087s1.011.477 1.184.564c.173.087.289.13.332.202.043.72.043.433-.101.824z" clip-rule="evenodd" />
                                </svg>
                            </a>
                        </div>
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
@endsection
