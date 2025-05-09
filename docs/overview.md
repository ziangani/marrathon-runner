# LuWSI Runner Registration System - Implementation Guide

Based on the requirements for the LuWSI Run event registration system, I'll provide a comprehensive guide for implementation without overwhelming code details.

## 1. System Overview

We need to build a registration website for the LuWSI Run event that:
- Has an attractive design following the LuWSI branding (blue and navy color scheme)
- Captures runner information through a registration form
- Processes payments via TechPay integration
- Sends confirmation via SMS, email, and WhatsApp after successful payment
- Generates a custom race number/PDF for the participant
- Stores data in a backend managed through Filament admin panel

## 2. Design Guidelines

### Color Scheme
Based on the brochure, the primary colors are:
- Primary Blue: `#33A9E0` (LuWSI logo blue)
- Dark Blue/Navy: `#3D3F94` (darker blue used in branding)
- Secondary/Accent: `#FFFFFF` (white)
- Text: `#333333` (dark gray/nearly black)
- Background: `#F5F8FF` (light blue/off-white)

### Visual Elements
- Circular crop frames for images, following the brochure style
- Rounded corners on cards and buttons
- Water droplet icons and wave patterns consistent with water theme
- Clear call-to-action buttons with high contrast colors

## 3. System Architecture

### Frontend
- Laravel Blade templates with Tailwind CSS for styling
- Responsive design (mobile-first approach)

### Backend
- Laravel 12 framework
- MySQL database
- Filament admin panel for backend management
- TechPay payment gateway integration
- Communication services (SMS, Email, WhatsApp)

## 4. Page Structure

1. **Landing Page**
    - Hero section with LuWSI Run branding
    - Event information (date, time, location, purpose)
    - Event categories (21KM, 10KM, 5KM Run, 5KM Walk)
    - Registration pricing table
    - Call-to-Action button ("Register Now")
    - About section explaining water security in Zambia

2. **Registration Form**
    - Personal information
    - Emergency contact details
    - Race category selection
    - Package selection (with pricing)
    - Dynamic fields based on form configuration

3. **Payment Page**
    - Summary of registration details
    - TechPay payment processing
    - Loading state while payment processes

4. **Confirmation Page**
    - Success message
    - Registration details
    - Race number display
    - Option to download PDF
    - Share on social media options

## 5. Database Structure

### Key Tables
- `users` - Basic user authentication
- `registrations` - Runner registration details
- `payments` - Payment information and status
- `race_numbers` - Generated race numbers

## 6. Form Implementation

The registration form will be built dynamically based on the provided JSON configuration. Fields include:

- Age (select)
- Gender (select)
- Emergency contact information (text/number)
- T-shirt size (select)
- Race category (select)
- Health condition (select with conditional field)
- How the participant heard about the event (select)
- Package selection (select with pricing)
- Exhibition interest (select)

## 7. Payment Flow

1. User completes registration form
2. System calculates fee based on selected package
3. User is redirected to TechPay payment page
4. TechPay processes payment and redirects back to our system
5. Our system verifies payment status via TechPay API
6. Upon successful payment, system triggers confirmations

## 8. Confirmation Process

After successful payment:
1. Generate unique race number
2. Create PDF certificate/race card with runner details
3. Send confirmation email with PDF attachment
4. Send SMS confirmation with download link
5. Send WhatsApp message with confirmation details
6. Update database with completed registration status

## 9. Admin Interface (Filament)

Key features:
- Dashboard with registration statistics
- Runner management
- Payment tracking
- Export functionality for race day logistics
- Communication management (send group messages)

## 10. Implementation Steps

1. **Project Setup**
    - Create Laravel 12 project
    - Install dependencies (Tailwind CSS, Filament, etc.)
    - Configure environment

2. **Frontend Development**
    - Create responsive page templates
    - Implement Tailwind styling based on LuWSI branding
    - Build dynamic form with validation

3. **Backend Development**
    - Create database migrations
    - Set up Filament admin panel
    - Implement form processing logic
    - Configure TechPay integration

4. **Payment Integration**
    - Set up TechPay API connection
    - Implement payment processing
    - Handle webhooks for payment status updates

5. **Confirmation System**
    - Create PDF generation service
    - Set up email, SMS, and WhatsApp sending
    - Design attractive race number template

6. **Testing**
    - Test payment flows
    - Test form validation
    - Test confirmation delivery
    - Perform mobile responsiveness testing

7. **Deployment**
    - Set up production environment
    - Configure proper security measures
    - Set up monitoring for the system

## 11. Key Technical Components

### TechPay Integration
```php
// Example of payment initiation (conceptual)
public function initiatePayment($registration)
{
    $amount = $registration->package_amount;
    
    // Create payment request to TechPay
    $response = TechPay::createPayment([
        'amount' => $amount,
        'reference' => $registration->reference,
        'redirect_url' => route('payment.callback'),
        // Other required parameters
    ]);
    
    // Redirect to TechPay checkout
    return redirect($response['payment_url']);
}
```

### Confirmation Generation
```php
// Example of PDF generation approach (conceptual)
public function generateRaceCard($registration)
{
    $pdf = PDF::loadView('pdf.race-card', [
        'runner' => $registration,
        'race_number' => $registration->race_number,
        'event_details' => $this->eventDetails,
    ]);
    
    $path = storage_path("app/race-cards/{$registration->reference}.pdf");
    $pdf->save($path);
    
    return $path;
}
```

## 12. Communication Services

We'll need to implement or integrate services for:
- **Email**: Laravel's built-in mail system with a provider like Mailgun
- **SMS**: Integration with a local SMS provider for Zambia
- **WhatsApp**: Business API integration for automated messages

## 13. Conclusion

This implementation approach delivers a beautifully designed registration system for the LuWSI Run that meets all the specified requirements. The system follows Laravel and Tailwind CSS best practices while providing a seamless user experience from registration through payment confirmation.

The admin panel powered by Filament will give organizers easy access to manage registrations, track payments, and coordinate event logistics.

Remember to deploy the system with proper security measures and monitor the payment integration carefully to ensure a smooth registration process for all participants.
## 12. Communication Services

We'll need to implement or integrate services for:
- **Email**: Laravel's built-in mail system with a provider like Mailgun
- **SMS**: Integration with a local SMS provider for Zambia
- **WhatsApp**: Business API integration for automated messages

## 13. Conclusion

This implementation approach delivers a beautifully designed registration system for the LuWSI Run that meets all the specified requirements. The system follows Laravel and Tailwind CSS best practices while providing a seamless user experience from registration through payment confirmation.

The admin panel powered by Filament will give organizers easy access to manage registrations, track payments, and coordinate event logistics.

Remember to deploy the system with proper security measures and monitor the payment integration carefully to ensure a smooth registration process for all participants.
