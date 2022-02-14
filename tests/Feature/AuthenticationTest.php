<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class AuthenticationTest extends TestCase
{
    public function testRequiredFieldsForSignup()
    {
        $this->json('POST', 'api/create-account', ['Accept' => 'application/json'])
            ->assertStatus(422)
            ->assertJson([
                "message" => "The given data was invalid.",
                "errors" => [
                    "name" => ["The name field is required."],
                    "email" => ["The email field is required."],
                    "password" => ["The password field is required."],
                ]
            ]);
    }

    public function testRepeatPassword()
    {
        $userData = [
            "name" => "Nisarg Bhavsar",
            "email" => "nisargbhavsar24@gmail.com",
            "password" => "nisarg@123"
        ];

        $this->json('POST', 'api/create-account', $userData, ['Accept' => 'application/json'])
            ->assertStatus(422)
            ->assertJson([
                "message" => "The given data was invalid.",
                "errors" => [
                    "password" => ["The password confirmation does not match."]
                ]
            ]);
    }

    public function testSuccessfullySignup()
    {
        $userData = [
            "name" => "Nisarg Bhavsar",
            "email" => 'nisargbhavsar'.rand(1, 999999).'@gmail.com',
            "password" => "nisarg@123",
            "password_confirmation" => "nisarg@123"
        ];

        $this->json('POST', 'api/create-account', $userData, ['Accept' => 'application/json'])
            ->assertStatus(200)
            ->assertJsonStructure([
                "status",
                "message",
                "data" => [
                    "token"
                ]
            ]);
    }

    public function testRequiredFieldsSignin()
    {
        $this->json('POST', 'api/signin')
            ->assertStatus(422)
            ->assertJson([
                "message" => "The given data was invalid.",
                "errors" => [
                    'email' => ["The email field is required."],
                    'password' => ["The password field is required."],
                ]
            ]);
    }

    public function testSuccessfullySignin()
    {
        $loginData = [
            'email' => 'admin@aspire.com', 
            'password' => 'password'
        ];

        $this->json('POST', 'api/signin', $loginData, ['Accept' => 'application/json'])
            ->assertStatus(200)
            ->assertJsonStructure([
                "status",
                "message",
                "data" => [
                    "token"
                ]
            ]);

        $this->assertAuthenticated();
    }
}
