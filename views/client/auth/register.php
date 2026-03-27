<div class="row justify-content-center">
    <div class="col-md-6">
        <div class="card">
            <div class="card-header">Đăng ký tài khoản</div>
            <div class="card-body">
                
                <?php if (isset($error)) : ?>
                    <div class="alert alert-danger"><?= $error ?></div>
                <?php endif; ?>
                
                <form action="<?= BASE_URL ?>?action=handle-register" method="POST">
                    <div class="mb-3">
                        <label for="username" class="form-label">Tên đăng nhập:</label>
                        <input type="text" class="form-control" id="username" name="username" required>
                    </div>
                    <div class="mb-3">
                        <label for="email" class="form-label">Email:</label>
                        <input type="email" class="form-control" id="email" name="email" required>
                    </div>
                    <div class="mb-3">
                        <label for="password" class="form-label">Mật khẩu:</label>
                        <input type="password" class="form-control" id="password" name="password" required>
                    </div>
                    <div class="mb-3">
                        <label for="password_confirm" class="form-label">Xác nhận mật khẩu:</label>
                        <input type="password" class="form-control" id="password_confirm" name="password_confirm" required>
                    </div>
                    <button type="submit" class="btn btn-primary">Đăng ký</button>
                    <a href="<?= BASE_URL ?>?action=login" class="btn btn-link">Đã có tài khoản? Đăng nhập</a>
                </form>
            </div>
        </div>
    </div>
</div>