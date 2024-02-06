<?php 
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: POST, GET, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type, Authorization");
header("Access-Control-Allow-Credentials: true");
require_once("habitsDAO.php");
require_once("../DAO/getID.php");

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

$email = $data['email'];
$name = $data['name'];
$importance = $data['importance'];
$dificulty = $data['dificulty'];
$weekDays = $data['weekDays'];
$description = $data['description'];
$category_name = $data['categoryName'];
$category_id = $data['categoryId'];
$error = '';
$sucess = '';

if(empty($weekDays)){
    $error = "Por favor escolha pelo menos 1 dia da semana";
    echo json_encode(array('error' => $error));
    exit();
}else{
    $getID = new getID();
    $id = $getID->fetchUserByEmail([$email]);
    $id = $id['id'];
    $newHabit = new habitsDAO();
    $registerHabit = $newHabit->registerUser($id, $name, $importance, $dificulty, $category_name, $weekDays, $description, $category_id );
    $sucess ="Habito criado com sucesso!";
    echo json_encode(array('success' => $sucess));
    exit();
}


?>