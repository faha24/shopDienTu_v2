<?php

namespace App\Controllers\Admin;
use App\Controllers\BaseController;
use App\Controllers\ICrud;
use App\Models\product;
use App\Models\Category;
use App\Models\Image;

class CategoryController extends BaseController implements ICrud
{
   
    public $categoryModel;
    

    public function __construct()
    {
       
        $this->categoryModel = new Category();
    }

    public function index()
    {
        $countProduct = $this->categoryModel->countCategory();
        $total_pages = ceil($countProduct->count / 5);
   
    
      
        $current_page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
        if ($current_page > $total_pages) {
            $current_page = $total_pages;
        }
        if ($current_page < 1) {
            $current_page = 1;
        }
        $offset = ($current_page - 1) * 5;
        $category = $this->categoryModel->getItem($offset);
        $paginationPages = $this -> getPaginationPages($total_pages, 5);
      
        $arr = ['categories' => $category
         ,'paginationPages' => $paginationPages
         ,'visiblePages'=> 5
         ,'totalPages'=>$total_pages 
         ,'currentPage'=>$current_page];
        $this->render('admin.category.list' ,$arr );
    }
    public function create()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            
                $category_name = $_POST['category_name'];
                $category_des = $_POST['category_des'];
                $data = array(
                  'category_name' => $category_name,
                  'category_des' => $category_des,
                  'status' => 1,
                );
          
                $this->categoryModel->insertTable($data);         
            flash('success','thêm thành công','admin/category');
        }
    }
    public function update()
    {

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $page =$_GET['page'] ; 
            $id = $_POST['id'];
            $category_name = $_POST['category_name'];
            $category_des = $_POST['category_des'];
            $data = array(
              'category_name' => $category_name,
              'category_des' => $category_des,
              'status' => 1,
            );
      
            $this->categoryModel->updateIdTable($data, $id);
            flash('success','sửa thành công',"admin/products?page=$page");
        }
       
    }
    public function destroy($id)
    {
        $page =$_GET['page']; 
        $this->categoryModel->removeIdTable($id);
        flash('success','xóa thành công',"admin/products?page=$page");
    }
   
      
    public function get($id)
    {
        $category = $this->categoryModel->findIdTable($id);
        return json_encode($category);
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
