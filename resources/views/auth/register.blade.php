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
            <div class="relative">
                <input type="password" name="password" id="password"
                       placeholder="パスワード"
                       class="w-full border-2 border-gray-300 px-4 py-3 pr-10">
                <button type="button" onclick="togglePasswordField('password', this)"
                        class="absolute right-3 top-1/2 -translate-y-1/2 text-gray-500">
                    <svg xmlns="http://www.w3.org/2000/svg" class="eye-open w-5 h-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <path d="M1 12s4-7 11-7 11 7 11 7-4 7-11 7-11-7-11-7z"/>
                        <circle cx="12" cy="12" r="3"/>
                    </svg>
                    <svg xmlns="http://www.w3.org/2000/svg" class="eye-closed w-5 h-5 hidden" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <path d="M17.94 17.94A10.94 10.94 0 0 1 12 19c-7 0-11-7-11-7a18.5 18.5 0 0 1 5.06-5.94M9.9 4.24A9.12 9.12 0 0 1 12 4c7 0 11 7 11 7a18.5 18.5 0 0 1-2.16 3.19m-6.72-1.07a3 3 0 1 1-4.24-4.24"/>
                        <line x1="1" y1="1" x2="23" y2="23"/>
                    </svg>
                </button>
            </div>
        </div>

        <div class="mb-6">
            <div class="relative">
                <input type="password" name="password_confirmation" id="password_confirmation"
                       placeholder="パスワード確認"
                       class="w-full border-2 border-gray-300 px-4 py-3 pr-10">
                <button type="button" onclick="togglePasswordField('password_confirmation', this)"
                        class="absolute right-3 top-1/2 -translate-y-1/2 text-gray-500">
                    <svg xmlns="http://www.w3.org/2000/svg" class="eye-open w-5 h-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <path d="M1 12s4-7 11-7 11 7 11 7-4 7-11 7-11-7-11-7z"/>
                        <circle cx="12" cy="12" r="3"/>
                    </svg>
                    <svg xmlns="http://www.w3.org/2000/svg" class="eye-closed w-5 h-5 hidden" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <path d="M17.94 17.94A10.94 10.94 0 0 1 12 19c-7 0-11-7-11-7a18.5 18.5 0 0 1 5.06-5.94M9.9 4.24A9.12 9.12 0 0 1 12 4c7 0 11 7 11 7a18.5 18.5 0 0 1-2.16 3.19m-6.72-1.07a3 3 0 1 1-4.24-4.24"/>
                        <line x1="1" y1="1" x2="23" y2="23"/>
                    </svg>
                </button>
            </div>
        </div>

        <button type="submit"
                class="w-full bg-blue-500 hover:bg-blue-600 text-white py-3 text-lg tracking-wider font-semibold">
            登録
        </button>
    </form>

    <div class="text-center mt-8">
        <a href="{{ route('login') }}" class="text-black underline">ログインはこちら</a>
    </div>
</div>

<script>
function togglePasswordField(id, btn) {
    const input = document.getElementById(id);
    const eyeOpen = btn.querySelector('.eye-open');
    const eyeClosed = btn.querySelector('.eye-closed');
    if (input.type === 'password') {
        input.type = 'text';
        eyeOpen.classList.add('hidden');
        eyeClosed.classList.remove('hidden');
    } else {
        input.type = 'password';
        eyeOpen.classList.remove('hidden');
        eyeClosed.classList.add('hidden');
    }
}
</script>
@endsection