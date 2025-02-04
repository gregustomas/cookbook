<?php
    $db_server = "localhost";
    $db_user = "root";
    $db_password = "";
    $db_name = "cookbook";
    $conn = "";


    $conn = mysqli_connect($db_server,
                            $db_user,
                            $db_password,
                            $db_name);

    if (!$conn) {
        die("Couldn't connect to the database: " . mysqli_connect_error());
    }
?>