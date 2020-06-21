<!DOCTYPE html>
<html lang="ja">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" >
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>
        なぞ箱:トップ
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
<section class="main background-light">
    <div class="container pt-5 col-md-7 col-12">
        @if (false == Auth::check())
        <section class= "sub-header">
            <div class="container col-mb-7 col-12">
                <div class="jumbotron mt-4">
                    <p class="display-4">ようこそ</p>
                    <p class="lead">質問はきちんと言葉にならなくても構いません</p>
                    <hr class="my-4">
                    <p>早速始めてみましょう！</p>
                    <a class="btn btn-warning btn-lg" href="{{action('UsersController@create')}}">ユーザー登録</a>
                </div>
            </div>
        </section>
        @endif
        <h2 class="text-center mb-4">質問広場って？</h2>
            <div class="row text-center">
                <div class="col-sm">
                    <div class="circle-div mb-3">
                        <span class="circle-number">1</span>
                    </div>
                    <h3><i class="fa fa-flag"></i> 相談</h3>
                    <p>質問広場は気軽に相談ができます。</p>
                </div>
                <div class="col-sm">
                    <div class="circle-div mb-3">
                        <span class="circle-number">2</span>
                    </div>
                    <h3><i class="fas fa-comments"></i> 回答</h3>
                    <p>いろんな人から回答がつきます。</p>
                </div>
                <div class="col-sm">
                    <div class="circle-div mb-3">
                        <span class="circle-number">3</span>
                    </div>
                    <h3><i class="fas fa-user-graduate"></i> 学び</h3>
                    <p>回答をしっかり読んで学びにしましょう。</p>
                </div>
            </div>
    </div>
</section>
<footer class="footer background-dark d-flex justify-content-center align-items-center">
    <small>©2019 PHP質問広場 All Rights Reserved.</small>
</footer>
    <script src="https://code.jquery.com/jquery-3.s3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</body>
</html>
