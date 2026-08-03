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
       class="block bg-blue-500 text-white text-center py-4"
       @if ($hasPausedQuiz)
           onclick="return confirm('中断中の問題があります。新しく始めると中断中のデータは失われますが、よろしいですか？');"
       @endif
    >問題開始</a>

    @if ($hasPausedQuiz)
        <a href="{{ route('quiz.resume') }}" class="block bg-yellow-400 text-center py-4">
            中断した問題を再開する
        </a>
    @endif

    <a href="{{ route('progress.index') }}" class="block border border-gray-300 text-center py-4">学習進捗</a>
    <a href="{{ route('progress.weak-words') }}" class="block border border-gray-300 text-center py-4">苦手単語一覧</a>
</div>
@endsection