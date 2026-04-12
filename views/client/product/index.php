<div class="container py-4">
    <h4 style="font-weight:800;margin-bottom:4px;">Tất cả sản phẩm</h4>
    <p class="text-muted mb-4" style="font-size:13.5px;"><?= count($data) ?> sản phẩm có sẵn</p>

    <div class="row g-3">
        <?php foreach($data as $pro): ?>
        <div class="col-6 col-md-4 col-lg-3">
            <div style="border:1px solid #e5e7eb;border-radius:14px;overflow:hidden;background:#fff;transition:all .22s;" class="h-100 d-flex flex-direction-column"
                 onmouseover="this.style.boxShadow='0 8px 28px rgba(22,163,74,.12)';this.style.transform='translateY(-3px)';this.style.borderColor='#86efac'"
                 onmouseout="this.style.boxShadow='';this.style.transform='';this.style.borderColor='#e5e7eb'">
                <div style="height:190px;overflow:hidden;background:#f9fafb;display:flex;align-items:center;justify-content:center;">
                    <?php if($pro['image']): ?>
                    <img src="<?= BASE_ASSETS_UPLOADS . 'products/' . $pro['image'] ?>" alt="<?= htmlspecialchars($pro['name']) ?>"
                         style="width:100%;height:100%;object-fit:cover;transition:transform .3s;">
                    <?php else: ?>
                    <span style="color:#d1d5db;font-size:40px;">📦</span>
                    <?php endif; ?>
                </div>
                <div style="padding:14px 14px 16px;display:flex;flex-direction:column;flex:1;">
                    <span style="font-size:11px;font-weight:600;color:#6d28d9;background:#ede9fe;padding:3px 8px;border-radius:20px;display:inline-block;margin-bottom:6px;width:fit-content;">
                        <?= htmlspecialchars($pro['cat_name']??'') ?>
                    </span>
                    <div style="font-weight:700;font-size:14px;color:#111827;margin-bottom:6px;overflow:hidden;display:-webkit-box;-webkit-line-clamp:2;-webkit-box-orient:vertical;">
                        <?= htmlspecialchars($pro['name']) ?>
                    </div>
                    <div style="font-size:12.5px;color:#9ca3af;margin-bottom:10px;flex:1;overflow:hidden;display:-webkit-box;-webkit-line-clamp:2;-webkit-box-orient:vertical;">
                        <?= htmlspecialchars(mb_substr($pro['description'],0,70)) ?>
                    </div>
                    <div style="display:flex;justify-content:space-between;align-items:center;margin-bottom:10px;">
                        <span style="font-weight:800;font-size:16px;color:#dc2626;"><?= number_format($pro['price']) ?>đ</span>
                        <?php if($pro['quantity']>0): ?>
                            <span style="font-size:11.5px;color:#16a34a;"><i class="fas fa-circle" style="font-size:7px;"></i> Còn <?= $pro['quantity'] ?></span>
                        <?php else: ?>
                            <span style="font-size:11.5px;background:#fee2e2;color:#dc2626;padding:2px 8px;border-radius:10px;">Hết hàng</span>
                        <?php endif; ?>
                    </div>
                    <div style="display:flex;gap:6px;">
                        <a href="<?= BASE_URL ?>?action=show-product&id=<?= $pro['id'] ?>"
                           style="flex:1;padding:8px;border:1.5px solid #e5e7eb;border-radius:9px;color:#374151;font-size:12.5px;font-weight:600;text-align:center;text-decoration:none;transition:all .18s;"
                           onmouseover="this.style.borderColor='#16a34a';this.style.color='#16a34a'"
                           onmouseout="this.style.borderColor='#e5e7eb';this.style.color='#374151'">Chi tiết</a>
                        <?php if($pro['quantity']>0): ?>
                        <a href="<?= BASE_URL ?>?action=order-create&id=<?= $pro['id'] ?>"
                           style="flex:1;padding:8px;background:#dc2626;border-radius:9px;color:#fff;font-size:12.5px;font-weight:700;text-align:center;text-decoration:none;transition:all .18s;"
                           onmouseover="this.style.background='#b91c1c'"
                           onmouseout="this.style.background='#dc2626'">Mua ngay</a>
                        <?php else: ?>
                        <button disabled style="flex:1;padding:8px;background:#e5e7eb;border-radius:9px;color:#9ca3af;font-size:12.5px;font-weight:600;border:none;">Hết hàng</button>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
        <?php endforeach; ?>
        <?php if(empty($data)): ?>
        <div class="col-12 text-center py-5 text-muted">
            <i class="fas fa-box-open fa-3x mb-3 opacity-25"></i>
            <p>Không tìm thấy sản phẩm nào.</p>
        </div>
        <?php endif; ?>
    </div>
</div>
