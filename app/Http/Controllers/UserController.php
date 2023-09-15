<?php

namespace App\Http\Controllers;

use App\Console\Constants\UserResponseEnum;
use App\Http\Requests\User\StoreRequest;
use App\Http\Requests\User\UpdateRequest;
use App\Http\Resources\UserResource;
use App\Models\User;
use App\Services\UserService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{
    public function __construct(protected readonly UserService $userService)
    {
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = $this->userService->userList();
        return response([
            'data' => UserResource::collection($data),
            'message' => UserResponseEnum::USERS_LIST,
            'succes' => true
        ]);
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreRequest $storeRequest)
    {
        $data = $this->userService->userStore($storeRequest->validated());
        return response([
            'data' => UserResource::make($data),
            'message' => UserResponseEnum::USER_CREATE,
            'success' => true,
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
        return response([
            'data' => UserResource::make($user),
            'message' => UserResponseEnum::USER_CREATE,
            'success' => true,
        ]);
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateRequest $updateRequest, User $user)
    {
        $data = $this->userService->userUpdate($updateRequest->validated(), $user);
        return response([
            'data' => UserResource::make($data),
            'message' => UserResponseEnum::USER_UPDATED,
            'success' => true
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        $this->userService->userDelete($user);

        return response([
            'message' => UserResponseEnum::USER_DELETED,
            'success' => true,
        ]);
    }
}
