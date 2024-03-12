<?php

namespace App\Adapter;
use App\Entity\Source;

interface DataAdapterInterface
{
    public function fetchData(string $src, Source $source): bool;

    public function supports(string $type): bool;
}