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
					<input type='radio' id='".$nomorDI."' class='radioPilih' name='".$resDariJawaban['id_jawaban']."' value='opt1_soal' ".cekUdahJawab('opt1_soal',$resDariJawaban['id_jawaban'])."/>
					<span>A</span>
				</label>
			</td>
			";
			echo "<td>".$sqlSoal['opt1_soal']."</td>";
		echo "</tr>";
		echo "<tr>";				
			echo "
			<td>
				<label class='coolbox'>
					<input type='radio' id='".$nomorDI."' class='radioPilih' name='".$resDariJawaban['id_jawaban']."' value='opt2_soal' ".cekUdahJawab('opt2_soal',$resDariJawaban['id_jawaban'])."/>
					<span>B</span>
				</label>
			</td>
			";
			echo "<td>".$sqlSoal['opt2_soal']."</td>";
		echo "</tr>";
		echo "<tr>";				
			echo "
			<td>
				<label class='coolbox'>
					<input type='radio' id='".$nomorDI."' class='radioPilih' name='".$resDariJawaban['id_jawaban']."' value='opt3_soal' ".cekUdahJawab('opt3_soal',$resDariJawaban['id_jawaban'])."/>
					<span>C</span>
				</label>
			</td>
			";
			echo "<td>".$sqlSoal['opt3_soal']."</td>";
		echo "</tr>";
		if($jmlOpsi['jml_opsi'] >= 4){
		echo "<tr>";				
			echo "
			<td>
				<label class='coolbox'>
					<input type='radio' id='".$nomorDI."' class='radioPilih' name='".$resDariJawaban['id_jawaban']."' value='opt4_soal' ".cekUdahJawab('opt4_soal',$resDariJawaban['id_jawaban'])."/>
					<span>D</span>
				</label>
			</td>
			";
			echo "<td>".$sqlSoal['opt4_soal']."</td>";
		echo "</tr>";
		}	
		if($jmlOpsi['jml_opsi'] >= 5){
		echo "<tr>";				
			echo "
			<td>
				<label class='coolbox'>
					<input type='radio' id='".$nomorDI."' class='radioPilih' name='".$resDariJawaban['id_jawaban']."' value='opt5_soal' ".cekUdahJawab('opt5_soal',$resDariJawaban['id_jawaban'])."/>
					<span>E</span>
				</label>
			</td>
			";
			echo "<td>".$sqlSoal['opt5_soal']."</td>";
		echo "</tr>";
		}
	echo "</table>"; 
echo "</div>";
?>