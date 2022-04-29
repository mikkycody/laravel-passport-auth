<?php

namespace App\Http\Controllers\Api;

use App\Actions\User\UserActions;
use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use App\Queries\User\UserQueries;
use Illuminate\Support\Facades\Auth;
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
        try {
            //Ensuring database is in a consistent state
            DB::beginTransaction();

            // Create a new user with the input from the request
            $user = UserActions::create();

            // Return the newly created user and the access token
            $response = $this->returnToken($user, 201); // pass the user object and status code to the response
            DB::commit();
            return $response;
        } catch (\Exception $e) {
            //rollback to ensure data integrity.
            DB::rollback();
            // Internal server error can be changed to something more meaningful or $e->getMessage() to get the real exception message
            return $this->response(500, false, 'Internal Server Error');
        }
    }

    /**
     * Handles User Login
     *
     * @param  mixed $request
     * @return void
     */
    public function login(LoginRequest $request)
    {
        try {
            //check user exists in the database
            if (!UserQueries::findUserByEmailOrPhoneNumber($request->email)) {
                return $this->response(400, false, 'User not found');
            }
            // Login a user with the input from the request
            $loginInput = filter_var($request->email, FILTER_VALIDATE_EMAIL) ? 'email' : 'phone_number';
            if (Auth::attempt(array($loginInput => $request->email, 'password' => $request->password))) {
                // Return the user and the access token
                return $this->returnToken(Auth::user()); // return user object and access token 
            }
            return $this->response(401, false, 'Unauthorized, Invalid Credentials');
        } catch (\Exception $e) {
            // Internal server error can be changed to something more meaningful or $e->getMessage() to get the real exception message
            return $this->response(500, false, 'Internal Server Error');
        }
    }
}
