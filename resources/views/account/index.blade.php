@extends('layouts.app')

@section('content')
<div class="max-w-md mx-auto space-y-8">
    <h2 class="text-xl font-bold text-center text-gray-800 dark:text-gray-100">アカウント設定</h2>

    @if (session('status'))
        <p class="text-center text-green-600 dark:text-green-400 text-sm">{{ session('status') }}</p>
    @endif

    {{-- パスワード変更フォーム --}}
    <div class="border-2 border-gray-300 dark:border-gray-600 p-6 dark:bg-gray-800">
        <h3 class="font-bold mb-4 text-gray-800 dark:text-gray-100">パスワード変更</h3>

        @if ($errors->updatePassword->any() ?? false)
            <div class="mb-4 px-4 py-2 bg-red-100 text-red-800 rounded text-sm">
                <ul class="list-disc list-inside">
                    @foreach ($errors->updatePassword->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form method="POST" action="{{ route('account.password.update') }}">
            @csrf
            @method('PUT')

            <label class="block text-sm mb-1 text-gray-800 dark:text-gray-100">現在のパスワード</label>
            <div class="relative mb-3">
                <input type="password" name="current_password" id="current_password"
                       class="border px-2 py-1 w-full text-gray-800 pr-10">
                <button type="button" onclick="togglePasswordField('current_password', this)"
                        class="absolute right-2 top-1/2 -translate-y-1/2 text-gray-500">
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

            <label class="block text-sm mb-1 text-gray-800 dark:text-gray-100">新しいパスワード</label>
            <div class="relative mb-3">
                <input type="password" name="password" id="new_password"
                       class="border px-2 py-1 w-full text-gray-800 pr-10">
                <button type="button" onclick="togglePasswordField('new_password', this)"
                        class="absolute right-2 top-1/2 -translate-y-1/2 text-gray-500">
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

            <label class="block text-sm mb-1 text-gray-800 dark:text-gray-100">新しいパスワード（確認）</label>
            <div class="relative mb-4">
                <input type="password" name="password_confirmation" id="new_password_confirmation"
                       class="border px-2 py-1 w-full text-gray-800 pr-10">
                <button type="button" onclick="togglePasswordField('new_password_confirmation', this)"
                        class="absolute right-2 top-1/2 -translate-y-1/2 text-gray-500">
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

            <button type="submit" class="w-full py-2 bg-indigo-700 text-white">
                パスワードを変更する
            </button>
        </form>
    </div>

    {{-- 退会 --}}
    <div class="border-2 border-red-300 dark:border-red-600 p-6 dark:bg-gray-800">
        <h3 class="font-bold mb-2 text-red-700 dark:text-red-400">退会</h3>
        <p class="text-sm text-gray-600 dark:text-gray-300 mb-4">
            退会すると、学習履歴を含むすべてのデータが削除され、元に戻すことはできません。
        </p>

        @if ($errors->deleteAccount->any() ?? false)
            <div class="mb-4 px-4 py-2 bg-red-100 text-red-800 rounded text-sm">
                <ul class="list-disc list-inside">
                    @foreach ($errors->deleteAccount->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <button type="button" onclick="document.getElementById('delete-confirm').classList.toggle('hidden')"
                class="w-full py-2 bg-red-100 dark:bg-red-800 border-2 border-red-400 dark:border-red-600 text-red-800 dark:text-red-100">
            退会手続きへ進む
        </button>

        <div id="delete-confirm" class="hidden mt-4 pt-4 border-t border-red-200 dark:border-red-700">
            <form method="POST" action="{{ route('account.destroy') }}"
                  onsubmit="return confirm('本当に退会しますか？この操作は取り消せません。');">
                @csrf
                @method('DELETE')

                <label class="block text-sm mb-1 text-gray-800 dark:text-gray-100">確認のためパスワードを入力してください</label>
                <div class="relative mb-4">
                    <input type="password" name="password" id="delete_password"
                           class="border px-2 py-1 w-full text-gray-800 pr-10" required>
                    <button type="button" onclick="togglePasswordField('delete_password', this)"
                            class="absolute right-2 top-1/2 -translate-y-1/2 text-gray-500">
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

                <button type="submit" class="w-full py-2 bg-red-700 text-white">
                    退会する
                </button>
            </form>
        </div>
    </div>

    <a href="{{ route('home') }}" class="block bg-blue-100 dark:bg-blue-800 border-2 border-blue-300 dark:border-blue-600 text-center py-4">
        ホームへ戻る
    </a>
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
