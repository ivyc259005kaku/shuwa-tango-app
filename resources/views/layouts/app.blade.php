<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>手話単語学習アプリ</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-white">
    @auth
    {{-- ログイン中のみヘッダーを表示（画面上部に固定） --}}
    <header class="bg-blue-200 flex items-center justify-between px-8 py-6 fixed top-0 left-0 right-0 z-50">
        <div></div>
        <h1 class="text-2xl">手話単語学習アプリ</h1>
        <div class="flex items-center gap-3">
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="border border-gray-400 bg-white px-4 py-1">
                    ログアウト
                </button>
            </form>
        </div>
    </header>
    <div class="pt-24"></div>
    @endauth
    <main class="p-8">
        @yield('content')
    </main>
        <script>
        function handleWordButton(event) {
            const form = document.getElementById('create-form');
            if (form) {
                event.preventDefault();
                form.classList.toggle('hidden');
                form.scrollIntoView({ behavior: 'smooth' });
            }
            return true;
        }
        </script>

    @auth
        @if(auth()->user()->role === 'admin')
        <a href="{{ route('admin.words') }}" onclick="return handleWordButton(event)"
           class="fixed bottom-8 right-8 z-50 w-24 h-24 rounded-full bg-blue-700 text-white flex items-center justify-center text-center text-sm font-bold shadow-lg hover:bg-blue-800 transition">
            単語登録
        </a>
        @endif
    @endauth
</body>
</html>
