
## Laravel Development Standards and Best Practices (AI-Coding Agent Enhanced)

### 1. **General Philosophy**

-   Maintain modular, extensible, and testable code to support automation.
    
-   Every function should be documented with input/output types and exception cases.
    
-   Adhere to Laravel conventions unless explicitly overridden (and documented).
    
-   Use service classes and repositories for business logic abstraction.
    
-   Implement interfaces for key services to allow mocking by AI agents.
    

----------

### 2. **Controllers**

-   Controllers should be thin. Only coordinate request/response.
    
-   Always inject FormRequest and Service classes via constructor.
    
-   Example:
    
    ```php
    public function __construct(private UserService $service) {}
    public function store(UserStoreRequest $request) {
        return response()->json($this->service->store($request->validated()));
    }
    
    ```
    
-   Return consistent JSON structure: `{ success: true|false, data: [], message: '' }`
    
-   Use Laravel's `response()->json()` helper with status codes.
    
-   Register all exceptions thrown per controller for AI agent reference.
    

----------

### 3. **Middleware**

-   Use descriptive names (`EnsureRoleIsAdmin`, `CheckRequestSignature`).
    
-   Include all middleware logic in `handle()` method; avoid closure middleware unless performance-critical.
    
-   Document middleware chain for every route group.
    

----------

### 4. **Routing**

-   Standardize route names using dot notation: `module.action` (e.g. `users.index`).
    
-   Annotate routes with purpose metadata for AI reference.
    
-   Group by modules and prefix using versioning (`/api/v1/users`).
    
-   Always define route parameters in camelCase.
    

----------

### 5. **Models and Migrations**

-   Define casts, hidden, and fillable properties explicitly.
    
-   All models should implement a `BaseModel` contract for metadata introspection.
    
-   Foreign keys must use snake_case and cascade rules must be clearly documented.
    
-   Include field descriptions as comments in migrations.
    

----------

### 6. **Eloquent Relationships**

-   Use the `with()` or `load()` methods instead of lazy loading.
    
-   Relationship functions must follow naming conventions:
    
    -   hasOne: `profile()`
        
    -   hasMany: `transactions()`
        
    -   belongsTo: `user()`
        
    -   belongsToMany: `roles()`
        
-   Document inverse relationships.
    

----------

### 7. **Views and Design**

-   Layouts must follow `resources/views/layouts` structure with `app.blade.php`, `admin.blade.php`, etc.
    
-   Components should live in `resources/views/components`, with Livewire or Blade components documented.
    
-   Always include ARIA labels for accessibility automation.
    
-   CSS should use Tailwind utility-first approach with responsive prefixes (`sm:`, `md:`, etc).
    

----------

### 8. **Forms and Validation**

-   Validation handled exclusively by FormRequest classes.
    
-   Annotate rules with expected inputs and validation rationale.
    
-   AJAX submissions should return:
    
    ```json
    { "status": "error", "errors": { "field": ["message"] } }
    
    ```
    
-   Always include a `uniqueRequestId` for tracking.
    

----------

### 9. **Authentication and Authorization**

-   Always access user using `\Auth::user()`.
    
-   Auth routes and flows must document:
    
    -   Input fields
        
    -   Token policies
        
    -   Rate limits
        
-   Role and permission-based access controlled using `spatie/laravel-permission`.
    
-   Protect all APIs with sanctum or passport.
    

----------

### 10. **Logging**

-   Use helper: `logCustom($level, $message, $context = [])`
    
-   Log structure:
    
    ```json
    {
      "level": "error",
      "context": "PaymentController@store",
      "payload": {},
      "exception": {
        "message": "...",
        "trace": [...]
      }
    }
    
    ```
    
-   All jobs, API requests, and payment integrations must log requests/responses.
    

----------

### 11. **FilamentPHP Dashboard**

-   Custom Resources must include:
    
    -   Fields with placeholders, help texts
        
    -   Tables with filters, searchable fields, and bulk actions
        
    -   Access policies per panel
        
-   Use UUIDs as resource identifiers, not auto-increment IDs.
    
-   Integrate widgets that expose analytics endpoints for AI feedback.
    

----------

### 12. **Console Commands & Jobs**

-   Use `progress()->advance()` and `withProgressBar()`.
    
-   Jobs should be idempotent and retriable.
    
-   Always capture job status and logs in a dedicated table with timestamps.
    
-   Define and document job dependencies and queue groups.
    

----------

### 13. **Emails & Notifications**

-   Blade templates stored in `resources/views/emails/`
    
-   Subject lines should use dynamic config strings.
    
-   Support for queuing via `Notification::route(...)->notify(...)`
    
-   Store logs in `notifications_log` table with:
    
    -   recipient
        
    -   payload
        
    -   sent_at
        
    -   delivery_status
        

----------

### 14. **Configuration and Seeding**

-   Configs should be in `config/` with ENV fallbacks.
    
-   Seeders must use `firstOrCreate` to avoid duplicates.
    
-   Include metadata per record: `created_by`, `source`, `import_id`
    

----------

### 15. **Front-End Web Portal**

-   Landing page must include:
    
    -   Hero (title, subtitle, CTA)
        
    -   Features grid (icons, text)
        
    -   Testimonials (carousel)
        
    -   Pricing if applicable
        
    -   Footer with sitemap and contact info
        
-   Mobile responsiveness required.
    
-   All UI components should have consistent class usage and namespacing.
    

----------

### 16. **Security**

-   All sensitive data encrypted using Laravel’s crypt helper.
    
-   All user inputs sanitized with HTMLPurifier or similar.
    
-   Use `rateLimiter()` for login, registration, and verification endpoints.
    
-   Rotate JWT or session tokens after login.
    

----------

### 17. **Reporting and Filters**

-   All filterable tables must implement:
    
    -   Global search
        
    -   Column filters
        
    -   Export to Excel/CSV
        
    -   API endpoint reference for AI
        
-   Filter parameters must be documented and optionally typed (int, date, bool).
    

----------

### 18. **Billing and Accounting**

-   Every financial transaction must generate:
    
    -   A ledger entry (debit, credit)
        
    -   A reference to initiating entity
        
    -   An audit trail
        
-   Use double-entry ledger:
    
    ```php
    Ledger::create([ 'entity_id' => 123, 'debit' => 500, 'credit' => 0, ... ])
    
    ```
    

----------

### 19. **Helper Functions**

-   All helpers live in `app/Helpers/functions.php` or as classes.
    
-   Autoload via `composer.json`.
    
-   Common helpers:
    
    -   `formatCurrency($amount, $currency)`
        
    -   `generateRef($prefix)`
        
    -   `logCustom($level, $message)`
        
-   Functions must be pure and testable.
    

----------

### 20. **Best Practices for AI Integration**

-   Every function, model, controller, and job must include a PHPDoc block.
    
-   All database schemas should be introspectable via a single command or schema dump.
    
-   Define a `/.ai/config.json` with all environment flags AI might require (e.g., API endpoints, queues, timeouts).
    
-   All exceptions and jobs should use standard error codes.
    

----------

This specification is optimized for AI systems and automation agents interacting with Laravel. All modules must comply with structured data expectations and well-documented APIs.
