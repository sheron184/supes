<?php 
//var_dump($this->session->userdata('uniq_id'));
?>
<!DOCTYPE html>
<html>
<head>
	<title>SUPES | PROFILE</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<link rel="icon" type="image/x-icon" href="<?php echo base_url() ?>assets/imgs/superhero.png">
	<meta content='width=device-width, initial-scale=1, maximum-scale=1' name='viewport'/>
	<link rel="stylesheet" type="text/css" href="<?php echo base_url() ?>assets/css/styles.css">
	<link href="https://fonts.googleapis.com/css2?family=Karla:wght@300&display=swap" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css2?family=Kaushan+Script&display=swap" rel="stylesheet">
	<link rel="stylesheet" type="text/css" href="<?php echo base_url() ?>assets/css/profile.css">
	<link rel="stylesheet" type="text/css" href="<?php echo base_url() ?>assets/bootstrap/bootstrap.min.css">
	<script type="text/javascript" src="<?php echo base_url() ?>assets/js/jq.js"></script>
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g==" crossorigin="anonymous" referrerpolicy="no-referrer" />
	<!--<script src="https://cdn.tailwindcss.com"></script>-->
</head>
<body>
	<div class="container-fluid">
		<div class="row">
			<div class="col-12">
				<div class="tabs d-flex mt-3">
					<div class="tab">
						<a class="tab-link btn" href="/supes"><i class="fa-solid fa-house-chimney"></i></a>
					</div>
					<div class="tab">
						<a class="tab-link btn" href="<?php echo base_url() ?>users/logout"><i class="fa-solid fa-power-off text-danger"></i></a>
					</div>
				</div>
			</div>
			<div class="col-xl-3 col-lg-4 col-md-12 col-sm-12 col-12">
				<div class="p-3">
					<div class="kata p-3">
						<div>
							<h4>Your profile <i class="ml-2 fa-regular fa-id-card"></i></h4>
						</div>
						<div class="name mt-3">
							<h6>Hello, <?php echo $this->session->userdata("full_name") ?></h6>
							<h6>You are a <span class="text-success"><?php echo $this->session->userdata("marvelordc") ?></span> fan!!</h6>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</body>
</html>