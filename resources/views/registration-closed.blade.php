@extends('layouts.app')

@section('title', 'Registration Closed')

@section('content')
    <!-- Hero Section -->
    <section class="relative overflow-hidden min-h-screen flex items-center">
        <!-- Background with overlay -->
        <div class="absolute inset-0">
            <div class="absolute inset-0 bg-gradient-to-br from-primary to-secondary opacity-90"></div>
            <!-- Wave pattern overlay -->
            <div class="absolute inset-0 opacity-20">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 320" class="absolute bottom-0 w-full">
                    <path fill="rgba(255,255,255,0.3)" d="M0,192L48,176C96,160,192,128,288,133.3C384,139,480,181,576,186.7C672,192,768,160,864,154.7C960,149,1056,171,1152,165.3C1248,160,1344,128,1392,112L1440,96L1440,320L1392,320C1344,320,1248,320,1152,320C1056,320,960,320,864,320C768,320,672,320,576,320C480,320,384,320,288,320C192,320,96,320,48,320L0,320Z"></path>
                </svg>
            </div>
        </div>

        <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-24 text-center">
            <div class="bg-white bg-opacity-10 backdrop-filter backdrop-blur-lg rounded-3xl p-8 md:p-12 shadow-2xl max-w-3xl mx-auto">
                <div class="inline-block mb-6 p-2 bg-white bg-opacity-20 rounded-full">
                    <span class="px-4 py-1 text-sm font-medium text-white bg-secondary rounded-full">
                        Registration Status
                    </span>
                </div>

                <h1 class="text-4xl md:text-5xl font-extrabold text-white tracking-tight">
                    Registration Closed
                </h1>

                <p class="mt-6 text-xl text-white opacity-90 leading-relaxed">
                    We regret to inform you that registration for this year's marathon has now closed. 
                    We have reached our maximum capacity and can no longer accept new registrations.
                </p>

                <div class="mt-10 bg-white bg-opacity-10 rounded-xl p-6 text-left">
                    <h3 class="text-xl font-bold text-white mb-4">What's Next?</h3>
                    <ul class="space-y-3 text-white opacity-90">
                        <li class="flex items-start">
                            <svg class="flex-shrink-0 h-5 w-5 text-white mr-3 mt-0.5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                            </svg>
                            <span>Check our website next year for registration dates</span>
                        </li>
                        <li class="flex items-start">
                            <svg class="flex-shrink-0 h-5 w-5 text-white mr-3 mt-0.5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                            </svg>
                            <span>Follow us on social media for updates about future events</span>
                        </li>
                        
                    </ul>
                </div>

                <div class="mt-10">
                    <a href="#contact" class="inline-flex items-center justify-center px-6 py-3 border border-white text-base font-medium rounded-full text-white hover:bg-white hover:bg-opacity-10 transform transition-transform hover:scale-105 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-white">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" viewBox="0 0 20 20" fill="currentColor">
                            <path d="M2 3a1 1 0 011-1h2.153a1 1 0 01.986.836l.74 4.435a1 1 0 01-.54 1.06l-1.548.773a11.037 11.037 0 006.105 6.105l.774-1.548a1 1 0 011.059-.54l4.435.74a1 1 0 01.836.986V17a1 1 0 01-1 1h-2C7.82 18 2 12.18 2 5V3z" />
                        </svg>
                        Contact Us
                    </a>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer Section -->
    <section class="bg-gray-900 text-white py-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <p class="text-lg">Thank you for your interest in our marathon!</p>
            <p class="mt-2 text-white opacity-80">
                For any questions, please contact us at {{ config('marathon.contact.email') }} or {{ config('marathon.contact.phone') }}
            </p>
        </div>
    </section>
@endsection
