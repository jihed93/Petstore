<?php

namespace App\Repositories;

use Illuminate\Support\Facades\DB;
use App\Interfaces\UserRepositoryInterface;
use Illuminate\Http\Request;


use App\Models\User;
use App\Models\ApiResponse;





class UserRepository implements UserRepositoryInterface
{
    public function getUserByEmail($email)
    {
        $user = User::where('email', $email)->first();
        return $user;
    }
}
