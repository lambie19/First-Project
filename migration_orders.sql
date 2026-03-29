-- ============================================================
-- MIGRATION: Tạo bảng orders và order_items
-- Chạy file này trong phpMyAdmin hoặc MySQL CLI trước khi dùng
-- ============================================================

CREATE TABLE IF NOT EXISTS `orders` (
    `id`               INT           AUTO_INCREMENT PRIMARY KEY,
    `customer_name`    VARCHAR(255)  NOT NULL            COMMENT 'Tên người nhận',
    `customer_phone`   VARCHAR(20)   NOT NULL            COMMENT 'Số điện thoại',
    `customer_address` TEXT          NOT NULL            COMMENT 'Địa chỉ giao hàng',
    `note`             TEXT                              COMMENT 'Ghi chú',
    `total_price`      DECIMAL(15,0) NOT NULL            COMMENT 'Tổng tiền',
    `status`           ENUM('pending','confirmed','shipping','completed','cancelled')
                       NOT NULL DEFAULT 'pending'        COMMENT 'Trạng thái đơn hàng',
    `created_at`       DATETIME DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE IF NOT EXISTS `order_items` (
    `id`         INT           AUTO_INCREMENT PRIMARY KEY,
    `order_id`   INT           NOT NULL COMMENT 'ID đơn hàng',
    `product_id` INT           NOT NULL COMMENT 'ID sản phẩm',
    `quantity`   INT           NOT NULL COMMENT 'Số lượng đặt',
    `price`      DECIMAL(15,0) NOT NULL COMMENT 'Giá tại thời điểm đặt',
    FOREIGN KEY (`order_id`)   REFERENCES `orders`(`id`)   ON DELETE CASCADE,
    FOREIGN KEY (`product_id`) REFERENCES `products`(`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
