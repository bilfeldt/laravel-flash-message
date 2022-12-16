@if($hasMessages() || $errors)
    <x-flash::alert
        :level="\Bilfeldt\LaravelFlashMessage\Message::LEVEL_ERROR"
        :title="$title"
        :text="$text"
        :messages="$messages ? $messageBag()->all() : $errors->getBag($bag)->all()"
        :links="$links"
    ></x-flash-alert>
@endif

