<?php

namespace App\Http\Controllers;

use App\Repositories\UserRepository;
use Illuminate\Http\Request;

class UserController extends Controller
{
    private $userRepository;

    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function index(Request $request)
    {
        // Check if user is login or not
        if ($request->session()->get('nameUser', false)) {
            return redirect('');
        }
        return view('login');
    }

    public function userLogin(Request $request)
    {
        // Check if request is not valid
        if (!$request->filled('username') || !$request->filled('password')) {
            return view('login', [
                'error'     => true, 
                'message'   => 'Username or password not filled'
            ]);
        }

        $loginResult = $this->userRepository->login($request->all());
        if ($loginResult) {
            // Login success. Get user id to session and redirect to home page
            $nameUser = $this->userRepository->findByField('username', $request->get('username'))[0]['name'];
            $request->session()->put('nameUser', $nameUser);
            return redirect('');
        } else {
            // Login failed. Notify and reload page login
            return view('login', [
                'error'     => true, 
                'message'   => 'Username or password is failed'
            ]);
        }
    }
}
