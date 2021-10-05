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

    /**
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
     * @param Request $request
     * @param Customers $customer
     * @return Response
     * @Route ("/{id}", name="customers_delete", methods={"POST"}),
     */
    public function delete(Request $request, Customers $customer): Response
    {
        if ($this->isCsrfTokenValid('delete'.$customer->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($customer);
            $entityManager->flush();
        }

        return $this->redirectToRoute('customers_index', [], Response::HTTP_SEE_OTHER);
    }
}
