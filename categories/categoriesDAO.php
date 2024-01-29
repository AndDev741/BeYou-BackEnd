<?php 
require_once(__DIR__ . "/../DAO/basicDAO.php");
class categoriesDAO extends BasicDAO{
    public function addCategory($name, $xp, $level, $user_id){
        $sql = "INSERT INTO categories VALUES(default, ?, ?, ?, ?)";
        $this->execDML($sql, $name, $xp, $level, $user_id);
    }

    public function getCategories($id){
        $sql = "SELECT * FROM categories WHERE user_id = ?";
        $pdo = $this->getConnection();
        try{
            $stmt = $pdo->prepare($sql);
            $stmt->execute($id);
            return $stmt->fetchAll();
        }finally{
            $pdo = null;
        }
    }
}

?>