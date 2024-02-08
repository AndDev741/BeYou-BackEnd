<?php 
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: POST, GET, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type, Authorization");
header("Access-Control-Allow-Credentials: true");
require_once("habitsDAO.php");

$data = json_decode(file_get_contents("php://input"), true);
if(empty($data['name']) || empty($data['importance']) || empty($data['dificulty'])){
    $error = "Por favor preencha todos os campos";
    echo json_encode(array('error' => $error));
    exit();
} else if(empty($data['categoryName']) || empty($data['categoryId'])){
    $error = "Por favor adicione uma categoria";
    echo json_encode(array('error' => $error));
    exit();
}

$habitID = $data['habitID'];
$name = $data['name'];
$importance = $data['importance'];
$dificulty = $data['dificulty'];
$category_name = $data['categoryName'];
$category_id = $data['categoryId'];
$description = $data['description'];
$error = '';
$sucess = '';


try{
    $newHabit = new habitsDAO();
    $registerHabit = $newHabit->updateHabit($name, $importance, $dificulty, $category_name, $description, $category_id,$habitID);
    $sucess ="Editado com sucesso!";
    echo json_encode(array('success' => $sucess));
    exit();
}catch(e){
    echo json_encode(array('error' => 'Erro ao editar categoria'));
}
    


?>
