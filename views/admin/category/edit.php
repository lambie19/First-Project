<div class="card card-warning">
    <div class="card-header">
        <h3 class="card-title"><?= $title ?></h3>
    </div>
    <form action="<?= BASE_URL_ADMIN . '&action=update-category&id=' . $data['id'] ?>" method="POST">
        <div class="card-body">
            <div class="form-group">
                <label for="name">ID</label>
                <input type="text" class="form-control" value="<?= $data['id'] ?>" disabled>
            </div>
            <div class="form-group">
                <label for="name">Tên danh mục</label>
                <input type="text" name="name" class="form-control" id="name" value="<?= $data['name'] ?>" placeholder="Nhập tên danh mục">
            </div>
        </div>
        <div class="card-footer">
            <button type="submit" class="btn btn-warning">Cập nhật</button>
        </div>
    </form>
</div>