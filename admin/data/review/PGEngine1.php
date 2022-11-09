<?php
function cekUdahJawab($opsi,$idJawaban){
	include("../../db.php");
	$cekUdahJawab = mysqli_query($con,"select * from tbl_jawaban where id_bank_soal='".$idJawaban."'");
	$resUdahJawab = mysqli_fetch_array($cekUdahJawab);
	if($opsi == $resUdahJawab['pg_jawaban']){
		return "checked";
	}
}

function kunciJawaban($id,$jawaban){
	if($id == $jawaban){
		return "checked='checked'";
	}
}

echo "<div class='blokJawaban'>";
	echo "Jawaban<hr>";
	echo "<table border=0 class='tabelku'>";
		echo "<tr>";				
			echo "
			<td width='50px'>
				<label class='coolbox'>
					<input type='radio' id='' class='radioPilih' name='".$resDariJawaban['id_bank_soal']."' value='opt1_soal' ".kunciJawaban('opt1_soal',$resDariJawaban['kunciopt_soal'])."/>
					<span>A</span>
				</label>
			</td>
			";
			echo "<td>".$resDariJawaban['opt1_soal']."</td>";
		echo "</tr>";
		echo "<tr>";				
			echo "
			<td>
				<label class='coolbox'>
					<input type='radio' id='' class='radioPilih' name='".$resDariJawaban['id_bank_soal']."' value='opt2_soal' ".kunciJawaban('opt2_soal',$resDariJawaban['kunciopt_soal'])."/>
					<span>B</span>
				</label>
			</td>
			";
			echo "<td>".$resDariJawaban['opt2_soal']."</td>";
		echo "</tr>";
		echo "<tr>";				
			echo "
			<td>
				<label class='coolbox'>
					<input type='radio' id='' class='radioPilih' name='".$resDariJawaban['id_bank_soal']."' value='opt3_soal' ".kunciJawaban('opt3_soal',$resDariJawaban['kunciopt_soal'])."/>
					<span>C</span>
				</label>
			</td>
			";
			echo "<td>".$resDariJawaban['opt3_soal']."</td>";
		echo "</tr>";
		if($jmlOpsi['jml_opsi'] > 3){
		echo "<tr>";				
			echo "
			<td>
				<label class='coolbox'>
					<input type='radio' id='' class='radioPilih' name='".$resDariJawaban['id_bank_soal']."' value='opt4_soal' ".kunciJawaban('opt4_soal',$resDariJawaban['kunciopt_soal'])."/>
					<span>D</span>
				</label>
			</td>
			";
			echo "<td>".$resDariJawaban['opt4_soal']."</td>";
		echo "</tr>";		
			if($jmlOpsi['jml_opsi'] > 4){
			echo "<tr>";				
				echo "
				<td>
					<label class='coolbox'>
						<input type='radio' id='' class='radioPilih' name='".$resDariJawaban['id_bank_soal']."' value='opt5_soal' ".kunciJawaban('opt5_soal',$resDariJawaban['kunciopt_soal'])."/>
						<span>E</span>
					</label>
				</td>
				";
				echo "<td>".$resDariJawaban['opt5_soal']."</td>";
			echo "</tr>";
			}
		}
	echo "</table>"; 
echo "</div>";
?>