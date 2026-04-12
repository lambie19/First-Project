<div class="d-flex align-items-center justify-content-between mb-3">
    <p class="text-muted mb-0" style="font-size:13px;">Quản lý tài khoản người dùng trong hệ thống</p>
</div>

<div class="card">
    <div class="card-body p-0">
        <table class="table mb-0">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Tên tài khoản</th>
                    <th>Email</th>
                    <th>Quyền</th>
                    <th>Trạng thái</th>
                    <th class="text-center">Thao tác</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach($data as $user) : ?>
                <tr>
                    <td class="text-muted"><?= $user['id'] ?></td>
                    <td>
                        <div class="d-flex align-items-center gap-2">
                            <div style="width:32px;height:32px;border-radius:8px;background:linear-gradient(135deg,#6366f1,#8b5cf6);display:flex;align-items:center;justify-content:center;color:#fff;font-weight:700;font-size:13px;flex-shrink:0;">
                                <?= strtoupper(substr($user['username'],0,1)) ?>
                            </div>
                            <span style="font-weight:600;"><?= htmlspecialchars($user['username']) ?></span>
                        </div>
                    </td>
                    <td class="text-muted"><?= htmlspecialchars($user['email']) ?></td>
                    <td>
                        <?php if($user['is_main'] == 1): ?>
                            <span class="badge" style="background:#ede9fe;color:#7c3aed;"><i class="fas fa-shield-halved me-1"></i>Admin</span>
                        <?php else: ?>
                            <span class="badge bg-secondary-subtle text-secondary">Người dùng</span>
                        <?php endif; ?>
                    </td>
                    <td>
                        <?php if(($user['status']??1) == 1): ?>
                            <span class="badge bg-success-subtle text-success"><i class="fas fa-circle me-1" style="font-size:8px;"></i>Hoạt động</span>
                        <?php else: ?>
                            <span class="badge bg-danger-subtle text-danger"><i class="fas fa-circle me-1" style="font-size:8px;"></i>Đã khóa</span>
                        <?php endif; ?>
                    </td>
                    <td class="text-center">
                        <a href="<?= BASE_URL_ADMIN . '&action=edit-user&id=' . $user['id'] ?>" class="btn btn-sm btn-warning"><i class="fas fa-pen me-1"></i>Sửa</a>
                        <?php if(($user['status']??1) == 1): ?>
                            <a href="<?= BASE_URL_ADMIN . '&action=lock-user&id=' . $user['id'] ?>"
                               onclick="return confirm('Khóa tài khoản này?')"
                               class="btn btn-sm btn-danger"><i class="fas fa-lock me-1"></i>Khóa</a>
                        <?php else: ?>
                            <a href="<?= BASE_URL_ADMIN . '&action=unlock-user&id=' . $user['id'] ?>"
                               onclick="return confirm('Mở khóa tài khoản này?')"
                               class="btn btn-sm btn-success"><i class="fas fa-lock-open me-1"></i>Mở khóa</a>
                        <?php endif; ?>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
        <?php if(empty($data)): ?>
        <div class="text-center py-5 text-muted">
            <i class="fas fa-users fa-3x mb-3 opacity-25"></i>
            <p>Chưa có người dùng nào.</p>
        </div>
        <?php endif; ?>
    </div>
</div>
