@extends('layouts.app')

@section('content')
    <!-- Hero Section with Gradient Overlay -->
    <div class="relative bg-blue-700 overflow-hidden">
        <!-- Gradient Overlay -->
        <div class="absolute inset-0 bg-gradient-to-r from-blue-700 to-blue-600 opacity-90"></div>
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
            <div class="relative z-20 pb-8 sm:pb-16 md:pb-20 lg:max-w-2xl lg:w-full lg:pb-28">
                <main class="mt-10 mx-auto max-w-7xl sm:mt-12 md:mt-16 lg:mt-20 xl:mt-28">
                    <div class="text-center lg:text-left">
                        <h1 class="text-4xl font-extrabold tracking-tight text-white sm:text-5xl md:text-6xl">
                            <span class="block">Professional Air Conditioning</span>
                            <span class="block text-blue-200">Services & Solutions</span>
                        </h1>
                        <p
                            class="mx-auto mt-3 max-w-md text-base text-blue-100 sm:text-lg md:mt-5 md:max-w-3xl md:text-xl lg:mx-0">
                            Expert installation, maintenance, and repair services for residential and commercial properties.
                        </p>
                        <div
                            class="mt-8 flex flex-col sm:flex-row sm:justify-center lg:justify-start space-y-3 sm:space-y-0 sm:space-x-4">
                            <div class="rounded-md shadow">
                                <a href="#contact"
                                    class="flex w-full items-center justify-center rounded-md border border-transparent bg-white px-8 py-3 text-base font-medium text-blue-700 hover:bg-blue-50 md:px-10 md:py-4 md:text-lg">
                                    Get a Free Quote
                                </a>
                            </div>
                            <div class="rounded-md shadow">
                                <a href="#services"
                                    class="flex w-full items-center justify-center rounded-md border border-transparent bg-blue-500 bg-opacity-60 px-8 py-3 text-base font-medium text-white hover:bg-opacity-70 md:px-10 md:py-4 md:text-lg">
                                    Our Services
                                </a>
                            </div>
                        </div>
                    </div>
                </main>
            </div>
        </div>
        <div class="relative h-64 sm:h-72 md:h-96 lg:absolute lg:right-0 lg:top-0 lg:h-full lg:w-1/2">
            <img src="{{ asset('images/hero.jpg') }}" alt="Professional Air Conditioning Services"
                class="h-full w-full object-cover"
                onerror="this.src='https://images.unsplash.com/photo-1551288049-bebda4e38f71?ixlib=rb-1.2.1&auto=format&fit=crop&w=1350&q=80'">
        </div>
    </div>

    <!-- Services Section -->
    <div id="services" class="py-16 bg-gray-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center">
                <h2 class="text-3xl font-extrabold text-gray-900 sm:text-4xl">
                    Our Services
                </h2>
                <p class="mt-4 text-xl text-gray-600">
                    Comprehensive air conditioning solutions for all your needs
                </p>
            </div>

            <div class="mt-16 grid gap-8 md:grid-cols-2 lg:grid-cols-3">
                <!-- Supply & Installation -->
                <div class="bg-white rounded-xl shadow-md overflow-hidden hover:shadow-lg transition-all duration-300 transform hover:-translate-y-1">
                    <div class="p-6">
                        <div class="flex items-center justify-center h-14 w-14 rounded-xl bg-blue-100 text-blue-600 mb-4">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-7 w-7" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6V4m0 2a2 2 0 100 4m0-4a2 2 0 110 4m-6 8a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4m6 6v10m6-2a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4" />
                            </svg>
                        </div>
                        <h3 class="text-xl font-semibold text-gray-900 mb-3">Supply & Installation</h3>
                        <p class="text-gray-600">Complete supply and professional installation of all types of air conditioning systems for residential and commercial properties.</p>
                    </div>
                </div>

                <!-- General Cleaning -->
                <div class="bg-white rounded-xl shadow-md overflow-hidden hover:shadow-lg transition-all duration-300 transform hover:-translate-y-1">
                    <div class="p-6">
                        <div class="flex items-center justify-center h-14 w-14 rounded-xl bg-green-100 text-green-600 mb-4">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-7 w-7" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
                            </svg>
                        </div>
                        <h3 class="text-xl font-semibold text-gray-900 mb-3">General Cleaning</h3>
                        <p class="text-gray-600">Thorough cleaning services to maintain optimal performance and air quality of your air conditioning units.</p>
                    </div>
                </div>

                <!-- Dismantling & Relocation -->
                <div class="bg-white rounded-xl shadow-md overflow-hidden hover:shadow-lg transition-all duration-300 transform hover:-translate-y-1">
                    <div class="p-6">
                        <div class="flex items-center justify-center h-14 w-14 rounded-xl bg-purple-100 text-purple-600 mb-4">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-7 w-7" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7h12m0 0l-4-4m4 4l-4 4m0 6H4m0 0l4 4m-4-4l4-4" />
                            </svg>
                        </div>
                        <h3 class="text-xl font-semibold text-gray-900 mb-3">Dismantling & Relocation</h3>
                        <p class="text-gray-600">Professional dismantling and safe relocation services for your air conditioning units to new locations.</p>
                    </div>
                </div>

                <!-- Repair & Maintenance -->
                <div class="bg-white rounded-xl shadow-md overflow-hidden hover:shadow-lg transition-all duration-300 transform hover:-translate-y-1">
                    <div class="p-6">
                        <div class="flex items-center justify-center h-14 w-14 rounded-xl bg-yellow-100 text-yellow-600 mb-4">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-7 w-7" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z" />
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                            </svg>
                        </div>
                        <h3 class="text-xl font-semibold text-gray-900 mb-3">Repair & Maintenance</h3>
                        <p class="text-gray-600">Comprehensive repair and maintenance services to keep your air conditioning systems running efficiently.</p>
                    </div>
                </div>

                <!-- Ducting Works -->
                <div class="bg-white rounded-xl shadow-md overflow-hidden hover:shadow-lg transition-all duration-300 transform hover:-translate-y-1">
                    <div class="p-6">
                        <div class="flex items-center justify-center h-14 w-14 rounded-xl bg-red-100 text-red-600 mb-4">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-7 w-7" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z" />
                            </svg>
                        </div>
                        <h3 class="text-xl font-semibold text-gray-900 mb-3">Ducting Works</h3>
                        <p class="text-gray-600">Expert installation and maintenance of ducting systems for efficient air distribution throughout your property.</p>
                    </div>
                </div>

                <!-- Design -->
                <div class="bg-white rounded-xl shadow-md overflow-hidden hover:shadow-lg transition-all duration-300 transform hover:-translate-y-1">
                    <div class="p-6">
                        <div class="flex items-center justify-center h-14 w-14 rounded-xl bg-indigo-100 text-indigo-600 mb-4">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-7 w-7" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 4a2 2 0 114 0v1h1.5a1.5 1.5 0 011.5 1.5v1.5H5V6.5A1.5 1.5 0 016.5 5H8V4a2 2 0 013-1.732V4z" />
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 9v10a2 2 0 002 2h12a2 2 0 002-2V9M4 9h16" />
                            </svg>
                        </div>
                        <h3 class="text-xl font-semibold text-gray-900 mb-3">Design</h3>
                        <p class="text-gray-600">Custom air conditioning system design services tailored to your specific requirements and space constraints.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Featured Projects -->
    @if(isset($featuredProjects) && $featuredProjects->count() > 0)
        <div id="projects" class="py-12 bg-gray-50">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="text-center">
                    <h2 class="text-3xl font-extrabold text-gray-900 sm:text-4xl">
                        Featured Projects
                    </h2>
                    <p class="mt-4 text-xl text-gray-600">
                        Check out some of our recent work
                    </p>
                </div>

                <div class="mt-10 grid gap-5 max-w-lg mx-auto lg:grid-cols-3 lg:max-w-none">
                    @foreach($featuredProjects as $project)
                        <div class="flex flex-col rounded-lg shadow-lg overflow-hidden">
                            @if($project->progress_images && count($project->progress_images) > 0)
                                <div class="flex-shrink-0">
                                    <img class="h-48 w-full object-cover" src="{{ asset('storage/' . $project->progress_images[0]) }}"
                                        alt="{{ $project->client_name }}">
                                </div>
                            @endif
                            <div class="flex-1 bg-white p-6 flex flex-col justify-between">
                                <div class="flex-1">
                                    <p class="text-sm font-medium text-blue-600">
                                        {{ $project->progress }}% Complete
                                    </p>
                                    <a href="#" class="block mt-2">
                                        <p class="text-xl font-semibold text-gray-900">{{ $project->client_name }}</p>
                                        <p class="mt-3 text-base text-gray-500">{{ $project->address }}</p>
                                    </a>
                                </div>
                                <div class="mt-6 flex items-center">
                                    <div class="w-full bg-gray-200 rounded-full h-2.5">
                                        <div class="bg-blue-600 h-2.5 rounded-full" style="width: {{ $project->progress }}%"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    @endif

    <!-- About Section -->
    <div id="about" class="py-12 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="lg:text-center">
                <h2 class="text-3xl font-extrabold text-gray-900 sm:text-4xl">
                    About Us
                </h2>
                <p class="mt-4 max-w-2xl text-xl text-gray-600 lg:mx-auto">
                    Trusted air conditioning experts serving the community for over 10 years.
                </p>
            </div>

            <div class="mt-10">
                <div class="space-y-10 md:space-y-0 md:grid md:grid-cols-2 md:gap-x-8 md:gap-y-10">
                    <div>
                        <h3 class="text-lg leading-6 font-medium text-gray-900">Our Mission</h3>
                        <p class="mt-2 text-base text-gray-600">
                            To provide top-quality air conditioning services with honesty, integrity, and exceptional
                            customer service.
                        </p>
                    </div>
                    <div>
                        <h3 class="text-lg leading-6 font-medium text-gray-900">Our Values</h3>
                        <ul class="mt-2 text-base text-gray-600 list-disc pl-5 space-y-1">
                            <li>Customer satisfaction is our top priority</li>
                            <li>Quality workmanship in every job</li>
                            <li>Transparent pricing and honest advice</li>
                            <li>Continuous training and improvement</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Contact Section -->
    <div id="contact" class="bg-gray-50 py-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="lg:text-center mb-10">
                <h2 class="text-3xl font-extrabold text-gray-900 sm:text-4xl">
                    Contact Us
                </h2>
                <p class="mt-4 max-w-2xl text-xl text-gray-600 lg:mx-auto">
                    Get in touch for a free consultation or quote
                </p>
            </div>

            <div class="bg-white shadow-xl rounded-xl overflow-hidden">
                <div class="grid grid-cols-1 lg:grid-cols-2">
                    <!-- Map Section -->
                    <div class="h-96 lg:h-auto">
                        <iframe 
                            src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3861.635654120113!2d120.98421931503525!3d14.599340789825763!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3397ca03571ec38b%3A0x69d1d5751069c11f!2sManila%2C%20Metro%20Manila%2C%20Philippines!5e0!3m2!1sen!2sus!4v1633023223456!5m2!1sen!2sus" 
                            width="100%" 
                            height="100%" 
                            style="border:0;" 
                            allowfullscreen="" 
                            loading="lazy"
                            title="Our Location in Manila, Philippines">
                        </iframe>
                    </div>

                    <!-- Contact Form -->
                    <div class="p-8">
                        <h3 class="text-2xl font-semibold text-gray-900 mb-6">Send us a message</h3>
                        <form action="#" method="POST" class="space-y-6">
                            <div class="grid grid-cols-1 gap-y-6 gap-x-4 sm:grid-cols-6">
                                <div class="sm:col-span-3">
                                    <label for="first-name" class="block text-sm font-medium text-gray-700">First name</label>
                                    <input type="text" name="first-name" id="first-name" autocomplete="given-name"
                                        class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                                </div>

                                <div class="sm:col-span-3">
                                    <label for="last-name" class="block text-sm font-medium text-gray-700">Last name</label>
                                    <input type="text" name="last-name" id="last-name" autocomplete="family-name"
                                    class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                            </div>

                            <div class="sm:col-span-4">
                                <label for="email" class="block text-sm font-medium text-gray-700">Email address</label>
                                <input type="email" name="email" id="email" autocomplete="email"
                                    class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                            </div>

                            <div class="sm:col-span-4">
                                <label for="phone" class="block text-sm font-medium text-gray-700">Phone number</label>
                                <input type="text" name="phone" id="phone" autocomplete="tel"
                                    class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                            </div>

                            <div class="sm:col-span-6">
                                <label for="message" class="block text-sm font-medium text-gray-700">Message</label>
                                <div class="mt-1">
                                    <textarea id="message" name="message" rows="4"
                                        class="shadow-sm focus:ring-blue-500 focus:border-blue-500 block w-full sm:text-sm border border-gray-300 rounded-md"></textarea>
                                </div>
                            </div>
                        </div>

                        <div class="flex justify-end">
                            <button type="submit"
                                class="ml-3 inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                                Send Message
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection