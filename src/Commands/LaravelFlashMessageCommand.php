<?php

namespace Bilfeldt\LaravelFlashMessage\Commands;

use Illuminate\Console\Command;

class LaravelFlashMessageCommand extends Command
{
    public $signature = 'laravel-flash-message';

    public $description = 'My command';

    public function handle()
    {
        $this->comment('All done');
    }
}
