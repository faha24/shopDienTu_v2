<?php
namespace App\Models;

use Exception;
use PDO;
class Details extends BaseModel  {

    public $tableName = 'product_details';
    public $color = 'colors';
    public $size = 'size';

    public function getColor() {
        try {
            global $coreApp;
            $sql = "SELECT * FROM {$this->color} ORDER BY id DESC";
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute();
            return $stmt->fetchAll();
        } catch (Exception $e) {
            $coreApp->debug($e);
          
        }
    }
    public function getSize() {
        try {
            global $coreApp;
            $sql = "SELECT * FROM {$this->size} ORDER BY id DESC";
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute();
            return $stmt->fetchAll();
        } catch (Exception $e) {
            $coreApp->debug($e);
          
        }
    }
    public function FindAllTable($id) {
        try {
            global $coreApp;
            $sql = "SELECT * FROM {$this->tableName} WHERE product_id = $id ORDER BY id DESC";
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute();
            return $stmt->fetchAll();
        } catch (Exception $e) {
            $coreApp->debug($e);
          
        }
    }
    public function list($offset,$id)
    {
        try {
            global $coreApp;
            $sql = "SELECT product_details.*,colors.color_name FROM `product_details` INNER JOIN colors ON product_details.color_id = colors.id  WHERE `product_id` = $id  LIMIT 5 OFFSET $offset";

            // var_dump($sql);
            // die();
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_OBJ);
        } catch (Exception $e) {
            $coreApp->debug($e);
        }
    }
    public function countProduct($id)
    {
        try {
            global $coreApp;
            $sql = "SELECT COUNT(*) as count FROM `product_details` WHERE `product_id` = $id ";


            $stmt = $this->pdo->prepare($sql);
            $stmt->execute();
            return $stmt->fetch(PDO::FETCH_OBJ);
        } catch (Exception $e) {
            $coreApp->debug($e);
        }
    }



}
?>