<?php

namespace App\Service;

use App\Entity\Customers;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class CustomerService extends AbstractController
{
    public function makeCustomer(Customers $customer, UserPasswordHasherInterface $passwordHasher)
    {
        $customer->setRoles(['ROLE_CUSTOMER']);
        $customer->setStatus('pending');
        $customer->setPassword
        (
            $passwordHasher->hashPassword( $customer, $customer->getPassword() )
        );

        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->persist($customer);
        $entityManager->flush();
    }

    public function validateCustomer($customersRepository, int $customerId)
    {
        $customer = $customersRepository->find($customerId);
        $customer->setStatus('validated');
        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->persist($customer);
        $entityManager->flush();

        $this->addFlash('success', 'vous avez accepté le compte.');
    }

    public function refuseCustomer($customersRepository, int $customerId)
    {
        $customerToDelete = $customersRepository->find($customerId);
        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->remove($customerToDelete);
        $entityManager->flush();

        $this->addFlash('danger', 'vous avez refusé le compte.');
    }
}