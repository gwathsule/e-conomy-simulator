<?php

namespace App\Http\Controllers;

use App\Support\Exceptions\ExceptionBase;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public const TYPE_ERROR_RETURN = 'error';
    public const TYPE_SUCCESS_RETURN = 'success';

    protected function returnWithException(ExceptionBase $exception)
    {
        return back()->with([
            'response' => [
                'type' => self::TYPE_ERROR_RETURN,
                'message' => $exception->getUserMessage(),
                'errors' => $exception->getErrors(),
                'error_code' => $exception->getErrorCode(),
                'error_category' => $exception->getCategory(),
            ],
        ])->setStatusCode($exception->getErrorCode());
    }

    protected function returnWithSuccess($message = null)
    {
        if(is_null($message))
            $message = __('user-messages.action.success');
        return back()->with([
            'response' => [
                'type' => self::TYPE_SUCCESS_RETURN,
                'message' => $message,
            ],
        ])->setStatusCode(200);
    }
}
