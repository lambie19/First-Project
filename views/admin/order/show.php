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

    // Trạng thái bị khóa: completed hoặc cancelled không thể chỉnh nữa
    $isLocked = in_array($order['status'], ['completed', 'cancelled']);
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
                <div class="card-header fw-bold <?= $isLocked ? 'bg-secondary text-white' : 'bg-warning text-dark' ?>">
                    <?= $isLocked ? '🔒 Trạng thái đã khóa' : '🔄 Cập nhật trạng thái' ?>
                </div>
                <div class="card-body">

                    <?php if ($isLocked) : ?>
                        <!-- Hiển thị thông báo khóa -->
                        <?php if ($order['status'] === 'completed') : ?>
                        <div class="alert alert-success mb-0 d-flex align-items-center gap-2">
                            <span style="font-size:1.5rem">✅</span>
                            <div>
                                <strong>Đơn hàng đã hoàn thành.</strong><br>
                                <span class="text-muted small">Không thể thay đổi trạng thái nữa.</span>
                            </div>
                        </div>
                        <?php else : ?>
                        <div class="alert alert-danger mb-0 d-flex align-items-center gap-2">
                            <span style="font-size:1.5rem">❌</span>
                            <div>
                                <strong>Đơn hàng đã bị hủy.</strong><br>
                                <span class="text-muted small">Không thể thay đổi trạng thái nữa.</span>
                            </div>
                        </div>
                        <?php endif; ?>

                    <?php else : ?>
                        <!-- Form cập nhật trạng thái -->
                        <form id="statusForm"
                              action="<?= BASE_URL_ADMIN ?>&action=update-order-status&id=<?= $order['id'] ?>"
                              method="POST"
                              class="d-flex gap-3 align-items-end flex-wrap">
                            <div class="flex-grow-1">
                                <label class="form-label fw-semibold mb-1">Trạng thái mới</label>
                                <select name="status" id="statusSelect" class="form-select">
                                    <?php foreach ($statusMap as $key => $val) : ?>
                                    <option value="<?= $key ?>"
                                        <?= $order['status'] === $key ? 'selected' : '' ?>>
                                        <?= $val['label'] ?>
                                    </option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                            <button type="button" class="btn btn-warning fw-bold px-4"
                                    onclick="confirmUpdate()">Lưu</button>
                        </form>
                    <?php endif; ?>

                    <!-- Timeline trạng thái -->
                    <div class="mt-4">
                        <div class="d-flex justify-content-between position-relative">
                            <div style="position:absolute; top:12px; left:0; right:0; height:3px; background:#dee2e6; z-index:0;"></div>
                            <?php
                            $steps = ['pending' => 'Chờ xác nhận', 'confirmed' => 'Đã xác nhận', 'shipping' => 'Đang giao', 'completed' => 'Hoàn thành'];
                            $stepKeys   = array_keys($steps);
                            $currentIdx = array_search($order['status'], $stepKeys);
                            foreach ($steps as $key => $label) :
                                $idx   = array_search($key, $stepKeys);
                                $done  = ($currentIdx !== false && $idx <= $currentIdx && $order['status'] !== 'cancelled');
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

<!-- Modal xác nhận đổi trạng thái -->
<div class="modal fade" id="confirmModal" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header bg-warning text-dark">
                <h5 class="modal-title fw-bold">⚠️ Xác nhận thay đổi trạng thái</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body" id="modalBody">
                Bạn có chắc chắn muốn thay đổi trạng thái đơn hàng không?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Hủy bỏ</button>
                <button type="button" class="btn btn-warning fw-bold" id="confirmBtn"
                        onclick="document.getElementById('statusForm').submit()">
                    Xác nhận
                </button>
            </div>
        </div>
    </div>
</div>

<script>
const statusLabels = {
    pending:   'Chờ xác nhận',
    confirmed: 'Đã xác nhận',
    shipping:  'Đang giao',
    completed: 'Hoàn thành',
    cancelled: 'Đã hủy',
};

// Các trạng thái không thể hoàn tác → cần cảnh báo mạnh hơn
const finalStatuses = ['completed', 'cancelled'];

function confirmUpdate() {
    const select    = document.getElementById('statusSelect');
    const newStatus = select.value;
    const newLabel  = statusLabels[newStatus] ?? newStatus;

    let message = `Bạn có chắc chắn muốn chuyển sang trạng thái <strong>"${newLabel}"</strong> không?`;

    if (finalStatuses.includes(newStatus)) {
        message += `<br><br><span class="text-danger fw-bold">⚠️ Lưu ý: Sau khi chuyển sang trạng thái này, đơn hàng sẽ bị <u>khóa</u> và không thể thay đổi nữa!</span>`;

        // Đổi màu nút xác nhận thành đỏ để nhấn mạnh
        document.getElementById('confirmBtn').className = 'btn btn-danger fw-bold';
    } else {
        document.getElementById('confirmBtn').className = 'btn btn-warning fw-bold';
    }

    document.getElementById('modalBody').innerHTML = message;

    const modal = new bootstrap.Modal(document.getElementById('confirmModal'));
    modal.show();
}
</script>