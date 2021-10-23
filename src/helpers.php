<?php

use Bilfeldt\LaravelFlashMessage\Message;
use Illuminate\Support\Str;

if (! function_exists('session_message')) {
    /**
     * Flash a message to the session.
     *
     * @param  \Bilfeldt\LaravelFlashMessage\Message  $message
     * @return void
     */
    function session_message(Message $message)
    {
        // This is added as a helper function simply because \Illuminate\Session\Store is not Macroable
        session()->flash(config('flash-message.session_flash').'.'.Str::orderedUuid(), $message);
    }
}
