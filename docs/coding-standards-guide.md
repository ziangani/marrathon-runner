# Laravel 12 Coding Standards Guide

This document outlines the coding standards to be followed when developing our Laravel 12 application. These standards ensure consistency, readability, and maintainability across the codebase.

## 1. General Principles

### 1.1 Code Readability
- Write clean, self-documenting code
- Prioritize readability over clever solutions
- Use meaningful names for variables, methods, and classes
- Follow PSR-12 coding style

### 1.2 File Organization
- One class per file
- Group related functionality in namespaces
- Follow Laravel's directory structure
- Maximum file size of 500 lines (soft limit)

### 1.3 Enforcement
- Use Laravel Pint for code style enforcement
- Configure Pint to follow PSR-12 standards
- Run Pint before committing code

## 2. PHP Coding Standards

### 2.1 Naming Conventions

#### 2.1.1 Classes
- Use `PascalCase` for class names
- Use full, descriptive nouns
- Singular form for models (e.g., `User`, not `Users`)
- Suffix controllers with `Controller` (e.g., `UserController`)
- Suffix middleware with `Middleware` (e.g., `AuthMiddleware`)
- Suffix services with `Service` (e.g., `ReportService`)

```php
// Good
class UserController extends Controller
{
    // Implementation
}

// Bad
class users_controller extends Controller
{
    // Implementation
}
```

#### 2.1.2 Methods and Functions
- Use `camelCase` for method and function names
- Start with a verb that describes the action
- Choose descriptive names that indicate purpose

```php
// Good
public function fetchUserProfile($userId)
{
    // Implementation
}

// Bad
public function x($y)
{
    // Implementation
}
```

#### 2.1.3 Variables
- Use `camelCase` for variable names
- Choose descriptive names
- Avoid abbreviations unless widely understood
- Boolean variables should be prefixed with `is`, `has`, `can`, etc.

```php
// Good
$userProfile = User::find($userId);
$isActive = $user->status === 'active';

// Bad
$up = User::find($id);
$s = $user->status === 'active';
```

#### 2.1.4 Constants
- Use `UPPER_SNAKE_CASE` for constants
- Descriptive names that indicate purpose

```php
// Good
const MAX_LOGIN_ATTEMPTS = 5;

// Bad
const MLT = 5;
```

#### 2.1.5 Database Tables and Columns
- Use `snake_case` for table and column names
- Plural form for table names (e.g., `users`, not `user`)
- Use foreign key naming pattern: `singular_table_name_id` (e.g., `user_id`)

### 2.2 Code Structure

#### 2.2.1 Class Structure
- Organize class elements in the following order:
  1. Constants
  2. Properties
  3. Constructor
  4. Public methods
  5. Protected methods
  6. Private methods
- Group related methods together

```php
class User extends Model
{
    // 1. Constants
    const STATUS_ACTIVE = 'active';
    const STATUS_INACTIVE = 'inactive';
    
    // 2. Properties
    protected $fillable = ['name', 'email'];
    
    // 3. Constructor (if needed)
    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);
        // Additional initialization
    }
    
    // 4. Public methods
    public function profile()
    {
        return $this->hasOne(Profile::class);
    }
    
    // 5. Protected methods
    protected function validateData($data)
    {
        // Implementation
    }
    
    // 6. Private methods
    private function formatData($data)
    {
        // Implementation
    }
}
```

#### 2.2.2 Method Structure
- Keep methods focused on a single responsibility
- Aim for methods shorter than 20 lines (soft limit)
- Extract complex operations into separate methods
- Use early returns to reduce nesting

```php
// Good
public function createUser(array $data)
{
    if (!$this->isValidEmail($data['email'])) {
        return null;
    }
    
    return User::create([
        'name' => $data['name'],
        'email' => $data['email'],
        'password' => Hash::make($data['password']),
    ]);
}

// Bad
public function createUser(array $data)
{
    if ($this->isValidEmail($data['email'])) {
        // Deeply nested code with multiple responsibilities
        if ($this->checkName($data['name'])) {
            // More nesting
            if ($this->checkPassword($data['password'])) {
                // Even more nesting
                // Many lines of code performing different tasks
            }
        }
    }
    return null;
}
```

### 2.3 Documentation

#### 2.3.1 Class Documentation
- Document all classes with PHPDoc blocks
- Include description of class purpose
- List author and any relevant URLs
- Document complex implementation details or design decisions

```php
/**
 * Handles user authentication and management operations.
 * 
 * This class is responsible for user login, logout, and registration.
 * It also handles password reset functionality.
 * 
 * @package App\Services
 */
class AuthService
{
    // Implementation
}
```

