<?php

class OrderController
{
    private $modelOrder;

    public function __construct() {
        $this->modelOrder = new Order();
    }

    // Danh sách tất cả đơn hàng
    public function index() {
        $view  = 'order/index';
        $title = 'Quản lý đơn hàng';
        $data  = $this->modelOrder->getAll();
        require_once PATH_VIEW_MAIN_ADMIN;
    }

    // Chi tiết 1 đơn hàng
    public function show() {
        $id = $_GET['id'] ?? null;
        if (!$id) {
            header('Location: ?mode=admin&action=list-order');
            exit;
        }
        $order      = $this->modelOrder->find($id);
        $orderItems = $this->modelOrder->getOrderItems($id);
        $view  = 'order/show';
        $title = 'Chi tiết đơn hàng #' . $id;
        require_once PATH_VIEW_MAIN_ADMIN;
    }

    // Cập nhật trạng thái
    public function updateStatus() {
        $id     = $_GET['id'] ?? null;
        $status = $_POST['status'] ?? null;
        $allowed = ['pending', 'confirmed', 'shipping', 'completed', 'cancelled'];
        if ($id && $status && in_array($status, $allowed)) {
            $this->modelOrder->updateStatus($id, $status);
        }
        header('Location: ?mode=admin&action=show-order&id=' . $id);
        exit;
    }

    // Xóa đơn hàng
    public function delete() {
        $id = $_GET['id'] ?? null;
        if ($id) {
            $this->modelOrder->delete($id);
        }
        header('Location: ?mode=admin&action=list-order');
        exit;
    }
}
