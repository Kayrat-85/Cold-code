<?php
    include("path.php");
    include("App/database/connect.php");
    include("App/controllers/registrationController.php");
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <?php
            include("App/include/head.php");
        ?>
        <title>Регистрация||Cold code</title>
    </head>

    <body>
        <!-- Header -->
        <?php
            include("App/include/header.php");
        ?>
 
        <!-- Form начало-->
        <div class="container reg_form">
            <form class="row justify-content-center" method="post" action="registration.php"> 
                <h2>Регистрация</h2>
                <?php include('App/database/errors.php'); ?>
                <div class="mb-3 col-12 col-md-4">
                    <label for="formGroupExampleInput" class="form-label">Examle label</label>
                    <input type="text" name="username" value="<?php echo $username; ?>" class="form-control" id="formGroupExamleInput" placeholder="Введите ваш логин">
                </div>
                <div class="w-100"></div>
                <div class="mb-3 col-12 col-md-4">
                    <label for="exampleInputEmail1" class="form-label">Email address</label>
                    <input name="email" type="email" value="<?php echo $email ?>" class="form-control" id="exampleInputEmail1" placeholder="Email" aria-describedby="emailHelp">
                    <div id="emailHelp" class="form-text">Ваш email адрес не будет использован для спама!</div>
                </div>
                <div class="w-100"></div>
                <div class="mb-3 col-12 col-md-4">
                    <label for="exampleInputPassword1" class="form-label">Password</label>
                    <input name="password_1" type="password" class="form-control" id="exampleInputPassword1" placeholder="Введите пароль">
                </div>
                <div class="w-100"></div>
                <div class="mb-3 col-12 col-md-4">
                    <label for="exampleInputPassword2" class="form-label">Password</label>
                    <input name="password_2" type="password" class="form-control" id="exampleInputPassword2" placeholder="повторно введите пароль">
                </div>
                <div class="w-100"></div>
                <div class="mb-3 col-12 col-md-4">
                    <button type="submit" class="btn btn-success" name="reg_user">Регистрация</button>
                    <a href="login.php">Войти </a>
                </div>
            </form>
        </div>
        <!-- Form конец-->
        <br>

        <?php
            include("App/include/footer.php");
        ?>


        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js" 
            integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4" crossorigin="anonymous">
        </script>
    </body>
</html>
