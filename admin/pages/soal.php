<!DOCTYPE html>
<html>
	<head>
		<script>
			$(document).ready(function(){
				var limit = 20;
				var flag = 0;

				if(flag <= 0){
			    	$("#btnPrev").hide();
			    }else{
			    	$("#btnPrev").show();
			    }

			    var idBank = $("#idBank").val();
			    $(".loadon").load("data/data_soal.php?idBank="+idBank+"&offset=0&limit="+limit);
			    //flag += limit;

			    $("#search").keyup(function(){
			    	var katakunci = $("#search").val();
			    	$(".loadon").load("data/data_soal.php?idBank="+idBank+"&offset=0&limit="+limit);			    	
			    });

			    $("#btnNext").click(function(){
			    	flag += limit;
			    	$(".loadon").load("data/data_soal.php?idBank="+idBank+"&offset="+flag+"&limit="+limit);			    	
			    	if(flag <= 0){
			    		$("#btnPrev").hide();
			    	}else{
			    		$("#btnPrev").show();
			    	}
			    });			    

			    $("#btnPrev").click(function(){
			    	flag -= limit;
			    	$(".loadon").load("data/data_soal.php?idBank="+idBank+"&offset="+flag+"&limit="+limit);		
			    	if(flag <= 0){
			    		$("#btnPrev").hide();
			    	}else{
			    		$("#btnPrev").show();
			    	}
			    });

			    $("#btnRestore").click(function(){
			    	$(".bloker").show();
		    	});
			    $("#btnImportWord").click(function(){
			    	$(".blokerWord").show();
		    	});

		    	$("#cancelRestore").click(function(){
			    	$(".bloker").hide();
		    	});

		    	$("#btnRestoreAudio").click(function(){
			    	$(".blokerAudio").show();
		    	});
		    	$("#cancelRestoreAudio").click(function(){
			    	$(".blokerAudio").hide();
		    	});
		    	$("#cancelWord").click(function(){
			    	$(".blokerWord").hide();
		    	});

			});
		</script>
		<style type="text/css">
			.isiBloker{
				width: 30%;
				min-height: 50px;
				margin:100px auto auto auto;
				left: 0;
				right: 0;
				background-color: #fff;
				padding:20px;
				border-radius: 3px;
			}
			#cancelRestore{
				cursor: pointer;
				position: absolute;
				display: block;
				margin:auto;
			}
			.blokerAudio{
				display: none;
				position: fixed;
				left: 0px;
				top: 0px;
				width:100%;
				height:100%;
				text-align:center;
				z-index: 100;
				background-color: rgba(0, 0, 0, 0.6);
			}
			#cancelRestoreAudio{
				cursor: pointer;
				position: absolute;
				display: block;
				margin:auto;
			}
			.blokerWord{
				display: none;
				position: fixed;
				left: 0px;
				top: 0px;
				width:100%;
				height:100%;
				text-align:center;
				z-index: 100;
				background-color: rgba(0, 0, 0, 0.6);
			}
			#cancelWord{
				cursor: pointer;
				position: absolute;
				display: block;
				margin:auto;
			}
		</style>
	</head>
<body>

	<div class="box2">
		<b>Data Soal</b>
		<br><br><br>
		<a href="?pages=soal_add&id=<?php echo $_GET['id'];?>" class="button" style="font-size: :13px;"><img style="margin-right: 5px;" src="images/plus.png">Tambah Soal</a>
		&nbsp
		<button class="buttonOrange" id="btnImportWord"><img style="margin-right: 5px;" src="images/word.png">Import Soal</button>
		&nbsp
		<a href="data/data_soal_backup.php?idBank=<?php echo $_GET['id'];?>" class="button" style="font-size: :13px;"><img style="margin-right: 5px;" src="images/save.png">Backup Soal</a>
		&nbsp
		<?php if(isset($_SESSION['audio'])){?>
			<a href="data/data_soal_download_audio.php" class="button" style="font-size: :13px;"><img style="margin-right: 5px;" src="images/save.png">Backup Audio</a>
		<?php }?>
		<button class="button" id="btnRestoreAudio"><img style="margin-right: 5px;" src="images/backup.png">Restore Audio</button>
		<br><br>
		<input type="hidden" id="idBank" value="<?php echo $_GET['id'];?>">
		<div class="loadon"></div>
		<br>
		<button class="button" id="btnPrev">Prev</button> &nbsp <button class="button" id="btnNext">Next</button>
	</div>

	<div class="modalTambah2">
		<table border="0" cellspacing="10" width="100%">
			<tr>
				<td>
					<textarea id="des" rows=""></textarea>
				</td>
			</tr>			
			<tr>
				<td><button class="button" id="btnMulaiTambah">TAMBAH</button>&nbsp<button class="button" id="btnCancelTambah">CANCEL</button></td>
			</tr>
		</table>
	</div>

	<div class="bloker">
		<div class="isiBloker">
			<span id="cancelRestore"><img src="images/cancel.png"></span>
			<form action="data/data_soal_restore.php" method="POST" enctype="multipart/form-data">
			<input type="hidden" name="idBank" value="<?php echo $_GET['id'];?>">
			<input type="file" name="fileku" class="input">
			<br><br>
			<input type="submit" name="submit" value="RESTORE SEKARANG" class="buttonHijau">
			</form>			
		</div>
	</div>

	<div class="blokerAudio">
		<div class="isiBloker">
			<span id="cancelRestoreAudio"><img src="images/cancel.png"></span>
			<form action="data/data_soal_restore_audio.php" method="POST" enctype="multipart/form-data">
			<input type="file" name="audioku" class="input">
			<br><br>
			<input type="submit" name="submit" value="RESTORE AUDIO SEKARANG" class="buttonHijau">
			</form>			
		</div>
	</div>

	<div class="blokerWord">
		<div class="isiBloker">
			<span id="cancelWord"><img src="images/cancel.png"></span>
			Silahkan import file anda<br><br>
			<a href="../admin/files/templateImportSoal.docx" style="color:red" download>[ Download template ]</a>
			<form action="data/data_soal_import_word.php" method="POST" enctype="multipart/form-data">
			<input type="hidden" name="idBank" value="<?php echo $_GET['id'];?>">
			<input type="file" name="word" class="input">
			<br><br>
			<input type="submit" name="submit" value="IMPORT SEKARANG" class="buttonHijau">
			</form>			
		</div>
	</div>
	
</body>
</html>