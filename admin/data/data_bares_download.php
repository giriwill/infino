<?php
header("Content-Disposition: attachment; filename=\"" . basename($_GET['kode']) . "\"");
header("Content-Type: application/force-download");
header("Content-Length: " . filesize($_GET['kode']));
header("Connection: close");
include $_GET['kode'];
unlink($_GET['kode']);
?>