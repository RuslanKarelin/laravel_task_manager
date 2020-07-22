<?php

namespace App\Factories;

use \App\Interfaces\Factories\IUserFactory;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\File;

class UserFactory implements IUserFactory
{
    /**
     * @param Request $request
     * @param int $id
     * @return mixed|void
     */
    public function updatePassword(Request $request, int $id)
    {
        User::findOrFail($id)->update(['password' => Hash::make($request->input('new_password'))]);
    }

    /**
     * @param Request $request
     * @param int $id
     * @return mixed|void
     */
    public function updateInfo(Request $request, int $id)
    {
        $user = User::findOrFail($id);
        $user->update($request->all());
        $user->profile->update($request->all());
        if ($request->has('avatar')) {
            $this->uploadAvatar($request, $user);
        }
    }

    /**
     * @param Request $request
     * @param $user
     */
    public function uploadAvatar(Request $request, $user)
    {
        $avatarName = time() . $request->file('avatar')->getClientOriginalName();
        Image::make($request->file('avatar'))
            ->resize(config('taskmanager.avatar_width'), null, function ($constraint) {
                $constraint->aspectRatio();
                $constraint->upsize();
            })->save(config('taskmanager.avatar_path') . $avatarName);

        if (!empty($user->profile->image)) {
            $currentAvatarPath = config('taskmanager.avatar_path') . $user->profile->image->filename;
            $user->profile->image->delete();
            File::delete($currentAvatarPath);
        }

        $user->profile->image()->create(['filename' => $avatarName]);
    }
}