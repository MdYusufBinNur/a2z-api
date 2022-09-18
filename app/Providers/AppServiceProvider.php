<?php

namespace App\Providers;

use App\Services\SMS\SMS;
use App\Services\SMS\SMSMicroService\SMSMicroService;
use App\Services\Ticket\Ticket;
use App\Services\Ticket\TicketService\FreshDesk;
use Illuminate\Support\Facades\App;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        if (!$this->app->isProduction()) {
            $this->app->register(TelescopeServiceProvider::class);
        }

        // bind SMS
        $this->app->bind(SMS::class, function() {
            return new SMSMicroService();
        });

        // bind Ticket
        $this->app->bind(Ticket::class, function() {
            return new FreshDesk();
        });
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        $noOfRequests = 0;
        \DB::listen(function ($query) use (&$noOfRequests) {
            if (!App::environment('prod')) {
                $noOfRequests++;
                \Log::debug("$noOfRequests - [time: $query->time] " . $query->sql . ' , ' . json_encode($query->bindings));
            }
        });
    }
}
