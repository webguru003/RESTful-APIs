<?php 
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
include_once('../../Db.php');
include_once('../../models/Products.php');

$database = new Db();
$db = $database->connect();

$products = new Products($db);

$products->id = isset($_GET['id']) ? $_GET['id'] : die();
$products->read_single();
$products_arr = array (
	'id' => $products->id,
	'name' => $products->name,
	'catname' => $products->catname,
	'price' => $products->price,
);
print_r(json_encode($products_arr)); 
?>