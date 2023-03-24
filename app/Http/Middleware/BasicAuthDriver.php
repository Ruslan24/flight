<?php

namespace App\Http\Middleware;

use Illuminate\Auth\GuardHelpers;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Contracts\Auth\Guard;

class BasicAuthDriver implements Guard
{
    use GuardHelpers;

    public function user()
    {

        die(print_r('dfdfdfd'));
        return $this->getUser();
    }

    public function validate(array $credentials = [])
    {
        die(print_r('dfdfdfd'));
        $username = $credentials['username'] ?? '';
        $password = $credentials['password'] ?? '';

        if (empty($username) || empty($password)) {
            return false;
        }

        // Authenticate the user here using the $username and $password
        // Return true if authentication succeeds, false otherwise
        // For example, you could use Laravel's built-in User model and the Hash facade:
        // $user = User::where('username', $username)->first();
        // return $user && Hash::check($password, $user->password);

        return true;
    }
}
