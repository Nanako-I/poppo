<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;
use App\Models\User;
use App\Models\Facility;
use App\Models\Person;
use App\Models\Role;

class HogoshaUserController extends Controller
{
    public function showRegister()
   {
       return view('hogosharegister');
   }
   
    public function register(Request $request)
   {
    //   $request->validate([
    //         'name' => ['required', 'string', 'max:255'],
    //         'email' => ['required', 'string', 'email', 'max:255', 'unique:'.User::class],
    //         'password' => ['required', 'confirmed', Rules\Password::defaults()],
    //     ]);
        
       $user = User::query()->create([
           'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
       ]);

       Auth::login($user);

    //   return redirect()->route('hogosha');
       return view('hogoshanumber');
   }
   public function hogosha()
   {
       return view('hogosha');
   }
   
   public function numberregister(Request $request)
{
    $request->validate([
        'jukyuusha_number' => 'required|digits:10',// バリデーションルールは適宜変更してください
    ]);

    // ログインユーザーを取得
    $user = auth()->user();
    
    // jukyuusha_numberで人を検索
    $person = Person::where('jukyuusha_number', $request->jukyuusha_number)->first();

    // 人が見つかった場合
    if ($person) {
        // people_familiesテーブルに関連付ける
        $user->people_family()->syncWithoutDetaching($person->id);
       
        // 任意のリダイレクト先にリダイレクトするなどの処理を行う
        $people = $user->people_family()->get();
        $user->user_roles()->attach(2); // ここでrole_id＝2(family)を紐づける

    return view('hogosha', compact('people'));
    
        // return redirect()->route('condition.edit');
    } else {
        // 人が見つからなかった場合の処理
        return redirect()->route('failure');
    }
}
}