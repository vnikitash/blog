<?php

namespace App\Http\Controllers;


use App\Http\Requests\GenerateUsersRequest;
use App\Services\TestDataService;
use Illuminate\Support\Arr;

class TestDataController extends Controller
{

    private $testDataService;

    public function __construct(TestDataService $testDataService)
    {
        $this->testDataService = $testDataService;
    }

    public function generate(GenerateUsersRequest $request)
    {
        $usersCount = Arr::get($request->validated(), 'userCount');


        return response(
            [
                'status' => $this->testDataService->generateRandomUsersAmount($usersCount)
            ]
        );
    }
}