#### 2.3.2 Method Documentation
- Document public methods with PHPDoc blocks
- Include parameter and return types
- Describe method purpose and behavior
- Document exceptions that may be thrown

```php
/**
 * Authenticates a user with the provided credentials.
 * 
 * @param string $email User's email address
 * @param string $password User's password
 * @param bool $remember Whether to remember the user
 * @return \App\Models\User|null The authenticated user or null if authentication fails
 * @throws \App\Exceptions\AccountLockedException If account is locked due to too many attempts
 */
public function authenticate(string $email, string $password, bool $remember = false): ?User
{
    // Implementation
}
```

### 2.4 Control Structures

#### 2.4.1 Conditional Statements
- Use spaces around operators
- Use parentheses to clarify complex conditions
- Curly braces on their own line

```php
// Good
if ($user->isAdmin() && ($user->isActive() || $user->isOwner())) {
    // Implementation
}

// Bad
if($user->isAdmin()&&$user->isActive()||$user->isOwner()){
    // Implementation
}
```

#### 2.4.2 Switch Statements
- Case statements indented from switch
- Break statements aligned with case code
- Default case always included, even if empty

```php
switch ($status) {
    case User::STATUS_ACTIVE:
        $this->activateUser($user);
        break;
        
    case User::STATUS_PENDING:
        $this->sendVerificationEmail($user);
        break;
        
    default:
        // No action needed
        break;
}
```

#### 2.4.3 Loops
- Use appropriate loop structures for the task
- Consider extraction for complex loop bodies
- Use early continue to reduce nesting

```php
// Good
foreach ($users as $user) {
    if (!$user->isActive()) {
        continue;
    }
    
    $this->sendNotification($user);
}

// Bad
foreach ($users as $user) {
    if ($user->isActive()) {
        // Many lines of deeply nested code
    }
}
```

### 2.5 Error Handling

#### 2.5.1 Exception Handling
- Use try-catch blocks around operations that may fail
- Catch specific exceptions when possible
- Re-throw exceptions with contextual information when appropriate
- Log exceptions with relevant context

```php
try {
    $result = $this->service->processPayment($paymentData);
    return response()->json($result);
} catch (PaymentException $e) {
    Log::error('Payment processing failed', [
        'user_id' => auth()->id(),
        'payment_data' => $paymentData,
        'error' => $e->getMessage()
    ]);
    return response()->json(['error' => 'Payment failed'], 422);
} catch (\Exception $e) {
    Log::error('Unexpected error during payment', [
        'error' => $e->getMessage()
    ]);
    return response()->json(['error' => 'An unexpected error occurred'], 500);
}
```

#### 2.5.2 Return Values
- Use consistent return types within a method
- Use null object pattern or default values when appropriate
- Consider using value objects for complex return types

### 2.6 Database Interactions

#### 2.6.1 Eloquent Models
- Define relationships in model classes
- Use accessors and mutators for data transformation
- Define fillable or guarded properties
- Use appropriate attribute casting

```php
class User extends Model
{
    protected $fillable = [
        'name', 'email', 'password', 'settings'
    ];
    
    protected $casts = [
        'email_verified_at' => 'datetime',
        'settings' => 'array',
        'is_active' => 'boolean',
    ];
    
    public function profile()
    {
        return $this->hasOne(Profile::class);
    }
    
    public function getFullNameAttribute()
    {
        return "{$this->first_name} {$this->last_name}";
    }
}
```

#### 2.6.2 Queries
- Use Eloquent query builder when possible
- Chain methods for readability
- Extract complex queries to model scopes
- Use eager loading to prevent N+1 problems

```php
// Good - Using query builder with eager loading
$users = User::with(['profile', 'roles'])
    ->where('is_active', true)
    ->orderBy('name')
    ->paginate(20);

// Good - Using model scope
public function scopeActive($query)
{
    return $query->where('is_active', true);
}

// Usage
$activeUsers = User::active()->get();

// Bad - N+1 problem
$users = User::all();
foreach ($users as $user) {
    $profile = $user->profile; // Triggers additional query for each user
}
```

## 3. Controller Standards

### 3.1 General Principles
- Keep controllers lean
- Focus on request handling and response generation
- Move business logic to models or services
- Use resource controllers for CRUD operations
- Apply middleware at controller or route level

### 3.2 Request Handling
- Use form requests for validation
- Access request data via request object, not globals
- Use type-hinted dependencies for services
- Validate data before using it

