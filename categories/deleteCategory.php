<?php 
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: POST, GET, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type, Authorization");
header("Access-Control-Allow-Credentials: true");
require_once("categoriesDAO.php");

$data = json_decode(file_get_contents('php://input'), true);
$error;
$success;

if(empty($data['id'])){
    $error = "Erro ao deletar a categoria";
    echo json_encode(array('error' => $error));
    exit();
}

try{
    $categoryId = $data['id'];
    $categoriesDao = new categoriesDAO();
    $deleteCategory = $categoriesDao->deleteCategory($categoryId);
    $success = "Categoria deletada com sucesso!";
    echo json_encode(array('success' => $success));
}catch(e){
    $error = "Erro ao deletar a categoria do banco de dados";
    echo json_encode(array('error' => $error));
}


?>