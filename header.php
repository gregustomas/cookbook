<?php
    include('auth.php');
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1>header</h1>
    <?php if(isLogedIn()): ?>
        <a href="dashboard.php">Dashboard</a>
    <?php else: ?>
        <a href="login.php">Přihlásit se</a>
        <br>
        <a href="login.php">Zaregistrovat se</a>
    <?php endif; ?>
</body>
</html>
