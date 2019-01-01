<?php

declare(strict_types=1);

namespace App\DataAccess;

use ApiPlatform\Core\DataPersister\DataPersisterInterface;
use ApiPlatform\Core\DataProvider\CollectionDataProviderInterface;
use ApiPlatform\Core\DataProvider\ItemDataProviderInterface;
use ApiPlatform\Core\Exception\ResourceClassNotSupportedException;
use App\Entity\NewsArticle;
use App\Repository\NewsArticleRepository;

class InDatabaseData implements
    ItemDataProviderInterface,
    CollectionDataProviderInterface,
    DataPersisterInterface
{
    /**
     * @var NewsArticleRepository
     */
    private $newsArticleRepository;

    /**
     * InMemoryData constructor.
     *
     * @throws \Exception
     */
    public function __construct(NewsArticleRepository $newsArticleRepository)
    {
        $this->newsArticleRepository = $newsArticleRepository;
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
        return $this->newsArticleRepository->find($id) ?? null;
    }

    /**
     * Is the data supported by the persister?
     */
    public function supports($data): bool
    {
        return (bool)$data === NewsArticle::class;
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
        return $this->newsArticleRepository->findAll();
    }

    /**
     * Persists the data.
     *
     *
     * @return object|void Void will not be supported in API Platform 3, an object should always be returned
     */
    public function persist($data)
    {
        $this->newsArticleRepository->save($data);
    }

    /**
     * Removes the data.
     */
    public function remove($data)
    {
        $this->newsArticleRepository->remove($data);
    }
}
