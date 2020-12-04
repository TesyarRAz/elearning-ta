<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

use App\Observers\RegisterMailObserver;
use App\Models\User;

use Illuminate\Auth\Notifications\VerifyEmail;

use Illuminate\Pagination\Paginator;

use League\Flysystem\Filesystem;
use Spatie\Dropbox\Client as DropboxClient;
use Spatie\FlysystemDropbox\DropboxAdapter;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Paginator::useBootstrap();

        \Storage::extend('dropbox', function($app, $config) {
            return new Filesystem(new DropboxAdapter(new DropboxClient(
                $config['token']
            )));
        });
        
        User::registerObserver(RegisterMailObserver::class);
        VerifyEmail::createUrlUsing(function($notifiable) {
            return route('verify', $notifiable->username);
        });

        User::created(function($user) {
            $user->state()->create(['state' => 'initial']);
        });
    }
}
