<?php
session_start();
include("../db.php");
?>
<!DOCTYPE html>
<html>
<head>
	<script>
		$(document).ready(function(){
			$('input[type="checkbox"]').click(function(){
			  if($(this).is(":checked")){
			    var idSiswa = this.id;
			    var idGroup = $("#idGroup").val();
			    var order = 1;
			    //alert(idSiswa);
			    //alert(idGroup);
			    $(".bloker").show();
			    $.ajax({
			        type: "GET",
			        url: "data/data_list_add.php",
			        data:{
			                'idSiswa' : idSiswa,
			                'idGroup' : idGroup,
			                'order' : order
			        },
			        success : function(data){
			                //$('.loadon').load(data);
			                //$(".loadon").load("data/data_group.php?katakunci="+katakunci);
			                //$(".modalTambah").hide();
			                //alert("Penambahan List Siswa Berhasil");
			                $(".bloker").hide();
			        }
			    });
			  }
			  else if($(this).is(":not(:checked)")){
			   	var idSiswa = this.id;
			    var idGroup = $("#idGroup").val();
			    var order = 0;
			    //alert(idSiswa);
			    //alert(idGroup);
			    $(".bloker").show();
			    $.ajax({
			        type: "GET",
			        url: "data/data_list_add.php",
			        data:{
			                'idSiswa' : idSiswa,
			                'idGroup' : idGroup,
			                'order' : order
			        },
			        success : function(data){
			                //$('.loadon').load(data);
			                //$(".loadon").load("data/data_group.php?katakunci="+katakunci);
			                //$(".modalTambah").hide();
			                //alert("Penambahan List Siswa Berhasil");
			                $(".bloker").hide();
			        }
			    });
			  }
			});
		});
	</script>
</head>
<body>
<table class="table">
			<tr>
				<th width="10">No.</th>
				<th>Nomor Peserta</th>
				<th>Nama Peserta</th>
				<th>Kelas</th>
				<th>Password</th>
				<th>Kelompok</th>
				<th width="10">Tambahkan</th>
			</tr>

			<?php
				//binding data Group
				$offset = $_GET['offset'];
				$limit = $_GET['limit'];
				if(isset($_GET['katakunci'])){
					$katakunci = $_GET['katakunci'];
				}else{
					$katakunci = "";
				}
				$no = $offset+1;
				$sql = "select * from tbl_siswa where nama_siswa LIKE '%".$katakunci."%' LIMIT ".$limit." OFFSET ".$offset;
				$query = mysqli_query($con,$sql);
				$stat = "";
				while($res = mysqli_fetch_array($query)){
					if($res['cek'] == 1){
						$stat = "checked";
					}else{
						$stat = "";
					}
					echo "<tr>";
						echo "<td>$no</td>";
						echo "<td>".$res['nopes_siswa']."</td>";
						echo "<td>".$res['nama_siswa']."</td>";				
							$kelas = "select * from tbl_kelas where id_kelas='".$res['id_kelas']."'";
							$qkelas = mysqli_query($con,$kelas);
							$dkelas = mysqli_fetch_array($qkelas);
							echo "<td>".$dkelas['nama_kelas']."</td>";
						echo "<td>".$res['password_siswa']."</td>";
						echo "<td>".$res['kelompok_siswa']."</td>";
						echo "<td align='center'>";?>
								<input style="transform: scale(2);" type="checkbox" id="<?php echo $res['id_siswa'];?>" <?php echo $stat;?> >
							</td>
						<?php
					echo "</tr>";
					$no++;
				}
			?>
		</table>
</body>
</html>