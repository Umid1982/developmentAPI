<?php

namespace App\Services;

use App\Models\User;
use Illuminate\Support\Facades\Storage;

class UserService
{
    /** @throws \Exception */

    public function userList()
    {
        return User::all();
    }

    public function userStore($validate)
    {
        $validate['avatar_path'] = Storage::disk('public')->put('avatars', $validate['avatar_path']);
        $user = User::query()->create($validate);

        return $user;
    }

    public function userUpdate($validate,User $user)
    {
        if (isset($validate['avatar_path'])) {
            Storage::disk('public')->delete('avatars', $user->avatar_path);
            $validate["avatar_path"] = Storage::disk('public')->put('avatars', $validate['avatar_path']);
        }

        $user->update($validate);

        return $user->refresh();
    }

    public function userDelete(User $user)
    {
        $user->delete();

        Storage::disk('public')->delete('avatars', $user->avatar_path);

        return true;
    }
}
