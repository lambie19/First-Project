
<?php
class DetailProductController {
    private $productModel;
    private $commentModel;

    public function __construct() {
        $this->productModel = new Product();
        $this->commentModel = new Comment(); 
    }

    public function show() {
        try {
            if(!isset($_GET["id"])) {
                throw new Exception("K tồn tại tham số ID trên URL");
            }
            $id = $_GET["id"];
            
            $pro = $this->productModel->find($id);
            if(empty($pro)) {
                throw new Exception("ID k tồn tại trong CSDL");
            }
            $view_count = $pro["view_count"] + 1;
            $this->productModel->updateViewCount($view_count, $id);
            $pro['view_count'] = $view_count; 
            
        
            $comments = $this->commentModel->getCommentsByProductID($id);
            
            
            $averageRating = 4.5; 
            $totalReviews = 25; 
            
            $view = 'detail-product';
            require_once PATH_VIEW_MAIN_CLIENT;

        }catch (Exception $ex){
            throw new Exception("có lỗi xảy ra: " . $ex->getMessage());
        }
    }
    
    public function storeComment() {
        if (!isset($_SESSION['user_id'])) {
            header('Location: ' . BASE_URL . '?action=login'); 
            exit();
        }
        
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            
            
            $product_id = filter_var($_POST['product_id'] ?? 0, FILTER_VALIDATE_INT);
            $content = trim($_POST['content'] ?? '');
            $user_id = filter_var($_SESSION['user_id'] ?? 0, FILTER_VALIDATE_INT);
            
            if ($product_id > 0 && $user_id > 0 && !empty($content)) { 
                
                $this->commentModel->insertComment($product_id, $user_id, $content);
                
            } else {
                $_SESSION['comment_error'] = "Dữ liệu bình luận không hợp lệ.";
            }
        }

        header('Location: ' . BASE_URL . '?action=detail-product&id=' . $product_id);
        exit();
    }
}