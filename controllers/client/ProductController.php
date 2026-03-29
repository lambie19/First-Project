<?php

class ProductController
{
    private $modelProduct;

    public function __construct() {
        $this->modelProduct = new Product();
    }

    // Danh sách sản phẩm
    public function index() {
        $view  = 'product/index';
        $title = 'Danh sách sản phẩm';
        $data  = $this->modelProduct->getAll();
        require_once PATH_VIEW_MAIN_CLIENT;
    }

    // Chi tiết sản phẩm
    public function show() {
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
        $view  = 'product/show';
        $title = $product['name'];
        require_once PATH_VIEW_MAIN_CLIENT;
    }
}
