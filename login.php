<?php
    session_start();
    include('db.php');
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
</head>
<body>
<form action="<?php htmlspecialchars($_SERVER["PHP_SELF"]) ?>" method="POST">
        <h2>Přihlášení</h2>
        username:
        <input type="text" name="jmeno">
        <br>
        heslo:
        <input type="password" name="heslo">
        <br>
        <button type="submit" name="submit" value="login">Přihlásit se</button>
    </form>
</body>
</html>

<?php
    //security filtr
    $username = filter_input(INPUT_POST, "jmeno", FILTER_SANITIZE_SPECIAL_CHARS);
    $password = filter_input(INPUT_POST, "heslo", FILTER_SANITIZE_SPECIAL_CHARS);

    if($_SERVER["REQUEST_METHOD"] == "POST"){
        
        
        //hledání uživatele & ochrana před SQL injekcím
        $sql = "SELECT * FROM uzivatele WHERE jmeno = ?";
        $stmt = mysqli_prepare($conn, $sql);
        mysqli_stmt_bind_param($stmt, "s", $username);  // nahradí ? a "s" znamený string
        mysqli_stmt_execute($stmt); //vykoná příkaz
        $result = mysqli_stmt_get_result($stmt); //vrací objekt s informacemi z databáze

        if(empty($username)){
            echo "Zadejte jméno";
        }
        else if(empty($password)){
            echo "Zadejte heslo";
        }
        else{
        }
        if($user = mysqli_fetch_assoc($result)){ //pokud se našli jakékoliv data v $result tak se vykoná podmínka, data = nazvy sloupce a hodnoty k nim v sql
            if(password_verify($password, $user['heslo'])){ //ověření hesla
                //nastavení session - úspěšné přihlášení
                $_SESSION['username'] = $username;
                $_SESSION['password'] = $password;
                echo "Přihlášení proběhlo úspěšně";
                mysqli_close($conn);
                header('Location: dashboard.php');
                exit;
            } 
            else {
                echo "Zadali jste nesprávné heslo.";
            }
        } 
        else {
            echo "Uživatel neexistuje.";
        }   
    }
    mysqli_close($conn);
?>