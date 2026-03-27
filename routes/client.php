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
};