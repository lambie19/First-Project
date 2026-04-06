<?php
// views/client/cart/index.php
// Được load bởi main.php qua $view = 'cart/index'
$title = 'Giỏ hàng';
?>

<?php if (isset($_SESSION['success'])) : ?>
    <div class="col-12">
        <div class="alert alert-success alert-dismissible fade show">
            <?= htmlspecialchars($_SESSION['success']) ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
        <?php unset($_SESSION['success']); ?>
    </div>
<?php endif; ?>

<?php if (isset($_SESSION['error'])) : ?>
    <div class="col-12">
        <div class="alert alert-danger alert-dismissible fade show">
            <?= htmlspecialchars($_SESSION['error']) ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
        <?php unset($_SESSION['error']); ?>
    </div>
<?php endif; ?>

<?php if (empty($cart)) : ?>

    <!-- Giỏ hàng trống -->
    <div class="col-12 text-center py-5">
        <img src="https://cdn-icons-png.flaticon.com/512/2038/2038854.png"
            alt="empty cart" width="120" class="mb-4 opacity-50">
        <h4 class="text-muted">Giỏ hàng của bạn đang trống</h4>
        <p class="text-muted">Hãy thêm sản phẩm vào giỏ để tiếp tục mua sắm.</p>
        <a href="<?= BASE_URL ?>" class="btn btn-primary mt-2">
            ← Tiếp tục mua sắm
        </a>
    </div>

<?php else : ?>

    <!-- Bảng sản phẩm trong giỏ -->
    <div class="col-lg-8">
        <table class="table table-bordered table-hover align-middle">
            <thead class="table-dark">
                <tr>
                    <th style="width:70px">Ảnh</th>
                    <th>Sản phẩm</th>
                    <th class="text-center" style="width:160px">Số lượng</th>
                    <th class="text-end" style="width:120px">Đơn giá</th>
                    <th class="text-end" style="width:130px">Thành tiền</th>
                    <th class="text-center" style="width:60px">Xoá</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($cart as $id => $item) : ?>
                    <tr>
                        <!-- Ảnh sản phẩm -->
                        <td class="text-center">
                            <?php if (!empty($item['image'])) : ?>
                                <img src="<?= BASE_ASSETS_UPLOADS . 'products/' . htmlspecialchars($item['image']) ?>"
                                    alt="<?= htmlspecialchars($item['name']) ?>"
                                    width="55" height="55"
                                    style="object-fit:cover; border-radius:6px;">
                            <?php else : ?>
                                <div class="bg-secondary d-flex align-items-center justify-content-center rounded"
                                    style="width:55px;height:55px;">
                                    <span class="text-white" style="font-size:22px;">📦</span>
                                </div>
                            <?php endif; ?>
                        </td>

                        <!-- Tên sản phẩm -->
                        <td>
                            <span class="fw-semibold"><?= htmlspecialchars($item['name']) ?></span>
                        </td>

                        <!-- Cập nhật số lượng -->
                        <td>
                            <form method="POST"
                                action="<?= BASE_URL ?>?action=cart-update"
                                class="d-flex align-items-center justify-content-center gap-1">
                                <input type="hidden" name="product_id" value="<?= $id ?>">

                                <button type="button" class="btn btn-outline-secondary btn-sm"
                                    onclick="changeQty(this, -1)">−</button>

                                <input type="number" name="quantity"
                                    value="<?= (int)$item['quantity'] ?>"
                                    min="1" max="999"
                                    class="form-control form-control-sm text-center"
                                    style="width:55px;"
                                    onchange="this.form.submit()">

                                <button type="button" class="btn btn-outline-secondary btn-sm"
                                    onclick="changeQty(this, 1)">+</button>
                            </form>
                        </td>

                        <!-- Đơn giá -->
                        <td class="text-end text-muted">
                            <?= number_format($item['price'], 0, ',', '.') ?>đ
                        </td>

                        <!-- Thành tiền -->
                        <td class="text-end fw-bold text-danger">
                            <?= number_format($item['price'] * $item['quantity'], 0, ',', '.') ?>đ
                        </td>

                        <!-- Nút xoá -->
                        <td class="text-center">
                            <a href="<?= BASE_URL ?>?action=cart-remove&id=<?= $id ?>"
                                class="btn btn-sm btn-outline-danger"
                                onclick="return confirm('Xoá sản phẩm này khỏi giỏ hàng?')"
                                title="Xoá">
                                🗑
                            </a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>

        <!-- Nút bên dưới bảng -->
        <div class="d-flex justify-content-between mt-2">
            <a href="<?= BASE_URL ?>" class="btn btn-outline-secondary">
                ← Tiếp tục mua sắm
            </a>
            <a href="<?= BASE_URL ?>?action=cart-clear"
                class="btn btn-outline-danger"
                onclick="return confirm('Xoá toàn bộ giỏ hàng?')">
                🗑 Xoá tất cả
            </a>
        </div>
    </div>

    <!-- Tóm tắt đơn hàng -->
    <div class="col-lg-4">
        <div class="card">
            <div class="card-header bg-dark text-white">
                <h5 class="mb-0">Tóm tắt đơn hàng</h5>
            </div>
            <div class="card-body">
                <div class="d-flex justify-content-between mb-2">
                    <span class="text-muted">Số lượng sản phẩm:</span>
                    <span><?= array_sum(array_column($cart, 'quantity')) ?></span>
                </div>
                <div class="d-flex justify-content-between mb-2">
                    <span class="text-muted">Tạm tính:</span>
                    <span><?= number_format($total, 0, ',', '.') ?>đ</span>
                </div>
                <div class="d-flex justify-content-between mb-2">
                    <span class="text-muted">Phí vận chuyển:</span>
                    <span class="text-success fw-semibold">Miễn phí</span>
                </div>
                <hr>
                <div class="d-flex justify-content-between fw-bold fs-5">
                    <span>Tổng cộng:</span>
                    <span class="text-danger"><?= number_format($total, 0, ',', '.') ?>đ</span>
                </div>

                <?php if (isset($_SESSION['user_id'])) : ?>
                    <a href="<?= BASE_URL ?>?action=order-create"
                        class="btn btn-primary w-100 mt-3">
                        Đặt hàng ngay →
                    </a>
                <?php else : ?>
                    <a href="<?= BASE_URL ?>?action=login"
                        class="btn btn-warning w-100 mt-3">
                        Đăng nhập để đặt hàng
                    </a>
                <?php endif; ?>
            </div>
        </div>
    </div>

<?php endif; ?>

<script>
    function changeQty(btn, delta) {
        const form = btn.closest('form');
        const input = form.querySelector('input[name="quantity"]');
        const val = Math.max(1, parseInt(input.value) + delta);
        input.value = val;
        form.submit();
    }
</script>