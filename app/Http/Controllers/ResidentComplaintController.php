<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\AppwriteService;
use Appwrite\ID;
use Appwrite\InputFile;

class ResidentComplaintController extends Controller
{

    public function create()
    {

        if(!session('resident_id')){
            return redirect('/login');
        }

        $appwrite = new AppwriteService();

        $categories = $appwrite->databases->listDocuments(
            $appwrite->databaseId(),
            'categories'
        );

        return view('submit_ticket',[
            'categories'=>$categories['documents']
        ]);

    }
    
    


    public function store(Request $request)
    {

        $appwrite = new AppwriteService();

        // Create Complaint

        $complaint = $appwrite->databases->createDocument(
            $appwrite->databaseId(),
            'complaints',
            ID::unique(),
            [

                "user_id"=>session('resident_id'),
                "title"=>$request->title,
                "description"=>$request->description,
                "category"=>$request->category,
                "location"=>$request->location ?? "Location not available",
                "status"=>"Pending",
                "date_submitted"=>now()->toISOString()

            ]
        );


        // Upload Evidence if exists

        if($request->hasFile('image')){

            $file = $appwrite->storage->createFile(
                env('APPWRITE_BUCKET_ID'),
                ID::unique(),
                InputFile::withPath($request->file('image')->getRealPath())
            );

            $appwrite->databases->createDocument(
                $appwrite->databaseId(),
                'complaints_evidence',
                ID::unique(),
                [

                    "complaint_id"=>$complaint['$id'],
                    "image_id"=>$file['$id'],
                    "uploaded_by"=>session('resident_id'),
                    "uploaded_at"=>now()->toISOString()

                ]
            );

        }

        return redirect('/dashboard')->with('success','Complaint submitted');

    }

   public function tickets()
{

    if(!session('resident_id')){
        return redirect('/login');
    }

    $appwrite = new AppwriteService();

    $tickets = $appwrite->databases->listDocuments(
        $appwrite->databaseId(),
        'complaints',
        [
            \Appwrite\Query::equal('user_id',[session('resident_id')])
        ]
    );

    $ticketsData = [];

    foreach($tickets['documents'] as $ticket){

        // Get first evidence image (if exists)
        $evidence = $appwrite->databases->listDocuments(
            $appwrite->databaseId(),
            'complaints_evidence',
            [
                \Appwrite\Query::equal('complaint_id', [$ticket['$id']]),
                \Appwrite\Query::limit(1)
            ]
        );

        $ticket['preview_image'] = count($evidence['documents']) > 0
            ? $evidence['documents'][0]['image_id']
            : null;

        $ticketsData[] = $ticket;
    }

    return view('tickets',[
        'tickets'=>$ticketsData
    ]);

}

public function deleteTicket(Request $request)
{

    $id = $request->id;

    if(!session('resident_id')){
        return redirect('/login');
    }

    $appwrite = new AppwriteService();

    $appwrite->databases->deleteDocument(
        $appwrite->databaseId(),
        'complaints',
        $id
    );

    return redirect('/tickets')->with('success','Ticket deleted');

}

public function ticketDetails($id)
{

    if(!session('resident_id')){
        return redirect('/login');
    }

    $appwrite = new AppwriteService();

    $ticket = $appwrite->databases->getDocument(
        $appwrite->databaseId(),
        'complaints',
        $id
    );

    $messages = $appwrite->databases->listDocuments(
        $appwrite->databaseId(),
        'messages',
        [
            \Appwrite\Query::equal('complaint_id',[$id])
        ]
    );

    $evidence = $appwrite->databases->listDocuments(
        $appwrite->databaseId(),
        'complaints_evidence',
        [
            \Appwrite\Query::equal('complaint_id',[$id])
        ]
    );

    return view('ticket_details',[
        'ticket'=>$ticket,
        'messages'=>$messages['documents'],
        'evidence'=>$evidence['documents']
    ]);

}

public function sendMessage(Request $request)
{

    if(!session('resident_id')){
        return redirect('/login');
    }

    $appwrite = new AppwriteService();

    $appwrite->databases->createDocument(
        $appwrite->databaseId(),
        'messages',
        \Appwrite\ID::unique(),
        [

            "complaint_id"=>$request->complaint_id,
            "sender_id"=>session('resident_id'),
            "sender_role"=>"resident",
            "message"=>$request->message,
            "created_at"=>now()->toISOString()

        ]
    );

    return back();

}

public function getMessages($id)
{

    if(!session('resident_id')){
        return response()->json([]);
    }

    $appwrite = new AppwriteService();

    $messages = $appwrite->databases->listDocuments(
        $appwrite->databaseId(),
        'messages',
        [
            \Appwrite\Query::equal('complaint_id', [$id])
        ]
    );

    return response()->json($messages['documents']);

}



}