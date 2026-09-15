@extends('layouts.app')

@section('content')
<h2 class="text-xl mb-6 text-gray-800 dark:text-gray-100">単語管理</h2>

@if (session('success'))
    <div class="mb-4 px-4 py-2 bg-green-100 text-green-800 rounded">
        {{ session('success') }}
    </div>
@endif

@if ($errors->any())
    <div class="mb-4 px-4 py-2 bg-red-100 text-red-800 rounded">
        <ul class="list-disc list-inside">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

{{-- 登録フォーム --}}
<div class="mb-8">
    <div id="create-form" class="hidden mt-4 p-6 bg-gray-100 dark:bg-gray-800">

        <form method="POST" action="{{ route('admin.words.store') }}" enctype="multipart/form-data">
            @csrf
            <div class="flex gap-6">
                <div class="w-64 h-64 bg-white flex flex-col items-center justify-center border text-gray-800">
                    <span class="text-lg mb-4">イラスト</span>
                    <input type="file" name="image" accept="image/*">
                </div>

                <div class="flex-1 bg-white p-4 text-gray-800">
                    <p class="mb-2">単語の意味</p>
                    <div id="word-fields">
                        <div class="flex items-center gap-2 mb-2">
                            <span>1.</span>
                            <input type="text" name="words[]" class="border px-2 py-1 flex-1 text-gray-800" required>
                            <button type="button" class="remove-word-btn px-2 py-1 bg-gray-200 border text-sm text-gray-800">×</button>
                        </div>
                    </div>
                    <button type="button" id="add-word-btn" class="mt-2 px-3 py-1 bg-blue-100 border border-blue-300 text-gray-800">
                        ＋意味を追加
                    </button>
                </div>
            </div>

            <div class="mt-4">
                <label class="block mb-1 text-gray-800 dark:text-gray-100">出典（任意）</label>
                <input type="text" name="source" class="border px-2 py-1 w-full max-w-md text-gray-800">
            </div>

            {{-- クイズ選択肢（4択） --}}
            <div class="mt-6 p-4 bg-white border text-gray-800">
                <p class="mb-2 font-bold">クイズの選択肢（4択・正解を1つ選択）</p>
                @for ($i = 0; $i < 4; $i++)
                    <div class="flex items-center gap-2 mb-2">
                        <input type="radio" name="correct_option" value="{{ $i }}" {{ $i === 0 ? 'checked' : '' }}>
                        <span>{{ $i + 1 }}.</span>
                        <input type="text" name="options[]" class="border px-2 py-1 flex-1 text-gray-800" placeholder="選択肢{{ $i + 1 }}">
                    </div>
                @endfor
                <p class="text-xs text-gray-500 dark:text-gray-300 dark:text-gray-300">※ラジオボタンで選んだ番号が正解になります。空欄の選択肢は保存されません。</p>
            </div>

            <button type="submit" class="mt-4 w-full max-w-md block mx-auto py-2 bg-indigo-700 text-white">
                単語を登録
            </button>
        </form>
    </div>
</div>

