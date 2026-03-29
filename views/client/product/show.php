<div class="col-12">
    <div class="mb-3">
        <a href="<?= BASE_URL ?>?action=list-product" class="btn btn-outline-secondary btn-sm">← Danh sách sản phẩm</a>
    </div>

    <div class="row g-4">
        <div class="col-md-5">
            <?php if ($product['image']) : ?>
            <img src="<?= BASE_ASSETS_UPLOADS . 'products/' . $product['image'] ?>"
                 alt="<?= htmlspecialchars($product['name']) ?>"
                 class="img-fluid rounded shadow-sm w-100"
                 style="max-height:400px; object-fit:cover;">
            <?php else : ?>
            <div class="bg-secondary-subtle rounded d-flex align-items-center justify-content-center"
                 style="height:300px;">
                <span class="text-muted">Không có ảnh</span>
            </div>
            <?php endif; ?>
        </div>

        <div class="col-md-7">
            <h2 class="fw-bold"><?= htmlspecialchars($product['name']) ?></h2>
            <div class="fs-3 fw-bold text-danger mb-3"><?= number_format($product['price']) ?> VNĐ</div>

            <table class="table table-borderless table-sm mb-3">
                <tr>
                    <th width="130">Danh mục:</th>
                    <td><span class="badge bg-light text-dark border"><?= $product['category_id'] ?></span></td>
                </tr>
                <tr>
                    <th>Tình trạng:</th>
                    <td>
                        <?php if ($product['quantity'] > 0) : ?>
                        <span class="badge bg-success">Còn hàng (<?= $product['quantity'] ?> sp)</span>
                        <?php else : ?>
                        <span class="badge bg-danger">Hết hàng</span>
                        <?php endif; ?>
                    </td>
                </tr>
            </table>

            <div class="mb-4">
                <h6 class="fw-bold">Mô tả:</h6>
                <p class="text-muted"><?= nl2br(htmlspecialchars($product['description'])) ?></p>
            </div>

            <?php if ($product['quantity'] > 0) : ?>
            <a href="<?= BASE_URL ?>?action=order-create&id=<?= $product['id'] ?>"
               class="btn btn-danger btn-lg px-5">
                🛒 Mua ngay
            </a>
            <?php else : ?>
            <button class="btn btn-secondary btn-lg px-5" disabled>Hết hàng</button>
            <?php endif; ?>
        </div>
    </div>
</div>
