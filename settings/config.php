<?php
$kurulumBilgileri = file_get_contents($_SERVER["DOCUMENT_ROOT"]."/kurulum/kurulum.json");
$kurulumBilgileri = json_decode($kurulumBilgileri,true);
$GLOBALS['pathPhp'] = $_SERVER["DOCUMENT_ROOT"].$kurulumBilgileri["txtKokDizin"];
$GLOBALS['pathHtml'] = $kurulumBilgileri["txtKokDizin"];


?>
