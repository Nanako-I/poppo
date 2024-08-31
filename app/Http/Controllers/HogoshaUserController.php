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
use App\Models\Chat;

class HogoshaUserController extends Controller
{
    public function showRegister()
   {
       return view('hogosharegister');
   }

    public function register(Request $request)
   {
      $form = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:'.User::class],
            'password' => [
            'required',
            'string',
            'min:8',
            'confirmed',
            'regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d).+$/' // '大文字小文字英数字含む,
        ], [
            'name.required' => '名前は必須です。',
            'email.required' => 'メールアドレスは必須です。',
            'email.email' => '有効なメールアドレスを入力してください。',
            'password.required' => 'パスワードは必須です。',
            'password.min' => 'パスワードは8文字以上で入力してください。',
            'validation.confirmed' => 'パスワード確認が一致しません。',
        ]
        ]);

        // 入力データを配列に保存
    $userData = [
        'name' => $request->input('name'),
        'email' => $request->input('email'),
        'password' => $request->input('password'),
    ];
    // dd($userData);
    $request->session()->put('user_data', $userData);
    // dd($request->session()->get('user_data'));
    return view('hogoshanumber');

  }

  public function index(){
    \Log::info('HogoshaUserController hogosha method started.');

  }

  public function edit(Request $request)
    {
        $user = auth()->user();

        // ログインしているユーザーに関連する人物を取得
        $people = $user->people_family()->get();
        // 各Personに対して未読メッセージがあるかを確認
        foreach ($people as $person) {
            $unreadMessages = Chat::where('people_id', $person->id)
                                ->where('is_read', false)
                                ->where('user_identifier', '!=', $user->id)
                                ->exists();
            $person->unreadMessages = $unreadMessages;
        }


        \Log::info('HogoshaUserController edit method started.');
        return view('hogosha', compact('people'));
    }

  public function hogosha()
  {
      // 現在ログインしているユーザーを取得
      $user = Auth::user();

      // ユーザーが関連付けられている全てのPerson（利用者）を取得
      $people = $user->people_family()->get();


      // データをビューに渡す
      return view('hogosha', compact('people'));
  }



   public function numberregister(Request $request)
{
    $request->validate([
        'jukyuusha_number' => 'required|digits:10',// バリデーションルールは適宜変更してください
    ]);

    // ログインユーザーを取得
    // $user = auth()->user();

    // // jukyuusha_numberカラムから人を検索
    // $person = Person::where('jukyuusha_number', $request->jukyuusha_number)->first();

    // // 人が見つかった場合
    // if ($person) {
    // // people_familiesテーブルに関連付ける
    // $user->people_family()->syncWithoutDetaching($person->id);

    //     // 任意のリダイレクト先にリダイレクトするなどの処理を行う
    // $people = $user->people_family()->get();
    // // $user->user_roles()->attach(2); // ここでrole_id＝2(family)を紐づける
    // $user->assignRole('client family user'); // ここで'client family user' を紐づける

    // return view('hogosha', compact('people'));
    // 受給者証番号カラムから人を検索
        $person = Person::where('jukyuusha_number', $request->jukyuusha_number)->first();

        // 人が見つかった場合
        if ($person) {
        \Log::info('This is a test log.');

            // セッションから登録データを取得
            $registerData = $request->session()->get('user_data');
            // dd($registerData);
            // セッションから登録するデータは取れている

            try {
                $user = User::query()->create([
                'name' => $registerData['name'],
                'email' => $registerData['email'],
                'password' => Hash::make($registerData['password']),
            ]);
                Auth::login($user);

                // people_familiesテーブルに関連付ける
                $user->people_family()->syncWithoutDetaching($person->id);

                // 任意のリダイレクト先にリダイレクトするなどの処理を行う
                $people = $user->people_family()->get();
                $user->assignRole('client family user'); // ここで 'client family user' を紐づける

                // DB::commit();

                  // 現在ログインしているユーザーを取得
                // $user = Auth::user();

                // ユーザーが関連付けられている全てのPerson（利用者）を取得
                $people = $user->people_family()->get();


                // 未読メッセージを取得
                $unreadMessages = Chat::where('people_id', $person->id)
                ->where('is_read', false)
                ->where('user_identifier', '!=', $user->id)
                ->exists();

                // hogosha ビューにデータを渡して表示
                return view('hogosha', compact('people', 'unreadMessages'));
            } catch (\Exception $e) {
                DB::rollBack();
                $error = '登録処理中にエラーが発生しました。もう一度お試しください。';
                return view('hogoshanumber', compact('error'));
                    }
                } else {
                    // 人が見つからなかった場合の処理
                    $error = 'この受給者証番号の利用者が存在しません。<br>施設側でこのアプリにご家族の登録がされているか施設にお問い合わせください';
                    return view('hogoshanumber', compact('error'));
                }
            }
}
