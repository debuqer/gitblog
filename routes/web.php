<?php
use \App\Repositories\ArticleRepository;
use \App\Repositories\UserRepository;

router()->get('/u/(\w+)', function ($username) {
    $user = UserRepository::make()->find($username);

    $articles = ArticleRepository::make()->all($username);
    usort($articles, function($first, $second) {
        return (int) $first->date <= $second->date;
    });
    $user->top_articles = $articles;

    echo template()->render('author', ['user' => $user]);
});

router()->get('/u/{file_name}', function ($file_name) {
    $article = ArticleRepository::make()->findByAddress($file_name);
    $user = UserRepository::make()->find(explode('/', $file_name)[0]);

    echo template()->render('article', ['user' => $user, 'article' => $article]);
});


router()->get('/index', function () {
    echo template()->render('index');
});