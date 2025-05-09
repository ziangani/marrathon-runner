# Laravel 12 UI Styling Guide

This guide outlines the UI styling standards for our Laravel 12 project. It provides a comprehensive framework for maintaining consistency in design elements, component structures, and frontend implementation.

## Table of Contents

1. [Design Tokens](#1-design-tokens)
   - [Colors](#11-colors)
   - [Typography](#12-typography)
   - [Spacing](#13-spacing)
   - [Shadows](#14-shadows)
2. [Component Patterns](#2-component-patterns)
   - [Cards](#21-cards)
   - [Forms](#22-forms)
   - [Buttons](#23-buttons)
   - [Tables](#24-tables)
   - [Alerts](#25-alerts)
3. [Layout Guidelines](#3-layout-guidelines)
   - [Container Widths](#31-container-widths)
   - [Spacing Hierarchy](#32-spacing-hierarchy)
   - [Grid System](#33-grid-system)
4. [Interactive Elements](#4-interactive-elements)
   - [Form Controls](#41-form-controls)
   - [Buttons](#42-buttons)
   - [Navigation](#43-navigation)
5. [Responsive Patterns](#5-responsive-patterns)
   - [Breakpoints](#51-breakpoints)
   - [Adaptive Layouts](#52-adaptive-layouts)
   - [Mobile-First Approach](#53-mobile-first-approach)
6. [Animation Guidelines](#6-animation-guidelines)
   - [Transitions](#61-transitions)
   - [Loading States](#62-loading-states)
7. [Dark Mode Support](#7-dark-mode-support)
   - [Color Adaptation](#71-color-adaptation)
   - [Implementation](#72-implementation)
8. [Accessibility Guidelines](#8-accessibility-guidelines)
   - [Color Contrast](#81-color-contrast)
   - [Focus States](#82-focus-states)
   - [ARIA Attributes](#83-aria-attributes)
9. [Tailwind CSS Practices](#9-tailwind-css-practices)
   - [Configuration](#91-configuration)
   - [Class Organization](#92-class-organization)
   - [Utility Usage](#93-utility-usage)
10. [Image Guidelines](#10-image-guidelines)
    - [Format Standards](#101-format-standards)
    - [Optimization](#102-optimization)
11. [JavaScript Component Structure](#11-javascript-component-structure)
    - [Organization](#111-organization)
    - [Event Handling](#112-event-handling)

## 1. Design Tokens

### 1.1 Colors

Define semantic color tokens with consistent meaning throughout the application:

```javascript
// tailwind.config.js
module.exports = {
  theme: {
    extend: {
      colors: {
        primary: {
          DEFAULT: 'rgb(var(--color-primary) / <alpha-value>)',
          light: 'rgb(var(--color-primary-light) / <alpha-value>)',
          dark: 'rgb(var(--color-primary-dark) / <alpha-value>)',
        },
        secondary: {
          DEFAULT: 'rgb(var(--color-secondary) / <alpha-value>)',
          light: 'rgb(var(--color-secondary-light) / <alpha-value>)',
          dark: 'rgb(var(--color-secondary-dark) / <alpha-value>)',
        },
        success: {
          DEFAULT: 'rgb(var(--color-success) / <alpha-value>)',
        },
        warning: {
          DEFAULT: 'rgb(var(--color-warning) / <alpha-value>)',
        },
        error: {
          DEFAULT: 'rgb(var(--color-error) / <alpha-value>)',
        },
        surface: {
          DEFAULT: 'rgb(var(--color-surface) / <alpha-value>)',
          raised: 'rgb(var(--color-surface-raised) / <alpha-value>)',
          sunken: 'rgb(var(--color-surface-sunken) / <alpha-value>)',
        },
        text: {
          DEFAULT: 'rgb(var(--color-text) / <alpha-value>)',
          muted: 'rgb(var(--color-text-muted) / <alpha-value>)',
          inverted: 'rgb(var(--color-text-inverted) / <alpha-value>)',
        }
      }
    }
  }
}
```

CSS variables in your base stylesheet:

```css
:root {
  --color-primary: 51 102 204; /* #3366CC */
  --color-primary-light: 76 126 226; /* #4C7EE2 */
  --color-primary-dark: 41 82 163; /* #2952A3 */
  
  --color-secondary: 255 153 0; /* #FF9900 */
  --color-secondary-light: 255 173 51; /* #FFAD33 */
  --color-secondary-dark: 204 122 0; /* #CC7A00 */
  
  --color-success: 40 167 69; /* #28A745 */
  --color-warning: 255 193 7; /* #FFC107 */
  --color-error: 220 53 69; /* #DC3545 */
  
  --color-surface: 255 255 255; /* #FFFFFF */
  --color-surface-raised: 249 250 251; /* #F9FAFB */
  --color-surface-sunken: 243 244 246; /* #F3F4F6 */
  
  --color-text: 17 24 39; /* #111827 */
  --color-text-muted: 107 114 128; /* #6B7280 */
  --color-text-inverted: 255 255 255; /* #FFFFFF */
}

.dark {
  --color-primary: 76 126 226; /* #4C7EE2 - brighter in dark mode */
  
  --color-surface: 17 24 39; /* #111827 */
  --color-surface-raised: 31 41 55; /* #1F2937 */
  --color-surface-sunken: 55 65 81; /* #374151 */
  
  --color-text: 243 244 246; /* #F3F4F6 */
  --color-text-muted: 156 163 175; /* #9CA3AF */
  --color-text-inverted: 17 24 39; /* #111827 */
}
```

### 1.2 Typography

Use a consistent type scale throughout the application:

```javascript
// tailwind.config.js
module.exports = {
  theme: {
    extend: {
      fontFamily: {
        sans: ['Inter', 'sans-serif'],
        mono: ['JetBrains Mono', 'monospace'],
      },
      fontSize: {
        xs: ['0.75rem', { lineHeight: '1rem' }],
        sm: ['0.875rem', { lineHeight: '1.25rem' }],
        base: ['1rem', { lineHeight: '1.5rem' }],
        lg: ['1.125rem', { lineHeight: '1.75rem' }],
        xl: ['1.25rem', { lineHeight: '1.75rem' }],
        '2xl': ['1.5rem', { lineHeight: '2rem' }],
        '3xl': ['1.875rem', { lineHeight: '2.25rem' }],
        '4xl': ['2.25rem', { lineHeight: '2.5rem' }],
      },
    }
  }
}
```

Typography usage:

```html
<!-- Headings -->
<h1 class="text-4xl font-bold tracking-tight">Page Title</h1>
<h2 class="text-2xl font-semibold">Section Title</h2>
<h3 class="text-xl font-medium">Subsection Title</h3>

<!-- Body Text -->
<p class="text-base text-text">Regular text</p>
<p class="text-sm text-text-muted">Supporting text</p>

<!-- Interactive Text -->
<a class="text-primary hover:text-primary-dark 
          underline-offset-4 hover:underline">Link Text</a>
```

### 1.3 Spacing

Use a consistent spacing scale:

```javascript
// tailwind.config.js
module.exports = {
  theme: {
    extend: {
      spacing: {
        xs: '0.25rem',   // 4px - Minimal spacing
        sm: '0.5rem',    // 8px - Tight spacing
        md: '1rem',      // 16px - Standard spacing
        lg: '1.5rem',    // 24px - Comfortable spacing
        xl: '2rem',      // 32px - Section spacing
        '2xl': '4rem',   // 64px - Major section spacing
      }
    }
  }
}
```

### 1.4 Shadows

Define consistent shadow tokens:

```javascript
// tailwind.config.js
module.exports = {
  theme: {
    extend: {
      boxShadow: {
        'card': '0 10px 15px -3px rgba(0, 0, 0, 0.05)',
        'button': '0 4px 6px -1px rgba(0, 0, 0, 0.1)',
        'dropdown': '0 10px 15px -3px rgba(0, 0, 0, 0.1), 0 4px 6px -2px rgba(0, 0, 0, 0.05)',
        'modal': '0 20px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04)',
      }
    }
  }
}
```

## 2. Component Patterns

### 2.1 Cards

Standard card structure:

```html
<!-- Base Card -->
<div class="rounded-lg bg-surface p-4 shadow-sm">
  <!-- Card Header -->
  <div class="flex items-center justify-between mb-4">
    <h3 class="text-lg font-semibold">Card Title</h3>
    <div class="flex gap-2"><!-- Actions --></div>
  </div>
  
  <!-- Card Content -->
  <div class="space-y-4">
    <!-- Content blocks -->
  </div>
  
  <!-- Card Footer -->
  <div class="mt-4 pt-4 border-t border-surface-raised">
    <!-- Footer content -->
  </div>
</div>
```

Card variants:

```html
<!-- Simple Card -->
<div class="rounded-lg bg-surface p-4 shadow-sm">
  <h3 class="text-lg font-semibold mb-2">Simple Card</h3>
  <p>Card content goes here.</p>
</div>

<!-- Interactive Card -->
<div class="rounded-lg bg-surface p-4 shadow-sm hover:shadow-card 
            transition-shadow duration-300">
  <h3 class="text-lg font-semibold mb-2">Interactive Card</h3>
  <p>This card has hover effects.</p>
</div>

<!-- Colored Card -->
<div class="rounded-lg bg-primary-light p-4 text-text-inverted">
  <h3 class="text-lg font-semibold mb-2">Primary Card</h3>
  <p>This card has a colored background.</p>
</div>
```

### 2.2 Forms

Standard form group:

```html
<!-- Form Group -->
<div class="space-y-2">
  <label for="field-id" class="block text-sm font-medium text-text-muted">
    Field Label
  </label>
  <input 
    type="text"
    id="field-id"
    name="field-name"
    class="w-full px-3 py-2 rounded-md border border-surface-raised
           focus:ring-2 focus:ring-primary focus:border-primary"
  >
  <p class="text-sm text-text-muted">Helper text</p>
</div>
```

Form structure:

```html
<!-- Complete Form -->
<form class="space-y-6">
  <div class="space-y-4">
    <h2 class="text-xl font-semibold">Form Section</h2>
    
    <!-- Text Field -->
    <div class="space-y-2">
      <label for="name" class="block text-sm font-medium text-text-muted">
        Name
      </label>
      <input 
        type="text"
        id="name"
        name="name"
        class="w-full px-3 py-2 rounded-md border border-surface-raised
               focus:ring-2 focus:ring-primary focus:border-primary"
      >
    </div>
    
    <!-- Select Field -->
    <div class="space-y-2">
      <label for="type" class="block text-sm font-medium text-text-muted">
        Type
      </label>
      <select 
        id="type"
        name="type"
        class="w-full px-3 py-2 rounded-md border border-surface-raised
               focus:ring-2 focus:ring-primary focus:border-primary"
      >
        <option value="">Select a type</option>
        <option value="type1">Type 1</option>
        <option value="type2">Type 2</option>
      </select>
    </div>
  </div>
  
  <!-- Form Actions -->
  <div class="flex justify-end space-x-3 pt-4 border-t border-surface-raised">
    <button type="button" class="px-4 py-2 rounded-md border border-surface-raised
                                text-text-muted hover:bg-surface-raised">
      Cancel
    </button>
    <button type="submit" class="px-4 py-2 rounded-md bg-primary text-white
                                hover:bg-primary-dark focus:ring-2 focus:ring-primary/50">
      Submit
    </button>
  </div>
</form>
```

### 2.3 Buttons

Primary buttons:

```html
<!-- Primary Button -->
<button class="px-4 py-2 rounded-md bg-primary text-white
               hover:bg-primary-dark focus:ring-2 focus:ring-primary/50
               transition-colors">
  Primary Action
</button>

<!-- Secondary Button -->
<button class="px-4 py-2 rounded-md border border-primary
               text-primary hover:bg-primary/10
               focus:ring-2 focus:ring-primary/50
               transition-colors">
  Secondary Action
</button>

<!-- Tertiary Button -->
<button class="px-4 py-2 text-primary hover:underline
               focus:ring-2 focus:ring-primary/50
               transition-colors">
  Tertiary Action
</button>
```

Button sizes:

```html
<!-- Small Button -->
<button class="px-2 py-1 text-sm rounded-md bg-primary text-white
               hover:bg-primary-dark focus:ring-2 focus:ring-primary/50">
  Small
</button>

<!-- Medium Button (Default) -->
<button class="px-4 py-2 rounded-md bg-primary text-white
               hover:bg-primary-dark focus:ring-2 focus:ring-primary/50">
  Medium
</button>

<!-- Large Button -->
<button class="px-6 py-3 text-lg rounded-md bg-primary text-white
               hover:bg-primary-dark focus:ring-2 focus:ring-primary/50">
  Large
</button>
```

Button with icon:

```html
<!-- Icon Button -->
<button class="px-4 py-2 rounded-md bg-primary text-white
               hover:bg-primary-dark focus:ring-2 focus:ring-primary/50
               inline-flex items-center gap-2">
  <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
    <!-- SVG path -->
  </svg>
  Button with Icon
</button>

<!-- Icon Only Button -->
<button class="p-2 rounded-full bg-primary text-white
               hover:bg-primary-dark focus:ring-2 focus:ring-primary/50">
  <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
    <!-- SVG path -->
  </svg>
  <span class="sr-only">Action</span>
</button>
```

### 2.4 Tables

Standard table:

```html
<!-- Basic Table -->
<div class="overflow-x-auto">
  <table class="min-w-full divide-y divide-surface-raised">
    <thead class="bg-surface-raised">
      <tr>
        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-text-muted uppercase tracking-wider">
          Name
        </th>
        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-text-muted uppercase tracking-wider">
          Status
        </th>
        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-text-muted uppercase tracking-wider">
          Date
        </th>
        <th scope="col" class="relative px-6 py-3">
          <span class="sr-only">Actions</span>
        </th>
      </tr>
    </thead>
    <tbody class="bg-surface divide-y divide-surface-raised">
      <tr>
        <td class="px-6 py-4 whitespace-nowrap">
          <div class="text-sm font-medium text-text">John Doe</div>
        </td>
        <td class="px-6 py-4 whitespace-nowrap">
          <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-success/10 text-success">
            Active
          </span>
        </td>
        <td class="px-6 py-4 whitespace-nowrap text-sm text-text-muted">
          2023-01-01
        </td>
        <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
          <a href="#" class="text-primary hover:text-primary-dark">Edit</a>
        </td>
      </tr>
      <!-- More rows -->
    </tbody>
  </table>
</div>
```

### 2.5 Alerts

Alert variants:

```html
<!-- Success Alert -->
<div class="rounded-md bg-success/10 p-4">
  <div class="flex">
    <div class="flex-shrink-0">
      <svg class="h-5 w-5 text-success" viewBox="0 0 20 20" fill="currentColor">
        <!-- SVG path -->
      </svg>
    </div>
    <div class="ml-3">
      <p class="text-sm font-medium text-success">
        Operation completed successfully.
      </p>
    </div>
  </div>
</div>

<!-- Warning Alert -->
<div class="rounded-md bg-warning/10 p-4">
  <div class="flex">
    <div class="flex-shrink-0">
      <svg class="h-5 w-5 text-warning" viewBox="0 0 20 20" fill="currentColor">
        <!-- SVG path -->
      </svg>
    </div>
    <div class="ml-3">
      <p class="text-sm font-medium text-warning">
        Please review the information before continuing.
      </p>
    </div>
  </div>
</div>

<!-- Error Alert -->
<div class="rounded-md bg-error/10 p-4">
  <div class="flex">
    <div class="flex-shrink-0">
      <svg class="h-5 w-5 text-error" viewBox="0 0 20 20" fill="currentColor">
        <!-- SVG path -->
      </svg>
    </div>
    <div class="ml-3">
      <p class="text-sm font-medium text-error">
        An error occurred. Please try again.
      </p>
    </div>
  </div>
</div>
```

## 3. Layout Guidelines

### 3.1 Container Widths

Standard containers:

```html
<!-- Default content container -->
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
  <!-- Content -->
</div>

<!-- Narrow content container -->
<div class="max-w-3xl mx-auto">
  <!-- Focused content -->
</div>

<!-- Full width container with padding -->
<div class="w-full px-4 sm:px-6 lg:px-8">
  <!-- Full width content -->
</div>
```

### 3.2 Spacing Hierarchy

Follow these spacing patterns:

- Content sections: `gap-8` or `space-y-8`
- Related elements: `gap-4` or `space-y-4`
- Tight grouping: `gap-2` or `space-y-2`

Example:

```html
<!-- Page structure -->
<div class="space-y-8">
  <!-- Section -->
  <section>
    <h2 class="text-2xl font-semibold mb-4">Section Title</h2>
    
    <!-- Related elements -->
    <div class="space-y-4">
      <div><!-- Element 1 --></div>
      <div><!-- Element 2 --></div>
    </div>
  </section>
  
  <!-- Another section -->
  <section>
    <h2 class="text-2xl font-semibold mb-4">Another Section</h2>
    
    <!-- Related elements with horizontal layout -->
    <div class="flex gap-4">
      <div><!-- Element 1 --></div>
      <div><!-- Element 2 --></div>
    </div>
  </section>
</div>
```

### 3.3 Grid System

Use Tailwind's grid system for layout:

```html
<!-- Basic grid with 3 columns -->
<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
  <div><!-- Item 1 --></div>
  <div><!-- Item 2 --></div>
  <div><!-- Item 3 --></div>
  <div><!-- Item 4 --></div>
</div>

<!-- Grid with varying column widths -->
<div class="grid grid-cols-12 gap-4">
  <div class="col-span-12 md:col-span-8"><!-- Main content --></div>
  <div class="col-span-12 md:col-span-4"><!-- Sidebar --></div>
</div>
```

## 4. Interactive Elements

### 4.1 Form Controls

Standard text input:

```html
<input 
  type="text"
  id="name"
  name="name"
  class="w-full px-3 py-2 rounded-md border border-surface-raised
         focus:ring-2 focus:ring-primary focus:border-primary"
>
```

Select input:

```html
<select 
  id="type"
  name="type"
  class="w-full px-3 py-2 rounded-md border border-surface-raised
         focus:ring-2 focus:ring-primary focus:border-primary"
>
  <option value="">Select a type</option>
  <option value="type1">Type 1</option>
  <option value="type2">Type 2</option>
</select>
```

Checkbox:

```html
<div class="flex items-center">
  <input 
    type="checkbox"
    id="terms"
    name="terms"
    class="h-4 w-4 text-primary focus:ring-primary border-surface-raised rounded"
  >
  <label for="terms" class="ml-2 block text-sm text-text">
    I agree to the terms
  </label>
</div>
```

Radio button:

```html
<div class="space-y-2">
  <div class="flex items-center">
    <input 
      type="radio"
      id="option1"
      name="options"
      value="option1"
      class="h-4 w-4 text-primary focus:ring-primary border-surface-raised"
    >
    <label for="option1" class="ml-2 block text-sm text-text">
      Option 1
    </label>
  </div>
  <div class="flex items-center">
    <input 
      type="radio"
      id="option2"
      name="options"
      value="option2"
      class="h-4 w-4 text-primary focus:ring-primary border-surface-raised"
    >
    <label for="option2" class="ml-2 block text-sm text-text">
      Option 2
    </label>
  </div>
</div>
```

### 4.2 Buttons

Button states:

```html
<!-- Default state -->
<button class="px-4 py-2 rounded-md bg-primary text-white">
  Primary Action
</button>

<!-- Hover state -->
<button class="px-4 py-2 rounded-md bg-primary text-white
               hover:bg-primary-dark">
  Hover State
</button>

<!-- Focus state -->
<button class="px-4 py-2 rounded-md bg-primary text-white
               focus:outline-none focus:ring-2 focus:ring-primary-light focus:ring-offset-2">
  Focus State
</button>

<!-- Disabled state -->
<button class="px-4 py-2 rounded-md bg-primary/50 text-white cursor-not-allowed"
        disabled>
  Disabled State
</button>

<!-- Loading state -->
<button class="px-4 py-2 rounded-md bg-primary text-white
               inline-flex items-center">
  <svg class="animate-spin -ml-1 mr-2 h-4 w-4 text-white" fill="none" viewBox="0 0 24 24">
    <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
    <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
  </svg>
  Loading
</button>
```

### 4.3 Navigation

Horizontal navigation:

```html
<nav class="bg-surface shadow">
  <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
    <div class="flex justify-between h-16">
      <div class="flex">
        <div class="flex-shrink-0 flex items-center">
          <!-- Logo -->
          <img class="h-8 w-auto" src="/logo.svg" alt="Logo">
        </div>
        <div class="ml-6 flex space-x-8">
          <!-- Navigation items -->
          <a href="#" class="border-b-2 border-primary text-primary px-1 pt-1 inline-flex items-center text-sm font-medium">
            Home
          </a>
          <a href="#" class="border-b-2 border-transparent text-text-muted hover:text-text hover:border-text-muted px-1 pt-1 inline-flex items-center text-sm font-medium">
            Dashboard
          </a>
          <a href="#" class="border-b-2 border-transparent text-text-muted hover:text-text hover:border-text-muted px-1 pt-1 inline-flex items-center text-sm font-medium">
            Reports
          </a>
        </div>
      </div>
      <div class="flex items-center">
        <!-- User menu -->
      </div>
    </div>
  </div>
</nav>
```

Vertical navigation:

```html
<nav class="bg-surface shadow w-64 h-screen">
  <div class="p-4">
    <!-- Logo -->
    <div class="flex items-center mb-6">
      <img class="h-8 w-auto" src="/logo.svg" alt="Logo">
    </div>
    
    <!-- Navigation items -->
    <div class="space-y-1">
      <a href="#" class="bg-primary/10 text-primary group flex items-center px-2 py-2 text-sm font-medium rounded-md">
        <svg class="mr-3 h-5 w-5" fill="currentColor" viewBox="0 0 20 20"><!-- SVG path --></svg>
        Home
      </a>
      <a href="#" class="text-text-muted hover:bg-surface-raised hover:text-text group flex items-center px-2 py-2 text-sm font-medium rounded-md">
        <svg class="mr-3 h-5 w-5" fill="currentColor" viewBox="0 0 20 20"><!-- SVG path --></svg>
        Dashboard
      </a>
      <a href="#" class="text-text-muted hover:bg-surface-raised hover:text-text group flex items-center px-2 py-2 text-sm font-medium rounded-md">
        <svg class="mr-3 h-5 w-5" fill="currentColor" viewBox="0 0 20 20"><!-- SVG path --></svg>
        Reports
      </a>
    </div>
  </div>
</nav>
```

## 5. Responsive Patterns

### 5.1 Breakpoints

Use Tailwind's default breakpoints:

- `sm`: 640px
- `md`: 768px
- `lg`: 1024px
- `xl`: 1280px
- `2xl`: 1536px

### 5.2 Adaptive Layouts

Grid layouts:

```html
<!-- Responsive grid -->
<div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
  <!-- Items -->
</div>
```

Flex layouts:

```html
<!-- Responsive flex layout -->
<div class="flex flex-col sm:flex-row items-start gap-4">
  <!-- Sidebar -->
  <div class="w-full sm:w-64 bg-surface-raised p-4 rounded-lg">
    <!-- Sidebar content -->
  </div>
  
  <!-- Main content -->
  <div class="flex-1 w-full bg-surface p-4 rounded-lg">
    <!-- Main content -->
  </div>
</div>
```

### 5.3 Mobile-First Approach

Always start with mobile layout and enhance for larger screens:

```html
<!-- Mobile-first navigation -->
<nav class="bg-surface shadow">
  <!-- Mobile menu button -->
  <div class="flex items-center justify-between px-4 py-3 sm:hidden">
    <img class="h-8 w-auto" src="/logo.svg" alt="Logo">
    <button type="button" class="p-2 rounded-md text-text-muted hover:text-text">
      <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
        <!-- SVG path for menu icon -->
      </svg>
    </button>
  </div>
  
  <!-- Desktop navigation -->
  <div class="hidden sm:block">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
      <div class="flex justify-between h-16">
        <!-- Logo and nav items -->
      </div>
    </div>
  </div>
</nav>

<!-- Mobile-first card layout -->
<div class="space-y-4 sm:grid sm:grid-cols-2 sm:gap-6 sm:space-y-0 lg:grid-cols-3">
  <!-- Cards -->
</div>

## 6. Animation Guidelines

### 6.1 Transitions

Use consistent transition properties:

```html
<!-- Hover transition -->
<div class="transform transition-all duration-300
            hover:scale-105 hover:shadow-lg">
  <!-- Content -->
</div>

<!-- Button transition -->
<button class="px-4 py-2 rounded-md bg-primary text-white
               transition-colors duration-200
               hover:bg-primary-dark">
  Action
</button>

<!-- Menu transition -->
<div class="transition-opacity duration-300 ease-out
            opacity-0 group-hover:opacity-100">
  <!-- Menu content -->
</div>
```

### 6.2 Loading States

```html
<!-- Spinner -->
<div class="animate-spin h-5 w-5 text-primary">
  <svg viewBox="0 0 24 24" fill="none">
    <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
    <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
  </svg>
</div>

<!-- Skeleton loading state -->
<div class="animate-pulse space-y-4">
  <div class="h-12 bg-surface-raised rounded-md"></div>
  <div class="space-y-2">
    <div class="h-4 bg-surface-raised rounded w-5/6"></div>
    <div class="h-4 bg-surface-raised rounded w-4/6"></div>
    <div class="h-4 bg-surface-raised rounded w-3/6"></div>
  </div>
</div>

<!-- Loading button -->
<button class="px-4 py-2 rounded-md bg-primary text-white
               inline-flex items-center justify-center">
  <svg class="animate-spin -ml-1 mr-2 h-4 w-4 text-white" fill="none" viewBox="0 0 24 24">
    <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
    <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
  </svg>
  Processing...
</button>
```

## 7. Dark Mode Support

### 7.1 Color Adaptation

Use Tailwind's dark mode variants:

```html
<div class="bg-white dark:bg-gray-800
            text-gray-900 dark:text-gray-100">
  <!-- Content adapts to dark mode -->
</div>

<button class="px-4 py-2 rounded-md 
               bg-primary dark:bg-primary-light 
               text-white
               hover:bg-primary-dark dark:hover:bg-primary">
  Button
</button>

<div class="border border-surface-raised dark:border-surface-sunken 
            shadow-sm dark:shadow-none">
  <!-- Card adapts to dark mode -->
</div>
```

### 7.2 Implementation

Configure dark mode in Tailwind:

```javascript
// tailwind.config.js
module.exports = {
  darkMode: 'class', // or 'media' for system preference
  // ...
}
```

Adding dark mode toggle functionality:

```html
<button id="dark-mode-toggle" class="p-2 rounded-md text-text-muted hover:text-text">
  <!-- Sun icon for dark mode -->
  <svg class="hidden dark:block h-5 w-5" fill="currentColor" viewBox="0 0 20 20">
    <!-- Sun SVG path -->
  </svg>
  <!-- Moon icon for light mode -->
  <svg class="block dark:hidden h-5 w-5" fill="currentColor" viewBox="0 0 20 20">
    <!-- Moon SVG path -->
  </svg>
</button>
```

```javascript
// dark-mode.js
document.getElementById('dark-mode-toggle').addEventListener('click', () => {
  document.documentElement.classList.toggle('dark');
  localStorage.setItem('darkMode', document.documentElement.classList.contains('dark'));
});

// Check for saved preference
if (localStorage.getItem('darkMode') === 'true' || 
    (localStorage.getItem('darkMode') === null && 
     window.matchMedia('(prefers-color-scheme: dark)').matches)) {
  document.documentElement.classList.add('dark');
} else {
  document.documentElement.classList.remove('dark');
}
```

## 8. Accessibility Guidelines

### 8.1 Color Contrast

Ensure sufficient color contrast (WCAG AA minimum):

- Regular text: 4.5:1 contrast ratio
- Large text: 3:1 contrast ratio
- UI components and graphics: 3:1 contrast ratio

### 8.2 Focus States

Implement proper focus states:

```html
<!-- Accessible button with focus state -->
<button 
  class="px-4 py-2 rounded-md bg-primary text-white
         hover:bg-primary-dark
         focus:outline-none focus:ring-2 focus:ring-primary focus:ring-offset-2">
  Accessible Button
</button>

<!-- Accessible link with focus state -->
<a href="#"
   class="text-primary hover:text-primary-dark
          focus:outline-none focus:ring-2 focus:ring-primary rounded-md">
  Accessible Link
</a>
```

### 8.3 ARIA Attributes

Use proper ARIA attributes:

```html
<!-- Accessible Button -->
<button 
  aria-label="Delete item"
  class="p-2 rounded-full hover:bg-surface-raised
         focus:outline-none focus:ring-2 focus:ring-primary"
>
  <span class="sr-only">Delete</span>
  <!-- Icon -->
  <svg class="h-5 w-5" fill="currentColor" viewBox="0 0 20 20">
    <!-- SVG path -->
  </svg>
</button>

<!-- Navigation with current page indicator -->
<nav aria-label="Main Navigation">
  <ul class="flex space-x-4">
    <li>
      <a href="/" 
         class="text-primary" 
         aria-current="page">
        Home
      </a>
    </li>
    <li>
      <a href="/about" 
         class="text-text-muted hover:text-text">
        About
      </a>
    </li>
  </ul>
</nav>

<!-- Modal dialog -->
<div 
  role="dialog"
  aria-labelledby="modal-title"
  aria-modal="true"
  class="fixed inset-0 z-50 overflow-y-auto">
  <div class="bg-surface p-6 rounded-lg max-w-lg mx-auto">
    <h2 id="modal-title" class="text-xl font-semibold">Modal Title</h2>
    <!-- Modal content -->
  </div>
</div>
```

## 9. Tailwind CSS Practices

### 9.1 Configuration

Configure Tailwind to match your design system:

```javascript
// tailwind.config.js
module.exports = {
  theme: {
    extend: {
      colors: {
        primary: {
          DEFAULT: 'rgb(var(--color-primary) / <alpha-value>)',
          light: 'rgb(var(--color-primary-light) / <alpha-value>)',
          dark: 'rgb(var(--color-primary-dark) / <alpha-value>)',
        },
        // Other color definitions
      },
      fontFamily: {
        sans: ['Inter', 'sans-serif'],
      },
      boxShadow: {
        'card': '0 10px 15px -3px rgba(0, 0, 0, 0.05)',
        'button': '0 4px 6px -1px rgba(0, 0, 0, 0.1)'
      }
    }
  },
  plugins: [
    require('@tailwindcss/forms'),
    require('@tailwindcss/typography'),
    // Other plugins
  ]
}
```

### 9.2 Class Organization

Group related Tailwind classes together and organize in a consistent order:

1. Layout (position, display, visibility)
2. Box model (width, height, margin, padding)
3. Typography (font, text)
4. Visual styles (background, border, shadow)
5. Interactive states (hover, focus)

Example:

```html
<button 
  class="
    /* Layout */
    relative inline-flex items-center justify-center
    /* Box model */
    px-4 py-2 w-full sm:w-auto
    /* Typography */
    text-sm font-medium text-white
    /* Visual styles */
    bg-primary rounded-md shadow-sm
    /* Interactive states */
    hover:bg-primary-dark focus:outline-none focus:ring-2 focus:ring-primary focus:ring-offset-2
  "
>
  Button Text
</button>
```

### 9.3 Utility Usage

Extract repeated patterns using component classes or @apply directives:

```css
/* styles.css */
@layer components {
  .btn-primary {
    @apply px-4 py-2 bg-primary text-white rounded-lg font-medium
           hover:bg-primary-dark focus:outline-none focus:ring-2 focus:ring-primary focus:ring-offset-2;
  }
  
  .card {
    @apply bg-surface rounded-lg shadow-card p-4;
  }
  
  .form-input {
    @apply w-full px-3 py-2 rounded-md border border-surface-raised
           focus:ring-2 focus:ring-primary focus:border-primary;
  }
}
```

Usage:

```html
<button class="btn-primary">
  Primary Button
</button>

<div class="card">
  <h3 class="text-lg font-semibold mb-2">Card Title</h3>
  <p>Card content</p>
</div>

<input type="text" class="form-input">
```

## 10. Image Guidelines

### 10.1 Format Standards

- Use SVG for icons and simple illustrations
- Use WebP with JPEG/PNG fallbacks for photographs
- Use appropriate sizes and resolutions for different breakpoints

```html
<!-- Icon (SVG) -->
<svg class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
  <!-- SVG path -->
</svg>

<!-- Responsive image with srcset -->
<img 
  src="/images/photo-default.jpg" 
  srcset="/images/photo-small.jpg 400w,
          /images/photo-medium.jpg 800w,
          /images/photo-large.jpg 1200w"
  sizes="(max-width: 640px) 400px,
         (max-width: 1024px) 800px,
         1200px"
  alt="Description of the image"
  class="rounded-lg"
>
```

### 10.2 Optimization

- Compress all images appropriately
- Use lazy loading for off-screen images
- Consider using blur-up techniques for progressive loading

```html
<!-- Lazy loading -->
<img 
  src="/images/photo.jpg" 
  alt="Description" 
  loading="lazy"
  class="rounded-lg"
>

<!-- Blur-up placeholder -->
<div class="relative">
  <!-- Low-quality placeholder -->
  <img 
    src="/images/photo-placeholder.jpg" 
    alt="" 
    class="absolute inset-0 w-full h-full object-cover blur-sm"
  >
  <!-- Full quality image (loaded later) -->
  <img 
    src="/images/photo-full.jpg" 
    alt="Description" 
    loading="lazy"
    class="relative w-full h-full object-cover transition-opacity duration-500"
    onload="this.style.opacity='1'; this.previousElementSibling.style.opacity='0'"
    style="opacity: 0"
  >
</div>
```

## 11. JavaScript Component Structure

### 11.1 Organization

Organize JavaScript components with a consistent structure:

```javascript
// Component initialization
const initializeDropdown = () => {
    const dropdown = document.querySelector('[data-dropdown]');
    const trigger = dropdown.querySelector('[data-dropdown-trigger]');
    const menu = dropdown.querySelector('[data-dropdown-menu]');
    
    // Setup event listeners
    trigger.addEventListener('click', () => toggleDropdown(menu));
};

// Event handlers
const toggleDropdown = (menu) => {
    const expanded = menu.getAttribute('aria-expanded') === 'true';
    menu.setAttribute('aria-expanded', !expanded);
    menu.classList.toggle('hidden', expanded);
};

// Initialize components
document.addEventListener('DOMContentLoaded', () => {
    initializeDropdown();
    // Initialize other components
});
```

### 11.2 Event Handling

Use data attributes for JavaScript hooks:

```html
<!-- Dropdown component -->
<div data-dropdown class="relative">
  <button data-dropdown-trigger class="px-4 py-2 rounded-md bg-primary text-white">
    Dropdown
  </button>
  <div data-dropdown-menu class="hidden absolute mt-2 w-48 rounded-md shadow-lg bg-surface p-2" aria-expanded="false">
    <!-- Dropdown items -->
    <a href="#" class="block px-4 py-2 rounded-md hover:bg-surface-raised">
      Item 1
    </a>
    <a href="#" class="block px-4 py-2 rounded-md hover:bg-surface-raised">
      Item 2
    </a>
  </div>
</div>
```

JavaScript to handle events:

```javascript
document.querySelectorAll('[data-dropdown-trigger]').forEach(trigger => {
  trigger.addEventListener('click', (event) => {
    const menu = event.currentTarget.nextElementSibling;
    const expanded = menu.getAttribute('aria-expanded') === 'true';
    
    // Toggle dropdown
    menu.setAttribute('aria-expanded', !expanded);
    menu.classList.toggle('hidden', expanded);
    
    // Close when clicking outside
    if (!expanded) {
      const closeDropdown = (outsideClick) => {
        if (!event.currentTarget.contains(outsideClick.target)) {
          menu.classList.add('hidden');
          menu.setAttribute('aria-expanded', 'false');
          document.removeEventListener('click', closeDropdown);
        }
      };
      
      // Add event listener on next tick to avoid immediate closure
      setTimeout(() => {
        document.addEventListener('click', closeDropdown);
      }, 0);
    }
  });
});
```