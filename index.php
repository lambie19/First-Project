<?php 

session_start();

require_once './configs/env.php';
require_once './configs/helper.php';

require_once PATH_MODEL . 'BaseModel.php';

spl_autoload_register(function ($class) {    
    $fileName = "$class.php";

    $fileModel              = PATH_MODEL . $fileName;
    $fileControllerAdmin    = PATH_CONTROLLER_ADMIN . $fileName;
    $fileControllerClient   = PATH_CONTROLLER_CLIENT . $fileName;

    
    
    // 1. Kiểm tra Model 
    if (is_readable($fileModel)) {
        require_once $fileModel;
        return; 
    } 
    
    // 2. Kiểm tra Controller Admin
    if (is_readable($fileControllerAdmin)) {
        require_once $fileControllerAdmin;
        return;
    }
    
    // 3. Kiểm tra Controller Client
    if (is_readable($fileControllerClient)) {
        require_once $fileControllerClient;
        return;
    }
    
});



// Điều hướng
$mode = $_GET['mode'] ?? 'client';
if ($mode == 'admin') {
    // require đường dẫn của admin
    require_once './routes/admin.php';
} else {
    // require đường dẫn của client
    require_once './routes/client.php';
}
