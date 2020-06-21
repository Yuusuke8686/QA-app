<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Answer;
use App\Question;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class AnswersController extends Controller
{
    /**
     * 回答投稿処理
     *  POST
     * return 質問詳細画面
     */
    public function AddAnswers(Request $request)
    {
        // 保存するAnswerモデルのインスタンスを生成 //
        $answers = new Answer;
        $user = Auth::user();

        // 保存するのはquestion_idとbody //
        $body = $request->body;
        $user_id = $user->id;
        $question_id = $request->question_id;

        $answers -> fill(['user_id' => $user_id, 'body' => $body, 'question_id' => $question_id ]);

        // 保存する //
        if ($answers->save()){
            session()->flash('flash_message', '回答を投稿しました');
        } else {
            session()->flash('flash_message', '回答の投稿に失敗しました');
        }

        // question_idをもとに質問データを取得 //
        $question = Question::where('id', $question_id)
                    ->first();

                    // 該当の質問に紐づいてる回答をすべて取得 //
        $answers = Answer::where('question_id', $question_id)
                    ->orderBy('id', 'desc')
                    ->get();

        // 質問投稿時間(created_at)を整形 //
        $createdTime = Carbon::createFromFormat('Y-m-d H:i:s', $question->created_at)->format('Y-m-d');

        // 回答数を取得 //
        $answersCount = $answers->count();

        // ログインユーザーのデータを取得 //
        $user = Auth::user();

        return view('app.view', ['question' => $question, 'answers' => $answers, 'createdTime' => $createdTime,
                     'answersCount' => $answersCount, 'user' => $user]);

    }

    /**
     * 回答削除機能
     * GET
     * return 質問詳細画面
     */
    public function getDeleteAnswer($id)
    {
        $user = Auth::user();
        // 遷移先の質問詳細画面で表示するようのquestion_idを取得 //
        $question_id = Answer::where('id', $id)
                        ->value('question_id');

        // 削除する回答のオブジェクトを取得 //
        $delete_answer = Answer::find($id);

        if(true == $delete_answer->delete()){
            session()->flash('flash_message', '回答を削除しました');
        } else {
            session()->flash('flash_message', '回答の削除に失敗しました');
        }

        // question_idをもとに質問データを取得 //
        $question = Question::where('id', $question_id)
                    ->first();

        // 投稿時間を取得 //
        $question_time = $question->value('created_at');

        // 該当の質問に紐づいてる回答をすべて取得 //
        $answers = Answer::where('question_id', $question_id)
                    ->orderBy('id', 'desc')
                    ->get();

        // 質問投稿時間(created_at)を整形 //
        $createdTime = Carbon::createFromFormat('Y-m-d H:i:s', $question_time)->format('Y-m-d');

        // 回答数を取得 //
        $answersCount = $answers->count();

        // ログインユーザーのデータを取得 //
        $user = Auth::user();

        return view('app.view', ['question' => $question, 'answers' => $answers, 'createdTime' => $createdTime,
                     'answersCount' => $answersCount, 'user' => $user]);
    }
}
