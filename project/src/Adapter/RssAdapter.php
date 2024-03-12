<?php

namespace App\Adapter;

use App\Entity\Article;
use App\Entity\Source;
use Doctrine\ORM\EntityManagerInterface;


class RssAdapter implements DataAdapterInterface
{

    private $em;

    public function __construct(EntityManagerInterface $em)
    {
        $this->em = $em;
    }

    public function fetchData(string $src, Source $source): bool
    {

        $xml = simplexml_load_file($src);
        foreach ($xml->channel->item as $item) {
            $article = new Article();
            $article->setName((string) $item->title);
            $article->setContent((string) $item->description);
            $article->setSource($source);

            $this->em->persist($article);
        }

        $this->em->flush();

        return true;
    }

    public function supports(string $type): bool
    {
        return $type === 'RSS';
    }
}