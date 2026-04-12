<?php

class ClientOrderController
{
    private $modelOrder;
    private $modelProduct;

    public function __construct() {
        $this->modelOrder   = new Order();
        $this->modelProduct = new Product();
    }

    // Hiển thị form đặt hàng
    // Truy cập: ?action=order-create&id=<product_id>
    public function create() {
        // Bắt buộc phải đăng nhập mới được đặt hàng
        if (!isset($_SESSION['user_id'])) {
            header('Location: ' . BASE_URL . '?action=login');
            exit;
        }

        $id = $_GET['id'] ?? null;
        if (!$id) {
            header('Location: ' . BASE_URL);
            exit;
        }

        $product = $this->modelProduct->find($id);
        if (!$product) {
            header('Location: ' . BASE_URL);
            exit;
        }

        $view  = 'order/create';
        $title = 'Đặt hàng: ' . $product['name'];
        require_once PATH_VIEW_MAIN_CLIENT;
    }

    // GET ?action=order-create (không cần &id)
public function createFromCart() {
    if (!isset($_SESSION['user_id'])) {
        header('Location: ' . BASE_URL . '?action=login');
        exit;
    }

    if (empty($_SESSION['cart'])) {
        header('Location: ' . BASE_URL . '?action=cart');
        exit;
    }

    $cart  = $_SESSION['cart'];
    $total = 0;
    foreach ($cart as $item) {
        $total += $item['price'] * $item['quantity'];
    }

    $view  = 'order/create-from-cart'; // view mới cho đặt hàng từ giỏ
    $title = 'Đặt hàng';
    require_once PATH_VIEW_MAIN_CLIENT;
}

    // Xử lý lưu đơn hàng (POST)
    public function store() {
        if (!isset($_SESSION['user_id'])) {
            header('Location: ' . BASE_URL . '?action=login');
            exit;
        }

        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            header('Location: ' . BASE_URL);
            exit;
        }

        $product_id = $_POST['product_id'] ?? null;
        $quantity   = intval($_POST['quantity'] ?? 1);

        if (!$product_id || $quantity < 1) {
            header('Location: ' . BASE_URL);
            exit;
        }

        $product = $this->modelProduct->find($product_id);
        if (!$product) {
            header('Location: ' . BASE_URL);
            exit;
        }

        // Kiểm tra số lượng tồn kho
        if ($quantity > $product['quantity']) {
            $error = 'Số lượng đặt (' . $quantity . ') vượt quá tồn kho (' . $product['quantity'] . ' sản phẩm).';
            $view  = 'order/create';
            $title = 'Đặt hàng: ' . $product['name'];
            require_once PATH_VIEW_MAIN_CLIENT;
            exit;
        }

        $total_price = $product['price'] * $quantity;

        // Lưu đơn hàng vào DB
        $order_id = $this->modelOrder->insert([
            'user_id'          => $_SESSION['user_id'],
            'customer_name'    => trim($_POST['customer_name']),
            'customer_phone'   => trim($_POST['customer_phone']),
            'customer_address' => trim($_POST['customer_address']),
            'note'             => trim($_POST['note'] ?? ''),
            'total_price'      => $total_price,
        ]);

        // Lưu chi tiết sản phẩm trong đơn
        $this->modelOrder->insertItem([
            'order_id'   => $order_id,
            'product_id' => $product_id,
            'quantity'   => $quantity,
            'price'      => $product['price'],
        ]);

        // Chuyển sang trang thành công
        header('Location: ' . BASE_URL . '?action=order-success&id=' . $order_id);
        exit;
    }

    // Trang xác nhận đặt hàng thành công
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
