<?php
function cekUdahJawab($idJawaban){
	include("../db.php");
	$cekUdahJawab = mysqli_query($con,"select * from tbl_jawaban where id_jawaban='".$idJawaban."'");
	$resUdahJawab = mysqli_fetch_array($cekUdahJawab);
	if(isset($resUdahJawab['essay_jawaban'])){
		return $essay = $resUdahJawab['essay_jawaban'];
	}
}

echo "<div class='blokJawaban'>";
	echo "Jawaban<hr>";
	echo "<table border=0 class='tabelku'>";
		echo "<tr>";				
			echo "
			<td width='50px'>
				<textarea class='jawabanEssay' name='".$resDariJawaban['id_jawaban']."' cols='50' rows='10'>".cekUdahJawab($resDariJawaban['id_jawaban'])."</textarea>
			</td>
			";
		echo "</tr>";
	echo "</table>"; 
echo "</div>";
?>