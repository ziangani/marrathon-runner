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
                        {{ config('marathon.date') }}
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
                <div class="mt-16 text-white">
                    <div class="grid grid-cols-1 gap-6 sm:grid-cols-3">
                        <div class="bg-white bg-opacity-10 backdrop-filter backdrop-blur-lg rounded-xl p-6 shadow-lg transform transition-transform hover:scale-105">
                            <div class="flex items-center justify-center w-12 h-12 mx-auto mb-4 rounded-full bg-primary bg-opacity-30">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                </svg>
                            </div>
                            <div class="text-2xl font-bold">{{ config('marathon.date') }}</div>
                            <div class="text-white text-opacity-80">Event Date</div>
                        </div>
                        <div class="bg-white bg-opacity-10 backdrop-filter backdrop-blur-lg rounded-xl p-6 shadow-lg transform transition-transform hover:scale-105">
                            <div class="flex items-center justify-center w-12 h-12 mx-auto mb-4 rounded-full bg-primary bg-opacity-30">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                            </div>
                            <div class="text-2xl font-bold">{{ config('marathon.time') }}</div>
                            <div class="text-white text-opacity-80">Start Time</div>
                        </div>
                        <div class="bg-white bg-opacity-10 backdrop-filter backdrop-blur-lg rounded-xl p-6 shadow-lg transform transition-transform hover:scale-105">
                            <div class="flex items-center justify-center w-12 h-12 mx-auto mb-4 rounded-full bg-primary bg-opacity-30">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                                </svg>
                            </div>
                            <div class="text-2xl font-bold">{{ config('marathon.location') }}</div>
                            <div class="text-white text-opacity-80">Location</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Race Categories Section -->
    <section class="py-24 bg-background">
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

            <div class="mt-16 grid gap-8 grid-cols-1 md:grid-cols-2 lg:grid-cols-4">
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
                    
                    <div class="p-8">
                        <h3 class="text-2xl font-bold text-gray-900 group-hover:text-primary transition-colors">
                            {{ $category['name'] }}
                        </h3>
                        
                        <p class="mt-4 text-base text-gray-500 leading-relaxed">
                            {{ $category['description'] }}
                        </p>
                        
                        <div class="mt-8 flex items-center justify-between">
                            <span class="flex items-center px-4 py-2 rounded-full text-sm font-medium bg-primary bg-opacity-10 text-primary">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-12a1 1 0 10-2 0v4a1 1 0 00.293.707l2.828 2.829a1 1 0 101.415-1.415L11 9.586V6z" clip-rule="evenodd" />
                                </svg>
                                {{ $category['start_time'] }}
                            </span>
                            
                            <a href="{{ route('register', ['category' => $key]) }}" class="text-primary hover:text-primary-dark font-medium flex items-center">
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
    <section class="py-24 bg-white relative overflow-hidden">
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

            <div class="mt-16 grid gap-8 grid-cols-1 md:grid-cols-2 lg:grid-cols-3">
                @foreach(config('marathon.packages') as $key => $package)
                <div class="relative bg-white rounded-2xl shadow-xl overflow-hidden border border-gray-100 transform transition-all hover:-translate-y-2 hover:shadow-2xl">
                    <!-- Package header -->
                    <div class="p-8 bg-gradient-to-br from-primary to-secondary text-white">
                        <h3 class="text-2xl font-bold">{{ $package['name'] }}</h3>
                        <div class="mt-4 flex items-baseline">
                            <span class="text-5xl font-extrabold tracking-tight">K{{ $package['price'] }}</span>
                        </div>
                    </div>
                    
                    <!-- Package content -->
                    <div class="p-8">
                        <p class="text-gray-600">{{ $package['description'] }}</p>
                        
                        <!-- Features list (placeholder - customize based on actual package features) -->
                        <ul class="mt-6 space-y-4">
                            <li class="flex items-start">
                                <svg class="flex-shrink-0 h-6 w-6 text-green-500" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                                </svg>
                                <span class="ml-3 text-gray-500">Race entry</span>
                            </li>
                            <li class="flex items-start">
                                <svg class="flex-shrink-0 h-6 w-6 text-green-500" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                                </svg>
                                <span class="ml-3 text-gray-500">Official T-shirt</span>
                            </li>
                            <li class="flex items-start">
                                <svg class="flex-shrink-0 h-6 w-6 text-green-500" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                                </svg>
                                <span class="ml-3 text-gray-500">Finisher medal</span>
                            </li>
                        </ul>
                        
                        <div class="mt-8">
                            <a href="{{ route('register', ['package' => $key]) }}" class="block w-full bg-primary border border-transparent rounded-full py-3 px-6 text-center font-medium text-white hover:bg-primary-dark focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary transition-colors shadow-md">
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
    <section id="about" class="py-24 bg-background relative overflow-hidden">
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

            <div class="mt-16">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-12">
                    <div class="bg-white rounded-2xl shadow-xl p-8 transform transition-all hover:-translate-y-1 hover:shadow-2xl">
                        <div class="flex items-center mb-6">
                            <div class="flex items-center justify-center h-14 w-14 rounded-full bg-primary bg-opacity-10 text-primary">
                                <svg class="h-8 w-8" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z" />
                                </svg>
                            </div>
                            <h3 class="ml-4 text-xl font-bold text-gray-900">Our Mission</h3>
                        </div>
                        <p class="text-gray-600 leading-relaxed">
                            The Lusaka Water Security Initiative (LuWSI) aims to improve water security in Lusaka through collaborative action, sustainable water management, and community engagement.
                        </p>
                    </div>

                    <div class="bg-white rounded-2xl shadow-xl p-8 transform transition-all hover:-translate-y-1 hover:shadow-2xl">
                        <div class="flex items-center mb-6">
                            <div class="flex items-center justify-center h-14 w-14 rounded-full bg-primary bg-opacity-10 text-primary">
                                <svg class="h-8 w-8" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
                                </svg>
                            </div>
                            <h3 class="ml-4 text-xl font-bold text-gray-900">Community Impact</h3>
                        </div>
                        <p class="text-gray-600 leading-relaxed">
                            Your participation in the LuWSI Run directly contributes to projects that improve water access, quality, and management in communities across Zambia.
                        </p>
                    </div>

                    <div class="bg-white rounded-2xl shadow-xl p-8 transform transition-all hover:-translate-y-1 hover:shadow-2xl">
                        <div class="flex items-center mb-6">
                            <div class="flex items-center justify-center h-14 w-14 rounded-full bg-primary bg-opacity-10 text-primary">
                                <svg class="h-8 w-8" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3.055 11H5a2 2 0 012 2v1a2 2 0 002 2 2 2 0 012 2v2.945M8 3.935V5.5A2.5 2.5 0 0010.5 8h.5a2 2 0 012 2 2 2 0 104 0 2 2 0 012-2h1.064M15 20.488V18a2 2 0 012-2h3.064M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                            </div>
                            <h3 class="ml-4 text-xl font-bold text-gray-900">Sustainable Solutions</h3>
                        </div>
                        <p class="text-gray-600 leading-relaxed">
                            We focus on long-term, sustainable solutions to water challenges, including infrastructure development, conservation efforts, and education programs.
                        </p>
                    </div>

                    <div class="bg-white rounded-2xl shadow-xl p-8 transform transition-all hover:-translate-y-1 hover:shadow-2xl">
                        <div class="flex items-center mb-6">
                            <div class="flex items-center justify-center h-14 w-14 rounded-full bg-primary bg-opacity-10 text-primary">
                                <svg class="h-8 w-8" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 12a9 9 0 01-9 9m9-9a9 9 0 00-9-9m9 9H3m9 9a9 9 0 01-9-9m9 9c1.657 0 3-4.03 3-9s-1.343-9-3-9m0 18c-1.657 0-3-4.03-3-9s1.343-9 3-9m-9 9a9 9 0 019-9" />
                                </svg>
                            </div>
                            <h3 class="ml-4 text-xl font-bold text-gray-900">Global Collaboration</h3>
                        </div>
                        <p class="text-gray-600 leading-relaxed">
                            We work with local and international partners to leverage expertise, resources, and best practices in water security management.
                        </p>
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
