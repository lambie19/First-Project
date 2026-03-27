<div class="container-fluid">
    <div class="row mb-4 mt-3 border-bottom pb-3">
        <div class="col-md-8">
            <h3 class="fw-bold">Cập nhật Sản phẩm: <?= $product['name'] ?></h3>
            <span class="text-muted">Mã: SP<?= $product['id'] ?></span>
        </div>
        <div class="col-md-4 text-end">
            <a href="?mode=admin&action=list-product" class="btn btn-secondary me-2">
                <i class="fas fa-arrow-left me-1"></i> Quay lại danh sách
            </a>
        </div>
    </div>

    <form action="?mode=admin&action=update-product&id=<?= $product['id'] ?>" method="POST" enctype="multipart/form-data">
        <div class="card shadow-lg border-0">
            <div class="card-body p-4">
                <div class="row">

                    <div class="col-md-4 text-center border-end pe-4">
                        <h5 class="mb-3 text-muted">Ảnh Sản phẩm</h5>
                        <div class="d-flex justify-content-center align-items-center bg-light rounded" style="height: 250px; padding: 10px;">
                            <img src="<?= BASE_ASSETS_UPLOADS . $product['image'] ?>" 
                                 alt="Ảnh sản phẩm hiện tại" 
                                 class="img-fluid rounded shadow-sm" 
                                 style="max-width: 100%; max-height: 100%; object-fit: contain;">
                            
                            <input type="hidden" name="current_image" value="<?= $product['image'] ?>">
                        </div>
                        
                        <div class="form-group mt-3 text-start">
                            <label for="image" class="form-label">Chọn ảnh mới (Nếu muốn thay đổi)</label>
                            <input type="file" class="form-control" name="image" id="image">
                        </div>
                    </div>

                    <div class="col-md-8 ps-4">
                        
                        <div class="row mb-3 align-items-center py-2 border-bottom">
                            <div class="col-4 fw-bold text-muted">Tên sản phẩm:</div>
                            <div class="col-8">
                                <input type="text" class="form-control" name="name" id="name" 
                                       value="<?= $product['name'] ?>">
                            </div>
                        </div>
                        
                        <div class="row mb-3 align-items-center py-2 border-bottom">
                            <div class="col-4 fw-bold text-muted">Danh mục:</div>
                            <div class="col-8">
                                <select class="form-select" name="category_id" id="category_id">
                                    <?php foreach ($categories as $cat): ?>
                                        <option value="<?= $cat['id'] ?>" 
                                            <?= ($cat['id'] == $product['category_id']) ? 'selected' : '' ?>
                                        >
                                            <?= $cat['name'] ?>
                                        </option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                        </div>

                        <div class="row mb-3 align-items-center py-2 border-bottom">
                            <div class="col-4 fw-bold text-muted">Giá bán (VNĐ):</div>
                            <div class="col-8">
                                <input type="number" class="form-control" name="price" id="price" 
                                       value="<?= $product['price'] ?>">
                            </div>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Trọng lượng (nhập từng mức, cách nhau bằng dấu phẩy)</label>
                            <input 
                                type="text" 
                                class="form-control" 
                                name="weights" 
                                placeholder="Ví dụ: 300g,500g,1kg"
                                value="<?= htmlspecialchars($product['weights'] ?? '') ?>"
                            >
                            <small class="text-muted">Nhập các mức trọng lượng cách nhau bằng dấu phẩy</small>
                        </div>

                        <div class="row mb-3 align-items-center py-2 border-bottom">
                            <div class="col-4 fw-bold text-muted">Số lượng tồn kho:</div>
                            <div class="col-8">
                                <input type="number" class="form-control" name="quantity" id="quantity" 
                                       value="<?= $product['quantity'] ?>">
                            </div>
                        </div>
                        
                    </div>
                </div>
                
                <hr class="my-5">
                
                <div class="row">
                    <div class="col-12">
                        <h5 class="mb-3 fw-bold border-bottom pb-2">Mô tả Sản phẩm</h5>
                        <div class="form-group">
                            <textarea class="form-control" name="description" id="description" rows="5"><?= $product['description'] ?></textarea>
                        </div>
                    </div>
                </div>

                <div class="mt-4 pt-3 border-top text-end">
                    <button type="submit" class="btn btn-warning me-2 shadow-sm">
                        <i class="fas fa-edit me-1"></i> Lưu cập nhật
                    </button>
                    <a href="?mode=admin&action=list-product" class="btn btn-secondary shadow-sm">
                        <i class="fas fa-undo me-1"></i> Hủy
                    </a>
                </div>
            </div>
        </div>
    </form>
</div>

