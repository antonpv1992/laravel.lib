<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Requests\UserRequest;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     // @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if($request->ajax()){
            $data = User::all('id', 'login', 'email', 'name', 'surname', 'age');
            return response($data->toJson());
        }
        $users = User::all('id', 'login', 'email', 'name', 'surname', 'age');
        $content = 'components/users';
        return view('welcome', compact('users','content'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     // @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(UserRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param   $login
     // @return \Illuminate\Http\Response
     */
    public function show($login)
    {
        $content = 'components/profile';
        $user = User::where('login', $login)->first();
        return view('welcome', compact('content', 'user'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  $login
     // @return \Illuminate\Http\Response
     */
    public function edit($login)
    {
        $content = 'components/edit';
        $user = User::where('login', $login)->first();
        return view('welcome', compact('content', 'user'));
    }

    /**
     * Update the specified resource in storage.
     *
     // @param  \Illuminate\Http\Request  $request
     * @param   $login
     // @return \Illuminate\Http\Response
     */
    public function update(UserRequest $request, $login)
    {
        $user = User::where('login', $login)->first();
        $user->login = $request->login;
        $user->email = $request->email;
        $user->name = $request->name;
        $user->surname = $request->surname;
        $user->age = $request->age;
        $user->update();
        return redirect()->route('profile', $user->login);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  string  $login
     // @return \Illuminate\Http\Response
     */
    public function destroy($login)
    {
        $user = User::where('login', $login)->first();
        $user->delete();
        return redirect()->route('users');
    }

}
