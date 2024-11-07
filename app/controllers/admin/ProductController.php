<?php

namespace App\Controllers\Admin;
use App\Controllers\BaseController;
use App\Controllers\ICrud;
use App\Models\product;
use App\Models\Category;
use App\Models\Image;

class ProductController extends BaseController implements ICrud
{
    public $productModel;
    public $categoryModel;
    public $imageModel;
    public $route;

    public function __construct()
    {
        $this->productModel = new product();
        $this->categoryModel = new Category();
        $this->imageModel = new Image();
        // $this->route = new Route();
    }

    public function index()
    {
        $countProduct = $this->productModel->countProduct();
        $total_pages = ceil($countProduct->count / 5);
   
    
      
        $current_page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
        if ($current_page > $total_pages) {
            $current_page = $total_pages;
        }
        if ($current_page < 1) {
            $current_page = 1;
        }
        
        // Tính toán OFFSET
        $offset = ($current_page - 1) * 5;
        // var_dump($offset);
        // die();
        $product = $this->productModel->list($offset);
        // var_dump($product);
        // die();
      
        $cate = $this->categoryModel->allTable();
        $paginationPages = $this -> getPaginationPages($total_pages, 5);
      
        $arr = ['products' => $product,'cate' => $cate ,'paginationPages' => $paginationPages,'visiblePages'=> 5,'totalPages'=>$total_pages ,'currentPage'=>$current_page];
        $this->render('admin.product.list' ,$arr );
    }
    public function create()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            
            $page =$_GET['page'] ; 
            $product_name = $_POST['product_name'];
            $price = $_POST['product_price'];
            $product_des = $_POST['product_des'];
            $stock = $_POST['product_quantity'];
            $category_id = $_POST['category_id'];
            $details = empty($_POST['Details']) ? 1: $_POST['Details'] ;
        
            $data = array(
                'product_name' => $product_name,
                'price' => $price,
                'product_des' => $product_des,
                'stock' => $stock,
                'category_id' => $category_id,
                'view' => 0,
                'status' => 1,
                'Detail_status' => $details,
            );
            $errnor =  $this->validateProductData($data);
            if(count($errnor) > 0){
                flash('errors_add',$errnor ,"admin/products");
            }
            $id = $this->productModel->insertTable($data);
            $dataImg = array(
                'path' => $_FILES['img']['name'],
                'product_id' => $id,
                'role' => 1,
            );

            $dir = 'public/img/products/';
            move_uploaded_file($_FILES['img']['tmp_name'], $dir . $_FILES['img']['name']);
            $this->imageModel->insertTable($dataImg);

            $name = array();

            foreach ($_FILES['images']['name'] as $file) {
                $name[] = $file;
            }
            foreach ($_FILES['images']['tmp_name'] as $file) {
                $tmp_name[] = $file;
            }
            foreach ($name as $file => $key) {

                move_uploaded_file($tmp_name[$file], $dir . $key);
                $dataImgs = array(
                    'path' => $key,
                    'product_id' => $id,
                    'role' => 0,
                );
                $this->imageModel->insertTable($dataImgs);
            }