```php
class UserController extends Controller
{
    private $userService;
    
    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }
    
    public function store(StoreUserRequest $request)
    {
        // Validation already handled by FormRequest
        $user = $this->userService->createUser($request->validated());
        
        return redirect()->route('users.show', $user)
            ->with('success', 'User created successfully');
    }
}
```

### 3.3 Response Generation
- Use appropriate response types (view, JSON, etc.)
- Set correct HTTP status codes
- Include success/error messages
- Follow consistent response format

```php
// Web response
return view('users.show', compact('user'));

// API response
return response()->json([
    'status' => 'success',
    'data' => $user,
], 200);

// Redirect with flash message
return redirect()->route('users.index')
    ->with('success', 'User updated successfully');

// Error response
return response()->json([
    'status' => 'error',
    'message' => 'User not found',
], 404);
```

### 3.4 Error Handling
- Wrap controller methods in try-catch blocks
- Log exceptions with context
- Return appropriate error responses
- Handle different exception types appropriately

```php
public function update(UpdateUserRequest $request, $id)
{
    try {
        $user = $this->userService->updateUser($id, $request->validated());
        
        return redirect()->route('users.show', $user)
            ->with('success', 'User updated successfully');
    } catch (UserNotFoundException $e) {
        return redirect()->route('users.index')
            ->with('error', 'User not found');
    } catch (\Exception $e) {
        Log::error('Failed to update user', [
            'id' => $id,
            'error' => $e->getMessage()
        ]);
        
        return redirect()->route('users.edit', $id)
            ->with('error', 'An error occurred while updating the user');
    }
}
```

## 4. Model Standards

### 4.1 Properties
- Define `$fillable` or `$guarded` properties
- Define `$casts` for appropriate type conversion
- Define `$dates` for date fields
- Use `$appends` for virtual attributes

```php
class User extends Model
{
    protected $fillable = [
        'name', 'email', 'password', 'settings'
    ];
    
    protected $casts = [
        'email_verified_at' => 'datetime',
        'settings' => 'array',
        'is_active' => 'boolean',
    ];
    
    protected $appends = [
        'full_name',
    ];
}
```

### 4.2 Relationships
- Name relationships clearly and consistently
- Use appropriate relationship methods
- Document relationships with PHPDoc
- Return relationship methods (not relationship results)

```php
/**
 * Get the user's profile.
 * 
 * @return \Illuminate\Database\Eloquent\Relations\HasOne
 */
public function profile()
{
    return $this->hasOne(Profile::class);
}

/**
 * Get the user's roles.
 * 
 * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
 */
public function roles()
{
    return $this->belongsToMany(Role::class);
}
```

### 4.3 Scopes
- Create query scopes for common queries
- Name scopes clearly using camelCase
- Prefix boolean scopes with appropriate verbs

```php
/**
 * Scope a query to only include active users.
 * 
 * @param \Illuminate\Database\Eloquent\Builder $query
 * @return \Illuminate\Database\Eloquent\Builder
 */
public function scopeActive($query)
{
    return $query->where('is_active', true);
}

/**
 * Scope a query to only include users with verified email.
 * 
 * @param \Illuminate\Database\Eloquent\Builder $query
 * @return \Illuminate\Database\Eloquent\Builder
 */
public function scopeVerified($query)
{
    return $query->whereNotNull('email_verified_at');
}
```

### 4.4 Accessors and Mutators
- Use accessors for computed properties
- Use mutators for data transformation before storage
- Name accessors and mutators with `get{AttributeName}Attribute` and `set{AttributeName}Attribute`

```php
/**
 * Get the user's full name.
 * 
 * @return string
 */
public function getFullNameAttribute()
{
    return "{$this->first_name} {$this->last_name}";
}

/**
 * Set the user's password.
 * 
 * @param string $value
 * @return void
 */
public function setPasswordAttribute($value)
{
    $this->attributes['password'] = Hash::make($value);
}
```

## 5. View Standards

### 5.1 Blade Templates
- Use Blade components for reusable UI elements
- Use layouts for consistent page structure
- Use sections for content organization
- Keep templates focused on presentation

```blade
<!-- Layout file: layouts/app.blade.php -->
<!DOCTYPE html>
<html>
<head>
    <title>@yield('title', config('app.name'))</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body>
    <header>
        @include('partials.navigation')
    </header>
    
    <main>
        @yield('content')
    </main>
    
    <footer>
        @include('partials.footer')
    </footer>
</body>
</html>

<!-- View file: users/show.blade.php -->
@extends('layouts.app')

@section('title', 'User Profile')

@section('content')
    <div class="container">
        <h1>{{ $user->name }}</h1>
        <p>{{ $user->email }}</p>
    </div>
@endsection
```

