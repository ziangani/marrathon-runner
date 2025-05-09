@extends('layouts.app')

@section('title', 'Register')

@section('content')
    <div class="bg-background py-12">
        <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="bg-white shadow-xl rounded-lg overflow-hidden">
                <!-- Registration Header -->
                <div class="bg-primary px-6 py-4">
                    <h2 class="text-2xl font-bold text-white">
                        Register for {{ config('marathon.name') }}
                    </h2>
                    <p class="text-white opacity-80">
                        Complete the form below to register for the event
                    </p>
                </div>

                <!-- Multi-step Form -->
                <div class="p-6">
                    <!-- Progress Steps -->
                    <div class="mb-8">
                        <div class="flex items-center justify-between">
                            <div class="step step-1 flex flex-col items-center">
                                <div class="w-10 h-10 rounded-full bg-primary text-white flex items-center justify-center font-bold text-lg step-active">
                                    1
                                </div>
                                <div class="text-sm mt-2">Personal Info</div>
                            </div>
                            <div class="flex-1 h-1 bg-gray-200 mx-2">
                                <div class="h-full bg-primary step-progress-1" style="width: 0%"></div>
                            </div>
                            <div class="step step-2 flex flex-col items-center">
                                <div class="w-10 h-10 rounded-full bg-gray-200 text-gray-600 flex items-center justify-center font-bold text-lg">
                                    2
                                </div>
                                <div class="text-sm mt-2">Race Details</div>
                            </div>
                            <div class="flex-1 h-1 bg-gray-200 mx-2">
                                <div class="h-full bg-primary step-progress-2" style="width: 0%"></div>
                            </div>
                            <div class="step step-3 flex flex-col items-center">
                                <div class="w-10 h-10 rounded-full bg-gray-200 text-gray-600 flex items-center justify-center font-bold text-lg">
                                    3
                                </div>
                                <div class="text-sm mt-2">Additional Info</div>
                            </div>
                            <div class="flex-1 h-1 bg-gray-200 mx-2">
                                <div class="h-full bg-primary step-progress-3" style="width: 0%"></div>
                            </div>
                            <div class="step step-4 flex flex-col items-center">
                                <div class="w-10 h-10 rounded-full bg-gray-200 text-gray-600 flex items-center justify-center font-bold text-lg">
                                    4
                                </div>
                                <div class="text-sm mt-2">Package</div>
                            </div>
                        </div>
                    </div>

                    <form id="registration-form" action="{{ route('register.store') }}" method="POST">
                        @csrf
                        
                        <!-- Step 1: Personal Information -->
                        <div class="step-content step-content-1">
                            <div class="mb-6">
                                <h3 class="text-lg font-medium text-gray-900 mb-4">Personal Information</h3>
                                
                                <div class="grid grid-cols-1 gap-6">
                                    <div>
                                        <label for="name" class="block text-sm font-medium text-gray-700">Full Name</label>
                                        <input type="text" name="name" id="name" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-primary focus:ring focus:ring-primary focus:ring-opacity-50" required>
                                    </div>
                                    
                                    <div>
                                        <label for="email" class="block text-sm font-medium text-gray-700">Email Address</label>
                                        <input type="email" name="email" id="email" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-primary focus:ring focus:ring-primary focus:ring-opacity-50" required>
                                    </div>
                                    
                                    <div>
                                        <label for="phone" class="block text-sm font-medium text-gray-700">Phone Number</label>
                                        <input type="tel" name="phone" id="phone" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-primary focus:ring focus:ring-primary focus:ring-opacity-50" required>
                                    </div>
                                    
                                    <div>
                                        <label for="age" class="block text-sm font-medium text-gray-700">Age Group</label>
                                        <select name="age" id="age" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-primary focus:ring focus:ring-primary focus:ring-opacity-50" required>
                                            <option value="">Select Age Group</option>
                                            <option value="below 20 years">Below 20 years</option>
                                            <option value="21 to 30 years">21 to 30 years</option>
                                            <option value="31 to 40 years">31 to 40 years</option>
                                            <option value="41 to 50 years">41 to 50 years</option>
                                            <option value="51 years and above">51 years and above</option>
                                        </select>
                                    </div>
                                    
                                    <div>
                                        <label for="gender" class="block text-sm font-medium text-gray-700">Gender</label>
                                        <select name="gender" id="gender" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-primary focus:ring focus:ring-primary focus:ring-opacity-50" required>
                                            <option value="">Select Gender</option>
                                            <option value="Male">Male</option>
                                            <option value="Female">Female</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="flex justify-end">
                                <button type="button" class="next-step bg-primary text-white px-4 py-2 rounded-md hover:bg-primary-dark focus:outline-none focus:ring-2 focus:ring-primary focus:ring-opacity-50" data-step="1">
                                    Next Step
                                </button>
                            </div>
                        </div>
                        
                        <!-- Step 2: Race Details -->
                        <div class="step-content step-content-2 hidden">
                            <div class="mb-6">
                                <h3 class="text-lg font-medium text-gray-900 mb-4">Race Details</h3>
                                
                                <div class="grid grid-cols-1 gap-6">
                                    <div>
                                        <label for="t_shirt_size" class="block text-sm font-medium text-gray-700">T-Shirt Size</label>
                                        <select name="t_shirt_size" id="t_shirt_size" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-primary focus:ring focus:ring-primary focus:ring-opacity-50" required>
                                            <option value="">Select T-Shirt Size</option>
                                            <option value="XS">XS</option>
                                            <option value="S">S</option>
                                            <option value="M">M</option>
                                            <option value="L">L</option>
                                            <option value="XL">XL</option>
                                            <option value="XXL">XXL</option>
                                            <option value="XXXL">XXXL</option>
                                        </select>
                                    </div>
                                    
                                    <div>
                                        <label for="race_category" class="block text-sm font-medium text-gray-700">Race Category</label>
                                        <select name="race_category" id="race_category" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-primary focus:ring focus:ring-primary focus:ring-opacity-50" required>
                                            <option value="">Select Race Category</option>
                                            @foreach(config('marathon.categories') as $key => $category)
                                                <option value="{{ $category['name'] }}">{{ $category['name'] }} - {{ $category['description'] }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    
                                    <div>
                                        <label for="health_condition" class="block text-sm font-medium text-gray-700">Do you have any health condition?</label>
                                        <select name="health_condition" id="health_condition" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-primary focus:ring focus:ring-primary focus:ring-opacity-50" required>
                                            <option value="">Select Option</option>
                                            <option value="Yes">Yes</option>
                                            <option value="No">No</option>
                                        </select>
                                    </div>
                                    
                                    <div id="health_condition_specify_container" class="hidden">
                                        <label for="health_condition_specify" class="block text-sm font-medium text-gray-700">Please specify your health condition</label>
                                        <input type="text" name="health_condition_specify" id="health_condition_specify" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-primary focus:ring focus:ring-primary focus:ring-opacity-50">
                                    </div>
                                </div>
                            </div>
                            
                            <div class="flex justify-between">
                                <button type="button" class="prev-step bg-gray-200 text-gray-700 px-4 py-2 rounded-md hover:bg-gray-300 focus:outline-none focus:ring-2 focus:ring-gray-400 focus:ring-opacity-50" data-step="2">
                                    Previous Step
                                </button>
                                <button type="button" class="next-step bg-primary text-white px-4 py-2 rounded-md hover:bg-primary-dark focus:outline-none focus:ring-2 focus:ring-primary focus:ring-opacity-50" data-step="2">
                                    Next Step
                                </button>
                            </div>
                        </div>
                        
                        <!-- Step 3: Additional Information -->
                        <div class="step-content step-content-3 hidden">
                            <div class="mb-6">
                                <h3 class="text-lg font-medium text-gray-900 mb-4">Additional Information</h3>
                                
                                <div class="grid grid-cols-1 gap-6">
                                    <div>
                                        <label for="emergency_contact_name" class="block text-sm font-medium text-gray-700">Emergency Contact Name</label>
                                        <input type="text" name="emergency_contact_name" id="emergency_contact_name" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-primary focus:ring focus:ring-primary focus:ring-opacity-50" required>
                                    </div>
                                    
                                    <div>
                                        <label for="emergency_contact_phone" class="block text-sm font-medium text-gray-700">Emergency Contact Phone</label>
                                        <input type="tel" name="emergency_contact_phone" id="emergency_contact_phone" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-primary focus:ring focus:ring-primary focus:ring-opacity-50" required>
                                    </div>
                                    
                                    <div>
                                        <label for="how_did_you_hear_about_us" class="block text-sm font-medium text-gray-700">How did you hear about us?</label>
                                        <select name="how_did_you_hear_about_us" id="how_did_you_hear_about_us" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-primary focus:ring focus:ring-primary focus:ring-opacity-50" required>
                                            <option value="">Select Option</option>
                                            <option value="Facebook">Facebook</option>
                                            <option value="Whatsapp">Whatsapp</option>
                                            <option value="Email">Email</option>
                                            <option value="LinkedIn">LinkedIn</option>
                                            <option value="Website">Website</option>
                                            <option value="A friend/workmate/ family member">A friend/workmate/ family member</option>
                                        </select>
                                    </div>
                                    
                                    <div>
                                        <label for="exhibiting" class="block text-sm font-medium text-gray-700">Are you exhibiting?</label>
                                        <select name="exhibiting" id="exhibiting" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-primary focus:ring focus:ring-primary focus:ring-opacity-50" required>
                                            <option value="">Select Option</option>
                                            <option value="Yes">Yes</option>
                                            <option value="No">No</option>
                                            <option value="Maybe">Maybe</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="flex justify-between">
                                <button type="button" class="prev-step bg-gray-200 text-gray-700 px-4 py-2 rounded-md hover:bg-gray-300 focus:outline-none focus:ring-2 focus:ring-gray-400 focus:ring-opacity-50" data-step="3">
                                    Previous Step
                                </button>
                                <button type="button" class="next-step bg-primary text-white px-4 py-2 rounded-md hover:bg-primary-dark focus:outline-none focus:ring-2 focus:ring-primary focus:ring-opacity-50" data-step="3">
                                    Next Step
                                </button>
                            </div>
                        </div>
                        
                        <!-- Step 4: Package Selection -->
                        <div class="step-content step-content-4 hidden">
                            <div class="mb-6">
                                <h3 class="text-lg font-medium text-gray-900 mb-4">Package Selection</h3>
                                
                                <div class="grid grid-cols-1 gap-6">
                                    <div>
                                        <label for="package" class="block text-sm font-medium text-gray-700">Select Package</label>
                                        <select name="package" id="package" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-primary focus:ring focus:ring-primary focus:ring-opacity-50" required>
                                            <option value="">Select Package</option>
                                            @foreach(config('marathon.packages') as $key => $package)
                                                <option value="{{ $key }}" data-price="{{ $package['price'] }}">{{ $package['name'] }} - K{{ $package['price'] }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    
                                    <div class="bg-gray-50 p-4 rounded-md">
                                        <h4 class="font-medium text-gray-900">Summary</h4>
                                        <div class="mt-2 space-y-2">
                                            <div class="flex justify-between">
                                                <span>Package:</span>
                                                <span id="summary-package">-</span>
                                            </div>
                                            <div class="flex justify-between font-bold">
                                                <span>Total:</span>
                                                <span id="summary-total">K0.00</span>
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <div>
                                        <div class="flex items-start">
                                            <div class="flex items-center h-5">
                                                <input id="terms" name="terms" type="checkbox" class="focus:ring-primary h-4 w-4 text-primary border-gray-300 rounded" required>
                                            </div>
                                            <div class="ml-3 text-sm">
                                                <label for="terms" class="font-medium text-gray-700">I agree to the terms and conditions</label>
                                                <p class="text-gray-500">By registering, you agree to participate at your own risk and confirm that you are medically fit to participate in this event.</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="flex justify-between">
                                <button type="button" class="prev-step bg-gray-200 text-gray-700 px-4 py-2 rounded-md hover:bg-gray-300 focus:outline-none focus:ring-2 focus:ring-gray-400 focus:ring-opacity-50" data-step="4">
                                    Previous Step
                                </button>
                                <button type="submit" class="bg-primary text-white px-4 py-2 rounded-md hover:bg-primary-dark focus:outline-none focus:ring-2 focus:ring-primary focus:ring-opacity-50">
                                    Complete Registration
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Multi-step form navigation
            const nextButtons = document.querySelectorAll('.next-step');
            const prevButtons = document.querySelectorAll('.prev-step');
            
            nextButtons.forEach(button => {
                button.addEventListener('click', function() {
                    const currentStep = parseInt(this.getAttribute('data-step'));
                    const nextStep = currentStep + 1;
                    
                    // Validate current step
                    if (validateStep(currentStep)) {
                        // Hide current step
                        document.querySelector(`.step-content-${currentStep}`).classList.add('hidden');
                        
                        // Show next step
                        document.querySelector(`.step-content-${nextStep}`).classList.remove('hidden');
                        
                        // Update progress
                        updateProgress(nextStep);
                    }
                });
            });
            
            prevButtons.forEach(button => {
                button.addEventListener('click', function() {
                    const currentStep = parseInt(this.getAttribute('data-step'));
                    const prevStep = currentStep - 1;
                    
                    // Hide current step
                    document.querySelector(`.step-content-${currentStep}`).classList.add('hidden');
                    
                    // Show previous step
                    document.querySelector(`.step-content-${prevStep}`).classList.remove('hidden');
                    
                    // Update progress
                    updateProgress(prevStep);
                });
            });
            
            // Health condition toggle
            const healthConditionSelect = document.getElementById('health_condition');
            const healthConditionSpecifyContainer = document.getElementById('health_condition_specify_container');
            
            healthConditionSelect.addEventListener('change', function() {
                if (this.value === 'Yes') {
                    healthConditionSpecifyContainer.classList.remove('hidden');
                    document.getElementById('health_condition_specify').setAttribute('required', 'required');
                } else {
                    healthConditionSpecifyContainer.classList.add('hidden');
                    document.getElementById('health_condition_specify').removeAttribute('required');
                }
            });
            
            // Package selection and summary update
            const packageSelect = document.getElementById('package');
            const summaryPackage = document.getElementById('summary-package');
            const summaryTotal = document.getElementById('summary-total');
            
            packageSelect.addEventListener('change', function() {
                const selectedOption = this.options[this.selectedIndex];
                if (selectedOption.value) {
                    summaryPackage.textContent = selectedOption.text;
                    const price = selectedOption.getAttribute('data-price');
                    summaryTotal.textContent = `K${price}`;
                } else {
                    summaryPackage.textContent = '-';
                    summaryTotal.textContent = 'K0.00';
                }
            });
            
            // Initialize with selected package if provided in URL
            const urlParams = new URLSearchParams(window.location.search);
            const packageParam = urlParams.get('package');
            if (packageParam) {
                const packageOption = packageSelect.querySelector(`option[value="${packageParam}"]`);
                if (packageOption) {
                    packageOption.selected = true;
                    // Trigger change event to update summary
                    const event = new Event('change');
                    packageSelect.dispatchEvent(event);
                }
            }
            
            // Form validation functions
            function validateStep(step) {
                const stepContent = document.querySelector(`.step-content-${step}`);
                const requiredFields = stepContent.querySelectorAll('[required]');
                let isValid = true;
                
                requiredFields.forEach(field => {
                    if (!field.value) {
                        isValid = false;
                        field.classList.add('border-red-500');
                        
                        // Add error message if it doesn't exist
                        const errorId = `${field.id}-error`;
                        if (!document.getElementById(errorId)) {
                            const errorElement = document.createElement('p');
                            errorElement.id = errorId;
                            errorElement.className = 'mt-1 text-sm text-red-600';
                            errorElement.textContent = 'This field is required';
                            field.parentNode.appendChild(errorElement);
                        }
                    } else {
                        field.classList.remove('border-red-500');
                        
                        // Remove error message if it exists
                        const errorElement = document.getElementById(`${field.id}-error`);
                        if (errorElement) {
                            errorElement.remove();
                        }
                    }
                });
                
                return isValid;
            }
            
            function updateProgress(step) {
                // Update step indicators
                document.querySelectorAll('.step').forEach((stepElement, index) => {
                    const stepNumber = index + 1;
                    const stepCircle = stepElement.querySelector('div:first-child');
                    
                    if (stepNumber < step) {
                        // Completed step
                        stepCircle.classList.remove('bg-gray-200', 'text-gray-600');
                        stepCircle.classList.add('bg-green-500', 'text-white');
                        // Add check icon
                        stepCircle.innerHTML = '<svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>';
                    } else if (stepNumber === step) {
                        // Current step
                        stepCircle.classList.remove('bg-gray-200', 'text-gray-600', 'bg-green-500');
                        stepCircle.classList.add('bg-primary', 'text-white');
                        stepCircle.innerHTML = stepNumber;
                    } else {
                        // Future step
                        stepCircle.classList.remove('bg-primary', 'text-white', 'bg-green-500');
                        stepCircle.classList.add('bg-gray-200', 'text-gray-600');
                        stepCircle.innerHTML = stepNumber;
                    }
                });
                
                // Update progress bars
                for (let i = 1; i < 4; i++) {
                    const progressBar = document.querySelector(`.step-progress-${i}`);
                    if (i < step) {
                        progressBar.style.width = '100%';
                    } else if (i === step - 1) {
                        progressBar.style.width = '50%';
                    } else {
                        progressBar.style.width = '0%';
                    }
                }
            }
        });
    </script>
@endsection
