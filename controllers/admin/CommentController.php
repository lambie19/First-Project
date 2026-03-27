<?php
class CommentController
{
    public $modelComment;

    public function __construct() {
        $this->modelComment = new Comment();
    }

    public function index() {
        $view = 'comment/index'; 
        $title = 'Danh sách Bình luận';
        $data = $this->modelComment->getAll();
        
        require_once PATH_VIEW_MAIN_ADMIN;
    }

    // 2. Lưu bình luận mới (Client - dành cho sản phẩm)
    public function storeComment() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $data = [
                'noi_dung'   => $_POST['noi_dung'],
                'id_user'    => $_SESSION['user']['id'], // Lấy ID người dùng từ session
                'id_san_pham'=> $_POST['id_san_pham'],
                'ngay_dang'  => date('Y-m-d H:i:s'),
                'trang_thai' => 1 // Mặc định là hiển thị
            ];

            $this->modelComment->insertComment(
                $_POST['id_san_pham'], 
                $_SESSION['user']['id'], 
                $_POST['noi_dung']
            );

            // Quay lại trang chi tiết sản phẩm sau khi bình luận
            header('Location: ?action=detail-product&id=' . $_POST['id_san_pham']);
            exit();
        }
    }

    // 3. Xóa bình luận
    public function destroy() {
        $id = $_GET['id'] ?? null;
        if ($id) {
            $this->modelComment->delete($id);
            header('Location: ?action=list-comment'); // Hoặc action quản lý của bạn
            exit();
        }
    }

    // 4. Thay đổi trạng thái (Ẩn/Hiện bình luận nếu cần mod)
    public function updateStatus() {
        $id = $_GET['id'] ?? null;
        $status = $_GET['status'] ?? 0;
        if ($id) {
            $this->modelComment->update($id, $status);
            header('Location: ?action=list-comment');
            exit();
        }
    }
}