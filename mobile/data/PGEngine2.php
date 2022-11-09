<?php
function cekUdahJawab($opsi,$idJawaban){
	include("../db.php");
	$cekUdahJawab = mysqli_query($con,"select * from tbl_jawaban where id_jawaban='".$idJawaban."'");
	$resUdahJawab = mysqli_fetch_array($cekUdahJawab);
	if($opsi == $resUdahJawab['pg_jawaban']){
		return "checked";
	}
}

echo "<div class='blokJawaban'>";
	echo "Jawaban<hr>";
	echo "<table border=0 class='tabelku'>";
		echo "<tr>";				
			echo "
			<td width='50px'>
				<label class='coolbox'>
					<input type='radio' id='".$nomorDI."' class='radioPilih' name='".$resDariJawaban['id_jawaban']."' value='".$_SESSION['opsiA'][$resDariJawaban['id_jawaban']]."' ".cekUdahJawab($_SESSION['opsiA'][$resDariJawaban['id_jawaban']],$resDariJawaban['id_jawaban'])."/>
					<span>A</span>
				</label>
			</td>
			";
			echo "<td>".$sqlSoal[$_SESSION['opsiA'][$resDariJawaban['id_jawaban']]]."</td>";
		echo "</tr>";
		echo "<tr>";				
			echo "
			<td>
				<label class='coolbox'>
					<input type='radio' id='".$nomorDI."' class='radioPilih' name='".$resDariJawaban['id_jawaban']."' value='".$_SESSION['opsiB'][$resDariJawaban['id_jawaban']]."' ".cekUdahJawab($_SESSION['opsiB'][$resDariJawaban['id_jawaban']],$resDariJawaban['id_jawaban'])."/>
					<span>B</span>
				</label>
			</td>
			";
			echo "<td>".$sqlSoal[$_SESSION['opsiB'][$resDariJawaban['id_jawaban']]]."</td>";
		echo "</tr>";
		echo "<tr>";				
			echo "
			<td>
				<label class='coolbox'>
					<input type='radio' id='".$nomorDI."' class='radioPilih' name='".$resDariJawaban['id_jawaban']."' value='".$_SESSION['opsiC'][$resDariJawaban['id_jawaban']]."' ".cekUdahJawab($_SESSION['opsiC'][$resDariJawaban['id_jawaban']],$resDariJawaban['id_jawaban'])."/>
					<span>C</span>
				</label>
			</td>
			";
			echo "<td>".$sqlSoal[$_SESSION['opsiC'][$resDariJawaban['id_jawaban']]]."</td>";
		echo "</tr>";
		if($jmlOpsi['jml_opsi'] >= 4){
		echo "<tr>";				
			echo "
			<td>
				<label class='coolbox'>
					<input type='radio' id='".$nomorDI."' class='radioPilih' name='".$resDariJawaban['id_jawaban']."' value='".$_SESSION['opsiD'][$resDariJawaban['id_jawaban']]."' ".cekUdahJawab($_SESSION['opsiD'][$resDariJawaban['id_jawaban']],$resDariJawaban['id_jawaban'])."/>
					<span>D</span>
				</label>
			</td>
			";
			echo "<td>".$sqlSoal[$_SESSION['opsiD'][$resDariJawaban['id_jawaban']]]."</td>";
		echo "</tr>";
		}	
		if($jmlOpsi['jml_opsi'] >= 5){
		echo "<tr>";				
			echo "
			<td>
				<label class='coolbox'>
					<input type='radio' id='".$nomorDI."' class='radioPilih' name='".$resDariJawaban['id_jawaban']."' value='".$_SESSION['opsiE'][$resDariJawaban['id_jawaban']]."' ".cekUdahJawab($_SESSION['opsiE'][$resDariJawaban['id_jawaban']],$resDariJawaban['id_jawaban'])."/>
					<span>E</span>
				</label>
			</td>
			";
			echo "<td>".$sqlSoal[$_SESSION['opsiE'][$resDariJawaban['id_jawaban']]]."</td>";
		echo "</tr>";
		}
	echo "</table>"; 
echo "</div>";
?>