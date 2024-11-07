<?php

namespace App\Models;

use Exception;
use PDO;

class Product extends BaseModel
{
    public $tableName = 'products';

    public function list($offset)
    {
        try {
            global $coreApp;
            $sql = "SELECT 
                        products.*, 
                        categories.id AS cate_id,
                        categories.category_name, 
                        images.id AS img_id, 
                        images.path 
                    FROM 
                        `products` 
                    INNER JOIN 
                        `categories` 
                        ON `products`.`category_id` = `categories`.`id` 
                    LEFT JOIN 
                        `images` 
                         ON `images`.`product_id` = `products`.`id` 
                         AND `images`.`role` = 1 
                    WHERE 
                        `products`.`status` = 1 
                   
                     LIMIT 5 OFFSET $offset";

            // var_dump($sql);
            // die();
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_OBJ);
        } catch (Exception $e) {
            $coreApp->debug($e);
        }
    }
    public function countProduct()
    {
        try {
            global $coreApp;
            $sql = "SELECT COUNT(*) as count
                 
                    FROM 
                        `products` 
                    INNER JOIN 
                        `categories` 
                        ON `products`.`category_id` = `categories`.`id` 
                    LEFT JOIN 
                        `images` 
                         ON `images`.`product_id` = `products`.`id` 
                         AND `images`.`role` = 1 
                    WHERE 
                        `products`.`status` = 1 ";


            $stmt = $this->pdo->prepare($sql);
            $stmt->execute();
            return $stmt->fetch(PDO::FETCH_OBJ);
        } catch (Exception $e) {
            $coreApp->debug($e);
        }
    }
    public function listTrack($offset)
    {
        try {
            global $coreApp;
            $sql = "SELECT 
                        products.*, 
                        categories.id AS cate_id,
                        categories.category_name, 
                        images.id AS img_id, 
                        images.path 
                    FROM 
                        `products` 
                    INNER JOIN 
                        `categories` 
                        ON `products`.`category_id` = `categories`.`id` 
                    LEFT JOIN 
                        `images` 
                         ON `images`.`product_id` = `products`.`id` 
                         AND `images`.`role` = 1 
                    WHERE 
                        `products`.`status` != 1 
                   
                     LIMIT 5 OFFSET $offset";

            // var_dump($sql);
            // die();
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_OBJ);
        } catch (Exception $e) {
            $coreApp->debug($e);
        }
    }
    public function countProductTrack()
    {
        try {
            global $coreApp;
            $sql = "SELECT COUNT(*) as count
                 
                    FROM 
                        `products` 
                    INNER JOIN 
                        `categories` 
                        ON `products`.`category_id` = `categories`.`id` 
                    LEFT JOIN 
                        `images` 
                         ON `images`.`product_id` = `products`.`id` 
                         AND `images`.`role` = 1 
                    WHERE 
                        `products`.`status` != 1 ";


            $stmt = $this->pdo->prepare($sql);
            $stmt->execute();
            return $stmt->fetch(PDO::FETCH_OBJ);
        } catch (Exception $e) {
            $coreApp->debug($e);
        }
    }
    public function insertTable($data)
    {
        try {
            global $coreApp;
            $data = $this->convertToArray($data);
            // Lấy các tên cột từ mảng $data
            $columns = array_keys($data);
            // Tạo chuỗi các tên cột
            $columnsString = implode(', ', $columns);
            // Tạo chuỗi các placeholder
            $placeholders = ':' . implode(', :', $columns);

            // Tạo câu lệnh SQL
            $sql = "INSERT INTO $this->tableName ($columnsString) VALUES ($placeholders)";

            $stmt = $this->pdo->prepare($sql);

            // Chuyển đổi mảng $data thành mảng có dạng ['column' => value]
            $parameters = [];
            foreach ($data as $key => $value) {
                $parameters[":$key"] = $value;
            }

            // return $stmt->execute($parameters);
            if ($stmt->execute($parameters)) {
                // Lấy ID của bản ghi vừa được chèn vào
                $lastInsertId = $this->pdo->lastInsertId();
                return $lastInsertId;
            } else {
                return false;
            }
        } catch (Exception $e) {
            $coreApp->debug($e);
        }
    }

    private function convertToArray($data)
    {
        if (is_object($data)) {
            return get_object_vars($data);
        } elseif (is_array($data)) {
            return $data;
        } else {
            return null;
        }
    }
}
