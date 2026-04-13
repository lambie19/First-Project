<?php
$action = $_GET['action'] ?? '/';

match ($action) {
    '/'         => (new ProductController)->home(),

    // CRUD Product — không có delete, thay bằng toggle-status
    'list-product'        => (new ProductController)->index(),
    'show-product'        => (new ProductController)->show(),
    'create-product'      => (new ProductController)->create(),
    'store-product'       => (new ProductController)->store(),
    'edit-product'        => (new ProductController)->edit(),
    'update-product'      => (new ProductController)->update(),
    'toggle-product'      => (new ProductController)->toggleStatus(),   // ← disable/enable

    // DANH MỤC — không có delete, thay bằng toggle-status
    'list-category'       => (new CategoryController)->index(),
    'create-category'     => (new CategoryController)->create(),
    'store-category'      => (new CategoryController)->store(),
    'edit-category'       => (new CategoryController)->edit(),
    'update-category'     => (new CategoryController)->update(),
    'toggle-category'     => (new CategoryController)->toggleStatus(),  // ← disable/enable

    // NGƯỜI DÙNG — chỉ xem + khóa/mở, không edit
    'list-user'           => (new UserController)->index(),
    'show-user'           => (new UserController)->show(),              // ← xem chi tiết
    'lock-user'           => (new UserController)->lock(),
    'unlock-user'         => (new UserController)->unlock(),

    // BÌNH LUẬN
    'list-comment'        => (new CommentController)->index(),
    'update-comment'      => (new CommentController)->updateStatus(),
    'delete-comment'      => (new CommentController)->destroy(),

    // ĐƠN HÀNG — không xóa được nếu đã hoàn thành
    'list-order'          => (new AdminOrderController)->index(),
    'show-order'          => (new AdminOrderController)->show(),
    'update-order-status' => (new AdminOrderController)->updateStatus(),
    'delete-order'        => (new AdminOrderController)->delete(),
};
