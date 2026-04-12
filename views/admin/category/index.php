<div class="d-flex align-items-center justify-content-between mb-3">
    <p class="text-muted mb-0" style="font-size:13px;">Quản lý danh mục sản phẩm</p>
    <a href="<?= BASE_URL_ADMIN . '&action=create-category' ?>" class="btn btn-primary">
        <i class="fas fa-plus me-1"></i> Thêm danh mục
    </a>
</div>

<div class="card">
    <div class="card-body p-0">
        <table class="table mb-0">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Tên danh mục</th>
                    <th class="text-center">Thao tác</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach($data as $cat) : ?>
                <tr>
                    <td class="text-muted"><?= $cat['id'] ?></td>
                    <td>
                        <div class="d-flex align-items-center gap-2">
                            <div style="width:8px;height:8px;border-radius:50%;background:#6366f1;flex-shrink:0;"></div>
                            <span style="font-weight:500;"><?= htmlspecialchars($cat['name']) ?></span>
                        </div>
                    </td>
                    <td class="text-center">
                        <a href="<?= BASE_URL_ADMIN . '&action=edit-category&id=' . $cat['id'] ?>" class="btn btn-sm btn-warning"><i class="fas fa-pen me-1"></i>Sửa</a>
                        <a href="<?= BASE_URL_ADMIN . '&action=delete-category&id=' . $cat['id'] ?>"
                           onclick="return confirm('Xóa danh mục này?')"
                           class="btn btn-sm btn-danger"><i class="fas fa-trash me-1"></i>Xóa</a>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
        <?php if(empty($data)): ?>
        <div class="text-center py-5 text-muted">
            <i class="fas fa-layer-group fa-3x mb-3 opacity-25"></i>
            <p>Chưa có danh mục nào.</p>
        </div>
        <?php endif; ?>
    </div>
</div>
