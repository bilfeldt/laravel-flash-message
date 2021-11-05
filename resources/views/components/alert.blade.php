<div role="alert" @class([
    'flex flex-row p-5 rounded border-b-2 mb-4',
    'bg-gray-200 border-gray-300' => $level == \Bilfeldt\LaravelFlashMessage\Message::LEVEL_MESSAGE,
    'bg-blue-200 border-blue-300' => $level == \Bilfeldt\LaravelFlashMessage\Message::LEVEL_INFO,
    'bg-green-200 border-green-300' => $level == \Bilfeldt\LaravelFlashMessage\Message::LEVEL_SUCCESS,
    'bg-yellow-200 border-yellow-300' => $level == \Bilfeldt\LaravelFlashMessage\Message::LEVEL_WARNING,
    'bg-red-200 border-red-300' => $level == \Bilfeldt\LaravelFlashMessage\Message::LEVEL_ERROR,
])>
    <div @class([
        'flex items-center border-2 justify-center h-10 w-10 flex-shrink-0 rounded-full',
        'bg-gray-50 border-gray-500' => $level == \Bilfeldt\LaravelFlashMessage\Message::LEVEL_MESSAGE,
        'bg-blue-50 border-blue-500' => $level == \Bilfeldt\LaravelFlashMessage\Message::LEVEL_INFO,
        'bg-green-50 border-green-500' => $level == \Bilfeldt\LaravelFlashMessage\Message::LEVEL_SUCCESS,
        'bg-yellow-50 border-yellow-500' => $level == \Bilfeldt\LaravelFlashMessage\Message::LEVEL_WARNING,
        'bg-red-50 border-red-500' => $level == \Bilfeldt\LaravelFlashMessage\Message::LEVEL_ERROR,
    ])>
        <span @class([
            'text-gray-500' => $level == \Bilfeldt\LaravelFlashMessage\Message::LEVEL_MESSAGE,
            'text-blue-500' => $level == \Bilfeldt\LaravelFlashMessage\Message::LEVEL_INFO,
            'text-green-500' => $level == \Bilfeldt\LaravelFlashMessage\Message::LEVEL_SUCCESS,
            'text-yellow-500' => $level == \Bilfeldt\LaravelFlashMessage\Message::LEVEL_WARNING,
            'text-red-500' => $level == \Bilfeldt\LaravelFlashMessage\Message::LEVEL_ERROR,
        ])>
            @if ($level == \Bilfeldt\LaravelFlashMessage\Message::LEVEL_MESSAGE)
                <svg fill="currentColor" viewBox="0 0 20 20" class="h-6 w-6">
                    <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd"></path>
                </svg>
            @elseif($level == \Bilfeldt\LaravelFlashMessage\Message::LEVEL_INFO)
                <svg fill="currentColor" viewBox="0 0 20 20" class="h-6 w-6">
                    <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd"></path>
                </svg>
            @elseif($level == \Bilfeldt\LaravelFlashMessage\Message::LEVEL_SUCCESS)
                <svg fill="currentColor" viewBox="0 0 20 20" class="h-6 w-6">
                    <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path>
                </svg>
            @elseif($level == \Bilfeldt\LaravelFlashMessage\Message::LEVEL_WARNING)
                <svg fill="currentColor" viewBox="0 0 20 20" class="h-6 w-6">
                    <path fill-rule="evenodd" d="M8.257 3.099c.765-1.36 2.722-1.36 3.486 0l5.58 9.92c.75 1.334-.213 2.98-1.742 2.98H4.42c-1.53 0-2.493-1.646-1.743-2.98l5.58-9.92zM11 13a1 1 0 11-2 0 1 1 0 012 0zm-1-8a1 1 0 00-1 1v3a1 1 0 002 0V6a1 1 0 00-1-1z" clip-rule="evenodd"></path>
                </svg>
            @elseif($level == \Bilfeldt\LaravelFlashMessage\Message::LEVEL_ERROR)
                <svg fill="currentColor" viewBox="0 0 20 20" class="h-6 w-6">
                    <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path>
                </svg>
            @endif
        </span>
    </div>
    <div class="ml-4">
        @if($title)
            <div @class([
                'font-semibold text-lg',
                'text-gray-800' => $level == \Bilfeldt\LaravelFlashMessage\Message::LEVEL_MESSAGE,
                'text-blue-800' => $level == \Bilfeldt\LaravelFlashMessage\Message::LEVEL_INFO,
                'text-green-800' => $level == \Bilfeldt\LaravelFlashMessage\Message::LEVEL_SUCCESS,
                'text-yellow-800' => $level == \Bilfeldt\LaravelFlashMessage\Message::LEVEL_WARNING,
                'text-red-800' => $level == \Bilfeldt\LaravelFlashMessage\Message::LEVEL_ERROR,
            ])>
                {{ $title }}
            </div>
        @endif

        @if($text)
            <div @class([
                'text-sm',
                'text-gray-700' => $level == \Bilfeldt\LaravelFlashMessage\Message::LEVEL_MESSAGE,
                'text-blue-700' => $level == \Bilfeldt\LaravelFlashMessage\Message::LEVEL_INFO,
                'text-green-700' => $level == \Bilfeldt\LaravelFlashMessage\Message::LEVEL_SUCCESS,
                'text-yellow-700' => $level == \Bilfeldt\LaravelFlashMessage\Message::LEVEL_WARNING,
                'text-red-700' => $level == \Bilfeldt\LaravelFlashMessage\Message::LEVEL_ERROR,
            ])>
                <p>{{ $text }}</p>
            </div>
        @endif

        @if (! empty($messages))
            <div @class([
                'mb-2 text-sm',
                'text-gray-700' => $level == \Bilfeldt\LaravelFlashMessage\Message::LEVEL_MESSAGE,
                'text-blue-700' => $level == \Bilfeldt\LaravelFlashMessage\Message::LEVEL_INFO,
                'text-green-700' => $level == \Bilfeldt\LaravelFlashMessage\Message::LEVEL_SUCCESS,
                'text-yellow-700' => $level == \Bilfeldt\LaravelFlashMessage\Message::LEVEL_WARNING,
                'text-red-700' => $level == \Bilfeldt\LaravelFlashMessage\Message::LEVEL_ERROR,
                ])>
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
            <div>
                <div class="-mx-2 flex">
                    @foreach($links as $text => $link)
                        <a href="{{ $link }}" @class([
                        'px-2 py-1.5 rounded-md text-sm font-medium focus:outline-none focus:ring-2 focus:ring-offset-2 mr-3',
                        'bg-gray-100 text-gray-800 hover:bg-gray-50 focus:ring-offset-gray-100 focus:ring-gray-600' => $level == \Bilfeldt\LaravelFlashMessage\Message::LEVEL_MESSAGE,
                        'bg-blue-100 text-blue-800 hover:bg-blue-50 focus:ring-offset-blue-100 focus:ring-blue-600' => $level == \Bilfeldt\LaravelFlashMessage\Message::LEVEL_INFO,
                        'bg-green-100 text-green-800 hover:bg-green-50 focus:ring-offset-green-100 focus:ring-green-600' => $level == \Bilfeldt\LaravelFlashMessage\Message::LEVEL_SUCCESS,
                        'bg-yellow-100 text-yellow-800 hover:bg-yellow-50 focus:ring-offset-yellow-100 focus:ring-yellow-600' => $level == \Bilfeldt\LaravelFlashMessage\Message::LEVEL_WARNING,
                        'bg-red-100 text-red-800 hover:bg-red-50 focus:ring-offset-red-100 focus:ring-red-600' => $level == \Bilfeldt\LaravelFlashMessage\Message::LEVEL_ERROR,
                        ])>{{ $text }}</a>
                    @endforeach
                </div>
            </div>
        @endif
    </div>
</div>
