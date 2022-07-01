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
    <?php include("../includesAdmin/head-admin.php");?>
    <title>Редактирование||Cold-code</title>
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
            <br>
            <!-- Display records from DB-->
		        <div class="table-div">
			        <!-- Display notification message -->
			        <?php include(ROOT_PATH . 'App/include/messages.php') ?>
			        
              <?php if (empty($topics)): ?>
				        <h2>No topics in the database.</h2>
			        <?php else: ?>
				      <table class="table">
					      <thead>
						      <th>N</th>
						      <th>Topic name</th>
						      <th>Edit</th>
                  <th>Delete</th>
					      </thead>
					      <tbody>
					        <?php foreach ($topics as $key => $topic): ?>
						      <tr>
							      <td>
                      <?php echo $key + 1; ?>
                    </td>
							      <td>
                      <?php echo $topic['name']; ?>
                    </td>
							      <td>
								      <a class="fa fa-pencil btn edit"
									      href="create.php?edit-topic=<?php echo $topic['id'] ?>">
								      </a>
							      </td>
							      <td>
								      <a class="fa fa-trash btn delete"								
									      href="create.php?delete-topic=<?php echo $topic['id'] ?>">
								      </a>
							      </td>
						      </tr>
					        <?php endforeach ?>
					      </tbody>
				      </table>
			        <?php endif ?>
		        </div>
		        <!-- // Display records from DB -->
          </div>
        </div>
      </div>

    <!--Блок Footer - начало-->
    <?php
      include("../includesAdmin/footer-admin.php");
    ?>   
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
