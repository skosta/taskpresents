<?php
session_start();
require_once(__DIR__."/../config/system.php");

$Presents->moneyConvertPoints($_POST["idPresents"]);
?>