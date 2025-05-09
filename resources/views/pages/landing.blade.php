@extends('layouts.app')

@section('title', 'Home')

@section('content')
    <!-- Hero Section -->
    <section class="relative bg-primary">
        <div class="absolute inset-0 bg-gradient-to-r from-primary to-secondary opacity-90"></div>
        <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-24 md:py-32">
            <div class="text-center">
                <h1 class="text-4xl md:text-5xl font-extrabold text-white tracking-tight">
                    {{ config('marathon.name') }}
                </h1>
                <p class="mt-3 max-w-md mx-auto text-xl text-white sm:text-2xl">
                    {{ config('marathon.tagline') }}
                </p>
                <div class="mt-6 flex justify-center space-x-4">
                    <div class="inline-flex rounded-md shadow">
                        <a href="{{ route('register') }}" class="inline-flex items-center justify-center px-5 py-3 border border-transparent text-base font-medium rounded-md text-primary bg-white hover:bg-gray-50">
                            Register Now
                        </a>
                    </div>
                    <div class="inline-flex">
                        <a href="#about" class="inline-flex items-center justify-center px-5 py-3 border border-transparent text-base font-medium rounded-md text-white bg-secondary hover:bg-opacity-90">
                            Learn More
                        </a>
                    </div>
                </div>
                <div class="mt-8 text-white">
                    <div class="grid grid-cols-1 gap-4 sm:grid-cols-3">
                        <div class="bg-white bg-opacity-20 backdrop-filter backdrop-blur-lg rounded-lg p-4">
                            <div class="text-2xl font-bold">{{ config('marathon.date') }}</div>
                            <div>Event Date</div>
                        </div>
                        <div class="bg-white bg-opacity-20 backdrop-filter backdrop-blur-lg rounded-lg p-4">
                            <div class="text-2xl font-bold">{{ config('marathon.time') }}</div>
                            <div>Start Time</div>
                        </div>
                        <div class="bg-white bg-opacity-20 backdrop-filter backdrop-blur-lg rounded-lg p-4">
                            <div class="text-2xl font-bold">{{ config('marathon.location') }}</div>
                            <div>Location</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Race Categories Section -->
    <section class="py-16 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center">
                <h2 class="text-3xl font-extrabold text-gray-900 sm:text-4xl">
                    Race Categories
                </h2>
                <p class="mt-3 max-w-2xl mx-auto text-xl text-gray-500 sm:mt-4">
                    Choose from multiple race categories suitable for all fitness levels.
                </p>
            </div>

            <div class="mt-12 grid gap-8 grid-cols-1 md:grid-cols-2 lg:grid-cols-4">
                @foreach(config('marathon.categories') as $key => $category)
                <div class="flex flex-col rounded-lg shadow-lg overflow-hidden">
                    <div class="flex-1 bg-white p-6 flex flex-col justify-between">
                        <div class="flex-1">
                            <h3 class="text-xl font-semibold text-gray-900">
                                {{ $category['name'] }}
                            </h3>
                            <p class="mt-3 text-base text-gray-500">
                                {{ $category['description'] }}
                            </p>
                        </div>
                        <div class="mt-6 flex items-center">
                            <div class="flex-shrink-0">
                                <span class="inline-flex items-center px-3 py-0.5 rounded-full text-sm font-medium bg-primary text-white">
                                    {{ $category['start_time'] }}
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </section>

    <!-- Pricing Section -->
    <section class="py-16 bg-gray-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center">
                <h2 class="text-3xl font-extrabold text-gray-900 sm:text-4xl">
                    Registration Packages
                </h2>
                <p class="mt-3 max-w-2xl mx-auto text-xl text-gray-500 sm:mt-4">
                    Select the package that works best for you or your team.
                </p>
            </div>

            <div class="mt-12 space-y-4 sm:mt-16 sm:space-y-0 sm:grid sm:grid-cols-2 sm:gap-6 lg:max-w-4xl lg:mx-auto xl:max-w-none xl:grid-cols-3">
                @foreach(config('marathon.packages') as $key => $package)
                <div class="bg-white border border-gray-200 rounded-lg shadow-sm divide-y divide-gray-200">
                    <div class="p-6">
                        <h3 class="text-lg font-medium text-gray-900">{{ $package['name'] }}</h3>
                        <p class="mt-4 text-sm text-gray-500">{{ $package['description'] }}</p>
                        <p class="mt-8">
                            <span class="text-4xl font-extrabold text-gray-900">K{{ $package['price'] }}</span>
                        </p>
                        <a href="{{ route('register', ['package' => $key]) }}" class="mt-8 block w-full bg-primary border border-transparent rounded-md py-2 text-sm font-semibold text-white text-center hover:bg-primary-dark">
                            Register
                        </a>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </section>

    <!-- About Section -->
    <section id="about" class="py-16 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="lg:text-center">
                <h2 class="text-base text-primary font-semibold tracking-wide uppercase">About</h2>
                <p class="mt-2 text-3xl leading-8 font-extrabold tracking-tight text-gray-900 sm:text-4xl">
                    Water Security in Zambia
                </p>
                <p class="mt-4 max-w-2xl text-xl text-gray-500 lg:mx-auto">
                    Learn about our mission to improve water security in Zambia and how your participation helps.
                </p>
            </div>

            <div class="mt-10">
                <div class="space-y-10 md:space-y-0 md:grid md:grid-cols-2 md:gap-x-8 md:gap-y-10">
                    <div class="relative">
                        <div class="absolute flex items-center justify-center h-12 w-12 rounded-md bg-primary text-white">
                            <svg class="h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z" />
                            </svg>
                        </div>
                        <div class="ml-16">
                            <h3 class="text-lg font-medium text-gray-900">Our Mission</h3>
                            <p class="mt-2 text-base text-gray-500">
                                The Lusaka Water Security Initiative (LuWSI) aims to improve water security in Lusaka through collaborative action, sustainable water management, and community engagement.
                            </p>
                        </div>
                    </div>

                    <div class="relative">
                        <div class="absolute flex items-center justify-center h-12 w-12 rounded-md bg-primary text-white">
                            <svg class="h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
                            </svg>
                        </div>
                        <div class="ml-16">
                            <h3 class="text-lg font-medium text-gray-900">Community Impact</h3>
                            <p class="mt-2 text-base text-gray-500">
                                Your participation in the LuWSI Run directly contributes to projects that improve water access, quality, and management in communities across Zambia.
                            </p>
                        </div>
                    </div>

                    <div class="relative">
                        <div class="absolute flex items-center justify-center h-12 w-12 rounded-md bg-primary text-white">
                            <svg class="h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3.055 11H5a2 2 0 012 2v1a2 2 0 002 2 2 2 0 012 2v2.945M8 3.935V5.5A2.5 2.5 0 0010.5 8h.5a2 2 0 012 2 2 2 0 104 0 2 2 0 012-2h1.064M15 20.488V18a2 2 0 012-2h3.064M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                        </div>
                        <div class="ml-16">
                            <h3 class="text-lg font-medium text-gray-900">Sustainable Solutions</h3>
                            <p class="mt-2 text-base text-gray-500">
                                We focus on long-term, sustainable solutions to water challenges, including infrastructure development, conservation efforts, and education programs.
                            </p>
                        </div>
                    </div>

                    <div class="relative">
                        <div class="absolute flex items-center justify-center h-12 w-12 rounded-md bg-primary text-white">
                            <svg class="h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 12a9 9 0 01-9 9m9-9a9 9 0 00-9-9m9 9H3m9 9a9 9 0 01-9-9m9 9c1.657 0 3-4.03 3-9s-1.343-9-3-9m0 18c-1.657 0-3-4.03-3-9s1.343-9 3-9m-9 9a9 9 0 019-9" />
                            </svg>
                        </div>
                        <div class="ml-16">
                            <h3 class="text-lg font-medium text-gray-900">Global Collaboration</h3>
                            <p class="mt-2 text-base text-gray-500">
                                We work with local and international partners to leverage expertise, resources, and best practices in water security management.
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- CTA Section -->
    <section class="bg-primary">
        <div class="max-w-7xl mx-auto py-12 px-4 sm:px-6 lg:py-16 lg:px-8 lg:flex lg:items-center lg:justify-between">
            <h2 class="text-3xl font-extrabold tracking-tight text-white sm:text-4xl">
                <span class="block">Ready to join the run?</span>
                <span class="block text-secondary">Register today and make a difference.</span>
            </h2>
            <div class="mt-8 flex lg:mt-0 lg:flex-shrink-0">
                <div class="inline-flex rounded-md shadow">
                    <a href="{{ route('register') }}" class="inline-flex items-center justify-center px-5 py-3 border border-transparent text-base font-medium rounded-md text-primary bg-white hover:bg-gray-50">
                        Register Now
                    </a>
                </div>
            </div>
        </div>
    </section>
@endsection
