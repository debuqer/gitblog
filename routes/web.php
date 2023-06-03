<?php
use \App\Repositories\ArticleRepository;
use \App\Repositories\UserRepository;

router()->get('/article/(\w+)/(\w+)', function ($username, $articleName) {
    $file = $username.'/'.$articleName;

    $article = ArticleRepository::make()->find($file);
    $user = UserRepository::make()->find($username);

    echo template()->render('article', ['user' => $user, 'article' => $article]);
});

router()->get('/author', function () {
    echo template()->render('author');
});

router()->get('/index', function () {
    echo template()->render('index');
});