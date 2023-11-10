<?php

declare(strict_types=1);

namespace App\Api;

use App\Models\NewsCollection;
use App\Models\News;
use Carbon\Carbon;
use GuzzleHttp\Client;

class ApiNews
{
    private Client $client;
    private const API_URL = "https://newsapi.org/v2/top-headlines";
    private const API_URL_EVER = "https://newsapi.org/v2/everything";

    public function __construct()
    {
        $this->client = new Client();
    }

    public function searchNews(string $country, string $category): NewsCollection
    {
        $apiKey = $_ENV['NEWS_API_KEY'];
        $url = self::API_URL . "?country={$country}&category={$category}&apiKey={$apiKey}";
        $response = $this->client->get($url);
        $data = json_decode($response->getBody()->getContents());

        $newsCollection = new NewsCollection();

        foreach ($data->articles as $article) {
            $newsCollection->add(new News(
                $article->source->name,
                $article->author,
                $article->title,
                $article->description,
                $article->url,
                $article->urlToImage,
                Carbon::parse($article->publishedAt),
                $article->content
            ));
        }
        return $newsCollection;
    }

    public function searchNewsByParameters(
        string $query,
        string $fromDate,
        string $toDate
    ): NewsCollection
    {
        $apiKey = $_ENV['NEWS_API_KEY'];
        $url = self::API_URL_EVER . "?q={$query}&from={$fromDate}&to={$toDate}&apiKey={$apiKey}";
        $response = $this->client->get($url);
        $data = json_decode($response->getBody()->getContents());

        $newsCollection = new NewsCollection();

        foreach ($data->articles as $article) {
            $newsCollection->add(new News(
                $article->source->name,
                $article->author,
                $article->title,
                $article->description,
                $article->url,
                $article->urlToImage,
                Carbon::parse($article->publishedAt),
                $article->content
            ));
        }
        return $newsCollection;
    }
}
