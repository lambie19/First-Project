<div class="col-12">

    <?php
    $statusMap = [
        'pending'   => ['label' => 'Chờ xác nhận', 'class' => 'bg-warning text-dark'],
        'confirmed' => ['label' => 'Đã xác nhận',  'class' => 'bg-info text-dark'],
        'shipping'  => ['label' => 'Đang giao',    'class' => 'bg-primary'],
        'completed' => ['label' => 'Hoàn thành',   'class' => 'bg-success'],
        'cancelled' => ['label' => 'Đã hủy',       'class' => 'bg-danger'],
    ];
    ?>

    <!-- Thống kê nhanh -->
    <div class="row g-3 mb-4">
        <?php
        $counts = ['pending' => 0, 'confirmed' => 0, 'shipping' => 0, 'completed' => 0, 'cancelled' => 0];
        $total_revenue = 0;
        foreach ($data as $o) {
            if (isset($counts[$o['status']])) $counts[$o['status']]++;
            if ($o['status'] === 'completed') $total_revenue += $o['total_price'];
        }
        ?>
        <div class="col-6 col-md-2">
            <div class="card text-center border-0 shadow-sm">
                <div class="card-body py-3">
                    <div class="fs-3 fw-bold text-dark"><?= count($data) ?></div>
                    <div class="small text-muted">Tất cả</div>
                </div>
            </div>
        </div>
        <div class="col-6 col-md-2">
            <div class="card text-center border-0 shadow-sm">
                <div class="card-body py-3">
                    <div class="fs-3 fw-bold text-warning"><?= $counts['pending'] ?></div>
                    <div class="small text-muted">Chờ xác nhận</div>
                </div>
            </div>
        </div>
        <div class="col-6 col-md-2">
            <div class="card text-center border-0 shadow-sm">
                <div class="card-body py-3">
                    <div class="fs-3 fw-bold text-primary"><?= $counts['shipping'] ?></div>
                    <div class="small text-muted">Đang giao</div>
                </div>
            </div>
        </div>
        <div class="col-6 col-md-2">
            <div class="card text-center border-0 shadow-sm">
                <div class="card-body py-3">
                    <div class="fs-3 fw-bold text-success"><?= $counts['completed'] ?></div>
                    <div class="small text-muted">Hoàn thành</div>
                </div>
            </div>
        </div>
        <div class="col-6 col-md-2">
            <div class="card text-center border-0 shadow-sm">
                <div class="card-body py-3">
                    <div class="fs-3 fw-bold text-danger"><?= $counts['cancelled'] ?></div>
                    <div class="small text-muted">Đã hủy</div>
                </div>
            </div>
        </div>
        <div class="col-6 col-md-2">
            <div class="card text-center border-0 shadow-sm bg-success-subtle">
                <div class="card-body py-3">
                    <div class="fs-6 fw-bold text-success"><?= number_format($total_revenue) ?>đ</div>
                    <div class="small text-muted">Doanh thu</div>
                </div>
            </div>
        </div>
    </div>

    <!-- Bảng đơn hàng -->
    <?php if (empty($data)) : ?>
    <div class="alert alert-info">Chưa có đơn hàng nào.</div>
    <?php else : ?>
    <div class="card shadow-sm">
        <div class="card-body p-0">
            <table class="table table-hover align-middle mb-0">
                <thead class="table-dark">
                    <tr>
                        <th class="ps-3">#ID</th>
                        <th>Khách hàng</th>
                        <th>Số điện thoại</th>
                        <th>Tổng tiền</th>
                        <th>Sản phẩm</th>
                        <th>Trạng thái</th>
                        <th>Ngày đặt</th>
                        <th class="text-center">Hành động</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($data as $order) :
                        $st = $statusMap[$order['status']] ?? ['label' => $order['status'], 'class' => 'bg-secondary'];
                    ?>
                    <tr>
                        <td class="ps-3"><strong>#<?= $order['id'] ?></strong></td>
                        <td><?= htmlspecialchars($order['customer_name']) ?></td>
                        <td><?= htmlspecialchars($order['customer_phone']) ?></td>
                        <td class="text-danger fw-bold"><?= number_format($order['total_price']) ?>đ</td>
                        <td><span class="badge bg-secondary"><?= $order['total_items'] ?> SP</span></td>
                        <td><span class="badge <?= $st['class'] ?>"><?= $st['label'] ?></span></td>
                        <td><?= date('d/m/Y H:i', strtotime($order['created_at'])) ?></td>
                        <td class="text-center">
                            <a href="<?= BASE_URL_ADMIN ?>&action=show-order&id=<?= $order['id'] ?>"
                               class="btn btn-primary btn-sm">Chi tiết</a>
                            <a href="<?= BASE_URL_ADMIN ?>&action=delete-order&id=<?= $order['id'] ?>"
                               class="btn btn-danger btn-sm"
                               onclick="return confirm('Xóa đơn hàng #<?= $order['id'] ?>?')">Xóa</a>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
    <?php endif; ?>
</div>
