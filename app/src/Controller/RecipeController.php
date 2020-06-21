<?php
/**
 * Recipe controller.
 */

namespace App\Controller;

use App\Entity\Comment;
use App\Entity\Mark;
use App\Entity\Recipe;
use App\Form\CommentMarkForm;
use App\Form\RecipeType;
use App\Service\CommentService;
use App\Service\MarkService;
use App\Service\RecipeService;
use Knp\Component\Pager\PaginatorInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 *  Class RecipeController.
 *
 * @Route("/recipe")
 */
class RecipeController extends AbstractController
{
    /**
     * Recipe service.
     *
     * @var \App\Service\RecipeService
     */
    private $recipeService;

    /**
     * Comment service.
     *
     * @var \App\Service\CommentService
     */
    private $commentService;

    /**
     * Mark service.
     *
     * @var \App\Service\MarkService
     */
    private $markService;

    /**
     * RecipeController constructor.
     *
     * @param \App\Service\RecipeService  $recipeService  Recipe service
     * @param \App\Service\CommentService $commentService Comment service
     * @param \App\Service\MarkService    $markService    Mark Service
     */
    public function __construct(RecipeService $recipeService, CommentService $commentService, MarkService $markService)
    {
        $this->recipeService = $recipeService;
        $this->commentService = $commentService;
        $this->markService = $markService;
    }

    /**
     * Show action.
     *
     * @param \App\Entity\Recipe $recipe Recipe entity
     * @param \Symfony\Component\HttpFoundation\Request $request HTTP request
     *
     * @return \Symfony\Component\HttpFoundation\Response HTTP response
     *
     * @Route(
     *     "/{id}",
     *     methods={"GET", "POST"},
     *     name="recipe_show",
     *     requirements={"id": "[1-9]\d*"},
     * )
     */
    public function show(Recipe $recipe, Request $request): Response
    {



        $form = $this->createForm(CommentMarkForm::class);
        $form->handleRequest($request);


        if ($form->isSubmitted() && $form->isValid()) {
            $formData = $form->getData();
            $mark = $formData['mark'];
            $comment = $formData['comment_content'];

            $comment->setRecipe($recipe);
            $comment->setAuthor($this->getUser());
            $comment->setCommentDate(new \DateTime());
            $this->commentService->save($comment);

            $mark->setRecipe($recipe);
            $mark->setUser($this->getUser());

            $this->markService->save($mark);

            $rating = $this->markService->calculateAvg($recipe);
            var_dump($rating);
            $recipe->setRating($rating);

            $this->recipeService->save($recipe);

            $this->addFlash('success', 'Dodanie nowego komentarza się powiodło');
            $this->addFlash('success', 'Dodanie nowej oceny się powiodło');

            return $this->redirectToRoute('recipe_show', ['id' => $recipe->getId()]);
         //_show,  ['id' => $id]);
        }

        return $this->render('recipe/show.html.twig',
                [
                    'recipe' => $recipe,
                    'form' => $form->createView(),
                ]
            );
    }

    /**
     * Index action.
     *
     * @param \Symfony\Component\HttpFoundation\Request $request HTTP request
     *
     * @return \Symfony\Component\HttpFoundation\Response HTTP response
     *
     * @Route(
     *     "/",
     *     name="recipe_index",
     * )
     */
    public function index(Request $request): Response
    {

        $pagination = $this->recipeService->createPaginatedList(
            $request->query->getInt('page', 1),
            $request->query->getAlnum('filters', [])
        );

        return $this->render(
            'recipe/index.html.twig',
            ['pagination' => $pagination,
                ]
        );
    }

    /**
     * Create action.
     *
     * @param \Symfony\Component\HttpFoundation\Request $request HTTP request
     *
     * @return \Symfony\Component\HttpFoundation\Response HTTP response
     *
     * @throws \Doctrine\ORM\ORMException
     * @throws \Doctrine\ORM\OptimisticLockException
     *
     * @Route(
     *     "/create",
     *     methods={"GET", "POST"},
     *     name="recipe_create",
     * )
     *  @Security("is_granted('ROLE_ADMIN')")
     */
    public function create(Request $request): Response
    {
        $recipe = new Recipe();
        $form = $this->createForm(RecipeType::class, $recipe);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $recipe->setCreationDate(new \DateTime());
            $recipe->setRating(0);
            $this->recipeService->save($recipe);
            $this->addFlash('success', 'Dodawania nowego przepisu się powiodło!');

            return $this->redirectToRoute('recipe_index');
        }

        return $this->render(
            'recipe/create.html.twig',
            ['form' => $form->createView()]
        );
    }

    /**
     * Edit action.
     *
     * @param \Symfony\Component\HttpFoundation\Request $request HTTP request
     * @param \App\Entity\Recipe                        $recipe  Recipe entity
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
     *     name="recipe_edit",
     * )
     * @Security("is_granted('ROLE_ADMIN')")
     */
    public function edit(Request $request, Recipe $recipe): Response
    {
        $form = $this->createForm(RecipeType::class, $recipe, ['method' => 'PUT']);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->recipeService->save($recipe);
            $this->addFlash('success', 'Edycja się powiodła');

            return $this->redirectToRoute('recipe_index');
        }

        return $this->render(
            'recipe/edit.html.twig',
            [
                'form' => $form->createView(),
                'recipe' => $recipe,
            ]
        );
    }

    /**
     * Delete action.
     *
     * @param \Symfony\Component\HttpFoundation\Request $request HTTP request
     * @param \App\Entity\Recipe                        $recipe  Recipe entity
     *
     * @return \Symfony\Component\HttpFoundation\Response HTTP response
     *
     * @throws \Doctrine\ORM\ORMException
     * @throws \Doctrine\ORM\OptimisticLockException
     *
     * @Route(
     *     "/{id}/delete",
     *     methods={"GET", "DELETE"},
     *     requirements={"id": "[1-9]\d*"},
     *     name="recipe_delete",
     * )
     * @Security("is_granted('ROLE_ADMIN')")
     */
    public function delete(Request $request, Recipe $recipe): Response
    {
        $form = $this->createForm(RecipeType::class, $recipe, ['method' => 'DELETE']);
        $form->handleRequest($request);

        if ($request->isMethod('DELETE') && !$form->isSubmitted()) {
            $form->submit($request->request->get($form->getName()));
        }

        if ($form->isSubmitted() && $form->isValid()) {
            $this->recipeService->delete($recipe);
            $this->addFlash('success', 'Usuwanie się powiodło');

            return $this->redirectToRoute('recipe_index');
        }

        return $this->render(
            'recipe/delete.html.twig',
            [
                'form' => $form->createView(),
                'recipe' => $recipe,
            ]
        );
    }
}
