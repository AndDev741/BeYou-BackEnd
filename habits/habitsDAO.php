<?php 
require_once(__DIR__ . "/../DAO/basicDAO.php");
class habitsDAO extends BasicDAO{
    private $email;
    public function registerUser($user_id, $name, $importance, $dificulty, $category, $description, $category_id){
        $sql = "INSERT INTO habits VALUES(default, ?, ?, ?, ?, ?, ?, default, default, ?)";
        $this->execDML($sql, $user_id, $name, $importance, $dificulty, $category, $description, $category_id);
    }

    public function getHabitsData($id){
        $sql = "SELECT * FROM habits WHERE user_id = ?";
        $pdo = $this->getConnection();
        try{
            $stmt = $pdo->prepare($sql);
            $stmt->execute($id);
            return $stmt->fetchAll();
        }finally{
            $pdo = null;
        }
    }
    
    public function updateHabit($name, $importance, $dificulty, $category, $description, $category_id, $habitID ){
        $sql = "UPDATE habits SET name = ?, importance = ?, dificulty = ?, category = ?, description = ?, category_id = ? where id = ?";
        $this->execDML($sql, $name, $importance, $dificulty, $category, $description, $category_id, $habitID);
    }

    public function deleteHabit($habitID){
        $sql = "DELETE FROM habits WHERE id = ?";
        $this->execDML($sql, $habitID);
    }
}

?>