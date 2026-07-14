<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\SignController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// トップページはログイン画面へ
Route::get('/', function () {
    return redirect()->route('login');
});

// 認証関連（未ログイン時のみアクセス可能）
Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login']);

    Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
    Route::post('/register', [AuthController::class, 'register']);
});

// ログアウト（ログイン時のみ）
Route::middleware('auth')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

    // 一般ユーザー：ホーム画面
    Route::get('/home', function () {
        return view('home.index');
    })->name('home');

   // 管理者：単語管理画面

    Route::get('/admin/words', [SignController::class, 'index'])->name('admin.words');
    Route::post('/admin/words', [SignController::class, 'store'])->name('admin.words.store');
    Route::put('/admin/words/{sign}', [SignController::class, 'update'])->name('admin.words.update');
    Route::delete('/admin/words/{sign}', [SignController::class, 'destroy'])->name('admin.words.destroy');
});
