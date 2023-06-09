<?php
declare(strict_types=1);

namespace App\Database;

use App\Entity\Order;

class OrderTable
{
    private \PDO $connection;

    public function __construct(\PDO $connection)
    {
        $this->connection = $connection;
    }

    // Извлекает из БД данные поста с указанным ID.
    // Возвращает null, если пост не найден
    public function find(int $orderId): ?Order
    {
        $query = <<<SQL
        SELECT
            order_id,
            name,
            composition,
            price,
            img_path
        FROM `order`
        WHERE order_id = $orderId
        SQL;

        $statement = $this->connection->query($query);
        if ($row = $statement->fetch(\PDO::FETCH_ASSOC))
        {
            return $this->createOrderFromRow($row);
        }

        return null;
    }

    // Сохраняет юзера в таблицу user, возвращает ID юзера.
    public function add(Order $order): int
    {
        $query = <<<SQL
        INSERT INTO `order` (name, composition, price, img_path)
        VALUES (:name, :composition, :ptice, :img_path)
        SQL;

        $statement = $this->connection->prepare($query);
        $statement->execute([
            ':name' => $order->getName(),
            ':composition' => $order->getComposition(),
            ':price' => $order->getPrice(),
            ':img_path' => $order->getImgPath()
        ]);

        return (int)$this->connection->lastInsertId();
    }

    public function delete(int $orderId): void
    {
        $query = <<<SQL
        DELETE FROM `order` WHERE order_id = :order_id
        SQL;

        $statement = $this->connection->prepare($query);
        $statement->execute([
            ':order_id' => $orderId
        ]);
    }

    /**
     * @return Order[]
     */
    public function list(): array
    {
        $query = <<<SQL
        SELECT
            order_id,
            name,
            composition,
            price,
            img_path
        FROM `order`
        SQL;

        $statement = $this->connection->query($query);

        $orders = [];
        while ($row = $statement->fetch(\PDO::FETCH_ASSOC))
        {
            $orders[] = $this->createOrderFromRow($row);
        }

        return $orders;
    }

    private function createOrderFromRow(array $row): Order
    {
        return new Order(
            (int)$row['order_id'],
            $row['name'],
            $row['composition'],
            $row['price'],
            $row['img_path']
        );
    }
}
