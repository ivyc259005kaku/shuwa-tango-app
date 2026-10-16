@extends('layouts.app')

@section('content')
<div class="max-w-md mx-auto mt-10">
    <h2 class="text-2xl text-center mb-8">パスワードの再設定</h2>

    <p class="text-sm text-gray-600 mb-6">
        登録したメールアドレスを入力してください。パスワード再設定用のリンクをお送りします。
    </p>

    @if (session('status'))
        <div class="mb-4 text-green-700 text-sm">{{ session('status') }}</div>
    @endif

    @if ($errors->any())
        <div class="mb-4 text-red-600 text-sm">
            @foreach ($errors->all() as $error)
                <p>{{ $error }}</p>
            @endforeach
        </div>
    @endif

    <form method="POST" action="{{ route('password.email') }}">
        @csrf

        <div class="mb-6">
            <input type="email" name="email" value="{{ old('email') }}"
                   placeholder="メールアドレス"
                   class="w-full border border-gray-300 px-4 py-3" required>
        </div>

        <button type="submit" class="w-full bg-blue-500 hover:bg-blue-600 text-white py-3">
            再設定リンクを送信
        </button>
    </form>

    <div class="text-center mt-8">
        <a href="{{ route('login') }}" class="text-black underline">ログイン画面にもどる</a>
    </div>
</div>
@endsection