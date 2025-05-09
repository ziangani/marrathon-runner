# Implementation Plan for AI Coding Agent

## 1. Project Development Sequence

This implementation plan is specifically designed for an AI coding agent to follow when building the Laravel 12 application. The development will proceed in the following sequence:

1. **Routes**: Define application routes first to establish the URL structure
2. **Controllers**: Create controllers that process requests and return responses
3. **Views**: Develop the UI templates that will be rendered
4. **Models**: Implement data models with relationships
5. **Migrations**: Create database structure
6. **Middleware**: Add request filters and protections

## 2. Development Phases

### Phase 1: Foundation Setup

#### Step 1: Project Initialization
- Initialize Laravel 12 project
- Configure environment (.env) with PostgreSQL connection
- Set up Redis for cache and queue
- Install and configure required packages via Composer

#### Step 2: Route Definition
- Create web routes in `routes/web.php`
  - Define authentication routes
  - Define main application routes
  - Group routes by functionality
  - Apply middleware groups
- Create API routes in `routes/api.php`
  - Define API endpoints with versioning (v1)
  - Group API routes by resource type
  - Apply rate limiting and authentication middleware

```php
// Example route structure to implement
// web.php
Route::middleware(['web'])->group(function () {
    // Auth routes (if not using Laravel's built-in routes)
    Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [AuthController::class, 'login']);
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
    Route::get('/register', [AuthController::class, 'showRegistrationForm'])->name('register');
    Route::post('/register', [AuthController::class, 'register']);
    
    // Password reset
    Route::get('/password/reset', [ForgotPasswordController::class, 'showLinkRequestForm'])->name('password.request');
    Route::post('/password/email', [ForgotPasswordController::class, 'sendResetLinkEmail'])->name('password.email');
    Route::get('/password/reset/{token}', [ResetPasswordController::class, 'showResetForm'])->name('password.reset');
    Route::post('/password/reset', [ResetPasswordController::class, 'reset'])->name('password.update');
    
    // Email verification
    Route::get('/email/verify', [VerificationController::class, 'show'])->name('verification.notice');
    Route::get('/email/verify/{id}/{hash}', [VerificationController::class, 'verify'])->name('verification.verify');
    Route::post('/email/resend', [VerificationController::class, 'resend'])->name('verification.resend');
    
    // Protected routes
    Route::middleware(['auth', 'verified'])->group(function () {
        Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
        
        // User profile
        Route::get('/profile', [ProfileController::class, 'show'])->name('profile.show');
        Route::put('/profile', [ProfileController::class, 'update'])->name('profile.update');
        
        // Module specific routes
        Route::prefix('module1')->group(function () {
            Route::get('/', [Module1Controller::class, 'index'])->name('module1.index');
            Route::get('/create', [Module1Controller::class, 'create'])->name('module1.create');
            Route::post('/', [Module1Controller::class, 'store'])->name('module1.store');
            Route::get('/{id}', [Module1Controller::class, 'show'])->name('module1.show');
            Route::get('/{id}/edit', [Module1Controller::class, 'edit'])->name('module1.edit');
            Route::put('/{id}', [Module1Controller::class, 'update'])->name('module1.update');
            Route::delete('/{id}', [Module1Controller::class, 'destroy'])->name('module1.destroy');
        });
        
        // Admin routes
        Route::prefix('admin')->middleware(['role:admin'])->group(function () {
            Route::get('/users', [UserController::class, 'index'])->name('admin.users.index');
            Route::get('/roles', [RoleController::class, 'index'])->name('admin.roles.index');
            Route::get('/activity-log', [ActivityLogController::class, 'index'])->name('admin.activity-log.index');
        });
    });
});

// api.php
Route::prefix('v1')->group(function () {
    Route::post('/login', [AuthApiController::class, 'login']);
    Route::post('/register', [AuthApiController::class, 'register']);
    
    Route::middleware('auth:sanctum')->group(function () {
        Route::apiResource('users', UserApiController::class);
        Route::apiResource('module1', Module1ApiController::class);
    });
});
```

