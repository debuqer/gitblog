<?php
use \App\Repositories\ArticleRepository;
use \App\Repositories\UserRepository;
use Debuqer\Kati\Http\Request;
use Debuqer\Kati\Http\Response;

router()->before('GET', '/.*', function () {
    Request::make()->appended_user = UserRepository::make()->getMe();
});

router()->get('/', function () {
    $title = user()->username;
    $readme = user()->readme;


    Response::create(template()->render('index', ['title' => $title, 'readme' => $readme]), 200);
});

router()->get('/blog', function () {
    $title = user()->username .' - Blog';

    $articles = ArticleRepository::make()->all('');
    usort($articles, function ($first, $second) {
        return (int)$first->date <= $second->date;
    });
    user()->top_articles = $articles;

    Response::create(template()->render('blog', ['title' => $title, 'user' => user()]));
});

router()->get('/blog/{query}', function ($query) {
    $article = ArticleRepository::make()->findByAddress($query);

    Response::create(template()->render('article', ['title' => $article->title, 'user' => user(), 'article' => $article]));
});