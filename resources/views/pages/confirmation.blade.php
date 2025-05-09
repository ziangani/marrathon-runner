@extends('layouts.app')

@section('title', 'Registration Confirmed')

@section('content')
    <div class="bg-background py-12">
        <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="bg-white shadow-xl rounded-lg overflow-hidden">
                <!-- Confirmation Header -->
                <div class="bg-green-500 px-6 py-4">
                    <div class="flex items-center justify-center">
                        <svg class="h-12 w-12 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </div>
                    <h2 class="text-2xl font-bold text-white text-center mt-2">
                        Registration Confirmed!
                    </h2>
                    <p class="text-white opacity-80 text-center">
                        Thank you for registering for {{ config('marathon.name') }}
                    </p>
                </div>

                <div class="p-6">
                    <!-- Session Messages -->
                    @include('partials.session-messages')
                    
                    <!-- Race Number -->
                    <div class="mb-8 text-center">
                        <h3 class="text-lg font-medium text-gray-900 mb-2">Your Race Number</h3>
                        <div class="bg-gray-50 rounded-lg p-6 inline-block">
                            <div class="text-5xl font-bold text-primary">{{ $registration->race_number }}</div>
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
                                    <p class="text-sm text-gray-500">T-Shirt Size</p>
                                    <p class="font-medium">{{ $registration->t_shirt_size }}</p>
                                </div>
                                <div>
                                    <p class="text-sm text-gray-500">Package</p>
                                    <p class="font-medium">{{ config('marathon.packages.'.$registration->package.'.name') }}</p>
                                </div>
                                <div>
                                    <p class="text-sm text-gray-500">Reference Number</p>
                                    <p class="font-medium">{{ $registration->reference }}</p>
                                </div>
                                <div>
                                    <p class="text-sm text-gray-500">Registration Date</p>
                                    <p class="font-medium">{{ $registration->created_at->format('F j, Y') }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Event Information -->
                    <div class="mb-8">
                        <h3 class="text-lg font-medium text-gray-900 mb-4">Event Information</h3>
                        
                        <div class="bg-gray-50 rounded-lg p-4">
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                <div>
                                    <p class="text-sm text-gray-500">Event Date</p>
                                    <p class="font-medium">{{ config('marathon.date') }}</p>
                                </div>
                                <div>
                                    <p class="text-sm text-gray-500">Start Time</p>
                                    <p class="font-medium">{{ config('marathon.categories.'.$registration->race_category_key.'.start_time') ?? config('marathon.time') }}</p>
                                </div>
                                <div>
                                    <p class="text-sm text-gray-500">Location</p>
                                    <p class="font-medium">{{ config('marathon.location') }}</p>
                                </div>
                            </div>
                            
                            <div class="mt-4 text-sm text-gray-500">
                                <p><strong>Important:</strong> Please arrive at least 1 hour before your race start time to collect your race pack and prepare.</p>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Action Buttons -->
                    <div class="flex flex-col sm:flex-row gap-4 justify-center">
                        <a href="{{ route('confirmation.download', $registration->reference) }}" class="inline-flex items-center justify-center px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-primary hover:bg-primary-dark focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary">
                            <svg class="-ml-1 mr-2 h-5 w-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                            </svg>
                            Download PDF
                        </a>
                        
                        <button type="button" id="share-button" class="inline-flex items-center justify-center px-4 py-2 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary">
                            <svg class="-ml-1 mr-2 h-5 w-5 text-gray-500" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8.684 13.342C8.886 12.938 9 12.482 9 12c0-.482-.114-.938-.316-1.342m0 2.684a3 3 0 110-2.684m0 2.684l6.632 3.316m-6.632-6l6.632-3.316m0 0a3 3 0 105.367-2.684 3 3 0 00-5.367 2.684zm0 9.316a3 3 0 105.368 2.684 3 3 0 00-5.368-2.684z" />
                            </svg>
                            Share
                        </button>
                    </div>
                </div>
            </div>
            
            <!-- Next Steps -->
            <div class="mt-8 bg-white shadow-xl rounded-lg overflow-hidden">
                <div class="px-6 py-4 bg-secondary">
                    <h3 class="text-lg font-medium text-white">Next Steps</h3>
                </div>
                
                <div class="p-6">
                    <div class="space-y-4">
                        <div class="flex">
                            <div class="flex-shrink-0">
                                <div class="flex items-center justify-center h-8 w-8 rounded-full bg-primary text-white">
                                    1
                                </div>
                            </div>
                            <div class="ml-4">
                                <h4 class="text-lg font-medium text-gray-900">Save Your Race Number</h4>
                                <p class="mt-1 text-sm text-gray-500">Keep your race number handy. You'll need it to collect your race pack on event day.</p>
                            </div>
                        </div>
                        
                        <div class="flex">
                            <div class="flex-shrink-0">
                                <div class="flex items-center justify-center h-8 w-8 rounded-full bg-primary text-white">
                                    2
                                </div>
                            </div>
                            <div class="ml-4">
                                <h4 class="text-lg font-medium text-gray-900">Check Your Email</h4>
                                <p class="mt-1 text-sm text-gray-500">We've sent a confirmation email to {{ $registration->email }} with all your registration details.</p>
                            </div>
                        </div>
                        
                        <div class="flex">
                            <div class="flex-shrink-0">
                                <div class="flex items-center justify-center h-8 w-8 rounded-full bg-primary text-white">
                                    3
                                </div>
                            </div>
                            <div class="ml-4">
                                <h4 class="text-lg font-medium text-gray-900">Prepare for Race Day</h4>
                                <p class="mt-1 text-sm text-gray-500">Get ready for the big day! Make sure to bring your ID and confirmation email or SMS to collect your race pack.</p>
                            </div>
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

    <!-- Share Modal -->
    <div id="share-modal" class="fixed inset-0 z-50 hidden overflow-y-auto" aria-labelledby="modal-title" role="dialog" aria-modal="true">
        <div class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
            <div class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity" aria-hidden="true"></div>
            
            <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>
            
            <div class="inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full">
                <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                    <div class="sm:flex sm:items-start">
                        <div class="mt-3 text-center sm:mt-0 sm:ml-4 sm:text-left w-full">
                            <h3 class="text-lg leading-6 font-medium text-gray-900" id="modal-title">
                                Share Your Registration
                            </h3>
                            <div class="mt-4">
                                <p class="text-sm text-gray-500 mb-4">
                                    Share your registration with friends and family!
                                </p>
                                
                                <div class="flex flex-wrap justify-center gap-4">
                                    <a href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode(route('confirmation.share', $registration->reference)) }}" target="_blank" class="inline-flex flex-col items-center p-3 rounded-lg hover:bg-gray-50">
                                        <svg class="h-8 w-8 text-blue-600" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                                            <path fill-rule="evenodd" d="M22 12c0-5.523-4.477-10-10-10S2 6.477 2 12c0 4.991 3.657 9.128 8.438 9.878v-6.987h-2.54V12h2.54V9.797c0-2.506 1.492-3.89 3.777-3.89 1.094 0 2.238.195 2.238.195v2.46h-1.26c-1.243 0-1.63.771-1.63 1.562V12h2.773l-.443 2.89h-2.33v6.988C18.343 21.128 22 16.991 22 12z" clip-rule="evenodd" />
                                        </svg>
                                        <span class="mt-2 text-sm text-gray-700">Facebook</span>
                                    </a>
                                    
                                    <a href="https://twitter.com/intent/tweet?text={{ urlencode('I just registered for ' . config('marathon.name') . '! Join me on ' . config('marathon.date') . '. #LuWSIRun') }}&url={{ urlencode(route('confirmation.share', $registration->reference)) }}" target="_blank" class="inline-flex flex-col items-center p-3 rounded-lg hover:bg-gray-50">
                                        <svg class="h-8 w-8 text-blue-400" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                                            <path d="M8.29 20.251c7.547 0 11.675-6.253 11.675-11.675 0-.178 0-.355-.012-.53A8.348 8.348 0 0022 5.92a8.19 8.19 0 01-2.357.646 4.118 4.118 0 001.804-2.27 8.224 8.224 0 01-2.605.996 4.107 4.107 0 00-6.993 3.743 11.65 11.65 0 01-8.457-4.287 4.106 4.106 0 001.27 5.477A4.072 4.072 0 012.8 9.713v.052a4.105 4.105 0 003.292 4.022 4.095 4.095 0 01-1.853.07 4.108 4.108 0 003.834 2.85A8.233 8.233 0 012 18.407a11.616 11.616 0 006.29 1.84" />
                                        </svg>
                                        <span class="mt-2 text-sm text-gray-700">Twitter</span>
                                    </a>
                                    
                                    <a href="https://wa.me/?text={{ urlencode('I just registered for ' . config('marathon.name') . '! Join me on ' . config('marathon.date') . '. Register here: ' . route('home')) }}" target="_blank" class="inline-flex flex-col items-center p-3 rounded-lg hover:bg-gray-50">
                                        <svg class="h-8 w-8 text-green-500" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                                            <path fill-rule="evenodd" d="M12.031 6.172c-3.181 0-5.767 2.586-5.768 5.766-.001 1.298.38 2.27 1.019 3.287l-.582 2.128 2.182-.573c.978.58 1.911.928 3.145.929 3.178 0 5.767-2.587 5.768-5.766.001-3.187-2.575-5.77-5.764-5.771zm3.392 8.244c-.144.405-.837.774-1.17.824-.299.045-.677.063-1.092-.069-.252-.08-.575-.187-.988-.365-1.739-.751-2.874-2.502-2.961-2.617-.087-.116-.708-.94-.708-1.793s.448-1.273.607-1.446c.159-.173.346-.217.462-.217l.332.006c.106.005.249-.04.39.298.144.347.491 1.2.534 1.287.043.087.072.188.014.304-.058.116-.087.188-.173.289l-.26.304c-.087.086-.177.18-.076.354.101.174.449.741.964 1.201.662.591 1.221.774 1.394.86s.274.072.376-.043c.101-.116.433-.506.549-.68.116-.173.231-.145.39-.087s1.011.477 1.184.564c.173.087.289.13.332.202.043.72.043.433-.101.824z" clip-rule="evenodd" />
                                        </svg>
                                        <span class="mt-2 text-sm text-gray-700">WhatsApp</span>
                                    </a>
                                    
                                    <button type="button" id="copy-link" class="inline-flex flex-col items-center p-3 rounded-lg hover:bg-gray-50" data-link="{{ route('confirmation.share', $registration->reference) }}">
                                        <svg class="h-8 w-8 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 16H6a2 2 0 01-2-2V6a2 2 0 012-2h8a2 2 0 012 2v2m-6 12h8a2 2 0 002-2v-8a2 2 0 00-2-2h-8a2 2 0 00-2 2v8a2 2 0 002 2z"></path>
                                        </svg>
                                        <span class="mt-2 text-sm text-gray-700">Copy Link</span>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="bg-gray-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
                    <button type="button" id="close-modal" class="mt-3 w-full inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm">
                        Close
                    </button>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Share modal functionality
            const shareButton = document.getElementById('share-button');
            const shareModal = document.getElementById('share-modal');
            const closeModal = document.getElementById('close-modal');
            const copyLink = document.getElementById('copy-link');
            
            shareButton.addEventListener('click', function() {
                shareModal.classList.remove('hidden');
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
                
                // Show copied message
                const originalText = this.querySelector('span').textContent;
                this.querySelector('span').textContent = 'Copied!';
                
                // Reset text after 2 seconds
                setTimeout(() => {
                    this.querySelector('span').textContent = originalText;
                }, 2000);
            });
        });
    </script>
@endsection
