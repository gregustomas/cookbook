<?php
    session_start();
    include('db.php');
?>
<?php
    $error_message = "";

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
            $error_message = "Zadej jméno.";
        }
        else if(empty($password)){
            $error_message = "Zadej heslo.";
        }
        else{
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
                    $error_message = "Zadali jste nesprávné heslo.";
                }
            } 
            else {
                $error_message = "Uživatel neexistuje.";
            } 
        }
          
    }
    mysqli_close($conn);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>

    <link
            href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css"
            rel="stylesheet"
            integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN"
            crossorigin="anonymous"
        />
</head>
<body>
    
    <div class="container-sm d-flex justify-content-center mt-4">
        <form action="<?php htmlspecialchars($_SERVER["PHP_SELF"]) ?>" method="POST"
        class="bg-dark text-white py-4 px-5 rounded w-100" style="max-width: 500px;">
        <h2>Log in</h2>  

        <div class="mb-3">
                <label for="userInput" class="form-label">Jméno</label>
                <input type="text" class="form-control" id="userInput" name="jmeno">
            </div>
            <div class="mb-3">
                <label for="passwordInput" class="form-label">Password</label>
                <input type="password" class="form-control" id="passwordInput" name="heslo">
            </div>
            <button type="submit" class="btn btn-primary">Log in</button>

            <?php if (!empty($error_message)): ?>
                <div class="alert alert-danger mt-3 text-center"><?php echo $error_message; ?></div>
            <?php endif; ?>
        </form>
    </div>

</body>
</html>

