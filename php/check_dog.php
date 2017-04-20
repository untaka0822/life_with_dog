<?php 
session_start();
require('dbconnect.php');

if (!isset($_SESSION['join'])) {
	header('Location: index_dog.php');
	exit();
}
if (!empty($_POST)) {
	$name = $_POST['name'];
	$age = $_POST['age'];
	$gender = $_POST['gender'];
	$type = $_POST['type'];
	$size_id = $_POST['size_id'];
	$fleas = $_POST['fleas'];
	$vaccin = $_POST['vaccin'];
	$spay_cast = $_POST['spay_cast'];
	$character = $_POST['character'];
	try{
		$sql = 'INSERT INTO `dogs` SET `name` = ?, `age` = ?, `gender` = ?, `type` = ?, `size-id` = ?, `fleas` = ?, `vaccin` = ?, `spay_cast` = ?, `character` = ?, `picture_path` = ?, `created` = NOW()' ;
		$data = array($name, $age, $gender, $type, $size_id, $fleas, $vaccin, $spay_cast, $character, $picture_path);
	}
}

 ?>