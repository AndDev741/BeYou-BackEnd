<?php 
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: POST, GET, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type, Authorization");
header("Access-Control-Allow-Credentials: true");
require_once("tasksDAO.php");

$data = json_decode(file_get_contents("php://input"), true);
if(empty($data['name']) || empty($data['importance']) || empty($data['dificulty']) || empty($data['taskId'])){
    $error = "Nome, importância e Dificuldade precisam ser preenchidos";
    echo json_encode(array('error' => $error));
    exit();
}

$email = $data['email'];
$name = $data['name'];
$importance = $data['importance'];
$dificulty = $data['dificulty'];
$taskId = $data['taskId'];
$categoryName;
$categoryId;
$description;
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
    $tasksDAO = new tasksDAO();
    $editTask = $tasksDAO->updateTask($name, $importance, $dificulty, $categoryName, $categoryId, $description, $taskId);
    echo json_encode(array('success' => "Tarefa editada com sucesso!"));
}catch(e){
    echo json_encode(array('error' => "Ocorreu um erro ao editar a tarefa"));
}

?>