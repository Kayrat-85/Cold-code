<?php
    include("../path.php");
    include("../App/database/connect.php");
    include("../App/controllers/postsController.php");
    include("../App/controllers/registrationController.php");
    include("controllersAdmin/security.php");
?>


<?php 
    //Получить все сообщения из базы данных  
    if (isset($_GET['post-slug'])) {
        $post = getPost($_GET['post-slug']);
    }
    //Получить все категории для сайдбара
    $topics = getAllTopics();
    //Контроль входа в Админ-панель. Доступ только Админу.
    if (!isLoggedIn()) {
        $_SESSION['msg'] = " Сначала вы должны войти в систему ";
        header('location:' . BASE_URL . '../index.php');
    }
    
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <?php
            include("includesAdmin/head-admin.php");
        ?>
        <title>Cold-code</title>
    </head>

    <body>
        <!-- Header -->
        <?php
            include('includesAdmin/header-admin.php');
        ?>

        <!--Блок main - начало-->
        <div class="container-fluid">
            <div class="content row">
                    <!--Sidebar Content-->
                    <?php
                        include("includesAdmin/sidebar-admin.php");
                    ?>
                <!--Main Content-->
                <div class="main-content col-md-9 col-12">

                    <!-- Display notification message -->
			        <?php include('../App/include/messages.php') ?>
                    <br>
                    <div class="alert alert-warning" role="alert">
                        <div class="col-md-4 offset-md-4">
                            <h2>Админ панель</h2>
                        </div>
                    </div>
                    <br>
                    <strong>Здесь могут быть диаграммы статистики посещения сайта</strong>

                </div>
            </div>
        <!--Блок main - конец-->
        </div>
        <?php
            include("includesAdmin/footer-admin.php");
        ?>


        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js" 
            integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4" crossorigin="anonymous">
        </script>
    </body>
</html>
