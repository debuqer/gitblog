<?php
use \App\Repositories\ArticleRepository;
use \App\Repositories\UserRepository;
use Debuqer\Kati\Http\Request;
use Debuqer\Kati\Http\Response;

router()->before('GET', '/.*', function () {
    Request::make()->appended_user = UserRepository::make()->getMe();

    Response::make()->headers->remove('X-Powered-By');
});

router()->get('/', function () {
    $title = user()->username;
    $readme = user()->readme;


    Response::make()->setStatusCode(200);
    Response::make()->setContent(template()->render('index', ['title' => $title, 'readme' => $readme, 'user' => user()]));
});

router()->get('/blog', function () {
    $title = user()->username .' - Blog';

    $articles = ArticleRepository::make()->all('');
    usort($articles, function ($first, $second) {
        return (int)$first->date <= $second->date;
    });
    user()->top_articles = $articles;

    Response::make()->setStatusCode(200);
    Response::make()->setContent(template()->render('blog', ['title' => $title, 'user' => user()]));
});

router()->get('/blog/{query}', function ($query) {
    $article = ArticleRepository::make()->findByAddress($query);

    Response::make()->setStatusCode(200);
    Response::make()->setContent(template()->render('article', ['title' => $article->title, 'user' => user(), 'article' => $article]));
});