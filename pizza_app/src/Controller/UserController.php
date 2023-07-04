<?php
declare(strict_types=1);

namespace App\Controller;

use App\Controller\Input\RegisterUserInput;
use App\Service\UserService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class UserController extends AbstractController
{
    private UserService $userService;

    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    public function index(): Response
    {
        return $this->redirectToRoute('home');
    }

    public function register(Request $request): Response
    {
        $input = new RegisterUserInput();
        $form = $this->createForm(RegisterUserInput::class, $input, [
            'action' => $this->generateUrl('sign_up'),
        ]);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid())
        {
            $input = $form->getData();
            $this->userService->register($input);

            return $this->redirectToRoute('login');
        }

        return $this->render('auth/sign_up.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}