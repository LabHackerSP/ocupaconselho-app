<?php
header('Content-Type: image/png');

$nome = $_GET['nome'];
$candidatos = $_GET['candidatos'];
$argh = "?nome=" . $nome . "&candidatos=" . $candidatos;
$mede5 = md5($argh);
$arquivo = "../cola/".$mede5.".png";

if (file_exists($arquivo)) {
	echo imagejpeg(imagecreatefrompng($arquivo));
}
else {
	$base_url = "http://localhost:8080/cola.html" . $argh;
	$image = shell_exec('./wkhtmltoimage --quality 100 "'. $base_url . '" ' . $arquivo);
	echo imagejpeg(imagecreatefrompng($arquivo));
}
?>