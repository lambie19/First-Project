<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title><?= $title ?? 'Home' ?></title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>


</head>

<body>

    <nav class="navbar navbar-expand-xxl bg-light justify-content-center">
        <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link text-uppercase" href="<?= BASE_URL ?>"><b>Home</b></a>
            </li>

            <?php if (isset($_SESSION['user_id'])) : ?>
                <li class="nav-item">
                    <span class="nav-link text-success">Xin chào, <b><?= $_SESSION['user_name'] ?></b></span>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-uppercase text-danger" href="<?= BASE_URL ?>?action=logout"><b>Đăng xuất</b></a>
                </li>

            <?php else : ?>
                <li class="nav-item">
                    <a class="nav-link text-uppercase" href="<?= BASE_URL ?>?action=login"><b>Đăng nhập</b></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-uppercase" href="<?= BASE_URL ?>?action=register"><b>Đăng ký</b></a>
                </li>
            <?php endif; ?>
        </ul>
    </nav>
    <div class="container">
        <h1 class="mt-3 mb-3"><?= $title ?? 'Home' ?></h1>

        <div class="row">
            <?php
            if (isset($view)) {
                require_once PATH_VIEW_CLIENT . $view . '.php';
            }
            ?>
        </div>
    </div>

</body>

</html>