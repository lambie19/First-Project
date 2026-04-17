<div class="container py-4">
    <!-- Breadcrumb -->
    <nav style="font-size:13px;color:#9ca3af;margin-bottom:20px;">
        <a href="<?= BASE_URL ?>" style="color:#16a34a;text-decoration:none;">Trang chủ</a>
        <span class="mx-2">/</span>
        <span style="color:#374151;"><?= htmlspecialchars($pro['name']) ?></span>
    </nav>

    <!-- Product Detail -->
    <div class="row g-4 mb-5">
        <!-- Image -->
        <div class="col-md-5">
            <div style="border:1px solid #e5e7eb;border-radius:16px;overflow:hidden;background:#f9fafb;aspect-ratio:1;display:flex;align-items:center;justify-content:center;">
                <img src="<?= BASE_ASSETS_UPLOADS . $pro['image'] ?>" alt="<?= htmlspecialchars($pro['name']) ?>"
                     style="width:100%;height:100%;object-fit:contain;padding:16px;">
            </div>
        </div>

        <!-- Info -->
        <div class="col-md-7">
            <h1 style="font-weight:800;font-size:24px;color:#111827;margin-bottom:12px;"><?= htmlspecialchars($pro['name']) ?></h1>

            <div style="display:flex;align-items:center;gap:16px;margin-bottom:16px;">
                <div style="display:flex;align-items:center;gap:6px;">
                    <?php for($i=1;$i<=5;$i++): ?>
                        <i class="fas fa-star" style="color:<?= $i<=$averageRating?'#f59e0b':'#e5e7eb' ?>;font-size:14px;"></i>
                    <?php endfor; ?>
                    <span style="font-size:13px;color:#6b7280;margin-left:4px;"><?= $averageRating ?>/5 (<?= $totalReviews ?> đánh giá)</span>
                </div>
                <span style="color:#9ca3af;font-size:13px;"><i class="fas fa-eye me-1"></i><?= $pro['view_count'] ?> lượt xem</span>
            </div>

            <div style="font-size:30px;font-weight:800;color:#dc2626;margin-bottom:20px;">
                <?= number_format($pro['price']) ?><span style="font-size:18px;">đ</span>
            </div>

            <div style="background:#f9fafb;border:1px solid #e5e7eb;border-radius:12px;padding:16px;margin-bottom:22px;">
                <p style="font-size:14px;color:#374151;margin:0;line-height:1.7;"><?= nl2br(htmlspecialchars($pro['description'])) ?></p>
            </div>

            <!-- Quantity + Add Cart -->
            <form method="POST" action="<?= BASE_URL ?>?action=cart-add" style="display:flex;align-items:center;gap:12px;margin-bottom:12px;flex-wrap:wrap;">
                <input type="hidden" name="product_id" value="<?= $pro['id'] ?>">
                <div style="display:flex;align-items:center;gap:8px;border:1.5px solid #e5e7eb;border-radius:10px;padding:6px 12px;background:#fff;">
                    <button type="button" onclick="this.nextElementSibling.value=Math.max(1,+this.nextElementSibling.value-1)"
                            style="border:none;background:none;font-size:18px;cursor:pointer;color:#374151;padding:0;width:24px;">−</button>
                    <input type="number" name="quantity" value="1" min="1" max="999"
                           style="width:46px;border:none;outline:none;text-align:center;font-size:15px;font-weight:700;">
                    <button type="button" onclick="this.previousElementSibling.value=Math.min(999,+this.previousElementSibling.value+1)"
                            style="border:none;background:none;font-size:18px;cursor:pointer;color:#374151;padding:0;width:24px;">+</button>
                </div>
                <button type="submit"
                        style="flex:1;padding:12px 20px;background:#fff;color:#16a34a;border:2px solid #16a34a;border-radius:11px;font-weight:700;font-size:14px;cursor:pointer;transition:all .18s;display:flex;align-items:center;justify-content:center;gap:8px;min-width:160px;"
                        onmouseover="this.style.background='#16a34a';this.style.color='#fff'"
                        onmouseout="this.style.background='#fff';this.style.color='#16a34a'">
                    <i class="fas fa-cart-plus"></i> Thêm vào giỏ
                </button>
            </form>

            <a href="<?= BASE_URL ?>?action=order-create&id=<?= $pro['id'] ?>"
               style="display:flex;align-items:center;justify-content:center;gap:8px;padding:13px;background:#dc2626;color:#fff;border-radius:11px;font-weight:700;font-size:14px;text-decoration:none;transition:all .18s;"
               onmouseover="this.style.background='#b91c1c'"
               onmouseout="this.style.background='#dc2626'">
                <i class="fas fa-bolt"></i> Mua ngay
            </a>

            <!-- Trust badges -->
            <div style="display:flex;gap:16px;margin-top:20px;flex-wrap:wrap;">
                <div style="display:flex;align-items:center;gap:6px;font-size:12.5px;color:#6b7280;">
                    <i class="fas fa-truck text-success"></i> Giao hàng nhanh
                </div>
                <div style="display:flex;align-items:center;gap:6px;font-size:12.5px;color:#6b7280;">
                    <i class="fas fa-rotate-left text-primary"></i> Đổi trả 7 ngày
                </div>
                <div style="display:flex;align-items:center;gap:6px;font-size:12.5px;color:#6b7280;">
                    <i class="fas fa-shield-halved text-warning"></i> Chính hãng 100%
                </div>
            </div>
        </div>
    </div>

    <!-- Comments Section -->
    <div style="border-top:1px solid #e5e7eb;padding-top:36px;">
        <h4 style="font-weight:800;margin-bottom:4px;">Đánh giá & Bình luận</h4>
        <p class="text-muted" style="font-size:13.5px;margin-bottom:24px;"><?= count($comments) ?> bình luận về sản phẩm này</p>

        <!-- Comment Form -->
        <?php if(isset($_SESSION['user_id'])): ?>
        <div style="background:#f9fafb;border:1px solid #e5e7eb;border-radius:14px;padding:20px;margin-bottom:28px;">
            <h6 style="font-weight:700;margin-bottom:14px;color:#374151;">✍️ Gửi bình luận của bạn</h6>
            <form action="<?= BASE_URL ?>?action=store-comment" method="POST">
                <input type="hidden" name="product_id" value="<?= $pro['id'] ?>">
                <textarea class="form-control" name="content" rows="3" required
                          placeholder="Chia sẻ cảm nhận của bạn về sản phẩm..." style="margin-bottom:12px;border-radius:10px;resize:none;"></textarea>
                <button type="submit" style="padding:9px 22px;background:#16a34a;color:#fff;border:none;border-radius:9px;font-weight:700;font-size:13.5px;cursor:pointer;">
                    <i class="fas fa-paper-plane me-1"></i>Gửi bình luận
                </button>
            </form>
        </div>
        <?php else: ?>
        <div style="background:#fffbeb;border:1px solid #fde68a;border-radius:12px;padding:16px;margin-bottom:24px;font-size:13.5px;color:#92400e;">
            <i class="fas fa-circle-info me-2"></i>
            Vui lòng <a href="<?= BASE_URL ?>?action=login" style="color:#16a34a;font-weight:700;">đăng nhập</a> để bình luận.
        </div>
        <?php endif; ?>

        <!-- Comments List -->
        <?php if(!empty($comments)): ?>
        <div style="display:flex;flex-direction:column;gap:14px;">
            <?php foreach($comments as $comment): ?>
            <div style="background:#fff;border:1px solid #e5e7eb;border-radius:13px;padding:16px;">
                <div style="display:flex;align-items:center;gap:10px;margin-bottom:10px;">
                    <div style="width:34px;height:34px;border-radius:50%;background:linear-gradient(135deg,#16a34a,#059669);display:flex;align-items:center;justify-content:center;color:#fff;font-weight:700;font-size:14px;flex-shrink:0;">
                        <?= strtoupper(substr($comment['user_name']??'K',0,1)) ?>
                    </div>
                    <div>
                        <div style="font-weight:700;font-size:13.5px;color:#111827;"><?= htmlspecialchars($comment['user_name']??'Khách') ?></div>
                        <div style="font-size:11.5px;color:#9ca3af;"><?= date('d/m/Y H:i', strtotime($comment['created_at'])) ?></div>
                    </div>
                </div>
                <p style="font-size:13.5px;color:#374151;margin:0;line-height:1.6;"><?= htmlspecialchars($comment['content']) ?></p>
            </div>
            <?php endforeach; ?>
        </div>
        <?php else: ?>
        <div style="text-align:center;padding:36px;background:#f9fafb;border-radius:14px;color:#9ca3af;">
            <i class="fas fa-comments fa-2x mb-3" style="opacity:.3;display:block;"></i>
            Chưa có bình luận nào. Hãy là người đầu tiên!
        </div>
        <?php endif; ?>
    </div>
</div>
