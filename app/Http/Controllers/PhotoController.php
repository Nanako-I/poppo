<?php

namespace App\Http\Controllers;

use App\Models\Photo;
use Illuminate\Http\Request;

class PhotoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('peopleregister');//
    }
public function uploadForm()
    {
        // return view('people');変更↓
       return view('peopleregister');
    }
    
    public function upload(Request $request)
{
// バリデーション
$request->validate([
            // 'profile_image' => 'required|image|max:2048',
            ]);
// 保存先ディレクトリ
 $directory = 'public/sample';

// ファイル名をユニークにする
$filename = uniqid() . '.' . $request->file('filename')->getClientOriginalExtension();

// アップロードされたファイル名を取得	// sampleディレクトリに画像を保存
$filename = $request->file('filename')->getClientOriginalName();	
// ファイルを保存
$request->file('filename')->storeAs($directory, $filename);
// 保存したファイルのパスを取得
$filepath = $directory . '/' . $filename;
// リダイレクト
return redirect()->route('photos.create.form')->with('success', '画像をアップロードしました。');
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
   public function store(PersonRequest $request)
{
    // $person = new Person;
    // $person->name = $request->name;
    // $person->save();

    // $photo = new Photo;
    // $photo->image = $request->file('photo')->store('public');
    // $photo->person_id = $person->id;
    // $photo->save();

    // return redirect()->route('people.index');
}

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Photo  $photo
     * @return \Illuminate\Http\Response
     */
    public function show(Photo $photo)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Photo  $photo
     * @return \Illuminate\Http\Response
     */
    public function edit(Photo $photo)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Photo  $photo
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Photo $photo)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Photo  $photo
     * @return \Illuminate\Http\Response
     */
    public function destroy(Photo $photo)
    {
        //
    }
}