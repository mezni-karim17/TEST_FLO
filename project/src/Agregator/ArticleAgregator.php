<?php

namespace App\Agregator;

use App\Entity\Source;

class ArticleAgregator {

    // table  column  select view ??
    public function appendDatabase($name, $type, $host, $username, $password, $databaseName)
    {
        $connectionString = "$type:$username:$password@$host/$datbase";
        // hypothese table article exist avec le meme structure que les table proposé
        $this->append(Source::DB, $name ,$connectionString);
        
    }

    public function appendRss($name, $url){
        $this->append(Source::RSS, $name, $url);
    }


    protected function append($type, $name , $src)
    {
        $source = new Source();
        $source->setType($type);
        $source->setName($name);
        $source->setSrc($src);
    }
}