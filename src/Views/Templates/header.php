<?php
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../assets/css/bootstrap.min.css">
</head>

<body>
    <header>
        <div class="container">
            <header class="d-flex flex-wrap align-items-center justify-content-center justify-content-md-between py-3 mb-4 border-bottom">
                <a href="/" class="d-flex align-items-center col-md-3 mb-2 mb-md-0 text-dark text-decoration-none">
                    <svg class="bi me-2" width="40" height="32" role="img" aria-label="Bootstrap">
                        <use xlink:href="#bootstrap"></use>
                    </svg>
                </a>

                <ul class="nav col-12 col-md-auto mb-2 justify-content-center mb-md-0">
                    <li><a href="/" class="nav-link px-2 link-secondary">Home</a></li>
                </ul>
                <?php
                if(isset($_SESSION['name'])){
                    ?>
                    <div class="col-md-3 text-end">
                    <h4>Привет <?=$_SESSION['name']?></h4>
                    <a type="button" href="/src/exit.php" class="btn btn-primary">Выйти</a>
                </div>
                <?php
                }else{?>
                <div class="col-md-3 text-end">
                    <a type="button" href="/login" class="btn btn-outline-primary me-2">Login</a>
                    <a type="button" href="/register" class="btn btn-primary">Sign-up</a>
                </div>
                <?php } ?>
            </header>
        </div>
    </header>