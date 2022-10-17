<?php

use FFI\CData;

include_once($_SERVER['DOCUMENT_ROOT'] . '/src/dbconnection.php');
if ($_POST['name'] || $_POST['password']) {
    if ($_POST['name'] && $_POST['password']) {
        $db = getDbConnection();
        $name = $_POST['name'];
        $password = $_POST['password'];

        $statement = "select id,password from users where name = :name";

        try {
            $statement = $db->prepare($statement);
            $statement->execute(['name' => $name]);
            $userData = $statement->fetchAll(\PDO::FETCH_ASSOC)[0];

            if (isset($userData) && ($_POST['password'] == $userData["password"])) {
                $name = $_POST['name'];
                $success = true;
                session_start();
                $_SESSION['name'] = $name;
                $_SESSION['id'] = $userData['id'];
                setcookie('name', $email, time() + 60 * 60 * 24 * 30, '/');
                header("Location:/");
            } else {
                $errorMessage = !isset($userdata) ? 'User doesnt\'t exist' : 'Password doesn\'t match';
            }
        } catch (\PDOException $e) {
            exit($e->getMessage());
        }
    } else {
        $errorMessage = (!isset($_POST['name'])) ? 'Enter name' : 'Enter password';
    }
} else {
    if(!isset($_POST))
    {
        $errorMessage = 'Data not sent';
    }
}
?>

<?php include($_SERVER['DOCUMENT_ROOT'] . '/Views/Templates/header.php'); ?>

<content>
    <div class="container" style="height:1000px">
        <main class="form-signin w-100 m-auto">
            <?php if ($success) { ?>
                <div class="alert alert-success" role="alert">
                    Succesfully logged in
                </div>
            <?php
            } elseif($errorMessage){
            ?>
                <div class="alert alert-danger" role="alert">
                    <?=$errorMessage?>
                </div>
            <?php } ?>
            <form method="post" action="/login/index.php">
                <img class="mb-4" src="/assets/images/logo.png" alt="" width="72" height="57">
                <h1 class="h3 mb-3 fw-normal">Sign in</h1>

                <div class="form-floating">
                    <input type="text" name="name" class="form-control" id="floatingInput" placeholder="name@example.com">
                    <label for="floatingInput">User name</label>
                </div>
                <div class="form-floating">
                    <input type="password" name="password" class="form-control" id="floatingPassword" placeholder="Password">
                    <label for="floatingPassword">Password</label>
                </div>

                <button class="w-100 btn btn-lg btn-primary" type="submit">Sign up</button>

                <div class="text-left"><a href="/register">Not a member?</a></div>

                <p class="mt-5 mb-3 text-muted">© 2017–2022</p>
            </form>
        </main>
    </div>
</content>

<?php include($_SERVER['DOCUMENT_ROOT'] . '/Views/Templates/footer.php'); ?>