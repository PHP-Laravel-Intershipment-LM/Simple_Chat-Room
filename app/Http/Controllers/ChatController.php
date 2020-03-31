<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\ChatRepository;

class ChatController extends Controller
{

    private $chatRepository;

    public function __construct(ChatRepository $chatRepository)
    {
        $this->chatRepository = $chatRepository;
    }

    public function index(Request $request)
    {
        // Check if request is not valid
        if (!$request->filled('id_active') || !$request->filled('content')) {
            return response()->json($request->all());
        }

        // Save content and send it to another user is online
        $result = $this->chatRepository->create([
            'id_active'    => $request->input('id_active', 1),
            'message'       => $request->input('content', null)
        ]);

        return response()->json($result);
    }
}
