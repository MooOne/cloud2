<?php

namespace Yeelight\Http\Controllers\Api\Middleware;

use Closure;
use Dingo\Api\Exception\ResourceException;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Exceptions\HttpResponseException;
use League\OAuth2\Server\Exception\OAuthServerException;
use Prettus\Validator\Exceptions\ValidatorException;
use Symfony\Component\HttpKernel\Exception\HttpException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\HttpKernel\Exception\UnauthorizedHttpException;

/**
 * Class ApiAccessMiddleware
 *
 * @category Yeelight
 *
 * @package Yeelight\Http\Controllers\Api\Middleware
 *
 * @author Sheldon Lee <xdlee110@gmail.com>
 *
 * @license https://opensource.org/licenses/MIT MIT
 *
 * @link https://www.yeelight.com
 */
class ApiAccessMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request Request
     * @param \Closure $next Closure
     *
     * @throws HttpException
     *
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        try {
            $response = $next($request);

            // Was an exception thrown? If so and available catch in our middleware
            if (isset($response->exception) && $response->exception) {
                throw $response->exception;
            }

            return $response;
        } catch (OAuthServerException $e) {
            $message = env('API_DEBUG') ? $e->getMessage() : null;

            throw new HttpException($e->getHttpStatusCode(), $message, $e, $e->getHttpHeaders());
        } catch (HttpResponseException $e) {
            $message = env('API_DEBUG') ? $e->getMessage() : null;

            throw new HttpException($e->getResponse()->getStatusCode(), $message, $e);
        } catch (AuthenticationException $e) {
            throw new UnauthorizedHttpException(null, $e->getMessage(), $e);
        } catch (ValidatorException $e) {
            $messageBag = $e->getMessageBag();

            throw new ResourceException($messageBag->first(), $messageBag->all());
        } catch (ModelNotFoundException $e) {
            throw new NotFoundHttpException('No results found.');
        }
    }
}
