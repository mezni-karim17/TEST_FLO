<?php

namespace App\State;

use ApiPlatform\Metadata\Operation;
use ApiPlatform\State\ProcessorInterface;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class HashPasswordProcessor implements ProcessorInterface
{

    public function __construct(
        private UserPasswordHasherInterface $userPasswordHasherInterface,
        private ProcessorInterface $processorInterface
    ) {

    }
    public function process(mixed $data, Operation $operation, array $uriVariables = [], array $context = [])
    {
        $hashedPassword = $this->userPasswordHasherInterface->hashPassword(
            $data,
            $data->getPassword()
        );

        $data->setPassword($hashedPassword);

        return $this->processorInterface->process($data, $operation, $uriVariables, $context);
    }
}
