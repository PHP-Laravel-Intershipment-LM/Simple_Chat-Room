<?php

namespace App\Http\Controllers;

use App\Repositories\UserRepository;
use Illuminate\Http\Request;

class HomeController extends Controller
{

    private $userRepository;

    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function index(Request $request) 
    {
        $idUser = $request->session()->get('nameUser', false);
        if (!$idUser) {
            // Redirect to login page
            return redirect('login');
        }
        // Load home page
        return view('index');
    }
}
