<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;
use App\Models\Loan;
use Laravel\Sanctum\Sanctum;

class LoanTest extends TestCase
{
    public function testRequiredFieldLoan()
    {
        $userData = [
            "name" => "Nisarg Bhavsar",
            "email" => 'nisargbhavsar'.rand(1, 999999).'@gmail.com',
            "password" => "nisarg@123",
            "password_confirmation" => "nisarg@123"
        ];
        $user = User::create($userData);

        Sanctum::actingAs($user);

        $this->json('POST', 'api/create-loan', ['Accept' => 'application/json'])
            ->assertStatus(422)
            ->assertJson([
                "message" => "The given data was invalid.",
                "errors" => [
                    "amount" => ["The amount field is required."],
                    "term" => ["The term field is required."],
                    "is_month" => ["The is month field is required."],
                    "start_date" => ["The start date field is required."],
                ]
            ]);
    }

    public function testCreateLoan()
    {
        $userData = [
            "name" => "Nisarg Bhavsar",
            "email" => 'nisargbhavsar'.rand(1, 999999).'@gmail.com',
            "password" => "nisarg@123",
            "password_confirmation" => "nisarg@123"
        ];
        $user = User::create($userData);

        Sanctum::actingAs($user);

        $loanData = [
            "amount" => 55000,
            "term" => 9,
            "is_month" => 1,
            "start_date" => "2022-02-14"
        ];

        $this->json('POST', 'api/create-loan', $loanData, ['Accept' => 'application/json'])
            ->assertStatus(200)
            ->assertJsonStructure([
                "status",
                "message",
                "data" => [
                    "user_id",
                    "code",
                    "amount",
                    "term",
                    "is_month",
                    "start_date",
                    "end_date",
                    "updated_at",
                    "created_at",
                    "id"
                ]
            ]);
    }

    public function testApproveLoan()
    {
        $userData = [
            "name" => "Nisarg Bhavsar",
            "email" => 'nisargbhavsar'.rand(1, 999999).'@gmail.com',
            "password" => "nisarg@123",
            "password_confirmation" => "nisarg@123"
        ];
        $user = User::create($userData);

        Sanctum::actingAs($user);

        $loan = Loan::orderBy('id', 'desc')->first();

        $loanData = [
            'loan_id' => $loan->id
        ];

        $this->json('POST', 'api/approve-loan', $loanData, ['Accept' => 'application/json'])
            ->assertStatus(200)
            ->assertJsonStructure([
                "status",
                "message",
                "data"
            ]);
    }
}
