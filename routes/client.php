<?php

$action = $_GET['action'] ?? '/';

match ($action) {
    '/'         => (new HomeController)->index(),
    'detail-product' => (new DetailProductController)->show(),
    // Bình luận    
    'list-comment'      => (new CommentController)->index(),
    'store-comment'     => (new DetailProductController)->storeComment(),
    'update-comment'    => (new CommentController)->updateStatus(),
    'delete-comment'    => (new CommentController)->destroy(),


    //đăng nhập/đăng kí
    'login'             => (new AuthController)->loginForm(),
    'handle-login'      => (new AuthController)->loginProcess(),
    'register'          => (new AuthController)->registerForm(),
    'handle-register'   => (new AuthController)->registerProcess(),
    'logout'            => (new AuthController)->logout(),

    // Đặt hàng
    'order-create'      => (new ClientOrderController)->create(),
    'order-store'       => (new ClientOrderController)->store(),
    'order-success'     => (new ClientOrderController)->success(),

    // ── Giỏ hàng ──────────────────────────────────────────────────────
    'cart'              => (new CartController)->index(),   // Xem giỏ hàng
    'cart-add'          => (new CartController)->add(),     // Thêm sản phẩm
    'cart-update'       => (new CartController)->update(),  // Cập nhật số lượng
    'cart-remove'       => (new CartController)->remove(),  // Xoá 1 sản phẩm
    'cart-clear'        => (new CartController)->clear(),   // Xoá tất cả
};
