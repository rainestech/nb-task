<?php

namespace App\Application\Events\Listeners;

use App\Domain\Entity\UserEntity;
use App\Infrastructure\Messaging\Commands\UserCreatedCommand;
use App\Infrastructure\Transformers\UserDataTransformer;
use Doctrine\Bundle\DoctrineBundle\Attribute\AsDoctrineListener;
use Doctrine\ORM\Event\PostPersistEventArgs;
use Doctrine\ORM\Events;
use Monolog\Attribute\WithMonologChannel;
use Psr\Log\LoggerInterface;
use Symfony\Component\Messenger\Envelope;
use Symfony\Component\Messenger\MessageBusInterface;

#[AsDoctrineListener(event: Events::postPersist, priority: 500, connection: 'default')]
class UserCreatedEventListener
{

    public function __construct(private MessageBusInterface $messageBus)
    {
    }


    public function postPersist(PostPersistEventArgs $args): void
    {
        $entity = $args->getObject();

        if (!$entity instanceof UserEntity) {
            return;
        }

        $message = new UserCreatedCommand(UserDataTransformer::toCommand($entity));

        $envelope = new Envelope($message);

        $this->messageBus->dispatch($envelope);
    }
}
