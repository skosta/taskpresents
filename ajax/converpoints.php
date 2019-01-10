<?php
session_start();
require_once($_SERVER['DOCUMENT_ROOT']."/config/system.php");

$Presents->moneyConvertPoints($_POST["idPresents"]);
?>