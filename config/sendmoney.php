#!/usr/bin/php
<?php
require_once(__DIR__."/system.php");

$line = readline('Введите сумму денег');
$Presents->sendMoney($line);
echo 'Пользователям у которых не было призов отправлен денежный приз в размере: ' . $line;
?>