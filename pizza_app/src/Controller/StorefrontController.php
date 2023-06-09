<?php
declare(strict_types=1);

namespace App\Controller;

use App\Entity\Order;
use App\Repository\OrderRepository;
use App\View\PhpTemplateEngine;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class StorefrontController extends AbstractController
{
    private OrderRepository $orderRepository;

    public function __construct(OrderRepository $orderRepository)
    {
        $this->orderRepository = $orderRepository;
    }
    public function index(): Response
    {
        $orders = $this->orderRepository->listAll();

        $ordersView = [];

        foreach ($orders as $order) {
            $ordersView[] = [
                'order_id' => $order->getOrderId(),
                'name' => $order->getName(),
                'composition' => $order->getComposition(),
                'price' => (string)$order->getPrice(),
                'img_path' => $order->getImgPath(),
            ];
        }
        return $this->render('store/catalog.html.twig', [
            'orders_list' => $ordersView
        ]);
    }

    public function viewOrder(int $orderId): Response
    {
        $order = $this->orderRepository->findById($orderId);
        if (!$order)
        {
            throw $this->createNotFoundException();
        }

        $orderView = [
            'order_id' => $order->getOrderId(),
            'name' => $order->getName(),
            'composition' => $order->getComposition(),
            'price' => (string)$order->getPrice(),
            'img_path' => $order->getImgPath(),
        ];

        return $this->render('store/order.html.twig', [
            'order' => $orderView
        ]);
    }
}
