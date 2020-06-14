<?php

namespace App\Repository;

use App\Document\ContactMessage;
use Doctrine\ODM\MongoDB\Iterator\Iterator;
use Doctrine\ODM\MongoDB\Repository\DocumentRepository;


class ContactMessageRepository extends DocumentRepository
{
    public function findLatestMessages(): Iterator
    {
        return $this
            ->createQueryBuilder()
            ->sort('sentAt', '-1')
            ->limit(5)
            ->getQuery()
            ->getIterator()
            ;
    }

    public function findAllDescending()
    {
        return $this
            ->createQueryBuilder()
            ->sort('sentAt', -1)
            ->getQuery()
            ;
    }

    public function getCount()
    {
        return $this
            ->createQueryBuilder()
            ->count()
            ->getQuery()
            ->execute()
        ;
    }

    public function getLastMonthCount()
    {
        return $this
            ->createQueryBuilder()
            ->count()
            ->getQuery()
            ->execute()
        ;
    }
}
