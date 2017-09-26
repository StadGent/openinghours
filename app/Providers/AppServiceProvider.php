<?php

namespace App\Providers;

use App\Models\Calendar;
use App\Models\Channel;
use App\Models\Openinghours;
use App\Observers\CalendarObserver;
use App\Observers\ChannelObserver;
use App\Observers\OpeninghoursObserver;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        /** OBSERVERS **/
        Calendar::observe(CalendarObserver::class);
        Channel::observe(ChannelObserver::class);
        Openinghours::observe(OpeninghoursObserver::class);
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        /** REPOSITORIES **/
        $this->app->bind('UserRepository', function ($app) {
            return new \App\Repositories\UserRepository(
                new \App\Models\User()
            );
        });

        $this->app->bind('ServicesRepository', function ($app) {
            return new \App\Repositories\ServicesRepository(
                new \App\Models\Service()
            );
        });

        $this->app->bind('CalendarRepository', function ($app) {
            return new \App\Repositories\CalendarRepository(
                new \App\Models\Calendar()
            );
        });

        $this->app->bind('ChannelRepository', function ($app) {
            return new \App\Repositories\ChannelRepository(
                new \App\Models\Channel()
            );
        });

        $this->app->bind('OpeninghoursRepository', function ($app) {
            return new \App\Repositories\OpeninghoursRepository(
                new \App\Models\Openinghours()
            );
        });

        $this->app->bind('EventRepository', function ($app) {
            return new \App\Repositories\EventRepository(
                new \App\Models\Event()
            );
        });

        $this->app->bind('UserRepository', function ($app) {
            return new \App\Repositories\UserRepository(
                new \App\Models\User()
            );
        });

        /** SERVICES **/
        $this->app->singleton('ChannelService', function ($app) {
            return new \App\Services\ChannelService();
        });

        $this->app->singleton('ICalService', function ($app) {
            return new \App\Services\ICalService();
        });

        $this->app->singleton('OpeninghoursService', function ($app) {
            return new \App\Services\OpeninghoursService();
        });

        $this->app->singleton('SparqlService', function ($app) {
            return new \App\Services\SparqlService(
                env('SPARQL_ENDPOINT'),
                env('SPARQL_ENDPOINT_USERNAME'),
                env('SPARQL_ENDPOINT_PASSWORD')
            );
        });
    }
}
