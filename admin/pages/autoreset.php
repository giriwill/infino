<?php
include("db.php");
?>
<!DOCTYPE html>
<html>
<head>
<script>
	function AutoRefresh( t ) {
        setTimeout("location.reload(true);", t);
    }
</script>
</head>
<body onload = "JavaScript:AutoRefresh(60000);">
<?php
	//$id = $_GET['id'];
	$sql2 = mysqli_query($con,"update tbl_login set status_login='0'");
	if($sql2){
		echo 'Auto Reset Berjalan...';
	}else{
		echo 'Auto Reset Berhenti...';
	}
		
?>
</body>
</html>