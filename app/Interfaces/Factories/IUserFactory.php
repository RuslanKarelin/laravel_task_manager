<?php

namespace App\Interfaces\Factories;

use Illuminate\Http\Request;

interface IUserFactory
{
    /**
     * @param Request $request
     * @param int $id
     * @return mixed
     */
    public function updatePassword(Request $request, int $id);

    /**
     * @param Request $request
     * @param int $id
     * @return mixed
     */
    public function updateInfo(Request $request, int $id);

    /**
     * @param Request $request
     * @param $user
     * @return mixed
     */
    public function uploadAvatar(Request $request, $user);
}