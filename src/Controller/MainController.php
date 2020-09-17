<?php

namespace App\Controller;

use App\Repository\LinkRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\Routing\Annotation\Route;

class MainController extends AbstractController
{
    /**
     * @var LinkRepository
     */
    private $linkRepository;

    public function __construct(LinkRepository $linkRepository)
    {

        $this->linkRepository = $linkRepository;
    }

    /**
     * @Route("/", methods={"GET"}, name="main")
     */
    public function index()
    {
        return $this->render('main/index.html.twig', []);
    }

    /**
     * @Route(
     *     "/{code}",
     *     methods={"GET"},
     *     condition="request.getPathInfo() matches '#^(/)((?!api).)(/(.)+)*#'",
     *     name="redirect-to"
     * )
     * @param $code
     * @return RedirectResponse
     */
    public function redirectTo($code)
    {
        $link = $this->linkRepository->findOneBy([
            'shortKey' => $code,
        ]);
        if ($link) {
            return $this->redirect($link->getSourceUrl());
        } else {
            return $this->redirect('/');
        }
    }
}
