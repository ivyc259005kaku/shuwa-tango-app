@extends('layouts.app')

@section('content')
<div class="max-w-md mx-auto mt-10">
    <h2 class="text-2xl text-center mb-8">新規登録</h2>

    @if ($errors->any())
        <div class="mb-4 text-red-600 text-sm">
            @foreach ($errors->all() as $error)
                <p>{{ $error }}</p>
            @endforeach
        </div>
    @endif

    <form method="POST" action="{{ route('register') }}">
        @csrf

        <div class="mb-6">
            <input type="text" name="name" value="{{ old('name') }}"
                   placeholder="名前"
                   class="w-full border-2 border-gray-300 px-4 py-3">
        </div>

        <div class="mb-6">
            <input type="email" name="email" value="{{ old('email') }}"
                   placeholder="メールアドレス"
                   class="w-full border-2 border-gray-300 px-4 py-3">
        </div>

        <div class="mb-6">
            <input type="password" name="password"
                   placeholder="パスワード"
                   class="w-full border-2 border-gray-300 px-4 py-3">
        </div>

        <div class="mb-6">
            <input type="password" name="password_confirmation"
                   placeholder="パスワード確認"
                   class="w-full border-2 border-gray-300 px-4 py-3">
        </div>

        <button type="submit"
                class="w-full bg-blue-500 hover:bg-blue-600 text-white py-3">
            登録
        </button>
    </form>

    <div class="text-center mt-8">
        <a href="{{ route('login') }}" class="text-black underline">ログインはこちら</a>
    </div>
</div>
@endsection
