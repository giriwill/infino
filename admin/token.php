<?php
	function genToken(){
	$abjad = array("A","B","C","D","E","F","G","H","I","J","K","L","M","N","O","P","Q","R","S","T","U","V","W","X","Y","Z");
	$ran = array_rand($abjad,5);
	$token = $abjad[$ran[0]].$abjad[$ran[1]].$abjad[$ran[2]].$abjad[$ran[3]].$abjad[$ran[4]];
	return $token;
	}
?>