#### Step 3: Controller Creation
- Create base controller class with common functionality
- Create auth controllers (if not using Laravel UI/Breeze/Jetstream)
- Create resource controllers for each module
- Create API controllers for each resource

```php
// Example controller structure
namespace App\Http\Controllers;

use App\Http\Requests\StoreModule1Request;
use App\Http\Requests\UpdateModule1Request;
use App\Models\Module1;
use Illuminate\Http\Request;

class Module1Controller extends Controller
{
    public function index()
    {
        try {
            $items = Module1::paginate(15);
            return view('module1.index', compact('items'));
        } catch (\Exception $e) {
            \Log::error('Failed to load module1 index: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Unable to load data. Please try again.');
        }
    }
    
    public function create()
    {
        return view('module1.create');
    }
    
    public function store(StoreModule1Request $request)
    {
        try {
            $item = Module1::create($request->validated());
            return redirect()->route('module1.show', $item)->with('success', 'Item created successfully!');
        } catch (\Exception $e) {
            \Log::error('Failed to store module1: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Unable to create item. Please try again.')->withInput();
        }
    }
    
    // Other controller methods...
}
```

#### Step 4: View Template Development
- Create layout files with Tailwind CSS
- Create auth views (login, register, etc.)
- Create dashboard view
- Create CRUD views for each module
- Implement form components with client-side validation

```html
<!-- Example Blade template structure -->
<!-- layouts/app.blade.php -->
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Laravel') }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="font-sans antialiased">
    <div class="min-h-screen bg-gray-100">
        @include('layouts.navigation')

        <!-- Page Heading -->
        @if (isset($header))
            <header class="bg-white shadow">
                <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                    {{ $header }}
                </div>
            </header>
        @endif

        <!-- Page Content -->
        <main>
            @include('components.alerts')
            {{ $slot }}
        </main>
    </div>
</body>
</html>

<!-- components/alerts.blade.php -->
@if (session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif

@if (session('error'))
    <div class="alert alert-danger">
        {{ session('error') }}
    </div>
@endif

<!-- module1/index.blade.php -->
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Module 1') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <!-- Table here -->
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
```

### Phase 2: Data Layer Implementation

#### Step 5: Model Creation
- Create base model with common functionality
- Create models for each entity with relationships
- Define fillable attributes, casts, and accessors/mutators
- Implement model methods for business logic

```php
// Example model structure
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Module1 extends Model
{
    use HasFactory, SoftDeletes;
    
    protected $fillable = [
        'name',
        'description',
        'status',
        'user_id',
    ];
    
    protected $casts = [
        'status' => 'boolean',
        'settings' => 'array',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];
    
    // Relationships
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    
    public function items()
    {
        return $this->hasMany(Module1Item::class);
    }
    
    // Scopes
    public function scopeActive($query)
    {
        return $query->where('status', true);
    }
    
    // Accessors
    public function getStatusLabelAttribute()
    {
        return $this->status ? 'Active' : 'Inactive';
    }
    
    // Business logic methods
    public function canBeDeleted()
    {
        return $this->items()->count() === 0;
    }
}
```

#### Step 6: Migration Creation
- Create migrations for all models
- Define table structure with appropriate column types
- Add foreign key constraints
- Create indexes for frequently queried columns

```php
// Example migration
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('module1s', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->text('description')->nullable();
            $table->boolean('status')->default(true);
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->json('settings')->nullable();
            $table->timestamps();
            $table->softDeletes();
            
            $table->index('status');
            $table->index('created_at');
        });
    }

    public function down()
    {
        Schema::dropIfExists('module1s');
    }
};
```

#### Step 7: Middleware Implementation
- Create authentication middleware
- Create role and permission middleware
- Implement rate limiting middleware for API
- Create custom request logging middleware

```php
// Example middleware
namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class RoleMiddleware
{
    public function handle(Request $request, Closure $next, string $role): Response
    {
        if (!$request->user() || !$request->user()->hasRole($role)) {
            return redirect()->route('dashboard')->with('error', 'You do not have permission to access this page.');
        }

        return $next($request);
    }
}
```

