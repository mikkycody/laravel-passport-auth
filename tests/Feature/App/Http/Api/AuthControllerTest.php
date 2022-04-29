<?php

namespace Tests\Feature\App\Http\Api;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\User;
use Laravel\Passport\Passport;


class AuthControllerTest extends TestCase
{
    use RefreshDatabase;

    public function setUp(): void
    {
        parent::setUp();

        $this->registration_data =
            [
                'name' => 'Bush',
                'password' => 'AstrongPassword1#',
                'phone_number' => '08000000000',
                'email' => 'mikkycody@gmail.com',
            ];
        $this->login_with_email =
            [
                'email' => 'mikkycody@gmail.com',
                'password' => 'AstrongPassword1#',
            ];
        $this->login_with_phone_number =
            [
                'email' => '08000000000',
                'password' => 'AstrongPassword1#',
            ];
        \Illuminate\Support\Facades\Artisan::call('passport:install');
    }


    /**
     * Test that a user should not signup without name.
     *
     * @return void
     */

    public function test_that_user_should_not_sign_up_with_no_name()
    {
        // Remove the name from the registration data.
        unset($this->registration_data['name']);

        $response = $this->json('POST', route('auth.register'), $this->registration_data);

        $response->assertJsonValidationErrors(['name']);

        $response->assertJson([
            "message" => "The name field is required.",
        ]);

        $response->assertStatus(422);
    }

    /**
     * Test that a user should not signup without password.
     *
     * @return void
     */

    public function test_that_user_should_not_sign_up_with_no_password()
    {
        // Remove the password from the registration data.
        unset($this->registration_data['password']);

        $response = $this->json('POST', route('auth.register'), $this->registration_data);

        $response->assertJsonValidationErrors(['password']);

        $response->assertJson([
            "message" => "The password field is required.",
        ]);

        $response->assertStatus(422);
    }

    /**
     * Test that a user should not signup without email.
     *
     * @return void
     */

    public function test_that_user_should_not_sign_up_with_no_email()
    {
        // Remove the email from the registration data.
        unset($this->registration_data['email']);

        $response = $this->json('POST', route('auth.register'), $this->registration_data);

        $response->assertJsonValidationErrors(['email']);

        $response->assertJson([
            "message" => "The email field is required.",
        ]);

        $response->assertStatus(422);
    }

    /**
     * Test that a user should not signup without phone number.
     *
     * @return void
     */

    public function test_that_user_should_not_sign_up_with_no_phone_number()
    {
        // Remove the phone_number from the registration data.
        unset($this->registration_data['phone_number']);

        $response = $this->json('POST', route('auth.register'), $this->registration_data);

        $response->assertJsonValidationErrors(['phone_number']);

        $response->assertJson([
            "message" => "The phone number field is required.",
        ]);

        $response->assertStatus(422);
    }

    /**
     * Test that a user should not signup with an invalid email.
     *
     * @return void
     */

    public function test_that_user_should_not_sign_up_with_invalid_email()
    {
        // Set the email key to an invalid email.
        $this->registration_data['email'] = "something@invalid.conn";

        $response = $this->json('POST', route('auth.register'), $this->registration_data);

        $response->assertJsonValidationErrors(['email']);

        $response->assertJson([
            "message" => "The email must be a valid email address.",
        ]);

        $response->assertStatus(422);
    }


    /**
     * Test that a user can signup.
     *
     * @return void
     */
    public function test_that_user_can_sign_up()
    {
        $response = $this->json('POST', route('auth.register'), $this->registration_data);

        $response->assertStatus(201);
    }

    /**
     * Test that a user can not not signin with no email.
     *
     * @return void
     */
    public function test_that_user_should_not_sign_in_with_no_email()
    {
        // Remove the email from the login data.
        unset($this->login_with_email['email']);

        $response = $this->json('POST', route('auth.login'), $this->login_with_email);

        $response->assertJsonValidationErrors(['email']);

        $response->assertJson([
            "message" => "The email field is required.",
        ]);

        $response->assertStatus(422);
    }

    /**
     * Test that a user can not not signin with an invalid email.
     *
     * @return void
     */
    public function test_that_user_should_not_sign_in_with_invalid_email()
    {
        // Set the email key to an invalid email.
        $this->login_with_email['email'] = "something@invalid.conn";

        $response = $this->json('POST', route('auth.login'), $this->login_with_email);

        $response->assertJsonValidationErrors(['email']);

        $response->assertJson([
            "message" => "The email must be a valid email address.",
        ]);

        $response->assertStatus(422);
    }

    /**
     * Test that a user can not not signin with no password.
     *
     * @return void
     */
    public function test_that_user_should_not_sign_in_with_no_password()
    {
        // Remove the password from the login data.
        unset($this->login_with_email['password']);

        $response = $this->json('POST', route('auth.login'), $this->login_with_email);

        $response->assertJsonValidationErrors(['password']);

        $response->assertJson([
            "message" => "The password field is required.",
        ]);

        $response->assertStatus(422);
    }

    /**
     * Test that a user can not not signin with wrong credentials.
     *
     * @return void
     */
    public function test_that_user_should_not_sign_in_with_wrong_credentials()
    {
        $this->test_that_user_can_sign_up(); //signup user

        $data = [
            //wrong login details
            'email' => $this->registration_data['email'],
            'password' => 'Thisiswrong123!#'
        ];

        $response = $this->json('POST', route('auth.login'), $data);

        $response->assertStatus(401);
    }

    /**
     * Test that a user can signin with email.
     *
     * @return void
     */
    public function test_that_user_can_sign_in_with_email()
    {
        $this->test_that_user_can_sign_up(); //signup user

        $response = $this->json('POST', route('auth.login'), $this->login_with_email);

        $response->assertStatus(200);
    }

    /**
     * Test that a user can signin with phone number.
     *
     * @return void
     */
    public function test_that_user_can_sign_in_with_phone_number()
    {
        $this->test_that_user_can_sign_up(); //signup user

        $response = $this->json('POST', route('auth.login'), $this->login_with_phone_number);

        $response->assertStatus(200);
    }
}