### 5.2 Blade Components
- Create components for reusable UI elements
- Use props for component configuration
- Keep components focused and single-purpose
- Use slots for flexible content areas

```blade
<!-- Component: components/alert.blade.php -->
@props(['type' => 'info', 'dismissible' => false])

<div class="alert alert-{{ $type }} @if($dismissible) alert-dismissible @endif">
    @if($dismissible)
        <button type="button" class="close" data-dismiss="alert">&times;</button>
    @endif
    
    {{ $slot }}
</div>

<!-- Usage -->
<x-alert type="success" :dismissible="true">
    User created successfully!
</x-alert>
```

### 5.3 Form Elements
- Use form components for consistency
- Include CSRF token in all forms
- Use appropriate input types
- Show validation errors

```blade
<form method="POST" action="{{ route('users.store') }}">
    @csrf
    
    <div class="form-group">
        <label for="name">Name</label>
        <input type="text" id="name" name="name" class="form-control @error('name') is-invalid @enderror" value="{{ old('name') }}">
        
        @error('name')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>
    
    <button type="submit" class="btn btn-primary">Create User</button>
</form>
```

## 6. API Standards

### 6.1 Endpoints
- Use RESTful resource naming
- Use plural nouns for resources
- Use appropriate HTTP methods
- Version API endpoints

```
# RESTful API endpoints
GET    /api/v1/users          # List users
POST   /api/v1/users          # Create user
GET    /api/v1/users/{id}     # Show user
PUT    /api/v1/users/{id}     # Update user
DELETE /api/v1/users/{id}     # Delete user
```

### 6.2 Request Handling
- Validate API requests
- Use API resources for response transformation
- Return appropriate HTTP status codes
- Include meaningful error messages

```php
public function store(StoreUserRequest $request)
{
    $user = User::create($request->validated());
    
    return new UserResource($user);
}

public function show($id)
{
    $user = User::find($id);
    
    if (!$user) {
        return response()->json([
            'status' => 'error',
            'message' => 'User not found'
        ], 404);
    }
    
    return new UserResource($user);
}
```

### 6.3 Response Format
- Use consistent response structure
- Include status, message, and data fields
- Use pagination for list endpoints
- Include meta data where appropriate

```php
// API resource
class UserResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'email' => $this->email,
            'created_at' => $this->created_at->toIso8601String(),
            'profile' => new ProfileResource($this->whenLoaded('profile')),
        ];
    }
}

// Collection resource
class UserCollection extends ResourceCollection
{
    public function toArray($request)
    {
        return [
            'data' => $this->collection,
            'meta' => [
                'total' => $this->resource->total(),
                'per_page' => $this->resource->perPage(),
                'current_page' => $this->resource->currentPage(),
                'last_page' => $this->resource->lastPage(),
            ],
        ];
    }
}
```

## 7. JavaScript Standards

### 7.1 General Principles
- Use ES6+ syntax where supported
- Follow jQuery best practices
- Organize code into modular functions
- Use consistent naming conventions

### 7.2 AJAX Requests
- Show loading indicators during requests
- Handle errors appropriately
- Update UI without page reloads
- Use proper error handling

```javascript
// AJAX request with loading indicator
$('#createUserForm').on('submit', function(e) {
    e.preventDefault();
    
    const form = $(this);
    const submitButton = form.find('button[type="submit"]');
    const formData = form.serialize();
    
    // Show loading state
    submitButton.prop('disabled', true).html('<span class="spinner-border spinner-border-sm"></span> Saving...');
    
    $.ajax({
        url: form.attr('action'),
        type: 'POST',
        data: formData,
        success: function(response) {
            // Show success message
            showAlert('success', 'User created successfully');
            
            // Update UI or redirect
            window.location.href = '/users/' + response.data.id;
        },
        error: function(xhr) {
            // Show error message
            const response = xhr.responseJSON;
            if (response && response.errors) {
                // Show validation errors
                showValidationErrors(form, response.errors);
            } else {
                // Show general error
                showAlert('error', 'Failed to create user');
            }
        },
        complete: function() {
            // Reset button state
            submitButton.prop('disabled', false).text('Create User');
        }
    });
});

// Helper function for showing alerts
function showAlert(type, message) {
    Swal.fire({
        icon: type,
        title: type === 'success' ? 'Success' : 'Error',
        text: message,
        timer: 3000
    });
}

// Helper function for showing validation errors
function showValidationErrors(form, errors) {
    // Clear previous errors
    form.find('.is-invalid').removeClass('is-invalid');
    form.find('.invalid-feedback').remove();
    
    // Show new errors
    $.each(errors, function(field, messages) {
        const input = form.find(`[name="${field}"]`);
        input.addClass('is-invalid');
        input.after(`<div class="invalid-feedback">${messages[0]}</div>`);
    });
}
```

