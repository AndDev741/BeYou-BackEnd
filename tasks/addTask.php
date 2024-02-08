<?php 
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: POST, GET, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type, Authorization");
header("Access-Control-Allow-Credentials: true");
require_once("tasksDAO.php");
require_once("../DAO/getID.php");

$data = json_decode(file_get_contents("php://input"), true);
if(empty($data['name']) || empty($data['importance']) || empty($data['dificulty'])){
    $error = "Por favor preencha todos os campos";
    echo json_encode(array('error' => $error));
    exit();
}

$email = $data['email'];
$name = $data['name'];
$importance = $data['importance'];
$dificulty = $data['dificulty'];
if(empty($data['categoryName'])){
    $categoryName = null;
}else{
    $categoryName = $data['categoryName'];
}

if(empty($data['categoryId'])){
    $categoryId = null;
}else{
    $categoryId = $data['categoryId'];
}

if(empty($data['description'])){
    $description = '';
}else{
    $description = $data['description'];
}

try{
    $idDAO = new getID();
    $id = $idDAO->fetchUserByEmail([$email]);
    $id = $id['id'];
    $tasksDAO = new tasksDAO();
    $addTask = $tasksDAO->addTask($id, $name, $importance, $dificulty, $categoryName, $categoryId, $description);
    echo json_encode(array('success' => "Tarefa adicionada com sucesso!"));
} catch(e){
    echo json_encode(array('error' => 'Ocorreu um erro ao adicionar a tarefa'));
}



?>