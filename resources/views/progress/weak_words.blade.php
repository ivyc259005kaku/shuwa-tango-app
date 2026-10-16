@extends('layouts.app')

@section('content')
<div class="max-w-md mx-auto space-y-6">
    <h2 class="text-xl font-bold text-center">苦手単語一覧</h2>

    <p class="text-center text-gray-500 dark:text-gray-300 text-sm">
        前回間違えた単語です（タップするとイラストが開きます）
    </p>

    @if ($weakSigns->isEmpty())
        <p class="text-center text-gray-500 dark:text-gray-300 py-8">
            苦手な単語はありません。
        </p>
    @else
        <div class="space-y-2">
            @foreach ($weakSigns as $sign)
                <div class="bg-pink-100 dark:bg-pink-800 border-2 border-pink-300 dark:border-pink-600">
                    <button type="button"
                            onclick="toggleSign({{ $sign->id }})"
                            aria-expanded="false"
                            id="toggle-{{ $sign->id }}"
                            class="w-full flex items-center justify-between px-4 py-3 text-left">
                        <span class="font-bold">
                            {{ $sign->words->pluck('word')->implode(' / ') }}
                        </span>
                        <span id="arrow-{{ $sign->id }}" class="text-sm">▼</span>
                    </button>

                    <div id="sign-{{ $sign->id }}" class="hidden px-4 pb-4 text-center">
                        <img src="{{ asset('storage/' . $sign->image_path) }}"
                             alt="{{ $sign->words->pluck('word')->implode(' / ') }}の手話イラスト"
                             class="mx-auto max-h-64 bg-white">
                        @if ($sign->source)
                            <p class="mt-2 text-xs text-gray-500 dark:text-gray-300">出典: {{ $sign->source }}</p>
                        @endif
                    </div>
                </div>
            @endforeach
        </div>
    @endif

    <div class="pt-4 space-y-3">
        <a href="{{ route('progress.index') }}" class="block bg-lime-100 dark:bg-lime-800 border-2 border-lime-300 dark:border-lime-600 text-center py-4 text-lg tracking-wider font-semibold">
            学習進捗へ戻る
        </a>
        <a href="{{ route('home') }}" class="block bg-blue-100 dark:bg-blue-800 border-2 border-blue-300 dark:border-blue-600 text-center py-4 text-lg tracking-wider font-semibold">
            ホームへ戻る
        </a>
    </div>
</div>

<script>
function toggleSign(id) {
    const panel = document.getElementById('sign-' + id);
    const button = document.getElementById('toggle-' + id);
    const arrow = document.getElementById('arrow-' + id);
    const isHidden = panel.classList.toggle('hidden');
    button.setAttribute('aria-expanded', isHidden ? 'false' : 'true');
    arrow.textContent = isHidden ? '▼' : '▲';
}
</script>
@endsection