<?php
    include('auth.php');
?>

<!doctype html>
<html lang="en">
    <head>
        <title>Title</title>
        <!-- Required meta tags -->
        <meta charset="utf-8" />
        <meta
            name="viewport"
            content="width=device-width, initial-scale=1, shrink-to-fit=no"
        />

        <!-- Bootstrap CSS v5.2.1 -->
        <link
            href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css"
            rel="stylesheet"
            integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN"
            crossorigin="anonymous"
        />
    </head>

    <body>

        <div class="container-fuid">
            <div class="row">
                <div class="col-auto min-vh-100 bg-dark">
                    <div class="pt-4 pb-1 px-2">
                        <a href="#" class="text-white text-decoration-none">
                            <span class="fs-4 d-none d-sm-inline">LOGO</span>
                        </a>    
                    </div>
                    <hr class="text-white">
                    <ul class="nav nav-pills flex-column mb-auto">
                        <li class="nav-item">
                            <a href="#" class="nav-link text-white active">Dashboard</a>
                        </li>
                        <li class="nav-item">
                            <a href="#" class="nav-link text-white">My recieps</a>
                        </li>
                        <li class="nav-item">
                            <a href="#" class="nav-link text-white">Popular</a>
                        </li>
                        <?php if(isLogedIn()): ?>
                        <li class="nav-item">
                            <button>Add reciep</button>
                        </li>
                        <li class="nav-item">
                            <a href="logout.php">Log out</a>
                        </li>
                        <?php else: ?>
                        <li class="nav-item">
                            <a href="login.php">Log in</a>
                        </li>
                        <li class="nav-item">
                            <a href="register.php">Register</a>
                        </li>
                        <?php endif; ?>
                    </ul>
                </div>
            </div>
        </div>


        <!-- Bootstrap JavaScript Libraries -->
        <script
            src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"
            integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r"
            crossorigin="anonymous"
        ></script>

        <script
            src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js"
            integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+"
            crossorigin="anonymous"
        ></script>
    </body>
</html>

