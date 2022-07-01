<?php
  session_start();
  include("../../path.php");
  include("../../App/database/connect.php");
  include("../controllersAdmin/topicsController.php");
  include("../controllersAdmin/security.php");
?>

<?php 
  //Получить все категории
  $topics = getAllTopics();	
  //Контроль входа в Админ-панель. Доступ только Админу.
  if (!isLoggedIn()) {
    $_SESSION['msg'] = " Сначала вы должны войти в систему ";
    header('location:' . BASE_URL . '../../index.php');
  }

?>

<!doctype html>
<html lang="ru">
  <head>
    <?php include("../includesAdmin/head-admin.php"); ?>
    <title>Создать категорию||Cold-code</title>
  </head>
  <body>
    <!-- Меню шапка сайта -->
    <?php
      include("../includesAdmin/header-admin.php");
    ?>   
    <!--Блок Меню сайта - конец-->
    <div class="container-fluid">
      <div class="row">
        <?php
            include("../includesAdmin/sidebar-admin.php");
        ?>   

        <div class="posts col-9">
          <div class="button row">
            <a href="<?php echo BASE_URL . 'Admin/topics/create.php'?>" class="col-3 btn btn-success">Создать категорию</a>
            <span class="col-1"></span>
            <a href="<?php echo BASE_URL . 'Admin/topics/index.php'?>" class="col-3 btn btn-warning">Управление категориями</a>
          </div>
          <div class="row title-table">
            <h2>Создать категорию</h2>
          </div>
          <div class="row add-post">
            <form method="post" action="create.php">
              <!-- validation errors for the form -->
				      <?php include(ROOT_PATH . 'App/database/errors.php') ?>

              <!-- if editing topic, the id is required to identify that topic -->
				      <?php if ($isEditingTopic === true): ?>
                <input type="hidden" name="topic_id" value="<?php echo $topic_id; ?>">
				      <?php endif ?>
              <div class="col">
                <input name="topic_name" type="text" value="<?php echo $topic_name; ?>" class="form-control" placeholder="Название кагории" aria-label="Название категории">
              </div>
              <div class="col">
                <label for="content" class="form-label">Описание категории</label>
                <textarea name="description" class="form-control" id="content" rows="3"></textarea>
              </div>
              <div class="col">
                <!-- if editing topic, display the update button instead of create button -->
                <?php if ($isEditingTopic === true): ?> 
                  <button name="update_topic" class="btn btn-success" type="submit">UPDATE</button>
                <?php else: ?>
                  <button name="create_topic" class="btn btn-primary" type="submit">Save Topic</button>
                <?php endif ?>
              </div>
            </form>
          </div>

        </div>
      </div>
    </div>
    <!--Блок Footer - начало-->
    <?php
      include("../includesAdmin/footer-admin.php");
    ?>   

    <!-- Текстовый редактор TinyMCE -->
    <script>
      tinymce.init({
        selector: 'textarea',
        plugins: 'advlist autolink lists link image charmap preview anchor pagebreak',
        toolbar_mode: 'floating',
      });
    </script>
    <!--Блок Footer - конец-->
    <!-- Необязательный JavaScript; выберите один из двух! -->
    <!-- Вариант 1: пакет Bootstrap с Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4" crossorigin="anonymous"></script>
    <!-- Вариант 2: отдельные JS для Popper и Bootstrap -->
    <!--
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.min.js" integrity="sha384-Atwg2Pkwv9vp0ygtn1JAojH0nYbwNJLPhwyoVbhoPwBhjQPR5VtM2+xf0Uwh9KtT" crossorigin="anonymous"></script>
    -->
  </body>
</html>
