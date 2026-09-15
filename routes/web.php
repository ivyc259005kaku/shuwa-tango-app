<?php

use App\Http\Controllers\AccountController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProgressController;
use App\Http\Controllers\QuizController;
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
    Route::get('/home', function (Illuminate\Http\Request $request) {
        $hasPausedQuiz = \App\Models\QuizSession::where('user_id', $request->user()->id)->exists();
        return view('home.index', compact('hasPausedQuiz'));
    })->name('home');

     // 一般ユーザー：4択クイズ
    Route::get('/quiz', [QuizController::class, 'start'])->name('quiz.start');
    Route::get('/quiz/resume', [QuizController::class, 'resume'])->name('quiz.resume');
    Route::post('/quiz/pause', [QuizController::class, 'pause'])->name('quiz.pause');
    Route::get('/quiz/question', [QuizController::class, 'question'])->name('quiz.question');
    Route::post('/quiz/answer', [QuizController::class, 'answer'])->name('quiz.answer');
    Route::get('/quiz/next', [QuizController::class, 'next'])->name('quiz.next');
    Route::get('/quiz/result', [QuizController::class, 'result'])->name('quiz.result');
    
     // 一般ユーザー：学習進捗
    Route::get('/progress', [ProgressController::class, 'index'])->name('progress.index');
    Route::get('/progress/weak-words', [ProgressController::class, 'weakWords'])->name('progress.weak-words');

     // 一般ユーザー：アカウント設定
    Route::get('/account', [AccountController::class, 'index'])->name('account.index');
    Route::put('/account/password', [AccountController::class, 'updatePassword'])->name('account.password.update');
    Route::delete('/account', [AccountController::class, 'destroy'])->name('account.destroy');

   // 管理者：単語管理画面
});

// 管理者：単語管理画面
Route::middleware(['auth', 'admin'])->group(function () {
    Route::get('/admin/words', [SignController::class, 'index'])->name('admin.words');
    Route::post('/admin/words', [SignController::class, 'store'])->name('admin.words.store');
    Route::put('/admin/words/{sign}', [SignController::class, 'update'])->name('admin.words.update');
    Route::delete('/admin/words/{sign}', [SignController::class, 'destroy'])->name('admin.words.destroy');
});
