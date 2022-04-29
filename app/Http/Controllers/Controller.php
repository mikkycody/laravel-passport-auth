<?php

namespace App\Http\Controllers;

use App\Http\Resources\UserResource;
use Carbon\Carbon;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
        
    /**
     * Response helper
     *
     * @param  mixed $statusCode
     * @param  mixed $status
     * @param  mixed $message
     * @param  mixed $data
     * @return void
     */
    protected function response($statusCode, $status, $message, $data = null)
    {
        return response()->json([
            'status' => $status,
            'message' => $message,
            'data' => $data,
        ], $statusCode);
    }

    protected function returnToken($user, $statusCode = 200)
    {
        $user->access_token = $user->createToken('Laravel Personal Access Client')->accessToken;
        $user->token_type = 'Bearer';
        $user->update();
        return $this->response($statusCode, true, 'User Authenticated Successfully', new UserResource($user));
    }
}
