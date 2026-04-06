<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

<style>
    
    .header-top { background-color: #fff; padding: 15px 0; }
    .search-bar-custom { background-color: #f5f5f5; border-radius: 50px; padding: 5px 20px; display: flex; align-items: center; }
    .search-bar-custom input { border: none; background: transparent; width: 100%; outline: none; font-size: 14px; }
    .search-bar-custom button { border: none; background: transparent; color: #666; }
    .delivery-btn { background-color: #f0fdf4; color: #0d6efd; border: 1px solid #cff4fc; border-radius: 30px; padding: 8px 20px; font-size: 14px; font-weight: 600; display: inline-flex; align-items: center; text-decoration: none; }
    .main-nav { border-top: 1px solid #eee; border-bottom: 1px solid #eee; }
    .nav-link { color: #555 !important; font-weight: 600; text-transform: uppercase; font-size: 14px; padding: 15px 20px !important; }
    .nav-link:hover { color: #0d6efd !important; }

    
    .card-img-top {
        height: 250px; 
        object-fit: cover; 
        width: 100%; 
    }
</style>

<header>
    <div class="container header-top">
        <div class="row align-items-center">
            <div class="col-md-2">
                <a href="index.php">
                    <img src="../assets/uploads/logo3.png" alt="Logo" style="height: 150px;"> </a>
            </div>
            <div class="col-md-5">
                <form action="index.php" method="GET">
                    <div class="search-bar-custom">
                        <button type="submit"><i class="fas fa-search"></i></button>
                        <input type="text" name="keyword" placeholder="Bạn muốn mua gì hôm nay?">
                    </div>
                </form>
            </div>
            <div class="col-md-5 d-flex justify-content-end align-items-center">
                <a href="#" class="delivery-btn me-3"><i class="fas fa-motorcycle"></i> Giao hàng</a>
                <a href="#" class="text-dark me-3 fs-5"><i class="far fa-envelope"></i></a>
                <?php if(isset($_SESSION['user'])): ?>
                    <div class="dropdown">
                        <a href="#" class="text-dark d-flex align-items-center text-decoration-none dropdown-toggle" data-bs-toggle="dropdown">
                            <i class="far fa-user-circle fs-4 me-1"></i> <span class="small fw-bold">Chào, <?= $_SESSION['user']['name'] ?? 'Bạn' ?></span>
                        </a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item text-danger" href=""></a></li>
                        </ul>
                    </div>
                <?php else: ?>
                    <span class="text-dark fs-4" style="cursor: default;" title="Tài khoản">
                    <i class="far fa-user-circle"></i>
                    </span>
                <?php endif; ?>
            </div>
        </div>
    </div>
    <div class="main-nav bg-white sticky-top">
        <div class="container">
            <nav class="navbar navbar-expand-lg navbar-light p-0">
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse justify-content-center" id="navbarNav">
                    <ul class="navbar-nav">
                        <li class="nav-item"><a class="nav-link" href="index.php">Trang chủ</a></li>
                        <li class="nav-item"><a class="nav-link" href="#">Menu</a></li>
                        <li class="nav-item"><a class="nav-link" href="#">Sản phẩm</a></li>
                        <li class="nav-item"><a class="nav-link" href="#">Về chúng tôi</a></li>
                        <li class="nav-item"><a class="nav-link" href="#">Khuyến mãi</a></li>
                    </ul>
                </div>
            </nav>
        </div>
    </div>
</header>

<div id="carouselExampleIndicators" class="carousel slide" data-bs-ride="carousel">
    <div class="carousel-indicators">
        <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
        <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1" aria-label="Slide 2"></button>
        <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="2" aria-label="Slide 3"></button>
    </div>
    <div class="carousel-inner">
        <div class="carousel-item active">
            <img src="../assets/uploads/banner5.png" class="d-block w-100" alt="...">
        </div>
        <div class="carousel-item">
            <img src="../assets/uploads/banner6.png" class="d-block w-100" alt="...">
        </div>
        <div class="carousel-item">
            <img src="../assets/uploads/banner7.png" class="d-block w-100" alt="...">
        </div>
    </div>
    <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Previous</span>
    </button>
    <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Next</span>
    </button>
</div>

<div class="container-fluid"> <div class="row mb-4 pt-3">
        <div class="col-12">
            <h4 class="mb-2">Lọc theo Danh mục</h4>
            
            <a href="<?= BASE_URL ?>" class="btn btn-primary btn-sm me-2">Tất cả</a>
            
            <?php 
            if (isset($categories) && is_array($categories)) : 
            ?>
                <?php foreach($categories as $cat) : ?>
                    <?php 
                        $isActive = ($_GET['category_id'] ?? null) == $cat['id'];
                    ?>
                    <a href="<?= BASE_URL ?>?category_id=<?= $cat['id'] ?>" 
                    class="btn btn-<?= $isActive ? 'info' : 'outline-secondary' ?> btn-sm me-2">
                        <?= $cat['name'] ?>
                    </a>
                <?php endforeach; ?>
            <?php endif; ?>
        </div>
    </div>

    <?php 
    //hiển thị kết quả lọc
    if (isset($filteredProducts) && !empty($filteredProducts)) : 
    ?>

        <h3 class="mt-3">Kết quả lọc</h3>
        <div class="row">
            <?php foreach($filteredProducts as $pro) : ?>
                <div class="col-3">
                    <div class="border rounded mb-4">
                        <div class="bg-light d-flex justify-content-center align-items-center" style="height: 400px;">
                            <img src="<?= BASE_ASSETS_UPLOADS . $pro["image"] ?>" alt="" class="mw-100 mh-100">
                        </div>
                        <div class="p-2 d-flex align-items-center justify-content-around">
                            <div>
                                <a href="<?= BASE_URL . '?action=detail-product&id=' . $pro["id"] ?>"><h5><?= $pro["name"] ?></h5></a>
                                <span class="fw-bold"> <?= number_format($pro["price"]) ?> đ</span>
                                <p class="text-muted small mb-0">Lượt xem: <?= $pro["view_count"] ?? 0 ?></p> 
                            </div>
                            <button class="btn btn-danger">Mua ngay</button>
                        </div>
                    </div>
                </div>
                <?php endforeach; ?>
        </div>

    <?php else : ?>

        <h3 class="mt-3">Sản phẩm mới</h3>
        <div class="row" id="product-list">
            <?php foreach($top4Lastest as $key => $pro) : 
            $hiddenClass = ($key >= 4) ? 'd-none' : ''; 
        ?>
            <div class="col-3 product-item <?= $hiddenClass ?>">
                <div class="border rounded mb-4">
                    <div class="bg-light d-flex justify-content-center align-items-center" style="height: 400px;">
                        <img src="<?= BASE_ASSETS_UPLOADS . $pro["image"] ?>" alt="" class="mw-100 mh-100">
                    </div>
                    <div class="p-2 d-flex align-items-center justify-content-around">
                        <div>
                            <a href="<?= BASE_URL . '?action=detail-product&id=' . $pro["id"] ?>"><h5><?= $pro["name"] ?></h5></a>
                            <span class="fw-bold"> <?= number_format($pro["price"]) ?> đ </span> <p class="text-muted small mb-0">Lượt xem: <?= $pro["view_count"] ?? 0 ?></p> 
                        </div>
                        <button class="btn btn-danger">Mua ngay</button>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>

    <?php if(count($top4Lastest) > 4): ?>
    <div class="row mt-3 text-center">
        <div class="col-12">
            <button id="btn-load-more" class="btn btn-outline-success px-4 py-2" style="border-radius: 0;">
                Xem thêm 4 sản phẩm <b>SẢN PHẨM MỚI</b> <i class="fa fa-angle-down"></i>
            </button>
        </div>
    </div>
    <?php endif; ?>

        <h3 class="mt-3">Sản phẩm được yêu thích nhất</h3>
        <div class="row">
            <?php 
            foreach($top4View as $pro) : 
            ?> 
                <div class="col-3">
                    <div class="border rounded mb-4">
                        <div class="bg-light d-flex justify-content-center align-items-center" style="height: 400px;">
                            <img src="<?= BASE_ASSETS_UPLOADS . $pro["image"] ?>" alt="" class="mw-100 mh-100">
                        </div>
                        <div class="p-2 d-flex align-items-center justify-content-around">
                            <div>
                                <a href="<?= BASE_URL . '?action=detail-product&id=' . $pro["id"] ?>"><h5><?= $pro["name"] ?></h5></a>
                                <span class="fw-bold"> <?= number_format($pro["price"]) ?> đ</span>
                                <p class="text-muted small mb-0">Lượt xem: <?= $pro["view_count"] ?? 0 ?></p> 
                            </div>
                            <button class="btn btn-danger">Mua ngay</button>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>

        <div class="row mt-5">
            <div class="col-12">
                <h3 class="mb-3" style="color: #000000ff;">TIN TỨC & KHUYẾN MÃI</h3>
            </div>
        </div>

        <div class="row">
            <div class="col-md-4 mb-4">
                <div class="card h-100 border-0 shadow-sm">
                    <img src="https://cms.piklab.vn/resources/Tai%20nguyen%20Piklab/File%20design%20TMDT/piklab1800.jpg" class="card-img-top" alt="Tin tuc">
                    <div class="card-body">
                        <h5 class="card-title"><a href="#" class="text-decoration-none text-dark">Mùa hè rực rỡ - Giảm giá 50%</a></h5>
                        <p class="card-text text-muted small">17/12/2025</p>
                        <p class="card-text">Đón chào mùa hè sôi động với chương trình khuyến mãi cực lớn...</p>
                        <a href="#" class="btn btn-outline-primary btn-sm">Xem chi tiết</a>
                    </div>
                </div>
            </div>
            <div class="col-md-4 mb-4">
                <div class="card h-100 border-0 shadow-sm">
                    <img src="https://cdn2.fptshop.com.vn/unsafe/Uploads/images/tin-tuc/178058/Originals/poster-tra-sua-7.jpg" class="card-img-top" alt="Tin tuc">
                    <div class="card-body">
                        <h5 class="card-title"><a href="#" class="text-decoration-none text-dark">Ra mắt BST nhài sữa Lục Vân</a></h5>
                        <p class="card-text text-muted small">16/12/2025</p>
                        <p class="card-text">Hương vị độc đáo, vẻ ngoài cuốn hút. Thử ngay món mới...</p>
                        <a href="#" class="btn btn-outline-primary btn-sm">Xem chi tiết</a>
                    </div>
                </div>
            </div>
            <div class="col-md-4 mb-4">
                <div class="card h-100 border-0 shadow-sm">
                    <img src="https://marketplace.canva.com/EAGYVlNB0Yg/3/0/1600w/canva-b%C3%A0i-%C4%91%C4%83ng-instagram-th%C3%B4ng-b%C3%A1o-l%E1%BB%8Bch-ngh%E1%BB%89-t%E1%BA%BFt-2026-cao-c%E1%BA%A5p-t%E1%BB%91i-gi%E1%BA%A3n-%C4%91%E1%BB%8F-v%C3%A0ng-SbP8iZ37fg4.jpg" class="card-img-top" alt="Tin tuc">
                    <div class="card-body">
                        <h5 class="card-title"><a href="#" class="text-decoration-none text-dark">Lịch nghỉ Tết Nguyên Đán 2026</a></h5>
                        <p class="card-text text-muted small">15/12/2025</p>
                        <p class="card-text">Thông báo lịch hoạt động của các cửa hàng trong dịp lễ...</p>
                        <a href="#" class="btn btn-outline-primary btn-sm">Xem chi tiết</a>
                    </div>
                </div>
            </div>
        </div>
        <?php endif; ?>
</div> <footer class="text-white pt-5 pb-4" style="background-color: #dee2e5ff; margin-top: 50px;">
    <div class="container text-md-left">
        <div class="row text-md-left">
            <div class="col-md-4 col-lg-4 col-xl-4 mx-auto mt-3">
                <h5 class="text-uppercase mb-4 font-weight-bold text-warning">Địa chỉ liên hệ</h5>
                <p><i class="fas fa-home mr-3"></i> Tòa nhà FPT Polytechnic, Hà Nội</p>
                <p><i class="fas fa-envelope mr-3"></i> contact@webbanhang.com</p>
                <p><i class="fas fa-phone mr-3"></i> + 84 234 567 88</p>
            </div>
            <div class="col-md-2 col-lg-2 col-xl-2 mx-auto mt-3">
                <h5 class="text-uppercase mb-4 font-weight-bold text-warning">Về chúng tôi</h5>
                <p><a href="#" class="text-white" style="text-decoration: none;">Giới thiệu</a></p>
                <p><a href="#" class="text-white" style="text-decoration: none;">Tuyển dụng</a></p>
            </div>
            <div class="col-md-3 col-lg-2 col-xl-2 mx-auto mt-3">
                <h5 class="text-uppercase mb-4 font-weight-bold text-warning">Chính sách</h5>
                <p><a href="#" class="text-white" style="text-decoration: none;">Bảo mật</a></p>
                <p><a href="#" class="text-white" style="text-decoration: none;">Giao hàng</a></p>
            </div>
            <div class="col-md-3 col-lg-3 col-xl-3 mx-auto mt-3">
                <h5 class="text-uppercase mb-4 font-weight-bold text-warning">Kết nối</h5>
                <div>
                    <a href="#" class="btn btn-outline-light btn-floating m-1"><i class="fab fa-facebook-f"></i></a>
                    <a href="#" class="btn btn-outline-light btn-floating m-1"><i class="fab fa-google"></i></a>
                </div>
            </div>
        </div>
    </div>
    <div class="text-center p-3 mt-4" style="background-color: #0a58ca;">
        © 2025 Copyright: <a class="text-white" href="#" style="text-decoration: none;"><strong>Đỗ Danh Hoàng sinh viên FPT Poly</strong></a>
    </div>
</footer>

<script>
    document.getElementById('btn-load-more').addEventListener('click', function() {
        const hiddenProducts = document.querySelectorAll('.product-item.d-none');
        let count = 0;
        hiddenProducts.forEach(function(item) {
            if (count < 4) { 
                item.classList.remove('d-none'); 
                item.classList.add('animate__animated', 'animate__fadeIn'); 
                count++;
            }
        });
        if (document.querySelectorAll('.product-item.d-none').length === 0) {
            this.style.display = 'none';
        }
    });
</script>