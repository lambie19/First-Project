<div class="card">
    <div class="card-header">
        <h3 class="card-title"><?= $title ?></h3>
        <a href="<?= BASE_URL_ADMIN . '&action=create-category' ?>" class="btn btn-primary float-right">Thêm mới</a>
    </div>
    <div class="card-body">
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th style="width: 10px">ID</th>
                    <th>Tên danh mục</th>
                    <th style="width: 150px">Thao tác</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach($data as $cat) : ?>
                    <tr>
                        <td><?= $cat['id'] ?></td>
                        <td><?= $cat['name'] ?></td>
                        <td>
                            <a href="<?= BASE_URL_ADMIN . '&action=edit-category&id=' . $cat['id'] ?>" class="btn btn-warning btn-sm">Sửa</a>
                            <a href="<?= BASE_URL_ADMIN . '&action=delete-category&id=' . $cat['id'] ?>" class="btn btn-danger btn-sm" onclick="return confirm('Bạn có chắc chắn muốn xóa?')">Xóa</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div> 