<?php
use \App\Repositories\ArticleRepository;
use \App\Repositories\UserRepository;

router()->get('/a/(\w+)/(\w+)', function ($username, $articleName) {
    $file = $username.'/'.$articleName;

    $article = ArticleRepository::make()->find($file);
    $user = UserRepository::make()->find($username);

    echo template()->render('article', ['user' => $user, 'article' => $article]);
});

router()->get('/u/(\w+)', function ($username) {
    $user = UserRepository::make()->find($username);

    $articles = ArticleRepository::make()->all($username);
    usort($articles, function($first, $second) {
        return (int) $first->date <= $second->date;
    });
    $user->top_articles = array_slice($articles, 0, 3);

    echo template()->render('author', ['user' => $user]);
});

router()->get('/index', function () {
    echo template()->render('index');
});