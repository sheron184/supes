	names_text = $("#names").text();
	username_text = $("#usernames").text();
	names = JSON.parse(names_text);
	usernames = JSON.parse(username_text);

	val = "";
	var url = window.location.href;
	var urlarr = url.split("/");
	var nametag = urlarr[urlarr.length-1];
	var unamefromurl = nametag.substring(1);
	
	function is_rated(){
		var heroid = $("#hero-id").val();
		var userid = $("#user-id").val();
				//console.log(heroid);

		$.ajax({
			url:"users/is_rated",
			method:"post",
			data:{heroid:heroid},
			success:function(response){
				console.log(response);
				if(response == "rated"){
					$(".rate-hero-sec").hide();
				}else{
					$(".rate-hero-sec").show();
				}
			}
		})
	}
	function find_hero(name){
		//add spinner
		$('<button class="btn spin-btn text-white" disabled><span class="spinner-grow spinner-grow-sm mr-2 text-warning"></span> Image loading..</button>').appendTo(".spin-div");
		hname = name;
		$.ajax({
			url:"http://localhost/supes/ajax/search.php",
			data:{name:hname},
			method:"post",
			success:function(response){
				//console.log(response);
				var data = JSON.parse(response);
				//console.log(data[0]);
				var name = data[0]['name'];
				var powerstats = JSON.parse(data[0]['powerstats']);
				var image = JSON.parse(data[0]['image']);
				var appearance = JSON.parse(data[0]['appearance']);
				var ratings = JSON.parse(data[0]['ratings']);
				var hero_id = JSON.parse(data[0]['id']);
				$("#hero-id").val(hero_id);
				is_rated();
				//console.log(ratings);
				try{
					var bio = JSON.parse(data[0]['biography']);
				}catch(e){}
				try{
					var connections = JSON.parse(data[0]['connections']);
				}catch(e){}
				try{
					var work = JSON.parse(data[0]['work']);
				}catch(e){}

				//add image
				//$(`<img class='hero-img' src='${image['url']}' >`).appendTo(".img");

				$(`<img class='hero-img' src='${image['url']}' >`).on('load', function() {
				    $(this).appendTo('.img');

				    //remove spinner
					$(".spin-btn").remove();
				});
				//add name
				$(`<h4 align='center' class='mt-2'>${name}</h4>`).appendTo(".name");
				//add ratings
				if(ratings[1]>1){
					var rate1 = ratings[0]/(ratings[1]-1);
					var rate = rate1.toFixed(1);
				}else{
					var rate = 0;
				}
				//console.log(ratings[0]/ratings[1]);
				$(`<div class='order-1'><div class='d-flex align-items-center justify-content-center'><h4 class='text-center total-rate mb-0'>${rate}</h4> <i style='font-size:18px;color:darkgoldenrod;margin-left:5px;' class="fa-solid fa-star"></i></div> <h5 class='text-center mt-3'>Supes Rating <i style='font-size:30px;color:#ff9800;' class="fa-solid fa-trophy"></i></h5><p class='text-center total-rated-users'>(${ratings[1]-1} user ratings)</p></div>`).appendTo(".rate-info");
				//add bio
				if(bio != undefined){
					var keys1 = Object.keys(bio);
					for(var i=0;i<keys1.length;i++){
						var nod = `<span class='bio-key'>${keys1[i]}</span> - <span>${bio[keys1[i]]}</span> <br>`;
						$(nod).appendTo(".bio");
					}
				}
				//add power
				var keys2 = Object.keys(powerstats);
				for(var i=0;i<keys2.length;i++){
					var nod_power = $(`<div class='prog-bar'><span class='bio-key bar-name'>${keys2[i]}</span> - <span class='bar-val'>${powerstats[keys2[i]]}%</span></div> <br>`).appendTo(".powers");
					var prog_pre = $(`<div class='prog-bar-pre'></div>`).css("width",`${powerstats[keys2[i]]}%`);
					$(prog_pre).appendTo(nod_power);	
				}
				//add appearance
				var keys3 = Object.keys(appearance);
				for(var i=0;i<keys3.length;i++){
					var nod_app = `<span class='bio-key'>${keys3[i]}</span> - <span>${appearance[keys3[i]]}</span> <br>`;
					$(nod_app).appendTo(".apperance");
				}
				//add connections
				if(connections != undefined){
					var keys4 = Object.keys(connections);
					for(var i=0;i<keys4.length;i++){
						var node_conn = `<span class='bio-key'>${keys4[i]}</span> - <span>${connections[keys4[i]]}</span> <br>`;
						$(node_conn).appendTo(".conns");
					}
				}
				if(work != undefined){
					//add works
					var keys5 = Object.keys(work);
					for(var i=0;i<keys4.length;i++){
						var node_work = `<span class='bio-key'>${keys5[i]}</span> - <span>${work[keys5[i]]}</span> <br>`;
						$(node_work).appendTo(".work");
					}	
				}
			}
		});	
	}
	if(unamefromurl == ""){
		find_hero("moonknight");
	}else{
		find_hero(unamefromurl);
	}
	function myfun(f){
		$("#results").empty();
		query = f;
		if(val != query){
			val = query;
			found_names = [];
			found_usernames = [];
			$(names).each(function(){		
				var name_part = "";
				for(var i=0;i<this.length;i++){
					name_part = name_part + this[i];
					if(name_part.localeCompare(query,'en',{ sensitivity: 'base' }) == 0){
						found_names.push(this);
						break;
					}
				}
			});
			if(found_names.length > 0){
				$(found_names).each(function(){
					var node = `<a class='p-2 border mb-2 btn mr-2 m-btn' href='#${usernames[this]}'>${this}</a>`;
					//console.log(found_names.length);
					$(node).appendTo("#results");
				});
			}else{
				var node = `<div class='p-2 border mb-2'>No match found</div>`;
				$(node).appendTo("#results");
			}
		}
	}
	ratings = [];
	$(document).on("click",".m-btn",function(){
		//add spinner
		$('<button class="btn spin-btn text-dark" disabled><span class="spinner-grow spinner-grow-sm mr-2 text-warning"></span> Image loading..</button>').appendTo(".spin-div");
		$(".rate-btn").addClass("disabled");
		$(".rate-btn").prop("disabled",true);

		$(".m-btn").removeClass("clickbtn");
		$(this).addClass("clickbtn");
		$(".data-h").empty();
		hname = $(this).text();
		$.ajax({
			url:"http://localhost/supes/ajax/search.php",
			data:{realname:hname},
			method:"post",
			success:function(response){
				var data = JSON.parse(response);
				//console.log(data[0]);
				var name = data[0]['name'];
				var powerstats = JSON.parse(data[0]['powerstats']);
				var image = JSON.parse(data[0]['image']);
				var appearance = JSON.parse(data[0]['appearance']);
				var heroRate = JSON.parse(data[0]['ratings']);
				ratings = JSON.parse(data[0]['ratings']);
				var hero_id = JSON.parse(data[0]['id']);
				$("#hero-id").val(hero_id);
				is_rated();
				//console.log(appearance);
				try{
					var bio = JSON.parse(data[0]['biography']);
				}catch(e){}
				try{
					var connections = JSON.parse(data[0]['connections']);
				}catch(e){}
				try{
					var work = JSON.parse(data[0]['work']);
				}catch(e){}

				//add image
				//$(`<img class='hero-img' src='${image['url']}' >`).appendTo(".img");

				$(`<img class='hero-img' src='${image['url']}' >`).on('load', function() {
				    $(this).appendTo('.img');

				    //remove spinner
					$(".spin-btn").remove();
				});
				//add name
				$(`<h4 align='center' class='mt-2'>${name}</h4>`).appendTo(".name");

				//add bio
				if(bio != undefined){
					var keys1 = Object.keys(bio);
					for(var i=0;i<keys1.length;i++){
						var nod = `<span class='bio-key'>${keys1[i]}</span> - <span>${bio[keys1[i]]}</span> <br>`;
						$(nod).appendTo(".bio");
					}
				}
				//add power
				var keys2 = Object.keys(powerstats);
				for(var i=0;i<keys2.length;i++){
					var nod_power = $(`<div class='prog-bar'><span class='bio-key bar-name'>${keys2[i]}</span> - <span class='bar-val'>${powerstats[keys2[i]]}%</span></div> <br>`).appendTo(".powers");
					var prog_pre = $(`<div class='prog-bar-pre'></div>`).css("width",`${powerstats[keys2[i]]}%`);
					$(prog_pre).appendTo(nod_power);	
				}
				//add ratings
				console.log(heroRate);
				if(ratings[1]>1){
					var rate2 = heroRate[0]/(heroRate[1]-1);
					var rate = rate2.toFixed(1);
				}else{
					var rate = 0;
				}
				$(`<div class='order-1'><div class='d-flex align-items-center justify-content-center'><h4 class='text-center total-rate mb-0'>${rate}</h4> <i style='font-size:18px;color:darkgoldenrod;margin-left:5px;' class="fa-solid fa-star"></i></div><h5 class='text-center mt-3'>Supes Rating <i style='font-size:30px;color:#ff9800;' class="fa-solid fa-trophy"></i></h5><p class='text-center total-rated-users'>(${ratings[1]-1} user ratings)</p></div>`).appendTo(".rate-info");
				//add appearance
				var keys3 = Object.keys(appearance);
				for(var i=0;i<keys3.length;i++){
					var nod_app = `<span class='bio-key'>${keys3[i]}</span> - <span>${appearance[keys3[i]]}</span> <br>`;
					$(nod_app).appendTo(".apperance");
				}
				//add connections
				if(connections != undefined){
					var keys4 = Object.keys(connections);
					for(var i=0;i<keys4.length;i++){
						var node_conn = `<span class='bio-key'>${keys4[i]}</span> - <span>${connections[keys4[i]]}</span> <br>`;
						$(node_conn).appendTo(".conns");
					}
				}
				if(work != undefined){
					//add works
					var keys5 = Object.keys(work);
					for(var i=0;i<keys4.length;i++){
						var node_work = `<span class='bio-key'>${keys5[i]}</span> - <span>${work[keys5[i]]}</span> <br>`;
						$(node_work).appendTo(".work");
					}	
				}
			}
		});
	});
	//=================================================rating supes ====================================================//
	function disableornot(val){
		if(val != ""){
			$(".rate-btn").removeClass("disabled");
			$(".rate-btn").prop("disabled",false);
		}
	}
	$(".star").hover(function(){
		value = parseInt($(this).attr("id"));
		$("#supesrate").val(value);
		$(".rateVal").text(value);
		for(var i=1;i<11;i++){
			if(i<=value){
				$(`#${i}`).addClass("orange");
				$(`#${i}`).addClass("selected");
			}else{
				$(`#${i}`).removeClass("orange");
				$(`#${i}`).removeClass("selected");
			}
		}
		disableornot(value);
	});
	
	$(".star").click(function(){
		value = parseInt($(this).attr("id"));
		disableornot(value);
		$("#supesrate").val(value);
		$(".rateVal").text(value);
		for(var i=1;i<11;i++){
			if(i<=value){
				$(`#${i}`).addClass("orange");
				$(`#${i}`).addClass("selected");
			}else{
				$(`#${i}`).removeClass("orange");
				$(`#${i}`).removeClass("selected");
			}
		}
	});
	$(".rate-btn").click(function(){
		id = $("#hero-id").val();
		rate = $("#supesrate").val();
		$.ajax({
			url:"users/rate_hero",
			method:"POST",
			data:{id:id,rate:rate},
			success:function(response){
				console.log(response);
				var data = JSON.parse(response);
				var rate = data['new_total_rate']/(data['new_total_rated_users']-1);
				$(".total-rate").text(`${rate.toFixed(1)}`);
				$(".total-rated-users").text(`${data['new_total_rated_users']-1} user ratings`);
				$(".star").removeClass('orange');
				$(".star").removeClass('selected');
				$(".rateVal").text("");
				$("#supesrate").val("");
				$(".rate-hero-sec").hide();
			},
			error:function(err){
				//$('body').text(JSON.stringify(err));
			}
		});
	});
