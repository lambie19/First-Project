<div class="col-12">

    <!-- Banner thành công -->
    <div class="text-center py-4 mb-4">
        <div style="font-size:4rem">✅</div>
        <h2 class="fw-bold text-success mt-2">Đặt hàng thành công!</h2>
        <p class="text-muted">Cảm ơn bạn đã đặt hàng. Chúng tôi sẽ liên hệ xác nhận sớm nhất.</p>
    </div>

    <div class="row justify-content-center">
        <div class="col-md-8">

            <!-- Thông tin đơn hàng -->
            <div class="card shadow-sm mb-4">
                <div class="card-header bg-success text-white fw-bold">
                    📋 Thông tin đơn hàng #<?= $order['id'] ?>
                </div>
                <div class="card-body">
                    <table class="table table-borderless table-sm mb-0">
                        <tr>
                            <th style="width:150px">Người nhận:</th>
                            <td><strong><?= htmlspecialchars($order['customer_name']) ?></strong></td>
                        </tr>
                        <tr>
                            <th>Số điện thoại:</th>
                            <td><?= htmlspecialchars($order['customer_phone']) ?></td>
                        </tr>
                        <tr>
                            <th>Địa chỉ:</th>
                            <td><?= htmlspecialchars($order['customer_address']) ?></td>
                        </tr>
                        <?php if (!empty($order['note'])) : ?>
                        <tr>
                            <th>Ghi chú:</th>
                            <td class="text-muted fst-italic"><?= htmlspecialchars($order['note']) ?></td>
                        </tr>
                        <?php endif; ?>
                        <tr>
                            <th>Trạng thái:</th>
                            <td><span class="badge bg-warning text-dark">Chờ xác nhận</span></td>
                        </tr>
                        <tr>
                            <th>Thời gian:</th>
                            <td><?= date('H:i - d/m/Y', strtotime($order['created_at'])) ?></td>
                        </tr>
                    </table>
                </div>
            </div>

            <!-- Sản phẩm đã đặt -->
            <div class="card shadow-sm mb-4">
                <div class="card-header bg-light fw-bold">🛒 Sản phẩm đã đặt</div>
                <div class="card-body p-0">
                    <table class="table table-hover align-middle mb-0">
                        <thead class="table-light">
                            <tr>
                                <th class="ps-3">Sản phẩm</th>
                                <th class="text-center">SL</th>
                                <th class="text-end">Đơn giá</th>
                                <th class="text-end pe-3">Thành tiền</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($orderItems as $item) : ?>
                            <tr>
                                <td class="ps-3">
                                    <?php if ($item['product_image']) : ?>
                                    <img src="<?= BASE_ASSETS_UPLOADS . 'products/' . $item['product_image'] ?>"
                                         width="44" height="44" class="rounded me-2"
                                         style="object-fit:cover; vertical-align:middle;">
                                    <?php endif; ?>
                                    <?= htmlspecialchars($item['product_name']) ?>
                                </td>
                                <td class="text-center"><?= $item['quantity'] ?></td>
                                <td class="text-end"><?= number_format($item['price']) ?>đ</td>
                                <td class="text-end pe-3 fw-bold text-danger">
                                    <?= number_format($item['price'] * $item['quantity']) ?>đ
                                </td>
                            </tr>
                            <?php endforeach; ?>
                        </tbody>
                        <tfoot class="table-light">
                            <tr>
                                <td colspan="3" class="text-end fw-bold ps-3">Tổng cộng:</td>
                                <td class="text-end pe-3 fw-bold text-danger fs-5">
                                    <?= number_format($order['total_price']) ?> VNĐ
                                </td>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>

            <div class="text-center">
                <a href="<?= BASE_URL ?>" class="btn btn-danger btn-lg px-5">
                    Tiếp tục mua sắm
                </a>
            </div>

        </div>
    </div>
</div>
