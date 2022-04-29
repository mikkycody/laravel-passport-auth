<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Password;

class LoginRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'email' => ['required', 'string', filter_var(request()->email, FILTER_VALIDATE_EMAIL) ? 'email:rfc,dns' : '', 'max:255'], // validate email is required, string, valid, and max 255 characters
            'password' => ['required', Password::defaults()], // validate password is required, is at least 8 characters long, contains letters, numbers, special characters and has not been in a data breach/leak
        ];
    }
}
