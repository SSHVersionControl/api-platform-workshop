<?php

declare(strict_types=1);

namespace App\Repository;

use App\Entity\NewsArticle;
use Doctrine\ORM\EntityRepository;

class NewsArticleRepository extends EntityRepository
{
    public function save(NewsArticle $newsArticle)
    {
        $this->getEntityManager()->persist($newsArticle);
        $this->getEntityManager()->flush();
    }

    public function remove(NewsArticle $newsArticle)
    {
        $this->getEntityManager()->remove($newsArticle);
        $this->getEntityManager()->flush();
    }
}
