<?php

namespace App\Http\Controllers;

use App\Repositories\ActiveRepository;
use App\Repositories\ChatRepository;
use Illuminate\Http\Request;

class HomeController extends Controller
{

    private $chatRepository;
    private $activeRepository;

    public function __construct(ChatRepository $chatRepository, ActiveRepository $activeRepository)
    {
        $this->chatRepository = $chatRepository;
        $this->activeRepository = $activeRepository;
    }

    public function index(Request $request) 
    {
        $idUser = $request->session()->get('idUser', false);
        $nameUser = $request->session()->get('nameUser', false);
        if (!$nameUser || !$idUser) {
            // Redirect to login page
            return redirect('login');
        }
        // Retrive user related data
        $rooms = $this->activeRepository->findByField('id_user', $idUser); // List room of user
        $chatroom = []; // Chat content in chatroom
        foreach ($rooms as $room) {
            $id_active = $room['id'];
            $content = $this->chatRepository->findByField('id_actives', $id_active)->toArray();
            array_push($chatroom, [
                'id_room'   => $room['id_room'],
                'content'   => $content
            ]);
        }
        // Add current id_active to session
        if (sizeof($chatroom) > 0) {
            $request->session()->put('idActive', $rooms[0]['id']);
        }
        // Load home page
        return view('index', ['data' => $chatroom]);
    }
}
