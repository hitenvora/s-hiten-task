<?php

namespace App\Http\Controllers;

use App\Models\Profile;
use App\Models\Role;
use App\Models\User;
use App\Traits\CaptureIpTrait;
use App\Traits\File;
use Auth;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Hash;
use Validator;
use View;

class UsersManagementController extends Controller
{
    Use File;
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
    //     $this->middleware('auth');
     }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function add(Request $request)
    {

        //$request=$request->all();
//         print_r($request);
// exit;


 $request->validate([
            'password'              => 'required|min:6|max:20|confirmed',
            'password_confirmation' => 'required|same:password',
        ]);
        $image="";
        if($request->image){
            $image = $this->resizeImage($request->image,'/user_image');

        }
        $user = User::create([
            'name'             => strip_tags($request->input('name')),
            'username'       => strip_tags($request->input('user_name')),
            'phone_no'        => strip_tags($request->input('phone_no')),
            'email'            => $request->input('email'),
            'password'         => Hash::make($request->input('password')),
            'active'        => '1',
            'image'=>$image
        ]);
        $user->save();

        return redirect('users')->with('success', trans('usersmanagement.createSuccess'));

    }
    public function index()
    {
        // $paginationEnabled = config('usersmanagement.enablePagination');
        // if ($paginationEnabled) {
        //     $users = User::paginate(config('usersmanagement.paginateListSize'));
        // } else {
        //     $users = User::all();
        // }
        // $roles = Role::all();

        return View('pages.users-layout-1');


    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // $roles = Role::all();

        return view('usersmanagement.create-user');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

    }

    /**
     * Display the specified resource.
     *
     * @param  User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        return view('usersmanagement.show-user', compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request)
    {
       // echo $request->id;

        $userData=User::find($request->id);
        // print_r($userData
        return View('usersmanagement.edit')->with('user',$userData)->with('id',$request->id);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $data = $request->all();
       // print_r($data);

       $user = User::find($request->id);

//dd($user);

            $image="";
            if($request->image){
                $image = $this->resizeImage($request->image,'/user_image');

            }
            $user->name = strip_tags($request->input('name'));
            $user->username = strip_tags($request->input('username'));
            $user->phone_no = strip_tags($request->input('phone_no'));
            $user->email = $request->input('email');
            if ($request->hasFile('image') && $request->file('image')->isValid()) {
                $imagePath = $this->resizeImage($request->file('image'), '/user_image');
                $user->image = $imagePath;
            }

            $user->save();

           return redirect('users')->with('success', trans('usersmanagement.createSuccess'));

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {

    }

    /**
     * Method to search the users.
     *
     * @param  Request  $request
     * @return \Illuminate\Http\Response
     */
    public function search(Request $request)
    {

    }
}
