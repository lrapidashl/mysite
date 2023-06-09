<?php
declare(strict_types=1);

namespace App\Controller;

use App\Entity\User;
use App\Repository\UserRepository;
use App\View\PhpTemplateEngine;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class UserController extends AbstractController
{
    private UserRepository $userRepository;

    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function index(): Response
    {
        return $this->render('auth/sign_in.html.twig');
    }

    public function signUp(): Response
    {
        return $this->render('auth/sign_up.html.twig');
    }

    public function createUser(Request $request): Response
    {
        $user = new User(
            null,
            $request->get('first_name'),
            $request->get('second_name'),
            $request->get('email'),
            $request->get('phone')
        );
        $userId = $this->userRepository->store($user);

        return $this->redirectToRoute('index', [], Response::HTTP_SEE_OTHER);
    }

    public function viewUser(int $userId): Response
    {
        $user = $this->userRepository->findById($userId);
        if (!$user)
        {
            throw $this->createNotFoundException();
        }

        $contents = PhpTemplateEngine::render('user.php', [
            'user' => $user
        ]);
        return new Response($contents);
    }

    public function deleteUser(int $userId): Response
    {
        $user = $this->userRepository->findById($userId);
        if (!$user)
        {
            throw $this->createNotFoundException();
        }

        $this->userRepository->delete($userId);

        return $this->redirectToRoute('index');
    }

    public function listUsers(): Response
    {
        $users = $this->userRepository->listAll();

        $usersView = [];

        foreach ($users as $user)
        {
            $usersView[] = [
                'user_id' => $user->getUserId(),
                'first_name' => $user->getFirstName(),
                'second_name' => $user->getSecondName(),
                'email' => $user->getEmail(),
                'phone' => $user->getPhone(),
            ];
        }

        return $this->render('user/list.html.twig', [
            'users_list' => $usersView
        ]);
    }
}