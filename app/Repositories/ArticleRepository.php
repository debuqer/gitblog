<?php


namespace App\Repositories;


use App\Models\Article;

class ArticleRepository
{
    protected static $repo = __ROOT__.'datasource';

    protected $defaultExt = '.md';

    public static function make()
    {
        return new self();
    }

    public function scanDir($dir, &$results = [])
    {
        $files = scandir($dir);

        foreach ($files as $key => $value) {
            $real_path = realpath($dir . DIRECTORY_SEPARATOR . $value);
            if (!is_dir($real_path)) {
                if ( !in_array($value, ['.', '..']) ) {
                    $results[] = $this->find($real_path);
                }
            } else if ($value != "." && $value != "..") {
                $results[$value] = [];
                $this->scanDir($real_path, $results[$value]);
            }
        }

        return $results;
    }

    public function all($dir = '')
    {
        $files = [];
        $this->scanDir($this->getQualifiedDir($dir), $files);

        $items = [];
        array_walk_recursive($files, function ($item) use(&$items) {
            $items[] = $item;
        });


        return $items;
    }

    public function exists($fileName)
    {
        return file_exists($fileName);
    }

    public function findByAddress($address)
    {
        $fileName = realpath(static::$repo.'/'.$address.$this->defaultExt);

        return $this->find($fileName);
    }

    public function find($fileName)
    {
        if ( $this->exists($fileName) ) {
            $article = file_get_contents($fileName);
            $date = date("F d Y H:i:s.", filemtime($fileName));

            return new Article(['exists' => true,
                'title' => $this->getArticleTitle($article),
                'body' => $this->getArticleBody($article),
                'content' => $article,
                'summary' => $this->getArticlFirstWords($article, 40) . $this->getEtcDots($article, 40),
                'estimated_time' => $this->getArticleEstimatedTime($article),
                'date' => $date,
                'link' => url('blog/'.$this->getSlug($fileName)),
                'tags' => $this->getArticleTags($fileName),
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

    public function getArticlFirstWords($article, $numOfWords = 10)
    {
        return implode(' ', array_slice(explode(' ', $this->getArticleBody($article)), 0, $numOfWords));
    }

    public function getEtcDots($article, $numOfWords = 10)
    {
        return $this->getArticlFirstWords($article, $numOfWords) === $article ? '' : ' ...';
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

    public function getSlug($fileName)
    {
        return str_replace($this->defaultExt, '', explode('datasource/', $fileName)[1]);
    }

    public function getArticleTags($fileName)
    {
        $slug = $this->getSlug($fileName);

        return explode('/', $slug);
    }
}