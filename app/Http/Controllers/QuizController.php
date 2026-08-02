<?php

namespace App\Http\Controllers;

use App\Models\QuizOption;
use App\Models\QuizResult;
use App\Models\Sign;
use App\Models\UserProgress;
use Illuminate\Http\Request;

class QuizController extends Controller
{
    /**
     * クイズ開始：登録済みの全イラストをシャッフルして出題順をセッションに保存
     */
    public function start(Request $request)
{
    // 1回のクイズで出題する問題数
    $questionCount = 10;

    $signIds = Sign::pluck('id')
        ->shuffle()
        ->take($questionCount)
        ->values()
        ->all();

    if (empty($signIds)) {
            return redirect()->route('home')->with('error', '出題できる問題が登録されていません。');
        }

        $request->session()->put('quiz.queue', $signIds);
        $request->session()->put('quiz.index', 0);
        $request->session()->put('quiz.correct', 0);

        return redirect()->route('quiz.question');
    }

    /**
     * 問題表示
     */
    public function question(Request $request)
    {
        [$queue, $index] = $this->currentState($request);

        if ($queue === null) {
            return redirect()->route('quiz.start');
        }

        if ($index >= count($queue)) {
            return redirect()->route('quiz.result');
        }

        $sign = Sign::with('quizOptions')->findOrFail($queue[$index]);
        $options = $sign->quizOptions->shuffle()->values();

        return view('quiz.question', [
            'sign' => $sign,
            'options' => $options,
            'current' => $index + 1,
            'total' => count($queue),
        ]);
    }

    /**
     * 回答受付：結果をquiz_resultsに記録し、user_progressを更新
     */
    public function answer(Request $request)
    {
        $validated = $request->validate([
            'option_id' => ['required', 'integer', 'exists:quiz_options,id'],
        ]);

        [$queue, $index] = $this->currentState($request);

        if ($queue === null || $index >= count($queue)) {
            return redirect()->route('quiz.start');
        }

        $signId = $queue[$index];
        $sign = Sign::with('quizOptions')->findOrFail($signId);
        $selectedOption = $sign->quizOptions->firstWhere('id', (int) $validated['option_id']);

        if (! $selectedOption) {
            abort(400, '不正な回答です。');
        }

        $isCorrect = (bool) $selectedOption->is_correct;
        $correctOption = $sign->quizOptions->firstWhere('is_correct', true);

        QuizResult::create([
            'user_id' => $request->user()->id,
            'sign_id' => $signId,
            'is_correct' => $isCorrect,
            'answered_at' => now(),
        ]);

        UserProgress::updateOrCreate(
            ['user_id' => $request->user()->id, 'sign_id' => $signId],
            ['status' => $isCorrect ? UserProgress::STATUS_MASTERED : UserProgress::STATUS_LEARNING]
        );

        if ($isCorrect) {
            $request->session()->put('quiz.correct', $request->session()->get('quiz.correct', 0) + 1);
        }

        return view('quiz.answer', [
            'isCorrect' => $isCorrect,
            'correctWord' => optional($correctOption)->word,
            'current' => $index + 1,
            'total' => count($queue),
            'isLast' => ($index + 1) >= count($queue),
        ]);
    }

    /**
     * 次の問題へ進む
     */
    public function next(Request $request)
    {
        [$queue, $index] = $this->currentState($request);

        if ($queue === null) {
            return redirect()->route('quiz.start');
        }

        $nextIndex = $index + 1;
        $request->session()->put('quiz.index', $nextIndex);

        if ($nextIndex >= count($queue)) {
            return redirect()->route('quiz.result');
        }

        return redirect()->route('quiz.question');
    }

    /**
     * 結果表示
     */
    public function result(Request $request)
    {
        $total = count($request->session()->get('quiz.queue', []));
        $correct = $request->session()->get('quiz.correct', 0);

        // 結果表示後はクイズセッション情報をクリア
        $request->session()->forget(['quiz.queue', 'quiz.index', 'quiz.correct']);

        return view('quiz.result', [
            'total' => $total,
            'correct' => $correct,
        ]);
    }

    /**
     * 現在のクイズ進行状況をセッションから取得
     */
    private function currentState(Request $request): array
    {
        $queue = $request->session()->get('quiz.queue');
        $index = $request->session()->get('quiz.index');

        if ($queue === null || $index === null) {
            return [null, null];
        }

        return [$queue, $index];
    }
}
