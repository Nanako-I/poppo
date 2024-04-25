<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;
use App\Http\Middleware\Authenticate; //追記
use App\Http\Middleware\RedirectIfNotAuthenticated; //追記

use App\Http\Controllers\PersonController; //追記
use App\Http\Controllers\FacilityController;
use App\Http\Controllers\HogoshaUserController;
use App\Http\Controllers\PhotoController; //追記
use App\Http\Controllers\TemperatureController;
use App\Http\Controllers\BloodpressureController;
use App\Http\Controllers\MedicineController;
use App\Http\Controllers\KyuuinController;
use App\Http\Controllers\TubeController;
use App\Http\Controllers\WaterController;
use App\Http\Controllers\HossaController;
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
use App\Http\Controllers\HogoshaController;
use App\Http\Controllers\ChildConditionController;
use App\Http\Controllers\ChildTemperatureController;
use App\Http\Controllers\ChildFoodController;
use App\Http\Controllers\ChildToiletController;
use App\Http\Controllers\BathController;
use App\Http\Controllers\HogoshaRecordController;

use App\Http\Controllers\DompdfController;
use App\Http\Controllers\MessageController;
use App\Http\Controllers\AmiVoiceController;
use App\Http\Controllers\VideoController;
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
})->middleware([Authenticate::class]); // Authenticate ミドルウェアを適用



