<?php

namespace App\Http\Controllers;


use App\Http\Requests\GetUserListRequest;
use App\Services\FriendsService;
use App\Services\UserService;
use Illuminate\Support\Arr;

class FriendsController extends Controller
{

    private $friendsService;

    public function __construct(FriendsService $friendsService)
    {
        $this->friendsService = $friendsService;
    }

    public function index(int $userId, GetUserListRequest $request)
    {
        $requestData = $request->validated();
        $page = Arr::get($requestData, 'page', 1);
        $perPage = Arr::get($requestData, 'perPage', 10);

        return response()->json($this->friendsService->getFriendsOfUserByUserId($userId, $page, $perPage));
    }

    public function store()
    {

    }

    public function destroy()
    {

    }

    public function update()
    {

    }
}