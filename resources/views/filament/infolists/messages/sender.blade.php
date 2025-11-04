<div class="py-4 border-b dark:border-gray-700">
    <div class="flex items-start justify-between">
        <div class="flex items-center space-x-4">
            <div class="flex-shrink-0 w-10 h-10 rounded-full bg-primary-100 dark:bg-gray-700 flex items-center justify-center">
                <span class="text-primary-600 dark:text-primary-300 font-medium">{{ strtoupper(substr($name, 0, 1)) }}</span>
            </div>
            <div>
                <div class="flex items-center space-x-2">
                    <h3 class="text-base font-medium text-gray-900 dark:text-white">{{ $name }}</h3>
                    <span class="text-sm text-gray-500 dark:text-gray-400">&lt;{{ $email }}&gt;</span>
                </div>
                @if($phone)
                    <div class="text-sm text-gray-500 dark:text-gray-400">{{ $phone }}</div>
                @endif
            </div>
        </div>
        <div class="text-sm text-gray-500 dark:text-gray-400">
            {{ $date }}
        </div>
    </div>
</div>
