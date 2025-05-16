<?php
namespace App\EventSubscriber;

use App\Trait\CreationModificationTrait;
use Doctrine\Common\EventSubscriber;
use Doctrine\Persistence\Event\LifecycleEventArgs;
use Doctrine\ORM\Events;

class CreationModificationDateSubscriber implements EventSubscriber
{
    public function getSubscribedEvents(): array
    {
        return [
            Events::prePersist,
            Events::preUpdate,
        ];
    }

    public function prePersist(LifecycleEventArgs $args): void
    {
        $entity = $args->getObject();

        if (!$this->usesTimestampableTrait($entity)) {
            return;
        }

        $now = new \DateTimeImmutable();

        if (null === $entity->getCreatedAt()) {
            $entity->setCreatedAt($now);
        }

        $entity->setUpdatedAt($now);
    }

    public function preUpdate(LifecycleEventArgs $args): void
    {
        $entity = $args->getObject();

        if (!$this->usesTimestampableTrait($entity)) {
            return;
        }

        $entity->setUpdatedAt(new \DateTimeImmutable());

        $em = $args->getObjectManager();
        $meta = $em->getClassMetadata(get_class($entity));
        $em->getUnitOfWork()->recomputeSingleEntityChangeSet($meta, $entity);
    }

    private function usesTimestampableTrait(object $entity): bool
    {
        $traits = class_uses($entity);
        return in_array(CreationModificationTrait::class, $traits);
    }
}
