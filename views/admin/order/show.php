<div class="col-12">

    <?php
    $statusMap = [
        'pending'   => ['label' => 'Chờ xác nhận', 'class' => 'bg-warning text-dark'],
        'confirmed' => ['label' => 'Đã xác nhận',  'class' => 'bg-info text-dark'],
        'shipping'  => ['label' => 'Đang giao',    'class' => 'bg-primary'],
        'completed' => ['label' => 'Hoàn thành',   'class' => 'bg-success'],
        'cancelled' => ['label' => 'Đã hủy',       'class' => 'bg-danger'],
    ];
    $st = $statusMap[$order['status']] ?? ['label' => $order['status'], 'class' => 'bg-secondary'];
    ?>

    <div class="mb-3">
        <a href="<?= BASE_URL_ADMIN ?>&action=list-order" class="btn btn-outline-secondary btn-sm">
            ← Quay lại danh sách
        </a>
    </div>

    <div class="row g-4">

        <!-- Thông tin đơn hàng -->
        <div class="col-md-5">
            <div class="card shadow-sm h-100">
                <div class="card-header fw-bold bg-dark text-white">
                    🧾 Đơn hàng #<?= $order['id'] ?>
                    <span class="badge <?= $st['class'] ?> ms-2"><?= $st['label'] ?></span>
                </div>
                <div class="card-body">
                    <table class="table table-borderless table-sm mb-0">
                        <tr>
                            <th style="width:140px">Người nhận:</th>
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
                            <td class="fst-italic text-muted"><?= htmlspecialchars($order['note']) ?></td>
                        </tr>
                        <?php endif; ?>
                        <tr>
                            <th>Ngày đặt:</th>
                            <td><?= date('H:i - d/m/Y', strtotime($order['created_at'])) ?></td>
                        </tr>
                        <tr>
                            <th>Tổng tiền:</th>
                            <td class="text-danger fw-bold fs-5"><?= number_format($order['total_price']) ?> VNĐ</td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>

        <!-- Cập nhật trạng thái -->
        <div class="col-md-7">

            <div class="card shadow-sm mb-3">
                <div class="card-header fw-bold bg-warning text-dark">🔄 Cập nhật trạng thái</div>
                <div class="card-body">
                    <form action="<?= BASE_URL_ADMIN ?>&action=update-order-status&id=<?= $order['id'] ?>"
                          method="POST" class="d-flex gap-3 align-items-end flex-wrap">
                        <div class="flex-grow-1">
                            <label class="form-label fw-semibold mb-1">Trạng thái mới</label>
                            <select name="status" class="form-select">
                                <?php foreach ($statusMap as $key => $val) : ?>
                                <option value="<?= $key ?>" <?= $order['status'] === $key ? 'selected' : '' ?>>
                                    <?= $val['label'] ?>
                                </option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <button type="submit" class="btn btn-warning fw-bold px-4">Lưu</button>
                    </form>

                    <!-- Timeline trạng thái -->
                    <div class="mt-4">
                        <div class="d-flex justify-content-between position-relative">
                            <div style="position:absolute; top:12px; left:0; right:0; height:3px; background:#dee2e6; z-index:0;"></div>
                            <?php
                            $steps = ['pending' => 'Chờ xác nhận', 'confirmed' => 'Đã xác nhận', 'shipping' => 'Đang giao', 'completed' => 'Hoàn thành'];
                            $stepKeys = array_keys($steps);
                            $currentIdx = array_search($order['status'], $stepKeys);
                            foreach ($steps as $key => $label) :
                                $idx = array_search($key, $stepKeys);
                                $done = ($currentIdx !== false && $idx <= $currentIdx && $order['status'] !== 'cancelled');
                                $color = $done ? '#198754' : '#dee2e6';
                            ?>
                            <div class="text-center position-relative" style="z-index:1; flex:1;">
                                <div class="mx-auto rounded-circle d-flex align-items-center justify-content-center fw-bold text-white"
                                     style="width:26px; height:26px; background:<?= $color ?>; font-size:12px;">
                                    <?= $done ? '✓' : ($idx + 1) ?>
                                </div>
                                <div class="mt-1" style="font-size:11px; color:<?= $done ? '#198754' : '#aaa' ?>">
                                    <?= $label ?>
                                </div>
                            </div>
                            <?php endforeach; ?>
                        </div>
                        <?php if ($order['status'] === 'cancelled') : ?>
                        <div class="alert alert-danger mt-3 mb-0 py-2 text-center">Đơn hàng đã bị hủy</div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>

            <!-- Danh sách sản phẩm trong đơn -->
            <div class="card shadow-sm">
                <div class="card-header fw-bold bg-light">🛒 Sản phẩm trong đơn</div>
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
                                         width="42" height="42" class="rounded me-2"
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
                                <td class="text-end pe-3 fw-bold text-danger fs-6">
                                    <?= number_format($order['total_price']) ?> VNĐ
                                </td>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>

        </div>
    </div>

    <!-- Nút xóa -->
    <div class="mt-4 pt-3 border-top">
        <a href="<?= BASE_URL_ADMIN ?>&action=delete-order&id=<?= $order['id'] ?>"
           class="btn btn-outline-danger"
           onclick="return confirm('Xóa đơn hàng #<?= $order['id'] ?>? Không thể hoàn tác!')">
            🗑 Xóa đơn hàng này
        </a>
    </div>

</div>
