<?php


namespace App\Services;


use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthService
{

    /**
     * @param $request
     * @return bool
     */
    public function login($request): bool
    {
        $credentials = $request->only('email', 'password');
        if (Auth::attempt($credentials)) {
            return true;
        }

        return false;
    }

    /**
     * @param $request
     */
    public function signup($request)
    {
        $data = $request->all();
        $this->create($data);
    }

    /**
     * @param array $data
     * @return mixed
     */
    public function create(array $data)
    {
        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password'])
        ]);
    }
}
