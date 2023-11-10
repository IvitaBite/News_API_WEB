<?php

declare(strict_types=1);

namespace App\Controllers;

use App\Api\ApiNews;
use App\Response;
use Carbon\Carbon;

class NewsController
{
    private ApiNews $apiNews;

    public function __construct(ApiNews $apiNews)
    {
        $this->apiNews = $apiNews;
    }

    public function index(): Response
    {
        $country = $_GET['country'] ?? 'lv';
        $category = $_GET['category'] ?? 'science';

        $newsCollection = $this->apiNews->searchNews($country, $category);

        return new Response('index', [
            'articles' => $newsCollection->getNews()
        ]);
    }

    public function getNewsByParameters(): Response
    {
        $query = $_GET['query'] ?? '';
        $fromDate = $_GET['fromDate'] ?? '';
        $toDate = $_GET['toDate'] ?? '';

        $fromDate = Carbon::parse($fromDate)->toDateString();
        $toDate = Carbon::parse($toDate)->toDateString();

        $newsCollection = $this->apiNews->searchNewsByParameters($query, $fromDate, $toDate);

        return new Response('news', [
            'articles' => $newsCollection->getNews()
        ]);
    }
}