Route::middleware([RedirectIfNotAuthenticated::class])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->middleware(['auth', 'verified'])->name('dashboard');

    // プレミア会員用のルーティング
    //Route::group(['middleware' => ['auth', 'can:company']], function () {
    // Item用の一括ルーティング
    //Route::resource('people', PersonController::class);

    //});

    // Route::get('facilityregister', [FacilityController::class, 'edit']);
    Route::get('/facilityregister', [FacilityController::class, 'create'])->name('facilityregister.create');
    Route::post('facilityregister', [FacilityController::class, 'store'])->name('facilityregister.store');

    // Book用の一括ルーティング　本来使ってたルーティング↓
    Route::resource('people', PersonController::class);

    // 中間テーブルのリレーションのための追記↓
    //Route::get('people', [PersonController::class, 'index'])->name('people.show');

    Route::view('/register', 'register');

    Route::get('peopleregister', [PersonController::class, 'create']);
    Route::post('peopleregister', [PersonController::class, 'store']);

    Route::post('/logout', 'Auth\LoginController@logout')->name('logout');

    Route::middleware('auth')->group(function () {
        Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
        Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
        Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    });

    // 保護者のuser登録画面↓
    Route::get('/hogosharegister', [HogoshaUserController::class, 'showRegister']);
    Route::post('/hogosharegister', [HogoshaUserController::class, 'register']);

    Route::middleware('auth')->group(function () {
        Route::get('/hogosha', [HogoshaUserController::class, 'hogosha'])->name('hogosha');
    });

    Route::get('hogoshanumber', [HogoshaUserController::class, 'create'])->name('hogoshanumber.show');
    Route::post('hogoshanumber', [HogoshaUserController::class, 'numberregister'])->name('hogoshanumber.store');


    Route::get('temperaturelist', [PersonController::class, 'showtemperature'])->name('temperaturelist.edit');
    Route::get('temperature/{people_id}/edit', [TemperatureController::class, 'edit'])->name('temperature.edit');

    // プルダウンで登録させるバージョン↓
    Route::post('temperatures/{people_id}', [TemperatureController::class, 'store'])->name('temperatures.store');
    Route::get('temperatures/{people_id}', [TemperatureController::class, 'show'])->name('temperatures.show');
    Route::get('temperatureedit/{people_id}', [TemperatureController::class, 'edit'])->name('temperature.edit');

    // 体温編集↓
    Route::get('temperaturechange/{people_id}/{id}', [TemperatureController::class, 'change'])->name('temperature.change');
    // Route::get('people', [TemperatureController::class, 'change'])->name('temperature.change');
    Route::post('temperaturechange/{people_id}/{id}', [TemperatureController::class, 'update'])->name('temperature_update');
    Route::post('temperaturedestroy/{id}', [TemperatureController::class, 'destroy'])->name('temperature.delete');

    // プルダウンで登録させるバージョン↓
    Route::post('bloodpressures/{people_id}', [BloodpressureController::class, 'store'])->name('bloodpressures.store');
    Route::get('bloodpressures/{people_id}', [BloodpressureController::class, 'show'])->name('bloodpressures.show');
    Route::get('bloodpressuresedit/{people_id}', [BloodpressureController::class, 'edit'])->name('bloodpressures.edit');

    // 血圧編集↓
    Route::get('bloodpressurechange/{people_id}/{id}', [BloodpressureController::class, 'change'])->name('bloodpressure.change');
    Route::post('bloodpressurechange/{people_id}/{id}', [BloodpressureController::class, 'update'])->name('bloodpressure_update');
    Route::post('bloodpressuredestroy/{id}', [BloodpressureController::class, 'destroy'])->name('bloodpressure.delete');

    Route::get('foods/{id}', 'FoodController@show')->name('foods.show');
    Route::get('food/{people_id}/edit', [FoodController::class, 'edit'])->name('food.edit');
    Route::post('food/{people_id}/edit', [FoodController::class, 'store'])->name('food.post');
    Route::get('foodchange/{people_id}', [FoodController::class, 'change'])->name('food.change');
    Route::post('foodchange/{people_id}', [FoodController::class, 'update'])->name('food_update');

    Route::post('toilet/{people_id}', [ToiletController::class, 'store'])->name('toilet.store');
    Route::get('toilet/{people_id}', [ToiletController::class, 'show'])->name('toilet.show');
    Route::get('toiletedit/{people_id}', [ToiletController::class, 'edit'])->name('toilet.edit');

    // 血圧編集↓
    Route::get('toiletchange/{people_id}/{id}', [ToiletController::class, 'change'])->name('toilet.change');
    Route::post('toiletchange/{people_id}/{id}', [ToiletController::class, 'update'])->name('toilet_update');
    Route::post('toiletdestroy/{id}', [ToiletController::class, 'destroy'])->name('toilet.delete');

    // プルダウンで登録させるバージョン↓
    Route::post('medicine/{people_id}', [MedicineController::class, 'store'])->name('medicine.store');
    Route::get('medicine/{people_id}', [MedicineController::class, 'show'])->name('medicine.show');
    Route::get('medicineedit/{people_id}', [MedicineController::class, 'edit'])->name('medicine.edit');

    // 内服編集↓
    Route::get('medicinechange/{people_id}/{id}', [MedicineController::class, 'change'])->name('medicine.change');
    Route::post('medicinechange/{people_id}/{id}', [MedicineController::class, 'update'])->name('medicine_update');
    Route::post('medicinedestroy/{id}', [MedicineController::class, 'destroy'])->name('medicine.delete');

    // プルダウンで登録させるバージョン↓
    Route::post('kyuuin/{people_id}', [KyuuinController::class, 'store'])->name('kyuuin.store');
    Route::get('kyuuin/{people_id}', [KyuuinController::class, 'show'])->name('kyuuin.show');
    Route::get('kyuuinedit/{people_id}', [KyuuinController::class, 'edit'])->name('kyuuin.edit');

    // 吸引編集↓
    Route::get('kyuuinchange/{people_id}/{id}', [KyuuinController::class, 'change'])->name('kyuuin.change');
    Route::post('kyuuinchange/{people_id}/{id}', [KyuuinController::class, 'update'])->name('kyuuin_update');
    Route::post('kyuuindestroy/{id}', [KyuuinController::class, 'destroy'])->name('kyuuin.delete');

    // プルダウンで登録させるバージョン↓
    Route::post('tube/{people_id}', [TubeController::class, 'store'])->name('tube.store');
    Route::get('tube/{people_id}', [TubeController::class, 'show'])->name('tube.show');
    Route::get('tubeedit/{people_id}', [TubeController::class, 'edit'])->name('tube.edit');

    // 注入編集↓
    Route::get('tubechange/{people_id}/{id}', [TubeController::class, 'change'])->name('tube.change');
    Route::post('tubechange/{people_id}/{id}', [TubeController::class, 'update'])->name('tube_update');
    Route::post('tubedestroy/{id}', [TubeController::class, 'destroy'])->name('tube.delete');

    // プルダウンで登録させるバージョン↓
    Route::post('water/{people_id}', [WaterController::class, 'store'])->name('water.store');
    Route::get('water/{people_id}', [WaterController::class, 'show'])->name('water.show');
    Route::get('wateredit/{people_id}', [WaterController::class, 'edit'])->name('water.edit');

    // 水編集↓
    Route::get('waterchange/{people_id}/{id}', [WaterController::class, 'change'])->name('water.change');
    Route::post('waterchange/{people_id}/{id}', [WaterController::class, 'update'])->name('water_update');
    Route::post('waterdestroy/{id}', [WaterController::class, 'destroy'])->name('water.delete');

    // プルダウンで登録させるバージョン↓
    Route::post('hossa/{people_id}', [HossaController::class, 'store'])->name('hossa.store');
    Route::get('hossa/{people_id}', [HossaController::class, 'show'])->name('hossa.show');
    Route::get('hossaedit/{people_id}', [HossaController::class, 'edit'])->name('hossa.edit');

    // 発作編集↓
    Route::get('hossachange/{people_id}/{id}', [HossaController::class, 'change'])->name('hossa.change');
    Route::post('hossachange/{people_id}/{id}', [HossaController::class, 'update'])->name('hossa_update');
    Route::post('hossadestroy/{id}', [HossaController::class, 'destroy'])->name('hossa.delete');

    Route::get('morningspeech/{people_id}/edit', [SpeechController::class, 'show'])->name('morningspeech.show');
    Route::post('morningspeech/{people_id}/edit', [SpeechController::class, 'store'])->name('morningspeech.post');

    // 1日の活動編集↓
    Route::get('morningspeechchange/{people_id}', [SpeechController::class, 'change'])->name('morningspeech.change');
    Route::post('morningspeechchange/{people_id}', [SpeechController::class, 'update'])->name('morningspeech_update');



    Route::post('speeches/{people_id}', [SpeechController::class, 'store'])->name('speech.store');
    // Route::post('/speech', 'SpeechController@store')->name('speech.store');
    Route::get('speeches/{people_id}', [SpeechController::class, 'show'])->name('speech.show');
    Route::get('/speech/{id}/edit', 'SpeechController@edit')->name('speech.edit');

    Route::get('record/{people_id}/edit', [RecordController::class, 'show'])->name('record.edit');

    Route::get('notification/{people_id}/edit', [NotificationController::class, 'show'])->name('notification.show');
    Route::post('notification/{people_id}/edit', [NotificationController::class, 'store'])->name('notification.post');

    // 編集↓
    Route::get('notificationchange/{people_id}', [NotificationController::class, 'change'])->name('notification.change');
    Route::post('notificationchange/{people_id}', [NotificationController::class, 'update'])->name('notification_update');


    // ★保護者の連絡
    // Route::get('hogosha/{people_id}/edit', [HogoshaController::class, 'edit'])->name('hogosha.edit');
    // Route::post('hogosha/{people_id}/edit', [HogoshaController::class,'store'])->name('hogosha.post');

    // // 編集↓
    // Route::get('hogoshachange/{people_id}', [HogoshaController::class, 'change'])->name('hogosha.change');
    // Route::post('hogoshachange/{people_id}',[HogoshaController::class,'update'])->name('hogosha');

    // 子どもの体調について　親からの報告↓

    Route::get('hogosha', [ChildConditionController::class, 'edit'])->name('condition.edit');
    // Route::get('hogosha/{people_id}', [ChildConditionController::class, 'edit'])->name('condition.edit');
    // Route::get('hogosha/{people_id}/edit', [ChildConditionController::class, 'edit'])->name('condition.edit');
    Route::post('condition/{people_id}/edit', [ChildConditionController::class, 'store'])->name('condition.post');

    // 編集↓
    Route::get('conditionchange/{people_id}', [ChildConditionController::class, 'change'])->name('condition.change');
    Route::post('conditionchange/{people_id}', [ChildConditionController::class, 'update'])->name('condition.update');

    // 子どもの体温について　親からの報告↓
    Route::get('hogosha/{people_id}/edit', [ChildTemperatureController::class, 'edit'])->name('childtemperature.edit');
    Route::post('childtemperature/{people_id}/edit', [ChildTemperatureController::class, 'store'])->name('childtemperature.post');

    // 編集↓
    Route::get('childtemperaturechange/{people_id}', [ChildTemperatureController::class, 'change'])->name('childtemperature.change');
    Route::post('childtemperaturechange/{people_id}', [ChildTemperatureController::class, 'update'])->name('childtemperature.update');

    // 子どもの食事について　親からの報告↓
    Route::get('hogosha/{people_id}/edit', [ChildFoodController::class, 'edit'])->name('childfood.edit');
    Route::post('hogosha/{people_id}/edit', [ChildFoodController::class, 'store'])->name('childfood.post');

    // 編集↓
    Route::get('childfoodchange/{people_id}', [ChildFoodController::class, 'change'])->name('childfood.change');
    Route::post('childfoodchange/{people_id}', [ChildFoodController::class, 'update'])->name('childfood.update');

    // 子どもの排泄について　親からの報告↓
    Route::get('hogosha/{people_id}/edit', [ChildToiletController::class, 'edit'])->name('childtoilet.edit');
    Route::post('childtoilet/{people_id}/edit', [ChildToiletController::class, 'store'])->name('childtoilet.post');
    // ↑hogosha/{people_id}/editだとエラーが出る
    // 編集↓
    Route::get('childtoiletchange/{people_id}', [ChildToiletController::class, 'change'])->name('childtoilet.change');
    Route::post('childtoiletchange/{people_id}', [ChildToiletController::class, 'update'])->name('childtoilet.update');

    // 子どもの入浴について　親からの報告↓
    Route::get('hogosha/{people_id}/edit', [BathController::class, 'edit'])->name('childbath.edit');
    Route::post('bath/{people_id}/edit', [BathController::class, 'store'])->name('childbath.post');

    // 編集↓
    Route::get('childbathchange/{people_id}', [BathController::class, 'change'])->name('childbath.change');
    Route::post('childbathchange/{people_id}', [BathController::class, 'update'])->name('childbath.update');

    // 連絡帳機能
    Route::get('chat/{people_id}', [ChatController::class, 'show'])->name('chat.show');
    Route::post('chat/{people_id}', [ChatController::class, 'store'])->name('chat.store');

    // 保護者が家で記録した内容一覧↓
    Route::get('hogosharecord/{people_id}/edit', [HogoshaRecordController::class, 'show'])->name('hogosharecord.edit');


    Route::get('people/{id}/edit', [PersonController::class, 'edit'])->name('people.edit');
    Route::get('/download', [SpreadsheetController::class, 'chart'])->name('chart');
    Route::resource('/upload', UploadController::class);
    Route::delete('/delete/{fileName}', [UploadController::class, 'delete'])->name('upload.delete');



    // Route::post('/read-pdf', 'UploadController@readPdf');
    Route::post('/upload', [UploadController::class, 'store'])->name('upload.edit');


    // Route::get('/convert-pdf', [UploadController::class, 'convert'])->name('convert.edit');
    Route::post('/convert-pdf', [UploadController::class, 'convertPDFsToPNG'])->name('convert.edit');
    Route::post('/readPNG', [UploadController::class, 'readPNG'])->name('readPNG.edit');

    Route::get('chart/{id}/edit', [ChartController::class, 'show'])->name('chart.edit');

    Route::get('/chartjs', function () {
        return view('chartjs');
    });

    // PDFでダウンロードする↓
    Route::get('record/{id}/edit', [DompdfController::class, 'record'])->name('record');
    Route::get('pdf/{people_id}/edit', [DompdfController::class, 'pdf'])->name('pdf');



    // マニュアル動画↓
    Route::post('videos/{people_id}', [VideoController::class, 'store'])->name('videos.store');
    Route::get('videos/{people_id}', [VideoController::class, 'show'])->name('videos.show');
    Route::get('videos/{people_id}/edit', [VideoController::class, 'edit'])->name('videos.edit');

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

    // Route::get('message', 'MessageController@index');
    Route::get('/message', [MessageController::class, 'index']);
    Route::get('ajax/message', 'Ajax\MessageController@index');
    Route::post('ajax/message', 'Ajax\MessageController@create');

    // 音声認識テスト↓
    Route::view('/speechsample', 'speechsample');
    Route::view('/speechsample2', 'speechsample2');
    Route::view('/speechsample3', 'speechsample3');
    Route::view('/speechsamplehrp', 'speechsamplehrp');
    Route::view('/speechsamplehrp', 'speechsamplehrp');

    // カレンダー↓
    Route::get('/calendar', function () {
        return view('calendar');
    });
    Route::get('/calendar/index_person', [CalenderController::class, 'indexPerson']);
    Route::get('/calendar/index_visit_type', [CalenderController::class, 'indexVisitType']);
    Route::get('/calendar/index_scheduled_visit', [CalenderController::class, 'indexScheduledVisit']);
    Route::get('/calendar/scheduled_visit_detail', [CalenderController::class, 'getScheduledVisitDetail']);
    Route::post('/calendar/register', [CalenderController::class, 'register']);
    Route::post('/calendar/edit', [CalenderController::class, 'edit']);
    Route::post('/calendar/delete', [CalenderController::class, 'delete']);

    require __DIR__ . '/auth.php';
});
