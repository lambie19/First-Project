<?php
class UserController
{
    public $modelUser;

    public function __construct() {
        $this->modelUser = new User();
    }

    public function index() {
        $view = 'user/index'; 
        $title = 'Danh sách Người dùng';
        $data = $this->modelUser->getAll();
        
        require_once PATH_VIEW_MAIN_ADMIN;
    }

    public function edit() {
        $id = $_GET['id'] ?? null;
        if(!$id) {
            throw new Exception("Thiếu tham số id");
        }
        $user = $this->modelUser->find($id);
        if(empty($user)) {
            throw new Exception("Tài khoản k tồn tại");
        }

        $view = 'user/edit';
        $title = 'Sửa Tài khoản: ' . $user['username'];
        $data = $user;
        
        require_once PATH_VIEW_MAIN_ADMIN;
    }

    public function update() {
        $id = $_GET['id'] ?? null;
        if ($_SERVER['REQUEST_METHOD'] == 'POST' && $id) {
            $data = [
                'username' => $_POST['username'] ?? '',
                'email'    => $_POST['email'] ?? ''
            ];
            
            if (empty($data['username']) || empty($data['email'])) {
                throw new Exception("Tên tài khoản và email không được để trống.");
            }
            
            $this->modelUser->update($id, $data);
            
            header('Location: ' . BASE_URL_ADMIN . '&action=list-user');
            exit;
        }
        
        header('Location: ' . BASE_URL_ADMIN . '&action=list-user');
        exit;
    }

    public function lock(): void {
        $id = $_GET['id'] ?? 0;
        
        if($id > 0) {
            $this->modelUser->updateStatus((int)$id, 0);
        }

        header('Location: ' . BASE_URL_ADMIN . '&action=list-user');
        exit();
    }

    public function unlock() {
        $id = $_GET['id'] ?? 0;
        
        if ($id > 0) {
            $this->modelUser->updateStatus((int)$id, 1); 
        }
        
        header('Location: ' . BASE_URL_ADMIN . '&action=list-user');
        exit();
    }
}