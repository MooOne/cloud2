<?php

namespace Yeelight\Http\Controllers\Api\Foundation\Validation;

use Dingo\Api\Exception\ResourceException;
use Illuminate\Contracts\Validation\Factory;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\UrlGenerator;

/**
 * Trait ValidatesRequests
 *
 * @category Yeelight
 *
 * @package Yeelight\Http\Controllers\Api\Foundation\Validation
 *
 * @author Sheldon Lee <xdlee110@gmail.com>
 *
 * @license https://opensource.org/licenses/MIT MIT
 *
 * @link https://www.yeelight.com
 */
trait ValidatesRequests
{
    /**
     * The default error bag.
     *
     * @var string
     */
    protected $validatesRequestErrorBag;

    /**
     * Run the validation routine against the given validator.
     *
     * @param \Illuminate\Contracts\Validation\Validator|array $validator Validator
     * @param \Illuminate\Http\Request|null $request Request
     *
     * @return void
     */
    public function validateWith($validator, Request $request = null)
    {
        $request = $request ?: app('request');

        if (is_array($validator)) {
            $validator = $this->getValidationFactory()->make($request->all(), $validator);
        }

        if ($validator->fails()) {
            $this->throwValidationException($request, $validator);
        }
    }

    /**
     * Validate the given request with the given rules.
     *
     * @param \Illuminate\Http\Request $request Request
     * @param array $rules rules
     * @param array $messages messages
     * @param array $customAttributes customAttributes
     *
     * @return void
     */
    public function validate(Request $request, array $rules, array $messages = [], array $customAttributes = [])
    {
        $validator = $this->getValidationFactory()->make($request->all(), $rules, $messages, $customAttributes);

        if ($validator->fails()) {
            $this->throwValidationException($request, $validator);
        }
    }

    /**
     * Validate the given request with the given rules.
     *
     * @param \Illuminate\Http\Request $request Request
     * @param array $data data
     * @param array $rules rules
     * @param array $messages messages
     * @param array $customAttributes customAttributes
     */
    public function validateData(Request $request, array $data, array $rules, array $messages = [], array $customAttributes = [])
    {
        $validator = $this->getValidationFactory()->make($data, $rules, $messages, $customAttributes);

        if ($validator->fails()) {
            $this->throwValidationException($request, $validator);
        }
    }

    /**
     * Validate the given request with the given rules.
     *
     * @param string $errorBag errorBag
     * @param \Illuminate\Http\Request $request Request
     * @param array $rules rules
     * @param array $messages messages
     * @param array $customAttributes customAttributes
     *
     * @throws \Illuminate\Foundation\Validation\ValidationException
     *
     * @return void
     */
    public function validateWithBag($errorBag, Request $request, array $rules, array $messages = [], array $customAttributes = [])
    {
        $this->withErrorBag($errorBag, function () use ($request, $rules, $messages, $customAttributes) {
            $this->validate($request, $rules, $messages, $customAttributes);
        });
    }

    /**
     * Throw the failed validation exception.
     *
     * @param \Illuminate\Http\Request $request Request
     * @param \Illuminate\Contracts\Validation\Validator $validator Validator
     *
     * @throws \Illuminate\Foundation\Validation\ValidationException
     *
     * @return void
     */
    protected function throwValidationException(Request $request, $validator)
    {
        throw new ResourceException($validator->errors()->first(), $validator->errors());
//        throw new ValidationException($validator, $this->buildFailedValidationResponse(
//            $request, $this->formatValidationErrors($validator)
//        ));
    }

    /**
     * Create the response for when a request fails validation.
     *
     * @param \Illuminate\Http\Request $request Request
     * @param array $errors errors
     *
     * @return \Illuminate\Http\Response
     */
    protected function buildFailedValidationResponse(Request $request, array $errors)
    {
        if (($request->ajax() && !$request->pjax()) || $request->wantsJson()) {
            return new JsonResponse($errors, 422);
        }

        return redirect()->to($this->getRedirectUrl())
            ->withInput($request->input())
            ->withErrors($errors, $this->errorBag());
    }

    /**
     * Format the validation errors to be returned.
     *
     * @param \Illuminate\Contracts\Validation\Validator $validator Validator
     *
     * @return array
     */
    protected function formatValidationErrors(Validator $validator)
    {
        return $validator->errors()->getMessages();
    }

    /**
     * Get the URL we should redirect to.
     *
     * @return string
     */
    protected function getRedirectUrl()
    {
        return app(UrlGenerator::class)->previous();
    }

    /**
     * Get a validation factory instance.
     *
     * @return \Illuminate\Contracts\Validation\Factory
     */
    protected function getValidationFactory()
    {
        return app(Factory::class);
    }

    /**
     * Execute a Closure within with a given error bag set as the default bag.
     *
     * @param string $errorBag errorBag
     * @param callable $callback callback
     *
     * @return void
     */
    protected function withErrorBag($errorBag, callable $callback)
    {
        $this->validatesRequestErrorBag = $errorBag;

        call_user_func($callback);

        $this->validatesRequestErrorBag = null;
    }

    /**
     * Get the key to be used for the view error bag.
     *
     * @return string
     */
    protected function errorBag()
    {
        return $this->validatesRequestErrorBag ?: 'default';
    }
}
