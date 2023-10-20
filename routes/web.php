<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\VideoController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

// Added route for videos
Route::resource('videos', VideoController::class)->middleware('auth');

Route::get('/', [VideoController::class, 'index'])->name('videos.index');
// routes/web.php

Route::post('/upload-video', 'VideoController@upload')->name('video.upload');
Route::get('/videos/create', [VideoController::class, 'create'])->name('videos.create');



