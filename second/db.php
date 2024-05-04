<?php 
    $mysql = new mysqli("localhost", "root", "root", "logintest");
    $mysql->query("SET NAMES 'utf-8'");
    $mysql->query("INSERT INTO `users` (`fullname`, `email`, `password`) VALUES('$fullname', '$email', '$password')");
?>
