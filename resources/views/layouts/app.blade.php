<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>手話単語学習アプリ</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = { darkMode: 'class' };

        if (localStorage.getItem('theme') === 'dark') {
            document.documentElement.classList.add('dark');
        }
    </script>
</head>
<body class="bg-gray-50 text-gray-800 dark:bg-gray-900 dark:text-gray-100 transition-colors duration-200">

    @auth
    {{-- ログイン中のみヘッダーを表示（画面上部に固定） --}}
    <header class="bg-blue-100 flex items-center justify-between px-8 py-6 fixed top-0 left-0 right-0 z-50 transition-colors duration-200 relative">
        <div></div>

        <h1 class="text-base sm:text-xl md:text-3xl font-bold text-gray-800 md:absolute md:left-1/2 md:-translate-x-1/2 text-center px-2 whitespace-nowrap">手話単語学習アプリ</h1>

        <div class="flex items-center gap-3">
            <button type="button" onclick="toggleTheme()"
                    class="border border-gray-400 bg-white text-indigo-800 px-4 py-1 rounded">
                <span id="theme-icon">🌙</span>
            </button>

            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="border border-gray-400 bg-white text-gray-800 px-4 py-1 rounded">
                    ログアウト
                </button>
            </form>
        </div>
    </header>
    <div class="pt-16"></div>
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

        function toggleTheme() {
            const html = document.documentElement;
            const isDark = html.classList.toggle('dark');
            localStorage.setItem('theme', isDark ? 'dark' : 'light');
            updateThemeIcon();
        }

        function updateThemeIcon() {
            const icon = document.getElementById('theme-icon');
            if (!icon) return;
            const isDark = document.documentElement.classList.contains('dark');
            icon.textContent = isDark ? '☀️' : '🌙';
        }

        document.addEventListener('DOMContentLoaded', updateThemeIcon);
               </script>

    @auth
        @if(auth()->user()->role === 'admin')
        <a href="{{ route('admin.words') }}" onclick="return handleWordButton(event)"
           class="fixed bottom-8 right-8 z-50 w-24 h-24 rounded-full bg-blue-700 dark:bg-blue-800 text-white
                  flex items-center justify-center text-center text-sm font-bold
                  shadow-lg hover:bg-blue-800 dark:hover:bg-blue-900 transition">
            単語登録
        </a>
        @endif
    @endauth
</body>
</html>
