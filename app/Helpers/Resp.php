<?php


namespace App\Helpers;

use Flugg\Responder\Http\Responses\ErrorResponseBuilder;
use Flugg\Responder\Http\Responses\SuccessResponseBuilder;
use Flugg\Responder\Contracts\Responder;
use Illuminate\Http\RedirectResponse;

/**
 * A helper
 * Class Resp
 * @method Responder error($errorCode = null, string $message = null): ErrorResponseBuilder
 * @package App\Helpers
 */
class Resp
{
    public function __call($methodName, $args)
    {
        return responder()->$methodName(...$args);
    }

    /**
     * Handle success responses
     * @param mixed ...$args
     * @return SuccessResponseBuilder
     */
    public function success(...$args): SuccessResponseBuilder
    {
        if(is_string($args[0])){
            $args[0] = [
                'message' => $args[0]
            ];
        }

        return responder()->success(...$args);
    }
}
