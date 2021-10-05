<?php

namespace App\Controller;

use App\Entity\Employees;
use App\Form\EmployeesType;
use App\Repository\EmployeesRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route ("/employees"),
 */
class EmployeesController extends AbstractController
{
    /**
     * @param EmployeesRepository $employeesRepository
     * @return Response
     * @Route ("/", name="employees_index", methods={"GET"}),
     */
    public function index(EmployeesRepository $employeesRepository): Response
    {
        return $this->render('employees/index.html.twig', [
            'employees' => $employeesRepository->findAll(),
        ]);
    }

    /**
     * @param Request $request
     * @return Response
     * @Route ("/new", name="employees_new", methods={"GET","POST"}),
     */
    public function new(Request $request, UserPasswordHasherInterface $passwordHasher): Response
    {
        $employee = new Employees();
        $form = $this->createForm(EmployeesType::class, $employee);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $employee->setRoles(['ROLE_EMPLOYEE']);
            $employee->setStatus('validated');
            $employee->setPassword
            (
                $passwordHasher->hashPassword( $employee, $employee->getPassword() )
            );

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($employee);
            $entityManager->flush();

            return $this->redirectToRoute('employees_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('employees/new.html.twig', [
            'employee' => $employee,
            'form' => $form,
        ]);
    }

    /**
     * @param Employees $employee
     * @return Response
     * @Route("/{id}", name="employees_show", methods={"GET"}),
     */
    public function show(Employees $employee): Response
    {
        return $this->render('employees/show.html.twig', [
            'employee' => $employee,
        ]);
    }

    /**
     * @param Request $request
     * @param Employees $employee
     * @return Response
     * @Route("/{id}/edit", name="employees_edit", methods={"GET","POST"}),
     */
    public function edit(Request $request, Employees $employee): Response
    {
        $form = $this->createForm(EmployeesType::class, $employee);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('employees_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('employees/edit.html.twig', [
            'employee' => $employee,
            'form' => $form,
        ]);
    }

    /**
     * @param Request $request
     * @param Employees $employee
     * @return Response
     * @Route("/{id}", name="employees_delete", methods={"POST"}),
     */
    public function delete(Request $request, Employees $employee): Response
    {
        if ($this->isCsrfTokenValid('delete'.$employee->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($employee);
            $entityManager->flush();
        }

        return $this->redirectToRoute('employees_index', [], Response::HTTP_SEE_OTHER);
    }
}
