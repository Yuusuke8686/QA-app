<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Answer;
use App\Question;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class QuestionsController extends Controller
{
    /**
     * 質問一覧表示機能
     *
     */
    public function indexQuestion(Request $request)
    {
        // Questionテーブルからid降順にデータを取得する //
        $question = new Question;

        $questions = $question->orderBy('id', 'desc')->get();

        return view('app.index', ['questions' => $questions]);
    }

    /**
     * 質問投稿機能
     * GET
     */
    public function getAddQuestion(Request $request)
    {
        //  GETでアクセスされたときは質問投稿画面を表示するだけ //
        return view('app.add');
    }

    /**
     * 質問投稿機能
     * POST
     */
    public function postAddQuestion(Request $request)
    {
        // 質問投稿画面のフォームから送られてきたデータをQuestionテーブルに保存する //
        $question = new Question;
        $user = Auth::user();

        $body_question = $request->body;
        $user_id_question = $user->id;

        $question->fill(['user_id' => $user_id_question, 'body' => $body_question]);

        if($question->save()){
            session()->flash('flash_message', '質問を投稿しました!');
             // Questionテーブルからid降順にデータを取得する //
             $questions = $question->orderBy('id', 'desc')->get();

            return view('app.index', compact('questions'));
        }
        session()->flash('flash_message', '投稿に失敗しました');

        return view('app.add');
    }

    /**
     * 質問詳細画面表示
     * POST
     */
    public function getViewQuestion($id)
    {
        // question_idをもとに質問データを取得 //
        $question = Question::where('id', $id)
                    ->first();

        // 該当の質問に紐づいてる回答をすべて取得 //
        $answers = Answer::where('question_id', $id)
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
     * 質問削除機能
     * GET
     * return 質問一覧画面
     */
    public function getDeleteQuestion(int $question_id)
    {
        // 質問投稿者以外は質問を削除できない。 //
        $user = Auth::user();
        if($user->id !== $question_id){
            session()->flash('flash_message', '投稿者以外は質問を削除できません');

            return redirect('/index');
        }

        // 質問を削除 //
        $question = Question::find($question_id);
        if(true == $question->delete()){
            session()->flash('falsh_message', '質問を削除しました');
        } else {
            session()->flash('flash_message', '質問の削除に失敗しました');
        }
        return redirect('/index');

    }

}
