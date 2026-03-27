<div class="card">
    <div class="card-header">
        <h3 class="card-title"><?= $title ?></h3>
    </div>
    <div class="card-body">
        <form action="<?= BASE_URL_ADMIN . '&action=update-user&id=' . $data['id'] ?>" method="POST">
            <div class="form-group">
                <label for="username">Tên tài khoản</label>
                <input type="text" name="username" id="username" class="form-control" value="<?= $data['username'] ?>" required>
            </div>
            <div class="form-group mt-3">
                <label for="email">Email</label>
                <input type="email" name="email" id="email" class="form-control" value="<?= $data['email'] ?>" required>
            </div>
            
            <div class="mt-4">
                <button type="submit" class="btn btn-primary">Lưu thay đổi</button>
                <a href="<?= BASE_URL_ADMIN . '&action=list-user' ?>" class="btn btn-secondary">Quay lại</a>
            </div>
        </form>
    </div>
</div>