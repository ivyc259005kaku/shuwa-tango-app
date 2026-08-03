@extends('layouts.app')

@section('content')
<div class="max-w-md mx-auto space-y-6">
    <h2 class="text-xl font-bold text-center">苦手単語一覧</h2>

    <p class="text-center text-gray-500 text-sm">
        前回間違えた単語です
    </p>

    @if ($weakSigns->isEmpty())
        <p class="text-center text-gray-500 py-8">
            苦手な単語はありません。
        </p>
    @else
        <div class="space-y-2">
            @foreach ($weakSigns as $sign)
                <div class="border border-gray-300 px-4 py-3">
                    <span class="font-bold">
                        {{ $sign->words->pluck('word')->implode(' / ') }}
                    </span>
                </div>
            @endforeach
        </div>
    @endif

    <div class="pt-4 space-y-3">
        <a href="{{ route('progress.index') }}" class="block border border-gray-300 text-center py-4">
            学習進捗へ戻る
        </a>
        <a href="{{ route('home') }}" class="block border border-gray-300 text-center py-4">
            ホームへ戻る
        </a>
    </div>
</div>
@endsection