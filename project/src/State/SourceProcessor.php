<?php

namespace App\State;

use ApiPlatform\State\ProcessorInterface;
use ApiPlatform\Metadata\Operation;
use App\Entity\Source;
use App\Services\AdapterAgregator;
use Doctrine\ORM\EntityManagerInterface;

class SourceProcessor implements ProcessorInterface
{

  private $em;

  private $adapterAgregator;

  public function __construct(EntityManagerInterface $em, AdapterAgregator $adapterAgregator)
  {
    $this->em = $em;
    $this->adapterAgregator = $adapterAgregator;
  }

  public function process(mixed $data, Operation $operation, array $uriVariables = [], array $context = []): Source
  {
    $this->em->persist($data);
    $this->em->flush();

    $type = $data->getType();

    $adapter = $this->adapterAgregator->getAdapter($type);


    if ($adapter !== null) {
      $adapter->fetchData($data->getSrc(), $data);
    }

    return $data;
  }



}