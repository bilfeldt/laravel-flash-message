<div role="alert" class="flex rounded mb-4 p-6 rounded-lg border bg-blue-50 border-blue-200 border-blue-200">
    <div class="text-blue-400">
        <svg fill="currentColor" viewBox="0 0 20 20" class="h-7 w-7">
            <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd"></path>
        </svg>
    </div>
    <div class="ml-4">
        @if($title)
            <div class="font-semibold text-lg leading-0 text-blue-700">
                {{ $title }}
            </div>
        @endif

        @if($text)
            <div class="text-sm text-blue-600">
                <p>{{ $text }}</p>
            </div>
        @endif

        @if (! empty($messages))
            <div class="mb-2 text-sm text-blue-600">
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
                        class="px-2 py-1.5 rounded-md text-sm font-medium focus:outline-none focus:ring-1 mr-3 border border border-blue-400 text-blue-700 hover:bg-blue-100/50 focus:ring-offset-blue-50 focus:ring-blue-500">
                        {{ $text }}
                    </a>
                @endforeach
            </div>
        @endif
    </div>
</div>
