<?php

namespace App\Http\Controllers;

use App\Models\Video;
use App\Models\Person;
use Illuminate\Http\Request;

class VideoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
     {
       $video = Video::all();
        // ('people')に$peopleが代入される
        
        // 'people'はpeople.blade.phpの省略↓　// compact('people')で合っている↓
        return view('people',compact('video'));
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
    $storeData = $request->validate([
        // 'person_name' => 'required|max:255',
        // 'date_of_birth' => 'required|max:255',
    ]);

    $directory = 'public/sample';
    $filename = null;
    $filepath = null;

    if ($request->hasFile('filename')) {
        $request->validate([
            'filename' => 'mimes:mp4,mov,x-ms-wmv,mpeg,avi|max:1000000',
        ]);
        $filename = uniqid() . '.' . $request->file('filename')->getClientOriginalExtension();
         $filename = $request->file('filename')->getClientOriginalName();	
        $request->file('filename')->storeAs($directory, $filename);
        $filepath = $directory . '/' . $filename;
    }

    $video = Video::create([
        'people_id' => $request->people_id,
        'filename' => $filename,
        'path' => $filepath,

    ]);
$people = Person::all();
    return view('people', compact('video', 'people'));
}

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Video  $video
     * @return \Illuminate\Http\Response
     */
    public function show($people_id)
{
    $person = Person::findOrFail($people_id);
    $videos = $person->videos;
    
    
    $people = Person::all(); // ここで $people を取得

//return view('notificationedit', ['id' => $person->id],compact('person'));
    return view('videos', ['id' => $person->id],compact('person','videos'));
   //return view('notificationedit', compact('person', 'apiKey', 'serverURL'));
}

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Video  $video
     * @return \Illuminate\Http\Response
     */
    public function edit(Video $video)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Video  $video
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Video $video)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Video  $video
     * @return \Illuminate\Http\Response
     */
    public function destroy(Video $video)
    {
        //
    }
}
