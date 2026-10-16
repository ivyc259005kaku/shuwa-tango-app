<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Str;

class AuthController extends Controller
{
    /**
     * ログイン画面表示
     */
    public function showLogin()
    {
        return view('auth.login');
    }

    /**
     * ログイン処理
     */
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        if (! Auth::attempt($credentials)) {
            throw ValidationException::withMessages([
                'email' => 'メールアドレスまたはパスワードが正しくありません。',
            ]);
        }

        $request->session()->regenerate();

        // role に応じて遷移先を振り分け
        if (Auth::user()->role === 'admin') {
            return redirect()->route('admin.words');
        }

        return redirect()->route('home');
    }

    /**
     * ユーザー登録画面表示
     */
    public function showRegister()
    {
        return view('auth.register');
    }

    /**
     * ユーザー登録処理（新規登録画面からは role=user のみ作成可能）
     */
    public function register(Request $request)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users,email'],
            'password' => ['required', 'confirmed', 'min:8'],
        ]);

        $user = User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']),
            'role' => 'user', // 新規登録画面からは常に一般ユーザーとして作成
        ]);

        Auth::login($user);

        return redirect()->route('home');
    }

    /**
     * ログアウト処理
     */
    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login');
    }


    /**
     * パスワード再設定：メールアドレス入力画面
     */
    public function showForgotPassword()
    {
        return view('auth.forgot-password');
    }

    /**
     * パスワード再設定：再設定リンクのメール送信
     */
    public function sendResetLink(Request $request)
    {
        $request->validate([
            'email' => ['required', 'email'],
        ]);

        $status = Password::sendResetLink($request->only('email'));

        if ($status === Password::RESET_LINK_SENT) {
            return back()->with('status', 'パスワード再設定用のリンクを送信しました。');
        }

        return back()->withErrors(['email' => 'このメールアドレスは登録されていません。']);
    }

    /**
     * パスワード再設定：新パスワード入力画面（メールのリンクから開く）
     */
    public function showResetForm(Request $request, string $token)
    {
        return view('auth.reset-password', [
            'token' => $token,
            'email' => $request->query('email'),
        ]);
    }

    /**
     * パスワード再設定：新パスワードの保存
     */
    public function resetPassword(Request $request)
    {
        $request->validate([
            'token' => ['required'],
            'email' => ['required', 'email'],
            'password' => ['required', 'confirmed', 'min:8'],
        ]);

        $status = Password::reset(
            $request->only('email', 'password', 'password_confirmation', 'token'),
            function (User $user, string $password) {
                $user->forceFill([
                    'password' => $password, // hashedキャストで自動的にハッシュ化される
                    'remember_token' => Str::random(60),
                ])->save();

                event(new PasswordReset($user));
            }
        );

        if ($status === Password::PASSWORD_RESET) {
            return redirect()->route('login')->with('status', 'パスワードを変更しました。新しいパスワードでログインしてください。');
        }

        return back()->withErrors(['email' => 'リンクが無効か、有効期限が切れています。']);
    }
}