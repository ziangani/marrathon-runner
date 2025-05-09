@extends('layouts.app')

@section('title', 'Register')

@section('content')
    <div class="min-h-screen bg-gradient-to-b from-background to-white py-16">
        <!-- Water-themed decorative elements -->
        <div class="absolute top-20 right-0 w-64 h-64 bg-primary opacity-5 rounded-full -mr-32"></div>
        <div class="absolute bottom-0 left-0 w-96 h-96 bg-secondary opacity-5 rounded-full -ml-48"></div>

        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 relative">
            <!-- Registration Card -->
            <div class="bg-white shadow-2xl rounded-3xl overflow-hidden border border-gray-100">
                <!-- Registration Header -->
                <div class="bg-gradient-to-r from-primary to-secondary px-8 py-8 relative overflow-hidden">
                    <!-- Wave pattern overlay -->
                    <div class="absolute inset-0 opacity-10">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 320" class="absolute bottom-0 w-full">
                            <path fill="rgba(255,255,255,0.3)"
                                  d="M0,192L48,176C96,160,192,128,288,133.3C384,139,480,181,576,186.7C672,192,768,160,864,154.7C960,149,1056,171,1152,165.3C1248,160,1344,128,1392,112L1440,96L1440,320L1392,320C1344,320,1248,320,1152,320C1056,320,960,320,864,320C768,320,672,320,576,320C480,320,384,320,288,320C192,320,96,320,48,320L0,320Z"></path>
                        </svg>
                    </div>

                    <div class="relative">
                        <h2 class="text-3xl font-bold text-white">
                            Register for {{ config('marathon.name') }}
                        </h2>
                        <p class="mt-2 text-white text-opacity-90 max-w-xl">
                            Complete the form below to register for the event and join us in making a difference for
                            water security in Zambia.
                        </p>
                    </div>
                </div>

                <!-- Multi-step Form -->
                <div class="p-8">
                    <!-- Session Messages -->
                    @include('partials.session-messages')
                    
                    <!-- Progress Steps (Simplified to 2 steps) -->
                    <div class="mb-12 px-4">
                        <div class="flex items-center justify-between">
                            <div class="step step-1 flex flex-col items-center">
                                <div
                                    class="w-12 h-12 rounded-full bg-primary text-white flex items-center justify-center font-bold text-lg shadow-md step-active transition-all duration-300 transform hover:scale-110">
                                    1
                                </div>
                                <div class="text-sm font-medium mt-2 text-gray-700">Personal & Race Details</div>
                            </div>
                            <div class="flex-1 h-1 bg-gray-200 mx-2 rounded-full overflow-hidden">
                                <div class="h-full bg-primary step-progress-1 transition-all duration-500 ease-in-out"
                                     style="width: 0%"></div>
                            </div>
                            <div class="step step-2 flex flex-col items-center">
                                <div
                                    class="w-12 h-12 rounded-full bg-gray-200 text-gray-600 flex items-center justify-center font-bold text-lg shadow-md transition-all duration-300 transform hover:scale-110">
                                    2
                                </div>
                                <div class="text-sm font-medium mt-2 text-gray-500">Additional Info & Package</div>
                            </div>
                        </div>
                    </div>

                    <!-- Form with AJAX submission -->
                    <form id="registration-form" action="{{ route('register.store') }}" method="POST">
                        @csrf

                        <!-- Step 1: Personal & Race Details (Combined) -->
                        <div class="step-content step-content-1">
                            <!-- Personal Information Section -->
                            <div class="mb-8">
                                <div class="flex items-center mb-6">
                                    <div
                                        class="flex items-center justify-center h-10 w-10 rounded-full bg-primary bg-opacity-10 text-primary">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none"
                                             viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                  d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                                        </svg>
                                    </div>
                                    <h3 class="ml-3 text-xl font-bold text-gray-900">Personal Information</h3>
                                </div>

                                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                    <div class="md:col-span-1">
                                        <label for="name" class="block text-sm font-medium text-gray-700 mb-1">Full
                                            Name</label>
                                        <input type="text" name="name" id="name"
                                               class="px-4 py-3 block w-full rounded-lg border-2 border-gray-200 shadow-sm focus:border-primary focus:ring focus:ring-primary focus:ring-opacity-50 transition-all duration-200"
                                               placeholder="John Doe" required>
                                        <div class="error-message text-red-500 text-sm mt-1 hidden"
                                             id="name-error"></div>
                                    </div>

                                    <div>
                                        <label for="email" class="block text-sm font-medium text-gray-700 mb-1">Email
                                            Address</label>
                                        <input type="email" name="email" id="email"
                                               class="px-4 py-3 block w-full rounded-lg border-2 border-gray-200 shadow-sm focus:border-primary focus:ring focus:ring-primary focus:ring-opacity-50 transition-all duration-200"
                                               placeholder="you@example.com" required>
                                        <div class="error-message text-red-500 text-sm mt-1 hidden"
                                             id="email-error"></div>
                                    </div>

                                    <div>
                                        <label for="phone" class="block text-sm font-medium text-gray-700 mb-1">Phone
                                            Number</label>
                                        <input type="tel" name="phone" id="phone"
                                               class="px-4 py-3 block w-full rounded-lg border-2 border-gray-200 shadow-sm focus:border-primary focus:ring focus:ring-primary focus:ring-opacity-50 transition-all duration-200"
                                               placeholder="+260 97 1234567" required>
                                        <div class="error-message text-red-500 text-sm mt-1 hidden"
                                             id="phone-error"></div>
                                    </div>

                                    <div>
                                        <label for="age" class="block text-sm font-medium text-gray-700 mb-1">Age
                                            Group</label>
                                        <select name="age" id="age"
                                                class="px-4 py-3 block w-full rounded-lg border-2 border-gray-200 shadow-sm focus:border-primary focus:ring focus:ring-primary focus:ring-opacity-50 transition-all duration-200"
                                                required>
                                            <option value="">Select Age Group</option>
                                            <option value="below 20 years">Below 20 years</option>
                                            <option value="21 to 30 years">21 to 30 years</option>
                                            <option value="31 to 40 years">31 to 40 years</option>
                                            <option value="41 to 50 years">41 to 50 years</option>
                                            <option value="51 years and above">51 years and above</option>
                                        </select>
                                        <div class="error-message text-red-500 text-sm mt-1 hidden"
                                             id="age-error"></div>
                                    </div>

                                    <div>
                                        <label for="gender"
                                               class="block text-sm font-medium text-gray-700 mb-1">Gender</label>
                                        <select name="gender" id="gender"
                                                class="px-4 py-3 block w-full rounded-lg border-2 border-gray-200 shadow-sm focus:border-primary focus:ring focus:ring-primary focus:ring-opacity-50 transition-all duration-200"
                                                required>
                                            <option value="">Select Gender</option>
                                            <option value="Male">Male</option>
                                            <option value="Female">Female</option>
                                        </select>
                                        <div class="error-message text-red-500 text-sm mt-1 hidden"
                                             id="gender-error"></div>
                                    </div>


                                    <div>
                                        <label for="health_condition"
                                               class="block text-sm font-medium text-gray-700 mb-1">Do you have any
                                            health condition?</label>
                                        <select name="health_condition" id="health_condition"
                                                class="px-4 py-3 block w-full rounded-lg border-2 border-gray-200 shadow-sm focus:border-primary focus:ring focus:ring-primary focus:ring-opacity-50 transition-all duration-200"
                                                required>
                                            <option value="">Select Option</option>
                                            <option value="Yes">Yes</option>
                                            <option value="No">No</option>
                                        </select>
                                        <div class="error-message text-red-500 text-sm mt-1 hidden"
                                             id="health_condition-error"></div>
                                    </div>

                                    <div id="health_condition_specify_container" class="hidden md:col-span-2">
                                        <label for="health_condition_specify"
                                               class="block text-sm font-medium text-gray-700 mb-1">Please specify your
                                            health condition</label>
                                        <input type="text" name="health_condition_specify" id="health_condition_specify"
                                               class="px-4 py-3 block w-full rounded-lg border-2 border-gray-200 shadow-sm focus:border-primary focus:ring focus:ring-primary focus:ring-opacity-50 transition-all duration-200"
                                               placeholder="Please describe your health condition">
                                        <div class="error-message text-red-500 text-sm mt-1 hidden"
                                             id="health_condition_specify-error"></div>
                                    </div>
                                </div>
                            </div>

                            <!-- Race Details Section -->
                            <div class="mb-8">
                                <div class="flex items-center mb-6">
                                    <div
                                        class="flex items-center justify-center h-10 w-10 rounded-full bg-primary bg-opacity-10 text-primary">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none"
                                             viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                  d="M13 10V3L4 14h7v7l9-11h-7z"/>
                                        </svg>
                                    </div>
                                    <h3 class="ml-3 text-xl font-bold text-gray-900">Race Details</h3>
                                </div>

                                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                    <div>
                                        <label for="t_shirt_size" class="block text-sm font-medium text-gray-700 mb-1">T-Shirt
                                            Size</label>
                                        <select name="t_shirt_size" id="t_shirt_size"
                                                class="px-4 py-3 block w-full rounded-lg border-2 border-gray-200 shadow-sm focus:border-primary focus:ring focus:ring-primary focus:ring-opacity-50 transition-all duration-200"
                                                required>
                                            <option value="">Select T-Shirt Size</option>
                                            <option value="XS">XS</option>
                                            <option value="S">S</option>
                                            <option value="M">M</option>
                                            <option value="L">L</option>
                                            <option value="XL">XL</option>
                                            <option value="XXL">XXL</option>
                                            <option value="XXXL">XXXL</option>
                                        </select>
                                        <div class="error-message text-red-500 text-sm mt-1 hidden"
                                             id="t_shirt_size-error"></div>
                                    </div>

                                    <div class="md:col-span-1">
                                        <label for="race_category" class="block text-sm font-medium text-gray-700 mb-1">Race
                                            Category</label>
                                        <select name="race_category" id="race_category"
                                                class="px-4 py-3 block w-full rounded-lg border-2 border-gray-200 shadow-sm focus:border-primary focus:ring focus:ring-primary focus:ring-opacity-50 transition-all duration-200"
                                                required>
                                            <option value="">Select Race Category</option>
                                            @foreach(config('marathon.categories') as $key => $category)
                                                <option value="{{ $category['name'] }}">{{ $category['name'] }}
                                                    - {{ $category['description'] }}</option>
                                            @endforeach
                                        </select>
                                        <div class="error-message text-red-500 text-sm mt-1 hidden"
                                             id="race_category-error"></div>
                                    </div>


                                </div>
                            </div>

                            <div class="flex justify-end">
                                <button type="button"
                                        class="next-step bg-primary text-white px-6 py-3 rounded-full hover:bg-primary-dark focus:outline-none focus:ring-2 focus:ring-primary focus:ring-opacity-50 shadow-md transform transition-transform hover:scale-105 flex items-center"
                                        data-step="1">
                                    Next Step
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 ml-2" viewBox="0 0 20 20"
                                         fill="currentColor">
                                        <path fill-rule="evenodd"
                                              d="M10.293 5.293a1 1 0 011.414 0l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414-1.414L12.586 11H5a1 1 0 110-2h7.586l-2.293-2.293a1 1 0 010-1.414z"
                                              clip-rule="evenodd"/>
                                    </svg>
                                </button>
                            </div>
                        </div>

                        <!-- Step 2: Additional Info & Package (Combined) -->
                        <div class="step-content step-content-2 hidden">
                            <!-- Additional Information Section -->
                            <div class="mb-8">
                                <div class="flex items-center mb-6">
                                    <div
                                        class="flex items-center justify-center h-10 w-10 rounded-full bg-primary bg-opacity-10 text-primary">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none"
                                             viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                  d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                        </svg>
                                    </div>
                                    <h3 class="ml-3 text-xl font-bold text-gray-900">Additional Information</h3>
                                </div>

                                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                    <div>
                                        <label for="emergency_contact_name"
                                               class="block text-sm font-medium text-gray-700 mb-1">Emergency Contact
                                            Name</label>
                                        <input type="text" name="emergency_contact_name" id="emergency_contact_name"
                                               class="px-4 py-3 block w-full rounded-lg border-2 border-gray-200 shadow-sm focus:border-primary focus:ring focus:ring-primary focus:ring-opacity-50 transition-all duration-200"
                                               required>
                                        <div class="error-message text-red-500 text-sm mt-1 hidden"
                                             id="emergency_contact_name-error"></div>
                                    </div>

                                    <div>
                                        <label for="emergency_contact_phone"
                                               class="block text-sm font-medium text-gray-700 mb-1">Emergency Contact
                                            Phone</label>
                                        <input type="tel" name="emergency_contact_phone" id="emergency_contact_phone"
                                               class="px-4 py-3 block w-full rounded-lg border-2 border-gray-200 shadow-sm focus:border-primary focus:ring focus:ring-primary focus:ring-opacity-50 transition-all duration-200"
                                               required>
                                        <div class="error-message text-red-500 text-sm mt-1 hidden"
                                             id="emergency_contact_phone-error"></div>
                                    </div>

                                    <div>
                                        <label for="how_did_you_hear_about_us"
                                               class="block text-sm font-medium text-gray-700 mb-1">How did you hear
                                            about us?</label>
                                        <select name="how_did_you_hear_about_us" id="how_did_you_hear_about_us"
                                                class="px-4 py-3 block w-full rounded-lg border-2 border-gray-200 shadow-sm focus:border-primary focus:ring focus:ring-primary focus:ring-opacity-50 transition-all duration-200"
                                                required>
                                            <option value="">Select Option</option>
                                            <option value="Facebook">Facebook</option>
                                            <option value="Whatsapp">Whatsapp</option>
                                            <option value="Email">Email</option>
                                            <option value="LinkedIn">LinkedIn</option>
                                            <option value="Website">Website</option>
                                            <option value="A friend/workmate/ family member">A friend/workmate/ family
                                                member
                                            </option>
                                        </select>
                                        <div class="error-message text-red-500 text-sm mt-1 hidden"
                                             id="how_did_you_hear_about_us-error"></div>
                                    </div>

                                    <div>
                                        <label for="exhibiting" class="block text-sm font-medium text-gray-700 mb-1">Are
                                            you exhibiting?</label>
                                        <select name="exhibiting" id="exhibiting"
                                                class="px-4 py-3 block w-full rounded-lg border-2 border-gray-200 shadow-sm focus:border-primary focus:ring focus:ring-primary focus:ring-opacity-50 transition-all duration-200"
                                                required>
                                            <option value="">Select Option</option>
                                            <option value="Yes">Yes</option>
                                            <option value="No">No</option>
                                            <option value="Maybe">Maybe</option>
                                        </select>
                                        <div class="error-message text-red-500 text-sm mt-1 hidden"
                                             id="exhibiting-error"></div>
                                    </div>
                                </div>
                            </div>

                            <!-- Package Selection Section -->
                            <div class="mb-8">
                                <div class="flex items-center mb-6">
                                    <div
                                        class="flex items-center justify-center h-10 w-10 rounded-full bg-primary bg-opacity-10 text-primary">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none"
                                             viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                  d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                        </svg>
                                    </div>
                                    <h3 class="ml-3 text-xl font-bold text-gray-900">Package Selection</h3>
                                </div>

                                <div class="grid grid-cols-1 gap-6">
                                    <div>
                                        <label for="package" class="block text-sm font-medium text-gray-700 mb-1">Select
                                            Package</label>
                                        <select name="package" id="package"
                                                class="px-4 py-3 block w-full rounded-lg border-2 border-gray-200 shadow-sm focus:border-primary focus:ring focus:ring-primary focus:ring-opacity-50 transition-all duration-200"
                                                required>
                                            <option value="">Select Package</option>
                                            @foreach(config('marathon.packages') as $key => $package)
                                                <option value="{{ $key }}"
                                                        data-price="{{ $package['price'] }}">{{ $package['name'] }} -
                                                    K{{ $package['price'] }}</option>
                                            @endforeach
                                        </select>
                                        <div class="error-message text-red-500 text-sm mt-1 hidden"
                                             id="package-error"></div>
                                    </div>

                                    <div class="bg-gray-50 p-6 rounded-lg shadow-sm">
                                        <h4 class="font-medium text-gray-900 text-lg mb-3">Summary</h4>
                                        <div class="space-y-3">
                                            <div
                                                class="flex justify-between gap-3 items-center border-b border-gray-200 pb-2">
                                                <span class="text-gray-600">Package:</span>
                                                <span id="summary-package" class="font-medium">-</span>
                                            </div>
                                            <div class="flex justify-between gap-3 items-center pt-2">
                                                <span class="text-gray-800 font-medium">Total:</span>
                                                <span id="summary-total"
                                                      class="text-xl font-bold text-primary">K0.00</span>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="bg-gray-50 p-4 rounded-lg">
                                        <div class="flex items-start">
                                            <div class="flex items-center h-5 mt-1">
                                                <input id="terms" name="terms" type="checkbox"
                                                       class="focus:ring-primary h-5 w-5 text-primary border-gray-300 rounded"
                                                       required>
                                            </div>
                                            <div class="ml-3">
                                                <label for="terms" class="font-medium text-gray-700">I agree to the
                                                    terms and conditions</label>
                                                <p class="text-gray-500 mt-1">By registering, you agree to participate
                                                    at your own risk and confirm that you are medically fit to
                                                    participate in this event.</p>
                                            </div>
                                        </div>
                                        <div class="error-message text-red-500 text-sm mt-1 hidden"
                                             id="terms-error"></div>
                                    </div>
                                </div>
                            </div>

                            <div class="flex justify-between gap-3">
                                <button type="button"
                                        class="prev-step bg-gray-200 text-gray-700 px-6 py-3 rounded-full hover:bg-gray-300 focus:outline-none focus:ring-2 focus:ring-gray-400 focus:ring-opacity-50 shadow-md transform transition-transform hover:scale-105 flex items-center"
                                        data-step="2">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" viewBox="0 0 20 20"
                                         fill="currentColor">
                                        <path fill-rule="evenodd"
                                              d="M9.707 14.707a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 1.414L7.414 9H15a1 1 0 110 2H7.414l2.293 2.293a1 1 0 010 1.414z"
                                              clip-rule="evenodd"/>
                                    </svg>
                                    Previous Step
                                </button>
                                <button type="button" id="submit-form"
                                        class="bg-primary text-white px-6 py-3 rounded-full hover:bg-primary-dark focus:outline-none focus:ring-2 focus:ring-primary focus:ring-opacity-50 shadow-md transform transition-transform hover:scale-105 flex items-center">
                                    Complete Registration
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 ml-2" viewBox="0 0 20 20"
                                         fill="currentColor">
                                        <path fill-rule="evenodd"
                                              d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"
                                              clip-rule="evenodd"/>
                                    </svg>
                                </button>
                            </div>
                        </div>

                        <!-- Form submission status -->
                        <div id="form-status" class="mt-4 hidden">
                            <div id="loading-status"
                                 class="bg-blue-50 text-blue-700 p-4 rounded-lg flex items-center hidden">
                                <svg class="animate-spin -ml-1 mr-3 h-5 w-5 text-blue-700"
                                     xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                    <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor"
                                            stroke-width="4"></circle>
                                    <path class="opacity-75" fill="currentColor"
                                          d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                                </svg>
                                Processing your registration...
                            </div>
                            <div id="success-status" class="bg-green-50 text-green-700 p-4 rounded-lg hidden">
                                Registration successful! You will be redirected shortly.
                            </div>
                            <div id="error-status" class="bg-red-50 text-red-700 p-4 rounded-lg hidden">
                                There was an error processing your registration. Please try again.
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    @vite(['resources/js/register.js'])
@endsection