{{-- 一覧表示 --}}
<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
    @foreach ($signs as $i => $sign)
        <div class="border p-4 dark:border-gray-600 dark:bg-gray-800">
            <p class="text-sm text-gray-400 dark:text-gray-300 mb-1">問{{ $i + 1 }}</p>
            <img src="{{ asset('storage/' . $sign->image_path) }}" alt="イラスト" class="w-full h-40 object-contain mb-3 bg-white">

            <ul class="mb-3 text-gray-800 dark:text-gray-100">
                @foreach ($sign->words as $wi => $word)
                    <li>{{ $wi + 1 }}. [{{ $word->word }}]</li>
                @endforeach
            </ul>

            @if ($sign->source)
                <p class="text-sm text-gray-500 dark:text-gray-300 mb-3">出典: {{ $sign->source }}</p>
            @endif

            @if ($sign->quizOptions->count() > 0)
                <div class="mb-3 text-sm">
                    <p class="text-gray-500 dark:text-gray-300 mb-1">選択肢:</p>
                    <ul class="text-gray-800 dark:text-gray-100">
                        @foreach ($sign->quizOptions as $option)
                            <li class="{{ $option->is_correct ? 'text-green-700 dark:text-green-400 font-bold' : '' }}">
                                {{ $option->word }} {{ $option->is_correct ? '(正解)' : '' }}
                            </li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <div class="flex gap-2">
                <button type="button" onclick="document.getElementById('edit-form-{{ $sign->id }}').classList.toggle('hidden')"
                        class="px-3 py-1 bg-yellow-100 border border-yellow-300 text-sm text-gray-800">
                    編集
                </button>

                <form method="POST" action="{{ route('admin.words.destroy', $sign) }}"
                      onsubmit="return confirm('本当に削除しますか？');">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="px-3 py-1 bg-red-100 border border-red-300 text-sm text-gray-800">
                        削除
                    </button>
                </form>
            </div>

            {{-- 編集フォーム --}}
            <div id="edit-form-{{ $sign->id }}" class="hidden mt-4 p-4 bg-gray-50 border-t text-gray-800">
                <form method="POST" action="{{ route('admin.words.update', $sign) }}" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <label class="block text-sm mb-1">画像を差し替える（任意）</label>
                    <input type="file" name="image" accept="image/*" class="mb-3">

                    <p class="mb-1 text-sm">単語の意味</p>
                    <div id="word-fields-{{ $sign->id }}">
                        @foreach ($sign->words as $wi => $word)
                            <div class="flex items-center gap-2 mb-2">
                                <span>{{ $wi + 1 }}.</span>
                                <input type="text" name="words[]" value="{{ $word->word }}" class="border px-2 py-1 flex-1 text-gray-800" required>
                                <button type="button" class="remove-word-btn px-2 py-1 bg-gray-200 border text-sm text-gray-800">×</button>
                            </div>
                        @endforeach
                    </div>

                    <button type="button" class="add-word-btn mt-1 mb-2 px-3 py-1 bg-blue-100 border border-blue-300 text-sm text-gray-800"
                            data-target="word-fields-{{ $sign->id }}">
                        ＋意味を追加
                    </button>

                    <label class="block text-sm mb-1 mt-2">出典（任意）</label>
                    <input type="text" name="source" value="{{ $sign->source }}" class="border px-2 py-1 w-full mb-3 text-gray-800">

                    {{-- クイズ選択肢（4択）編集 --}}
                    <div class="mt-4 p-3 bg-white border text-gray-800">
                        <p class="mb-2 font-bold text-sm">クイズの選択肢（4択・正解を1つ選択）</p>
                        @for ($i = 0; $i < 4; $i++)
                            @php
                                $existingOption = $sign->quizOptions[$i] ?? null;
                            @endphp
                            <div class="flex items-center gap-2 mb-2">
                                <input type="radio" name="correct_option" value="{{ $i }}"
                                       {{ $existingOption && $existingOption->is_correct ? 'checked' : (!$existingOption && $i === 0 ? 'checked' : '') }}>
                                <span>{{ $i + 1 }}.</span>
                                <input type="text" name="options[]" value="{{ $existingOption->word ?? '' }}"
                                       class="border px-2 py-1 flex-1 text-gray-800" placeholder="選択肢{{ $i + 1 }}">
                            </div>
                        @endfor
                        <p class="text-xs text-gray-500 dark:text-gray-300 dark:text-gray-300">※ラジオボタンで選んだ番号が正解になります。空欄の選択肢は保存されません。</p>
                    </div>

                    <button type="submit" class="mt-3 w-full py-2 bg-indigo-700 text-white">
                        更新する
                    </button>
                </form>
            </div>
        </div>
    @endforeach
</div>

<a href="{{ route('home') }}" class="mt-8 block max-w-md mx-auto py-2 bg-indigo-700 text-white text-center">
    ホームにもどる
</a>

<script>
function renumber(container) {
    Array.from(container.children).forEach((div, index) => {
        div.querySelector('span').textContent = (index + 1) + '.';
    });
}

function attachRemoveEvent(div, container) {
    const btn = div.querySelector('.remove-word-btn');
    btn.addEventListener('click', function () {
        if (container.children.length <= 1) {
            alert('単語の意味は最低1つ必要です。');
            return;
        }
        div.remove();
        renumber(container);
    });
}

function addWordField(container) {
    const count = container.children.length + 1;
    const div = document.createElement('div');
    div.className = 'flex items-center gap-2 mb-2';
    div.innerHTML = `
        <span>${count}.</span>
        <input type="text" name="words[]" class="border px-2 py-1 flex-1 text-gray-800" required>
        <button type="button" class="remove-word-btn px-2 py-1 bg-gray-200 border text-sm text-gray-800">×</button>
    `;
    container.appendChild(div);
    attachRemoveEvent(div, container);
}

// 新規登録フォームの「＋意味を追加」
const createContainer = document.getElementById('word-fields');
document.getElementById('add-word-btn').addEventListener('click', function () {
    addWordField(createContainer);
});
Array.from(createContainer.children).forEach(function (div) {
    attachRemoveEvent(div, createContainer);
});

// 各編集フォームの「＋意味を追加」＆最初から表示されている欄
document.querySelectorAll('.add-word-btn').forEach(function (btn) {
    const container = document.getElementById(btn.dataset.target);
    btn.addEventListener('click', function () {
        addWordField(container);
    });
    Array.from(container.children).forEach(function (div) {
        attachRemoveEvent(div, container);
    });
});
</script>
@endsection
