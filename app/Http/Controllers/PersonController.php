<?php

namespace App\Http\Controllers;
// ↓livewireを呼び出し
// namespace App\Http\Livewire;
//use Illuminate\Foundation\Auth\User; // 認証分岐のため追加
use Illuminate\Support\Facades\Auth;

// Personモデルを呼び出している↓
use App\Models\User;
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
    
     public function index(User $user)
     {
         $people = Person::all();
         
         // Initialize an array to store selected items for each person
         $selectedItems = [];
         
         // Loop through each person and decode their selected items
         foreach ($people as $person) {
             $selectedItems[$person->id] = json_decode($person->selected_items, true) ?? [];
         }
     
         return view('people', compact('people', 'selectedItems'));
     }
    // }

    public function show(User $user)
    {
        $people = Person::all();
        
        // Initialize an array to store selected items for each person
        $selectedItems = [];
        
        // Loop through each person and decode their selected items
        foreach ($people as $person) {
            $selectedItems[$person->id] = json_decode($person->selected_items, true) ?? [];
        }
    
        return view('people', compact('people', 'selectedItems'));
    }

      
    /**
     * Show the form for creating a new resource.
     *
 
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

public function showSelectedItems($people_id)
{
    $person = Person::findOrFail($people_id);
    $selectedItems = json_decode($person->selected_items, true) ?? [];
    // $selectedItems = $person->selected_items ?? []; // Retrieve selected items or use an empty array if null
    return view('select_item', compact('person', 'selectedItems'));
}

public function updateSelectedItems(Request $request, $id)
    {
        $person = Person::findOrFail($id);
        $selectedItems = $request->input('selected_items', []);
        $person->selected_items = json_encode($selectedItems, JSON_UNESCAPED_UNICODE);
        $person->save();
        return redirect()->route('people.show', $person->id)->with('success', '記録項目が更新されました。');
    }

// public function updateSelectedItems(Request $request, Person $person)
// {
//     $selectedItems = $request->input('selected_items', []);
//     $person->selected_items = $selectedItems;
//     $person->save();
//     return redirect('people');
//     // return redirect()->route('people', $person->id)->with('success', '記録項目が更新されました。');
// }
    

   
    // public function show(Person $person)
    // {
    // return view('temperature.'.$person->id.'.edit');//
    // }
    
   

    
     
    // 更新画面の表示↓
    public function edit($id)
{
    $person = Person::find($id);
    return view('peopleedit', compact('person'));
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