<div class="row"> <div class="col-12"> <div class="container-fluid">
            <div class="row mb-4 mt-3 border-bottom pb-3">
                <div class="col-md-8">
                    <h3 class="fw-bold">Chi tiết Sản phẩm: <?= $product['name'] ?></h3>
                    <span class="text-muted">Mã: SP<?= $product['id'] ?></span>
                </div>
                <div class="col-md-4 text-end">
                    <a href="?mode=admin&action=list-product" class="btn btn-secondary me-2">
                        <i class="fas fa-arrow-left me-1"></i> Quay lại danh sách
                    </a>
                </div>
            </div>

            <div class="card shadow-lg border-0">
                <div class="card-body p-4">
                    <div class="row">
                        
                        <div class="col-md-4 text-center border-end pe-4">
                            <h5 class="mb-3 text-muted">Ảnh Sản phẩm</h5>
                            <div class="d-flex justify-content-center align-items-center bg-light rounded" style="height: 300px; padding: 10px;">
                                <img src="<?= BASE_ASSETS_UPLOADS . $product['image'] ?>" 
                                     alt="Ảnh sản phẩm" 
                                     class="img-fluid rounded shadow-sm" 
                                     style="max-width: 100%; max-height: 100%; object-fit: contain;">
                            </div>
                        </div>

                        <div class="col-md-8 ps-4">
                            <h4 class="mb-4 fw-bold"><?= $product['name'] ?></h4>
                            
                            <div class="row mb-3 align-items-center py-2 border-bottom">
                                <div class="col-4 fw-bold text-muted">Mã sản phẩm:</div>
                                <div class="col-8">SP<?= $product['id'] ?></div>
                            </div>
                            
                            <div class="row mb-3 align-items-center py-2 border-bottom">
                                <div class="col-4 fw-bold text-muted">Giá bán:</div>
                                <div class="col-8 text-danger fs-5 fw-bold">
                                    <?= number_format($product['price']) ?> VNĐ
                                </div>
                            </div>

                            <div class="row mb-3 align-items-center py-2 border-bottom">
                                <div class="col-4 fw-bold text-muted">Danh mục:</div>
                                <div class="col-8">
                                    <?= $product['category_name'] ?? $product['category_id'] ?>
                                </div>
                            </div>

                            <div class="row mb-3 align-items-center py-2 border-bottom">
                                <div class="col-4 fw-bold text-muted">Số lượng tồn kho:</div>
                                <div class="col-8 text-success fw-bold">
                                    <?= $product['quantity'] ?>
                                </div>
                            </div>
                            
                            <div class="row mb-3 align-items-center py-2 border-bottom">
                                <div class="col-4 fw-bold text-muted">Lượt xem (Giả định):</div>
                                <div class="col-8">
                                    <?= $product['view_count'] ?? 'N/A' ?>
                                </div>
                            </div>
                            
                        </div>
                    </div>
                    
                    <hr class="my-5">
                    
                    <div class="row">
                        <div class="col-12">
                            <h5 class="mb-3 fw-bold border-bottom pb-2">Mô tả Sản phẩm</h5>
                            <div class="border p-4 bg-light rounded shadow-sm" style="white-space: pre-wrap; min-height: 150px;">
                                <?= $product['description'] ?>
                            </div>
                        </div>
                    </div>

                    <div class="mt-4 pt-3 border-top text-end">
                        <a href="?mode=admin&action=edit-product&id=<?= $product['id'] ?>" class="btn btn-warning me-2 shadow-sm">
                            <i class="fas fa-edit me-1"></i> Sửa sản phẩm này
                        </a>
                        <a href="?mode=admin&action=delete-product&id=<?= $product['id'] ?>" 
                           class="btn btn-danger shadow-sm"
                           onclick="return confirm('Bạn có chắc chắn muốn xóa sản phẩm này không?');">
                           <i class="fas fa-trash-alt me-1"></i> Xóa sản phẩm
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>