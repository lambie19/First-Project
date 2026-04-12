<?php $title = 'Xác nhận đặt hàng'; ?>

<div class="container py-4">
    <h4 style="font-weight:800;margin-bottom:4px;"><i class="fas fa-check-circle me-2 text-success"></i>Xác nhận đặt hàng</h4>
    <p class="text-muted mb-4" style="font-size:13.5px;">Điền thông tin giao hàng để hoàn tất đơn</p>

    <div class="row g-4">
        <!-- Form -->
        <div class="col-md-7">
            <div style="background:#fff;border:1px solid #e5e7eb;border-radius:14px;overflow:hidden;">
                <div style="padding:14px 20px;background:#f9fafb;border-bottom:1px solid #e5e7eb;font-weight:700;font-size:14px;">
                    <i class="fas fa-map-marker-alt me-2 text-success"></i>Thông tin giao hàng
                </div>
                <form method="POST" action="<?= BASE_URL ?>?action=order-store" style="padding:22px;">
                    <div class="row g-3">
                        <div class="col-md-6">
                            <label class="form-label">Họ và tên <span class="text-danger">*</span></label>
                            <input type="text" name="customer_name" class="form-control" required placeholder="Người nhận hàng"
                                   value="<?= htmlspecialchars($_SESSION['user_name']??'') ?>">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Số điện thoại <span class="text-danger">*</span></label>
                            <input type="text" name="customer_phone" class="form-control" required placeholder="0xxxxxxxxx">
                        </div>
                        <div class="col-12">
                            <label class="form-label">Địa chỉ giao hàng <span class="text-danger">*</span></label>
                            <input type="text" name="customer_address" class="form-control" required placeholder="Số nhà, đường, phường/xã, quận/huyện, tỉnh/thành">
                        </div>
                        <div class="col-12">
                            <label class="form-label">Ghi chú</label>
                            <textarea name="note" class="form-control" rows="2" placeholder="Ghi chú thêm về đơn hàng..."></textarea>
                        </div>
                    </div>
                    <div style="border-top:1px solid #f1f5f9;margin-top:20px;padding-top:18px;display:flex;gap:10px;">
                        <button type="submit"
                                style="flex:1;padding:13px;background:#16a34a;color:#fff;border:none;border-radius:11px;font-weight:800;font-size:14px;cursor:pointer;display:flex;align-items:center;justify-content:center;gap:8px;">
                            <i class="fas fa-check-circle"></i> Xác nhận đặt hàng
                        </button>
                        <a href="<?= BASE_URL ?>?action=cart"
                           style="padding:13px 20px;border:1.5px solid #e5e7eb;border-radius:11px;color:#374151;font-weight:600;font-size:14px;text-decoration:none;display:flex;align-items:center;gap:6px;">
                            <i class="fas fa-arrow-left"></i> Giỏ hàng
                        </a>
                    </div>
                </form>
            </div>
        </div>

        <!-- Order Summary -->
        <div class="col-md-5">
            <div style="background:#fff;border:1px solid #e5e7eb;border-radius:14px;overflow:hidden;position:sticky;top:80px;">
                <div style="padding:14px 20px;background:#f9fafb;border-bottom:1px solid #e5e7eb;font-weight:700;font-size:14px;">
                    <i class="fas fa-basket-shopping me-2 text-primary"></i>Giỏ hàng (<?= count($cart) ?> sản phẩm)
                </div>
                <div style="padding:0;">
                    <?php foreach($cart as $item): ?>
                    <div style="display:flex;justify-content:space-between;align-items:center;padding:12px 18px;border-bottom:1px solid #f9fafb;gap:10px;">
                        <div style="flex:1;">
                            <div style="font-size:13.5px;font-weight:600;color:#111827;"><?= htmlspecialchars($item['name']) ?></div>
                            <div style="font-size:12px;color:#9ca3af;">x<?= $item['quantity'] ?></div>
                        </div>
                        <div style="font-weight:700;color:#374151;font-size:13.5px;white-space:nowrap;"><?= number_format($item['price']*$item['quantity']) ?>đ</div>
                    </div>
                    <?php endforeach; ?>
                    <div style="padding:16px 18px;display:flex;justify-content:space-between;font-weight:800;font-size:16px;border-top:2px solid #e5e7eb;">
                        <span>Tổng cộng</span>
                        <span style="color:#dc2626;"><?= number_format($total) ?>đ</span>
                    </div>
                </div>
                <div style="padding:0 18px 18px;">
                    <div style="padding:10px;background:#f0fdf4;border-radius:9px;font-size:12px;color:#15803d;text-align:center;">
                        <i class="fas fa-truck me-1"></i>Miễn phí vận chuyển
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
