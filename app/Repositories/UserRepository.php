<?php


namespace App\Repositories;


use App\Models\User;

class UserRepository
{
    public static function make()
    {
        return new self();
    }

    public function find($username)
    {
        $userArticle = ArticleRepository::make()->find($username.'/info');

        return new User([
            'username' => $username,
            'profile' => 'https://github.com/'.$username.'.png',
            'summary' => $userArticle->title,
            'description' => $userArticle->content,
            'link' => url('/u/'.$username),
        ]);
    }
}