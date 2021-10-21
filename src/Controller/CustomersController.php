<?php

namespace App\Controller;

use App\Entity\Customers;
use App\Form\CustomersType;
use App\PasswordHasher;
use App\Repository\CustomersRepository;
use App\Service\CustomerService;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route ("/customers")
 */
class CustomersController extends AbstractController
{
    /**
     * Create a customer account
     *
     * @param Request $request
     * @return Response
     * @Route ("/new", name="customers_new", methods={"GET","POST"}),
     */
    public function new(Request $request,
                        UserPasswordHasherInterface $passwordHasher,
                        CustomerService $customerService): Response
    {
        $customer = new Customers();
        $form = $this->createForm(CustomersType::class, $customer);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid())
        {
            $customerService->makeCustomer($customer, $passwordHasher);

            return $this->redirectToRoute('app_login');
        }

        return $this->renderForm('customers/new.html.twig', [
            'customer' => $customer,
            'form' => $form,
        ]);
    }

    /**
     * Display the page where the employee can validate a new account
     *
     * @IsGranted("ROLE_EMPLOYEE"),
     * @Route("/validation", name="customers_validation_page", methods={"GET","POST"}),
     */
    public function displayValidateCustomer(CustomersRepository $customersRepository): Response
    {
        $customers = $customersRepository->findBy([ 'status' =>'pending' ]);

        return $this->render('customers/customersValidationPage.html.twig',
            [ 'customers' => $customers ]);
    }

    /**
     * Validate a new customer's account
     *
     * @IsGranted("ROLE_EMPLOYEE"),
     * @Route("/validation/{customerId}", name="customers_validation", methods={"GET","POST"}),
     */
    public function validateCustomer(CustomersRepository $customersRepository,
                                     int $customerId,
                                     CustomerService $customerService): Response
    {
        $customerService->validateCustomer($customersRepository, $customerId);

        return $this->redirectToRoute('customers_validation_page');
    }

    /**
     * refuse a new customer's account
     *
     * @IsGranted("ROLE_EMPLOYEE"),
     * @param Request $request
     * @param Customers $customer
     * @return Response
     * @Route ("/refuse/{customerId}", name="customers_delete", methods={"GET","POST"}),
     */
    public function delete(CustomersRepository $customersRepository,
                           int $customerId,
                           CustomerService $customerService): Response
    {
        $customerService->refuseCustomer($customersRepository, $customerId);

        return $this->redirectToRoute('customers_validation_page');
    }
}
