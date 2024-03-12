<?php

namespace App\Adapter;
use App\Entity\Source;


class FileSystemAdapter implements DataAdapterInterface
{
    public function fetchData(string $src, Source $source): bool
    {
        // Logique pour récupérer les données du flux RSS
    }

    public function supports(string $type): bool
    {
        return $type === 'FS';
    }
}