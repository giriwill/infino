<?php
session_start();
include("db.php");
$upLogin = mysqli_query($con,"update tbl_login set status_login='0' where nopes_siswa='".$_SESSION['nopes']."'");
session_destroy();
header('Location: index.php');
?>