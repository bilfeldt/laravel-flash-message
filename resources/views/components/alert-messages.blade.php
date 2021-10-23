@foreach($messages as $message)
    <x-flash-alert
        :level="$message->getLevel()"
        :text="$message->getText()"
        :title="$message->getTitle()"
        :messages="$message->getMessageBag()->all()"
        :links="$message->getLinks()"
    ></x-flash-alert>
@endforeach
