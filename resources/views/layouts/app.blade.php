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
    {{-- ログイン中のみヘッダーを表示 --}}
    <header class="bg-blue-200 flex items-center justify-between px-8 py-6">
        <div></div>

        <h1 class="text-2xl">手話単語学習アプリ</h1>

        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit" class="border border-gray-400 bg-white px-4 py-1">
                ログアウト
            </button>
        </form>
    </header>
    @endauth

    <main class="p-8">
        @yield('content')
    </main>

</body>
</html>
