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
                    <h2>Контактные данные</h2>
                    <p>
                        Если у Вас возникли вопросы, связанные с работой сайта cold-code.kz, 
                        или любые другие вопросы, Вы можете связаться с администратором сайта, используя эту форму.
                    </p>
                    <form action="contacts.php" method="POST">
                        <div class="col-md-5 mb-2">
                            <input name="username" value="" type="text" class="form-control" id="formGroupExamleInput" placeholder="Ваше имя">
                        </div>
                        <div class="col-md-5 mb-2">
                            <input name="email" value="" type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Введите ваш email">
                        </div>
                        <div class="col-md-5 mb-2">
                            <input name="title" value="" type="text" class="form-control" placeholder="Тема сообщения" aria-label="Тема сообщения">
                        </div>
                        <div class="col-md-8 mb-2">
                            <textarea name="body" id="body" class="form-control" rows="5">
                                text
                            </textarea>
                        </div>
                        <button class="btn btn-primary" name="Send" type="submit">Отправить</button>
                    </form>

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