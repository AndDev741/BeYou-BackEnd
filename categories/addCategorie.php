<?php 
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: POST, GET, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type, Authorization");
header("Access-Control-Allow-Credentials: true");
require_once("categoriesDAO.php");
require_once("../DAO/getID.php");

$data = json_decode(file_get_contents("php://input"), true);

if(empty($data['name']) || empty($data['level'])){
    echo json_encode(array('error' => 'Por favor insira o nome e o nível'));
    exit();
}

$email = $data['email'];
$name = $data['name'];
$level = $data['level'];
$xp;
switch($level){
    case 'Iniciante':
        $level = 1;
        $xp = 0;
        break;
    case 'Intermediário':
        $level = 5;
        $xp = 208;
        break;
    case 'Avançado':
        $level = 7;
        $xp = 298;
}

try{
    $addCategory = new categoriesDAO();
    $getID = new getID();
    $id = $getID->fetchUserByEmail([$email]);
    $id = $id['id'];
    $addCategory->addCategory($name, $xp, $level, $id);
    echo json_encode(array("success" => "Categoria adicionada com sucesso!"));
    exit();
}catch(error){
    echo json_encode(array("error" => "Erro ao adicionar a categoria"));
    exit();
}

?>