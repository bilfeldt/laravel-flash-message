<div role="alert" class="flex rounded mb-4 p-6 rounded-lg border bg-red-50 border-red-200 border-red-200">
    <div class="text-red-400">
        <svg fill="currentColor" viewBox="0 0 20 20" class="h-7 w-7">
            <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path>
        </svg>
    </div>
    <div class="ml-4">
        @if($title)
            <div class="font-semibold text-lg leading-0 text-red-700">
                {{ $title }}
            </div>
        @endif

        @if($text)
            <div class="text-sm text-red-600">
                <p>{{ $text }}</p>
            </div>
        @endif

        {{ $slot ?? '' }}

        @if (! empty($messages))
            <div class="mb-2 text-sm text-red-600">
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
                        class="px-2 py-1.5 rounded-md text-sm font-medium focus:outline-none focus:ring-1 mr-3 border border border-red-400 text-red-700 hover:bg-red-100/50 focus:ring-offset-red-50 focus:ring-red-500">
                        {{ $text }}
                    </a>
                @endforeach
            </div>
        @endif
    </div>
</div>
