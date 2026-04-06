<div class="row">
    <div class="col-4">
        <img src="<?= BASE_ASSETS_UPLOADS . $pro['image'] ?>" class="img-fluid border rounded" alt="<?= $pro['name'] ?>">
    </div>

    <div class="col-8">
        <h1><?= $pro['name'] ?></h1>
        <div class="d-flex align-items-center mb-3">
            <div class="text-warning me-3">
                <span class="h5 me-1">⭐ <?= $averageRating ?>/5</span>
                <span class="text-muted small">(<?= $totalReviews ?> đánh giá)</span>
            </div>
            <span class="text-muted"><i class="fas fa-eye"></i> Lượt xem: <?= $pro['view_count'] ?></span>
        </div>

        <h3 class="text-danger fw-bold mb-3">Giá: <?= number_format($pro['price'], 0, ',', '.') ?> VNĐ</h3>

        <p class="mb-4">
            <strong>Mô tả:</strong>
            <?= nl2br($pro['description']) ?>
        </p>

        <!-- Nút thêm vào giỏ hàng -->
        <form method="POST" action="<?= BASE_URL ?>?action=cart-add" class="d-inline-flex align-items-center gap-2 me-2">
            <input type="hidden" name="product_id" value="<?= $pro['id'] ?>">
            <input type="number" name="quantity" value="1" min="1" max="999"
                class="form-control" style="width: 75px;">
            <button type="submit" class="btn btn-lg btn-success">
                🛒 Thêm vào giỏ hàng
            </button>
        </form>

        <a href="<?= BASE_URL ?>?action=order-create&id=<?= $pro['id'] ?>" class="btn btn-danger btn-lg px-5">
            ⚡ Mua ngay
        </a>
    </div>
</div>

<hr class="my-5">

<div class="row">
    <div class="col-12">
        <h2>Bình luận và Đánh giá</h2>

        <h4 class="mt-4">Gửi Bình luận của bạn</h4>

        <?php if (isset($_SESSION['user_id'])) : //Yêu cầu đăng nhập để bình luận 
        ?>
            <form action="<?= BASE_URL ?>?action=store-comment" method="POST" class="mb-5">
                <input type="hidden" name="product_id" value="<?= $pro['id'] ?>">

                <div class="mb-3">
                    <label for="comment_content" class="form-label">Nội dung bình luận:</label>
                    <textarea class="form-control" name="content" id="comment_content" rows="3" required></textarea>
                </div>

                <button type="submit" class="btn btn-primary">Gửi Bình luận</button>
            </form>
        <?php else : ?>
            <div class="alert alert-warning">
                Vui lòng <a href="<?= BASE_URL ?>?action=login">đăng nhập</a> để bình luận.
            </div>
        <?php endif; ?>

        <h4 class="mt-5">Các Bình luận (<?= count($comments) ?>)</h4>

        <?php if (!empty($comments)) : ?>
            <ul class="list-group">
                <?php foreach ($comments as $comment) : ?>
                    <li class="list-group-item d-flex justify-content-between align-items-start">
                        <div class="ms-2 me-auto">
                            <div class="fw-bold"><?= $comment['user_name'] ?? 'Khách' ?></div>
                            <?= $comment['content'] ?>
                        </div>
                        <span class="badge bg-secondary rounded-pill">
                            <?= date('d/m/Y H:i', strtotime($comment['created_at'])) ?>
                        </span>
                    </li>
                <?php endforeach; ?>
            </ul>
        <?php else : ?>
            <p>Chưa có bình luận nào cho sản phẩm này.</p>
        <?php endif; ?>
    </div>
</div>