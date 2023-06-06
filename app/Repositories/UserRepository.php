<?php


namespace App\Repositories;


use App\Models\User;

class UserRepository
{
    public static function make()
    {
        return new self();
    }

    public function getMe()
    {
        $username = $_ENV['username'];

        $readmeArticle = ArticleRepository::make()->findByAddress('README');
        $resumeArticle = ArticleRepository::make()->findByAddress('RESUME');

        return new User([
            'username' => $username,
            'profile' => 'https://github.com/'.$username.'.png',
            'summary' => $_ENV['summary'],
            'readme' => $readmeArticle->content,
            'resume' => $resumeArticle->content,
        ]);
    }
}