<?php 
class Products {
	private $conn;
	private $tb;
	public $id;
	public $catid;
	public $catname;
	public $prodname;
	public $prodprice;
	public function __construct($db) {
		$this->conn = $db;
	}
	public function read() {
		$sql = 'SELECT c.name as catname, p.id, p.cat, p.name, p.price FROM products p LEFT JOIN cat c ON p.cat = c.id ORDER BY p.name ';
		$stmt = $this->conn->prepare($sql);
		$stmt->execute();
		return $stmt;
	}
	public function read_single() {
		$sql = 'SELECT c.name as catname,  p.id, p.cat, p.name, p.price FROM products p LEFT JOIN cat c ON p.cat = c.id where  p.id = ?
				LIMIT 0,1 ';
		$stmt = $this->conn->prepare($sql);
		$stmt->bindParam(1,$this->id);
		$stmt->execute();
		$row = $stmt->fetch(PDO::FETCH_ASSOC);
		
		$this->name = $row['name'];
		$this->cat = $row['cat'];
		$this->price = $row['price'];
		$this->catname = $row['catname'];
	}
	public function create() {
		$sql = 'INSERT into products SET name = :name, cat = :cat, price = :price';
		
		$stmt = $this->conn->prepare($sql);
		$this->name = htmlspecialchars(strip_tags($this->name));
		$this->cat = htmlspecialchars(strip_tags($this->cat));
		$this->price = htmlspecialchars(strip_tags($this->price));
				
		$stmt->bindParam(':name',$this->name);
		$stmt->bindParam(':cat',$this->cat);
		$stmt->bindParam(':price',$this->price);
		
		if($stmt->execute()) {
			return true;
		}
		
		printf("Error: %s. \n", $stmt->error);
		return false;
	}
	public function update() {
		$sql = 'UPDATE products SET name = :name, cat = :cat, price = :price WHERE id = :id';
		
		$stmt = $this->conn->prepare($sql);
		$this->name = htmlspecialchars(strip_tags($this->name));
		$this->cat = htmlspecialchars(strip_tags($this->cat));
		$this->price = htmlspecialchars(strip_tags($this->price));
		$this->id = htmlspecialchars(strip_tags($this->id));
				
		$stmt->bindParam(':name',$this->name);
		$stmt->bindParam(':cat',$this->cat);
		$stmt->bindParam(':price',$this->price);
		$stmt->bindParam(':id',$this->id);
		
		if($stmt->execute()) {
			return true;
		}		
		printf("Error: %s. \n", $stmt->error);
		return false;
	}
	public function delete() {
		$sql = 'DELETE FROM products WHERE id = :id';
		
		$stmt = $this->conn->prepare($sql);
		$this->id = htmlspecialchars(strip_tags($this->id));				
		$stmt->bindParam(':id',$this->id);
		
		if($stmt->execute()) {
			return true;
		}
		
		printf("Error: %s. \n", $stmt->error);
		return false;
	}
}
?>