<?php 
class Db{
	function fetch($key){
		include('db.php');
		$sql = "SELECT * FROM cb_heros WHERE username=?"; 
		$stmt = $conn->prepare($sql); 
		$stmt->bind_param("s", $key);
		$stmt->execute();
		$result = $stmt->get_result(); 
		$res = [];
		if($result->num_rows>0){
			while ($hero = $result->fetch_assoc()) {
				array_push($res,$hero);
			}
		}
		//var_dump(mysqli_error($conn));die();
		return $res;
	}
	function fetchByName($uname){
		include('db.php');
		$sql = "SELECT * FROM cb_heros WHERE name=?"; 
		$stmt = $conn->prepare($sql); 
		$stmt->bind_param("s", $uname);
		$stmt->execute();
		$result = $stmt->get_result(); 
		$res = [];
		if($result->num_rows>0){
			while ($hero = $result->fetch_assoc()) {
				array_push($res,$hero);
			}
		}
		//var_dump(mysqli_error($conn));die();
		return $res;
	}
	function insert_visit(){
		include('db.php');
		$dt = date('Y-m-d');
		$sql1 = "SELECT * FROM log WHERE date='$dt'";
		$reslt = $conn->query($sql1);
		//var_dump(empty($reslt));die();
		if($reslt->num_rows==0){
			$id = uniqid();
			$visits = 1;
			$sql = "INSERT INTO log (id, date, visits) VALUES ('$id', '$dt', '$visits')";
			$conn->query($sql);
			
		}else{
			$data = $reslt->fetch_assoc();
			//var_dump($data);die();
			$visits = $data['visits'];
			$newvisits = $visits+1;
			$sql2 = "UPDATE log SET visits='$newvisits' WHERE date='$dt'";
			$conn->query($sql2);
		}
	}
}