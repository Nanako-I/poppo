<?php

namespace App\Http\Controllers;
use App\Models\Upload;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

// OCR付け足し↓
use Google\Cloud\Vision\V1\ImageAnnotatorClient;
// use Google\Cloud\Vision\VisionClient;


class UploadController extends Controller
{
    public function index(){
         
        
         // スキャンするディレクトリのパスを指定↓-->
    // $directory = storage_path('app/public');  ///cms/storage/app/public
    $directory = storage_path('app/public/images'); ///cms/storage/app/public/images
    // $directory = storage_path('images');
    // dd($directory);
    
     // ディレクトリ内のファイル一覧を取得　. と .. を除外↓↓-->
     $files = array_diff(scandir($directory), ['.', '..']);
//   dd($files);
    
    //   upload.blade.phpを表示させる↓
    	return view('upload', compact('files'));
    }
    public function store(Request $request){
        
        // NULL許容後にコメントアウトした↓
//         $request->validate([
//             'file' => 'required|file'
//  ]);
        // 'file' => 'required|file|mimes:pdf', // ここでバリデーションルールを設定（PDFファイルしか許容しない場合）
   
    
    if ($request->hasFile('file')) {
        $uploadedFile = $request->file('file');
        // ファイル名をそのままで保存
        // $file_name = $request->file('file')->getClientOriginalName();
        // $request->file('file')->storeAs('public', $file_name);
        $file_name = $uploadedFile->getClientOriginalName();
        // $uploadedFile->storeAs('public', $file_name);
        // $uploadedFile->storeAs($directory, $file_name);
        $uploadedFile->storeAs('public/images', $file_name);
        // ファイル情報をデータベースに保存
        $upload = new Upload();
        $upload->file_name = $file_name;
        // $upload->file_path = 'storage/' . $file_name; // ファイルの保存パスに注意
        $upload->file_path = 'public/images' . $file_name;
        $upload->save();


        // アップロード成功時の処理
        return redirect('upload')->with('success', 'ファイルがアップロードされました');
    } else {
        // ファイルがアップロードされていない場合の処理
        // エラーメッセージをセットし、アップロードフォームに戻る
        return redirect('upload')->with('error', 'ファイルが選択されていません');
    }
}


        // アップロードしたファイルの情報を確認↓
        // dd($request->file('file'));
        
        
        // $request->file('file')->store('');
        
        // ファイル名をupload_file.pdfで保存↓
        // $request->file('file')->storeAs('','upload_file.pdf');
        
        // ファイル名をそのままで保存↓
        // $file_name = $request->file('file')->getClientOriginalName();
        // $request->file('file')->storeAs('public',$file_name);
        
        // return view('upload');
    
    
        public function delete($file_name)
        {
            // Uploads::where('file_name', $file_name)->delete();
            Upload::where('file_name', $file_name)->delete();
            // ファイルを削除
            // Storage::delete('public/' . $file_name);
            Storage::delete('public/images/' . $file_name);
            return response()->json(['message' => 'ファイルが削除されました']);
        }
        
        
        public function convertPdfToImage()
        {
            // PDFファイルをイメージに変換
            exec('gs -sDEVICE=jpeg -o /path/to/output.jpg /path/to/input.pdf');
        }
        
     public function convert(Request $request) {
        // アップロードされたPDFファイルを取得
        $pdfFile = $request->file('pdfFile');
        
        // 一意のファイル名を生成
        $imageFileName = uniqid('image_') . '.jpg';
        
        // PDFを画像に変換
        //gs -sDEVICE=pngalpha -o usagi.png usagi.pdf
        exec("gs -sDEVICE=jpeg -o " . storage_path('storage/' . $imageFileName) . " " . $pdfFile->path());
        
        // 画像からテキストを抽出（OCR）
        $imagePath = storage_path('app/public/images/' . $imageFileName);
        $extractedText = $this->performOCR($imagePath);
        
        // テキストをJSON形式で返す
        return response()->json(['text' => $extractedText]);
        }


    public function showUploadForm()
    {
        return view('upload'); // アップロードフォームを表示
    }

