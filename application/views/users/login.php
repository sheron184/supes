<!DOCTYPE html>
<html>
<head>
	<title>SUPES | LOGIN or REGISTER</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<link rel="icon" type="image/x-icon" href="<?php echo base_url() ?>assets/imgs/superhero.png">
	<meta content='width=device-width, initial-scale=1, maximum-scale=1' name='viewport'/>
	<link rel="stylesheet" type="text/css" href="<?php echo base_url() ?>assets/css/styles.css">
	<link href="https://fonts.googleapis.com/css2?family=Karla:wght@300&display=swap" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css2?family=Kaushan+Script&display=swap" rel="stylesheet">
	<link rel="stylesheet" type="text/css" href="<?php echo base_url() ?>assets/css/forms.css">
	<link rel="stylesheet" type="text/css" href="<?php echo base_url() ?>assets/bootstrap/bootstrap.min.css">
	<script type="text/javascript" src="<?php echo base_url() ?>assets/js/jq.js"></script>
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>
	<script src="./assets/js/just-validate.production.min.js"></script>
</head>
<body class="bg">
	<div class="container">
		<div class="row justify-content-center">
			<div class="col-12 d-flex justify-content-center">
				<?php if($this->session->flashdata('user_created')): ?>
					<div class="p-3 w-50">
					    <div class="alert alert-success animate__animated animate__fadeInDown"> 
					        <?php echo $this->session->flashdata('user_created'); ?>
					    </div>
					</div>
				<?php endif; ?>
				<?php if($this->session->flashdata('user_not_created')): ?>
					<div class="p-3 w-50">
					    <div class="alert alert-danger animate__animated animate__fadeInDown"> 
					        <?php echo $this->session->flashdata('user_not_created'); ?>
					    </div>
					</div>
				<?php endif; ?>
			</div>
			<div class="col-xl-7 col-lg-7 col-md-12 col-sm-12 col-12">
				<div class="d-flex justify-content-center align-items-center" style="height:100vh;">
					<form id="RegForm" action="users/reg" method="POST" class="pt-3 pb-3 pl-5 pr-5 animate__animated registerForm bg-white">
						<div class="form-group mb-5 justify-content-center">
							<h3 class="text-center">Sign up</h3>
						</div>
						<div class="form-group">
							<div class="form-wrapper">
								<label for="">Full Name</label>
								<input id="fullname" name="full_name" type="text" class="form-control-1">
							</div>
							<div class="form-wrapper">
								<label for="">Username</label>
								<input id="username" name="username" type="text" class="form-control-1">
							</div>
						</div>
						<div class="form-wrapper">
							<label for="">Email</label>
							<input id="email" name="email" type="text" class="form-control-1">
						</div>
						<div class="form-wrapper">
							<label for="">Password</label>
							<input id="password" name="password" type="password" class="form-control-1">
						</div>
						<div class="form-wrapper">
							<label for="">Confirm Password</label>
							<input id="confpassword" type="password" class="form-control-1">
						</div>
						<div class="">
							<label>
								<input id="terms" type="checkbox" class="">
								<span class="">I accept the Terms of Use & Privacy Policy.</span>
							</label>
						</div>
						<div class="d-flex justify-content-center p-3 align-items-center">
							<button class="button-34" type="submit">Sign Up</button>
							<span>Or</span>
							<a href="#" class="movetologin btn text-info">Login</a>
						</div>
					</form>
					<!-- ==================== marvel or dc ======================== -->

					

					<!-- ==================== Login form ==================== -->
					<form id="LogForm" action="users/login" method="POST" class="pt-3 pb-3 pl-5 pr-5 animate__animated animate__fadeInRight loginForm hide bg-white">
						<div class="form-group mb-5 justify-content-center">
							<h3 class="text-center">Login</h3>
						</div>
						<div class="form-wrapper">
							<label for="">Email</label>
							<input id="emailLog" name="email" type="text" class="form-control-1">
						</div>
						<div class="form-wrapper">
							<label for="">Password</label>
							<input id="passwordLog" name="password" type="password" class="form-control-1">
						</div>
						<div class="d-flex justify-content-center p-3 align-items-center">
							<button class="button-34" type="submit">Login</button>
							<span>Or</span>
							<a href="#" class="movetosignup btn text-info">Sign Up</a>
						</div>
						<div class="d-flex justify-content-center">
							<a href="forgot_password">Forgot password?</a>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
</body>
<script type="text/javascript" src="<?php echo base_url() ?>assets/js/other.js"></script>
</html>