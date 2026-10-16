@extends('layouts.app')

@section('content')
<div class="max-w-md mx-auto mt-10">
    <h2 class="text-2xl text-center mb-8">新しいパスワードの設定</h2>

    @if ($errors->any())
        <div class="mb-4 text-red-600 text-sm">
            @foreach ($errors->all() as $error)
                <p>{{ $error }}</p>
            @endforeach
        </div>
    @endif

    <form method="POST" action="{{ route('password.update') }}">
        @csrf
        <input type="hidden" name="token" value="{{ $token }}">
        <input type="hidden" name="email" value="{{ old('email', $email) }}">

        <div class="mb-6">
            <input type="password" name="password" placeholder="新しいパスワード（8文字以上）"
                   class="w-full border border-gray-300 px-4 py-3" required>
        </div>

        <div class="mb-6">
            <input type="password" name="password_confirmation" placeholder="新しいパスワード（確認）"
                   class="w-full border border-gray-300 px-4 py-3" required>
        </div>

        <button type="submit" class="w-full bg-blue-500 hover:bg-blue-600 text-white py-3">
            パスワードを変更する
        </button>
    </form>
</div>
@endsection