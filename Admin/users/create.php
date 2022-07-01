<?php
  session_start();
  include("../../path.php");
  include("../controllersAdmin/usersController.php");
  include("../controllersAdmin/security.php");
?>

<?php 
	// Get all admin users from DB
	$admins = getAdminUsers();
	$roles = ['Admin', 'User'];			
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
    <title>Создать пользователя||Cold-code</title>
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

        <div class="posts col-md-9 col-12">
          <div class="button row">
            <a href="<?php echo BASE_URL . 'Admin/users/create.php'?>" class="col-3 btn btn-success">Создать пользователя</a>
            <span class="col-1"></span>
            <a href="<?php echo BASE_URL . 'Admin/users/index.php'?>" class="col-3 btn btn-warning">Управление пользователями</a>
          </div>
          <div class="row title-table">
            <h2>Создать пользователя</h2>
          </div>
          <div class="row add-post">
            <form method="post" action="create.php">
              <!-- validation errors for the form -->
				      <?php include(ROOT_PATH . 'App/database/errors.php') ?>

              <!-- if editing user, the id is required to identify that user -->
				      <?php if ($isEditingUser === true): ?>
					      <input type="hidden" name="admin_id" value="<?php echo $admin_id; ?>">
				      <?php endif ?>
                <div class="col">
                    <label for="formGroupExampleInput" class="form-label">Имя аккаунта</label>
                    <input name="username" value="<?php echo $username; ?>" type="text" class="form-control" id="formGroupExamleInput" placeholder="Введите ваш логин">
                </div>
                <div class="col">
                    <label for="exampleInputEmail1" class="form-label">Email</label>
                    <input name="email" value="<?php echo $email; ?>" type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Введите ваш email">
                </div>
                <div class="col">
                    <label for="exampleInputPassword1" class="form-label">Пароль</label>
                    <input name="password_1" type="password" class="form-control" id="exampleInputPassword1" placeholder="Введите пароль">
                </div>
                <div class="col">
                    <label for="exampleInputPassword2" class="form-label">Пароль</label>
                    <input name="password_2" type="password" class="form-control" id="exampleInputPassword2" placeholder="повторно введите пароль">
                </div>
                <select name="role" class="form-select" aria-label="Default select example">
                  <option value="" selected disabled>
                    Assign role
                  </option>
					          <?php foreach ($roles as $key => $role): ?>
						          <option value="<?php echo $role; ?>"><?php echo $role; ?></option>
					          <?php endforeach ?>
                </select>
                <div class="col">
                  <!-- if editing user, display the update button instead of create button -->
				          <?php if ($isEditingUser === true): ?> 
                    <button class="btn btn-success" name="update_admin" type="submit">UPDATE</button>
                  <?php else: ?>
                    <button class="btn btn-primary" name="create_admin" type="submit">Save User</button>
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
