<?php

namespace App\Http\Controllers\TaskManager;

use App\Http\Requests\ChangePasswordUserRequest;
use App\Interfaces\Repositories\IUserRepository;
use App\Interfaces\Factories\IUserFactory;
use App\Http\Requests\UserInfoRequest;

class ProfileController extends BaseController
{
    protected $userRepository;
    protected $userFactory;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(IUserRepository $userRepository, IUserFactory $userFactory)
    {
        $this->userRepository = $userRepository;
        $this->userFactory = $userFactory;
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function edit(int $id)
    {
        return view('taskmanager.profile.edit', ['user' => $this->userRepository->getById($id)]);
    }

    /**
     * @param UserInfoRequest $request
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function updateUserInfo(UserInfoRequest $request, int $id)
    {
        $this->userFactory->updateInfo($request, $id);
        return redirect(route('profile.edit', $id))->with('status', 'profile info updated, id=' . $id);
    }

    /**
     * @param ChangePasswordUserRequest $request
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function updateUserPassword(ChangePasswordUserRequest $request, int $id)
    {
        $this->userFactory->updatePassword($request, $id);
        return redirect(route('profile.edit', $id))->with('status', 'user password updated, id=' . $id);
    }
}
