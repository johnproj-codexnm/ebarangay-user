<?php

namespace App\Http\Controllers;

use App\Services\AppwriteService;

class ResidentDashboardController extends Controller
{

    public function index()
    {

        if(!session('resident_id')){
            return redirect('/login');
        }

        $appwrite = new AppwriteService();

        $announcements = $appwrite->databases->listDocuments(
            $appwrite->databaseId(),
            'announcements'
        );

        return view('dashboard',[
            'announcements'=>$announcements['documents']
        ]);

    }

}