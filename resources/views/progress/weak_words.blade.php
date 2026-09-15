@extends('layouts.app')

@section('content')
<div class="max-w-md mx-auto space-y-6">
    <h2 class="text-xl font-bold text-center">苦手単語一覧</h2>

    <p class="text-center text-gray-500 dark:text-gray-300 text-sm">
        前回間違えた単語です
    </p>

    @if ($weakSigns->isEmpty())
        <p class="text-center text-gray-500 dark:text-gray-300 py-8">
            苦手な単語はありません。
        </p>
    @else
        <div class="space-y-2">
            @foreach ($weakSigns as $sign)
                <div class="bg-pink-100 dark:bg-pink-800 border-2 border-pink-300 dark:border-pink-600 px-4 py-3">
                    <span class="font-bold">
                        {{ $sign->words->pluck('word')->implode(' / ') }}
                    </span>
                </div>
            @endforeach
        </div>
    @endif

    <div class="pt-4 space-y-3">
        <a href="{{ route('progress.index') }}" class="block bg-lime-100 dark:bg-lime-800 border-2 border-lime-300 dark:border-lime-600 text-center py-4">
            学習進捗へ戻る
        </a>
        <a href="{{ route('home') }}" class="block bg-blue-100 dark:bg-blue-800 border-2 border-blue-300 dark:border-blue-600 text-center py-4">
            ホームへ戻る
        </a>
    </div>
</div>
@endsection