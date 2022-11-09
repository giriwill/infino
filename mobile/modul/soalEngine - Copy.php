<?php
session_start();
if($_SESSION['reg'] != 1){
	header('Location: ../login.php');
}
include("../db.php");
?>
<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<script type="text/javascript" src="../../js/jquery.js"></script>
<script type="text/javascript" src="../../js/ckeditor/ckeditor.js"></script>
<link rel="stylesheet" href="../../css/global.css">
<link rel="stylesheet" href="../css/awesome/css/font-awesome.css">
<style>
body{
	background-color: #efefef;
}
*{
	box-sizing: border-box;
}
div.header{
	display: inline-block;
	width: 100%;
	min-height: 50px;
	font-size: 15px;
	background-color: #0789c1;
	color: #fff;
	position: fixed;
	top:0;
}
div.judul{
	float: left;
	width: 40%;
	height: 50px;
	padding: 10px;
}
div.identitas{
	float: left;
	width: 35%;
	height: 50px;
	background-color: #465266;
	padding: 5px;
	overflow: hidden;
	font-size: 12px;
}
div.timer{
	float: left;
	width: 25%;
	height: 50px;
	background-color: #465266;
	padding: 5px;
	border-right: 1px solid #fff;
	text-align: center;	
	font-size: 12px;
}
div.identitas #logout{
	font-size: 12px;
	color: #ccc;
}
.blok{
	padding: 5px;
	background-color: #fff;
	margin:50px 5px 50px 5px;
}
.blokIdentitas{
	min-height: 10;
	background-color: #fff;
	border-bottom:1px solid #ccc;
	overflow: hidden;
	padding: 5px;
}
.blokSoal{
	margin: 10px auto auto 20px;
	min-height: 100px;
	background-color: #fff;
	border-radius: 5px;
	overflow: hidden;
	padding: 2px;
	width: 90%;
	text-align: justify;
	overflow: scroll;
}
.blokJawaban{
	margin-top: 50px;
	min-height: 10;
	background-color: #fff;
	overflow: hidden;
	padding: 5px;
}
.blokNavigasi{
	margin: auto;
	bottom: 0;
	position: fixed;
	min-height: 10px;
	background-color: #333;
	overflow: hidden;
	padding: 5px;
	width: 100%;
	text-align: center;
}
.isiBloker{
	margin: auto auto auto auto;
	position: absolute;
	top:0; left: 0; right: 0; bottom: 0;
	width: 300px;
	height: 230px;
	background-color: #efefef;
	box-shadow: 0 1px 3px rgba(0,0,0,0.12), 0 1px 2px rgba(0,0,0,0.24);
	border-radius: 10px;
	overflow: hidden;
	text-align: center;
	padding: 20px;
}
.bloking{
	 display: none;
     position: absolute;
     left: 0px;
     top: 0px;
     width:100%;
     height:100%;
     text-align:center;
     z-index: 1001;
     background-color: rgba(0, 0, 0, 0.6);
}
.bloking img{
	width: 50px;
	margin: auto;
	position: absolute;
	top: 0; left: 0; bottom: 0; right: 0;
}
.DIComp{
	margin: 50px auto auto auto;
	top: 0;right:0;
	position: fixed;
}
.btnDI{	
	border:1px solid #fff;
	padding: 10px;
	box-shadow: 0 1px 3px rgba(0,0,0,0.12), 0 1px 2px rgba(0,0,0,0.24);
	background-color: #fc373e;
	color:#fff;
	cursor: pointer;
	float: left;
}
.DI{	
	width: 310px;
	height: 300px;
	border:2px solid #333;
	padding: 10px;
	box-shadow: 0 1px 3px rgba(0,0,0,0.12), 0 1px 2px rgba(0,0,0,0.24);
	background-color: #fff;
	color:#333;
	overflow: scroll;
	float: left;
	display: none;
}
.butirDI{
	width: 60px;
	height: 60px;
	border:1px solid #333;
	margin: 0 5px 5px 0;
	float: left;
	text-align: center;
	padding-top: 5px;
	cursor: pointer;
	background-color: #ffb5b7;
	font-size: 20px;
	border-radius: 3px;
}
label.coolbox input {display:none;}
label.coolbox span {
	padding:5px;
    margin:2px;
    display:inline-block;
    width:30px;
    height:30px;
    line-height:15px;
    text-align:center;    
    font-weight:bold;
    font-size:16px;
    border-radius:100px;
    border:2px solid #333;
}
label.coolbox span:hover{
	cursor: pointer;
}
label.coolbox input:checked+span  {background-color:#9989f4;color:#fff;}
#pause{
	display: none;
}
.audioPlayer{
	border:1px solid #ccc;
	padding:5px;
	border-radius: 5px;
	width: 300px;
	display: inline-block;
}
.audioBar{
	width:200px;
	height: 10px;
	background-color: #fce028;
	display: inline-block;
	margin-bottom: 5px;
	border-radius:10px;
}
#endButton{
	display: none;
}
</style>
<script>
$(document).ready(function(){
	var nopes = $("#nopes").val();
	var idUjian = $("#idUjian").val();
	var idBank = $("#idBank").val();
	var limit = 1;
	var flag = 0;
	var nomorSoal = 1;
	$(".blokSoal").load("../data/data_soal.php?nopes="+nopes+"&idUjian="+idUjian+"&idBank="+idBank+"&limit="+limit+"&flag="+flag);

	$("#prevButton").hide();
	$("#prevButton").click(function(){
		flag --;
		$(".blokSoal").load("../data/data_soal.php?nopes="+nopes+"&idUjian="+idUjian+"&idBank="+idBank+"&limit="+limit+"&flag="+flag);

		$.ajax({
            type: "GET",
            url: "../data/data_soal_shadow.php",
            data:{
                'nopes' : nopes,
                'idUjian' : idUjian,
                'idBank' : idBank,
                'limit' : limit,
                'flag' : flag
            },
            success : function(data){
            	$(".DI").hide();
            	if(data == 1){
            		$("#prevButton").hide();
            	}
            	if(data < $("#totalSoal").val()){
            		$("#nextButton").show();
            		$("#endButton").hide();
            	}
            }
		});		
	});

	$("#nextButton").click(function(){
		flag ++;
		$(".blokSoal").load("../data/data_soal.php?nopes="+nopes+"&idUjian="+idUjian+"&idBank="+idBank+"&limit="+limit+"&flag="+flag);

		$.ajax({
            type: "GET",
            url: "../data/data_soal_shadow.php",
            data:{
                'nopes' : nopes,
                'idUjian' : idUjian,
                'idBank' : idBank,
                'limit' : limit,
                'flag' : flag
            },
            success : function(data){
            	$(".DI").hide();
            	if(data > 1){
            		$("#prevButton").show();
            	}
            	if(data == $("#totalSoal").val()){
            		$("#nextButton").hide();
            		$("#endButton").show();
            	}
            }
		});
	});

	$(".btnDI").click(function(){
		$(".DI").animate({width:"toggle"});
	});

	var totalSoal = $("#totalSoal").val();
	for(var s=0;s<totalSoal;s++){
		$("#butir"+s).click(function(){
			$(".DI").animate({width:"toggle"});
			$(".blokSoal").load("../data/data_soal.php?nopes="+nopes+"&idUjian="+idUjian+"&idBank="+idBank+"&limit="+limit+"&flag="+$(this).val());
			flag = $(this).val();
			$.ajax({
		        type: "GET",
		        url: "../data/data_soal_shadow.php",
		        data:{
		            'nopes' : nopes,
		            'idUjian' : idUjian,
		            'idBank' : idBank,
		            'limit' : limit,
		            'flag' : $(this).val()
		        },
		        success : function(data){
		        	if(data > 1){
		        		$("#prevButton").show();
		        	}else{
		        		$("#prevButton").hide();
		        	}
		        	if(data == $("#totalSoal").val()){
		        		$("#nextButton").hide();
		        		$("#endButton").show();
		        	}else{
		        		$("#nextButton").show();
		        		$("#endButton").hide();
		        	}
		        }
			});
		});
	}
	var waktu = $("#timed").val();
	var detik = waktu * 60;
	var saveTime = 60;
	var recordTime = saveTime;
	var isPlaying = 1;

	setInterval(function(){
		if(detik > 0){
			detik -= 1;
			var jam = detik/3600;
			var sisamenit = jam-(Math.floor(jam));
			var menit = Math.ceil(sisamenit * 60);
			var komposisi = Math.floor(jam)+" Jam : "+menit+" Menit";
			$(".timer").text(komposisi);
			if(recordTime > 0){
				recordTime -= 1;
			}else{
				recordTime = saveTime;
				var idUjian = $("#idUjian").val();
				var nopes = $("#nopes").val();
				var sisaWaktu = detik/60;
				$.ajax({
	            type: "GET",
	            url: "../data/updateTime.php",
	            data:{
	                'idUjian' : idUjian,
	                'nopes' : nopes,
	                'siswaWaktu' : sisaWaktu
	            },
	            success : function(data){
	            }
				});
			}
		}else{
			var idUjian = $("#idUjian").val();
			var nopes = $("#nopes").val();
			$.ajax({
	            type: "GET",
	            url: "../data/endingTime.php",
	            data:{
	                'idUjian' : idUjian,
	                'nopes' : nopes
	            },
	            success : function(data){
	            	$(".bloker").show();
	            }
            });
		}
	},1000);

	if($("#timed").val() == -1){
		$(".bloker").show();
	}

	$("#endButton").click(function(){
		$(".bloker2").show();
	});

	$("#btnBatalSelesai").click(function(){
		$(".bloker2").hide();
	});

	$("#btnJadiSelesai").click(function(){
		var idUjian = $("#idUjian").val();
		var nopes = $("#nopes").val();
		$.ajax({
            type: "GET",
            url: "../data/endingTime.php",
            data:{
                'idUjian' : idUjian,
                'nopes' : nopes
            },
            success : function(data){
            	$(".bloker2").hide();
            	$(".bloker").show();
            }
        });
	});

});			
</script>
</head>
<body>
<?php
$sqlNama = mysqli_query($con,"select * from tbl_siswa where nopes_siswa='".$_SESSION['nopes']."'");
$resNama = mysqli_fetch_array($sqlNama);

