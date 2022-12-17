@if ($errors->getBag($bag)->any())
    <x-flash::alert
        :level="\Bilfeldt\LaravelFlashMessage\Message::LEVEL_ERROR"
        :title="$title"
        :text="$text"
        :messages="$errors->getBag($bag)->all($format)"
        :links="$links"
    ></x-flash-alert>
@endif

