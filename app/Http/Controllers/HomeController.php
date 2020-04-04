<?php

namespace App\Http\Controllers;

use App\Repositories\ActiveRepository;
use App\Repositories\ChatRepository;
use App\Repositories\UserRepository;
use Illuminate\Http\Request;

class HomeController extends Controller
{

    private $chatRepository;
    private $activeRepository;
    private $userRepository;

    public function __construct(ChatRepository $chatRepository, ActiveRepository $activeRepository, UserRepository $userRepository)
    {
        $this->chatRepository = $chatRepository;
        $this->activeRepository = $activeRepository;
        $this->userRepository = $userRepository;
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
        $rooms = $this->activeRepository->getActivesOfUser($idUser); // List all active for user's room
        for ($i = 0; $i < sizeof($rooms); $i++) {
            // List all message of room
            $actives = $rooms[$i]['actives'];
            $rooms[$i]['contents'] = [];
            foreach ($actives as $active) {
                $content['messages'] = $this->chatRepository->findByField('id_active', $active['id'])->toArray();
                if (sizeof($content['messages']) > 0) {
                    // Add user info to each messagemessage
                    $userInfo = $this->userRepository->find($active['id_user'])->toArray();
                    foreach ($content['messages'] as $message) {
                        $message['name_user'] = $userInfo['name'];
                        array_push($rooms[$i]['contents'], $message);
                    }
                }
            }
            // Remove list actives in room
            unset($rooms[$i]['actives']);
        }
        // Add current id_active to session
        if (sizeof($rooms) > 0) {
            $request->session()->put('idActive', $this->activeRepository->findByField('id_user', $idUser)[0]['id']);
        }
        // Sort message in room follow time create
        usort($rooms[0]['contents'], function($item1, $item2) {
            return $item1['created_at'] > $item2['created_at'];
        });
        // Load home page
        return view('index', ['messages' => $rooms]);
    }
}
