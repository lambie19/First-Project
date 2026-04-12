<div class="container py-4">
    <div class="mb-3">
        <a href="<?= BASE_URL ?>?action=list-product" style="color:#16a34a;text-decoration:none;font-size:13.5px;font-weight:600;">
            <i class="fas fa-arrow-left me-1"></i>Danh sách sản phẩm
        </a>
    </div>
    <div class="row g-4">
        <div class="col-md-5">
            <?php if($product['image']): ?>
            <div style="border:1px solid #e5e7eb;border-radius:16px;overflow:hidden;background:#f9fafb;aspect-ratio:1;display:flex;align-items:center;justify-content:center;">
                <img src="<?= BASE_ASSETS_UPLOADS . 'products/' . $product['image'] ?>" alt="<?= htmlspecialchars($product['name']) ?>"
                     style="width:100%;height:100%;object-fit:contain;padding:16px;">
            </div>
            <?php else: ?>
            <div style="border:1px solid #e5e7eb;border-radius:16px;background:#f9fafb;height:320px;display:flex;align-items:center;justify-content:center;font-size:60px;color:#d1d5db;">📦</div>
            <?php endif; ?>
        </div>
        <div class="col-md-7">
            <h2 style="font-weight:800;font-size:24px;color:#111827;margin-bottom:14px;"><?= htmlspecialchars($product['name']) ?></h2>
            <div style="font-size:30px;font-weight:800;color:#dc2626;margin-bottom:20px;"><?= number_format($product['price']) ?>đ</div>

            <div style="display:flex;gap:12px;margin-bottom:20px;flex-wrap:wrap;">
                <div style="padding:8px 14px;background:#f9fafb;border-radius:9px;font-size:13px;">
                    <span style="color:#6b7280;">Danh mục: </span>
                    <span style="font-weight:600;color:#6d28d9;"><?= $product['category_id'] ?></span>
                </div>
                <?php if($product['quantity']>0): ?>
                <div style="padding:8px 14px;background:#f0fdf4;border-radius:9px;font-size:13px;color:#16a34a;font-weight:600;">
                    <i class="fas fa-circle" style="font-size:8px;"></i> Còn hàng (<?= $product['quantity'] ?> sp)
                </div>
                <?php else: ?>
                <div style="padding:8px 14px;background:#fef2f2;border-radius:9px;font-size:13px;color:#dc2626;font-weight:600;">Hết hàng</div>
                <?php endif; ?>
            </div>

            <div style="background:#f9fafb;border-radius:12px;padding:16px;margin-bottom:22px;">
                <div style="font-weight:700;font-size:13.5px;margin-bottom:8px;">Mô tả sản phẩm:</div>
                <p style="font-size:13.5px;color:#374151;margin:0;line-height:1.7;"><?= nl2br(htmlspecialchars($product['description'])) ?></p>
            </div>

            <?php if($product['quantity']>0): ?>
            <a href="<?= BASE_URL ?>?action=order-create&id=<?= $product['id'] ?>"
               style="display:inline-flex;align-items:center;gap:8px;padding:13px 32px;background:#dc2626;color:#fff;border-radius:11px;font-weight:700;font-size:14px;text-decoration:none;">
                <i class="fas fa-bolt"></i> Mua ngay
            </a>
            <?php else: ?>
            <button disabled style="padding:13px 32px;background:#e5e7eb;color:#9ca3af;border:none;border-radius:11px;font-size:14px;font-weight:700;">Hết hàng</button>
            <?php endif; ?>
        </div>
    </div>
</div>
