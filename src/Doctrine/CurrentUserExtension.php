<?php

namespace App\Doctrine;

use Doctrine\ORM\QueryBuilder;
use ApiPlatform\Core\Bridge\Doctrine\Orm\Util\QueryNameGeneratorInterface;
use ApiPlatform\Core\Bridge\Doctrine\Orm\Extension\QueryItemExtensionInterface;
use ApiPlatform\Core\Bridge\Doctrine\Orm\Extension\QueryCollectionExtensionInterface;
use App\Entity\User;
use Symfony\Component\Security\Core\Authorization\AuthorizationCheckerInterface;
use Symfony\Component\Security\Core\Security;

class CurrentUserExtension implements QueryCollectionExtensionInterface, QueryItemExtensionInterface
{
    protected $security;

    public function __construct(Security $security)
    {
        $this->security = $security;
    }



    public function applyToCollection(QueryBuilder $queryBuilder, QueryNameGeneratorInterface $queryNameGenerator, string $resourceClass, string $operationName = null)
    {
        $this->adWhere($queryBuilder, $resourceClass);
    }

    public function applyToItem(QueryBuilder $queryBuilder, QueryNameGeneratorInterface $queryNameGenerator, string $resourceClass, array $identifiers, string $operationName = null, array $context = [])
    {
            $this->adWhere($queryBuilder, $resourceClass);
    }


    private function adWhere(QueryBuilder $queryBuilder, string $resourceClass): void
    {
        $user = $this->security->getUser();
        if ($resourceClass === User::class && !$this->security->isGranted('ROLE_ADMIN') && $user !== null) {
            $routeAlias = $queryBuilder->getRootAliases()[0];
            $queryBuilder->andWhere("$routeAlias.id = :myId");
            
            $queryBuilder->setParameter('myId', $user->getId());
        }
    }
}
