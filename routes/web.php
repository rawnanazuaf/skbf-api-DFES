<?php

use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Storage;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ConsultationController;
use App\Http\Controllers\NewsAndPromoController;
use App\Http\Controllers\Views\ConsultationController as ViewsConsultationController;
use App\Http\Controllers\Views\NewsAndPromoController as ViewsNewsAndPromoController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!

    Route::get($uri, $callback);
    Route::post($uri, $callback);
    Route::put($uri, $callback);
    Route::patch($uri, $callback);
    Route::delete($uri, $callback);
    Route::options($uri, $callback);

    - Redirect
    Route::redirect('/here', '/there');

    - Parameter
    Route::get('/user/{id}', function ($id) {
    return 'User '.$id;
    Route::get('/posts/{post}/comments/{comment}', function ($postId, $commentId) {
        //
    });

    - Middleware
    Route::middleware(['first', 'second'])->group(function () {
        Route::get('/', function () {
            // Uses first & second middleware...
        });

        Route::get('/user/profile', function () {
            // Uses first & second middleware...
        });
    });
});

*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/test', function () {
    return view('test');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'home'])->name('home');
Route::post('/consultation-registration/store', [ViewsConsultationController::class, 'store']);

Route::get('/consultation-views', [ViewsConsultationController::class, 'index'])->name('consultation-views');
Route::get('/consultation-history', [ViewsConsultationController::class, 'indexHistory'])->name('consultation-history');
Route::get('/consultation-registration', [ViewsConsultationController::class, 'registration'])->name('consultation-registration');
Route::get('/consultation-processing', [ViewsConsultationController::class, 'processing'])->name('consultation-processing');
Route::get('/consultation-actived', [ViewsConsultationController::class, 'actived'])->name('consultation-actived');
Route::get('/consultation-rejected', [ViewsConsultationController::class, 'rejected'])->name('consultation-rejected');

Route::get('/detail-consultation-processing/{consultation_id}', [ViewsConsultationController::class, 'detailConsultationProcessing'])->name('detail-consultation-processing');

Route::POST('/consultation/{consultation_id}', [ViewsConsultationController::class, 'updateState']);
Route::POST('/consultation-processing-update/{consultation_id}', [ViewsConsultationController::class, 'updateConsultationProcessing']);

Route::get('/news-promo', [ViewsNewsAndPromoController::class, 'index'])->name('news-promo');
Route::post('/news-promo/store', [ViewsNewsAndPromoController::class, 'store']);

Route::post('/send-notification', [HomeController::class, 'sendNotification'])->name('send.notification');
Route::post('/save-token', [HomeController::class, 'saveToken'])->name('save-token');
Auth::routes();