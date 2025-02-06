<?php
    include('db.php');
?>
<?php
    $error_message = "";

    if($_SERVER["REQUEST_METHOD"] == "POST"){
        //security filtr
        $username = filter_input(INPUT_POST, "jmeno", FILTER_SANITIZE_SPECIAL_CHARS);
        $password = filter_input(INPUT_POST, "heslo", FILTER_SANITIZE_SPECIAL_CHARS);
    
        //opatření prázdných hodnot
        if(empty($username)){
            $error_message = "Zadejte jméno";
        }
        else if(empty($password)){
            $error_message = "Zadejte heslo";
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
                mysqli_close($conn);
                header("Location: login.php");
                exit;
            }
            catch(mysqli_sql_exception){
                $error_message = "Toto jméno již někdo používá :(";
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
    <title>Registrace</title>

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
            <button type="submit" class="btn btn-primary" value="register">Register</button>
        
            <?php if (!empty($error_message)): ?>
                <div class="alert alert-danger mt-3 text-center"><?php echo $error_message; ?></div>
            <?php endif; ?>
        </form>
    </div>

</body>
</html>