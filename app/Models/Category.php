<?php

namespace App\Models;

use Exception;
use PDO;

class Category extends BaseModel
{
    public $tableName = 'categories';
    public function getItem($offset)
    {
        try {
            global $coreApp;
            $sql = "SELECT c.*, COUNT(p.id) 
            AS total_products 
            FROM categories c 
            LEFT JOIN products p 
            ON c.id = p.category_id 
            GROUP BY c.id, c.category_name LIMIT 5 OFFSET $offset";
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_OBJ);
        } catch (Exception $e) {
            $coreApp->debug($e);
        }
    }
    public function countCategory()
    {
        try {
            global $coreApp;
            $sql = "SELECT COUNT(*) as count
                   FROM categories c 
                   LEFT JOIN products p 
                   ON c.id = p.category_id 
                   GROUP BY c.id, c.category_name ";


            $stmt = $this->pdo->prepare($sql);
            $stmt->execute();
            return $stmt->fetch(PDO::FETCH_OBJ);
        } catch (Exception $e) {
            $coreApp->debug($e);
        }
    }
}
