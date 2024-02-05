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

$categorieID = $data['id'];
$email = $data['email'];
$name = $data['name'];
$level = $data['level'];
$icon = $data['icon'];
$xp;
switch($level){
    case 'Iniciante':
        $level = 1;
        $xp = 0;
        break;
    case 'Intermediário':
        $level = 5;
        $xp = 120 * $level;
        break;
    case 'Avançado':
        $level = 7;
        $xp = 120 * $level;
}
try{
    $categoryDao = new categoriesDAO();
    $editCategory = $categoryDao->editCategory($name, $xp, $level, $icon, $categorieID);
    $sucess ="Editado com sucesso!";
    echo json_encode(array('success' => $sucess));
} catch(e){
    echo json_encode(array('error' => "Ocorreu um erro ao editar a categoria"));
}

?>