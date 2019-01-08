<?php 
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
include_once('../../Db.php');
include_once('../../models/Products.php');

$database = new Db();
$db = $database->connect();

$products = new Products($db);

$result = $products->read();
$num = $result->rowCount();

if($num > 0) {
	$products_arr = array ();
	$products_arr['data'] = array();
	while($row = $result->fetch(PDO::FETCH_ASSOC)) {
		extract($row);
		$products_item = array (
			'id' => $id,
			'name' => $name,
			'price' => $price,
			'cat' => $cat,
			'catname' => $catname,
		);
		array_push($products_arr['data'], $products_item);
	}
	echo json_encode($products_arr);
}
else {
	echo json_encode(array('msg'=> 'No Products Found'));
}
?>