<?php

namespace App\Http\Controllers;
// ↓livewireを呼び出し
// namespace App\Http\Livewire;


// Personモデルを呼び出している↓
use App\Models\Person;
use App\Models\Speech;
use App\Models\Toilets;
use App\Models\Temperature;
use Illuminate\Http\Request;

class PersonController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // 全件データ取得して一覧表示する↓
        // $people は変数名　Person::でPersonモデルにアクセスする
        $people = Person::all();
        // ('people')に$peopleが代入される
        
        // 'people'はpeople.blade.phpの省略↓　// compact('people')で合っている↓
        return view('people',compact('people'));
        // APIのときは　return $people;などでJSONデータで返す
   
    }

// use Livewire\Component;

// class Birthday extends Component
// {
//     public $birthday;

//     public function render()
//     {
//         return view('livewire.birthday');
//     }
// }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
{
    return view('peopleregister');
}


   public function store(Request $request)
{
    $storeData = $request->validate([
        'person_name' => 'required|max:255',
        'date_of_birth' => 'required|max:255',
    ]);

    $directory = 'public/sample';
    $filename = null;
    $filepath = null;

    if ($request->hasFile('filename')) {
        $request->validate([
            'filename' => 'image|max:2048',
        ]);
        $filename = uniqid() . '.' . $request->file('filename')->getClientOriginalExtension();
         $filename = $request->file('filename')->getClientOriginalName();	
        $request->file('filename')->storeAs($directory, $filename);
        $filepath = $directory . '/' . $filename;
    }

    $people = Person::create([
        'person_name' => $request->person_name,
        'date_of_birth' => $request->date_of_birth,
        'gender' => $request->gender,
        'disability_name' => $request->disability_name,
        'filename' => $filename,
        'path' => $filepath,

    ]);

    return redirect('people');
}

//      public function templist()
// {
//     $people = Person::all();
        // ('people')に$peopleが代入される
        
        // 'people'はpeople.blade.phpの省略↓　// compact('people')で合っている↓
        // return view('temperaturelist',compact('people'));
    // return view('temperaturelist');
// }
    // return view('peopleregister');

        // $people = Person::create($storeData);
        // // トップページに返す↓
        // return redirect('/people');
    
    

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Person  $person
     * @return \Illuminate\Http\Response
     */
    public function show(Person $person)
    {
    return view('temperature.'.$person->id.'.edit');//
    }
    
    // public function showAmountFood(Person $person)
    // {
    // return view('food.'.$person->id.'.edit');//
    // }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Person  $person
     * @return \Illuminate\Http\Response
     */
     
    // 更新画面の表示↓
    public function edit($id)
{
    $person = Person::find($id);
    return view('peopleedit', compact('person'));
}

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Person  $person
     * @return \Illuminate\Http\Response
     */
     
    // 体温登録のルート↓
    public function showtemperature(Person $person)
{
    $people = Person::all();
        // ('people')に$peopleが代入される
    return view('temperaturelist',compact('people'));
} 

// 食事
// 登録のルート↓
    public function showfood(Person $person)
{
    $people = Person::all();
        // ('people')に$peopleが代入される
    return view('foodlist',compact('people'));
} 
    //  フォームから送られてきたデータ↓
    public function update(Request $request, Person $person)
    {
       $storeData = $request->validate([
            //  requireは必須項目　nullableは書かなくてもいい
            // 'person_name' => 'required|max:255',
            // 'date_of_birth' => 'required|max:255',
            // 'age' => 'required|max:255',
        ]);
        
        $person ->update($updateData);
        // トップページに返す↓
        return redirect('/people');
    }


    
public function uploadForm()
    {
        // return view('people');変更↓
       return view('peopleregister');
    }
    
    



 public function __invoke()
    {
        return view('person');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Person  $person
     * @return \Illuminate\Http\Response
     */
    public function destroy(Person $person)
    {
        
        $person->delete();
        return redirect('/people');
    }
}