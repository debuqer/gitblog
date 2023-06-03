<?php


namespace App\Repositories;


use App\Models\Repo;

class ReposRepository
{
    public static function make()
    {
        return new self();
    }

    public function find($repo)
    {
        $config = require __PUBLIC__.'/../config/repos.php';
        $repoConfig = $config[$repo] ?? [];

        return new Repo($repoConfig);
    }
}