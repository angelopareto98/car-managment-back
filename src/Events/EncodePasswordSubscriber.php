<?php

namespace App\Events;

use ApiPlatform\Core\EventListener\EventPriorities;
use App\Entity\User;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpKernel\Attribute\AsController;
use Symfony\Component\HttpKernel\Event\ViewEvent;
use Symfony\Component\HttpKernel\KernelEvents;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;


class EncodePasswordSubscriber implements EventSubscriberInterface
{
    /**
     * @var UserPasswordHasherInterface
     */
    protected $encoder;

    public function __construct(UserPasswordHasherInterface $encoder)
    {
        $this->encoder = $encoder;
    }


    public static function getSubscribedEvents()
    {
        return [KernelEvents::VIEW => ['encodePassword', EventPriorities::PRE_WRITE]];
    }

    public function encodePassword(ViewEvent $event){
        $result = $event->getControllerResult();
        $method = $event->getRequest()->getMethod();

        if ($result instanceof User && ($method === 'POST' || 'PUT') ) {
            if (!empty($result->getPassword())) {
                $hash = $this->encoder->hashPassword($result, $result->getPassword());
                $result->setPassword($hash);
            }
        }
    }
}
