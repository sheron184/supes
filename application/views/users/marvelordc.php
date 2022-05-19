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
	<link rel="stylesheet" type="text/css" href="<?php echo base_url() ?>assets/css/marvelordc.css">
	<link rel="stylesheet" type="text/css" href="<?php echo base_url() ?>assets/bootstrap/bootstrap.min.css">
	<script type="text/javascript" src="<?php echo base_url() ?>assets/js/jq.js"></script>
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>
	<link href="https://fonts.googleapis.com/css2?family=Permanent+Marker&display=swap" rel="stylesheet">
</head>
<body>
	<div class="container">
		<div class="row justify-content-center">
			<div class="col-12 mt-4 mb-4">
				<div class="pt-3 pb-3">
					<h3 class="animate__animated animate__fadeInDown" style="font-family: Permanent Marker;font-size: 40px;" align="center">Are you a Marvel or DC fan..?</h3>
				</div>
			</div>
			<div class="col-xl-4 col-lg-4 col-md-12 col-sm-12 col-12">
				<a href="#" class="btn cardbtn">
					<div id="marvel" class="fancard shadow position-relative animate__animated animate__backInDown">
						<div style="width:100%;height: 100%;background:#11111175;z-index: 0;position: absolute;top:0px;"><h4 class="p-3">Marvel</h4></div>
					</div>
				</a>
			</div>
			<div class="col-xl-1 col-lg-1 col-md-12 col-sm-12 col-12"></div>
			<div class="col-xl-4 col-lg-4 col-md-12 col-sm-12 col-12">
				<a href="#" class="btn cardbtn">
					<div id="dc" class="fancard shadow position-relative animate__animated animate__backInDown">
						<div style="width:100%;height: 100%;background:#11111175;z-index: 0;position: absolute;top: 0px;"><h4 class="p-3">DC</h4></div>
					</div>
				</a>
			</div>
			<div class="col-12">
				<div class="d-flex justify-content-center mt-3 mb-3">
					<form id="fanform" action="add_fan" method="POST">
						<input id="sendfan" type="hidden" name="marvelordc">
						<button class="button-85" type="submit">Continue</button>
					</form> 
				</div>
			</div>
		</div>
	</div>
</body>
<script type="text/javascript">
	cardSelected = "";
	$("#sendfan").val(cardSelected);
	$(".cardbtn").click(function(){
		$(".fancard").each(function(){
			$(this).removeClass("selected-border");
			$(this).find(".check").empty();
		});
		if(!$(this).find(".fancard").hasClass("selected-border")){
			cardSelected = $(this).find(".fancard").attr("id");
			$("<div style='width:20px;height:20px;background:red;border-radius:50%;'></div>").appendTo($(this).find(".fancard").find(".check"));
			$(this).find(".fancard").addClass("selected-border");
			//console.log(cardSelected);
		}else{
			cardSelected = "";
			$(this).find(".fancard").find(".check").empty();
			$(this).find(".fancard").removeClass("selected-border");
		}
		$("#sendfan").val(cardSelected);
	});
	$("#fanform").submit(function(e){
		if($("#sendfan").val() == ""){
			e.preventDefault();
			alert("Please choose one!");
		}else{
			$("#fanform").unbind();
		}
	});
</script>
</html>