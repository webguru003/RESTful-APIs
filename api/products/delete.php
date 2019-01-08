<?php 
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: DELETE');
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers, Content-Type, Access-Control-Allow-Methods, Authorization, X-Requested-with');

include_once('../../Db.php');
include_once('../../models/Products.php');

$database = new Db();
$db = $database->connect();

$products = new Products($db);

$data = json_decode(file_get_contents("php://input"));

$products->id = $data->id;

if($products->delete()) {
	echo json_encode(array('message' => 'ok'));
} else {
	echo json_encode(array('message' => 'error'));	
}
?>