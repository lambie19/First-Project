<div class="row row-cols-1 row-cols-md-3 g-4">
    <?php foreach ($data as $pro) : ?>
    <div class="col">
        <div class="card h-100 shadow-sm border-0">
            <?php if ($pro['image']) : ?>
            <img src="<?= BASE_ASSETS_UPLOADS . 'products/' . $pro['image'] ?>"
                 class="card-img-top"
                 alt="<?= htmlspecialchars($pro['name']) ?>"
                 style="height:200px; object-fit:cover;">
            <?php else : ?>
            <div class="bg-secondary-subtle d-flex align-items-center justify-content-center"
                 style="height:200px;">
                <span class="text-muted">Không có ảnh</span>
            </div>
            <?php endif; ?>

            <div class="card-body d-flex flex-column">
                <span class="badge bg-light text-muted mb-1" style="width:fit-content">
                    <?= htmlspecialchars($pro['cat_name'] ?? '') ?>
                </span>
                <h5 class="card-title fw-bold"><?= htmlspecialchars($pro['name']) ?></h5>
                <p class="card-text text-muted small flex-grow-1">
                    <?= htmlspecialchars(mb_substr($pro['description'], 0, 80)) ?>...
                </p>
                <div class="d-flex justify-content-between align-items-center mt-2">
                    <span class="fw-bold text-danger fs-5"><?= number_format($pro['price']) ?>đ</span>
                    <?php if ($pro['quantity'] > 0) : ?>
                    <span class="text-muted small">Còn <?= $pro['quantity'] ?></span>
                    <?php else : ?>
                    <span class="badge bg-danger">Hết hàng</span>
                    <?php endif; ?>
                </div>
            </div>

            <div class="card-footer bg-white border-0 d-flex gap-2 pb-3">
                <a href="<?= BASE_URL ?>?action=show-product&id=<?= $pro['id'] ?>"
                   class="btn btn-outline-secondary btn-sm flex-fill">Xem chi tiết</a>
                <?php if ($pro['quantity'] > 0) : ?>
                <a href="<?= BASE_URL ?>?action=order-create&id=<?= $pro['id'] ?>"
                   class="btn btn-danger btn-sm flex-fill">🛒 Mua ngay</a>
                <?php else : ?>
                <button class="btn btn-secondary btn-sm flex-fill" disabled>Hết hàng</button>
                <?php endif; ?>
            </div>
        </div>
    </div>
    <?php endforeach; ?>
</div>
