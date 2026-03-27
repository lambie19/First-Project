<table class="table table-striped">
    <thead>
        <tr>
            <th>ID</th>
            <th>Người dùng</th>
            <th>Sản phẩm</th>
            <th>Nội dung</th>
            <th>Ngày tạo</th>
            <th>Trạng thái</th>
            <th>Hành động</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach($data as $cmt) :?>
        <tr>
            <td><?= $cmt["id"] ?></td>
            <td><?= $cmt["username"] ?></td>
            <td><?= $cmt["product_name"] ?></td>
            <td><?= $cmt["content"] ?></td>
            <td><?= $cmt["created_at"] ?></td>
            <td>
                <?php if ($cmt["status"] == 1): ?>
                    <span class="text-success">Hiển thị</span>
                <?php else: ?>
                    <span class="text-danger">Ẩn</span>
                <?php endif; ?>
            </td>
            <td>
                <a href="?action=update-comment&id=<?= $cmt['id'] ?>&status=<?= ($cmt['status'] == 1) ? 0 : 1 ?>" class="btn btn-primary">
                    <?= ($cmt['status'] == 1) ? 'Ẩn comment' : 'Hiển thị comment' ?>
                </a>
                <a href="?action=delete-comment&id=<?= $cmt['id'] ?>" 
                   class="btn btn-danger"
                   onclick="return confirm('Bạn có chắc chắn muốn xóa bình luận này?');">Xóa</a>
            </td>
        </tr>
        <?php endforeach; ?>
    </tbody>
</table>