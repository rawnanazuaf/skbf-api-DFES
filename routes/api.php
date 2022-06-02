<?php

use App\Http\Controllers\ConsultationController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ConsultationProcessController;
use App\Http\Controllers\CreditSimulationController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\NewsPromoController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\SalesAreaController;
use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

// LOGIN
Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);
// DATA
// get sales area
Route::get('/data/salesarea', [SalesAreaController::class, 'index']);

// authentication
Route::group(['middleware' => ['auth:sanctum']], function(){
    // DASHBOARD
    // get dashboard data (by sales id)
    Route::get('/dashboard/{sales_id}', [ConsultationController::class, 'dashboard']);
    
    // CONSULTATION
    // get all consultation
    Route::get('/consultation', [ConsultationController::class, 'index']);
    //get all consultation by sales_id
    Route::get('/consultation/{sales_id}/all', [ConsultationController::class, 'all']);
    // create new consultation
    Route::post('/consultation', [ConsultationController::class, 'store']);

    // get a consultation detail
    Route::get('/consultation/{consultation_id}', [ConsultationController::class, 'show']);
    // update a consultation data
    // Route::post('/consultation/{consultation_id}', [ConsultationController::class, 'updateProcess']);
    Route::post('/consultation/{consultation_id}', [ConsultationController::class, 'updateState']);

    // get myconsultation list by sales_id
    Route::get('/consultation/{sales_id}/myconsultation', [ConsultationController::class, 'showMyConsultation']);
    // get active consultation list by sales id
    Route::get('/consultation/{sales_id}/active', [ConsultationController::class, 'showMyActive']);
    // get consultation history list by sales_id
    Route::get('/consultation/{sales_id}/history', [ConsultationController::class, 'showMyHistory']);

    // delete consultation by id
    Route::post('/delete/{consultation_id}', [ConsultationController::class, 'destroy']);

    // PUSH NOTIFICATION
    // save device token
    Route::post('/device/save-token', [NotificationController::class, 'saveToken']);
    // remove device token
    Route::post('/device/remove-token', [NotificationController::class, 'removeToken']);
    // send notification to one user
    Route::post('/device/send-notification-one', [NotificationController::class, 'sendNotificationOne']);
    // send notification to all users
    Route::post('/device/send-notification-all', [NotificationController::class, 'sendNotificationAll']);

    Route::post('/send-notification', [HomeController::class, 'sendNotification'])->name('send.notification');
    Route::post('/save-token', [HomeController::class, 'saveToken'])->name('save-token');
    

    // NEWS PROMO
    // create a newspromo
    Route::post('/news', [NewsPromoController::class, 'store']);
    // get all newspromo
    Route::get('/news', [NewsPromoController::class, 'index']);
    // get newspromo detail
    Route::get('/news/{id}', [NewsPromoController::class, 'view']);

    // DATA
    // get consultation process
    Route::get('/data/consultationprocess', [ConsultationProcessController::class, 'index']);
    
    // CREDIT SIMULATION
    // get credit simulation calculation
    Route::post('/simulation', [CreditSimulationController::class, 'calculate']);
    
    // PROFILE
    // get user profile
    Route::get('/profile/{sales_id}', [UserController::class, 'view']);
    // modify user profile
    Route::put('/profile/{sales_id}/edit', [UserController::class, 'edit']);

    // logout
    Route::post('/logout', [AuthController::class, 'logout']);
});