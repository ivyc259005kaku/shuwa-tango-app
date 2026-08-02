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
}