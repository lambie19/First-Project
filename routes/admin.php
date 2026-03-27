<?php
// Kiểm tra login có quyền vào trang admin không
// TODO
$action = $_GET['action'] ?? '/';

match ($action) {
    '/'         => (new ProductController)->home(),

    // CRUD Product
    'list-product' => (new ProductController)->index(), 
    'delete-product' => (new ProductController)->delete(), 
    'show-product' => (new ProductController)->show(), 
    'create-product' => (new ProductController)->create(), 
    'store-product' => (new ProductController)->store(), 
    'edit-product'=> (new ProductController)->edit(), 
    'update-product'=> (new ProductController)->update(), 

    // DANH MỤC 
    'list-category'   => (new CategoryController)->index(),
    'create-category' => (new CategoryController)->create(), 
    'store-category'  => (new CategoryController)->store(),  
    'edit-category'   => (new CategoryController)->edit(),   
    'update-category' => (new CategoryController)->update(), 
    'delete-category' => (new CategoryController)->delete(), 

    // NGƯỜI DÙNG 
    'list-user'       => (new UserController)->index(),
    'edit-user'       => (new UserController)->edit(),
    'update-user'       => (new UserController)->update(),
    'lock-user'       => (new UserController)->lock(),
    'unlock-user'       => (new UserController)->unlock(),
    
    //  BÌNH LUẬN 
    'list-comment'    => (new CommentController)->index(),
};