@extends('layouts.app')

@section('content')
<div class="max-w-md mx-auto space-y-6">
    <h2 class="text-xl font-bold text-center">学習進捗</h2>

    <div class="text-center">
        <p class="text-3xl font-bold text-blue-600">{{ $mastered }} / {{ $total }} 問 習得済み</p>
        <p class="text-gray-500 text-sm mt-1">全体の {{ $masteredPercent }}%</p>
    </div>

    {{-- 進捗バー --}}
    <div class="w-full h-6 bg-gray-200 flex overflow-hidden">
        <div class="bg-blue-500 h-full" style="width: {{ $masteredPercent }}%"></div>
        <div class="bg-yellow-400 h-full" style="width: {{ $learningPercent }}%"></div>
    </div>

    {{-- 内訳 --}}
    <div class="space-y-2">
        <div class="flex items-center justify-between border border-gray-300 px-4 py-3">
            <span class="flex items-center gap-2">
                <span class="w-3 h-3 bg-blue-500 inline-block"></span>
                習得済み
            </span>
            <span>{{ $mastered }} 問</span>
        </div>
        <div class="flex items-center justify-between border border-gray-300 px-4 py-3">
            <span class="flex items-center gap-2">
                <span class="w-3 h-3 bg-yellow-400 inline-block"></span>
                学習中
            </span>
            <span>{{ $learning }} 問</span>
        </div>
        <div class="flex items-center justify-between border border-gray-300 px-4 py-3">
            <span class="flex items-center gap-2">
                <span class="w-3 h-3 bg-gray-300 inline-block"></span>
                未学習
            </span>
            <span>{{ $unlearned }} 問</span>
        </div>
    </div>

    <div class="pt-4 space-y-3">
        <a href="{{ route('quiz.start') }}" class="block bg-blue-500 text-white text-center py-4">
            問題を解く
        </a>
        <a href="{{ route('home') }}" class="block border border-gray-300 text-center py-4">
            ホームへ戻る
        </a>
    </div>
</div>
@endsection