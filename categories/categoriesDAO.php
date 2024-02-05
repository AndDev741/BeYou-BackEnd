<?php 
require_once(__DIR__ . "/../DAO/basicDAO.php");
class categoriesDAO extends BasicDAO{
    public function addCategory($name, $xp, $level, $user_id, $icon){
        $sql = "INSERT INTO categories VALUES(default, ?, ?, ?, ?, ?)";
        $this->execDML($sql, $name, $xp, $level, $user_id, $icon);
    }

    public function editCategory($name, $xp, $level, $icon, $categoryId){
        $sql = ("UPDATE categories SET name = ?, xp = ?, level = ?, icon_index = ? WHERE id = ?");
        $this->execDML($sql, $name, $xp, $level, $icon, $categoryId);
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