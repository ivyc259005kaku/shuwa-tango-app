<?php

namespace App\Http\Controllers;

use App\Models\Sign;
use App\Models\UserProgress;
use Illuminate\Http\Request;

class ProgressController extends Controller
{
    /**
     * 学習進捗（全体サマリー）表示
     */
    public function index(Request $request)
    {
        $userId = $request->user()->id;
        $total = Sign::count();

        // ユーザーの進捗をステータスごとに集計
        $counts = UserProgress::where('user_id', $userId)
            ->selectRaw('status, count(*) as count')
            ->groupBy('status')
            ->pluck('count', 'status');

        $mastered = $counts[UserProgress::STATUS_MASTERED] ?? 0;
        $learning = $counts[UserProgress::STATUS_LEARNING] ?? 0;
        $unlearned = max($total - $mastered - $learning, 0);

        $masteredPercent = $total > 0 ? round($mastered / $total * 100) : 0;
        $learningPercent = $total > 0 ? round($learning / $total * 100) : 0;
        $unlearnedPercent = $total > 0 ? round($unlearned / $total * 100) : 0;

        return view('progress.index', compact(
            'total',
            'mastered',
            'learning',
            'unlearned',
            'masteredPercent',
            'learningPercent',
            'unlearnedPercent'
        ));
    }

    /**
     * 苦手単語一覧表示
     * 判定ロジック：各単語の直近の回答が不正解のものを「苦手」とする
     */
    public function weakWords(Request $request)
    {
        $userId = $request->user()->id;

        $latestResults = \App\Models\QuizResult::where('user_id', $userId)
            ->orderBy('answered_at')
            ->get()
            ->groupBy('sign_id')
            ->map(fn ($results) => $results->last());

        $weakSignIds = $latestResults
            ->filter(fn ($result) => ! $result->is_correct)
            ->keys();

        $weakSigns = Sign::with('words')
            ->whereIn('id', $weakSignIds)
            ->get();

        return view('progress.weak_words', compact('weakSigns'));
    }
}