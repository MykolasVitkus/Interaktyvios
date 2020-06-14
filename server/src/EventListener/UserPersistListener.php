<?php

namespace App\EventListener;

use Doctrine\ODM\MongoDB\Event\LifecycleEventArgs;
use Doctrine\ODM\MongoDB\Event\OnFlushEventArgs;
use Doctrine\ODM\MongoDB\Event\PreUpdateEventArgs;
use App\Document\User;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class UserPersistListener
{

    private UserPasswordEncoderInterface $encoder;

    /**
     * AdminUserListener constructor.
     * @param $encoder
     */
    public function __construct(UserPasswordEncoderInterface $encoder)
    {
        $this->encoder = $encoder;
    }


    public function prePersist(LifecycleEventArgs $event)
    {
        if ($event->getObject() instanceof User) {
            $user = $event->getObject();
            $this->setPassword($user);
        }
    }

    public function preUpdate(PreUpdateEventArgs $event)
    {
        if ($event->getObject() instanceof User) {
            $user = $event->getObject();
            $this->setPassword($user);
        }
    }

    private function setPassword(User $user)
    {
        if ($user->getPlainPassword()) {
            $encoded = $this->encoder->encodePassword($user, $user->getPlainPassword());
            $user->setPassword($encoded);
        }
    }
}
