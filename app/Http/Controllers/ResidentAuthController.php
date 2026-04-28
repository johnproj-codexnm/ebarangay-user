<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\AppwriteService;
use Appwrite\Query;
use Appwrite\ID;
use Illuminate\Support\Facades\Hash;

class ResidentAuthController extends Controller
{

    public function showLogin()
    {
        return view('auth.login');
    }

    public function showRegister()
    {
        return view('auth.register');
    }

    public function register(Request $request)
    {

        $appwrite = new AppwriteService();

        $appwrite->databases->createDocument(
            $appwrite->databaseId(),
            'users',
            ID::unique(),
            [

                "full_name"=>$request->full_name,
                "address"=>$request->address,
                "contact_number"=>$request->contact_number,
                "email"=>$request->email,
                "password"=>Hash::make($request->password),
                "role"=>"resident",
                "created_at"=>now()->toISOString()

            ]
        );

        return redirect('/login')->with('success','Account created successfully');

    }


    public function login(Request $request)
    {

        $appwrite = new AppwriteService();

        $users = $appwrite->databases->listDocuments(
            $appwrite->databaseId(),
            'users',
            [
                Query::equal('email',[$request->email])
            ]
        );

        if(count($users['documents']) == 0){
            return back()->with('error','User not found');
        }

        $user = $users['documents'][0];

        if(!Hash::check($request->password,$user['password'])){
            return back()->with('error','Incorrect password');
        }

        if($user['role'] != "resident"){
            return back()->with('error','Access denied');
        }

        session([
            'resident_id'=>$user['$id'],
            'resident_name'=>$user['full_name']
        ]);

        return redirect('/dashboard');

    }


    public function logout()
    {

        session()->forget('resident_id');

        return redirect('/login');

    }

}