@extends('layouts.app')

@section('content')
<div class="max-w-md mx-auto mt-10">
    <h2 class="text-2xl text-center mb-8">手話単語学習アプリ</h2>

    @if ($errors->any())
        <div class="mb-4 text-red-600 text-sm">
            @foreach ($errors->all() as $error)
                <p>{{ $error }}</p>
            @endforeach
        </div>
    @endif

    <form method="POST" action="{{ route('login') }}">
        @csrf

        <div class="mb-6">
            <input type="email" name="email" value="{{ old('email') }}"
                   placeholder="メールアドレス"
                   class="w-full border border-gray-300 px-4 py-3">
        </div>

        <div class="mb-6">
            <input type="password" name="password"
                   placeholder="パスワード"
                   class="w-full border border-gray-300 px-4 py-3">
        </div>

        <button type="submit"
                class="w-full bg-blue-500 hover:bg-blue-600 text-white py-3">
            ログイン
        </button>
    </form>

    <div class="text-center mt-8">
        <a href="{{ route('register') }}" class="text-black underline">新規登録</a>
    </div>
</div>
@endsection
