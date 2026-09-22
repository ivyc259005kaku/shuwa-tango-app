@extends('layouts.app')

@section('content')
<div class="max-w-md mx-auto space-y-6">

    @if (session('status'))
        <p class="text-center text-green-600 text-sm">{{ session('status') }}</p>
    @endif

    @if (session('error'))
        <p class="text-center text-red-600 text-sm">{{ session('error') }}</p>
    @endif

    <a href="{{ route('quiz.start') }}"
       class="block bg-blue-500 text-white text-center py-4 text-lg tracking-wider font-semibold"
       @if ($hasPausedQuiz)
           onclick="return confirm('中断中の問題があります。新しく始めると中断中のデータは失われますが、よろしいですか？');"
       @endif
    >問題開始</a>

    @if ($hasPausedQuiz)
        <a href="{{ route('quiz.resume') }}" class="block bg-yellow-400 text-gray-900 text-center py-4 text-lg tracking-wider font-semibold">
            中断した問題を再開する
        </a>
    @endif

    <a href="{{ route('progress.index') }}" class="block bg-lime-100 dark:bg-lime-800 border-2 border-lime-300 dark:border-lime-600 text-center py-4 text-lg tracking-wider font-semibold">学習進捗</a>
    <a href="{{ route('progress.weak-words') }}" class="block bg-pink-100 dark:bg-pink-800 border-2 border-pink-300 dark:border-pink-600 text-center py-4 text-lg tracking-wider font-semibold">苦手単語一覧</a>

    <a href="{{ route('account.index') }}" class="block bg-gray-100 dark:bg-gray-700 border-2 border-gray-300 dark:border-gray-600 text-center py-4 text-lg tracking-wider font-semibold text-gray-800 dark:text-gray-100">アカウント設定</a>
</div>
@endsection