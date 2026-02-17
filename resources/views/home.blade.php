@extends('layouts.app')

@section('content')
    <!-- Hero Section with Gradient Overlay -->
    <div class="h-screen relative bg-gradient-to-r from-cyan-800 to-cyan-700 overflow-hidden">
        <!-- Gradient Overlay -->
        <div class="absolute inset-0 bg-gradient-to-br from-cyan-900/40 via-cyan-800/20 to-transparent opacity-90"></div>

        <!-- Animated background elements -->
        <div class="absolute top-0 right-0 w-96 h-96 bg-cyan-600 rounded-full blur-3xl opacity-10 animate-pulse"></div>
        <div class="absolute bottom-0 left-0 w-72 h-72 bg-blue-600 rounded-full blur-3xl opacity-10 animate-pulse delay-1000"></div>

        <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 h-full flex items-center">
            <div class="relative z-20 w-full grid grid-cols-1 lg:grid-cols-2 gap-8 lg:gap-12 items-center">
                <!-- Content -->
                <div class="flex flex-col justify-center">
                    <div class="space-y-6">
                        <!-- Badge -->
                        <div class="inline-flex items-center space-x-2 bg-cyan-500/20 px-4 py-2 rounded-full w-fit border border-cyan-400/30">
                            <span class="w-2 h-2 bg-cyan-300 rounded-full animate-pulse"></span>
                            <span class="text-sm font-medium text-cyan-100">Trusted by 500+ clients</span>
                        </div>

                        <!-- Main Heading -->
                        <div class="space-y-3">
                            <h1 class="text-4xl sm:text-5xl lg:text-6xl font-bold tracking-tight text-white leading-tight">
                                <span class="block">Professional</span>
                                <span class="block">Air Conditioning</span>
                                <span class="block text-cyan-300">Solutions</span>
                            </h1>
                        </div>

                        <!-- Description -->
                        <p class="text-lg sm:text-xl text-cyan-50 max-w-md leading-relaxed">
                            Expert installation, maintenance, and repair services for residential and commercial properties. 10+ years of trusted service excellence.
                        </p>

                        <!-- CTA Buttons -->
                        <div class="flex flex-col sm:flex-row gap-4 pt-4">
                            <a href="#about" class="inline-flex items-center justify-center px-16 py-4 bg-white text-cyan-700 font-semibold rounded-lg hover:bg-cyan-50 transition-all duration-300 shadow-lg hover:shadow-xl transform hover:scale-105">
                                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path>
                                </svg>
                                About Us
                            </a>
                            <a href="#services" class="inline-flex items-center justify-center px-8 py-4 bg-cyan-600/80 hover:bg-cyan-600 text-white font-semibold rounded-lg transition-all duration-300 backdrop-blur-sm border border-cyan-400/30 hover:border-cyan-300/50">
                                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 13l-4 4m0 0l-4-4m4 4V3"></path>
                                </svg>
                                Explore Services
                            </a>
                        </div>

                        <!-- Trust badges -->
                        <div class="flex items-center space-x-6 pt-6 border-t border-cyan-400/20">
                            <div class="flex items-center space-x-2">
                                <svg class="w-5 h-5 text-cyan-300" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M6.267 3.455a3.066 3.066 0 001.745-.723 3.066 3.066 0 013.976 0 3.066 3.066 0 001.745.723 3.066 3.066 0 012.812 2.812c.051.643.304 1.254.723 1.745a3.066 3.066 0 010 3.976 3.066 3.066 0 00-.723 1.745 3.066 3.066 0 01-2.812 2.812 3.066 3.066 0 00-1.745.723 3.066 3.066 0 01-3.976 0 3.066 3.066 0 00-1.745-.723 3.066 3.066 0 01-2.812-2.812 3.066 3.066 0 00-.723-1.745 3.066 3.066 0 010-3.976 3.066 3.066 0 00.723-1.745 3.066 3.066 0 012.812-2.812zm7.44 5.252a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
                                </svg>
                                <span class="text-sm text-cyan-100">Licensed & Insured</span>
                            </div>
                            <div class="flex items-center space-x-2">
                                <svg class="w-5 h-5 text-cyan-300" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M6.267 3.455a3.066 3.066 0 001.745-.723 3.066 3.066 0 013.976 0 3.066 3.066 0 001.745.723 3.066 3.066 0 012.812 2.812c.051.643.304 1.254.723 1.745a3.066 3.066 0 010 3.976 3.066 3.066 0 00-.723 1.745 3.066 3.066 0 01-2.812 2.812 3.066 3.066 0 00-1.745.723 3.066 3.066 0 01-3.976 0 3.066 3.066 0 00-1.745-.723 3.066 3.066 0 01-2.812-2.812 3.066 3.066 0 00-.723-1.745 3.066 3.066 0 010-3.976 3.066 3.066 0 00.723-1.745 3.066 3.066 0 012.812-2.812zm7.44 5.252a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
                                </svg>
                                <span class="text-sm text-cyan-100">24/7 Support</span>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Image -->
                <div class="relative h-96 lg:h-full min-h-[400px] hidden lg:block">
                    <div class="absolute inset-0 bg-gradient-to-br from-cyan-400/10 to-transparent rounded-2xl"></div>
                    <img src="{{ asset('images/hero.jpg') }}"
                         alt="Professional Air Conditioning Services"
                         class="w-full h-full object-cover rounded-2xl shadow-2xl"
                         onerror="this.src='https://images.unsplash.com/photo-1551288049-bebda4e38f71?ixlib=rb-1.2.1&auto=format&fit=crop&w=1350&q=80'">
                    <!-- Overlay gradient -->
                    <div class="absolute inset-0 bg-gradient-to-t from-cyan-900/40 to-transparent rounded-2xl"></div>
                </div>
            </div>
        </div>
    </div>

    <!-- Services Section -->
    <div id="services" class="py-24 bg-gray-50">
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
                @forelse($services as $service)
                    <div class="bg-white rounded-xl shadow-md overflow-hidden hover:shadow-lg transition-all duration-300 transform hover:-translate-y-1" data-service-id="{{ $service->id }}">
                        <!-- Video Thumbnail Section -->
                        @if($service->video_type)
                            <div class="relative bg-gray-900 h-40 overflow-hidden cursor-pointer group" onclick="openVideoModal({{ $service->id }}, '{{ addslashes($service->name) }}', '{{ addslashes($service->getVideoEmbedUrl()) }}', '{{ $service->video_type }}')">
                                @if($service->video_type === 'file')
                                    <video class="w-full h-full object-cover">
                                        <source src="{{ asset("storage/{$service->video_file}") }}" type="video/mp4">
                                    </video>
                                @else
                                    @php
                                        $videoUrl = $service->video_url;
                                        $videoId = '';
                                        if (preg_match('/(?:youtube\.com\/watch\?v=|youtu\.be\/)([a-zA-Z0-9_-]+)/', $videoUrl, $matches)) {
                                            $videoId = $matches[1];
                                        }
                                    @endphp
                                    <img src="https://img.youtube.com/vi/{{ $videoId }}/mqdefault.jpg" alt="{{ $service->name }}" class="w-full h-full object-cover" />
                                @endif
                                <div class="absolute inset-0 bg-black bg-opacity-40 group-hover:bg-opacity-60 transition-all flex items-center justify-center">
                                    <svg class="w-16 h-16 text-white opacity-75 group-hover:opacity-100 transform group-hover:scale-110 transition-transform" fill="currentColor" viewBox="0 0 20 20">
                                        <path d="M6.3 2.841A1.5 1.5 0 004 4.11V15.89a1.5 1.5 0 002.3 1.269l9.344-5.89a1.5 1.5 0 000-2.538L6.3 2.84z"/>
                                    </svg>
                                </div>
                            </div>
                        @endif

                        <div class="p-6">
                            <div class="flex items-center justify-center h-14 w-14 rounded-xl bg-{{ $service->color }}-100 text-{{ $service->color }}-600 mb-4">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-7 w-7" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                </svg>
                            </div>
                            <h3 class="text-xl font-semibold text-gray-900 mb-3">{{ $service->name }}</h3>
                            <p class="text-gray-600">{{ $service->description }}</p>
                        </div>
                    </div>
                @empty
                    <div class="md:col-span-2 lg:col-span-3 text-center py-8">
                        <p class="text-gray-600">No services available at the moment.</p>
                    </div>
                @endforelse
            </div>
        </div>
    </div>

    <!-- Video Modal -->
    <div id="videoModal" class="hidden fixed inset-0 bg-black bg-opacity-75 z-50 flex items-center justify-center p-4">
        <div class="bg-black rounded-lg max-w-4xl w-full max-h-screen overflow-y-auto">
            <div class="flex justify-between items-center p-4 border-b border-gray-700">
                <h3 id="modalTitle" class="text-white text-xl font-bold"></h3>
                <button onclick="closeVideoModal()" class="text-gray-400 hover:text-white">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                    </svg>
                </button>
            </div>
            <div id="modalContent" class="relative w-full"  style="padding-bottom: 56.25%; height: 0; overflow: hidden;">
                <!-- Content will be inserted here -->
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
    <div id="about" class="py-24 bg-white">
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

