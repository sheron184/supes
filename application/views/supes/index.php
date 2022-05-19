<?php 
include('./ajax/db.php');
include('./ajax/db_functions.php');
if(!isset($_COOKIE['maestro'])){
    $visit = new Db();
    $visit->insert_visit();    
}

$sql = "SELECT * FROM cb_heros";
$query = "SELECT * FROM users";
 
$users = $conn->query($query);
$heros = $conn->query($sql);

$marvel_fans = [];
$dc_fans = [];

//var_dump($heros->fetch_assoc());die();
$cbms = [];
$names = [];
$usernames = [];
while($row = $heros->fetch_assoc()){
	array_push($cbms,$row);
	array_push($names,$row['name']);
	$usernames[$row['name']] = $row['username'];
	//$arr = [$row['name'],$row['username']];
	//array_push($usernames,$row['name']=>$row['username']);
}
while($row = $users->fetch_assoc()){
	if($row['marvelordc'] == "marvel"){
		array_push($marvel_fans,$row);
	}else{
		array_push($dc_fans,$row);
	}
}
$marvel_user_precentage = count($marvel_fans)/(count($dc_fans)+count($marvel_fans)) *100;
$dc_user_precentage = count($dc_fans)/(count($dc_fans)+count($marvel_fans)) *100;
//var_dump(count($dc_fans));die();
//$data = file_get_contents("https://www.superheroapi.com/api.php/2496364390592143/1/");
//$heros = json_decode($data);
//var_dump($heros);die();
//$data = {"response":"success","id":"489","name":"Nick Fury","powerstats":{"intelligence":"75","strength":"11","speed":"23","durability":"42","power":"25","combat":"100"},"biography":{"full-name":"Nicholas Joseph Fury","alter-egos":"No alter egos found.","aliases":["Doyle","The Mystery in the Mask","Patch","Scorpio"],"place-of-birth":"New York City","first-appearance":"Sgt. Fury and His Howling Commandos #1 (1963)","publisher":"Marvel Comics","alignment":"good"},"appearance":{"gender":"Male","race":"Human","height":["6'1","185 cm"],"weight":["221 lb","99 kg"],"eye-color":"Brown","hair-color":"Brown \/ White"},"work":{"occupation":"S.H.I.E.L.D. director; former S.H.I.E.L.D. agent, intelligence agent, soldier and commando leader, parachuting instructor, stunt flyer","base":"-"},"connections":{"group-affiliation":"Secret Avengers, SHIELD (both incarnations); formerly Team Valkyrie, C.I.A., liaison to MI-5, O.S.S., Howling Commandos, U.S. Army","relatives":"Jack Fury (father, deceased);\nunnamed mother;\nunnamed stepmother (deceased);\nDawn Fury (half-sister);\nJake Fury (half-brother);\nMikel Fury (son, deceased);\nJerry Sapristi (cousin);\nTina Sapristi (cousin by marriage);\nErnesto, Pietro, Giovanni, Maria, Rosa and Gabriella (1st cousins once removed);"},"image":{"url":"https:\/\/www.superherodb.com\/pictures2\/portraits\/10\/100\/326.jpg"}};
//$heros = json_decode($data);
//var_dump($heros->biography->publisher);die();
/*
for($i=1;$i<732;$i++){
	$data = file_get_contents("https://www.superheroapi.com/api.php/2496364390592143/".$i."");
	$heros = json_decode($data);

	$id = intval($heros->id);
	$name = $heros->name;
	$powerstats = json_encode($heros->powerstats); 
	$biography = json_encode($heros->biography);
	$ap = $heros->appearance;
	$height = $ap->height;
	//$pts = explode("'",$height);

	$heros->appearance->height = $height[0][0];
	//var_dump($heros->appearance);die();
	//$ap1 = json_encode($ap);

	$appearance = json_encode($heros->appearance);
	$work = json_encode($heros->work); 
	$connections = json_encode($heros->connections); 
	$image = json_encode($heros->image); 
	//$dataType = gettype($heros->powerstats);
	$sql = "INSERT INTO `cb_heros`(`id`, `name`, `powerstats`, `biography`, `appearance`, `work`, `connections`, `image`) VALUES ('$id','$name','$powerstats','$biography','$appearance','$work','$connections','$image')";
	//echo $sql;echo "<br>";
	if(!$conn->query($sql)){
		var_dump(mysqli_error($conn));
	}
	echo "Added ".$name." / ";
}
*/

