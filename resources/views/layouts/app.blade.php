<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TCR Airconditioning Services</title>

    <!-- Favicon -->
    <link rel="icon" type="image/png" href="{{ asset('images/logo.png') }}">
    <link rel="icon" type="image/x-icon" href="{{ asset('images/logo.png') }}">
    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('images/logo.png') }}">
    <link rel="apple-touch-icon" href="{{ asset('images/logo.png') }}">

    <!-- Vite Assets -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

    <style>
        /* Ensure smooth scrolling */
        html {
            scroll-behavior: smooth;
        }
        /* Base styles */
        body {
            font-family: 'Poppins', sans-serif;
        }
    </style>
</head>
<body class="font-sans antialiased">
    <!-- Navigation -->
    <nav class="sticky top-0 z-40 bg-white shadow-lg">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="h-20 flex justify-between">
                <div class="flex">
                    <div class="flex-shrink-0 flex items-center">
                        <img src="{{ asset('images/tcr-logo-transparent.png') }}" alt="TCR Logo" class="h-16 w-auto">
                    </div>
                    <div class="hidden sm:ml-6 sm:flex sm:space-x-8">
                        <a href="/" class="nav-link border-cyan-700 text-gray-900 inline-flex items-center px-1 pt-1 border-b-2 text-md font-medium transition-all duration-300" data-section="home">
                            Home
                        </a>
                        <a href="#services" class="nav-link border-transparent text-gray-500 hover:border-gray-300 hover:text-gray-700 inline-flex items-center px-1 pt-1 border-b-2 text-md font-medium transition-all duration-300" data-section="services">
                            Services
                        </a>
                        {{-- <a href="#projects" class="nav-link border-transparent text-gray-500 hover:border-gray-300 hover:text-gray-700 inline-flex items-center px-1 pt-1 border-b-2 text-md font-medium transition-all duration-300" data-section="projects">
                            Projects
                        </a> --}}
                        <a href="#about" class="nav-link border-transparent text-gray-500 hover:border-gray-300 hover:text-gray-700 inline-flex items-center px-1 pt-1 border-b-2 text-md font-medium transition-all duration-300" data-section="about">
                            About Us
                        </a>
                        <a href="#contact" class="nav-link border-transparent text-gray-500 hover:border-gray-300 hover:text-gray-700 inline-flex items-center px-1 pt-1 border-b-2 text-md font-medium transition-all duration-300" data-section="contact">
                            Contact
                        </a>
                    </div>
                </div>
                <!-- Client Login button removed as per requirements -->
            </div>
        </div>
    </nav>

    <!-- Page Content -->
    <main>
        @yield('content')
    </main>

    <!-- Footer -->
    <footer class="bg-gray-800 text-white py-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-8">
                <div>
                    <img src="{{ asset('images/tcr-logo-transparent.png') }}" alt="TCR Logo" class="h-24 w-auto">
                    <p class="text-gray-400">Your trusted partner for all air conditioning solutions.</p>
                </div>
                <div>
                    <h4 class="text-lg font-semibold mb-4 text-white">Quick Links</h4>
                    <ul class="space-y-2">
                        <li><a href="#" class="text-gray-400 hover:text-white">Home</a></li>
                        <li><a href="#services" class="text-gray-400 hover:text-white">Services</a></li>
                        <li><a href="#projects" class="text-gray-400 hover:text-white">Projects</a></li>
                        <li><a href="#about" class="text-gray-400 hover:text-white">About Us</a></li>
                        <li><a href="#contact" class="text-gray-400 hover:text-white">Contact</a></li>
                    </ul>
                </div>
                <div>
                    <h4 class="text-lg font-semibold mb-4 text-white">Contact Us</h4>
                    <address class="not-italic text-gray-400">
                        <p><i class="fas fa-map-marker-alt mr-2"></i> Manila, Philippines</p>
                        <p class="mt-2"><i class="fas fa-phone-alt mr-2"></i> +639 173 056 911</p>
                        <p class="mt-2"><i class="fas fa-envelope mr-2"></i> tcr.airconditioning@gmail.com</p>
                    </address>
                </div>
                <div>
                    <h4 class="text-lg font-semibold mb-4 text-white">Follow Us</h4>
                    <div class="flex space-x-4">
                        <a href="https://www.facebook.com/tcr.airconditioning" target="_blank" class="text-gray-400 hover:text-white"><i class="fab fa-facebook-f text-xl"></i></a>
                        <a href="#" class="text-gray-400 hover:text-white"><i class="fab fa-twitter text-xl"></i></a>
                        <a href="#" class="text-gray-400 hover:text-white"><i class="fab fa-instagram text-xl"></i></a>
                        <a href="#" class="text-gray-400 hover:text-white"><i class="fab fa-linkedin-in text-xl"></i></a>
                    </div>
                </div>
            </div>
            <div class="border-t border-gray-700 mt-8 pt-8 text-center text-gray-400">
                <p>&copy; {{ date('Y') }} TCR Aircon. All rights reserved.</p>
            </div>
        </div>
    </footer>

    <script>
        // Set active navigation link based on scroll position
        function updateActiveNav() {
            const navLinks = document.querySelectorAll('.nav-link');
            const sections = {
                home: { offset: 0 },
                services: { element: document.getElementById('services') },
                about: { element: document.getElementById('about') },
                contact: { element: document.getElementById('contact') }
            };

            // Reset all links
            navLinks.forEach(link => {
                link.classList.remove('border-cyan-700', 'text-gray-900');
                link.classList.add('border-transparent', 'text-gray-500');
            });

            // Determine which section is in view
            let currentSection = 'home';
            const scrollY = window.scrollY + 100; // Add offset for header height

            Object.keys(sections).forEach(section => {
                const sectionElement = sections[section].element;
                if (sectionElement) {
                    const sectionTop = sectionElement.offsetTop;
                    const sectionHeight = sectionElement.offsetHeight;

                    if (scrollY >= sectionTop && scrollY < sectionTop + sectionHeight) {
                        currentSection = section;
                    }
                }
            });

            // Set active link
            const activeLink = document.querySelector(`[data-section="${currentSection}"]`);
            if (activeLink) {
                activeLink.classList.remove('border-transparent', 'text-gray-500');
                activeLink.classList.add('border-cyan-700', 'text-gray-900');
            }
        }

        // Update on scroll
        window.addEventListener('scroll', updateActiveNav);

        // Update on page load
        document.addEventListener('DOMContentLoaded', updateActiveNav);
    </script>
</body>
</html>
