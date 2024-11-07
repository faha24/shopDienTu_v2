<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Controllers\ICrud;
use App\Models\Details;


class DetailController extends BaseController
{

    public $detailModel;



    public function __construct()
    {

        $this->detailModel = new Details();
    }

    public function index()
    {
        $pr_id = $_GET['pr_id'];
        $countProduct = $this->detailModel->countProduct($pr_id);
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
        $data = $this->detailModel->list($offset, $pr_id);
        $color = $this->detailModel->getColor();
        $size = $this->detailModel->getSize();
        // var_dump($product);
        // die();


        $paginationPages = $this->getPaginationPages($total_pages, 5);

        $arr = [
            'Details' => $data,
            'paginationPages' => $paginationPages,
            'visiblePages' => 5,
            'totalPages' => $total_pages,
            'currentPage' => $current_page,
            'color' => $color,
            'size' => $size,
            'id' => $pr_id
        ];


        $this->render('admin.product.detail', $arr);
    }
    public function create()
    {
        $pr_id = $_GET['pr_id'];
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $quantity = $_POST['quantity'];
            $price = $_POST['price'];

            $color_id = $_POST['color_id'];
            

            $data = array(
                'product_id' => $pr_id,
                'quantity' => $quantity,
                'price' => $price,
                'color_id' => $color_id,

            );
            $errnor =  $this->validateProductData($data);
            if(count($errnor) > 0){
                flash('errors_add_detail',$errnor ,"admin/products/detail?pr_id=$pr_id");
            }
            $this->detailModel->insertTable($data);



            flash('success', 'thêm thành công', "admin/products/detail?pr_id=$pr_id");
        }
    }
    public function destroy($id)
    {
        $pr_id = $_GET['pr_id'];
        $this->detailModel->removeIdTable($id);
        flash('success', 'xóa thành công', "admin/products/detail?pr_id=$pr_id");
    }

    private function  getPaginationPages($totalPages, $currentPage, $visiblePages = 5)
    {
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
    
        // Kiểm tra quantity
        if (!isset($data['quantity']) || !is_numeric($data['quantity']) || $data['quantity'] <= 0) {
            $errors['quantity'] = 'Số lượng sản phẩm phải là số và lớn hơn 0';
        } elseif (empty($data['quantity'])) {
            $errors['quantity'] = 'Số lượng sản phẩm không được để trống';
        }
    
        // Kiểm tra price
        if (!isset($data['price']) || !is_numeric($data['price']) || $data['price'] <= 0) {
            $errors['price'] = 'Giá sản phẩm phải là số và lớn hơn 0';
        } elseif (empty($data['price'])) {
            $errors['price'] = 'Giá sản phẩm không được để trống';
        }
    
        // Kiểm tra color_id
       
        return $errors;
    }
}
