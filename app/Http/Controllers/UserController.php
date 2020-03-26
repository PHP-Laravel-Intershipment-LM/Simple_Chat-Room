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
        if ($request->session()->get('idUser', false)) {
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
            $idUser = $this->userRepository->visible(['id'])->findByField('username', $request->get('username'));
            $request->session()->put('idUser', $idUser);
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
