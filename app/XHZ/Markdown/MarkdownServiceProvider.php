<?php
namespace XHZ\Markdown;

use Illuminate\Support\ServiceProvider;
use Event;
use App;

class MarkdownServiceProvider extends ServiceProvider
{
    protected $defer = true;

    public function register()
    {
        $this->app->singleton('XHZ\Markdown\Markdown', function ($app) {
            return new \XHZ\Markdown\Markdown;
        });
    }

    public function provides()
    {
        return ['XHZ\Markdown\Markdown'];
    }
}