### Phase 3: Feature Implementation

#### Step 8: Authentication System
- Implement user registration with email verification
- Create login and logout functionality
- Implement password reset flow
- Add "remember me" functionality

#### Step 9: Authorization System
- Create role and permission system
- Implement policy classes for authorization
- Add role management interface
- Implement permission checks in controllers

#### Step 10: User Management
- Create user CRUD functionality
- Implement user profile management
- Add user impersonation for admins
- Create activity logging

#### Step 11: Core Business Modules
- Implement CRUD operations for each module
- Add business logic in models/services
- Create forms with validation
- Add data tables with sorting and filtering

#### Step 12: API Development
- Implement API authentication with Sanctum
- Create API resources for serialization
- Add rate limiting and throttling
- Implement API documentation

### Phase 4: Advanced Features

#### Step 13: Reporting System
- Create report generation functionality
- Implement export to PDF/CSV
- Add scheduled reports
- Create dashboard widgets

#### Step 14: Notification System
- Implement in-app notifications
- Create email notification templates
- Add real-time notifications
- Implement notification preferences

#### Step 15: File Management
- Create file upload functionality
- Implement S3 integration
- Add file validation and processing
- Create file preview functionality

### Phase 5: Optimization and Refinement

#### Step 16: Performance Optimization
- Implement caching strategy
- Optimize database queries
- Add lazy loading for images
- Implement queue for background processing

#### Step 17: Security Hardening
- Add CSRF protection
- Implement proper input validation
- Add security headers
- Create secure API endpoints

#### Step 18: Testing
- Create feature tests for critical flows
- Add unit tests for models and services
- Implement API tests
- Create database seeders for testing

## 3. Development Guidelines

### 3.1. Controller Guidelines
- Keep controllers lean (under 100 lines where possible)
- Use form requests for validation
- Implement try-catch blocks for error handling
- Return appropriate responses (views or JSON)
- Use resource controllers for CRUD operations

### 3.2. Model Guidelines
- Define relationships properly
- Use proper attribute casting
- Implement scopes for common queries
- Add business logic to models or service classes
- Use events for side effects

### 3.3. View Guidelines
- Use Blade components for reusability
- Implement mobile-first responsive design with Tailwind
- Add proper form validation feedback
- Use loading indicators for AJAX operations
- Implement consistent UI patterns

### 3.4. JavaScript Guidelines
- Use jQuery for DOM manipulation and AJAX
- Implement loading indicators for all async operations
- Use SweetAlert for notifications
- Handle form submission with AJAX
- Implement client-side validation

### 3.5. Security Guidelines
- Validate all input data
- Escape output to prevent XSS
- Implement proper authorization checks
- Use CSRF tokens for all forms
- Implement rate limiting for authentication

## 4. Implementation Checklist

### Foundation
- [ ] Initialize Laravel 12 project
- [ ] Configure database connection
- [ ] Set up Redis for cache and queue
- [ ] Define route structure
- [ ] Create base controller structure
- [ ] Create layout templates
- [ ] Set up authentication controllers

### Models & Database
- [ ] Create user model extensions
- [ ] Implement role and permission models
- [ ] Create core module models
- [ ] Define table migrations
- [ ] Implement model relationships
- [ ] Add model business logic

### Features
- [ ] Implement authentication flows
- [ ] Create dashboard interface
- [ ] Implement user management
- [ ] Create role management
- [ ] Implement CRUD for core modules
- [ ] Create reporting functionality
- [ ] Implement notification system
- [ ] Add file management

### API & Integration
- [ ] Implement API authentication
- [ ] Create API resources
- [ ] Add rate limiting
- [ ] Implement API documentation
- [ ] Create webhook functionality

### Performance & Security
- [ ] Implement caching strategy
- [ ] Optimize database queries
- [ ] Add queue processing
- [ ] Implement security headers
- [ ] Create comprehensive tests
