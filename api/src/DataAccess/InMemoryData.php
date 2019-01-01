<?php

declare(strict_types=1);

namespace App\DataAccess;

use ApiPlatform\Core\DataProvider\CollectionDataProviderInterface;
use ApiPlatform\Core\DataProvider\ItemDataProviderInterface;
use ApiPlatform\Core\DataProvider\RestrictedDataProviderInterface;
use ApiPlatform\Core\Exception\ResourceClassNotSupportedException;
use App\Entity\NewsArticle;

class InMemoryData implements
    ItemDataProviderInterface,
    RestrictedDataProviderInterface,
    CollectionDataProviderInterface
{
    /**
     * @var array
     */
    private $articles;

    /**
     * InMemoryData constructor.
     *
     * @throws \Exception
     */
    public function __construct()
    {
        $this->generateTestNewsArticles();
    }

    /**
     * Retrieves an item.
     *
     * @param array|int|string $id
     *
     * @throws ResourceClassNotSupportedException
     *
     * @return object|null
     */
    public function getItem(string $resourceClass, $id, string $operationName = null, array $context = [])
    {
        return $this->articles[$id] ?? null;
    }

    public function supports(string $resourceClass, string $operationName = null, array $context = []): bool
    {
//        return ($resourceClass === NewsArticle::class);
        return false;
    }

    private function generateTestNewsArticles(): void
    {
        $test = new NewsArticle();
        $test->setId(1);
        $test->setBody('This is the body');
        $test->setTitle('This is the first news article');
        $test->setPublicationDate((new \DateTimeImmutable()));

        $test2 = new NewsArticle();
        $test2->setId(2);
        $test2->setBody('This is the body');
        $test2->setTitle('This is the second news article');
        $test2->setPublicationDate((new \DateTimeImmutable()));

        $this->articles = [
            1 => $test,
            2 => $test2
        ];
    }

    /**
     * Retrieves a collection.
     *
     * @throws ResourceClassNotSupportedException
     *
     * @return array|\Traversable
     */
    public function getCollection(string $resourceClass, string $operationName = null)
    {
        return $this->articles;
    }
}
