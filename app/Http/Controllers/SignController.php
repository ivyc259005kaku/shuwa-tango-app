<?php

namespace App\Http\Controllers;

use App\Models\QuizOption;
use App\Models\Sign;
use App\Models\SignWord;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class SignController extends Controller
{
    /**
     * 単語一覧
     */
    public function index()
    {
        $signs = Sign::with(['words', 'quizOptions'])->oldest()->get();

        return view('admin.words', compact('signs'));
    }

    /**
     * 登録処理
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'image' => ['required', 'image', 'max:5120'],
            'source' => ['nullable', 'string', 'max:255'],
            'words' => ['required', 'array', 'min:1'],
            'words.*' => ['required', 'string', 'max:255'],
            'options' => ['nullable', 'array'],
            'options.*' => ['nullable', 'string', 'max:255'],
            'correct_option' => ['nullable', 'integer', 'min:0', 'max:3'],
        ]);

        $path = $request->file('image')->store('signs', 'public');

        $sign = Sign::create([
            'image_path' => $path,
            'source' => $validated['source'] ?? null,
        ]);

        foreach ($validated['words'] as $word) {
            SignWord::create([
                'sign_id' => $sign->id,
                'word' => $word,
            ]);
        }

        // 選択肢（4択）の保存。空欄は無視する
        if (!empty($validated['options'])) {
            foreach ($validated['options'] as $index => $optionWord) {
                if (trim((string) $optionWord) === '') {
                    continue;
                }
                QuizOption::create([
                    'sign_id' => $sign->id,
                    'word' => $optionWord,
                    'is_correct' => (int) ($validated['correct_option'] ?? -1) === $index,
                ]);
            }
        }

        return redirect()->route('admin.words')->with('success', '単語を登録しました。');
    }

    /**
     * 更新処理
     */
    public function update(Request $request, Sign $sign)
    {
        $validated = $request->validate([
            'image' => ['nullable', 'image', 'max:5120'],
            'source' => ['nullable', 'string', 'max:255'],
            'words' => ['required', 'array', 'min:1'],
            'words.*' => ['required', 'string', 'max:255'],
            'options' => ['nullable', 'array'],
            'options.*' => ['nullable', 'string', 'max:255'],
            'correct_option' => ['nullable', 'integer', 'min:0', 'max:3'],
        ]);

        if ($request->hasFile('image')) {
            if ($sign->image_path) {
                Storage::disk('public')->delete($sign->image_path);
            }
            $sign->image_path = $request->file('image')->store('signs', 'public');
        }

        $sign->source = $validated['source'] ?? null;
        $sign->save();

        $sign->words()->delete();
        foreach ($validated['words'] as $word) {
            SignWord::create([
                'sign_id' => $sign->id,
                'word' => $word,
            ]);
        }

        // 選択肢をいったん削除して作り直す
        $sign->quizOptions()->delete();
        if (!empty($validated['options'])) {
            foreach ($validated['options'] as $index => $optionWord) {
                if (trim((string) $optionWord) === '') {
                    continue;
                }
                QuizOption::create([
                    'sign_id' => $sign->id,
                    'word' => $optionWord,
                    'is_correct' => (int) ($validated['correct_option'] ?? -1) === $index,
                ]);
            }
        }

        return redirect()->route('admin.words')->with('success', '単語を更新しました。');
    }

    /**
     * 削除処理
     */
    public function destroy(Sign $sign)
    {
        if ($sign->image_path) {
            Storage::disk('public')->delete($sign->image_path);
        }

        $sign->delete(); // sign_words / quiz_options はcascadeOnDeleteで自動削除される

        return redirect()->route('admin.words')->with('success', '単語を削除しました。');
    }
}