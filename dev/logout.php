<?php

session_start();
$_SESSION["usuario"]   = "";
$_SESSION["nome"] = "";
$_SESSION["email"] = "";
$_SESSION["nivel"] = "";
$_SESSION["autenticado"]   = "";
$_SESSION["logado_em"] = "";
$_SESSION["ultima_atividade"] = "";

$url = "index.php";
header("Location:$url");


?>