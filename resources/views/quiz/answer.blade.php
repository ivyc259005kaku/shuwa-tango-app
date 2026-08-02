@extends('layouts.app')

@section('content')
<div class="max-w-md mx-auto space-y-6 text-center">
    <p class="text-sm text-gray-500 text-right">{{ $current }} / {{ $total }} 問</p>

    @if($isCorrect)
        <p class="text-2xl text-blue-600 font-bold py-8">正解！</p>
    @else
        <div class="py-8 space-y-2">
            <p class="text-2xl text-red-500 font-bold">不正解…</p>
            <p class="text-gray-700">正解: {{ $correctWord }}</p>
        </div>
    @endif

    <a href="{{ route('quiz.next') }}" class="block bg-blue-500 text-white text-center py-4">
        {{ $isLast ? '結果を見る' : '次の問題へ' }}
    </a>
</div>
@endsection
