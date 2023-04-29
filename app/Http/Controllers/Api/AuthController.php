<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function login(Request $request)
    {
        //
        $login  = $request->all();

        // $validate = Validator::make($login [
        //     "username" => "required",
        //     "password"=> "required"
        // ]);

        $validator = Validator::make($login, [
            'username' => 'required',
            'password' => 'required'
        ]);

        $user = $request->username;
        $password = $request->password;

        $cekLogin = User::where('username', $user)->where('password', $password)->first();
        if($cekLogin){
            return response(['status' => 200,'message' => 'Authenticated', 'user'=> $cekLogin]);
        } else {
            return response(['message' => 'Invalid Credentials'], 401);
        }
         if($validator->fails()){
             return response(['message' => $validator->errors()], 400);
         }

         if(!Auth::attempt($login)){
             return response(['message' => 'Invalid Credentials'], 401);
         }

         $user = User::where('username', $request->username)->first();

         return response(['message' => 'Authenticated', 'user'=> $user]);

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
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
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
}
