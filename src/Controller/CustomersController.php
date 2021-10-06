<?php

namespace App\Controller;

use App\Entity\Customers;
use App\Form\CustomersType;
use App\PasswordHasher;
use App\Repository\CustomersRepository;
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
    public function new(Request $request, UserPasswordHasherInterface $passwordHasher): Response
    {
        $customer = new Customers();
        $form = $this->createForm(CustomersType::class, $customer);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $customer->setRoles(['ROLE_CUSTOMER']);
            $customer->setStatus('pending');
            $customer->setPassword
            (
                $passwordHasher->hashPassword( $customer, $customer->getPassword() )
            );

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($customer);
            $entityManager->flush();

            return $this->redirectToRoute('customers_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('customers/new.html.twig', [
            'customer' => $customer,
            'form' => $form,
        ]);
    }

    /**
     * Display the page where the employee can validate a new account
     *
     * @Route("/validationPage", name="customers_validation_page", methods={"GET","POST"}),
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
     * @Route("/validation/{customerId}", name="customers_validation", methods={"GET","POST"}),
     */
    public function validateCustomer(CustomersRepository $customersRepository, int $customerId): Response
    {
        $customer = $customersRepository->find($customerId);
        $customer->setStatus('validated');
        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->persist($customer);
        $entityManager->flush();

        return $this->redirectToRoute('customers_validation_page');
    }

    /**
     * refuse a new customer's account
     *
     * @param Request $request
     * @param Customers $customer
     * @return Response
     * @Route ("/refuse/{customerId}", name="customers_delete", methods={"GET","POST"}),
     */
    public function delete(CustomersRepository $customersRepository, int $customerId): Response
    {
        $customerToDelete = $customersRepository->find($customerId);
        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->remove($customerToDelete);
        $entityManager->flush();

        return $this->redirectToRoute('customers_validation_page');
    }

    /**
     * Not used for now
     *
     * @param Customers $customer
     * @return Response
     * @Route ("/{id}", name="customers_show", methods={"GET"}),
     */
    public function show(Customers $customer): Response
    {
        return $this->render('customers/show.html.twig', [
            'customer' => $customer,
        ]);
    }

    /**
     * not used for now
     *
     * @param Request $request
     * @param Customers $customer
     * @return Response
     * @Route ("/{id}/edit", name="customers_edit", methods={"GET","POST"}),
     */
    public function edit(Request $request, Customers $customer): Response
    {
        $form = $this->createForm(CustomersType::class, $customer);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('customers_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('customers/edit.html.twig', [
            'customer' => $customer,
            'form' => $form,
        ]);
    }

    /**
     * not used for now
     *
     * @param CustomersRepository $customersRepository
     * @return Response
     * @Route ("/", name="customers_index",  methods={"GET"}),
     */
    public function index(CustomersRepository $customersRepository): Response
    {
        return $this->render('customers/index.html.twig', [
            'customers' => $customersRepository->findAll(),
        ]);
    }
}
