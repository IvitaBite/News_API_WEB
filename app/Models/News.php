<?php

declare(strict_types=1);

namespace App\Models;

use Carbon\Carbon;

class News
{
    private ?string $name;
    private ?string $author;
    private ?string $title;
    private ?string $description;
    private ?string $url;
    private ?string $urlToImage;
    private ?Carbon $publishedAt;
    private ?string $content;

    public function __construct(
        ?string $name,
        ?string $author,
        ?string $title,
        ?string $description,
        ?string $url,
        ?string $urlToImage,
        ?Carbon $publishedAt,
        ?string $content
    )
    {
        $this->name = $name;
        $this->author = $author;
        $this->title = $title;
        $this->description = $description;
        $this->url = $url;
        $this->urlToImage = $urlToImage;
        $this->publishedAt = $publishedAt;
        $this->content = $content;
    }

    public function getName(): ?string
    {
        return $this->name ?? '';
    }

    public function getAuthor(): ?string
    {
        return $this->author ?? '';
    }

    public function getTitle(): ?string
    {
        return $this->title ?? '';
    }

    public function getDescription(): ?string
    {
        return $this->description ?? '';
    }

    public function getUrl(): ?string
    {
        return $this->url ?? '';
    }

    public function getUrlToImage(): ?string
    {
        return $this->urlToImage ?? 'data:image/png;base64,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';
    }

    public function getPublishedAt(): Carbon
    {
        return $this->publishedAt;
    }

    public function getContent(): ?string
    {
        return $this->content ?? '';
    }
}
