<?php

namespace App\Http\Controllers;

use App\Models\Notification;
use App\Models\Person;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
// use Google\Cloud\Speech\V1\SpeechClient;
// use Google\Cloud\Speech\V1\RecognitionConfig;
// use Google\Cloud\Speech\V1\RecognitionConfig\AudioEncoding;
// use Google\Cloud\Speech\V1\StreamingRecognitionConfig;
// use Google\Cloud\Speech\V1\StreamingRecognizeRequest;

class NotificationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       $notification = Notification::all();
        // ('people')に$peopleが代入される
        
        // 'people'はpeople.blade.phpの省略↓　// compact('people')で合っている↓
        return view('people',compact('notification'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
     public function create(Request $request)
    {
        $storeData = $request->validate([
            // 'temperature' => 'required|max:255',
            // 'people_id' => 'required|exists:people,id',
        ]);
        // バリデーションした内容を保存する↓
        
        $notification = Notification::create([
        'people_id' => $request->people_id,
        'notification' => $request->notification,
        
        
    ]);
    // return redirect('people/{id}/edit');
//   $person = Person::findOrFail($request->people_id);
   $people = Person::all();
    // return redirect()->route('speech.edit', ['people_id' => $person->id]);
    // return view('people', ['people' => Person::all()]);
    return view('people', compact('notification', 'people'));
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
            // 'temperature' => 'required|max:255',
            // 'people_id' => 'required|exists:people,id',
        ]);
        // バリデーションした内容を保存する↓
        
        $notification = Notification::create([
        'people_id' => $request->people_id,
        'notification' => $request->notification,
        
    ]);
    // return redirect('people/{id}/edit');
//   $person = Person::findOrFail($request->people_id);
   $people = Person::all();
    // return redirect()->route('speech.edit', ['people_id' => $person->id]);
    // return view('people', ['people' => Person::all()]);
    return view('people', compact('notification', 'people'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Speech  $speech
     * @return \Illuminate\Http\Response
     */
   public function show($people_id)
{
    
//     $person = Person::findOrFail($people_id);
//     $notifications = $person->notifications;
//     $response = Http::post('https://acp-api.amivoice.com/issue_service_authorization', [
//     'sid' => 'Nanako-I',
//     'spw' => 'EDVlyXeLj2AmHMku',
//     'epi' => 300000,
//     // 他のパラメータ
// ]);
// dd($response);
// // レスポンスが成功した場合
// if ($response->successful()) {
//     dd($response);
//     $cookieJar = $response->cookies;
//     // AWSALBTGCORSクッキーの値を取得
//     $awsalbtgcorsCookie = $cookieJar->getCookieByName('AWSALBTGCORS');
//     // クッキーが存在するか確認
//     if ($awsalbtgcorsCookie) {
//         $awsalbtgcorsValue = $awsalbtgcorsCookie->getValue();
//       //dd($awsalbtgcorsValue);
//     } else {
//         dd("AWSALBTGCORSクッキーが見つかりません。");
//     }
// } else {
//     $statusCode = $response->status();
//     $responseBody = $response->body();
//     // エラー処理を行います
//     dd("エラー: ステータスコード $statusCode, レスポンス: $responseBody");
// }
//     $people = Person::all(); // ここで $people を取得
//     return view('notificationedit', ['id' => $person->id],compact('person', 'awsalbtgcorsValue'));
//     $response = Http::get('https://example.com');
// dd($response->body());

    $person = Person::findOrFail($people_id);
    $notifications = $person->notifications;
    
//     $url = "https://acp-api.amivoice.com/issue_service_authorization";

// $post_fields = array(
//     'sid' => 'Nanako-I',//変数名＝値
//      'spw' => 'EDVlyXeLj2AmHMku',
//      'epi' => 300000,
// //   "title" => "example"
// );
// $headers = array(
//   "Authorization: Bearer access_token",
//   "Content-type: application/json"
// );

// // curlのセッションを初期化する
// $ch = curl_init();

// // curlのオプションを設定する
// $options = array(
//   CURLOPT_URL => $url,
//   CURLOPT_RETURNTRANSFER => true,
//   CURLOPT_HTTPHEADER => $headers,
//   CURLOPT_POST => true,
//   CURLOPT_POSTFIELDS => json_encode($post_fields)
// );
// curl_setopt_array($ch, $options);

// // curlを実行し、レスポンスデータを保存する
// $response  = curl_exec($ch);
// // dd($response);

// $responseArray = json_decode($response, true);
// dd($responseArray);

// // curlセッションを終了する
// curl_close($ch);


    $url = 'https://acp-api.amivoice.com/issue_service_authorization';
    
    $apiID = config('services.amivoice.api_id');
    $apiPW = config('services.amivoice.api_pw');
    // dd($apiPW);
    $data = [
     'sid' => $apiID,//変数名＝値
     'spw' => $apiPW,
     'epi' => 300000,
    ];
    $queryString = http_build_query($data);
    // dd($queryString);
//     $data = array(
//     'sid' => 'Nanako-I',//変数名＝値
//      'spw' => 'EDVlyXeLj2AmHMku',
//      'epi' => 300000,
// );
//   dd($data);
$jsonData = json_encode($data);

// dd($jsonData);
$headers = [
    // 'Content-Type: application/json',
    'Authorization: Bearer ' . $jsonData
];

    
    $curl_handle = curl_init();//curlセッションを初期化して、curlハンドルを取得
    curl_setopt($curl_handle, CURLOPT_POST, TRUE);
    curl_setopt($curl_handle, CURLOPT_CUSTOMREQUEST, "POST");
    curl_setopt($curl_handle, CURLOPT_URL, $url);
    curl_setopt($curl_handle, CURLOPT_POSTFIELDS, $queryString);
    curl_setopt($curl_handle, CURLOPT_HTTPHEADER, $headers);

    curl_setopt($curl_handle, CURLOPT_RETURNTRANSFER, true); // curl_exec()の結果を文字列にする
    $json_response = curl_exec($curl_handle);
    if ($json_response === false) {
    echo 'Curl error: ' . curl_error($curl_handle);
} else {
    // dd($json_response);
}
    if(curl_exec($curl_handle) === false) {
    echo 'Curl error: ' . curl_error($curl_handle);
}

    //  dd($json_response);
    
    curl_close($curl_handle);
    //$answer = $decoded_data->answer;
    // dd($json_response);
//     $user_id  = filter_input(INPUT_POST, 'user_id');
// $password = filter_input(INPUT_POST, 'password');
//     $dataJsonString = file_get_contents("php://input");
//     // dd($dataJsonString);
// dd($dataJsonString);
//     $command = "curl -X POST -d '$jsonData' $url";
// //dd($command);
//     // curlコマンドを実行し、結果を取得
//     $result = exec($command);
// //dd($result);
// dd(var_dump($result));
//     // 結果をログに記録
//     Log::info("Curl command result: $result");
    $people = Person::all();
    return view('notificationedit', ['id' => $person->id],compact('person', 'json_response'));
}

    
   



    public function getAmivoiceApiKey()
    {
        $amivoiceApiKey = Config::get('services.amivoice.api_key');
        return response()->json(['amivoiceApiKey' => $amivoiceApiKey]);
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Speech  $speech
     * @return \Illuminate\Http\Response
     */
     public function edit($people_id)
{
    
}


    public function change(Request $request, $people_id)
{
    $person = Person::findOrFail($people_id);
    $lastNotification = $person->notifications->last(); // 最後のSpeechモデルを取得
    $lastNotificationValue = $lastNotification ? $lastNotification->notification : null;

    return view('notificationchange', compact('person', 'lastNotificationValue'));
}
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Speech  $speech
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Notification $notification)
    {
      //データ更新
        $person = Person::find($request->people_id);
        $notification->people_id = $person->id;
        $notification->notification = $request->notification;
        
        $speech->save();
        
        $people = Person::all();
        
        return view('people', compact('notification', 'people'));
    }
    
    
   

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Speech  $speech
     * @return \Illuminate\Http\Response
     */
    public function destroy(Speech $speech)
    {
        //
    }
}