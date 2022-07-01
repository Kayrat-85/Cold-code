<?php
    session_start();
    include("path.php");
    include("App/database/connect.php");
    include("App/controllers/topicsController.php");
    include("App/controllers/registrationController.php");
    
?>
<?php 
    $topics = getAllTopics(); 
?>


<!DOCTYPE html>
<html lang="en">
    <head>
        <?php
            include("App/include/head.php");
        ?>
        <title>Cold-code</title>
    </head>

    <body>
        <!-- Header -->
        <?php
            include('App/include/header.php');
        ?>
        <!-- Banner -->
        <?php
            include("App/include/banner.php");
        ?>

        <!--Блок main - начало-->
        <div class="container">
            <div class="content row">
              <!--Main Content-->
              <div class="main-content col-md-9 col-12">
                <h2>Главные вопросы и ответы на них</h2>
                  
                    <div class="post row">
                        <div class="img col-12 col-md-4">
                          <img src="Assets/Images/1da3b552f7b5413371952c714e08b3ec.jpg" alt="Image" class="img-thumbnail">
                        </div>
                        <div class="post_text col-12 col-md-8">
                          <h3>
                              <a href="App/views/whatInternet.php">Что такое интернет?</a>
                          </h3>
                          <i class="far fa-user">Admin</i>
                          <i class="far fa-calendar">Mar 11, 2022</i>
                          <p class="preview-text">
                            Интернет– это всемирная компьютерная сеть, предназначенная для хранения, 
                            обработки и передачи информации.
                          </p>
                        </div>
                    </div>
                    <div class="post row">
                        <div class="img col-12 col-md-4">
                          <img src="Assets/Images/1648010208_49-kartinkin-net-p-kartinki-dlya-programmistov-52.jpg" alt="Image" class="img-thumbnail">
                        </div>
                        <div class="post_text col-12 col-md-8">
                          <h3>
                              <a href="App/views/whatProgramming.php">Программирование - это..</a>
                          </h3>
                          <i class="far fa-user">Admin</i>
                          <i class="far fa-calendar">Mar 13, 2022</i>
                          <p class="preview-text">
                            Программирование — процесс создания компьютерных программ. По выражению одного из 
                            основателей языков программирования Никлауса Вирта «Программы = алгоритмы + структуры данных». 
                          </p>
                        </div>
                    </div>

                </div>
                <!--Sidebar Content-->
                <?php
                    include("App/include/sidebar.php");
                ?>
            </div>
        <!--Блок main - конец-->
        </div>
        <?php
            include("App/include/footer.php");
        ?>


        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js" 
            integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4" crossorigin="anonymous">
        </script>
    </body>
</html>
