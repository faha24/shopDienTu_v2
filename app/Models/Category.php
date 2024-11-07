<?php
namespace App\Models;
use Exception;
class Category extends BaseModel
{
    public $tableName = 'categories';
    public function getItem()
    {
        try {
            global $coreApp;
            $sql = "SELECT c.*, COUNT(p.id) AS total_products FROM categories c LEFT JOIN products p ON c.id = p.category_id GROUP BY c.id, c.category_name;";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute();
            return $stmt->fetchAll();
        } catch (Exception $e) {
            $coreApp->debug($e);
        }
    }
}
