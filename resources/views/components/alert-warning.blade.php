<div role="alert" class="flex rounded mb-4 p-6 rounded-lg border bg-orange-50 border-orange-200 border-orange-200">
    <div class="text-orange-400">
        <svg fill="currentColor" viewBox="0 0 20 20" class="h-7 w-7">
            <path fill-rule="evenodd" d="M8.257 3.099c.765-1.36 2.722-1.36 3.486 0l5.58 9.92c.75 1.334-.213 2.98-1.742 2.98H4.42c-1.53 0-2.493-1.646-1.743-2.98l5.58-9.92zM11 13a1 1 0 11-2 0 1 1 0 012 0zm-1-8a1 1 0 00-1 1v3a1 1 0 002 0V6a1 1 0 00-1-1z" clip-rule="evenodd"></path>
        </svg>
    </div>
    <div class="ml-4">
        @if($title)
            <div class="font-semibold text-lg leading-0 text-orange-700">
                {{ $title }}
            </div>
        @endif

        @if($text)
            <div class="text-sm text-orange-600">
                <p>{{ $text }}</p>
            </div>
        @endif

        {{ $slot }}

        @if (! empty($messages))
            <div class="mb-2 text-sm text-orange-600">
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
                        class="px-2 py-1.5 rounded-md text-sm font-medium focus:outline-none focus:ring-1 mr-3 border border border-orange-400 text-orange-700 hover:bg-orange-100/50 focus:ring-offset-orange-50 focus:ring-orange-500">
                        {{ $text }}
                    </a>
                @endforeach
            </div>
        @endif
    </div>
</div>
