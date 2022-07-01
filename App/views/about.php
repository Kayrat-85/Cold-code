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
                <h2>О сайте Cold-code</h2>
                   <!--Информация о сайте-->
                   <p>
                        Cold-code - блог для обучения программированию, публикации it-новостей и общения.
                   </p>
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