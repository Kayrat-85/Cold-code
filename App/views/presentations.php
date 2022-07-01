<?php
    session_start();
    include("../../path.php");
    include("../database/connect.php");
    include("../controllers/topicsController.php");
    include("../controllers/registrationController.php");
?>
<?php 
    $topics = getAllTopics(); 
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <?php
            include("../include/head.php");
        ?>
        <title>Cold-code</title>
    </head>

    <body>
        <!-- Header -->
        <?php
            include('../include/header.php');
        ?>

        <!--Блок main - начало-->
        <div class="container">
            <div class="content row">
                <!--Main Content-->
                <div class="main-content col-md-9 col-12">
                    <h2>Презинтации</h2>
                    <!--Здесь будет список презинтаций-->
                    <div class="post row">
                        <div class="img col-12 col-md-4">
                            <img src="Assets/Images/20200909_195932_0000.png" alt="Image" class="img-thumbnail">
                        </div>
                        <div class="post_text col-12 col-md-8">
                            <h3>
                                <a href="#">Архитектура операционных систем</a>
                            </h3>
                            <i class="far fa-user">Имя Автора</i>
                            <i class="far fa-calendar">Mar 11, 2019</i>
                            <p class="preview-text">
                                Операционная система – это комплекс программ, которые выступают как интерфейс 
                                между устройствами вычислительной си-стемы и прикладными программами, 
                                предназначены для управления устройствами и вычислительными процессами, 
                                а также для эффек-тивного распределения вычислительных ресурсов и организации 
                                надёжных вычислений.
                            </p>
                        </div>
                    </div>
                </div>
                <!--Sidebar Content-->
                <?php
                    include("../include/sidebar.php");
                ?>
            </div>
        <!--Блок main - конец-->
        </div>
        <?php
            include("../include/footer.php");
        ?>


        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js" 
            integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4" crossorigin="anonymous">
        </script>
    </body>
</html>