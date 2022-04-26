<?php

namespace Trin4ik\LaravelHttpAfter;

use Trin4ik\LaravelHttpAfter\Middleware\AfterMiddleware;
use Illuminate\Http\Client\PendingRequest;
use Illuminate\Support\ServiceProvider;

class LaravelHttpAfterServiceProvider extends ServiceProvider
{
	/**
	 * Will be called at the end of the boot method by spatie/laravel-package-tools.
	 *
	 * More info: https://github.com/spatie/laravel-package-tools
	 */
	public function boot () {
		PendingRequest::macro('after', function (
			\Closure $callback = null
		) {
			/** @var \Illuminate\Http\Client\PendingRequest $this */
			return $this->withMiddleware((new AfterMiddleware())->__invoke($callback));
		});
	}
}