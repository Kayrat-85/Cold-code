<?php
    include("path.php");
    include("App/database/connect.php");
    //include("App/controllers/registrationController.php");
    include("App/controllers/loginController.php");
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <?php
            include("App/include/head.php");
        ?>
        <title>Авторизация||Cold code</title>
    </head>

    <body>
        <!-- Header -->
        <?php
            include("App/include/header.php");
        ?>
 
        <!-- Form начало-->
        <div class="container reg_form">
            <form class="row justify-content-center" method="post" action="login.php"> 
                <h2 class="col-12">Авторизация</h2>
                <?php include('App/database/errors.php'); ?>
                <div class="mb-3 col-12 col-md-4">
                    <label for="formGroupExampleInput" class="form-label">Ваш логин</label>
                    <input type="text" name="username" value="<?php echo $username; ?>" class="form-control" id="formGroupExamleInput" placeholder="Username">
                </div>
                <div class="w-100"></div>
                <div class="mb-3 col-12 col-md-4">
                    <label for="exampleInputPassword1" class="form-label">Пароль</label>
                    <input type="password" name="password" class="form-control" id="exampleInputPassword1" placeholder="Password">
                </div>
                <div class="w-100"></div>
                <div class="mb-3 col-12 col-md-4">
                    <button type="submit" class="btn btn-success" name="login_btn">Войти</button>
                    <a href="registration.php">Зарегистрироваться</a>
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
