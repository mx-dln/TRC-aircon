<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Project Progress - {{ $project->name }}</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100">
    <div class="container mx-auto px-4 py-8">
        <div class="bg-white rounded-lg shadow-md p-6 mb-6">
            <h1 class="text-2xl font-bold text-gray-800 mb-2">{{ $project->name }}</h1>
            <p class="text-gray-600 mb-4">Project Progress</p>
            
            @if($project->client)
            <div class="bg-gray-50 p-4 rounded-md mb-6">
                <h2 class="text-lg font-semibold mb-2">Client Information</h2>
                <p class="text-gray-700">{{ $project->client->name }}</p>
                <p class="text-gray-600 text-sm">{{ $project->client->email }}</p>
                <p class="text-gray-600 text-sm">{{ $project->client->phone ?? 'N/A' }}</p>
            </div>
            @endif

            <div class="mb-6">
                <h2 class="text-xl font-semibold mb-4 text-gray-800">Project Progress</h2>
                
                @if($progress->count() > 0)
                    <div class="space-y-4">
                        @foreach($progress as $update)
                        <div class="border-l-4 border-blue-500 pl-4 py-2">
                            <div class="flex justify-between items-start">
                                <div>
                                    <h3 class="font-semibold text-gray-800">{{ $update->title }}</h3>
                                    <p class="text-gray-600 text-sm">{{ $update->date->format('F j, Y') }}</p>
                                </div>
                                <span class="px-2 py-1 text-xs rounded-full {{ 
                                    $update->status === 'completed' ? 'bg-green-100 text-green-800' : 
                                    ($update->status === 'in_progress' ? 'bg-blue-100 text-blue-800' : 'bg-yellow-100 text-yellow-800')
                                }}">
                                    {{ str_replace('_', ' ', ucfirst($update->status)) }}
                                </span>
                            </div>
                            @if($update->description)
                                <p class="mt-2 text-gray-700">{{ $update->description }}</p>
                            @endif
                            @if($update->images)
                                <div class="mt-2 flex space-x-2 overflow-x-auto">
                                    @foreach(explode(',', $update->images) as $image)
                                        <img src="{{ asset('storage/' . trim($image)) }}" alt="Progress Image" class="h-24 w-auto rounded">
                                    @endforeach
                                </div>
                            @endif
                        </div>
                        @endforeach
                    </div>
                @else
                    <div class="text-center py-8 text-gray-500">
                        <p>No progress updates available yet.</p>
                    </div>
                @endif
            </div>

            <div class="mt-8 pt-4 border-t border-gray-200">
                <h3 class="text-lg font-semibold mb-3">Project Details</h3>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <p class="text-sm text-gray-600">Start Date</p>
                        <p class="font-medium">{{ $project->start_date ? $project->start_date->format('F j, Y') : 'Not specified' }}</p>
                    </div>
                    <div>
                        <p class="text-sm text-gray-600">Estimated Completion</p>
                        <p class="font-medium">{{ $project->end_date ? $project->end_date->format('F j, Y') : 'Not specified' }}</p>
                    </div>
                    <div class="md:col-span-2">
                        <p class="text-sm text-gray-600">Project Description</p>
                        <p class="mt-1 text-gray-700">{{ $project->description ?? 'No description provided.' }}</p>
                    </div>
                </div>
            </div>
        </div>

        <div class="text-center text-sm text-gray-500">
            <p>Last updated: {{ now()->format('F j, Y \a\t g:i A') }}</p>
        </div>
    </div>
</body>
</html>
