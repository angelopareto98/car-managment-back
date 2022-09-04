<?php
namespace App\EventListener;

use Lexik\Bundle\JWTAuthenticationBundle\Event\JWTCreatedEvent;

class JWTCreatedListener{
    public function onJWTCreated(JWTCreatedEvent $event){
        $userConnected = $event->getUser();
        $dataJwt = $event->getData();

        $dataJwt['name'] = $userConnected->getName();
        $dataJwt['username'] = $userConnected->getUsername();

        $event->setData($dataJwt);
    }
}
