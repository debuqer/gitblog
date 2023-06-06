<?php
use \App\Repositories\ArticleRepository;
use \App\Repositories\UserRepository;
use Debuqer\Kati\Http\Request;

router()->before('GET', '/.*', function () {
    Request::make()->appended_user = UserRepository::make()->getMe();
});

router()->get('/', function () {
    $title = user()->username;
    $readme = user()->readme;

    echo template()->render('index', ['title' => $title, 'readme' => $readme]);
});

router()->get('/blog', function () {
    $title = user()->username .' - Blog';

    $articles = ArticleRepository::make()->all('');
    usort($articles, function ($first, $second) {
        return (int)$first->date <= $second->date;
    });
    user()->top_articles = $articles;

    echo template()->render('blog', ['title' => $title, 'user' => user()]);
});

router()->get('/blog/{query}', function ($query) {
    $article = ArticleRepository::make()->findByAddress($query);

    echo template()->render('article', ['title' => $article->title, 'user' => user(), 'article' => $article]);
});