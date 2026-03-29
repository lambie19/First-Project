<?php

class OrderController
{
    private $modelOrder;
    private $modelProduct;

    public function __construct() {
        $this->modelOrder   = new Order();
        $this->modelProduct = new Product();
    }

    // Hiển thị form đặt hàng
    public function create() {
        $id = $_GET['id'] ?? null;
        if (!$id) {
            header('Location: ' . BASE_URL . '?action=list-product');
            exit;
        }
        $product = $this->modelProduct->find($id);
        if (!$product) {
            header('Location: ' . BASE_URL . '?action=list-product');
            exit;
        }
        $view  = 'order/create';
        $title = 'Đặt hàng: ' . $product['name'];
        require_once PATH_VIEW_MAIN_CLIENT;
    }

    // Xử lý lưu đơn hàng
    public function store() {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            header('Location: ' . BASE_URL . '?action=list-product');
            exit;
        }

        $product_id = $_POST['product_id'] ?? null;
        $quantity   = intval($_POST['quantity'] ?? 1);

        if (!$product_id || $quantity < 1) {
            header('Location: ' . BASE_URL . '?action=list-product');
            exit;
        }

        $product = $this->modelProduct->find($product_id);
        if (!$product) {
            header('Location: ' . BASE_URL . '?action=list-product');
            exit;
        }

        // Kiểm tra tồn kho
        if ($quantity > $product['quantity']) {
            $error = 'Số lượng đặt vượt quá tồn kho (' . $product['quantity'] . ' sản phẩm).';
            $view  = 'order/create';
            $title = 'Đặt hàng: ' . $product['name'];
            require_once PATH_VIEW_MAIN_CLIENT;
            exit;
        }

        $total_price = $product['price'] * $quantity;

        // Lưu đơn hàng
        $order_id = $this->modelOrder->insert([
            'customer_name'    => trim($_POST['customer_name']),
            'customer_phone'   => trim($_POST['customer_phone']),
            'customer_address' => trim($_POST['customer_address']),
            'note'             => trim($_POST['note'] ?? ''),
            'total_price'      => $total_price,
        ]);

        // Lưu chi tiết đơn hàng
        $this->modelOrder->insertItem([
            'order_id'   => $order_id,
            'product_id' => $product_id,
            'quantity'   => $quantity,
            'price'      => $product['price'],
        ]);

        header('Location: ' . BASE_URL . '?action=order-success&id=' . $order_id);
        exit;
    }

    // Trang đặt hàng thành công
    public function success() {
        $id = $_GET['id'] ?? null;
        if (!$id) {
            header('Location: ' . BASE_URL);
            exit;
        }
        $order      = $this->modelOrder->find($id);
        $orderItems = $this->modelOrder->getOrderItems($id);
        $view  = 'order/success';
        $title = 'Đặt hàng thành công!';
        require_once PATH_VIEW_MAIN_CLIENT;
    }
}
