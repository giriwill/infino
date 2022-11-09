<?php
session_start();
include("admin/db.php");
?>
<!DOCTYPE html>
<html>
<head>
<title>INFINO E-RAPOR V 1.0</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="stylesheet" href="css/global.css">
<link rel="icon" href="../icon.png">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
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
<style type="text/css">
	select {
		padding: 5px 3px 5px 3px;
	}
	input {
		padding: 5px 3px 5px 3px;
	}
	body,html{
		height: 100%;
		margin: 0;
	}
	.bg {
	  /* The image used */
	  background-image: url("images/gambar.jpg");

	  /* Full height */
	  height: 100%; 

	  /* Center and scale the image nicely */
	  background-position: center;
	  background-repeat: no-repeat;
	  background-size: cover;

	  padding-top: 200px;
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
</head>
<body>
	
	<div class="bg">
			<table align="center">
				<tr>
					<td align="center"><div style="color:#00ffff;font-size:30px;stroke:black;background-color: black;padding:5px 10px 5px 10px;"><b>PILIH PERANGKAT</b></div></td>
				</tr>
				<tr>
					<td>&nbsp</td>
				</tr>
				<tr>
					<td align="center">
						<a href="/infino/mobile"><img src="images/smartphone.png"></a>
					</td>
				</tr>
				<tr>
					<td>&nbsp</td>
				</tr>
				<tr>
					<td align="center">
						<a href="/infino/client"><img src="images/laptop.png"></a>
					</td>
				</tr>
			</table>
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