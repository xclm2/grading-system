<?php
namespace App\Http\Controllers;

use App\Models\User;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
class UserController extends Controller
{

    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');
        Auth::attempt($credentials);
        return redirect()->intended('/');
    }

    public function createtest(Request $request)
    {
        $user = new User();
        $user->password = Hash::make('admin123');
        $user->email = 'admin@example.com';
        $user->firstname = 'George';
        $user->lastname = 'Bugwak';
        $user->type = 2;
        $user->save();
    }
}