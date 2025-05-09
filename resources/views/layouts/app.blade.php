<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Meta Tags -->
    <title>{{ config('marathon.meta.title', config('marathon.name').' - '.config('app.name')) }} - @yield('title', 'Marathon Registration')</title>
    <meta name="description" content="{{ config('marathon.meta.description') }}">
    <meta name="keywords" content="{{ config('marathon.meta.keywords') }}">
    <meta name="author" content="{{ config('marathon.meta.author') }}">

    <!-- Open Graph / Social Media Meta Tags -->
    <meta property="og:title" content="{{ config('marathon.meta.title') }}">
    <meta property="og:description" content="{{ config('marathon.meta.description') }}">
    <meta property="og:image" content="{{ config('marathon.meta.image') }}">
    <meta property="og:url" content="{{ url()->current() }}">
    <meta name="twitter:card" content="summary_large_image">

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Tailwind CSS via CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        primary: '#33A9E0', // LuWSI logo blue
                        secondary: '#3D3F94', // Dark blue/navy
                        accent: '#FFFFFF', // White
                        background: '#F5F8FF', // Light blue/off-white
                    }
                }
            },
            plugins: [
                function({ addUtilities }) {
                    const newUtilities = {
                        '.line-clamp-1': {
                            overflow: 'hidden',
                            display: '-webkit-box',
                            '-webkit-box-orient': 'vertical',
                            '-webkit-line-clamp': '1',
                        },
                        '.line-clamp-2': {
                            overflow: 'hidden',
                            display: '-webkit-box',
                            '-webkit-box-orient': 'vertical',
                            '-webkit-line-clamp': '2',
                        },
                        '.line-clamp-3': {
                            overflow: 'hidden',
                            display: '-webkit-box',
                            '-webkit-box-orient': 'vertical',
                            '-webkit-line-clamp': '3',
                        },
                        '.line-clamp-none': {
                            '-webkit-line-clamp': 'unset',
                        },
                    }
                    addUtilities(newUtilities, ['responsive', 'hover'])
                }
            ]
        }
    </script>
