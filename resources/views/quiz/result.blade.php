@extends('layouts.app')

@section('content')
<div class="max-w-md mx-auto space-y-6 text-center">
    <h2 class="text-xl font-bold">結果発表</h2>

    <p class="text-3xl font-bold text-blue-600 py-4">{{ $correct }} / {{ $total }} 問正解</p>
    <p class="text-gray-600">正答率: {{ $total > 0 ? round($correct / $total * 100) : 0 }}%</p>

    <div class="pt-4 space-y-3">
        <a href="{{ route('quiz.start') }}" class="block bg-blue-500 text-white text-center py-4">
            もう一度挑戦する
        </a>
        <a href="{{ route('home') }}" class="block border-2 border-gray-300 text-center py-4">
            ホームへ戻る
        </a>
    </div>
</div>
@endsection