//var_dump($_SERVER['REMOTE_ADDR']);die();  
?>
<!DOCTYPE html>
<html>
<head>
	<title>SUPES</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width,initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
	<link rel="icon" type="image/x-icon" href="<?php echo base_url() ?>assets/imgs/superhero.png">
	<meta content='width=device-width, initial-scale=1, maximum-scale=1' name='viewport'/>
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css" integrity="sha384-zCbKRCUGaJDkqS1kPbPd7TveP5iyJE0EjAuZQTgFLD2ylzuqKfdKlfG/eSrtxUkn" crossorigin="anonymous">
	<link rel="stylesheet" type="text/css" href="<?php echo base_url() ?>assets/css/styles.css">
	<link href="https://fonts.googleapis.com/css2?family=Karla:wght@300&display=swap" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css2?family=Kaushan+Script&display=swap" rel="stylesheet">
	<script type="text/javascript" src="<?php echo base_url() ?>assets/js/jq.js"></script>
	<script type="text/javascript" src="<?php echo base_url() ?>assets/bootstrap/bootstrap.min.js"></script>
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g==" crossorigin="anonymous" referrerpolicy="no-referrer" />
	<link href="https://fonts.googleapis.com/css2?family=Oleo+Script+Swash+Caps&display=swap" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css2?family=Macondo&display=swap" rel="stylesheet">
