<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use App\Question;
use Illuminate\Support\Collection;
use App\Http\Requests\AddUserRequest;
use App\Http\Requests\EditUserRequest;
use App\Http\Requests\LoginUserRequest;
use App\Answer;

class UsersController extends Controller
{
    /**
     * Home画面遷移用
     * GET
     */
    public function gethome()
    {
        return view('app.home');
    }


    /**
     * 新規登録画面
     * GET
     */
    public function create()
    {
        return view('user.add');
    }

    /**
     * 新規登録したメンバーの登録
     * POST
     * @return ログイン画面
     */
    public function store(AddUserRequest $request)
    {
        $user = new User();

        // フォームから送信されたパラメータの取得 //
        $name_user = $request->name;
        $nickname_user = $request->nickname;
        $email_user = $request->email;
        $password_user = Hash::make($request->password);

        // Userテーブルに保存する //
        $user->fill(['name' => $name_user, 'nickname' => $nickname_user, 'email' => $email_user, 'password' => $password_user]);

        if ($user->save()){
            session()->flash('flash_message', 'ユーザーの登録が完了しました');

            return view('user.login');
        } else {
            session()->flash('flash_message', 'ユーザーの登録に失敗しました');

            return view('user.add');
        }
    }

    /**
     * ユーザー編集機能
     * GET
     * @return ユーザー編集画面
     */
     public function getEditUser()
     {
         return view('user.edit');
     }

    /**ユーザー編集機能
     * POST
     * @return 質問一覧画面
     */
    public function postEditUser(EditUserRequest $request)
    {
        $user = Auth::user();
        $id = $user->id;

        // フォームからデータを取得して更新 //
        $userUpdate = User::find($id);
        $userUpdate->fill(['name' => $request->name, 'nickname' => $request->nickname, 'email' => $request->email, 'password' => $request->password]);

        if($userUpdate->save()){
            session()->flash('flash_message', 'ユーザー情報を更新しました');

            return redirect('/index');
        } else {
            session()->flash('flash_message', 'ユーザー情報の更新に失敗しました');

            return redirect('/edit');
        }

    }

    /**
     * 認証処理
     * GET
     * @return ログイン画面
     */
    public function getAuth()
    {
        return view('user.login');
    }

    /**
     * 認証処理
     * POST
     * @return 質問一覧画面
     */
    public function postAuth(LoginUserRequest $request)
    {
        if(Auth::attempt(['name' =>$request->input('name'), 'email' => $request->input('email'), 'password' => $request->input('password')])){
            session()->flash('flash_message', 'ログインに成功しました');

            // Questionテーブルからid降順にデータを取得する //
            $question = new Question;

            $questions = $question->orderBy('id', 'desc')->get();

            return view('app.index', compact('questions'));
        } else {
            session()->flash('flash_message', 'ログインに失敗しました');

            return redirect('/login');
        }
    }

    /**
     * ログアウト機能
     * GET
     * @return ホーム画面
     */
    public function getLogOut()
    {
        Auth::logout();
        session()->flash('flash_message', 'ログアウトしました');

        return view('app.home');
    }

}
