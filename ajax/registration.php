<?php
session_start();
require_once(__DIR__."/../config/system.php");

echo $Member->registration($_POST["name"],$_POST["surname"],$_POST["mail"],$_POST["password"],$_POST["phone"]);

?>