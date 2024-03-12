<?php

namespace App\Services;

use App\Adapter\DataAdapterInterface;


class AdapterAgregator
{

    private $adapters;
    public function __construct(iterable $adapters)
    {
        $this->adapters = $adapters;
    }

    public function getAdapter(string $type): ?DataAdapterInterface
    {
        foreach ($this->adapters as $adapter) {
            if ($adapter->supports($type)) {
                return $adapter;
            }
        }

        return null;
    }

}