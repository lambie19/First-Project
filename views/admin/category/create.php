<div class="card card-primary">
    <form action="<?= BASE_URL_ADMIN . '&action=store-category' ?>" method="POST">
        <div class="card-body">
            <div class="form-group">
                <label for="name">Tên danh mục</label>
                <input type="text" name="name" class="form-control" id="name" placeholder="Nhập tên danh mục">
            </div>
            <div class="form-group">
                <label for="description">Mô tả danh mục</label>
                <textarea name="description" class="form-control" id="description" rows="3" placeholder="Nhập mô tả danh mục (tùy chọn)"></textarea>
            </div>
            </div>
        <div class="card-footer">
            <button type="submit" class="btn btn-primary">Lưu</button>
        </div>
    </form>
</div>