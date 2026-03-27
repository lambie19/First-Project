<div class="card">
    <div class="card-header">
        <h3 class="card-title"><?= $title ?></h3>
    </div>
    <div class="card-body">
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th style="width: 10px">ID</th>
                    <th>Tên tài khoản (Username)</th>
                    <th>Email</th>
                    <th>Quyền (Admin)</th>
                    <th>Trạng thái (Khóa/Mở)</th>
                    <th style="width: 180px">Thao tác</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach($data as $user) : ?>
                    <tr>
                        <td><?= $user['id'] ?></td>
                        <td><?= $user['username'] ?></td>
                        <td><?= $user['email'] ?></td>
                        <td>
                            <?php 
                                if ($user['is_main'] == 1) {
                                    echo '<span class="badge bg-primary">Admin</span>';
                                } else {
                                    echo '<span class="badge bg-secondary">User</span>';
                                }
                            ?>
                        </td>
                        <td>
                            <?php 
                                if (($user['status'] ?? 1) == 1) { 
                                    echo '<span class="badge bg-success">Hoạt động</span>';
                                } else {
                                    echo '<span class="badge bg-danger">Đã khóa</span>';
                                }
                            ?>
                        </td>
                        <td>
                            <a href="<?= BASE_URL_ADMIN . '&action=edit-user&id=' . $user['id'] ?>" class="btn btn-warning btn-sm">Sửa</a>
                            
                            <?php if (($user['status'] ?? 1) == 1) : ?>
                                <a href="<?= BASE_URL_ADMIN . '&action=lock-user&id=' . $user['id'] ?>" class="btn btn-danger btn-sm" onclick="return confirm('Bạn có chắc chắn muốn khóa tài khoản này?')">Khóa</a>
                            <?php else : ?>
                                <a href="<?= BASE_URL_ADMIN . '&action=unlock-user&id=' . $user['id'] ?>" class="btn btn-success btn-sm" onclick="return confirm('Bạn có chắc chắn muốn mở khóa tài khoản này?')">Mở khóa</a>
                            <?php endif; ?>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>