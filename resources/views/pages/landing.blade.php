@extends('layouts.app')

@section('title', 'Home')

@section('content')
    <!-- Hero Section -->
    <section class="relative overflow-hidden">
        <!-- Water-themed background with wave pattern -->
        <div class="absolute inset-0 bg-gradient-to-br from-primary to-secondary">
            <div class="absolute inset-0 opacity-10">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 320" class="absolute bottom-0 w-full">
                    <path fill="rgba(255,255,255,0.3)" d="M0,192L48,176C96,160,192,128,288,133.3C384,139,480,181,576,186.7C672,192,768,160,864,154.7C960,149,1056,171,1152,165.3C1248,160,1344,128,1392,112L1440,96L1440,320L1392,320C1344,320,1248,320,1152,320C1056,320,960,320,864,320C768,320,672,320,576,320C480,320,384,320,288,320C192,320,96,320,48,320L0,320Z"></path>
                </svg>
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 320" class="absolute bottom-0 w-full opacity-50">
                    <path fill="rgba(255,255,255,0.2)" d="M0,256L48,240C96,224,192,192,288,197.3C384,203,480,245,576,250.7C672,256,768,224,864,218.7C960,213,1056,235,1152,229.3C1248,224,1344,192,1392,176L1440,160L1440,320L1392,320C1344,320,1248,320,1152,320C1056,320,960,320,864,320C768,320,672,320,576,320C480,320,384,320,288,320C192,320,96,320,48,320L0,320Z"></path>
                </svg>
            </div>
        </div>
        
        <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-24 md:py-36">
            <div class="text-center">
                <div class="inline-block mb-6 p-2 bg-white bg-opacity-20 backdrop-filter backdrop-blur-lg rounded-full">
                    <span class="px-4 py-1 text-sm font-medium text-white bg-secondary rounded-full">
                        {{ date('F j, Y', strtotime(config('marathon.date'))) }}
                    </span>
                </div>
                
                <h1 class="text-4xl md:text-6xl font-extrabold text-white tracking-tight leading-tight">
                    {{ config('marathon.name') }}
                </h1>
                
                <p class="mt-6 max-w-xl mx-auto text-xl text-white sm:text-2xl leading-relaxed">
                    {{ config('marathon.tagline') }}
                </p>
                
                <div class="mt-10 flex flex-col sm:flex-row justify-center gap-4">
                    <a href="{{ route('register') }}" class="inline-flex items-center justify-center px-6 py-4 border border-transparent text-base font-medium rounded-full text-primary bg-white shadow-lg hover:bg-gray-50 transform transition-transform hover:scale-105 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-11a1 1 0 10-2 0v2H7a1 1 0 100 2h2v2a1 1 0 102 0v-2h2a1 1 0 100-2h-2V7z" clip-rule="evenodd" />
                        </svg>
                        Register Now
                    </a>
                    <a href="#about" class="inline-flex items-center justify-center px-6 py-4 border border-white text-base font-medium rounded-full text-white bg-transparent hover:bg-white hover:bg-opacity-10 transform transition-transform hover:scale-105 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-white">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2h2a1 1 0 100-2H9z" clip-rule="evenodd" />
                        </svg>
                        Learn More
                    </a>
                </div>
                <!-- Countdown Timer -->
                <div class="mt-12 text-white">
                    <h2 class="text-xl font-semibold mb-4">Race Day Countdown</h2>
                    <div class="grid grid-cols-4 gap-3 max-w-lg mx-auto">
                        <div class="bg-white bg-opacity-10 backdrop-filter backdrop-blur-lg rounded-xl p-4 shadow-lg">
                            <div id="countdown-days" class="text-3xl font-bold">--</div>
                            <div class="text-white text-opacity-80 text-sm">Days</div>
                        </div>
                        <div class="bg-white bg-opacity-10 backdrop-filter backdrop-blur-lg rounded-xl p-4 shadow-lg">
                            <div id="countdown-hours" class="text-3xl font-bold">--</div>
                            <div class="text-white text-opacity-80 text-sm">Hours</div>
                        </div>
                        <div class="bg-white bg-opacity-10 backdrop-filter backdrop-blur-lg rounded-xl p-4 shadow-lg">
                            <div id="countdown-minutes" class="text-3xl font-bold">--</div>
                            <div class="text-white text-opacity-80 text-sm">Minutes</div>
                        </div>
                        <div class="bg-white bg-opacity-10 backdrop-filter backdrop-blur-lg rounded-xl p-4 shadow-lg">
                            <div id="countdown-seconds" class="text-3xl font-bold">--</div>
                            <div class="text-white text-opacity-80 text-sm">Seconds</div>
                        </div>
                    </div>
                    
                    <div class="mt-6 flex justify-center space-x-8">
                        <div class="flex items-center">
                            <div class="flex items-center justify-center w-10 h-10 rounded-full bg-primary bg-opacity-30 mr-3">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                            </div>
                            <div class="text-left">
                                <div class="text-sm text-white text-opacity-80">Start Time</div>
                                <div class="text-lg font-semibold">{{ config('marathon.time') }}</div>
                            </div>
                        </div>
                        <div class="flex items-center">
                            <div class="flex items-center justify-center w-10 h-10 rounded-full bg-primary bg-opacity-30 mr-3">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                                </svg>
                            </div>
                            <div class="text-left">
                                <div class="text-sm text-white text-opacity-80">Location</div>
                                <div class="text-lg font-semibold">{{ config('marathon.location') }}</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Race Categories Section -->
    <section class="py-16 bg-background">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center">
                <span class="inline-block px-3 py-1 text-sm font-medium text-primary bg-primary bg-opacity-10 rounded-full">
                    For All Fitness Levels
                </span>
                <h2 class="mt-4 text-3xl font-extrabold text-gray-900 sm:text-5xl">
                    Race Categories
                </h2>
                <div class="mt-4 max-w-2xl mx-auto">
                    <p class="text-xl text-gray-500">
                        Choose from multiple race categories suitable for all fitness levels.
                    </p>
                </div>
            </div>

            <div class="mt-12 grid gap-6 grid-cols-1 md:grid-cols-2 lg:grid-cols-4">
                @foreach(config('marathon.categories') as $key => $category)
                <div class="group relative bg-white rounded-2xl shadow-xl overflow-hidden transform transition-all hover:-translate-y-2 hover:shadow-2xl">
                    <!-- Category color indicator -->
                    <div class="absolute top-0 inset-x-0 h-1 bg-primary"></div>
                    
                    <!-- Category icon (placeholder, you can customize based on category) -->
                    <div class="absolute top-4 right-4 w-10 h-10 rounded-full bg-primary bg-opacity-10 flex items-center justify-center">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-primary" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-8.707l-3-3a1 1 0 00-1.414 0l-3 3a1 1 0 001.414 1.414L9 9.414V13a1 1 0 102 0V9.414l1.293 1.293a1 1 0 001.414-1.414z" clip-rule="evenodd" />
                        </svg>
                    </div>
                    
                    <div class="p-6">
                        <h3 class="text-xl font-bold text-gray-900 group-hover:text-primary transition-colors">
                            {{ $category['name'] }}
                        </h3>
                        
                        <p class="mt-3 text-sm text-gray-500 leading-relaxed">
                            {{ $category['description'] }}
                        </p>
                        
                        <div class="mt-6 flex items-center justify-between">
                            <span class="flex items-center px-3 py-1 rounded-full text-xs font-medium bg-primary bg-opacity-10 text-primary">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3 mr-1" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-12a1 1 0 10-2 0v4a1 1 0 00.293.707l2.828 2.829a1 1 0 101.415-1.415L11 9.586V6z" clip-rule="evenodd" />
                                </svg>
                                {{ $category['start_time'] }}
                            </span>
                            
                            <a href="{{ route('register', ['category' => $key]) }}" class="text-primary hover:text-primary-dark font-medium text-sm flex items-center">
                                Register
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 ml-1 group-hover:translate-x-1 transition-transform" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" d="M10.293 5.293a1 1 0 011.414 0l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414-1.414L12.586 11H5a1 1 0 110-2h7.586l-2.293-2.293a1 1 0 010-1.414z" clip-rule="evenodd" />
                                </svg>
                            </a>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </section>

    <!-- Pricing Section -->
    <section class="py-16 bg-white relative overflow-hidden">
        <!-- Background decoration -->
        <div class="absolute right-0 top-0 -mt-16 -mr-16 w-64 h-64 rounded-full bg-primary opacity-5"></div>
        <div class="absolute left-0 bottom-0 -mb-16 -ml-16 w-80 h-80 rounded-full bg-secondary opacity-5"></div>
        
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative">
            <div class="text-center">
                <span class="inline-block px-3 py-1 text-sm font-medium text-secondary bg-secondary bg-opacity-10 rounded-full">
                    Pricing Options
                </span>
                <h2 class="mt-4 text-3xl font-extrabold text-gray-900 sm:text-5xl">
                    Registration Packages
                </h2>
                <div class="mt-4 max-w-2xl mx-auto">
                    <p class="text-xl text-gray-500">
                        Select the package that works best for you or your team.
                    </p>
                </div>
            </div>

            <div class="mt-12 grid gap-6 grid-cols-1 md:grid-cols-3">
                @foreach(config('marathon.packages') as $key => $package)
                <div class="relative bg-white rounded-2xl shadow-xl overflow-hidden border border-gray-100 transform transition-all hover:-translate-y-2 hover:shadow-2xl">
                    <!-- Package header -->
                    <div class="p-6 bg-gradient-to-br from-primary to-secondary text-white">
                        <h3 class="text-xl font-bold">{{ $package['name'] }}</h3>
                        <div class="mt-2 flex items-baseline">
                            <span class="text-4xl font-extrabold tracking-tight">K{{ $package['price'] }}</span>
                        </div>
                    </div>
                    
                    <!-- Package content -->
                    <div class="p-6">
                        <p class="text-gray-600 text-sm">{{ $package['description'] }}</p>
                        
                        <!-- Features list -->
                        <ul class="mt-4 space-y-2">
                            <li class="flex items-start">
                                <svg class="flex-shrink-0 h-5 w-5 text-green-500" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                                </svg>
                                <span class="ml-3 text-sm text-gray-500">Race entry</span>
                            </li>
                            <li class="flex items-start">
                                <svg class="flex-shrink-0 h-5 w-5 text-green-500" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                                </svg>
                                <span class="ml-3 text-sm text-gray-500">Official T-shirt</span>
                            </li>
                            <li class="flex items-start">
                                <svg class="flex-shrink-0 h-5 w-5 text-green-500" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                                </svg>
                                <span class="ml-3 text-sm text-gray-500">Finisher medal</span>
                            </li>
                        </ul>
                        
                        <div class="mt-6">
                            <a href="{{ route('register', ['package' => $key]) }}" class="block w-full bg-primary border border-transparent rounded-full py-2 px-4 text-center font-medium text-white hover:bg-primary-dark focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary transition-colors shadow-md">
                                Register Now
                            </a>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </section>

    <!-- About Section -->
    <section id="about" class="py-16 bg-background relative overflow-hidden">
        <!-- Water-themed decorative elements -->
        <div class="absolute top-0 right-0 w-1/3 h-1/3 bg-primary opacity-5 rounded-full -mr-16 -mt-16"></div>
        <div class="absolute bottom-0 left-0 w-1/4 h-1/4 bg-secondary opacity-5 rounded-full -ml-16 -mb-16"></div>
        
        <!-- Water droplet SVG decoration -->
        <div class="absolute top-1/4 right-10 opacity-10">
            <svg xmlns="http://www.w3.org/2000/svg" width="120" height="120" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1" stroke-linecap="round" stroke-linejoin="round" class="text-primary">
                <path d="M12 2.69l5.66 5.66a8 8 0 1 1-11.31 0z"></path>
            </svg>
        </div>
        
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative">
            <div class="text-center">
                <span class="inline-block px-3 py-1 text-sm font-medium text-primary bg-primary bg-opacity-10 rounded-full">
                    Our Mission
                </span>
                <h2 class="mt-4 text-3xl font-extrabold text-gray-900 sm:text-5xl">
                    Water Security in Zambia
                </h2>
                <div class="mt-4 max-w-2xl mx-auto">
                    <p class="text-xl text-gray-500">
                        Learn about our mission to improve water security in Zambia and how your participation helps.
                    </p>
                </div>
            </div>

            <div class="mt-12">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                    <div class="bg-white rounded-2xl shadow-xl p-6 transform transition-all hover:-translate-y-1 hover:shadow-2xl">
                        <div class="flex items-center mb-4">
                            <div class="flex items-center justify-center h-12 w-12 rounded-full bg-primary bg-opacity-10 text-primary">
                                <svg class="h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z" />
                                </svg>
                            </div>
                            <h3 class="ml-4 text-lg font-bold text-gray-900">Our Mission & Impact</h3>
                        </div>
                        <p class="text-gray-600 text-sm leading-relaxed line-clamp-3">
                            The Lusaka Water Security Initiative (LuWSI) improves water security through collaborative action and sustainable management. Your participation directly contributes to projects that improve water access, quality, and management in communities across Zambia.
                        </p>
                        <div class="mt-4">
                            <button class="text-primary text-sm font-medium flex items-center" id="read-more-mission">
                                Read more
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 ml-1" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                </svg>
                            </button>
                        </div>
                    </div>

                    <div class="bg-white rounded-2xl shadow-xl p-6 transform transition-all hover:-translate-y-1 hover:shadow-2xl">
                        <div class="flex items-center mb-4">
                            <div class="flex items-center justify-center h-12 w-12 rounded-full bg-primary bg-opacity-10 text-primary">
                                <svg class="h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3.055 11H5a2 2 0 012 2v1a2 2 0 002 2 2 2 0 012 2v2.945M8 3.935V5.5A2.5 2.5 0 0010.5 8h.5a2 2 0 012 2 2 2 0 104 0 2 2 0 012-2h1.064M15 20.488V18a2 2 0 012-2h3.064M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                            </div>
                            <h3 class="ml-4 text-lg font-bold text-gray-900">Solutions & Partnerships</h3>
                        </div>
                        <p class="text-gray-600 text-sm leading-relaxed line-clamp-3">
                            We focus on long-term, sustainable solutions to water challenges, including infrastructure development, conservation efforts, and education programs. We work with local and international partners to leverage expertise, resources, and best practices in water security management.
                        </p>
                        <div class="mt-4">
                            <button class="text-primary text-sm font-medium flex items-center" id="read-more-solutions">
                                Read more
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 ml-1" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                </svg>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- CTA Section -->
    <section class="relative overflow-hidden">
        <!-- Background with gradient and wave pattern -->
        <div class="absolute inset-0 bg-gradient-to-br from-primary to-secondary">
            <div class="absolute inset-0 opacity-10">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 320" class="absolute bottom-0 w-full">
                    <path fill="rgba(255,255,255,0.3)" d="M0,192L48,176C96,160,192,128,288,133.3C384,139,480,181,576,186.7C672,192,768,160,864,154.7C960,149,1056,171,1152,165.3C1248,160,1344,128,1392,112L1440,96L1440,320L1392,320C1344,320,1248,320,1152,320C1056,320,960,320,864,320C768,320,672,320,576,320C480,320,384,320,288,320C192,320,96,320,48,320L0,320Z"></path>
                </svg>
            </div>
        </div>
        
        <div class="relative max-w-7xl mx-auto py-16 px-4 sm:py-24 sm:px-6 lg:px-8">
            <div class="bg-white bg-opacity-10 backdrop-filter backdrop-blur-lg rounded-3xl p-8 md:p-12 shadow-2xl">
                <div class="lg:grid lg:grid-cols-2 lg:gap-8 items-center">
                    <div>
                        <h2 class="text-3xl font-extrabold tracking-tight text-white sm:text-4xl">
                            <span class="block">Ready to join the run?</span>
                            <span class="block text-white opacity-90">Register today and make a difference.</span>
                        </h2>
                        <p class="mt-4 text-lg text-white text-opacity-80 max-w-md">
                            Join hundreds of runners supporting water security initiatives in Zambia. Every step you take helps create a sustainable future.
                        </p>
                        
                        <div class="mt-8 flex flex-col sm:flex-row gap-4">
                            <a href="{{ route('register') }}" class="inline-flex items-center justify-center px-6 py-4 border border-transparent text-base font-medium rounded-full text-primary bg-white shadow-lg hover:bg-gray-50 transform transition-transform hover:scale-105 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-11a1 1 0 10-2 0v2H7a1 1 0 100 2h2v2a1 1 0 102 0v-2h2a1 1 0 100-2h-2V7z" clip-rule="evenodd" />
                                </svg>
                                Register Now
                            </a>
                            <a href="#contact" class="inline-flex items-center justify-center px-6 py-4 border border-white text-base font-medium rounded-full text-white hover:bg-white hover:bg-opacity-10 transform transition-transform hover:scale-105 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-white">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" viewBox="0 0 20 20" fill="currentColor">
                                    <path d="M2 3a1 1 0 011-1h2.153a1 1 0 01.986.836l.74 4.435a1 1 0 01-.54 1.06l-1.548.773a11.037 11.037 0 006.105 6.105l.774-1.548a1 1 0 011.059-.54l4.435.74a1 1 0 01.836.986V17a1 1 0 01-1 1h-2C7.82 18 2 12.18 2 5V3z" />
                                </svg>
                                Contact Us
                            </a>
                        </div>
                    </div>
                    
                    <div class="mt-10 lg:mt-0 flex justify-center">
                        <!-- Decorative image or icon -->
                        <div class="relative w-72 h-72 rounded-full bg-white bg-opacity-20 flex items-center justify-center">
                            <div class="absolute inset-0 rounded-full border-4 border-white border-opacity-20 animate-pulse"></div>
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-32 w-32 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8" />
                            </svg>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
