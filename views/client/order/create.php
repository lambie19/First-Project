<div class="container py-4">
    <div class="mb-3">
        <a href="<?= BASE_URL ?>?action=detail-product&id=<?= $product['id'] ?>" style="color:#16a34a;text-decoration:none;font-size:13.5px;font-weight:600;">
            <i class="fas fa-arrow-left me-1"></i>Quay lại sản phẩm
        </a>
    </div>

    <?php if(isset($error)): ?>
    <div class="alert alert-danger"><i class="fas fa-exclamation-circle me-2"></i><?= $error ?></div>
    <?php endif; ?>

    <div class="row g-4">
        <!-- Product Summary -->
        <div class="col-md-4">
            <div style="background:#fff;border:1px solid #e5e7eb;border-radius:14px;padding:20px;position:sticky;top:80px;">
                <div style="font-weight:700;font-size:13px;color:#6b7280;text-transform:uppercase;letter-spacing:.5px;margin-bottom:14px;"><i class="fas fa-box-open me-2 text-primary"></i>Sản phẩm đặt mua</div>
                <?php if($product['image']): ?>
                <img src="<?= BASE_ASSETS_UPLOADS . 'products/' . $product['image'] ?>" alt=""
                     style="width:100%;height:150px;object-fit:cover;border-radius:12px;margin-bottom:14px;border:1px solid #e5e7eb;">
                <?php endif; ?>
                <div style="font-weight:700;font-size:15px;color:#111827;margin-bottom:6px;"><?= htmlspecialchars($product['name']) ?></div>
                <div style="font-size:20px;font-weight:800;color:#dc2626;margin-bottom:4px;"><?= number_format($product['price']) ?>đ</div>
                <div style="font-size:12.5px;color:#9ca3af;">Còn <?= $product['quantity'] ?> sản phẩm</div>

                <div id="order-total-preview" style="margin-top:16px;padding:12px;background:#f0fdf4;border-radius:10px;border:1px solid #bbf7d0;">
                    <div style="display:flex;justify-content:space-between;font-size:13.5px;font-weight:700;">
                        <span>Tổng cộng:</span>
                        <span id="total-display" style="color:#dc2626;"><?= number_format($product['price']) ?>đ</span>
                    </div>
                </div>
            </div>
        </div>

        <!-- Order Form -->
        <div class="col-md-8">
            <div style="background:#fff;border:1px solid #e5e7eb;border-radius:14px;overflow:hidden;">
                <div style="padding:16px 22px;border-bottom:1px solid #f1f5f9;font-weight:700;font-size:15px;background:#f9fafb;">
                    <i class="fas fa-truck me-2 text-success"></i>Thông tin giao hàng
                </div>
                <div style="padding:22px;">
                    <form action="<?= BASE_URL ?>?action=order-store" method="POST">
                        <input type="hidden" name="product_id" value="<?= $product['id'] ?>">
                        <div class="row g-3">
                            <div class="col-md-6">
                                <label class="form-label">Họ và tên <span class="text-danger">*</span></label>
                                <input type="text" name="customer_name" class="form-control" required placeholder="Nhập họ tên người nhận"
                                       value="<?= htmlspecialchars($_POST['customer_name']??$_SESSION['user_name']??'') ?>">
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Số điện thoại <span class="text-danger">*</span></label>
                                <input type="tel" name="customer_phone" class="form-control" required placeholder="0xxxxxxxxx"
                                       value="<?= htmlspecialchars($_POST['customer_phone']??'') ?>">
                            </div>
                            <div class="col-12">
                                <label class="form-label">Địa chỉ giao hàng <span class="text-danger">*</span></label>
                                <textarea name="customer_address" class="form-control" rows="2" required
                                          placeholder="Số nhà, đường, phường/xã, quận/huyện, tỉnh/thành"><?= htmlspecialchars($_POST['customer_address']??'') ?></textarea>
                            </div>
                            <div class="col-md-4">
                                <label class="form-label">Số lượng <span class="text-danger">*</span></label>
                                <input type="number" name="quantity" id="qty" class="form-control" min="1" max="<?= $product['quantity'] ?>" required
                                       value="<?= intval($_POST['quantity']??1) ?>" oninput="updateTotal()">
                            </div>
                            <div class="col-12">
                                <label class="form-label">Ghi chú</label>
                                <textarea name="note" class="form-control" rows="2" placeholder="Ghi chú thêm (không bắt buộc)"><?= htmlspecialchars($_POST['note']??'') ?></textarea>
                            </div>
                        </div>
                        <div style="border-top:1px solid #f1f5f9;margin-top:22px;padding-top:18px;">
                            <button type="submit"
                                    style="width:100%;padding:13px;background:#16a34a;color:#fff;border:none;border-radius:11px;font-weight:800;font-size:15px;cursor:pointer;display:flex;align-items:center;justify-content:center;gap:8px;transition:all .18s;">
                                <i class="fas fa-check-circle"></i> Xác nhận đặt hàng
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
const price = <?= $product['price'] ?>;
function updateTotal() {
    const qty = Math.max(1, parseInt(document.getElementById('qty').value)||1);
    document.getElementById('total-display').textContent = (price*qty).toLocaleString('vi-VN')+'đ';
}
</script>