</head>
<body class="font-sans antialiased bg-background text-gray-900">
    <header class="bg-white shadow">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex justify-between h-20">
                    <div class="flex">
                        <div class="flex-shrink-0 flex items-center">
                            <!-- Logo -->
                            <a href="{{ route('home') }}" class="text-primary font-bold text-xl group">
                                <img src="{{ asset('img/logo.png') }}" alt="{{ config('marathon.name') }} Logo" class="h-10 w-auto transition-transform duration-300 group-hover:scale-105">
                            </a>
                        </div>
                    </div>
                    <div class="flex items-center">
                        <nav class="hidden md:flex items-center space-x-1 lg:space-x-2">
                            @php
                                $currentRoute = Route::currentRouteName();
                            @endphp
                            <a href="{{ route('home') }}" class="nav-link {{ $currentRoute == 'home' ? 'active' : '' }}">
                                <span>Home</span>
                            </a>
                            <a href="{{ route('register') }}" class="nav-link {{ $currentRoute == 'register' ? 'active' : '' }}">
                                <span>Register</span>
                            </a>
                            <a href="{{ route('home') }}#about" class="nav-link {{ request()->is('*#about') ? 'active' : '' }}">
                                <span>About</span>
                            </a>
                            <a href="{{ route('home') }}#contact" class="nav-link {{ request()->is('*#contact') ? 'active' : '' }}">
                                <span>Contact</span>
                            </a>
                        </nav>
                    <!-- Mobile menu button -->
                    <div class="md:hidden flex items-center">
                        <button type="button" class="mobile-menu-button inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-gray-500 hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-inset focus:ring-primary">
                            <span class="sr-only">Open main menu</span>
                            <!-- Icon when menu is closed -->
                            <svg class="block h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                            </svg>
                        </button>
                    </div>
                </div>
            </div>

            <!-- Mobile menu, show/hide based on menu state -->
            <div class="mobile-menu hidden md:hidden">
                <div class="px-2 pt-2 pb-3 space-y-1 sm:px-3">
                    <a href="{{ route('home') }}" class="block px-3 py-2 rounded-md text-base font-medium text-gray-700 hover:text-gray-900 hover:bg-gray-50">Home</a>
                    <a href="{{ route('register') }}" class="block px-3 py-2 rounded-md text-base font-medium text-gray-700 hover:text-gray-900 hover:bg-gray-50">Register</a>
                    <a href="{{ route('home') }}#about" class="block px-3 py-2 rounded-md text-base font-medium text-gray-700 hover:text-gray-900 hover:bg-gray-50">About</a>
                    <a href="{{ route('home') }}#contact" class="block px-3 py-2 rounded-md text-base font-medium text-gray-700 hover:text-gray-900 hover:bg-gray-50">Contact</a>
                </div>
            </div>
        </div>
    </header>

    <main>
        @yield('content')
    </main>

    <footer class="bg-secondary text-white py-8">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex flex-col md:flex-row justify-between items-center">
                    <div class="mb-6 md:mb-0">
                        <h3 class="text-xl font-bold">{{ config('marathon.name') }}</h3>
                        <p class="text-gray-300 mt-2">{{ config('marathon.tagline') }}</p>
                    </div>

                    <div class="flex flex-wrap justify-center gap-x-8 gap-y-2 mb-6 md:mb-0">
                        <a href="{{ route('home') }}" class="text-gray-300 hover:text-white transition-colors">Home</a>
                        <a href="{{ route('register') }}" class="text-gray-300 hover:text-white transition-colors">Register</a>
                        <a href="#about" class="text-gray-300 hover:text-white transition-colors">About</a>
                        <a href="#contact" class="text-gray-300 hover:text-white transition-colors">Contact</a>
                    </div>

                    <div class="flex space-x-4">
                        @if(config('marathon.social.facebook'))
                        <a href="{{ config('marathon.social.facebook') }}" target="_blank" class="text-gray-300 hover:text-white transition-colors">
                            <span class="sr-only">Facebook</span>
                            <svg class="h-6 w-6" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                                <path fill-rule="evenodd" d="M22 12c0-5.523-4.477-10-10-10S2 6.477 2 12c0 4.991 3.657 9.128 8.438 9.878v-6.987h-2.54V12h2.54V9.797c0-2.506 1.492-3.89 3.777-3.89 1.094 0 2.238.195 2.238.195v2.46h-1.26c-1.243 0-1.63.771-1.63 1.562V12h2.773l-.443 2.89h-2.33v6.988C18.343 21.128 22 16.991 22 12z" clip-rule="evenodd" />
                            </svg>
                        </a>
                        @endif
                        @if(config('marathon.social.twitter'))
                        <a href="{{ config('marathon.social.twitter') }}" target="_blank" class="text-gray-300 hover:text-white transition-colors">
                            <span class="sr-only">Twitter</span>
                            <svg class="h-6 w-6" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                                <path d="M8.29 20.251c7.547 0 11.675-6.253 11.675-11.675 0-.178 0-.355-.012-.53A8.348 8.348 0 0022 5.92a8.19 8.19 0 01-2.357.646 4.118 4.118 0 001.804-2.27 8.224 8.224 0 01-2.605.996 4.107 4.107 0 00-6.993 3.743 11.65 11.65 0 01-8.457-4.287 4.106 4.106 0 001.27 5.477A4.072 4.072 0 012.8 9.713v.052a4.105 4.105 0 003.292 4.022 4.095 4.095 0 01-1.853.07 4.108 4.108 0 003.834 2.85A8.233 8.233 0 012 18.407a11.616 11.616 0 006.29 1.84" />
                            </svg>
                        </a>
                        @endif
                        @if(config('marathon.social.instagram'))
                        <a href="{{ config('marathon.social.instagram') }}" target="_blank" class="text-gray-300 hover:text-white transition-colors">
                            <span class="sr-only">Instagram</span>
                            <svg class="h-6 w-6" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                                <path fill-rule="evenodd" d="M12.315 2c2.43 0 2.784.013 3.808.06 1.064.049 1.791.218 2.427.465a4.902 4.902 0 011.772 1.153 4.902 4.902 0 011.153 1.772c.247.636.416 1.363.465 2.427.048 1.067.06 1.407.06 4.123v.08c0 2.643-.012 2.987-.06 4.043-.049 1.064-.218 1.791-.465 2.427a4.902 4.902 0 01-1.153 1.772 4.902 4.902 0 01-1.772 1.153c-.636.247-1.363.416-2.427.465-1.067.048-1.407.06-4.123.06h-.08c-2.643 0-2.987-.012-4.043-.06-1.064-.049-1.791-.218-2.427-.465a4.902 4.902 0 01-1.772-1.153 4.902 4.902 0 01-1.153-1.772c-.247-.636-.416-1.363-.465-2.427-.047-1.024-.06-1.379-.06-3.808v-.63c0-2.43.013-2.784.06-3.808.049-1.064.218-1.791.465-2.427a4.902 4.902 0 011.153-1.772A4.902 4.902 0 015.45 2.525c.636-.247 1.363-.416 2.427-.465C8.901 2.013 9.256 2 11.685 2h.63zm-.081 1.802h-.468c-2.456 0-2.784.011-3.807.058-.975.045-1.504.207-1.857.344-.467.182-.8.398-1.15.748-.35.35-.566.683-.748 1.15-.137.353-.3.882-.344 1.857-.047 1.023-.058 1.351-.058 3.807v.468c0 2.456.011 2.784.058 3.807.045.975.207 1.504.344 1.857.182.466.399.8.748 1.15.35.35.683.566 1.15.748.353.137.882.3 1.857.344 1.054.048 1.37.058 4.041.058h.08c2.597 0 2.917-.01 3.96-.058.976-.045 1.505-.207 1.858-.344.466-.182.8-.398 1.15-.748.35-.35.566-.683.748-1.15.137-.353.3-.882.344-1.857.048-1.055.058-1.37.058-4.041v-.08c0-2.597-.01-2.917-.058-3.96-.045-.976-.207-1.505-.344-1.858a3.097 3.097 0 00-.748-1.15 3.098 3.098 0 00-1.15-.748c-.353-.137-.882-.3-1.857-.344-1.023-.047-1.351-.058-3.807-.058zM12 6.865a5.135 5.135 0 110 10.27 5.135 5.135 0 010-10.27zm0 1.802a3.333 3.333 0 100 6.666 3.333 3.333 0 000-6.666zm5.338-3.205a1.2 1.2 0 110 2.4 1.2 1.2 0 010-2.4z" clip-rule="evenodd" />
                            </svg>
                        </a>
                        @endif
                    </div>
                </div>

                <div class="mt-6 pt-6 border-t border-gray-700 text-center text-gray-400">
                    <p>&copy; {{ date('Y') }} {{ config('marathon.name') }}. All rights reserved.</p>
                </div>
            </div>
        </footer>

    <!-- Navigation styles -->
        <style>
            .nav-link {
                position: relative;
                display: inline-flex;
                align-items: center;
                padding: 0.75rem 1rem;
                font-size: 1rem;
                font-weight: 500;
                color: #4B5563; /* text-gray-600 */
                border-radius: 0.375rem;
                transition: all 0.3s ease;
                margin: 0 0.25rem;
            }
            
            .nav-link:hover {
                color: #33A9E0; /* primary */
                background-color: rgba(51, 169, 224, 0.05);
            }
            
            .nav-link::after {
                content: '';
                position: absolute;
                bottom: 0;
                left: 50%;
                width: 0;
                height: 3px;
                background-color: #33A9E0; /* primary */
                transition: all 0.3s ease;
                transform: translateX(-50%);
                opacity: 0;
            }
            
            .nav-link:hover::after {
                width: 30%;
                opacity: 0.7;
            }
            
            .nav-link.active {
                color: #33A9E0; /* primary */
                font-weight: 600;
            }
            
            .nav-link.active::after {
                width: 60%;
                opacity: 1;
            }
        </style>
    
        <!-- Mobile menu toggle script -->
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                const mobileMenuButton = document.querySelector('.mobile-menu-button');
                const mobileMenu = document.querySelector('.mobile-menu');
    
                if (mobileMenuButton && mobileMenu) {
                    mobileMenuButton.addEventListener('click', function() {
                        mobileMenu.classList.toggle('hidden');
                    });
                }
                
                // Add active class to nav links based on URL hash
                function setActiveNavLink() {
                    const hash = window.location.hash;
                    if (hash) {
                        const navLinks = document.querySelectorAll('.nav-link');
                        navLinks.forEach(link => {
                            link.classList.remove('active');
                            if (link.getAttribute('href').includes(hash)) {
                                link.classList.add('active');
                            }
                        });
                    }
                }
                
                // Set active nav link on page load and hash change
                setActiveNavLink();
                window.addEventListener('hashchange', setActiveNavLink);
            
            // Countdown Timer
            function updateCountdown() {
                const eventDate = new Date('{{ config('marathon.date') }}T{{ substr(config('marathon.time'), 0, 5) }}:00');
                const now = new Date();
                const diff = eventDate - now;
                
                if (diff <= 0) {
                    // Event has passed
                    const daysElement = document.getElementById('countdown-days');
                    const hoursElement = document.getElementById('countdown-hours');
                    const minutesElement = document.getElementById('countdown-minutes');
                    const secondsElement = document.getElementById('countdown-seconds');
                    
                    if (daysElement) daysElement.textContent = '0';
                    if (hoursElement) hoursElement.textContent = '0';
                    if (minutesElement) minutesElement.textContent = '0';
                    if (secondsElement) secondsElement.textContent = '0';
                    return;
                }
                
                // Calculate days, hours, minutes, seconds
                const days = Math.floor(diff / (1000 * 60 * 60 * 24));
                const hours = Math.floor((diff % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
                const minutes = Math.floor((diff % (1000 * 60 * 60)) / (1000 * 60));
                const seconds = Math.floor((diff % (1000 * 60)) / 1000);
                
                // Update the DOM if elements exist
                if (document.getElementById('countdown-days')) {
                    document.getElementById('countdown-days').textContent = days;
                    document.getElementById('countdown-hours').textContent = hours.toString().padStart(2, '0');
                    document.getElementById('countdown-minutes').textContent = minutes.toString().padStart(2, '0');
                    document.getElementById('countdown-seconds').textContent = seconds.toString().padStart(2, '0');
                }
            }
            
            // Initialize countdown
            if (document.getElementById('countdown-days')) {
                updateCountdown();
                // Update every second
                setInterval(updateCountdown, 1000);
            }
            
            // Category tabs functionality
            const categoryTabs = document.querySelectorAll('.category-tab');
            const categoryContents = document.querySelectorAll('.category-content');
            
            categoryTabs.forEach(tab => {
                tab.addEventListener('click', () => {
                    // Remove active class from all tabs
                    categoryTabs.forEach(t => {
                        t.classList.remove('border-primary', 'text-primary');
                        t.classList.add('border-transparent', 'text-gray-500');
                    });
                    
                    // Add active class to clicked tab
                    tab.classList.remove('border-transparent', 'text-gray-500');
                    tab.classList.add('border-primary', 'text-primary');
                    
                    // Hide all content sections
                    categoryContents.forEach(content => {
                        content.classList.add('hidden');
                    });
                    
                    // Show selected content
                    const categoryId = tab.getAttribute('data-category');
                    document.getElementById('category-' + categoryId)?.classList.remove('hidden');
                });
            });
            
            // Read more functionality for About section
            const readMoreMission = document.getElementById('read-more-mission');
            const readMoreSolutions = document.getElementById('read-more-solutions');
            
            if (readMoreMission) {
                readMoreMission.addEventListener('click', function() {
                    const content = this.previousElementSibling;
                    
                    if (content.classList.contains('line-clamp-3')) {
                        content.classList.remove('line-clamp-3');
                        this.innerHTML = 'Read less <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 ml-1" viewBox="0 0 20 20" fill="currentColor"><path fill-rule="evenodd" d="M14.707 12.707a1 1 0 01-1.414 0L10 9.414l-3.293 3.293a1 1 0 01-1.414-1.414l4-4a1 1 0 011.414 0l4 4a1 1 0 010 1.414z" clip-rule="evenodd" /></svg>';
                    } else {
                        content.classList.add('line-clamp-3');
                        this.innerHTML = 'Read more <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 ml-1" viewBox="0 0 20 20" fill="currentColor"><path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" /></svg>';
                    }
                });
            }
            
            if (readMoreSolutions) {
                readMoreSolutions.addEventListener('click', function() {
                    const content = this.previousElementSibling;
                    
                    if (content.classList.contains('line-clamp-3')) {
                        content.classList.remove('line-clamp-3');
                        this.innerHTML = 'Read less <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 ml-1" viewBox="0 0 20 20" fill="currentColor"><path fill-rule="evenodd" d="M14.707 12.707a1 1 0 01-1.414 0L10 9.414l-3.293 3.293a1 1 0 01-1.414-1.414l4-4a1 1 0 011.414 0l4 4a1 1 0 010 1.414z" clip-rule="evenodd" /></svg>';
                    } else {
                        content.classList.add('line-clamp-3');
                        this.innerHTML = 'Read more <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 ml-1" viewBox="0 0 20 20" fill="currentColor"><path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" /></svg>';
                    }
                });
            }
        });
    </script>
</body>
</html>
