<div role="alert" class="flex rounded mb-4 p-6 rounded-lg border bg-green-50 border-green-200 border-green-200 dark:bg-gray-800 dark:border-green-700/75">
    <div class="text-green-400">
        <svg fill="currentColor" viewBox="0 0 20 20" class="h-7 w-7">
            <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path>
        </svg>
    </div>
    <div class="ml-4">
        @if($title)
            <div class="font-semibold text-lg leading-0 text-grey-800 dark:text-gray-300">
                {{ $title }}
            </div>
        @endif

        @if($text)
            <div class="text-sm text-grey-700 dark:text-gray-300">
                <p>{{ $text }}</p>
            </div>
        @endif

        {{ $slot ?? '' }}

        @if (! empty($messages))
            <div class="mb-2 text-sm text-grey-700 dark:text-gray-300">
                <ul role="list" class="list-disc pl-5 space-y-1">
                    @foreach($messages as $message)
                        <li>
                            {{ $message }}
                        </li>
                    @endforeach
                </ul>
            </div>
        @endif

        @if (! empty($links))
            <div class="-mx-2 flex mt-4">
                @foreach($links as $text => $link)
                    <a href="{{ $link }}"
                        class="px-2 py-1.5 rounded-md text-sm font-medium focus:outline-none focus:ring-1 mr-3 border border border-green-400 dark:border-green-700/75 dark:hover:bg-green-700/25 text-grey-700 dark:text-gray-300 hover:bg-green-100/50 focus:ring-offset-green-50 focus:ring-green-500">
                        {{ $text }}
                    </a>
                @endforeach
            </div>
        @endif
    </div>
</div>
