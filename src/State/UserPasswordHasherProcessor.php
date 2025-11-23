<?php

namespace App\State;

use ApiPlatform\Metadata\Operation;
use ApiPlatform\State\ProcessorInterface;
use App\Entity\User;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Bundle\SecurityBundle\Security;
use ApiPlatform\Doctrine\Common\State\PersistProcessor;

class UserPasswordHasherProcessor implements ProcessorInterface
{
    public function __construct(
        private PersistProcessor $persistProcessor,
        private UserPasswordHasherInterface $passwordHasher,
        private Security $security
    ) {}

    public function process(mixed $data, Operation $operation, array $uriVariables = [], array $context = [])
    {
        if ($data instanceof User) {

            if ($data->getPlainPassword()) {

                if ($data->getId() !== null && $data !== $this->security->getUser()) {
                    throw new \Exception('not allowed to edit password');
                }

                $hashed = $this->passwordHasher->hashPassword($data, $data->getPlainPassword());
                $data->setPassword($hashed);

                $data->eraseCredentials();
            }
        }

        return $this->persistProcessor->process($data, $operation, $uriVariables, $context);
    }
}
