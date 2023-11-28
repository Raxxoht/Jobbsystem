<?php
session_start();

include_once $_SERVER["DOCUMENT_ROOT"] . "/Jobbsystem/www/Assets/Lib/PHPFunctions/login-sjekk.php";

unset($_SESSION["Bruker"]);
header("Location: /Jobbsystem/www/index.php");
?>