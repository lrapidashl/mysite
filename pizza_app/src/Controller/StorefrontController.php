<?php
declare(strict_types=1);

namespace App\Controller;

use App\Controller\Input\CreateOrderInput;
use App\Service\Data\OrderData;
use App\Service\OrderService;
use App\Service\ImageService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class StorefrontController extends AbstractController
{
    private OrderService $orderService;
    private ImageService $imageService;

    public function __construct(OrderService $orderService, ImageService $imageService)
    {
        $this->orderService = $orderService;
        $this->imageService = $imageService;
    }

    public function create(): Response
    {
        $input = new CreateOrderInput();
        $form = $this->createForm(CreateOrderInput::class, $input, [
            'action' => $this->generateUrl('add_order'),
        ]);

        return $this->render('store/create_order.html.twig', [
            'form' => $form->createView(),
        ]);
    }
    public function index(): Response
    {
        $orders = $this->orderService->listOrders();

        $ordersView = [];

        foreach ($orders as $order) {
            $ordersView[] = $order->toArray();
        }
        return $this->render('store/list.html.twig', [
            'orders_list' => $ordersView
        ]);
    }

    public function publishOrder(Request $request): Response
    {
        $input = new CreateOrderInput();
        $form = $this->createForm(CreateOrderInput::class, $input);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid())
        {
            $imageData = $form->get('image_path')->getData();
            $imagePath = null;
            if ($imageData !== null)
            {
                $imagePath = $this->imageService->moveImageToUploads($imageData);
            }

            $orderId = $this->orderService->createOrder(
                $input->getName(),
                $input->getComposition(),
                $input->getPrice(),
                $imagePath,
                $this->getUser()->getUserId()
            );

            return $this->redirectToRoute(
                'show_order',
                ['orderId' => $orderId],
                Response::HTTP_SEE_OTHER
            );
        }

        return $this->redirectToRoute('index');
    }

    public function viewOrder(int $orderId): Response
    {
        $user = $this->getUser();
        $order = $this->orderService->getOrder($orderId);

        if ($order === null)
        {
            throw $this->createNotFoundException();
        }
        return $this->render('store/order.html.twig', [
            'canRemove' => $user->isAdmin() || $user->getUserId() === $order->getAuthor(),
            'order' => $this->orderDataToArray($order)
        ]);
    }

    public function deleteOrder(int $orderId): Response
    {
        $user = $this->getUser();
        $order = $this->orderService->getOrder($orderId);
        if ($order === null)
        {
            return $this->redirectToRoute('index');
        }
        if (!$user->isAdmin() && $order->getAuthor() !== $user->getUserId())
        {
            throw $this->createAccessDeniedException();
        }
        $this->orderService->deleteOrder($orderId);

        return $this->redirectToRoute('index');
    }

    public function listOrders(): Response
    {
        $user = $this->getUser();
        $orders = $this->orderService->listOrders();

        return $this->render('store/list.html.twig', [
            'is_admin'  => $user->isAdmin(),
            'orders_list' => $this->ordersToArray($orders)
        ]);
    }

    /**
     * @param OrderData[] $orders
     * @return array
     */
    private function ordersToArray(array $orders): array
    {
        return array_map(function (OrderData $order): array {
            return $this->orderDataToArray($order);
        }, $orders);
    }

    private function orderDataToArray(OrderData $order): array
    {
        return [
            'order_id' => $order->getOrderId(),
            'name' => $order->getName(),
            'composition' => $order->getComposition(),
            'price' => $order->getPrice(),
            'image_path' => $order->getImagePath(),
        ];
    }
}
