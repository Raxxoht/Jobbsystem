<?php
if (!isset($_SESSION["Bruker"])) {
    header("Location: /Jobbsystem/www/index.php");
    exit(); 
}