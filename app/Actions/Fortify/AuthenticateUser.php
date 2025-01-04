<?php

namespace App\Actions\Fortify;


use App\Models\Admin;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthenticateUser
{
  public function authenticate($request)
  {

    $username = $request->post(config('fortify.username')); // config('fortify.username') == email
    $password = $request->post(config('fortify.passwords')); //config('fortify.passwords') => 'users'

    $user = Admin::where('username', '=', $username)
                ->orWhere('email', '=', $username)
                ->orWhere('phone_number' , '=' ,$username)
                ->where('password' , '=' ,md5($password))
                ->first();

    if ($user) {
        return $user;
    }
    return false;
     /**
      *  in laravel 9  Dont use  ->where('password' , '=' ,md5($password)
      *
      * if( $user && Hash::check($password ,$user->password) ){
      *  return $user;
      *    }
      *  return false;
     */
  }
}
