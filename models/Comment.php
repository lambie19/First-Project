<?php
class Comment extends BaseModel {
    public function getAll() {
        $sql = "SELECT 
                    c.id, 
                    c.content, 
                    c.created_at, 
                    c.status, 
                    u.username, 
                    p.name as product_name
                FROM comments as c
                JOIN users as u ON c.user_id = u.id
                JOIN products as p ON c.product_id = p.id
                ORDER BY c.created_at DESC";
                
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll();
    }
    public function getCommentsByProductID($product_id) {
        
        $sql = "SELECT c.*, u.username as user_name 
                FROM comments as c
                JOIN users as u ON c.user_id = u.id
                WHERE c.product_id = :product_id AND c.status = 1
                ORDER BY c.created_at DESC";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute(['product_id' => $product_id]);
        return $stmt->fetchAll();
    }

    public function insertComment($product_id, $user_id, $content) {
        $sql = "INSERT INTO comments (product_id, user_id, content, status) VALUES (?, ?, ?, 1)";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([$product_id, $user_id, $content]);
    }

    public function delete($id) {
    $sql = "DELETE FROM comments WHERE id = ?";
    $stmt = $this->pdo->prepare($sql);
    return $stmt->execute([$id]);
}

    public function update($id, $status) {
        $sql = "UPDATE comments SET status = ? WHERE id = ?";
        $stmt = $this->pdo->prepare($sql);
        return $stmt->execute([$status, $id]);
    }
}