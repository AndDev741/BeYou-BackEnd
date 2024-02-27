<?php 
require_once("tasksDAO.php");
require_once("../DAO/getID.php");
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: POST, GET, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type, Authorization");
header("Access-Control-Allow-Credentials: true");

$data = json_decode(file_get_contents("php://input"), true);
if(empty($data['email'])){
    $error = "Ocorreu um erro ao validar o id";
    echo json_encode(array('error'=> $error));
    exit();
}

try{
    $email = $data['email'];
    $getId = new getID();
    $id = $getId->fetchUserByEmail([$email]);
    $id = $id['id'];
    $tasksDAO = new tasksDAO();
    $tasksData = $tasksDAO->getTasks([$id]);
    echo json_encode(array('data' => $tasksData));
}catch(e){
    $error = "Ocorreu um erro ao requisitar os dados";
    echo json_encode(array('error'=> $error));
}

?>