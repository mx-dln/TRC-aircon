<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $project->name }} - Project Progress</title>
    <!-- Favicon -->
    <link rel="icon" type="image/png" href="{{ asset('images/logo.png') }}">
    <link rel="apple-touch-icon" href="{{ asset('images/logo.png') }}">
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Inter', sans-serif;
            background-color: #f8fafc;
        }
        .gradient-bg {
            background: linear-gradient(135deg, #4f46e5 0%, #7c3aed 100%);
        }
        .card {
            background: white;
            border-radius: 12px;
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.05), 0 2px 4px -1px rgba(0, 0, 0, 0.03);
            transition: transform 0.2s ease, box-shadow 0.2s ease;
        }
        .card:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1), 0 4px 6px -2px rgba(0, 0, 0, 0.05);
        }
        .progress-bar {
            height: 12px;
            border-radius: 6px;
            background-color: rgba(255, 255, 255, 0.2);
            overflow: hidden;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1) inset;
        }
        .progress-fill {
            height: 100%;
            border-radius: 6px;
            background: linear-gradient(90deg, #60a5fa, #3b82f6, #2563eb);
            transition: width 0.6s ease;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }
        .gallery {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(180px, 1fr));
            gap: 1.25rem;
            margin-top: 1rem;
        }
        .gallery-item {
            position: relative;
            border-radius: 10px;
            overflow: hidden;
            aspect-ratio: 4/3;
            transition: all 0.3s ease;
        }
        .gallery-item:hover {
            transform: translateY(-4px);
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.1);
        }
        .gallery-item img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform 0.5s ease;
        }
        .gallery-item:hover img {
            transform: scale(1.05);
        }
        .gallery-item .overlay {
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: rgba(0, 0, 0, 0.4);
            display: flex;
            align-items: center;
            justify-content: center;
            opacity: 0;
            transition: opacity 0.3s ease;
        }
        .gallery-item:hover .overlay {
            opacity: 1;
        }
        .status-badge {
            display: inline-flex;
            align-items: center;
            padding: 0.25rem 0.75rem;
            border-radius: 9999px;
            font-size: 0.75rem;
            font-weight: 600;
            text-transform: capitalize;
        }
        .status-pending {
            background-color: #fef3c7;
            color: #92400e;
        }
        .status-in_progress {
            background-color: #dbeafe;
            color: #1e40af;
        }
        .status-completed {
            background-color: #dcfce7;
            color: #166534;
        }
        .timeline {
            position: relative;
            padding-left: 2rem;
        }
        .timeline::before {
            content: '';
            position: absolute;
            left: 0.5rem;
            top: 0;
            bottom: 0;
            width: 2px;
            background: #e2e8f0;
        }
        .timeline-item {
            position: relative;
            padding-bottom: 2.5rem;
            padding-left: 1.5rem;
        }
        .timeline-item:last-child {
            padding-bottom: 0;
        }
        .timeline-item::before {
            content: '';
            position: absolute;
            left: -0.5rem;
            top: 0.5rem;
            width: 1.25rem;
            height: 1.25rem;
            border-radius: 9999px;
            border: 3px solid white;
            z-index: 1;
        }
        .timeline-item.pending::before {
            background-color: #f59e0b;
        }
        .timeline-item.in_progress::before {
            background-color: #3b82f6;
        }
        .timeline-item.completed::before {
            background-color: #10b981;
        }
            cursor: pointer;
        }
        .gallery img:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06);
        }
        .status-badge {
            display: inline-flex;
            align-items: center;
            padding: 0.25rem 0.75rem;
            border-radius: 9999px;
            font-size: 0.75rem;
            font-weight: 600;
            text-transform: capitalize;
        }
    </style>
