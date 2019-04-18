<?php

namespace App\Http\Controllers;


use App\Http\Requests\GetUserListRequest;
use App\Services\UserService;
use Illuminate\Support\Arr;

class UsersController extends Controller
{

    private $userService;

    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    public function index(GetUserListRequest $request)
    {
        $requestData = $request->validated();
        $page = Arr::get($requestData, 'page', 1);
        $perPage = Arr::get($requestData, 'perPage', 10);

        return response()->json($this->userService->getUserList($page, $perPage));
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