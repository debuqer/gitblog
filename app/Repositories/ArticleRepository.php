<?php


namespace App\Repositories;


use App\Models\Article;

class ArticleRepository
{
    protected static $repo = __PUBLIC__.'/../data';

    protected $defaultExt = '.md';

    public static function make()
    {
        return new self();
    }

    public function all($dir = '')
    {
        $items = [];
        $files = scandir($this->getQualifiedDir($dir));
        if ( $files ) {
            $items = array_filter($files, function ($item) {
                return !in_array($item, ['.', '..', 'info.md']);
            });

            $items = array_map(function ($fileName) use($dir) {
                return $this->find($dir.'/'.$fileName);
            }, $items);
        }

        return $items;
    }

    public function exists($fileName)
    {
        return file_exists(static::$repo.'/'.$fileName.$this->defaultExt);
    }

    public function find($fileName)
    {
        $fileName = str_replace($this->defaultExt, '', $fileName);
        if ( $this->exists($fileName) ) {
            $article = file_get_contents($this->getQualifiedFileName($fileName));
            $date = date("F d Y H:i:s.", filemtime($this->getQualifiedFileName($fileName)));

            return new Article(['exists' => true,
                'title' => $this->getArticleTitle($article),
                'content' => $this->getArticleBody($article),
                'estimated_time' => $this->getArticleEstimatedTime($article),
                'date' => $date,
                'link' =>  url('article/'.$fileName),
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

    protected function getQualifiedDir($dir)
    {
        return static::$repo.'/'.$dir;
    }

    protected function getQualifiedFileName($fileName)
    {
        $fileName = str_replace($this->defaultExt, '', $fileName);

        return static::$repo.'/'.$fileName.$this->defaultExt;
    }
}