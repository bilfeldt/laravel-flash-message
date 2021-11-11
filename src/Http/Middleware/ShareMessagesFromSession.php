<?php

namespace Bilfeldt\LaravelFlashMessage\Http\Middleware;

use Bilfeldt\LaravelFlashMessage\ViewFlashMessageBag;
use Closure;
use Illuminate\Contracts\View\Factory as ViewFactory;

/** This file is essentially a copy of \Illuminate\View\Middleware\ShareErrorsFromSession */
class ShareMessagesFromSession
{
    /**
     * The view factory implementation.
     *
     * @var \Illuminate\Contracts\View\Factory
     */
    protected ViewFactory $view;

    /**
     * Create a new error binder instance.
     *
     * @param \Illuminate\Contracts\View\Factory $view
     *
     * @return void
     */
    public function __construct(ViewFactory $view)
    {
        $this->view = $view;
    }

    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure                 $next
     *
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        // If the current session has an "messages" variable bound to it, we will share
        // its value with all view instances so the views can easily access messages
        // without having to bind. An empty collection is set when there aren't any messages.
        $this->view->share(
            'messages',
            ViewFlashMessageBag::make($request->session()->get(config('flash-message.session_flash')) ?: [])
        );

        // Putting the messages in the view for every view allows the developer to just
        // assume that some messages are always available, which is convenient since
        // they don't have to continually run checks for the presence of messages.

        return $next($request);
    }
}
