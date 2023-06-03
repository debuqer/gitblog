<?php
use \App\Repositories\ArticleRepository;
use \App\Repositories\UserRepository;
use Debuqer\Kati\Http\Request;

router()->before('GET', '/u/{query}', function ($query) {
    $user = UserRepository::make()->find(explode('/', $query)[0]);

    Request::make()->appended_user = $user;
});

router()->get('/u/{query}', function ($query) {
    if ( count(explode('/', $query)) == 1 ) {
        $user = Request::make()->appended_user;

        $articles = ArticleRepository::make()->all($user->username);
        usort($articles, function ($first, $second) {
            return (int)$first->date <= $second->date;
        });
        $user->top_articles = $articles;

        echo template()->render('author', ['title' => $user->username, 'user' => $user]);
    } else {
        $user = $user = Request::make()->appended_user;
        $article = ArticleRepository::make()->findByAddress($query);

        echo template()->render('article', ['title' => $article->title, 'user' => $user, 'article' => $article]);
    }
});