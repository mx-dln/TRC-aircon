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
    <div id="contact" class="bg-gradient-to-br from-blue-50 to-white py-16">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center max-w-3xl mx-auto mb-12">
                <span class="inline-block px-3 py-1 text-sm font-semibold text-blue-700 bg-blue-100 rounded-full mb-4">Get In Touch</span>
                <h2 class="text-4xl font-bold text-gray-900 sm:text-5xl">
                    Let's Talk About Your Project
                </h2>
                <p class="mt-4 text-lg text-gray-600">
                    Fill out the form and our team will get back to you within 24 hours.
                </p>
            </div>

            <div class="bg-white rounded-2xl shadow-2xl overflow-hidden border border-gray-100">
                <div class="grid grid-cols-1 lg:grid-cols-2">
                    <!-- Map of Manila, Philippines -->
                    <div class="h-full min-h-[400px] lg:min-h-[600px] relative">
                        <iframe 
                            class="absolute inset-0 w-full h-full"
                            frameborder="0" 
                            style="border:0"
                            src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d123543.59131670194!2d120.93605800000001!3d14.554729!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3397ca03571ec38b%3A0x69d1d5751069c11f!2sManila%2C%20Metro%20Manila%2C%20Philippines!5e0!3m2!1sen!2sus!4v1620000000000!5m2!1sen!2sus"
                            allowfullscreen="" 
                            loading="lazy"
                            aria-hidden="false"
                            tabindex="0">
                        </iframe>
                        <div class="absolute bottom-0 left-0 right-0 bg-gradient-to-t from-black/80 to-transparent p-4">
                            <div class="text-white text-sm">
                                <p class="font-medium">Our Location</p>
                                <p>Manila, Philippines</p>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Contact Form -->
                    <div class="p-8 lg:p-12">
                        <h3 class="text-2xl font-bold text-gray-900 mb-2">Send us a message</h3>
                        <p class="text-gray-500 mb-8">We'll get back to you as soon as possible</p>
                        
                        <form id="contactForm" action="{{ route('contact.submit') }}" method="POST" class="space-y-6">
                            @csrf
                            <div id="formMessage" class="hidden p-4 mb-6 rounded-lg text-sm"></div>
                            
                            <div class="space-y-6">
                                <div class="grid grid-cols-1 gap-6 sm:grid-cols-2">
                                    <div>
                                        <label for="name" class="block text-sm font-medium text-gray-700 mb-1">Full Name <span class="text-red-500">*</span></label>
                                        <div class="relative">
                                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                                <svg class="h-5 w-5 text-gray-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                                    <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd" />
                                                </svg>
                                            </div>
                                            <input type="text" name="name" id="name" required
                                                class="block w-full pl-10 pr-3 py-3 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                                                placeholder="John Doe">
                                        </div>
                                    </div>
                                    
                                    <div>
                                        <label for="email" class="block text-sm font-medium text-gray-700 mb-1">Email Address <span class="text-red-500">*</span></label>
                                        <div class="relative">
                                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                                <svg class="h-5 w-5 text-gray-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                                    <path d="M2.003 5.884L10 9.882l7.997-3.998A2 2 0 0016 4H4a2 2 0 00-1.997 1.884z" />
                                                    <path d="M18 8.118l-8 4-8-4V14a2 2 0 002 2h12a2 2 0 002-2V8.118z" />
                                                </svg>
                                            </div>
                                            <input type="email" name="email" id="email" required
                                                class="block w-full pl-10 pr-3 py-3 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                                                placeholder="you@example.com">
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="grid grid-cols-1 gap-6 sm:grid-cols-2">
                                    <div>
                                        <label for="phone" class="block text-sm font-medium text-gray-700 mb-1">Phone Number</label>
                                        <div class="relative">
                                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                                <svg class="h-5 w-5 text-gray-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                                    <path d="M2 3a1 1 0 011-1h2.153a1 1 0 01.986.836l.74 4.435a1 1 0 01-.54 1.06l-1.548.773a11.037 11.037 0 006.105 6.105l.774-1.548a1 1 0 011.059-.54l4.435.74a1 1 0 01.836.986V17a1 1 0 01-1 1h-2C7.82 18 2 12.18 2 5V3z" />
                                                </svg>
                                            </div>
                                            <input type="tel" name="phone" id="phone"
                                                class="block w-full pl-10 pr-3 py-3 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                                                placeholder="+63 (XXX) XXX-XXXX">
                                        </div>
                                    </div>
                                    
                                    <div>
                                        <label for="subject" class="block text-sm font-medium text-gray-700 mb-1">Subject</label>
                                        <div class="relative">
                                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                                <svg class="h-5 w-5 text-gray-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                                    <path fill-rule="evenodd" d="M18 10c0 3.866-3.582 7-8 7a8.841 8.841 0 01-4.083-.98L2 17l1.338-3.123C2.493 12.767 2 11.434 2 10c0-3.866 3.582-7 8-7s8 3.134 8 7zM7 9H5v2h2V9zm8 0h-2v2h2V9zM9 9h2v2H9V9z" clip-rule="evenodd" />
                                                </svg>
                                            </div>
                                            <input type="text" name="subject" id="subject"
                                                class="block w-full pl-10 pr-3 py-3 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                                                placeholder="How can we help?">
                                        </div>
                                    </div>
                                </div>
                                
                                <div>
                                    <label for="message" class="block text-sm font-medium text-gray-700 mb-1">Your Message <span class="text-red-500">*</span></label>
                                    <div class="relative">
                                        <div class="absolute top-3 left-3">
                                            <svg class="h-5 w-5 text-gray-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                                <path d="M2.003 5.884L10 9.882l7.997-3.998A2 2 0 0016 4H4a2 2 0 00-1.997 1.884z" />
                                                <path d="M18 8.118l-8 4-8-4V14a2 2 0 002 2h12a2 2 0 002-2V8.118z" />
                                            </svg>
                                        </div>
                                        <textarea id="message" name="message" rows="4" required
                                            class="block w-full pl-10 pr-3 py-3 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                                            placeholder="Tell us about your project..."></textarea>
                                    </div>
                                </div>
                                
                                <div class="flex items-start">
                                    <div class="flex items-center h-5">
                                        <input id="privacy" name="privacy" type="checkbox" required
                                            class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300 rounded">
                                    </div>
                                    <div class="ml-3 text-sm">
                                        <label for="privacy" class="text-gray-700">
                                            I agree to the <a href="#" class="text-blue-600 hover:text-blue-500 font-medium">Privacy Policy</a>
                                        </label>
                                    </div>
                                </div>
                                
                                <div>
                                    <button type="submit"
                                        class="w-full flex justify-center py-4 px-6 border border-transparent rounded-lg shadow-sm text-lg font-medium text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-colors duration-200">
                                        Send Message
                                        <svg class="ml-2 -mr-1 h-5 w-5 text-white" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                            <path fill-rule="evenodd" d="M10.293 5.293a1 1 0 011.414 0l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414-1.414L12.586 11H5a1 1 0 110-2h7.586l-2.293-2.293a1 1 0 010-1.414z" clip-rule="evenodd" />
                                        </svg>
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @push('styles')
    <link href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css" rel="stylesheet">
    <style>
        /* Add some custom styles for the form */
        .form-input:focus {
            outline: none;
            ring: 2px;
            ring-color: #3b82f6;
            border-color: #3b82f6;
        }
        .form-input {
            transition: all 0.2s ease-in-out;
        }
    </style>
    @endpush
    @push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
    // Make sure jQuery is loaded
    if (typeof jQuery == 'undefined') {
        document.write('<script src="https://code.jquery.com/jquery-3.6.0.min.js"><\/script>');
    }
    // Wait for the DOM to be fully loaded
    document.addEventListener('DOMContentLoaded', function() {
        console.log('DOM fully loaded');
        
        // Get the form element
        const form = document.getElementById('contactForm');
        
        if (!form) {
            console.error('Contact form not found!');
            return;
        }
        
        console.log('Form found, setting up event listener');
        
        // Add submit event listener to the form
        form.addEventListener('submit', function(e) {
            // Prevent the default form submission
            e.preventDefault();
            console.log('Form submission started');
            
            // Get form elements
            const submitButton = this.querySelector('button[type="submit"]');
            const buttonText = submitButton ? submitButton.querySelector('#buttonText') : null;
            const spinner = submitButton ? submitButton.querySelector('#spinner') : null;
            const formMessage = document.getElementById('formMessage');
            
            if (!submitButton || !buttonText || !spinner) {
                console.error('Form elements not found:', {submitButton, buttonText, spinner});
                return;
            }
            
            // Show loading state
            submitButton.disabled = true;
            buttonText.textContent = 'Sending...';
            spinner.classList.remove('hidden');
            if (formMessage) formMessage.classList.add('hidden');
            
            // Get form data
            const formData = new FormData(this);
            
            // Use jQuery for AJAX to ensure compatibility
            $.ajax({
                url: $(this).attr('action'),
                type: 'POST',
                data: formData,
                processData: false,
                contentType: false,
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function(response) {
                    // Show success message
                    Swal.fire({
                        title: response.title || 'Success!',
                        text: response.message,
                        icon: 'success',
                        confirmButtonColor: '#3b82f6',
                        confirmButtonText: 'OK',
                        customClass: {
                            popup: 'rounded-xl',
                            confirmButton: 'px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white rounded-md font-medium transition-colors duration-200'
                        }
                    }).then(() => {
                        // Reset form after the user clicks OK
                        form.reset();
                    });
                },
                error: function(xhr) {
                    const errorMessage = xhr.responseJSON && xhr.responseJSON.message 
                        ? xhr.responseJSON.message 
                        : 'An error occurred. Please try again.';
                    
                    // Show error message
                    Swal.fire({
                        title: 'Error!',
                        text: errorMessage,
                        icon: 'error',
                        confirmButtonColor: '#ef4444',
                        confirmButtonText: 'OK',
                        customClass: {
                            popup: 'rounded-xl',
                            confirmButton: 'px-4 py-2 bg-red-600 hover:bg-red-700 text-white rounded-md font-medium transition-colors duration-200'
                        }
                    });
                },
                complete: function() {
                    // Reset button state
                    if (submitButton) {
                        submitButton.disabled = false;
                        if (buttonText) buttonText.textContent = 'Send Message';
                        if (spinner) spinner.classList.add('hidden');
                    }
                    
                    // Scroll to form message area
                    if (formMessage) {
                        formMessage.scrollIntoView({ behavior: 'smooth', block: 'nearest' });
                    }
                }
            });
        });
    });
    </script>
    @endpush
@endsection