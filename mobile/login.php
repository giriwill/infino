<?php
session_start();
include("db.php");
?>
<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<script type="text/javascript" src="../js/jquery.js"></script>
<link rel="stylesheet" href="../css/global.css">
<link rel="stylesheet" href="css/awesome/css/font-awesome.css">
<script>
$(document).ready(function(){
	$('.hover_bkgr_fricc').show();
    $('.hover_bkgr_fricc').click(function(){
        $('.hover_bkgr_fricc').hide();

    });
    $('.popupCloseButton').click(function(){
        $('.hover_bkgr_fricc').hide();
    });
});
</script>
<style>
body{
	background: url(../images/background.jpg) no-repeat center center fixed;
}
*{
box-sizing: border-box;
}

.header{
	width: 100%;
	padding: 10px;
	font-size: 15px;
	background-color: #0789c1;
	color: #fff;
	text-align: center;
}
.loginBox{
	margin: auto auto auto auto;
	position: absolute;
	top:0; left: 0; right: 0; bottom: 0;
	width: 95%;
	height: 250px;
	background-color: #efefef;
	box-shadow: 0 1px 3px rgba(0,0,0,0.12), 0 1px 2px rgba(0,0,0,0.24);
	border-radius: 10px;
	overflow: hidden;
}
.loginBox .header{
	width: 100%;
	padding: 15px;
	background-color: #07004f;
	font-size: 15px;
	color:#ffffff;
}
.loginBox .body{
	padding: 5px;
}
.loginBox .body .input{
	width:100%;
	border:none;
}
.input-field {
  width: 80%;
  padding: 10px;
  outline: none;
}
.input-field:focus {
  border: 2px solid dodgerblue;
}
.icon {
  min-width: 50px;
  text-align: center;
  font-size: 15px;
}
.statusBar{
	width: 100%;
	padding: 10px;
	font-size: 12px;
	color: #dd0030;
	background-color: #ffc9d5;
	text-align: center;
}
.bloking{
     position: absolute;
     left: 0px;
     top: 0px;
     width:100%;
     height:100%;
     text-align:center;
     z-index: 1000;
     background-color: rgba(0, 0, 0, 0.6);
}
.bloking img{
	width: 50px;
	margin: auto;
	position: absolute;
	top: 0; left: 0; bottom: 0; right: 0;
}
/* Popup box BEGIN */
.hover_bkgr_fricc{
    background:rgba(0,0,0,.4);
    cursor:pointer;
    display:none;
    height:100%;
    position:fixed;
    text-align:center;
    top:0;
    width:100%;
    z-index:10000;
}
.hover_bkgr_fricc .helper{
    display:inline-block;
    height:100%;
    vertical-align:middle;
}
.hover_bkgr_fricc > div {
    background-color: #fff;
    box-shadow: 10px 10px 60px #555;
    display: inline-block;
    height: auto;
    max-width: 551px;
    min-height: 100px;
    vertical-align: middle;
    width: 70%;
    position: relative;
    border-radius: 8px;
    padding: 15px 5%;
}
.popupCloseButton {
    background-color: #fff;
    border: 3px solid #999;
    border-radius: 50px;
    cursor: pointer;
    display: inline-block;
    font-family: arial;
    font-weight: bold;
    position: absolute;
    top: -20px;
    right: -20px;
    font-size: 25px;
    line-height: 30px;
    width: 30px;
    height: 30px;
    text-align: center;
}
.popupCloseButton:hover {
    background-color: #ccc;
}
.trigger_popup_fricc {
    cursor: pointer;
    font-size: 20px;
    margin: 20px;
    display: inline-block;
    font-weight: bold;
}
/* Popup box BEGIN */
</style>
<script>
	$(document).ready(function(){
		$(".bloking").hide();
		$(".statusBar").hide();
		$("#submit").click(function(){
			var username = $("#username").val();
			var password = $("#password").val();
			if(username != "" && password != ""){				
				$(".bloking").show();
				$.ajax({
					type: "GET",
					url: "cekLogin.php",
					data:{
					    'username' : username,
					     'password' : password
					},
					     success : function(data){
					     $(".bloking").hide();
					     if(data > 0){
					     	window.location.href = "modul/listMapel.php";
					     }else if(data == 0){					     	
							$(".statusBar").show();
					     	$(".statusBar").text("Nomor Peserta dan Password Tidak Terdaftar");
					     }else{
					     	$(".statusBar").show();
					     	$(".statusBar").text("Nomor Peserta Sedang Digunakan");
					     }
					}
				});
			}else{
				$(".statusBar").show();
				$(".statusBar").text("Nomor Peserta dan Password TIDAK boleh kosong");
			}
		});
	});			
</script>
</head>
<body>
	<div class="header">
		<img src="../images/logoinfino3.png" style="width: 100px;">
	</div>
	<div class="statusBar"></div>

	<div class="loginBoxM loginBox">
		<div class="header">LOGIN</div>
		<div class="body">
			<div class="input">
			    <i class="fa fa-user icon"></i>
			    <input class="input-field" type="text" placeholder="Nomor Peserta" id="username">
			</div>
			<div class="input">
			    <i class="fa fa-key icon"></i>
			    <input class="input-field" type="password" placeholder="Password" id="password">
			</div>
			<div class="input">			    
			    <button id="submit" class="button" style="width: 100%;">LOGIN</button>
			</div>
		</div>
	</div>

	<div class="bloking">
		<img src="images/infinity.gif">
	</div>

	<div class="hover_bkgr_fricc">
	    <span class="helper"></span>
	    <div>
	        <div class="popupCloseButton">&times;</div>
	        <?php
				$sql = "select * from tbl_notes where id_notes = '1'";
				$query = mysqli_query($con,$sql);
				while($res = mysqli_fetch_array($query)){
					echo $res['notes'];
				}
				?>
	    </div>
	</div>
</body>
</html>