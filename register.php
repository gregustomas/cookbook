<?php
    include('db.php');
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrace</title>
</head>
<body>

    <form action="<?php htmlspecialchars($_SERVER["PHP_SELF"]) ?>" method="POST">
        <h2>Registrace</h2>
        username:
        <input type="text" name="jmeno">
        <br>
        heslo:
        <input type="password" name="heslo">
        <br>
        <button type="submit" name="submit" value="register">Zaregistrovat se</button>
    </form>

</body>
</html>

<?php

    if($_SERVER["REQUEST_METHOD"] == "POST"){
        //security filtr
        $username = filter_input(INPUT_POST, "jmeno", FILTER_SANITIZE_SPECIAL_CHARS);
        $password = filter_input(INPUT_POST, "heslo", FILTER_SANITIZE_SPECIAL_CHARS);
    
        //opatření prázdných hodnot
        if(empty($username)){
            echo "Zadejte jméno";
        }
        else if(empty($password)){
            echo "Zadejte heslo";
        }
        else{
            //hash hesla, pokud jsou údaje OK a insert do db
            $hash = password_hash($password, PASSWORD_DEFAULT);
            $sql = "INSERT INTO uzivatele (jmeno, heslo)
                    VALUES('$username','$hash')";
            //unique jmeno handle
            try{
                mysqli_query($conn, $sql);
                echo "Registrace proběhla úspěšně";
                header("Location: login.php");
                exit;
            }
            catch(mysqli_sql_exception){
                echo "Toto jméno již někdo používá :(";
            }
            
        }
    }

    mysqli_close($conn);
?>