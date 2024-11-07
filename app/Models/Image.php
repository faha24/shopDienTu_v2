<?php
namespace App\Models;
use Exception;
class Image extends BaseModel  {
    public $tableName = 'images';
    public function findroleTable($id,$role) {
        try {
            global $coreApp;
            $sql = "SELECT * FROM {$this->tableName} WHERE product_id = :id AND role = :role";
    
            $stmt = $this->pdo->prepare($sql);
        
            $stmt->execute([':id' => $id ,':role' => $role]);

            return $stmt->fetch();
        } catch(Exception $e) {
            $coreApp->debug($e);
        }
    }
}
?>