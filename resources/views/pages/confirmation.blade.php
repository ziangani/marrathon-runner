@extends('layouts.app')

@section('title', 'Registration Confirmed')

@section('content')
    <div class="bg-background py-12">
        <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="bg-white shadow-modal rounded-lg overflow-hidden transform transition-all duration-300">
                <!-- Confirmation Header -->
                <div class="bg-gradient-to-r from-primary to-secondary px-6 py-8 relative">
                    <div class="absolute top-0 left-0 w-full h-full opacity-10">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100" class="w-full h-full">
                            <path d="M10 10L90 10M10 20L90 20M10 30L90 30M10 40L90 40M10 50L90 50M10 60L90 60M10 70L90 70M10 80L90 80M10 90L90 90" stroke="currentColor" stroke-width="0.5" fill="none"/>
                        </svg>
                    </div>
                    <div class="flex items-center justify-center animate-bounce-slow">
                        <div class="bg-white rounded-full p-3 shadow-lg">
                            <svg class="h-12 w-12 text-primary" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                        </div>
                    </div>
                    <h2 class="text-3xl font-bold text-white text-center mt-4 drop-shadow-md">
                        Registration Confirmed!
                    </h2>
                    <p class="text-white text-center mt-2 max-w-md mx-auto">
                        Thank you for registering for {{ config('marathon.name') }}
                    </p>
                </div>

                <div class="p-6">
                    <!-- Race Number -->
                    <div class="mb-10 text-center">
                        <h3 class="text-lg font-medium text-gray-900 mb-3">Your Race Number</h3>
                        <div class="bg-gradient-to-r from-primary/10 to-secondary/10 rounded-lg p-8 inline-block shadow-inner relative overflow-hidden transform transition-transform hover:scale-105 duration-300">
                            <div class="absolute inset-0 bg-white/50"></div>
                            <div class="relative">
                                <div class="text-7xl font-bold bg-clip-text text-transparent bg-gradient-to-r from-primary to-secondary">
                                    {{ $registration->race_number }}
                                </div>
                                <div class="text-xs uppercase tracking-wider text-gray-500 mt-2">Remember this number</div>
                            </div>
                        </div>
                    </div>

                    <!-- Registration Details -->
                    <div class="mb-10">
                        <h3 class="text-lg font-medium text-gray-900 mb-4 flex items-center">
                            <svg class="w-5 h-5 mr-2 text-primary" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                            </svg>
                            Event Information
                        </h3>

                        <div class="bg-surface-raised rounded-lg p-0 shadow-sm">
                            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                                <div class="p-4 rounded-md bg-white shadow-sm border border-gray-100 flex flex-col items-center justify-center text-center transition-all duration-300 hover:shadow-md">
                                    <svg class="w-8 h-8 text-primary mb-2" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                    </svg>
                                    <p class="text-sm text-gray-500 mb-1">Event Date</p>
                                    <p class="font-medium text-gray-900">{{ config('marathon.date') }}</p>
                                </div>
                                <div class="p-4 rounded-md bg-white shadow-sm border border-gray-100 flex flex-col items-center justify-center text-center transition-all duration-300 hover:shadow-md">
                                    <svg class="w-8 h-8 text-primary mb-2" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                    <p class="text-sm text-gray-500 mb-1">Start Time</p>
                                    <p class="font-medium text-gray-900">{{ config('marathon.categories.'.$registration->race_category_key.'.start_time') ?? config('marathon.time') }}</p>
                                </div>
                                <div class="p-4 rounded-md bg-white shadow-sm border border-gray-100 flex flex-col items-center justify-center text-center transition-all duration-300 hover:shadow-md">
                                    <svg class="w-8 h-8 text-primary mb-2" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                                    </svg>
                                    <p class="text-sm text-gray-500 mb-1">Location</p>
                                    <p class="font-medium text-gray-900">{{ config('marathon.location') }}</p>
                                </div>
                            </div>

                            <div class="mt-6 p-4 bg-primary/10 rounded-lg border border-primary/20 flex items-start">
                                <svg class="w-5 h-5 text-primary mt-0.5 mr-2 flex-shrink-0" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                                <p class="text-sm text-primary-dark"><strong>Important:</strong> Please arrive at least 1 hour before your race start time to collect your race pack and prepare.</p>
                            </div>
                        </div>
                    </div>

                    <!-- Action Buttons -->
                    <div class="flex flex-col sm:flex-row gap-4 justify-center mb-6">
                        <a href="{{ route('confirmation.download', $registration->reference) }}" class="inline-flex items-center justify-center px-6 py-3 border border-transparent rounded-md shadow-button text-base font-medium text-white bg-primary hover:bg-primary-dark focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary transition-colors duration-200">
                            <svg class="-ml-1 mr-2 h-5 w-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                            </svg>
                            Download PDF
                        </a>

                        <button type="button" id="share-button" class="inline-flex items-center justify-center px-6 py-3 border border-primary rounded-md shadow-sm text-base font-medium text-primary bg-white hover:bg-primary/10 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary transition-colors duration-200">
                            <svg class="-ml-1 mr-2 h-5 w-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8.684 13.342C8.886 12.938 9 12.482 9 12c0-.482-.114-.938-.316-1.342m0 2.684a3 3 0 110-2.684m0 2.684l6.632 3.316m-6.632-6l6.632-3.316m0 0a3 3 0 105.367-2.684 3 3 0 00-5.367 2.684zm0 9.316a3 3 0 105.368 2.684 3 3 0 00-5.368-2.684z" />
                            </svg>
                            Share
                        </button>
                    </div>
                </div>
            </div>

            <!-- Next Steps -->
            <div class="mt-10 bg-white shadow-modal rounded-lg overflow-hidden transform transition-all duration-300">
                <div class="px-6 py-4 bg-gradient-to-r from-secondary to-secondary-dark relative">
                    <div class="absolute top-0 left-0 w-full h-full opacity-10">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100" class="w-full h-full">
                            <path d="M10 10L90 10M10 20L90 20M10 30L90 30M10 40L90 40M10 50L90 50M10 60L90 60M10 70L90 70M10 80L90 80M10 90L90 90" stroke="currentColor" stroke-width="0.5" fill="none"/>
                        </svg>
                    </div>
                    <h3 class="text-xl font-semibold text-white flex items-center">
                        <svg class="w-5 h-5 mr-2" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                        </svg>
                        Next Steps
                    </h3>
                </div>

                <div class="p-6">
                    <div class="space-y-6">
                        <div class="flex items-start p-4 rounded-lg bg-surface-raised hover:bg-surface-raised/80 transition-colors duration-300">
                            <div class="flex-shrink-0">
                                <div class="flex items-center justify-center h-10 w-10 rounded-full bg-gradient-to-r from-primary to-secondary text-white shadow-sm">
                                    1
                                </div>
                            </div>
                            <div class="ml-4">
                                <h4 class="text-lg font-medium text-gray-900">Save Your Race Number</h4>
                                <p class="mt-2 text-sm text-gray-600">Keep your race number handy. You'll need it to collect your race pack on event day.</p>
                            </div>
                        </div>

                        <div class="flex items-start p-4 rounded-lg bg-surface-raised hover:bg-surface-raised/80 transition-colors duration-300">
                            <div class="flex-shrink-0">
                                <div class="flex items-center justify-center h-10 w-10 rounded-full bg-gradient-to-r from-primary to-secondary text-white shadow-sm">
                                    2
                                </div>
                            </div>
                            <div class="ml-4">
                                <h4 class="text-lg font-medium text-gray-900">Check Your Email</h4>
                                <p class="mt-2 text-sm text-gray-600">We've sent a confirmation email to <span class="font-medium text-primary">{{ $registration->email }}</span> with all your registration details.</p>
                            </div>
                        </div>

                        <div class="flex items-start p-4 rounded-lg bg-surface-raised hover:bg-surface-raised/80 transition-colors duration-300">
                            <div class="flex-shrink-0">
                                <div class="flex items-center justify-center h-10 w-10 rounded-full bg-gradient-to-r from-primary to-secondary text-white shadow-sm">
                                    3
                                </div>
                            </div>
                            <div class="ml-4">
                                <h4 class="text-lg font-medium text-gray-900">Prepare for Race Day</h4>
                                <p class="mt-2 text-sm text-gray-600">Get ready for the big day! Make sure to bring your ID and confirmation email or SMS to collect your race pack.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Return to Home -->
            <div class="mt-10 text-center">
                <a href="{{ route('home') }}" class="inline-flex items-center px-6 py-3 rounded-md border border-primary text-primary hover:bg-primary/10 transition-colors duration-200 font-medium shadow-sm">
                    <svg class="-ml-1 mr-2 h-5 w-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                    </svg>
                    Return to Home
                </a>
            </div>
        </div>
    </div>

    <!-- Share Modal -->
    <div id="share-modal" class="fixed inset-0 z-50 hidden overflow-y-auto" aria-labelledby="modal-title" role="dialog" aria-modal="true">
        <div class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
            <div class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity" aria-hidden="true"></div>

            <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>

            <div class="inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-modal transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full">
                <div class="bg-gradient-to-r from-primary to-secondary px-6 py-4 relative">
                    <div class="absolute top-0 left-0 w-full h-full opacity-10">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100" class="w-full h-full">
                            <path d="M10 10L90 10M10 20L90 20M10 30L90 30M10 40L90 40M10 50L90 50M10 60L90 60M10 70L90 70M10 80L90 80M10 90L90 90" stroke="currentColor" stroke-width="0.5" fill="none"/>
                        </svg>
                    </div>
                    <h3 class="text-xl font-semibold text-white flex items-center" id="modal-title">
                        <svg class="w-5 h-5 mr-2" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8.684 13.342C8.886 12.938 9 12.482 9 12c0-.482-.114-.938-.316-1.342m0 2.684a3 3 0 110-2.684m0 2.684l6.632 3.316m-6.632-6l6.632-3.316m0 0a3 3 0 105.367-2.684 3 3 0 00-5.367 2.684zm0 9.316a3 3 0 105.368 2.684 3 3 0 00-5.368-2.684z" />
                        </svg>
                        Share Your Registration
                    </h3>
                </div>

                <div class="bg-white px-6 py-6">
                    <p class="text-sm text-gray-600 mb-6">
                        Share your registration with friends and family and encourage them to join you!
                    </p>

                    <div class="grid grid-cols-2 sm:grid-cols-4 gap-4">
                        <a href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode(route('confirmation.share', $registration->reference)) }}" target="_blank" class="flex flex-col items-center p-4 rounded-lg bg-white shadow-sm border border-gray-100 transition-all duration-300 hover:shadow-md hover:bg-blue-50">
                            <svg class="h-10 w-10 text-blue-600" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                                <path fill-rule="evenodd" d="M22 12c0-5.523-4.477-10-10-10S2 6.477 2 12c0 4.991 3.657 9.128 8.438 9.878v-6.987h-2.54V12h2.54V9.797c0-2.506 1.492-3.89 3.777-3.89 1.094 0 2.238.195 2.238.195v2.46h-1.26c-1.243 0-1.63.771-1.63 1.562V12h2.773l-.443 2.89h-2.33v6.988C18.343 21.128 22 16.991 22 12z" clip-rule="evenodd" />
                            </svg>
                            <span class="mt-3 text-sm font-medium text-gray-700">Facebook</span>
                        </a>

                        <a href="https://twitter.com/intent/tweet?text={{ urlencode('I just registered for ' . config('marathon.name') . '! Join me on ' . config('marathon.date') . '. #LuWSIRun') }}&url={{ urlencode(route('confirmation.share', $registration->reference)) }}" target="_blank" class="flex flex-col items-center p-4 rounded-lg bg-white shadow-sm border border-gray-100 transition-all duration-300 hover:shadow-md hover:bg-blue-50">
                            <svg class="h-10 w-10 text-blue-400" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                                <path d="M8.29 20.251c7.547 0 11.675-6.253 11.675-11.675 0-.178 0-.355-.012-.53A8.348 8.348 0 0022 5.92a8.19 8.19 0 01-2.357.646 4.118 4.118 0 001.804-2.27 8.224 8.224 0 01-2.605.996 4.107 4.107 0 00-6.993 3.743 11.65 11.65 0 01-8.457-4.287 4.106 4.106 0 001.27 5.477A4.072 4.072 0 012.8 9.713v.052a4.105 4.105 0 003.292 4.022 4.095 4.095 0 01-1.853.07 4.108 4.108 0 003.834 2.85A8.233 8.233 0 012 18.407a11.616 11.616 0 006.29 1.84" />
                            </svg>
                            <span class="mt-3 text-sm font-medium text-gray-700">Twitter</span>
                        </a>

                        <a href="https://wa.me/?text={{ urlencode('I just registered for ' . config('marathon.name') . '! Join me on ' . config('marathon.date') . '. Register here: ' . route('home')) }}" target="_blank" class="flex flex-col items-center p-4 rounded-lg bg-white shadow-sm border border-gray-100 transition-all duration-300 hover:shadow-md hover:bg-green-50">
                            <svg class="h-10 w-10 text-green-500" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                                <path fill-rule="evenodd" d="M12.031 6.172c-3.181 0-5.767 2.586-5.768 5.766-.001 1.298.38 2.27 1.019 3.287l-.582 2.128 2.182-.573c.978.58 1.911.928 3.145.929 3.178 0 5.767-2.587 5.768-5.766.001-3.187-2.575-5.77-5.764-5.771zm3.392 8.244c-.144.405-.837.774-1.17.824-.299.045-.677.063-1.092-.069-.252-.08-.575-.187-.988-.365-1.739-.751-2.874-2.502-2.961-2.617-.087-.116-.708-.94-.708-1.793s.448-1.273.607-1.446c.159-.173.346-.217.462-.217l.332.006c.106.005.249-.04.39.298.144.347.491 1.2.534 1.287.043.087.072.188.014.304-.058.116-.087.188-.173.289l-.26.304c-.087.086-.177.18-.076.354.101.174.449.741.964 1.201.662.591 1.221.774 1.394.86s.274.072.376-.043c.101-.116.433-.506.549-.68.116-.173.231-.145.39-.087s1.011.477 1.184.564c.173.087.289.13.332.202.043.72.043.433-.101.824z" clip-rule="evenodd" />
                            </svg>
                            <span class="mt-3 text-sm font-medium text-gray-700">WhatsApp</span>
                        </a>

                        <button type="button" id="copy-link" class="flex flex-col items-center p-4 rounded-lg bg-white shadow-sm border border-gray-100 transition-all duration-300 hover:shadow-md hover:bg-gray-50" data-link="{{ route('confirmation.share', $registration->reference) }}">
                            <svg class="h-10 w-10 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 16H6a2 2 0 01-2-2V6a2 2 0 012-2h8a2 2 0 012 2v2m-6 12h8a2 2 0 002-2v-8a2 2 0 00-2-2h-8a2 2 0 00-2 2v8a2 2 0 002 2z"></path>
                            </svg>
                            <span class="mt-3 text-sm font-medium text-gray-700">Copy Link</span>
                        </button>
                    </div>
                </div>

                <div class="bg-gray-50 px-6 py-4 sm:flex sm:flex-row-reverse">
                    <button type="button" id="close-modal" class="w-full inline-flex justify-center items-center rounded-md border border-primary px-6 py-3 bg-white text-base font-medium text-primary hover:bg-primary/10 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary transition-colors duration-200 sm:w-auto">
                        <svg class="w-4 h-4 mr-2" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                        Close
                    </button>
                </div>
            </div>
        </div>
    </div>

    <style>
        /* Custom animations */
        @keyframes bounce-slow {
            0%, 100% {
                transform: translateY(0);
            }
            50% {
                transform: translateY(-10px);
            }
        }
        .animate-bounce-slow {
            animation: bounce-slow 3s infinite;
        }

        @keyframes fade-in-up {
            from {
                opacity: 0;
                transform: translateY(20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
        .animate-fade-in-up {
            animation: fade-in-up 0.3s ease-out forwards;
        }
    </style>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Share modal functionality
            const shareButton = document.getElementById('share-button');
            const shareModal = document.getElementById('share-modal');
            const closeModal = document.getElementById('close-modal');
            const copyLink = document.getElementById('copy-link');

            shareButton.addEventListener('click', function() {
                shareModal.classList.remove('hidden');
                // Add entrance animation
                const modalContent = shareModal.querySelector('.inline-block');
                modalContent.classList.add('animate-fade-in-up');
            });

            closeModal.addEventListener('click', function() {
                shareModal.classList.add('hidden');
            });

            // Close modal when clicking outside
            shareModal.addEventListener('click', function(e) {
                if (e.target === shareModal) {
                    shareModal.classList.add('hidden');
                }
            });

            // Copy link functionality
            copyLink.addEventListener('click', function() {
                const link = this.getAttribute('data-link');

                // Create a temporary input element
                const tempInput = document.createElement('input');
                tempInput.value = link;
                document.body.appendChild(tempInput);

                // Select and copy the link
                tempInput.select();
                document.execCommand('copy');

                // Remove the temporary input
                document.body.removeChild(tempInput);

                // Show copied message with animation
                const originalText = this.querySelector('span').textContent;
                this.querySelector('span').textContent = 'Copied!';
                this.classList.add('scale-105', 'text-primary');

                // Reset text and animation after 2 seconds
                setTimeout(() => {
                    this.querySelector('span').textContent = originalText;
                    this.classList.remove('scale-105', 'text-primary');
                }, 2000);
            });

            // Add hover effects to cards
            const cards = document.querySelectorAll('.hover\\:shadow-md');
            cards.forEach(card => {
                card.addEventListener('mouseenter', function() {
                    this.classList.add('transform', 'scale-105', 'z-10');
                });
                card.addEventListener('mouseleave', function() {
                    this.classList.remove('transform', 'scale-105', 'z-10');
                });
            });
        });
    </script>
@endsection
