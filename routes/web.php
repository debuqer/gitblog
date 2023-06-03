<?php
use \App\Repositories\ArticleRepository;
use \App\Repositories\UserRepository;

router()->get('/', function () {
    $title = 'DEBUQER';
    $username = 'debuqer';

    $user = UserRepository::make()->find($username);

    $articles = ArticleRepository::make()->all($username);
    usort($articles, function($first, $second) {
        return (int) $first->date <= $second->date;
    });
    $user->top_articles = $articles;

    echo template()->render('author', ['title' => $title, 'user' => $user]);
});

router()->get('/u/{file_name}', function ($file_name) {
    $article = ArticleRepository::make()->findByAddress($file_name);
    $user = UserRepository::make()->find(explode('/', $file_name)[0]);

    echo template()->render('article', ['title' => $article->title, 'user' => $user, 'article' => $article]);
});