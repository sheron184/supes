<?php 
include('../db.php');
include('../db_functions.php');
$sql = "SELECT * FROM cb_heros";
$heros = $conn->query($sql);
$cbms = [];
$names = [];
while($row = $heros->fetch_assoc()){
	array_push($cbms,$row);
	array_push($names,$row['name']);
}

foreach($names as $hero){
	$str_parts1 = explode(" ",$hero);
	$str_parts2 = explode("-",$hero);
	$newname = "";
	if(count($str_parts1)==1){	
		for($i=0;$i<count($str_parts2);$i++){
			$newname = $newname .=strtolower($str_parts2[$i]);
		}
	}else if(count($str_parts1)>1){
		for($i=0;$i<count($str_parts1);$i++){
			$newname = $newname .=strtolower($str_parts1[$i]);
		}
	}
	//$sql = "UPDATE cb_heros SET username='$newname' WHERE name='$hero'";
	//$conn->query($sql);
	echo $newname;echo "<br>";
	//print_r(count($str_parts1));echo $hero;echo "<br>";
	//print_r($str_parts2);echo "<br>";

}
?>
<!DOCTYPE html>
<html>
<head>
	<title>ADMIN</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<link rel="icon" type="image/x-icon" href="f1.png">
	<meta content='width=device-width, initial-scale=1, maximum-scale=1' name='viewport'/>
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
	<link rel="stylesheet" type="text/css" href="../css/styles.css">
	<link href="https://fonts.googleapis.com/css2?family=Karla:wght@300&display=swap" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css2?family=Kaushan+Script&display=swap" rel="stylesheet">
	<script type="text/javascript" src="../js/jq.js"></script>
</head>
<body>
	
</body>
</html>