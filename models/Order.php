<?php
class Order extends BaseModel {
    protected $tableName = 'orders';

    // Lấy toàn bộ đơn hàng kèm số lượng sản phẩm
    public function getAll() {
        $sql = "
            SELECT 
                o.*,
                COUNT(oi.id) AS total_items
            FROM orders AS o
            LEFT JOIN order_items AS oi ON o.id = oi.order_id
            GROUP BY o.id
            ORDER BY o.id DESC
        ";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll();
    }

    // Lấy 1 đơn hàng theo id
    public function find($id) {
        $sql  = "SELECT * FROM orders WHERE id = :id";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute(['id' => $id]);
        return $stmt->fetch();
    }

    // Lấy danh sách sản phẩm thuộc 1 đơn hàng
    public function getOrderItems($order_id) {
        $sql = "
            SELECT 
                oi.*,
                p.name  AS product_name,
                p.image AS product_image
            FROM order_items AS oi
            JOIN products    AS p ON oi.product_id = p.id
            WHERE oi.order_id = :order_id
        ";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute(['order_id' => $order_id]);
        return $stmt->fetchAll();
    }

    // Tạo đơn hàng mới, trả về id vừa tạo
    public function insert($data) {
        $sql = "
            INSERT INTO orders
                (customer_name, customer_phone, customer_address, note, total_price, status, created_at)
            VALUES
                (:customer_name, :customer_phone, :customer_address, :note, :total_price, 'pending', NOW())
        ";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([
            'customer_name'    => $data['customer_name'],
            'customer_phone'   => $data['customer_phone'],
            'customer_address' => $data['customer_address'],
            'note'             => $data['note'] ?? '',
            'total_price'      => $data['total_price'],
        ]);
        return $this->pdo->lastInsertId();
    }

    // Thêm 1 dòng order_item
    public function insertItem($data) {
        $sql = "
            INSERT INTO order_items (order_id, product_id, quantity, price)
            VALUES (:order_id, :product_id, :quantity, :price)
        ";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([
            'order_id'   => $data['order_id'],
            'product_id' => $data['product_id'],
            'quantity'   => $data['quantity'],
            'price'      => $data['price'],
        ]);
    }

    // Cập nhật trạng thái đơn hàng
    public function updateStatus($id, $status) {
        $sql  = "UPDATE orders SET status = :status WHERE id = :id";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute(['status' => $status, 'id' => $id]);
    }

    // Xóa đơn hàng (xóa items trước do FK)
    public function delete($id) {
        $sql  = "DELETE FROM order_items WHERE order_id = :id";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute(['id' => $id]);

        $sql  = "DELETE FROM orders WHERE id = :id";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute(['id' => $id]);
    }
}
?>