            flash('success','thêm thành công','admin/products');
        }
    }
    public function update()
    {

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $page =$_GET['page'] ; 
            $id = $_POST['id'];
            $product_name = $_POST['product_name'];
            $price = $_POST['product_price'];
            $product_des = $_POST['product_des'];
            $stock = $_POST['product_quantity'];
            $category_id = $_POST['category_id'];
            // $details = $_POST['Details'];
            $data = array(
                'product_name' => $product_name,
                'price' => $price,
                'product_des' => $product_des,
                'stock' => $stock,
                'category_id' => $category_id,
                'view' => 0,
                'status' => 1,
                // 'Detail_status' => $details,
            );
            $errnor =  $this->validateProductData($data);
            $_SESSION['errors_edit_id'] = $id;
            if(count($errnor) > 0){
                flash('errors_edit',$errnor ,"admin/products?page=$page");
            }
         
            $dir = 'public/img/products/';
            $this->productModel->updateIdTable($data, $id);



            // var_dump($_FILES['img']['name']);
            // die();
            if (!empty($_FILES['img']['name'])) {
                move_uploaded_file($_FILES['img']['tmp_name'], $dir . $_FILES['img']['name']);
                $img_old =  $this->imageModel->findroleTable($id, 1);
                // var_dump($img_old);
                // die();
                if ($img_old) {
                    $data_old_img = array(
                        'path' => $_FILES['img']['name'],
                    );
                    $this->imageModel->updateIdTable($data_old_img, $img_old['id']);
                 
                }else {
                    $dataImg = array(
                        'path' => $_FILES['img']['name'],
                        'product_id' => $id,
                        'role' => 1,
                    );
        
                    move_uploaded_file($_FILES['img']['tmp_name'], $dir . $_FILES['img']['name']);
                    $this->imageModel->insertTable($dataImg);
                }

                $dataImg = array(
                    'path' => $_FILES['img']['name'],
                    'product_id' => $id,
                    'role' => 1,
                );
            
               
            }
            if(!empty($_FILES['images']['name'])){
                $name = array();

                foreach ($_FILES['images']['name'] as $file) {
                    $name[] = $file;
                }
                foreach ($_FILES['images']['tmp_name'] as $file) {
                    $tmp_name[] = $file;
                }
                foreach ($name as $file => $key) {
    
                    move_uploaded_file($tmp_name[$file], $dir . $key);
                    $dataImgs = array(
                        'path' => $key,
                        'product_id' => $id,
                        'role' => 0,
                    );
                    $this->imageModel->insertTable($dataImgs);
                }
            }



            $this->productModel->updateIdTable($data, $id);
        }
        flash('success','sửa thành công',"admin/products?page=$page");
    }
    public function destroy($id)
    {
        // var_dump($id);
        // die();
        $page =$_GET['page']; 
        $this->productModel->updateIdTable(['status' => "2"],$id);
        // var_dump( $this->productModel->updateIdTable(['status' => 2],$id));
        // die();
        flash('success','xóa thành công',"admin/products?page=$page");
    }
    public function listTrash(){
        $countProduct = $this->productModel->countProductTrack();
        $total_pages = ceil($countProduct->count / 5);
   
    
      
        $current_page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
        if ($current_page > $total_pages) {
            $current_page = $total_pages;
        }
        if ($current_page < 1) {
            $current_page = 1;
        }
        
    
        $offset = ($current_page - 1) * 5;
       
        $product = $this->productModel->listTrack($offset);
    
        $cate = $this->categoryModel->allTable();
        $paginationPages = $this -> getPaginationPages($total_pages, 5);
      
        $arr = ['products' => $product,'cate' => $cate ,'paginationPages' => $paginationPages,'visiblePages'=> 5,'totalPages'=>$total_pages ,'currentPage'=>$current_page];
        $this->render('admin.product.trash' ,$arr );
      }
      
    public function get($id)
    {
        $product = $this->productModel->findIdTable($id);
        return json_encode($product);
    }

    public function rollback($id){
       
        $data = array(
       
          'status' => 1,
         
        );
        $this->productModel->updateIdTable($data, $id);
        flash('success','rollback thành công','admin/products/listTrash');
       
      }
    private function  getPaginationPages($totalPages, $currentPage, $visiblePages = 5) {
        $pages = [];
        $halfVisible = floor($visiblePages / 2);
    
        // Nếu số trang ít hơn hoặc bằng số trang có thể hiển thị, hiển thị tất cả
        if ($totalPages <= $visiblePages) {
            for ($i = 1; $i <= $totalPages; $i++) {
                $pages[] = $i;
            }
        } else {
            // Bắt đầu dấu "..." ở đầu nếu trang hiện tại cách xa trang đầu
            if ($currentPage > $halfVisible + 1) {
                $pages[] = 1;
                $pages[] = "...";
            }
    
            // Các trang ở giữa gần trang hiện tại
            $start = max(2, $currentPage - $halfVisible);
            $end = min($totalPages - 1, $currentPage + $halfVisible);
            for ($i = $start; $i <= $end; $i++) {
                $pages[] = $i;
            }
    
            // Kết thúc dấu "..." nếu trang hiện tại cách xa trang cuối
            if ($currentPage < $totalPages - $halfVisible) {
                $pages[] = "...";
                $pages[] = $totalPages;
            }
        }
    
        return $pages;
    }
private function validateProductData($data) {
        $errors = [];
    
        // Kiểm tra product_name
        if (empty($data['product_name'])) {
            $errors['product_name'] = 'Tên sản phẩm không được để trống';
        } elseif (strlen($data['product_name']) > 100) {
            $errors['product_name'] = 'Tên sản phẩm không được dài quá 100 ký tự';
        }
      
        // Kiểm tra price
        if (!isset($data['price']) || !is_numeric($data['price']) || $data['price'] <= 0) {
            $errors['price'] = 'Giá sản phẩm phải là số và lớn hơn 0';
        }
        if (empty($data['price'])) {
            $errors['price'] = 'giá sản phẩm không được để trống';
        }
        // Kiểm tra product_des
        if (empty($data['product_des'])) {
            $errors['product_des'] = 'Mô tả sản phẩm không được để trống';
        }
    
        // Kiểm tra stock
        if (!isset($data['stock']) || !is_numeric($data['stock']) || $data['stock'] < 0) {
            $errors['stock'] = 'Số lượng sản phẩm phải là số nguyên không âm';
        }
        if (empty($data['stock'])) {
            $errors['stock'] = 'giá sản phẩm không được để trống';
        }
    
        return $errors;
    }
}
