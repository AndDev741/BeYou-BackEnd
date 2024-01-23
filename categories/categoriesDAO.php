<?php 
require_once(__DIR__ . "/../DAO/basicDAO.php");
class categoriesDAO extends BasicDAO{
    public function addCategory($name, $xp, $level, $user_id){
        $sql = "INSERT INTO categories VALUES(default, ?, ?, ?, ?)";
        $this->execDML($sql, $name, $xp, $level, $user_id);
    }
}

?>