</head>
<body class="bg-gray-50">
    <div class="min-h-screen">
        <!-- Header -->
        <header class="gradient-bg text-white shadow-lg">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-6">
                <div class="flex flex-col md:flex-row md:items-center md:justify-between">
                    <div class="flex-1">
                        <h1 class="text-2xl md:text-3xl font-bold">{{ $project->name }}</h1>
                        <div class="flex flex-wrap items-center gap-2 mt-1 text-indigo-100">
                            <span>Project Progress Tracker</span>
                            <span class="text-indigo-200">•</span>
                            <span>Client: {{ $project->client->name ?? 'N/A' }}</span>
                        </div>
                    </div>
                    <div class="mt-4 md:mt-0 flex items-center space-x-4">
                        @php
                            $status = $project->progress >= 100 ? 'completed' : $project->status;
                            $statusText = $project->progress >= 100 ? 'Completed' : ucfirst(str_replace('_', ' ', $project->status));
                        @endphp
                        <span class="status-badge status-{{ $status }}">
                            <i class="fas {{ 
                                $status === 'completed' ? 'fa-check-circle' : 
                                ($status === 'in_progress' ? 'fa-sync-alt fa-spin' : 'fa-clock')
                            }} mr-2"></i>
                            {{ $statusText }}
                        </span>
                        <a href="{{ url('/') }}" class="flex items-center px-4 py-2 bg-white/10 hover:bg-white/20 rounded-lg text-sm font-medium transition-colors duration-200">
                            <i class="fas fa-arrow-left mr-2"></i> Back to Home
                        </a>
                    </div>
                </div>
                
                <!-- Project Progress -->
                <div class="mt-8">
                    <div class="flex justify-between items-center mb-2">
                        <span class="text-sm font-medium text-indigo-100">Project Progress</span>
                        <span class="text-sm font-bold text-white">{{ $project->progress }}%</span>
                    </div>
                    <div class="progress-bar">
                        <div class="progress-fill" style="width: {{ $project->progress }}%"></div>
                    </div>
                </div>
            </div>
        </header>

        <main class="max-w-7xl mx-auto py-8 px-4 sm:px-6 lg:px-8 -mt-12">
            <!-- Project Overview -->
            <div class="card mb-8 overflow-hidden">
                <div class="p-6">
                    <div class="flex flex-col md:flex-row md:items-center md:justify-between">
                        <div>
                            <h2 class="text-xl font-semibold text-gray-900">Project Overview</h2>
                            <p class="mt-1 text-sm text-gray-500">Details and description of the project</p>
                        </div>
                    </div>
                    
                    <div class="mt-6 grid grid-cols-1 gap-5 sm:grid-cols-2 lg:grid-cols-4">
                        <div class="p-5 bg-gray-50 rounded-lg">
                            <div class="flex items-center">
                                <div class="w-12 h-12 flex items-center justify-center rounded-full bg-indigo-100 text-indigo-600 flex-shrink-0">
                                    <i class="fas fa-user-tie text-lg"></i>
                                </div>
                                <div class="ml-4">
                                    <p class="text-sm font-medium text-gray-500">Client</p>
                                    <p class="text-lg font-semibold text-gray-900">
                                        {{ $project->client->name ?? 'Not assigned' }}
                                    </p>
                                </div>
                            </div>
                        </div>
                        <div class="p-5 bg-gray-50 rounded-lg">
                            <div class="flex items-center">
                                <div class="w-12 h-12 flex items-center justify-center rounded-full bg-indigo-100 text-indigo-600 flex-shrink-0">
                                    <i class="fas fa-calendar-day text-lg"></i>
                                </div>
                                <div class="ml-4">
                                    <p class="text-sm font-medium text-gray-500">Start Date</p>
                                    <p class="text-lg font-semibold text-gray-900">
                                        {{ $project->start_date ? $project->start_date->format('M d, Y') : 'Not set' }}
                                    </p>
                                </div>
                            </div>
                        </div>
                        
                        <div class="p-5 bg-gray-50 rounded-lg">
                            <div class="flex items-center">
                                <div class="w-12 h-12 flex items-center justify-center rounded-full bg-indigo-100 text-indigo-600 flex-shrink-0">
                                    <i class="fas fa-flag-checkered text-lg"></i>
                                </div>
                                <div class="ml-4">
                                    <p class="text-sm font-medium text-gray-500">End Date</p>
                                    <p class="text-lg font-semibold text-gray-900">
                                        {{ $project->end_date ? $project->end_date->format('M d, Y') : 'Not set' }}
                                    </p>
                                </div>
                            </div>
                        </div>
                        
                        <div class="p-5 bg-gray-50 rounded-lg">
                            <div class="flex items-center">
                                <div class="w-12 h-12 flex items-center justify-center rounded-full bg-indigo-100 text-indigo-600 flex-shrink-0">
                                    <i class="fas fa-tasks text-lg"></i>
                                </div>
                                <div class="ml-4">
                                    <p class="text-sm font-medium text-gray-500">Status</p>
                                    <div class="flex items-center">
                                        @php
                                            $status = $project->progress >= 100 ? 'completed' : $project->status;
                                            $statusText = $project->progress >= 100 ? 'Completed' : ucfirst(str_replace('_', ' ', $project->status));
                                        @endphp
                                        <span class="status-badge status-{{ $status }}">
                                            {{ $statusText }}
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <!-- <div class="p-5 bg-gray-50 rounded-lg">
                            <div class="flex items-center">
                                <div class="p-3 rounded-full bg-indigo-100 text-indigo-600">
                                    <i class="fas fa-chart-line"></i>
                                </div>
                                <div class="ml-4">
                                    <p class="text-sm font-medium text-gray-500">Progress</p>
                                    <div class="flex items-center">
                                        <span class="text-lg font-bold text-gray-900 mr-2">{{ $project->progress }}%</span>
                                        <div class="flex-1">
                                            <div class="progress-bar">
                                                <div class="progress-fill" style="width: {{ $project->progress }}%"></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div> -->
                    </div>
                    
                    @if($project->description)
                    <div class="mt-8">
                        <h3 class="text-lg font-medium text-gray-900 mb-3">Project Description</h3>
                        <div class="prose max-w-none text-gray-600">
                            {!! nl2br(e($project->description)) !!}
                        </div>
                    </div>
                    @endif
                </div>
            </div>

            <!-- Project Gallery -->
            @if(!empty($project->images) && count($project->images) > 0)
            <div class="card mb-8">
                <div class="px-6 py-5 border-b border-gray-200">
                    <h3 class="text-lg font-semibold text-gray-900">Project Gallery</h3>
                    <p class="mt-1 text-sm text-gray-500">Images and media related to this project</p>
                </div>
                <div class="p-6">
                    <div class="gallery">
                        @foreach($project->images as $index => $image)
                            <div class="gallery-item group cursor-pointer" onclick="openModal('{{ asset('storage/' . $image) }}')">
                                <img src="{{ asset('storage/' . $image) }}" alt="Project Image {{ $index + 1 }}" class="w-full h-48 object-cover rounded-lg">
                                <div class="absolute inset-0 bg-black bg-opacity-0 group-hover:bg-opacity-30 transition-all duration-300 flex items-center justify-center opacity-0 group-hover:opacity-100 rounded-lg">
                                    <span class="bg-white p-3 rounded-full text-indigo-600 transform scale-90 group-hover:scale-100 transition-transform duration-300">
                                        <i class="fas fa-expand"></i>
                                    </span>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
            @endif
        </main>
    </div>

    <!-- Image Modal -->
    <div id="imageModal" class="fixed inset-0 bg-black bg-opacity-90 z-50 flex items-center justify-center hidden">
        <div class="relative max-w-4xl w-full p-4">
            <button id="closeModal" class="absolute -top-12 right-0 bg-white hover:bg-red-500 hover:text-white text-gray-800 w-10 h-10 rounded-full flex items-center justify-center transition-all duration-300 transform hover:rotate-90">
                <i class="fas fa-times text-xl"></i>
            </button>
            <img id="modalImage" src="" alt="" class="max-h-[85vh] max-w-full mx-auto">
        </div>
    </div>

    <script>
        // Image Modal Functionality
        function openModal(imageSrc) {
            const modal = document.getElementById('imageModal');
            const modalImg = document.getElementById('modalImage');
            
            modalImg.src = imageSrc;
            modal.classList.remove('hidden');
            document.body.style.overflow = 'hidden';
            
            // Close modal when clicking outside the image
            modal.addEventListener('click', function(e) {
                if (e.target === modal) {
                    closeModal();
                }
            });
        }
        
        function closeModal() {
            const modal = document.getElementById('imageModal');
            modal.classList.add('hidden');
            document.body.style.overflow = 'auto';
        }
        
        // Initialize event listeners
        document.addEventListener('DOMContentLoaded', function() {
            // Close modal with button
            const closeBtn = document.getElementById('closeModal');
            if (closeBtn) {
                closeBtn.addEventListener('click', closeModal);
            }
            
            // Close with Escape key
            document.addEventListener('keydown', function(e) {
                if (e.key === 'Escape') {
                    closeModal();
                }
            });
            
            // Add loading state for images
            document.querySelectorAll('.gallery img').forEach(img => {
                img.addEventListener('load', function() {
                    this.style.opacity = 1;
                });
                // Start with 0 opacity for smooth fade-in
                img.style.opacity = 0;
                img.style.transition = 'opacity 0.3s ease';
            });
        });
    </script>
</body>
</html>
