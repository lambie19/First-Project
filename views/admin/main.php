<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title><?= $title ?? 'Admin Dashboard' ?></title> 
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    
    <style>
        .sidebar {
            height: 100vh;
            position: fixed;
            top: 0;
            left: 0;
            width: 250px; 
            padding-top: 56px; 
            background-color: #343a40; 
        }
        .sidebar a {
            padding: 10px 15px;
            text-decoration: none;
            font-size: 1.1em;
            color: #f8f9fa;
            display: block;
        }
        .sidebar a:hover {
            background-color: #495057;
        }
        .content {
            margin-left: 250px;
            padding: 20px;
            padding-top: 70px ;
        }
    </style>
</head>

<body>

    <nav class="navbar navbar-expand-xxl navbar-dark bg-dark fixed-top justify-content-center">
        <a class="navbar-brand ms-3" href="<?= BASE_URL_ADMIN ?>">Admin Dashboard</a>
        <ul class="navbar-nav ms-auto">
            <li class="nav-item">
                <span class="nav-link text-warning">Xin chào, Admin (<?= $_SESSION['user_name'] ?? 'Guest' ?>)</span>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="<?= BASE_URL ?>?action=logout">Đăng xuất</a>
            </li>
        </ul>
    </nav>
    
    <div class="container-fluid">
        <div class="row">
            
            <nav id="sidebar" class="col-md-3 col-lg-2 d-md-block sidebar">
                <div class="position-sticky pt-3">
                    <ul class="nav flex-column">
                        
                        <li class="nav-item">
                            <a class="nav-link active" href="<?= BASE_URL_ADMIN ?>">
                                <i class="fas fa-tachometer-alt me-2"></i> Dashboard
                            </a>
                        </li>
                        
                        <li class="nav-item">
                            <a class="nav-link" href="<?= BASE_URL_ADMIN ?>&action=list-category">
                                <i class="fas fa-list me-2"></i> Danh mục
                            </a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link" href="<?= BASE_URL_ADMIN ?>&action=list-product">
                                <i class="fas fa-boxes me-2"></i> Sản phẩm
                            </a>
                        </li>
                        
                        <li class="nav-item">
                            <a class="nav-link" href="<?= BASE_URL_ADMIN ?>&action=list-user">
                                <i class="fas fa-users me-2"></i> Người dùng
                            </a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link" href="<?= BASE_URL_ADMIN ?>&action=list-comment">
                                <i class="fas fa-comments me-2"></i> Bình luận
                            </a>
                        </li>
                        
                        <li class="nav-item mt-3 border-top">
                            <a class="nav-link" href="<?= BASE_URL ?>">
                                <i class="fas fa-external-link-alt me-2"></i> Xem Trang Chủ
                            </a>
                        </li>
                        
                    </ul>
                </div>
            </nav>

            <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4 content">
                <h1 class="mt-3 mb-3"><?= $title ?? 'Admin Dashboard' ?></h1> 

                <?php 
                if (isset($view)) {
                    require_once PATH_VIEW_ADMIN . $view . '.php'; 
                    
                } else {
                    echo '<div class="alert alert-info">Chào mừng đến trang Quản trị!</div>';
                }
                ?>
                
            </main>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>