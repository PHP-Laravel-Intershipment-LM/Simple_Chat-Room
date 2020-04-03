<?php

namespace App\Http\Controllers;

use Laravolt\Avatar\Avatar;
use App\Events\ChatEvent;
use App\Repositories\ActiveRepository;
use Illuminate\Http\Request;
use App\Repositories\ChatRepository;
use App\Repositories\UserRepository;

class ChatController extends Controller
{

    private $chatRepository, $activeRepository, $userRepository;

    public function __construct(ChatRepository $chatRepository, ActiveRepository $activeRepository, UserRepository $userRepository)
    {
        $this->chatRepository = $chatRepository;
        $this->activeRepository = $activeRepository;
        $this->userRepository = $userRepository;
    }

    public function index(Request $request)
    {
        // Check if request is not valid
        if (!$request->filled('id_active') || !$request->filled('avatar') || !$request->filled('content')) {
            return response()->json(['status' => false]);
        }

        // Save content and send it to another user is online
        $id_active = $request->input('id_active', 1);
        $content = $request->input('content', null);
        $avatar = $request->input('avatar', null);
        $result = $this->chatRepository->create([
            'id_active'    => $request->input('id_active', 1),
            'message'       => $request->input('content', null)
        ]);
        // Get name user from id_active
        $idUser = $this->activeRepository->find($id_active)['id_user'];
        $nameUser = $this->userRepository->find($idUser)['name'];
        event(new ChatEvent($nameUser, $avatar, $content));

        return response()->json(['status' => true]);
    }
}