### 7.3 UI Interactions
- Use event delegation for dynamic elements
- Implement proper form validation
- Create reusable UI components
- Maintain separation of concerns

```javascript
// Event delegation for dynamic elements
$(document).on('click', '.delete-user', function(e) {
    e.preventDefault();
    
    const button = $(this);
    const userId = button.data('user-id');
    
    Swal.fire({
        title: 'Are you sure?',
        text: 'This action cannot be undone!',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#dc3545',
        confirmButtonText: 'Yes, delete it!'
    }).then((result) => {
        if (result.isConfirmed) {
            deleteUser(userId, button);
        }
    });
});

// Function to handle user deletion
function deleteUser(userId, button) {
    // Show loading state
    button.prop('disabled', true).html('<span class="spinner-border spinner-border-sm"></span>');
    
    $.ajax({
        url: `/api/v1/users/${userId}`,
        type: 'DELETE',
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        success: function() {
            // Remove user from UI
            button.closest('tr').fadeOut(300, function() {
                $(this).remove();
            });
            
            // Show success message
            showAlert('success', 'User deleted successfully');
        },
        error: function() {
            // Show error message
            showAlert('error', 'Failed to delete user');
            
            // Reset button state
            button.prop('disabled', false).html('<i class="fa fa-trash"></i>');
        }
    });
}
```

## 8. Testing Standards

### 8.1 Test Organization
- Group tests by feature or model
- Use descriptive test method names
- Follow arrange-act-assert pattern
- One assertion per test when possible

```php
class UserTest extends TestCase
{
    /** @test */
    public function it_can_create_a_user()
    {
        // Arrange
        $userData = [
            'name' => 'John Doe',
            'email' => 'john@example.com',
            'password' => 'password',
        ];
        
        // Act
        $user = User::create($userData);
        
        // Assert
        $this->assertInstanceOf(User::class, $user);
        $this->assertEquals('John Doe', $user->name);
        $this->assertEquals('john@example.com', $user->email);
    }
}
```

### 8.2 Feature Tests
- Test complete user flows
- Verify critical application functionality
- Focus on user interaction and results
- Use database transactions for isolation

```php
class UserControllerTest extends TestCase
{
    use RefreshDatabase;
    
    /** @test */
    public function authenticated_users_can_create_new_users()
    {
        // Arrange
        $admin = User::factory()->create();
        $this->actingAs($admin);
        
        $userData = [
            'name' => 'Jane Doe',
            'email' => 'jane@example.com',
            'password' => 'password',
            'password_confirmation' => 'password',
        ];
        
        // Act
        $response = $this->post(route('users.store'), $userData);
        
        // Assert
        $response->assertRedirect(route('users.index'));
        $this->assertDatabaseHas('users', [
            'name' => 'Jane Doe',
            'email' => 'jane@example.com',
        ]);
        $response->assertSessionHas('success', 'User created successfully');
    }
}
```

### 8.3 Unit Tests
- Test individual components in isolation
- Mock dependencies when necessary
- Focus on business logic and edge cases
- Keep tests fast and focused

```php
class UserServiceTest extends TestCase
{
    /** @test */
    public function it_throws_exception_when_creating_user_with_duplicate_email()
    {
        // Arrange
        $userService = new UserService();
        User::factory()->create(['email' => 'existing@example.com']);
        
        $userData = [
            'name' => 'New User',
            'email' => 'existing@example.com',
            'password' => 'password',
        ];
        
        // Assert & Act
        $this->expectException(DuplicateEmailException::class);
        $userService->createUser($userData);
    }
}
```

## 9. Documentation Standards

### 9.1 Code Documentation
- Document all classes and complex methods
- Use PHPDoc blocks for PHP code
- Include example usage where helpful
- Document exceptions and edge cases

### 9.2 API Documentation
- Document all API endpoints
- Include request and response examples
- Document required headers and parameters
- Include information about authentication

### 9.3 User Documentation
- Create user guides for key features
- Include screenshots and examples
- Follow consistent structure and style
- Keep documentation up to date with changes

## 10. Deployment Standards

### 10.1 Environment Configuration
- Use environment variables for configuration
- Include example .env file with documentation
- Document required environment variables
- Keep sensitive information out of version control

### 10.2 Build Process
- Document build and deployment steps
- Use version control for tracking changes
- Include database migration instructions
- Document rollback procedures
