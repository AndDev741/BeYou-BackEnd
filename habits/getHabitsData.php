<?php 
require_once("habitsDAO.php");
require_once("../DAO/getID.php");
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: POST, GET, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type, Authorization");
header("Access-Control-Allow-Credentials: true");

$data = json_decode(file_get_contents("php://input"), true);
$email = $data['email'];

if(empty($email)){
    echo json_encode(array('error' => 'Erro ao requisitar os dados'));
    exit();
} else{
    $getID = new getID();
    $id = $getID->fetchUserByEmail([$email]);
    $id = $id["id"];
    $habitsData = new habitsDAO();
    $data = $habitsData->getHabitsData([$id]);
    echo json_encode(['data' => $data]);
}


?>