<?php
session_start();
include("../db.php");
if($_SESSION['regis'] != 1){
	header('Location: ../index.php');
}
?>
<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<script type="text/javascript" src="../../js/jquery.js"></script>
<link rel="stylesheet" href="../../css/global.css">
<link rel="stylesheet" href="../css/awesome/css/font-awesome.css">
<style>
body{
	background-color: #efefef;
}
*{
	box-sizing: border-box;
}
.blok{
	padding: 5px;
	background-color: #fff;
	margin:50px 5px 50px 5px;
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

</style>
<script>
$(document).ready(function(){
	var idBank = $("#idBank").val();
	var jmlSoal = $("#jmlSoal").val();
	var limit = 1;
	var flag = 0;
	var nomorSoal = 1;
	$(".blokSoal").load("../data/review/data_soal.php?idBank="+idBank+"&limit="+limit+"&flag="+flag+"&nomor="+nomorSoal);
	
	$("#prevButton").hide();
	$("#prevButton").click(function(){
		nomorSoal--;
		flag --;
		$(".blokSoal").load("../data/review/data_soal.php?idBank="+idBank+"&limit="+limit+"&flag="+flag+"&nomor="+nomorSoal);

		$.ajax({
            type: "GET",
            url: "../data/review/data_soal_shadow.php",
            data:{
                'idBank' : idBank,
                'limit' : limit,
                'flag' : flag
            },
            success : function(data){
            	$(".DI").hide();
            	if(data == 1){
            		//$("#prevButton").hide();
            	}
            	if(data < $("#totalSoal").val()){
            		//$("#nextButton").show();
            		//$("#endButton").hide();
            	}
            }
		});
		$("#nextButton").show();	
		if(nomorSoal == 1){
			$("#prevButton").hide();
		}
	});

	$("#nextButton").click(function(){
		nomorSoal++;
		flag ++;
		$(".blokSoal").load("../data/review/data_soal.php?idBank="+idBank+"&limit="+limit+"&flag="+flag+"&nomor="+nomorSoal);

		$.ajax({
            type: "GET",
            url: "../data/review/data_soal_shadow.php",
            data:{
                'idBank' : idBank,
                'limit' : limit,
                'flag' : flag
            },
            success : function(data){
            	$(".DI").hide();
            	if(data > 1){
            		//$("#prevButton").show();
            	}
            	if(data == $("#totalSoal").val()){
            		//$("#nextButton").hide();
            		//$("#endButton").show();
            	}
            }
		});
		$("#prevButton").show();		
		if(nomorSoal == jmlSoal){
			$("#nextButton").hide();
		}
	});	

});
	
</script>
</head>
<body>

<input type="hidden" id="idBank" value="<?php echo $_GET['id'];?>">
<?php
//jml soal
$jmlSoal = mysqli_num_rows(mysqli_query($con,"select * from tbl_soal where id_bank_soal='".$_GET['id']."'"));
?>
<input type="hidden" id="jmlSoal" value="<?php echo $jmlSoal;?>">

<div class="blok">
	<div class="blokSoal"></div>
</div>

<div class="blokNavigasi">
	<table width="100%">
		<tr>
			<td width="50%"><button id="prevButton" class="button"><< Sebelumnya</button></td>
			<td width="50%"><button id="nextButton" class="button">Selanjutnya >></button></td>
		</tr>
	</table>	
</div>
</body>
</html>