    public function convertPDFsToPNG(Request $request)
    {
        // フォームからPDFファイルを取得
        // $pdfFile = $request->file('file');
         $pdfFiles = Storage::files('public/images');
         $pngPaths = [];
    

        foreach ($pdfFiles as $pdfFile) {
        // ファイルの実際のパスを取得
        $pdfPath = storage_path("app/$pdfFile");
        
        
        
        // dd($pdfPath);

        // ファイル名を変更してPNGファイルのパスを生成
        $pngPath = str_replace('.pdf', '.png', $pdfPath);
 //dd($pngPath);
        // Ghostscriptを使用してPDFをPNGに変換
        $command = "gs -sDEVICE=pngalpha -o $pngPath $pdfPath";
        shell_exec($command);
           
        // PNGファイルのパスを配列に追加
        $pngPaths[] = $pngPath;
        dd($pngPath);
        }
        //  return redirect('upload');
        if (count($pngPaths) > 0) {
    //     // 最初に変換したPNGファイルをブラウザで表示
        return response()->file($pngPaths[0]);
    }

            // PNGファイルをブラウザで表示
            
            //return response()->file($pngPath);
        

        return "PDFファイルがアップロードされていません。";
    }

//         // // OCR付け足し↓
        public function readPNG(Request $request)
        {
            // 指定ディレクトリ内のすべてのファイルを取得
$files = Storage::files('public/images');
       $textResults = [];
       
//       $vision_path = config('vision_cloud_api.fruits');
// //       dd($vision_path);
//   putenv("GOOGLE_APPLICATION_CREDENTIALS=/storage/json/vision_api_key.json");
// $imageAnnotator = new ImageAnnotatorClient();
// dd($imageAnnotator);
// $url = 'https://vision.googleapis.com/v1/images:annotate?key=AIzaSyBtE_NInCBqcXT-DqWpQxTcVTY6T6IcEsY';
// $method = "GET";

        //接続
        // $client = new ImageAnnotatorClient();

        // $response = $client->request($method, $url);

   
    
    // vision_cloud_apiファイルのAPIキーを読み込む
    //   $apiKey = config('vision_cloud_api.api_key');
    //   putenv("GOOGLE_APPLICATION_CREDENTIALS={$apiKey}");
    //   dd($apiKey);
    //   $imageAnnotator = new ImageAnnotatorClient();

    // $imageAnnotator = new ImageAnnotatorClient([
    //     'key' => "{{ config('app.api_key') }}"
    //     'key' => env('APP_API_KEY'),
    // ]);
    // PNGファイルのみを取り出すためのフィルタリング
    $pngFiles = [];
    foreach ($files as $file) {
        // ファイルの拡張子を取得
        $extension = pathinfo($file, PATHINFO_EXTENSION);

        // 拡張子が 'png' の場合のみ処理する
        if ($extension === 'png') {
            
            $pngFiles[] = $file;
            // dd($pngFiles);
            // $send_image = $request->file('image');
            // dd($send_image);
            
            
            foreach ($files as $file) {
        // ファイルの拡張子を取得
        $extension = pathinfo($file, PATHINFO_EXTENSION);

        // 拡張子が 'png' の場合のみ処理する
        if ($extension === 'png') {
            $pngPath = storage_path('app/' . $file);
            // dd($pngPath);
            
            // Vision APIにリクエストを送信
            $requestData = [
                'requests' => [
                    [
                        'image' => [
                            'content' => base64_encode(file_get_contents($pngPath)),
                        ],
                        'features' => [
                            [
                                'type' => 'TEXT_DETECTION',
                            ],
                        ],
                    ],
                ],
            ];
            //  dd($requestData);
            //  Upload::create([
            //     'base64_data' => json_encode($requestData), // base64_data カラムにデータを格納
            // ]);
            
    //         return view('/upload', [
    //     'requestData' => $requestData,
    // ]);
            //   $PNGData = json_decode($request->input('requestData'), true);
            //   dd($PNGData);
// dd($requestData);
// http_build_query($requestData);
            // $response = file_get_contents("https://vision.googleapis.com/v1/images:annotate?key=" . $apiKey, false, stream_context_create([
                $response = file_get_contents("https://vision.googleapis.com/v1/images:annotate?key=AIzaSyBtE_NInCBqcXT-DqWpQxTcVTY6T6IcEsY", false, stream_context_create([
                'http' => [
                    'method' => 'POST',
                    'header' => 'Content-Type: application/json',
                    'content' => '',//json_encode($requestData),
                ],
            ]));
            dd($response);
//             $ch = curl_init();

            // Vision APIのエンドポイントURLとAPIキー
            // $url = "https://vision.googleapis.com/v1/images:annotate?key={$apiKey}";
            
//             curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
            
//             curl_setopt($ch, CURLOPT_URL,'https://vision.googleapis.com/v1/images:annotate?key=AIzaSyBtE_NInCBqcXT-DqWpQxTcVTY6T6IcEsY');
//             curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($requestData));
//             curl_setopt($ch, CURLOPT_HTTPHEADER, ['Content-Type: application/json']);
//             curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);                  // 証明書の検証を無効化
// curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, FALSE);                  // 証明書の検証を無効化
// curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);                   // 返り値を文字列に変更
// curl_setopt($ch, CURLOPT_FOLLOWLOCATION, TRUE); 

            // dd($url);
            // cURLオプションを設定
            // curl_setopt($ch, CURLOPT_URL, $url);
            // curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
            // curl_setopt($ch, CURLOPT_POST, 1);

            
            // リクエストを実行し、レスポンスを取得
//             $response = curl_exec($ch);
//             dd($response);
//             // cURLセッションをクローズ
            
//             if (curl_errno($ch)) {
//     // エラーが発生した場合の処理
// } else {
//     // レスポンスデータを処理
//     $data = json_decode($response, true);

//     if (isset($data['responses'][0]['fullTextAnnotation']['text'])) {
//         $text = $data['responses'][0]['fullTextAnnotation']['text'];
//         $textResults[] = $text;
//     }

//     // cURLセッションをクローズ
//     curl_close($ch);
// }

//             curl_close($ch);
            
//             // レスポンスを処理
//             if ($response === false) {
//                 // エラーハンドリング
//             } else {
//                 // レスポンスを処理
//             }

//             $data = json_decode($response, true);
//             dd($data);

//             if (isset($data['responses'][0]['fullTextAnnotation']['text'])) {
//                 $text = $data['responses'][0]['fullTextAnnotation']['text'];
//                 $textResults[] = $text;
//             }
//         }
//     }

//     return response()->json(['textResults' => $textResults]);
}
        //     $client = new ImageAnnotatorClient();
       
        // $annotations = $imageAnnotator->text();

        // 文字認識結果を取得
        // foreach ($annotations as $annotation) {
        //     $textResults[] = $annotation->getDescription();
        // }
            
    //     }
    // }
    //     }
        //     $uploadedFile = $request->file('file');
        //     $pdfContent = file_get_contents($uploadedFile->getRealPath());
        //     // Google Cloud Vision APIのクライアントを初期化
     
        
        //     try {
        //         // PDFファイルのテキストを抽出
                // $image = $imageAnnotator->image($pngPath, ['PDF_TEXT_DETECTION']);
        //         $annotation = $imageAnnotator->textDetection($image);
        //         $text = $annotation->text();
        
        //         return response()->json(['text' => $text]);
        //     } finally {
        //         $imageAnnotator->close();
        //     }
        // }
        
    //     public function processImage(Request $request)
    // {
    //     $vision = new VisionClient([
    //         'keyFile' => json_decode(file_get_contents('path/to/service-account-key.json'), true)
    //     ]);

    //     $image = $vision->image(file_get_contents('path/to/uploaded-pdf.pdf'), ['pdf']);
    //     $result = $vision->annotate($image);

    //     foreach ($result->text() as $text) {
    //         echo $text->description() . PHP_EOL;
    //     }
    // }
    
//   public function deleteFile($file_name)
//         {

// require 'vendor/autoload.php';

// $vision = new VisionClient([　　// Google Cloud Vision APIを使用するためのクライアントを作成します。ここでサービスアカウントキーを設定しています。
//     "keyFile" => json_decode(file_get_contents('path/to/service-account-key.json'), true)
// ]);

// $pdfFile = $_FILES['pdf']['tmp_name'];　 //リクエストのフォームデータからアップロードされたPDFファイルの一時ファイルへのパスを取得

// $image = $vision->image(file_get_contents($pdfFile), ['pdf']);　//Cloud Vision APIの image メソッドを使用して、PDFファイルを画像として読み込み、OCR処理の対象として指定
// $result = $vision->annotate($image);　//Cloud Vision APIを使用して画像からテキストを抽出し、結果を取得

// header('Content-Type: application/json');　 //レスポンスのコンテンツタイプをJSONに設定しています。　Content-Type→HTTPレスポンスの本文（コンテンツ）の種類を示す
// echo json_encode($result->text());

// }
}}}}};