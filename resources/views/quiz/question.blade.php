@extends('layouts.app')

@section('content')
<div class="max-w-md mx-auto space-y-6 -mt-16">
    <p class="text-sm text-gray-500 dark:text-gray-300 text-right">{{ $current }} / {{ $total }} 問</p>

    <div class="text-center bg-gray-50 py-6">
        <img src="{{ asset('storage/' . $sign->image_path) }}" alt="手話イラスト" class="mx-auto max-h-64">
    </div>

    @if($sign->source)
        <p class="text-xs text-gray-400 dark:text-gray-300 text-center">出典: {{ $sign->source }}</p>
    @endif

    <form method="POST" action="{{ route('quiz.answer') }}" class="space-y-3">
        @csrf
        @foreach($options as $option)
            <button type="submit" name="option_id" value="{{ $option->id }}"
                class="block w-full border-2 border-gray-300 text-center py-4 hover:bg-blue-50 text-lg tracking-wider font-semibold">
                {{ $option->word }}
            </button>
        @endforeach
    </form>

    <form method="POST" action="{{ route('quiz.pause') }}">
        @csrf
        <button type="submit" class="block w-full text-red-600 dark:text-red-400 text-center py-2 text-sm">
            中断する
        </button>
    </form>
</div>
@endsection
