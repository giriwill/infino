<?php
session_start();
include("../db.php");
$_SESSION['audiopart'] = "";
?>
<!DOCTYPE html>
<html>
<head>
<script>
	$(document).ready(function(){
		$(".radioPilih").click(function(){
			var idJawaban = $(this).attr("name");
			var idButir = $(this).attr("id");
			var jawabanku = $(this).val();
			$.ajax({
	            type: "GET",
	            url: "../data/answerEngine.php",
	            data:{
	                'idJawaban' : idJawaban,
	                'jawabanku' : jawabanku
	            },
	            success : function(data){
	            	$("#butir"+idButir).css('background-color','#9989f4');
	            }
			});
		});

		$(".jawabanEssay").keyup(function(){
			var idJawaban = $(this).attr("name");
			var idsebenarnya = idJawaban - 1;
			var jawabanku = $(this).val();
			$.ajax({
	            type: "GET",
	            url: "../data/answerEngine2.php",
	            data:{
	                'idJawaban' : idJawaban,
	                'jawabanku' : jawabanku
	            },
	            success : function(data){	    
	            	$("#butir"+idsebenarnya).css('background-color','#9989f4');       	
	            }
			});
		});

		var isPlaying = false;
		var songTime = 0;
		var durasi = 0;
		var mp3 = $("#judulAudio").val();
		var song = document.createElement('audio');
		song.setAttribute('src','../../audios/'+mp3);
		$.get();
		song.addEventListener('loadedmetadata', function() {
			durasi = song.duration;
		});	

		$("#play").click(function(){
			song.play();
			isPlaying = true;
			$("#play").hide();
			$("#pause").show();
			$("#nextButton").prop('disabled',true);
			$("#prevButton").prop('disabled',true);
			$(".btnDI").prop('disabled',true);
			$(".DI").hide();
		});
		$("#pause").click(function(){
			song.pause();
			isPlaying = false;
			$("#play").show();
			$("#pause").hide();
			$("#nextButton").prop('disabled',false);
			$("#prevButton").prop('disabled',false);
			$(".btnDI").prop('disabled',false);
		});

		setInterval(function(){
			if(isPlaying == true){
				songTime++;
				$("#tulisan").text("Detik Ke : " + songTime + ", Dari : "+Math.floor(durasi)+" Detik");
				var gap = 200 / Math.floor(durasi) ;
				var perdetik = gap * songTime;
				$(".audioBar").css('width',perdetik);
				if(songTime >= Math.floor(durasi)){
					isPlaying = false;
					songTime = 0;
					$("#nextButton").prop('disabled',false);
					$("#prevButton").prop('disabled',false);
					$(".btnDI").prop('disabled',false);
				}
			}
		},1000);
	});
</script>
</head>
<body>
<?php
	$nopes = $_GET['nopes'];
	$idBank = $_GET['idBank'];
	$idUjian = $_GET['idUjian'];
	$limit = $_GET['limit'];
	$flag = $_GET['flag'];

	//cek jml opsi
	$jmlOpsi = mysqli_fetch_array(mysqli_query($con,"select * from tbl_bank_soal where id_bank_soal='".$idBank."'"));
		
	//munculkan soal
	mysqli_set_charset($con,'utf8');
	$sqldariJawaban = mysqli_query($con,"select * from tbl_jawaban where id_ujian='".$idUjian."' AND nopes_siswa='".$nopes."' LIMIT ".$limit." OFFSET ".$flag);
	while($resDariJawaban = mysqli_fetch_array($sqldariJawaban)){
		$sqlSoal = mysqli_fetch_array(mysqli_query($con,"select * from tbl_soal where id_soal='".$resDariJawaban['id_soal']."'"));
		$nomorDI = $resDariJawaban['nomor_soal'] - 1;
		echo "<div class='blokIdentitas'>Nomor Soal : ".$resDariJawaban['nomor_soal']." </div>";
		echo $sqlSoal['des_soal'] ;
		if($sqlSoal['audio_soal'] != ""){
			echo "<br>";
			echo "<label style='font-size:12px;color:red;'>Silahkan pause untuk pindah nomor soal</label><br>";
			echo "<div class='audioPlayer'>";
			echo "<input type='hidden' id='judulAudio' value='".$sqlSoal['audio_soal']."'>";
			echo "<button id='play' style='padding:10px;margin-right:10px;border-radius:5px;cursor:pointer;'><img src='../images/play-button.png'></button>";
			echo "<button id='pause' style='padding:10px;margin-right:10px;border-radius:5px;cursor:pointer;'><img src='../images/pause-button.png'></button>";
			echo "<div class='audioBar'></div>";
			echo "</div>";
			echo "<br>";
		}
		if($sqlSoal['jenis_soal'] == 1){
			require_once 'PGEngine2.php';
		}else{
			require_once 'EssayEngine.php';
		}
		
	}
		
?>
</body>
</html>