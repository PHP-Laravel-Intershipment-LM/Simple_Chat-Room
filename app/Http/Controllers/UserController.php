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
            // Login success. Change property isLogin in table and get user id to session and redirect to home page
            $user = $this->userRepository->findByField('username', $request->get('username'))[0];
            $this->userRepository->update(['isOnline' => 1], $user['id']);
            $request->session()->put('nameUser', $user['name']);
            $request->session()->put('idUser', $user['id']);
            return redirect('');
        } else {
            // Login failed. Notify and reload page login
            return view('login', [
                'error'     => true, 
                'message'   => 'Username or password is failed'
            ]);
        }
    }

    public function userLogout(Request $request) {
        // Get id of current user or break if failed
        $idUser = $request->session()->get('idUser', false);
        if (!$idUser) {
            return false;
        }

        // Update column isLogin in database
        $this->userRepository->update(['isOnline' => 0], $idUser);

        // Delete session of this user
        $request->session()->forget('idUser');
        $request->session()->forget('nameUser');
        
        // Redirect to login page
        return redirect('/login');
    }
}