$cekwaktudistatus = mysqli_query($con,"select * from tbl_status_ujian where id_ujian='".$_GET['idUjian']."' AND nopes_siswa='".$_SESSION['nopes']."'");
$jmlcekwaktudistatus = mysqli_num_rows($cekwaktudistatus);
$rescekwaktudistatus = mysqli_fetch_array($cekwaktudistatus);

if($rescekwaktudistatus['status'] != 1){
	if($jmlcekwaktudistatus > 0 && $rescekwaktudistatus['sisa_waktu'] > 0){
		echo "<input type='hidden' id='timed' value='".$rescekwaktudistatus['sisa_waktu']."'>";
	}else{
		$sqlTimer = mysqli_query($con,"select * from tbl_ujian where id_ujian='".$_GET['idUjian']."'");
		$resTimer = mysqli_fetch_array($sqlTimer);
		echo "<input type='hidden' id='timed' value='".$resTimer['lama_ujian']."'>";
	}
}else{
	echo "<input type='hidden' id='timed' value='-1'>";

}
?>
<div class="header">
	<div class="judul">
		<img src="../../images/logoinfino3.png" style="width: 100px;">
	</div>
	<div class="timer"></div>
	<div class="identitas">
		<label><?php echo $resNama['nama_siswa'];?></label><br>
		<label id="logout"><a href="../logout.php" style="color: #ccc;">Logout</a></label>
	</div>
