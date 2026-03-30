<?php if (!empty($_SESSION['errors'])): ?>
    <div class="alert alert-danger">
        <ul class="mb-0">
            <?php foreach ($_SESSION['errors'] as $error): ?>
                <li><?= htmlspecialchars($error) ?></li>
            <?php endforeach; ?>
        </ul>
    </div>
    <?php unset($_SESSION['errors']); ?>
<?php endif; ?>

<form action="<?= BASE_URL_ADMIN . '&action=store-product' ?>" method="POST" enctype="multipart/form-data">
    <div class="mt-3 mb-3">
        <label for="" class="form-label">Tên:</label>
        <input type="text" name="name" class="form-control"
            value="<?= htmlspecialchars($_SESSION['old']['name'] ?? '') ?>">
    </div>
    <div class="mt-3 mb-3">
        <label for="" class="form-label">Danh mục:</label>
        <select name="category_id" id="" class="form-control">
            <?php foreach ($categories as $cat) : ?>
                <option value="<?= $cat["id"] ?>"
                    <?= (isset($_SESSION['old']['category_id']) && $_SESSION['old']['category_id'] == $cat['id']) ? 'selected' : '' ?>>
                    <?= $cat["name"] ?>
                </option>
            <?php endforeach; ?>
        </select>
    </div>
    <div class="mt-3 mb-3">
        <label for="" class="form-label">Mô tả:</label>
        <input type="text" name="description" class="form-control"
            value="<?= htmlspecialchars($_SESSION['old']['description'] ?? '') ?>">
    </div>
    <div class="mt-3 mb-3">
        <label for="" class="form-label">Giá:</label>
        <input type="number" name="price" class="form-control"
            value="<?= htmlspecialchars($_SESSION['old']['price'] ?? '') ?>">
    </div>
    <div class="mb-3">
        <label class="form-label">Trọng lượng (nhập từng mức, cách nhau bằng dấu phẩy)</label>
        <input
            type="text"
            class="form-control"
            name="weights"
            placeholder="Ví dụ: 300g,500g,1kg"
            value="<?= htmlspecialchars($_SESSION['old']['weights'] ?? '') ?>">
        <small class="text-muted">Nhập các mức trọng lượng cách nhau bằng dấu phẩy</small>
    </div>
    <div class="mt-3 mb-3">
        <label for="" class="form-label">Số lượng:</label>
        <input type="number" name="quantity" class="form-control"
            value="<?= htmlspecialchars($_SESSION['old']['quantity'] ?? '') ?>">
    </div>
    <div class="mt-3 mb-3">
        <label for="" class="form-label">Ảnh:</label>
        <input type="file" name="image" class="form-control">
    </div>
    <button class="btn btn-primary">Lưu</button>
</form>

<?php unset($_SESSION['old']); ?>

<a href="<?= BASE_URL_ADMIN . '&action=list-product' ?>">Quay lại trang danh sách</a>