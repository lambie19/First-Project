<div class="row justify-content-center">
    <div class="col-md-6">
        <div class="card">
            <div class="card-header">Đăng nhập</div>
            <div class="card-body">
                
                <?php if (isset($error)) : ?>
                    <div class="alert alert-danger"><?= $error ?></div>
                <?php endif; ?>
                
                <?php if (isset($_SESSION['success_message'])) : ?>
                    <div class="alert alert-success"><?= $_SESSION['success_message'] ?></div>
                    <?php unset($_SESSION['success_message']); ?>
                <?php endif; ?>

                <form action="<?= BASE_URL ?>?action=handle-login" method="POST">
                    <div class="mb-3">
                        <label for="username" class="form-label">Tên đăng nhập:</label>
                        <input type="text" class="form-control" id="username" name="username" required>
                    </div>
                    <div class="mb-3">
                        <label for="password" class="form-label">Mật khẩu:</label>
                        <input type="password" class="form-control" id="password" name="password" required>
                    </div>
                    <button type="submit" class="btn btn-primary">Đăng nhập</button>
                    <a href="<?= BASE_URL ?>?action=register" class="btn btn-link">Chưa có tài khoản? Đăng ký ngay</a>
                </form>
            </div>
        </div>
    </div>
</div>