</div>

<input type="hidden" id="nopes" value="<?php echo $_SESSION['nopes'];?>">
<input type="hidden" id="idUjian" value="<?php echo $_GET['idUjian'];?>">
<input type="hidden" id="idBank" value="<?php echo $_GET['idBank'];?>">

<?php
$sqldariJawaban = mysqli_query($con,"select * from tbl_jawaban where id_ujian='".$_GET['idUjian']."' AND nopes_siswa='".$_SESSION['nopes']."'");
$jmlSeluruhSoal = mysqli_num_rows($sqldariJawaban);
?>

<input type="hidden" id="totalSoal" value="<?php echo $jmlSeluruhSoal;?>">

<div class="blok">
	<div class="blokSoal"></div>
</div>

<div class="blokNavigasi">
	<table width="100%">
		<tr>
			<td width="50%"><button id="prevButton" class="button"><< Sebelumnya</button></td>
			<td width="50%"><button id="nextButton" class="button">Selanjutnya >></button><button id="endButton" class="buttonOrange" style="background-color: red;">SELESAI</button></td>
		</tr>
	</table>	
</div>

<div class="bloker">
	<div class="isiBloker">
		<img src="../images/warning.png"><br><br>
		Nomor Peserta Sudah Selesai Pada Ujian Ini !<br><br>
		<a href="../logout.php" class="buttonOrange">LOGOUT</a>&nbsp
		<?php 
		//cek lihat hasil di tbl_ujian
		$cekLihatHasil = mysqli_fetch_array(mysqli_query($con,"select * from tbl_ujian where id_ujian='".$_GET['idUjian']."'"));
		if($cekLihatHasil['lihat_hasil'] == 1){
		?>
		<a href="hasilUjian.php?idUjian=<?php echo $_GET['idUjian'];?>&nopes=<?php echo $_SESSION['nopes'];?>" class="buttonHijau">LIHAT HASIL</a>
		<?php }?>
	</div>
</div>

<div class="bloker2">
	<div class="isiBloker">
		<img src="../images/warning.png"><br><br>
		Apakah Anda Menyelesaikan Ujian Ini ?<br><br>
		<button id="btnJadiSelesai" class="buttonOrange">YA</button>&nbsp<button id="btnBatalSelesai" class="buttonOrange">TIDAK</button>
	</div>
</div>

<div class="bloking">
	<img src="../images/infinity.gif">
</div>

<div class="DIComp">
	<button class="btnDI">
		Daftar Isi
	</button>

	<div class="DI">
		<?php
		$i = 0;
		while($resSeluruhSoal = mysqli_fetch_array($sqldariJawaban)){
			$muncul = $i +1;
			if($resSeluruhSoal['pg_jawaban'] != "" || $resSeluruhSoal['essay_jawaban'] != ""){
				echo "<button class='butirDI' style='background-color:#9989f4' id='butir".$i."' value='".$i."'>".$muncul."</button>";
			}else{
				echo "<button class='butirDI' id='butir".$i."' value='".$i."'>".$muncul."</button>";
			}			
			$i++;
		}
		?>
	</div>
</div>
</body>
</html>