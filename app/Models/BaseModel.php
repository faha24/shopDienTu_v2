<?php 
// Các thành phần mặc định của 1 model phải có. Tất cả các model đều phải kế thừa lớp này
namespace App\Models;
use PDO;

class BaseModel {
    public $tableName;
    public $conn;
    public $pdo = null;

    public function __construct() {
        global $coreApp;
        $this->pdo =  new PDO("mysql:host=" . DBHOST
        . ";dbname=" . DBNAME
        . ";charset=" . DBCHARSET,
        DBUSER,
        DBPASS
    );
    }

    public function allTable() {
        try {
            global $coreApp;
            $sql = "SELECT * FROM {$this->tableName} ORDER BY id DESC";
          
           
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute();
            return $stmt->fetchAll();
        } catch (\Exception $e) {
            $coreApp->debug($e);
          
        }
    }

    public function findIdTable($id) {
        try {
            global $coreApp;
            $sql = "SELECT * FROM {$this->tableName} WHERE id = :id";
    
            $stmt = $this->pdo->prepare($sql);
        
            $stmt->execute([':id' => $id]);

            return $stmt->fetch();
        } catch(\Exception $e) {
            $coreApp->debug($e);
        }
    }

    public function removeIdTable($id) {
        try {
            global $coreApp;
            $sql = "DELETE FROM {$this->tableName} WHERE (`id` = :id)";
    
            $stmt = $this->pdo->prepare($sql);
        
            return $stmt->execute([
                ':id' => $id
            ]);
        } catch(\Exception $e) {
       
            $coreApp->debug($e);
           
        }
    }

    public function insertTable($data) {
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

            return $stmt->execute($parameters);
        } catch(\Exception $e) {
            $coreApp->debug($e);
        }
    }

    public function updateIdTable($data, $id) {
        try {
            global $coreApp;
            $data = $this->convertToArray($data);
            // Lấy các tên cột từ mảng $data
            $columns = array_keys($data);
            // Tạo chuỗi các cặp 'column = :column'
            $setString = implode(', ', array_map(function($col) {
                return "$col = :$col";
            }, $columns));
            
            // Tạo câu lệnh SQL
            $sql = "UPDATE $this->tableName SET $setString WHERE id = :id";
        //    var_dump($sql);
        //    die();
            
            $stmt = $this->pdo->prepare($sql);
            
            // Chuyển đổi mảng $data thành mảng có dạng ['column' => value]
            $parameters = [];
            foreach ($data as $key => $value) {
                $parameters[":$key"] = $value;
            }
            // Thêm id vào mảng parameters
            $parameters[':id'] = $id;
           
            return $stmt->execute($parameters);
        } catch(\Exception $e) {
            $coreApp->debug($e);
        }
    }

    private function convertToArray($data) {
        if (is_object($data)) {
            return get_object_vars($data);
        } elseif (is_array($data)) {
            return $data;
        } else {
            return null;
        }
    }
    public function findIdUser($name,$pass) {
        try {
            global $coreApp;
            $sql = "SELECT * FROM {$this->tableName} WHERE `username` = '$name' AND `password` = '$pass'";
           
            $stmt = $this->pdo->prepare($sql);

            $stmt->execute();

            return $stmt->fetch();
        } catch(\Exception $e) {
            $coreApp->debug($e);
        }
    }


    public function debug($data)
    {
        echo "<pre>";
        print_r($data);
        die();
    }
}
