<!DOCTYPE html>
<html>
	<head>
		<script>
			$(document).ready(function(){
				var limit = 30;
				var flag = 0;

				if(flag <= 0){
			    	$("#btnPrev").hide();
			    }else{
			    	$("#btnPrev").show();
			    }

			    var katakunci = $("#search").val();
			    $(".loadon").load("data/data_statusujian.php?katakunci="+katakunci+"&offset=0&limit="+limit);
			    //flag += limit;

			    $("#search").keyup(function(){
			    	var katakunci = $("#search").val();
			    	$(".loadon").load("data/data_statusujian.php?katakunci="+katakunci+"&offset=0&limit="+limit);			    	
			    });

			    $("#btnNext").click(function(){
			    	flag += limit;
			    	$(".loadon").load("data/data_statusujian.php?katakunci="+katakunci+"&offset="+flag+"&limit="+limit);			    	
			    	if(flag <= 0){
			    		$("#btnPrev").hide();
			    	}else{
			    		$("#btnPrev").show();
			    	}
			    });			    

			    $("#btnPrev").click(function(){
			    	flag -= limit;
			    	$(".loadon").load("data/data_statusujian.php?katakunci="+katakunci+"&offset="+flag+"&limit="+limit);		
			    	if(flag <= 0){
			    		$("#btnPrev").hide();
			    	}else{
			    		$("#btnPrev").show();
			    	}
			    });

			});			
		</script>
	</head>
<body>

	<div class="box2">
		<b>Status Ujian Peserta</b>
		<br><br><br>
		<input type="text" class="input" id="search" placeholder="Search Nomor Peserta">
		<br><br>
		<div class="loadon"></div>
		<br>
		<button class="button" id="btnPrev">Prev</button> &nbsp <button class="button" id="btnNext">Next</button>
	</div>

	
</body>
</html>