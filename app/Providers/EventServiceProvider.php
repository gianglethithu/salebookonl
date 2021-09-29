<?php

namespace App\Providers;

use App\Events\OrderSucceed;
use App\Listeners\UpdateBookStock;
use App\Listeners\UpdatedEmployeeSale;
use App\Listeners\UpdateGroupSale;
use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Event;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        Registered::class => [
            SendEmailVerificationNotification::class,
        ],
        OrderSucceed::class => [
            UpdatedEmployeeSale::class,
            UpdateBookStock::class,
            UpdateGroupSale::class,
        ],
    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
	/**
	 * The event listener mappings for the application.
	 * @return array
	 */
	function getListen() {
		return $this->listen;
	}

	/**
	 * The event listener mappings for the application.
	 * @param array $listen The event listener mappings for the application.
	 * @return EventServiceProvider
	 */
	function setListen($listen): self {
		$this->listen = $listen;
		return $this;
	}
}
