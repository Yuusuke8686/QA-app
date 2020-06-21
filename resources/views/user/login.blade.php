<!DOCTYPE html>
<html lang="ja">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" >
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>
        なぞ箱～シンプルなQAサイト～:質問詳細
    </title>
    <meta content="icon">

    <script src="https://cdn.jsdelivr.net/npm/jquery@3.3.1/dist/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.2.1/dist/js/bootstrap.bundle.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.2.1/dist/css/bootstrap.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/FortAwesome/Font-Awesome@5.6.3/css/all.css">
</head>
<body>
    <header class="header">
    <nav class="navbar navbar-expand-lg navbar-light background-white">
        <div class="container col-md-7 col-12">
            <a class="navbar-brand" href="/">
                <i class="fas fa-tree"></i> なぞ箱～シンプルなQAサイト～
            </a>

            <button
                type="button"
                class="navbar-toggler"
                data-toggle="collapse"
                data-target="#Navber">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="Navber">
                @if (Auth::check())
                <ul class="navbar-nav mr-auto">
                        <li class="nav-item">
                            <a class="nav-link" href="{{action('QuestionsController@indexQuestion')}}">質問一覧</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{action('QuestionsController@getAddQuestion')}}">質問を投稿する</a>
                        </li>
                </ul>
                @endif
                <ul class="navbar-nav ml-auto">
                    @if (Auth::check())
                    @php
                        $user = Auth::user();
                    @endphp
                    <li class="nav-item">
                        <a class="nav-link" href="{{action('UsersController@getEditUser')}}">{{$user->nickname}}</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{action('UsersController@getLogOut')}}">ログアウト</a>
                    </li>
                    @else
                    <li class="nav-item">
                        <a class="nav-link" href="{{action('UsersController@create')}}">ユーザー登録</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{action('UsersController@getAuth')}}">ログイン</a>
                    </li>
                    @endif
                </ul>
            </div>
        </div>
    </nav>
</header>
@if (session('flash_message'))
<div class="flash_message">
    {{session('flash_message')}}
</div>
@endif

<section class="main background-light">
    <div class="container pt-5 col-md-7 col-12">
        <h2 class="mb-3"><i class="fas fa-sign-in-alt"></i> ログイン</h2>
        @if ($errors->any())
            <div>
                <ul>
                    @foreach ($errors->all() as $message)
                    <li>{{$message}}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <form action="/index" method="post">
            {{ csrf_field() }}
            <div class="form-group">
                <label>ユーザー名</label>
                <input class="form-control" type="text" name="name" placeholder="ユーザー名" maxlength="50">
            </div>
            <div class="form-group">
                <label>メールアドレス</label>
                <input class="form-control" type="email" name="email" placeholder="メールアドレス" maxlength="50">
            </div>
            <div class="form-group">
                <label>パスワード</label>
                <input class="form-control" type="password" name="password" placeholder="パスワード" maxlength="50">
            </div>
            <button class="btn btn-warning" type="submit">ログイン</button>
        </form>
    </div>
</section>
<footer class="footer background-dark d-flex justify-content-center align-items-center">
    <small>©2019 なぞ箱～シンプルなQAサイト～ All Rights Reserved.</small>
</footer>
    <script src="https://code.jquery.com/jquery-3.s3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</body>
</html>
