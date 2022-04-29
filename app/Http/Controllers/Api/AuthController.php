<?php

namespace App\Http\Controllers\Api;

use App\Actions\User\UserActions;
use App\Http\Controllers\Controller;
use App\Http\Requests\RegisterRequest;
use Illuminate\Support\Facades\DB;

class AuthController extends Controller
{    
    /**
     * Handles User Registration
     *
     * @param  mixed $request
     * @return void
     */
    public function register(RegisterRequest $request)
    {
        try{
        //Ensuring database is in a consistent state
        DB::beginTransaction(); 
        // Create a new user with the input from the request
        $user = UserActions::create();

        // Return the newly created user and the access token
        $response = $this->returnToken($user, 201); // pass the user object and status code to the response
        DB::commit();
        return $response;
        }catch(\Exception $e){
            //rollback to ensure data integrity.
            DB::rollback();
            // Internal server error can be changed to something more meaningful or $e->getMessage() to geet the real exception message
            return $this->response(500, false, $e->getMessage());
        }
    }
}