</head>
<body>
	<div class="container-fluid" style="min-height: 95vh;">
		<div class="row">
			<div class="col-6 header">
				<div class="p-2 d-flex align-items-center">
					<h2 class="hh">Supes</h2>
					<img src="./assets/imgs/superhero.png" class="logo-img ml-3">
				</div>
			</div>
			<div class="col-6 header">
				<div class="h-100 d-flex align-items-center justify-content-end pr-3">
					<?php if($this->session->userdata('logged_in')): ?>
						<div class="pl-3 pr-3 animate__animated animate__heartBeat"><a class="btn bg-dark" href="users"><i class="fa-solid fa-user" style="color:#fff;font-size:25px;"></i></a></div>
					<?php else: ?>
						<div class="pl-3 pr-3 animate__animated animate__heartBeat"><a class="btn shadow text-white button-85" href="users">Join us</a></div>
					<?php endif ?>
				</div>
			</div>
			<div class="col-xl-6 col-lg-6 col-md-12 col-sm-12 col-12 search-bar">
				<div class="p-3 mb-3">
					<form class="pb-3">
						<div><h4>Search heros</h4></div>
						<div class="form-group pt-2">
							<div style="background-image: linear-gradient(to right,#e91e63,#673ab7,#ff5722,#009688);width: 50%;border-radius: 30px;" class="p-1 search-box"><input style="border:none;" id="search" type="text" name="q" onkeyup="myfun(this.value)" class="form-control search-box-input"></div>
						</div>
					</form>
					<div id="results" class="pt-2 pb-2"></div>
				</div>
				<div>
					<div class="p-4">
						<h4 style="font-family:Macondo;font-size: 40px;text-align: center;">Join our community</h4>
						<div class="d-flex mt-3">
							<div class="dc-bar shadow position-relative" style="height: 100px;border-top-left-radius: 60px;border-bottom-left-radius: 60px; width:<?php echo $dc_user_precentage ?>%;background-image: url(./assets/imgs/dc.png);background-size: cover;background-position: center;">
								<div class="d-flex justify-content-center align-items-center" style="border-top-left-radius: 60px;border-bottom-left-radius: 60px;background: #3f51b569;width:100%;height:100%;position: absolute;top: 0px;">
									<p class="mb-0 text-white" style="text-shadow: 2px 2px black;font-size:20px;font-weight: bold;">DC <?php echo round($dc_user_precentage) ?>%</p>
								</div>
							</div>
							<div class="marvel-bar shadow position-relative" style="height: 100px;border-top-right-radius: 60px;border-bottom-right-radius: 60px; width:<?php echo $marvel_user_precentage ?>%;background-image: url(./assets/imgs/marvel.jpg);background-size: cover;background-position: center;">
								<div class="d-flex justify-content-center align-items-center" style="border-top-right-radius: 60px;border-bottom-right-radius: 60px;background: #e91e6342;width:100%;height:100%;position: absolute;top: 0px;">
									<p class="mb-0 text-white" style="text-shadow: 2px 2px black;font-size:20px;font-weight: bold;">MARVEL <?php echo round($marvel_user_precentage) ?>%</p>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="d-flex justify-content-center">
					<h2 class="mt-4 alert alert-warning p-3" style="font-size: 20px;" align="center">Much more updates are coming soon!!</h2>
				</div>
			</div>
			<!--
			<div class="col-1 pl-0 pr-0">
				<div class="shape"></div>
			</div>
			<div class="shape-wrapper col-1 pl-0 pr-0"><div class="shape-1"></div></div>
			-->
			<div id="datahere" class="col-xl-6 col-lg-6 col-md-12 col-sm-12 col-12 data-bar">
				<div class="data p-3 animate__animated animate__fadeInRight">
					<div class="name data-h pb-3 pp"></div>
					<div class="spin-div d-flex justify-content-center p-2"></div>
					<div class="img data-h d-flex justify-content-center"></div>
					<div class="rating pt-2 pb-2">
						<div class="data-h rate-info"></div>
						<p class="hero-id" style="display:none;"></p>
						<?php if($this->session->userdata('logged_in')): ?>
						<div class="rate-hero-sec animate__animated">
							<div>
								<h4 class="rateVal text-center"></h4>
							</div>
							<div class="stars d-flex justify-content-center align-items-center">
								<a class="ml-1 star" id="1"><i class="fa-solid fa-star"></i></a>
								<a class="ml-1 star" id="2"><i class="fa-solid fa-star"></i></a>
								<a class="ml-1 star" id="3"><i class="fa-solid fa-star"></i></a>
								<a class="ml-1 star" id="4"><i class="fa-solid fa-star"></i></a>
								<a class="ml-1 star" id="5"><i class="fa-solid fa-star"></i></a>
								<a class="ml-1 star" id="6"><i class="fa-solid fa-star"></i></a>
								<a class="ml-1 star" id="7"><i class="fa-solid fa-star"></i></a>
								<a class="ml-1 star" id="8"><i class="fa-solid fa-star"></i></a>
								<a class="ml-1 star" id="9"><i class="fa-solid fa-star"></i></a>
								<a class="ml-1 star" id="10"><i class="fa-solid fa-star"></i></a>
							</div>
							<div>
								<div>
									<input type="hidden" name="rate" id="supesrate">
									<div class="d-flex justify-content-center"><button type="submit" class="mt-2 mb-2 rate-btn disabled" disabled="true">Rate</button></div>	
								</div>
							</div>
							<div>
								<div class="">
									<div class="d-flex justify-content-center"><a style="text-decoration: none;" href="#" data-toggle="collapse" data-target="#demo" align="center">What should you consider before rate..? <i class="fa-solid fa-caret-down ml-1"></i></a></div>
									<div id="demo" class="collapse p-3 pl-4">
										<p>Orgin story</p>
										<p>Not OP!</p>
										<p>Leadership skills</p>
										<p>Character development</p>
									</div>
								</div>
							</div>
						</div>
					<?php else: ?>
						<div class="d-flex justify-content-center"><h6><a href="users">Sign Up or Login to rate this chracter</a></h6></div>
					<?php endif; ?>
					</div>
					<div class="bio data-h pt-2 pp"></div>
					<div class="apperance data-h pt-4 pp"></div>
					<div class="work data-h pp"></div>
					<div class="conns data-h pp"></div>
					<div class="powers data-h pt-3 pb-3 pp"></div>
				</div>
			</div>
		</div>
	</div>
	
	<div class="container-fluid" style="background:#111;">
		<div class="row">
			<div class="col-12 ft justify-content-center align-items-center">
				<p class="mb-0 mt-2" style="color:#ccc;text-align: center;">Powerd By SJTech</p>
			</div>
		</div>
	</div>

	<span style="visibility: hidden;display: none;" id="names"><?php echo json_encode($names) ?></span>
	<span style="visibility: hidden;display: none;" id="usernames"><?php echo json_encode($usernames) ?></span>
</body>
<input type="hidden" id="hero-id">
<input type="hidden" id="user-id" value="<?php echo $this->session->userdata('uniq_id') ?>">
<script type="text/javascript" src="<?php echo base_url() ?>assets/js/main.js"></script>
</html>


