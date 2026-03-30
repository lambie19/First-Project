<div class="col-12">
    <div class="mb-3">
        <a href="<?= BASE_URL ?>?action=detail-product&id=<?= $product['id'] ?>"
           class="btn btn-outline-secondary btn-sm">← Quay lại sản phẩm</a>
    </div>

    <?php if (isset($error)) : ?>
    <div class="alert alert-danger"><?= htmlspecialchars($error) ?></div>
    <?php endif; ?>

    <div class="row g-4">

        <!-- Thông tin sản phẩm -->
        <div class="col-md-4">
            <div class="card shadow-sm border-0 sticky-top" style="top:20px">
                <div class="card-header bg-light fw-bold">📦 Sản phẩm đặt mua</div>
                <div class="card-body">
                    <?php if ($product['image']) : ?>
                    <img src="<?= BASE_ASSETS_UPLOADS . 'products/' . $product['image'] ?>"
                         class="img-fluid rounded mb-3 w-100"
                         style="max-height:160px; object-fit:cover;"
                         alt="<?= htmlspecialchars($product['name']) ?>">
                    <?php endif; ?>
                    <h6 class="fw-bold"><?= htmlspecialchars($product['name']) ?></h6>
                    <div class="text-danger fw-bold fs-5"><?= number_format($product['price']) ?> VNĐ</div>
                    <div class="text-muted small mt-1">Còn lại: <?= $product['quantity'] ?> sản phẩm</div>
                </div>
            </div>
        </div>

        <!-- Form đặt hàng -->
        <div class="col-md-8">
            <div class="card shadow-sm border-0">
                <div class="card-header bg-danger text-white fw-bold">🚀 Thông tin đặt hàng</div>
                <div class="card-body">
                    <form action="<?= BASE_URL ?>?action=order-store" method="POST">
                        <input type="hidden" name="product_id" value="<?= $product['id'] ?>">

                        <div class="mb-3">
                            <label class="form-label fw-semibold">
                                Họ và tên <span class="text-danger">*</span>
                            </label>
                            <input type="text" name="customer_name" class="form-control" required
                                   placeholder="Nhập họ tên người nhận"
                                   value="<?= htmlspecialchars($_POST['customer_name'] ?? $_SESSION['user_name'] ?? '') ?>">
                        </div>

                        <div class="mb-3">
                            <label class="form-label fw-semibold">
                                Số điện thoại <span class="text-danger">*</span>
                            </label>
                            <input type="tel" name="customer_phone" class="form-control" required
                                   placeholder="0xxxxxxxxx" pattern="[0-9]{9,11}"
                                   value="<?= htmlspecialchars($_POST['customer_phone'] ?? '') ?>">
                        </div>

                        <div class="mb-3">
                            <label class="form-label fw-semibold">
                                Địa chỉ giao hàng <span class="text-danger">*</span>
                            </label>
                            <textarea name="customer_address" class="form-control" rows="2" required
                                      placeholder="Số nhà, đường, phường/xã, quận/huyện, tỉnh/thành"><?= htmlspecialchars($_POST['customer_address'] ?? '') ?></textarea>
                        </div>

                        <div class="mb-3">
                            <label class="form-label fw-semibold">
                                Số lượng <span class="text-danger">*</span>
                            </label>
                            <input type="number" name="quantity" id="qty" class="form-control"
                                   min="1" max="<?= $product['quantity'] ?>" required
                                   value="<?= intval($_POST['quantity'] ?? 1) ?>"
                                   oninput="updateTotal()">
                        </div>

                        <div class="mb-4">
                            <label class="form-label fw-semibold">Ghi chú</label>
                            <textarea name="note" class="form-control" rows="2"
                                      placeholder="Ghi chú thêm (không bắt buộc)"><?= htmlspecialchars($_POST['note'] ?? '') ?></textarea>
                        </div>

                        <div class="alert alert-warning d-flex justify-content-between align-items-center mb-4">
                            <span class="fw-bold fs-6">💰 Tổng tiền:</span>
                            <span class="fw-bold fs-5 text-danger" id="totalPrice">
                                <?= number_format($product['price']) ?> VNĐ
                            </span>
                        </div>

                        <button type="submit" class="btn btn-danger btn-lg w-100 fw-bold">
                            ✅ Xác nhận đặt hàng
                        </button>
                    </form>
                </div>
            </div>
        </div>

    </div>
</div>

<script>
const unitPrice = <?= (int)$product['price'] ?>;
function updateTotal() {
    const qty   = Math.max(1, parseInt(document.getElementById('qty').value) || 1);
    const total = qty * unitPrice;
    document.getElementById('totalPrice').textContent = total.toLocaleString('vi-VN') + ' VNĐ';
}
</script>
