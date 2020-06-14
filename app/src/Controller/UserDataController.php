<?php


namespace App\Controller;

use App\Entity\UserData;
use App\Repository\UserDataRepository;
use App\Form\UserDataType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
/**
 *  Class UserDataController.
 *
 * @Route("/userdata")
 */
class UserDataController extends AbstractController
{
    /**
     * Edit action.
     *
     * @param \Symfony\Component\HttpFoundation\Request $request           HTTP request
     * @param \App\Entity\UserData                      $userData           UserData entity
     * @param \App\Repository\UserDataRepository         $userDataRepository UserData repository
     *
     * @return \Symfony\Component\HttpFoundation\Response HTTP response
     *
     * @throws \Doctrine\ORM\ORMException
     * @throws \Doctrine\ORM\OptimisticLockException
     *
     * @Route(
     *     "/{id}/edit",
     *     methods={"GET", "PUT"},
     *     requirements={"id": "[1-9]\d*"},
     *     name="userdata_edit",
     * )
     *
     *@Security("is_granted('ROLE_USER') and is_granted('EDIT', userData) or is_granted('ROLE_ADMIN')")
     *
     *
     */
    public function edit(Request $request, UserData $userData, UserDataRepository $userDataRepository): Response
    {
        $form = $this->createForm(UserDataType::class, $userData, ['method' => 'PUT']);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $userDataRepository->save($userData);

            $this->addFlash('success', 'Edycja się powiodła!');

            return $this->redirectToRoute('recipe_index');
        }

        return $this->render(
            'user/edit_data.html.twig',
            [
                'form' => $form->createView(),
                'userData' => $userData,
            ]
        );
    }
}