<?php
/**
 * AccessDenied handler.
 */

namespace App\Security;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Security\Core\Exception\AccessDeniedException;
use Symfony\Component\Security\Http\Authorization\AccessDeniedHandlerInterface;
use Twig\Environment;

/**
 * Class AccessDeniedHandler.
 */
class AccessDeniedHandler implements AccessDeniedHandlerInterface
{
    /**
     * Twig.
     *
     * @var Environment
     */
    private $twig;

    /**
     * AccessDeniedHandler constructor.
     * @param Environment $twig
     */
    public function __construct(Environment $twig)
    {
        $this->twig = $twig;
    }

    /**
     * Handle.
     *
     *
     * @param Request               $request
     * @param AccessDeniedException $accessDeniedException
     *
     * @return Response|null
     *
     * @throws \Twig\Error\LoaderError
     * @throws \Twig\Error\RuntimeError
     * @throws \Twig\Error\SyntaxError
     *
     * @return Response|null
     */
    public function handle(Request $request, AccessDeniedException $accessDeniedException)
    {
        $content = $this->twig->render('errors/accessdenied.html.twig');


        return new Response($content, 403);
    }
}
