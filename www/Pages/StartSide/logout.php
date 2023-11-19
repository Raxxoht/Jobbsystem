<?php
session_start();

unset($_SESSION["Bruker"]);
header("Location: /Jobbsystem/www/index.php");
?>