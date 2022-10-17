<?php
include_once($_SERVER['DOCUMENT_ROOT'] . '/src/dbconnection.php');
session_start();
if ($_POST['name'] || $_POST['password']) {
    if ($_POST['name'] && $_POST['password']) {
        $db = getDbConnection();
        $name = $_POST['name'];
        $password = $_POST['password'];

        $statement = "INSERT INTO `users` (`id`, `name`, `password`) VALUES (NULL, :name, :password);";

        try {
            $statement = $db->prepare($statement);
            $statement->execute(['name' => $name, 'password' => $password]);
            $userData = $statement->fetchAll(\PDO::FETCH_ASSOC);
            if(isset($userData))
            {
                $success = true;
            }
        } catch (\PDOException $e) {
            exit($e->getMessage());
        }
    } else {
        $errorMessage = (!isset($_POST['name'])) ? 'Enter name' : 'Enter password';
    }
} else {
    if (!isset($_POST)) {
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
                    Succesfully registered
                </div>
            <?php
            } elseif($errorMessage){
            ?>
                <div class="alert alert-danger" role="alert">
                    <?=$errorMessage?>
                </div>
            <?php } ?>
            <form method="post" action="/register/index.php">
                <img class="mb-4" src="/assets/images/logo.png" alt="" width="72" height="57">
                <h1 class="h3 mb-3 fw-normal">Signup</h1>

                <div class="form-floating">
                    <input type="text" name="name" class="form-control" id="floatingInput" placeholder="name@example.com">
                    <label for="floatingInput">User name</label>
                </div>
                <div class="form-floating">
                    <input type="password" name="password" class="form-control" id="floatingPassword" placeholder="Password">
                    <label for="floatingPassword">Password</label>
                </div>

                <button class="w-100 btn btn-lg btn-primary" type="submit">Sign up</button>
                <div class="text-left"><a href="/login">Already a user?</a></div>
                <p class="mt-5 mb-3 text-muted">© 2017–2022</p>
            </form>
        </main>
    </div>
</content>

<?php include($_SERVER['DOCUMENT_ROOT'] . '/Views/Templates/footer.php'); ?>