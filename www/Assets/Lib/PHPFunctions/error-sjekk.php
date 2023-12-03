<?php
if(isset($_SESSION["error_message"])){
    echo "<h3 style='color:red;'>" . $_SESSION["error_message"] . "</h3>";
    unset($_SESSION["error_message"]);
}
?>