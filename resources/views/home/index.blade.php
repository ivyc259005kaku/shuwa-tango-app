@extends('layouts.app')

@section('content')
<div class="max-w-md mx-auto space-y-6">
    <a href="{{ route('quiz.start') }}" class="block bg-blue-500 text-white text-center py-4">問題開始</a>
     <a href="{{ route('progress.index') }}" class="block border border-gray-300 text-center py-4">学習進捗</a>
    <a href="#" class="block border border-gray-300 text-center py-4">苦手単語一覧</a>
</div>
@endsection
