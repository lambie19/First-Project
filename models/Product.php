<?php
class Product extends BaseModel {
    public function getAll() {
        $sql = 'SELECT pro.*, cat.name as cat_name FROM `products` as pro JOIN categories as cat ON pro.category_id = cat.id ORDER BY pro.id DESC;';
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll();
    }

    public function insert($data) {
    $sql = "INSERT INTO `products` (`id`, `category_id`, `name`, `description`, `price`, `quantity`, `image`, `weights`) VALUES 
    (NULL, :category_id, :name, :description, :price, :quantity, :image, :weights)";
    $stmt = $this->pdo->prepare($sql);
    $stmt->execute([
        'category_id' => $data['category_id'],
        'name'        => $data['name'],
        'description' => $data['description'],
        'price'       => $data['price'],
        'quantity'    => $data['quantity'],
        'image'       => $data['image'],
        'weights'     => $data['weights'] ?? null,
    ]);
}


    public function find($id) {
        $sql = "SELECT * FROM products WHERE id = :id";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute(['id' => $id]);
        return $stmt->fetch();
    }

public function update($id, $data) {
    $sql = "UPDATE products SET 
                category_id = :category_id,
                name        = :name,
                description = :description,
                price       = :price,
                quantity    = :quantity,
                image       = :image,
                weights     = :weights
            WHERE id = :id";
    $stmt = $this->pdo->prepare($sql);
    $stmt->execute([
        'category_id' => $data['category_id'],
        'name'        => $data['name'],
        'description' => $data['description'],
        'price'       => $data['price'],
        'quantity'    => $data['quantity'],
        'image'       => $data['image'],
        'weights'     => $data['weights'] ?? null,
        'id'          => $id,
    ]);
}

    public function delete($id) {
        $sql = "DELETE FROM products WHERE id = $id";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute();
    }



    public function top4Lastest() {
        $sql = "SELECT * FROM products ORDER BY id DESC LIMIT 8";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll();
    }


    public function top4View() {
        $sql = "SELECT * FROM products ORDER BY id DESC LIMIT 4";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll();
    }

    public function updateViewCount($view_count, $id) {
        $sql = "UPDATE `products` SET `view_count` = $view_count WHERE `products`.`id` = $id;";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute();
    }

    public function getProductsByCategoryID($category_id) {
        $sql = 'SELECT pro.*, cat.name as cat_name 
            FROM `products` as pro 
            JOIN categories as cat ON pro.category_id = cat.id 
            WHERE pro.category_id = :category_id 
            ORDER BY pro.id DESC';
        
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute(['category_id' => $category_id]);
        return $stmt->fetchAll();
    }
}

?>