<?php

class ProductController
{
    public $modelProduct;
    public $modelCat;

    public function __construct()
    {
        $this->modelProduct = new Product();
        $this->modelCat = new Category();
    }

    public function home()
    {
        $title = 'Đây là trang quản trị';
        require_once PATH_VIEW_MAIN_ADMIN;
    }

    public function index()
    {
        $view = 'product/index';
        $title = 'Danh sách Sản phẩm';
        $data = $this->modelProduct->getAll();
        require_once PATH_VIEW_MAIN_ADMIN;
    }

    public function create()
    {
        $view = 'product/create';
        $title = 'Tạo mới sản phẩm';
        $categories = $this->modelCat->getAll();
        require_once PATH_VIEW_MAIN_ADMIN;
    }

    public function store() {
        try {
            $data = $_POST + $_FILES;
            // echo "<pre>";
            // var_dump($data);
        
            if ($data["image"]["size"] > 0) {
                $data["image"] = upload_file('products', $data["image"]);
            }

            // weights
            if (isset($_POST['weights']) && is_array($_POST['weights'])) {
            // Loại bỏ các ô trống và nối lại bằng dấu phẩy
            $data['weights'] = implode(',', array_filter($_POST['weights']));
            } else {
                $data['weights'] = null; 
            }

            $this->modelProduct->insert($data);

        } catch(Exception $ex) {
            throw new Exception("Thao tác tạo mới lỗi");
        }
        header('Location:' .BASE_URL_ADMIN .'&action=create-product');
        exit();
    }
    public function delete()
    {
        try {
            if (!isset($_GET["id"])) {
                throw new Exception("Thiếu tham số id");
            }
            $id = $_GET["id"];
            $pro = $this->modelProduct->find($id);
            if (empty($pro)) {
                throw new Exception("Product không tồn tại id = $id");
            } else {
                $this->modelProduct->delete($id);
            }
        } catch (Exception $er) {
            throw new Exception($er->getMessage());
        }
        header('Location:' . BASE_URL_ADMIN . '&action=list-product');
        exit();
    }



    public function show()
    {
        $id = $_GET['id'] ?? null;
        if (!$id) {
            header('Location: ?mode=admin&action=list-product');
            exit;
        }

        $product = $this->modelProduct->find($id);


        $view =  'product/show';
        $title = 'Chi tiết sản phẩm';
        require_once  PATH_VIEW_MAIN_ADMIN;
    }

    //FORM SỬA
    public function edit()
    {
        $id = $_GET['id'];
        $product = $this->modelProduct->find($id);


        $categoryModel = new Category();
        $categories = $categoryModel->getAll();

        $view =  'product/edit';
        $title = 'Thay đổi sản phẩm';

        require_once PATH_VIEW_MAIN_ADMIN;
    }

    //CẬP NHẬT
    public function update()
    {
        $id = $_GET['id'] ?? null;


        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $data = [
                'category_id' => $_POST['category_id'],
                'name'        => $_POST['name'],
                'description' => $_POST['description'],
                'price'       => $_POST['price'],
                'quantity'    => $_POST['quantity'],
                'weights'     => $_POST['weights'],
            ];


            $file = $_FILES['image'];

            if (!is_numeric($data['price']) || $data['price'] < 0 || floor($data['price']) != $data['price']) {
                die("Giá phải là số nguyên không âm");
            }

            if (!is_numeric($data['quantity']) || $data['quantity'] < 0 || floor($data['quantity']) != $data['quantity']) {
                die("Số lượng phải là số nguyên không âm");
            }

        
        $this->modelProduct->update($id, $data);

        
        header('Location: ?mode=admin&action=list-product');
        exit;
    }
}
    
}