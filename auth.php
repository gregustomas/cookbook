<?php
session_start();

function isLogedIn() {
    return isset($_SESSION['username']);
}

?>