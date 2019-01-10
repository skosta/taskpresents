<?php 
//подключение классов	
require_once($_SERVER['DOCUMENT_ROOT']."/functions/db.php");
require_once($_SERVER['DOCUMENT_ROOT']."/functions/member.php");
require_once($_SERVER['DOCUMENT_ROOT']."/functions/presents.php");

//Объявление классов
$sql = new sql();
$Member = new Member();
$Presents = new Presents();

echo $Presents->check();
?>