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
        return response()->json($request->post());
    }
}
