<?php 
require_once(__DIR__ . "/../DAO/basicDAO.php");
class tasksDAO extends BasicDAO{
    public function addTask($user_id, $name, $importance, $dificulty, $category, $category_id, $description){
        $sql = "INSERT INTO tasks VALUES(default, ?, ?, ?, ?, ?, ?, ?)";
        $this->execDML($sql, $user_id, $name, $importance, $dificulty, $category, $category_id, $description);
    }

    public function getTasks($id){
        $sql = "SELECT * FROM tasks WHERE user_id = ?";
        $pdo = $this->getConnection();
        try{
            $stmt = $pdo->prepare($sql);
            $stmt->execute($id);
            return $stmt->fetchAll();
        }finally{
            $pdo = null;
        }
    }
    
    public function updateTask($name, $importance, $dificulty, $category, $category_id, $description, $taskId ){
        $sql = "UPDATE tasks SET name = ?, importance = ?, dificulty = ?, category = ?, category_id = ?, description = ? where id = ?";
        $this->execDML($sql, $name, $importance, $dificulty, $category, $category_id, $description, $taskId);
    }

    public function deleteTask($taskId){
        $sql = "DELETE FROM tasks WHERE id = ?";
        $this->execDML($sql, $taskId);
    }
}

?>