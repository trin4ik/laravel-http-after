<?php

namespace Trin4ik\LaravelHttpAfter\Middleware;

use GuzzleHttp\Promise\PromiseInterface;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;

class AfterMiddleware
{
	/**
	 * Called when the middleware is handled by the client.
	 *
	 * @param \Closure $callback
	 *
	 * @return callable
	 */
	public function __invoke (\Closure $callback = null): callable {
		return function (callable $handler) use ($callback): callable {
			return function (RequestInterface $request, array $options) use ($callback, $handler): PromiseInterface {
				$start = microtime(true);
				$promise = $handler($request, $options);

				return $promise->then(
					function (ResponseInterface $response) use ($callback, $request, $start) {
						$time = microtime(true) - $start;

						if (is_callable($callback)) {
							$callback($request, $response, $time);
						}

						return $response;
					}
				);
			};
		};
	}
}
