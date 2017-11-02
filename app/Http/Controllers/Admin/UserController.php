<?php

namespace App\Http\Controllers\Admin;

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
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $q = $request->q;
        $confirmed = $request->confirmed;
        $admin = $request->admin;
        $sort = $request->sort;

        $users = $this->userRepo->fetchAll()->paginate(20);

        return view('admin.users.index', compact('users', 'q', 'confirmed', 'admin', 'sort'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        youAreDenied('create', authUser());
        $user = $this->userRepo->getNew();
        return view('admin.users.create', compact('user'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(UserRegisterRequest $request)
    {
        youAreDenied('create', authUser());
        
        $user = $this->userRepo->registerUser($request->all(), NULL);

        return redirect()->route('admin.users.index')->withStatus('New user created');
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

        return view('admin.users.create', compact('user'));
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

        return view('admin.users.create', compact('user'));
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

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function getSellRequest(Request $request)
    {
        
    }
}
