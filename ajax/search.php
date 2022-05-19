<?php 
include('db.php');
include('db_functions.php');

if(isset($_POST['name'])){
	$hero_name = $_POST['name'];
	$newHero = new Db();
	$res = $newHero->fetch($hero_name);
	echo json_encode($res);
}else if(isset($_POST['realname'])){
	$realname = $_POST['realname'];
	$hr = new Db();
	$res = $hr->fetchByName($realname);
	echo json_encode($res);
}

//echo mysqli_error($conn);
