<?php

declare(strict_types=1);

namespace App\Models;

class NewsCollection
{
    private array $newsCollection;

    public function __construct(array $newsCollection = [])
    {
        $this->newsCollection = $newsCollection; //todo vai šo man vajag?
        foreach ($newsCollection as $news) {
            $this->add($news);
        }
    }

    public function getNews(): array
    {
        return $this->newsCollection;
    }

    public function add(News $news)
    {
        $this->newsCollection [] = $news;
    }
}
