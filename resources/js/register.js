document.addEventListener('DOMContentLoaded', function() {
    // Multi-step form navigation
    const nextButtons = document.querySelectorAll('.next-step');
    const prevButtons = document.querySelectorAll('.prev-step');
    const submitButton = document.getElementById('submit-form');
    const form = document.getElementById('registration-form');
    const formStatus = document.getElementById('form-status');
    const loadingStatus = document.getElementById('loading-status');
    const successStatus = document.getElementById('success-status');
    const errorStatus = document.getElementById('error-status');

    // Next step buttons
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

                // Scroll to top of form
                document.querySelector('.bg-white.shadow-2xl.rounded-3xl').scrollIntoView({ behavior: 'smooth' });
            }
        });
    });

    // Previous step buttons
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

            // Scroll to top of form
            document.querySelector('.bg-white.shadow-2xl.rounded-3xl').scrollIntoView({ behavior: 'smooth' });
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

                // Show error message
                const errorElement = document.getElementById(`${field.id}-error`);
                if (errorElement) {
                    errorElement.textContent = 'This field is required';
                    errorElement.classList.remove('hidden');
                }
            } else {
                field.classList.remove('border-red-500');

                // Hide error message
                const errorElement = document.getElementById(`${field.id}-error`);
                if (errorElement) {
                    errorElement.classList.add('hidden');
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
            const stepText = stepElement.querySelector('div:last-child');

            if (stepNumber < step) {
                // Completed step
                stepCircle.classList.remove('bg-gray-200', 'text-gray-600');
                stepCircle.classList.add('bg-green-500', 'text-white');
                stepText.classList.remove('text-gray-500');
                stepText.classList.add('text-gray-700');
                // Add check icon
                stepCircle.innerHTML = '<svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>';
            } else if (stepNumber === step) {
                // Current step
                stepCircle.classList.remove('bg-gray-200', 'text-gray-600', 'bg-green-500');
                stepCircle.classList.add('bg-primary', 'text-white');
                stepText.classList.remove('text-gray-500');
                stepText.classList.add('text-gray-700');
                stepCircle.innerHTML = stepNumber;
            } else {
                // Future step
                stepCircle.classList.remove('bg-primary', 'text-white', 'bg-green-500');
                stepCircle.classList.add('bg-gray-200', 'text-gray-600');
                stepText.classList.remove('text-gray-700');
                stepText.classList.add('text-gray-500');
                stepCircle.innerHTML = stepNumber;
            }
        });

        // Update progress bar
        const progressBar = document.querySelector('.step-progress-1');
        if (step === 1) {
            progressBar.style.width = '0%';
        } else if (step === 2) {
            progressBar.style.width = '100%';
        }
    }

    // AJAX form submission
    submitButton.addEventListener('click', function(e) {
        e.preventDefault();

        // Validate final step
        if (!validateStep(2)) {
            return;
        }

        // Show loading status
        formStatus.classList.remove('hidden');
        loadingStatus.classList.remove('hidden');
        successStatus.classList.add('hidden');
        errorStatus.classList.add('hidden');

        // Disable submit button
        submitButton.disabled = true;
        submitButton.classList.add('opacity-75', 'cursor-not-allowed');

        // Get form data
        const formData = new FormData(form);

        // Send AJAX request
        fetch(form.action, {
            method: 'POST',
            body: formData,
            headers: {
                'X-Requested-With': 'XMLHttpRequest'
            }
        })
            .then(response => {
                if (!response.ok) {
                    throw new Error('Network response was not ok');
                }
                return response.json();
            })
            .then(data => {
                // Hide loading status
                loadingStatus.classList.add('hidden');

                // Show success message
                successStatus.classList.remove('hidden');

                // Redirect to confirmation page after a delay
                setTimeout(() => {
                    window.location.href = data.redirect || '/confirmation';
                }, 2000);
            })
            .catch(error => {
                console.error('Error:', error);

                // Hide loading status
                loadingStatus.classList.add('hidden');

                // Show error message
                errorStatus.classList.remove('hidden');

                // Re-enable submit button
                submitButton.disabled = false;
                submitButton.classList.remove('opacity-75', 'cursor-not-allowed');
            });
    });
});
