<?php
session_start();
require_once($_SERVER['DOCUMENT_ROOT']."/config/system.php");

echo $Member->auth($_POST["mail"],$_POST["password"]);

?>