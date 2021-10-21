<?php

namespace App\EventSubscriber;

use App\Entity\Books;
use App\Entity\Customers;
use App\Entity\Employees;
use App\Entity\Reservations;
use App\Entity\Users;
use EasyCorp\Bundle\EasyAdminBundle\Event\BeforeEntityPersistedEvent;
use EasyCorp\Bundle\EasyAdminBundle\Event\BeforeEntityUpdatedEvent;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;


class EasyAdminSubscriber implements EventSubscriberInterface
{
    private $passwordHasher;

    public function __construct(UserPasswordHasherInterface $passwordHasher)
    {
        $this->passwordHasher = $passwordHasher;
    }

    public static function getSubscribedEvents(): array
    {
        return [
            BeforeEntityPersistedEvent::class => ['addEntity'],
            BeforeEntityUpdatedEvent::class => ['updateEntity'],
        ];
    }



    public function addEntity(BeforeEntityPersistedEvent $event): void
    {
        $entity = $event->getEntityInstance();

        if ($entity instanceof Users) {
            $this->setEntityUser($entity);
        }

        if( $entity instanceof Reservations) {
            $this->setEntityReservation($entity);
        }

        if( $entity instanceof Books) {
            $this->setEntityBook($entity);
        }
    }

    public function updateEntity(BeforeEntityUpdatedEvent $event): void
    {
        $entity = $event->getEntityInstance();

        if ($entity instanceof Users) {
            $this->setEntityUser($entity);
        }
    }

    /**
     * @param Users $entity
     * @return void
     * @uses Class::\App\Entity\Users
     */
    public function setEntityUser(Users $entity): void
    {
        if($entity instanceof Employees) {
            $entity->setRoles(["ROLE_EMPLOYEE"]);
            $entity->setStatus('validated');
        }

        if($entity instanceof Customers) {
            $entity->setRoles(["ROLE_CUSTOMER"]);
            $entity->setStatus('validated');
        }
        $hashedPassword = $this->passwordHasher->hashPassword($entity, $entity->getPassword());
        $entity->setPassword($hashedPassword);
    }

    public function setEntityReservation($entity)
    {
        $endDate = $entity->getStartDate();
        $startDate = clone($endDate);
        $increment = '+0';

        if($entity->getStatus() == 'reserved')
        {
            $increment = '+3 day';
        }

        if($entity->getStatus() == 'borrowed')
        {
            $increment = '+21 day';
        }

        $endDate = $startDate->modify($increment);

        $entity->setStartDate($startDate);
        $entity->setEndDate($endDate);
    }

    public function setEntityBook($entity)
    {
        $entity->setImage('default_cover.jpg');
    }
}