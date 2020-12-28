<?php
    require_once("includes/config.php");

    if(!isset($_SESSION["userLoggedIn"])) {
        // Redirect user to register
        header("Location: register.php");
    }

?>