<script>
    function getVideoId(url) {
        let videoId = '';
        if (url.includes('youtube.com')) {
            videoId = url.split('v=')[1]?.split('&')[0] || '';
        } else if (url.includes('youtu.be')) {
            videoId = url.split('/').pop()?.split('?')[0] || '';
        }
        return videoId;
    }

    function openVideoModal(serviceId, serviceName, videoUrl, videoType) {
        const modal = document.getElementById('videoModal');
        const modalTitle = document.getElementById('modalTitle');
        const modalContent = document.getElementById('modalContent');

        modalTitle.textContent = serviceName;

        if (videoType === 'youtube' || videoType === 'vimeo') {
            modalContent.innerHTML = `
                <iframe
                    class="absolute top-0 left-0 w-full h-full"
                    src="${videoUrl}"
                    frameborder="0"
                    allow="autoplay; encrypted-media"
                    allowfullscreen>
                </iframe>
            `;
        } else if (videoType === 'file') {
            modalContent.innerHTML = `
                <video class="absolute top-0 left-0 w-full h-full" controls>
                    <source src="${videoUrl}" type="video/mp4">
                    Your browser does not support the video tag.
                </video>
            `;
        }

        modal.classList.remove('hidden');
        document.body.style.overflow = 'hidden';
    }

    function closeVideoModal() {
        const modal = document.getElementById('videoModal');
        const modalContent = document.getElementById('modalContent');
        modal.classList.add('hidden');
        modalContent.innerHTML = '';
        document.body.style.overflow = 'auto';
    }

    // Close modal when clicking outside it
    document.getElementById('videoModal').addEventListener('click', function(e) {
        if (e.target === this) {
            closeVideoModal();
        }
    });

    // Close modal on Escape key
    document.addEventListener('keydown', function(e) {
        if (e.key === 'Escape') {
            closeVideoModal();
        }
    });
</script>
