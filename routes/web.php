<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;

use App\Http\Controllers\PersonController;//追記
use App\Http\Controllers\PhotoController;//追記
use App\Http\Controllers\TimeController;//追記
use App\Http\Controllers\ActivityController;//追記
use App\Http\Controllers\TrainingController;//追記
use App\Http\Controllers\LifestyleController;//追記
use App\Http\Controllers\CreativeController;//追記
use App\Http\Controllers\TemperatureController;
use App\Http\Controllers\BloodpressureController;
use App\Http\Controllers\FoodController;
use App\Http\Controllers\ToiletController;
use App\Http\Controllers\CarController;
use App\Http\Controllers\SpeechController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\RecordController;
use App\Http\Controllers\SpreadsheetController; // Qiitaの記事
use App\Http\Controllers\UploadController;
use App\Http\Controllers\ChartController;
use App\Http\Controllers\ChatController;
use App\Http\Controllers\DompdfController;


// use Google\Cloud\Speech\V1p1beta1\StreamingRecognitionConfig;
// use Google\Cloud\Speech\V1p1beta1\StreamingRecognizeRequest;



/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Route::get('/', function () {
    return view('auth.login');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');


// Book用の一括ルーティング
Route::resource('people', PersonController::class);
// Route::resource('peopleregister',  PersonController::class);

Route::get('peopleregister', [PersonController::class, 'create']);
Route::post('peopleregister', [PersonController::class, 'store']);
// Route::get('peopleregister', [PersonController::class, 'create']); 
//   Route::resource('/photos', 'App\Http\Controllers\PhotoController')->only(['create','store']);

Route::post('/logout', 'Auth\LoginController@logout')->name('logout');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// 利用時間↓
Route::post('times/{people_id}', [TimeController::class, 'store'])->name('time.store');
Route::get('times/{people_id}', [TimeController::class, 'show'])->name('time.show');
// Route::get('bloodpressure/{people_id}', [BloodpressureController::class, 'edit'])->name('bloodpressure.edit');

Route::get('times/{people_id}/edit', [TimeController::class, 'edit'])->name('time.edit');
// 利用時間編集↓
Route::get('timechange/{people_id}', [TimeController::class, 'change'])->name('time.change');
Route::post('timechange/{people_id}',[TimeController::class,'update'])->name('time_update');

// トレーニング↓
Route::post('trainings/{people_id}', [TrainingController::class, 'store'])->name('training.store');
Route::get('trainings/{people_id}', [TrainingController::class, 'show'])->name('training.show');
// Route::get('bloodpressure/{people_id}', [BloodpressureController::class, 'edit'])->name('bloodpressure.edit');

Route::get('trainings/{people_id}/edit', [TrainingController::class, 'edit'])->name('training.edit');
// トレーニング編集↓
Route::get('trainingchange/{people_id}', [TrainingController::class, 'change'])->name('training.change');
Route::post('trainingchange/{people_id}',[TrainingController::class,'update'])->name('training_update');


// 生活習慣↓
Route::post('lifestyles/{people_id}', [LifestyleController::class, 'store'])->name('lifestyle.store');
Route::get('lifestyles/{people_id}', [LifestyleController::class, 'show'])->name('lifestyle.show');

Route::get('lifestyles/{people_id}/edit', [LifestyleController::class, 'edit'])->name('lifestyle.edit');
// 生活習慣編集↓
Route::get('lifestylechange/{people_id}', [LifestyleController::class, 'change'])->name('lifestyle.change');
Route::post('lifestylechange/{people_id}',[LifestyleController::class,'update'])->name('lifestyle_update');

// 創作活動↓
Route::post('creatives/{people_id}', [CreativeController::class, 'store'])->name('creative.store');
Route::get('creatives/{people_id}', [CreativeController::class, 'show'])->name('creative.show');

Route::get('creatives/{people_id}/edit', [CreativeController::class, 'edit'])->name('creative.edit');
// 創作活動編集↓
Route::get('creativechange/{people_id}', [CreativeController::class, 'change'])->name('creative.change');
Route::post('creativechange/{people_id}',[CreativeController::class,'update'])->name('creative_update');

// 個人・集団活動↓
Route::post('activities/{people_id}', [ActivityController::class, 'store'])->name('activity.store');
Route::get('activities/{people_id}', [ActivityController::class, 'show'])->name('activity.show');

Route::get('activities/{people_id}/edit', [ActivityController::class, 'edit'])->name('activity.edit');
// 個人・集団活動編集↓
Route::get('activitychange/{people_id}', [ActivityController::class, 'change'])->name('activity.change');
Route::post('activitychange/{people_id}',[ActivityController::class,'update'])->name('activity_update');


Route::get('temperaturelist', [PersonController::class, 'showtemperature'])->name('temperaturelist.edit');

Route::get('temperature/{people_id}/edit', [TemperatureController::class, 'edit'])->name('temperature.edit');

// プルダウンで登録させるバージョン↓
Route::post('temperatures/{people_id}', [TemperatureController::class, 'store'])->name('temperatures.store');
Route::get('temperatures/{people_id}', [TemperatureController::class, 'show'])->name('temperatures.show');
// Route::get('temperatures/{people_id}', [PersonController::class, 'index'])->name('temperatures.show');
Route::get('temperature/{people_id}/edit', [TemperatureController::class, 'edit'])->name('temperature.edit');

// 体温編集↓
Route::get('temperaturechange/{people_id}', [TemperatureController::class, 'change'])->name('temperature.change');
Route::post('temperaturechange/{people_id}',[TemperatureController::class,'update'])->name('temperature_update');
// プルダウンで登録させるバージョン↓
Route::post('bloodpressures/{people_id}', [BloodpressureController::class, 'store'])->name('bloodpressures.store');
Route::get('bloodpressures/{people_id}', [BloodpressureController::class, 'show'])->name('bloodpressures.show');
// Route::get('bloodpressure/{people_id}', [BloodpressureController::class, 'edit'])->name('bloodpressure.edit');

Route::get('bloodpressures/{people_id}/edit', [BloodpressureController::class, 'edit'])->name('bloodpressures.edit');

// 血圧編集↓
Route::get('bloodpressurechange/{people_id}', [BloodpressureController::class, 'change'])->name('bloodpressure.change');
Route::post('bloodpressurechange/{people_id}',[BloodpressureController::class,'update'])->name('bloodpressure_update');

Route::get('foods/{id}', 'FoodController@show')->name('foods.show');
Route::get('food/{people_id}/edit', [FoodController::class, 'edit'])->name('food.edit');
// Route::post('food/{people_id}/edit', [FoodController::class,'store'])->name('food.post');
// プルダウンで登録させるバージョン↓
Route::post('food/{people_id}', [FoodController::class,'store'])->name('food.store');
//本：更新画面
Route::get('foodchange/{people_id}',[FoodController::class,'change'])->name('food.change'); //通常


//本：更新画面
Route::post('foodchange/{people_id}',[FoodController::class,'update'])->name('food_update');

Route::get('toilets/{id}', [ToiletController::class, 'show'])->name('toilets.show');
// Route::get('toilets/{id}', 'ToiletController@show')->name('toilets.show');
Route::get('toilet/{people_id}/edit', [ToiletController::class, 'edit'])->name('toilet.edit');
// Route::post('toilet/{people_id}/edit', [ToiletController::class,'store'])->name('toilet.post');

// プルダウンで登録させるバージョン↓
Route::post('toilets/{people_id}',  [ToiletController::class,'store'])->name('toilet.store');

// トイレ編集↓
Route::get('toiletchange/{people_id}', [ToiletController::class, 'change'])->name('toilet.change');
Route::post('toiletchange/{people_id}',[ToiletController::class,'update'])->name('toilet_update');


// Route::get('speeches/{id}', 'SpeechController@show')->name('speeches.show');
// Route::get('speech/{people_id}/edit', [SpeechController::class, 'edit'])->name('speech.edit');
Route::get('morningspeech/{people_id}/edit', [SpeechController::class, 'show'])->name('morningspeech.show');
Route::post('morningspeech/{people_id}/edit', [SpeechController::class,'store'])->name('morningspeech.post');

// 午前の活動編集↓
Route::get('morningspeechchange/{people_id}', [SpeechController::class, 'change'])->name('morningspeech.change');
Route::post('morningspeechchange/{people_id}',[SpeechController::class,'update'])->name('morningspeech_update');

// SpeechControllerにshowメソッド・storeメソッドが重複するためedit createで書いた↓
Route::get('afternoonspeech/{people_id}/edit', [SpeechController::class, 'edit'])->name('afternoonspeech.show');
Route::post('afternoonspeech/{people_id}/edit', [SpeechController::class,'create'])->name('afternoonspeech.post');

// 午後の活動編集↓
Route::get('afternoonspeechchange/{people_id}', [SpeechController::class, 'PMchange'])->name('afternoonspeech.PMchange');
Route::post('afternoonspeechchange/{people_id}',[SpeechController::class,'PMupdate'])->name('afternoonspeech_PMupdate');


// プルダウンで登録させるバージョン↓
Route::post('speeches/{people_id}', [SpeechController::class,'store'])->name('speech.store');
// Route::post('/speech', 'SpeechController@store')->name('speech.store');
Route::get('speeches/{people_id}', [SpeechController::class,'show'])->name('speech.show');
Route::get('/speech/{id}/edit', 'SpeechController@edit')->name('speech.edit');

Route::get('record/{people_id}/edit', [RecordController::class, 'show'])->name('record.edit');

Route::get('notification/{people_id}/edit', [NotificationController::class, 'show'])->name('notification.show');
Route::post('notification/{people_id}/edit', [NotificationController::class,'store'])->name('notification.post');

// 連絡事項の編集↓
Route::get('notificationchange/{people_id}', [NotificationController::class, 'change'])->name('notification.change');
Route::post('notificationchange/{people_id}',[NotificationController::class,'update'])->name('notification_update');

// 連絡帳機能
Route::get('chat/{people_id}', [ChatController::class, 'show'])->name('chat.show');
Route::post('chat/{people_id}', [ChatController::class, 'store'])->name('chat.store');


Route::get('people/{id}/edit', [PersonController::class, 'edit'])->name('people.edit');

Route::get('/download',[SpreadsheetController::class,'chart'])->name('chart');

Route::resource('/upload',UploadController::class);

Route::delete('/delete/{fileName}',[UploadController::class,'delete'])->name('upload.delete');

// Route::delete('/delete/{fileName}', function ($fileName) {
//     // ファイルを削除
//     Storage::delete('storage/images/' . $fileName);
    
//     return response()->json(['message' => 'ファイルが削除されました']);
// });

// Route::post('/read-pdf', 'UploadController@readPdf');
Route::post('/upload', [UploadController::class, 'store'])->name('upload.edit');
// Route::get('/convert-pdf-to-image', 'PdfToImageController@convertPdfToImage');
// Route::get('/convert-pdf-to-image',  [UploadController::class, 'convertPdfToImage'])->name('convert.edit');

// Route::get('/upload', function () {
//     return view('upload');
// });

// Route::get('/convert-pdf', [UploadController::class, 'convert'])->name('convert.edit');
Route::post('/convert-pdf', [UploadController::class, 'convertPDFsToPNG'])->name('convert.edit');
Route::post('/readPNG', [UploadController::class, 'readPNG'])->name('readPNG.edit');

Route::get('chart/{id}/edit', [ChartController::class, 'show'])->name('chart.edit');
// Route::get('food/{people_id}/edit', [FoodController::class, 'edit'])->name('food.edit');

Route::get('/chartjs', function () {
    return view('chartjs');
});

// PDFでダウンロードする↓
Route::get('record/{id}/edit', [DompdfController::class, 'generatePDF'])->name('outputPDF.edit');
// Route::get('record/{id}/edit', [RecordController::class, 'show'])->name('record.edit');

// Qiitaの記事↓
// Route::get('/index', [SpreadsheetController::class, 'index']);
// Route::post('/download', [SpreadsheetController::class, 'download']);

// Route::get('/', function () {
//     return view('welcome');
// });


// Route::get('/photo/upload', PhotoController::class, 'uploadForm')->name('photo.upload.form');

// Route::post('/photo/upload', PhotoController::class, 'upload')->name('photo.upload');



Route::get('businesscard', 'BusinessCardController@index');
Route::post('businesscard/extract', 'BusinessCardController@extract');

Route::view('/sample', 'sample');



require __DIR__.'/auth.php';