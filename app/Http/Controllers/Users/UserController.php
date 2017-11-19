<?php

namespace App\Http\Controllers\Users;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\UserRegisterRequest;
use App\Http\Requests\Auth\UserUpdateRequest;
use App\Repositories\Eloquent\UserRepository;

class UserController extends Controller
{
    protected $userRepo;

    function __construct(UserRepository $userRepo)
    {
        $this->middleware('auth');
        $this->userRepo = $userRepo;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($slug)
    {
        $user = $this->userRepo->requiredBySlug($slug);

        youAreDenied('update', $user);

        return view('users.profile.create', compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($slug)
    {
        $user = $this->userRepo->requiredBySlug($slug);

        youAreDenied('update', $user);

        return view('users.profile.edit', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UserUpdateRequest $request, $id)
    {
        $user = $this->userRepo->requiredById($id);
        youAreDenied('update', $user);

        $user = $this->userRepo->updateUser($user, $request);
        
        return back()->withStatus('Profile updated successfully'); 

    }

}
