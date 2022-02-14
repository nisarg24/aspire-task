<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\CreateAccountRequest;
use App\Http\Requests\SigninRequest;
use App\Models\User;
use App\Http\Traits\ResponseTrait;

class AuthenticationController extends Controller
{
    use ResponseTrait;

    public function createAccount(CreateAccountRequest $request)
    {
        try {
            $user = User::create(
                [
                    'name' => $request->name,
                    'password' => bcrypt($request->password),
                    'email' => $request->email
                ]
            );
    
            $data['token'] = $user->createToken('token')->plainTextToken;
    
            return $this->success(
                'Successfully registerd',
                $data
            );
        } catch (\Exception $e) {
            return $this->error(
                403,
                $e->getMessage()
            );
        }
        
    }

    public function signin(SigninRequest $request)
    {
        try {
            $credentials = $request->only('email', 'password');

            if (!\Auth::attempt($credentials)) {
                return $this->error(401, 'Invalid credential');
            }

            $data['token'] = auth()->user()->createToken('token')->plainTextToken;

            return $this->success(
                'Successfully login',
                $data
            );
        } catch (\Exception $e) {
            return $this->error(
                403,
                $e->getMessage()
            );
        }
    }

    public function signout()
    {
        try {
            auth()->user()->tokens()->delete();
            return $this->success(
                'Successfully logout'
            );
        } catch(\Exception $e) {
            return $this->error(
                403,
                $e->getMessage()
            );
        }
    }
}
