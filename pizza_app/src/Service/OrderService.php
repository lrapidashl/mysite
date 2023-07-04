<?php
declare(strict_types=1);

namespace App\Service;

use App\Entity\Order;
use App\Service\Data\OrderData;
use App\Repository\OrderRepository;
use App\Repository\UserRepository;

class OrderService
{
    private OrderRepository $orderRepository;
    private UserRepository $userRepository;

    public function __construct(OrderRepository $orderRepository, UserRepository $userRepository)
    {
        $this->orderRepository = $orderRepository;
        $this->userRepository = $userRepository;
    }

    public function createOrder(string $name, string $composition, string $price, string $imagePath, int $author): int
    {
        $order = new Order(
            null,
            $name,
            $composition,
            $price,
            $imagePath,
            $author,
        );
        return $this->orderRepository->store($order);
    }

    public function getOrder(int $orderId): ?OrderData
    {
        $order = $this->orderRepository->findById($orderId);
        $author = $order->getAuthor();
        if ($author !== null)
        {
            $user = $this->userRepository->findById($author);
        }

        return ($order === null) ? null : new OrderData(
            $order->getOrderId(),
            $order->getName(),
            $order->getComposition(),
            $order->getPrice(),
            $order->getImgPath(),
            $order->getAuthor(),
        );
    }

    public function deleteOrder(int $orderId): void
    {
        $order = $this->orderRepository->findById($orderId);
        if ($order === null)
        {
            return;
        }

        $this->orderRepository->delete($order);
    }

    public function listOrders(): array
    {
        $orders = $this->orderRepository->listOrders();
        $userIds = [];
        foreach ($orders as $order)
        {
            if ($order->getAuthor() !== null)
            {
                $userIds[] = $order->getAuthor();
            }
        }
        $users = $this->userRepository->listUsers($userIds);
        $usersMap = [];
        foreach ($users as $user)
        {
            $usersMap[$user->getUserId()] = $user;
        }


        $ordersView = [];
        foreach ($orders as $order)
        {
            $user = $usersMap[$order->getAuthor()] ?? null;
            $ordersView[] = new OrderData(
                $order->getOrderId(),
                $order->getName(),
                $order->getComposition(),
                $order->getPrice(),
                $order->getImgPath(),
                $order->getAuthor(),
            );
        }

        return  $ordersView;
    }
}