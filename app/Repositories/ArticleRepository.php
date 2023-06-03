<?php


namespace App\Repositories;


use App\Models\Article;

class ArticleRepository
{
    protected static $repo = __APP__.'../data';

    protected $defaultExt = '.md';

    public static function make()
    {
        return new self();
    }

    public function all()
    {
        $files = scandir(static::$repo);

        return array_filter($files, function ($item) {
            return $item !== '..';
        });
    }

    public function exists($fileName)
    {
        return file_exists(static::$repo.'/'.$fileName.$this->defaultExt);
    }

    public function find($fileName)
    {
        if ( $this->exists($fileName) ) {
            $article = file_get_contents($this->getQualifiedFileName($fileName));
            $date = date("F d Y H:i:s.", filemtime($this->getQualifiedFileName($fileName)));

            return new Article(['exists' => true,
                'title' => $this->getArticleTitle($article),
                'content' => $this->getArticleBody($article),
                'estimated_time' => $this->getArticleEstimatedTime($article),
                'date' => $date,
            ]);
        }

        return new Article(['exists' => false]);
    }

    public function getArticleTitle($article)
    {
        return explode(PHP_EOL, $article)[0];
    }

    public function getArticleBody($article)
    {
        return str_replace($this->getArticleTitle($article), '', $article);
    }

    public function getArticleEstimatedTime($article)
    {
        $body = $this->getArticleBody($article);
        $numberOfWords = count(explode(' ', $body));

        return ceil($numberOfWords / 200);
    }

    protected function getQualifiedFileName($fileName)
    {
        return static::$repo.'/'.$fileName.$this->defaultExt;
    }
}