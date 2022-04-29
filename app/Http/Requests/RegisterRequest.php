<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Password;

class RegisterRequest extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'name' => ['required','string','max:255'], // validate name is required, string, and max 255 characters
            'email' => ['required','string', 'email:rfc,dns','max:255','unique:users'], // validate email is required, string, valid, max 255 characters and unique to each user
            'phone_number' => ['required','string','max:255','unique:users'], // validate phone_number is required, string, max 255 characters and unique to each user
            'password' => ['required',Password::defaults()], // validate password is required, is at least 8 characters long, contains letters, numbers, special characters and has not been in a data breach/leak
        ];
    }
}
