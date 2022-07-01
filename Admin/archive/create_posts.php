<?php
  session_start();
  include("../../path.php");
  include("../../App/database/connect.php");
  //include("../controllersAdmin/postController.php");
  include("../controllersAdmin/code.php");
  include("../controllersAdmin/security.php");
?>

<!-- Get all topics -->
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
    <?php include("../includesAdmin/head-admin.php");?>
    <title>Create post || Cold-code</title>
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
        <!--
          <div class="button row">
            <a href="<?php echo BASE_URL . 'Admin/posts/create.php'?>" class="col-2 btn btn-success">Добавить статью</a>
            <span class="col-1"></span>
            <a href="<?php echo BASE_URL . 'Admin/posts/index.php'?>" class="col-3 btn btn-warning">Управление статьями</a>
          </div>
        -->
          <div class="row title-table">
            <h2>Добавление записи</h2>
          </div>
          <div class="row add-post">
            <form action="<?php echo BASE_URL . 'Admin/archive/create_posts.php'; ?>" method="POST" enctype="multipart/form-data">
                <!-- validation errors for the form -->
				        <?php include('../../App/database/errors.php') ?>
                <!-- if editing post, the id is required to identify that post -->
				        <?php if ($isEditingPost === true): ?>
					        <input type="hidden" name="post_id" value="<?php echo $post_id; ?>">
				        <?php endif ?>
                <div class="col">
                    <input name="title" type="text" value="<?php echo $title; ?>" class="form-control" placeholder="Title" aria-label="Название статьи">
                </div>
                <div class="col">
                    <label for="content" class="form-label">Содержимое записи</label>
                    <textarea name="body" id="body" class="form-control" rows="5">
                      <?php echo $body; ?>
                    </textarea>
                </div>
                <div class="input-group col">
                    <input type="file" name="featured_image" class="form-control" id="inputGroupFile02">
                    <label class="input-group-text" for="inputGroupFile02">Загрузить</label>
                </div>
                 
                <select class="form-select" name="topic_id" aria-label="Default select example">
                  <option value="" selected disabled>Choose topic</option>
					          <?php foreach ($topics as $topic): ?>
						          <option value="<?php echo $topic['id']; ?>">
							          <?php echo $topic['name']; ?>
						          </option>
					          <?php endforeach ?>
                </select>
                
                <div class="col">
                    <button class="btn btn-primary" name="create_post" type="submit">SAVE</button>
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
    <!--Блок Footer - конец-->

    <!-- Текстовый редактор TinyMCE -->
    <script>
      tinymce.init({
        selector: 'textarea',
        plugins: 'advlist autolink lists link image charmap preview anchor pagebreak',
        toolbar_mode: 'floating',
      });
    </script>
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
