<?php

namespace App\Reader;
use App\Entity\Article;
use Doctrine\ORM\EntityManagerInterface;

class RssFluxReader {
    // source db 
    private string $name = "le monde";
    // connection string 
    private string $url = "https://www.lemonde.fr/rss/une.xml";

    private EntityManagerInterface $em;

    public function process(){
        $rss_feed = simplexml_load_file($this->url);
        $source = new Source();

        if (! empty($rss_feed)) {
            foreach ($rss_feed->channel->item as $feedItem) {
                $feedItem->title;
                $feedItem->link;
                $feedItem->description;
                $article = new Article();
                $article->setName($feedItem->title);
                $article->setContent($feedItem->description);
                $article->setSource($source);
                $this->em->persist($article);
            }
            $this->em->flush();

        }
     }


}
