<?php
   session_start();
  include("../../path.php");
  include("../../App/database/connect.php");
  include("../controllersAdmin/postController.php");
  include("../controllersAdmin/security.php");
 
?>

<!-- Get all admin posts from DB -->
<?php 
  //Получить все посты из базы данных
  $posts = getAllPosts(); 
  //Контроль входа в Админ-панель. Доступ только Админу.
  if (!isLoggedIn()) {
    $_SESSION['msg'] = " Сначала вы должны войти в систему ";
    header('location:' . BASE_URL . '../../index.php');
  }
?>

<!doctype html>
<html lang="ru">
  <head>
    <?php 
        include("../includesAdmin/head-admin.php");
    ?>
    <title>Редактирование категории||Cold-code</title>
  </head>
  <body>
    <!-- Меню шапка сайта -->
    <?php
      include("../includesAdmin/header-admin.php");
    ?>   

    <div class="container-fluid">
      <div class="row">
        <?php
          include("../includesAdmin/sidebar-admin.php");
        ?>  

        <div class="posts col-9">
          <div class="button row">
            <a href="<?php echo BASE_URL . 'Admin/posts/create.php'?>" class="col-2 btn btn-success">Добавить статью</a>
            <span class="col-1"></span>
            <a href="<?php echo BASE_URL . 'Admin/posts/index.php'?>" class="col-3 btn btn-warning">Управление статьями</a>
          </div>

          		<!-- Display records from DB-->
		<div class="table-div">
			<!-- Display notification message -->
			<?php include('../../App/include/messages.php') ?>

			<?php if (empty($posts)): ?>
				<h2>No posts in the database.</h2>
			<?php else: ?>
				<table class="table">
						<thead>
						<th>N</th>
						<th>Author</th>
            <th>Title</th>
						<th>Views</th>
						<th><small>Edit</small></th>
						<th><small>Delete</small></th>
					</thead>
					<tbody>
					<?php foreach ($posts as $key => $post): ?>
						<tr>
							<td><?php echo $key + 1; ?></td>
							<td><?php echo $post['user']; ?></td>
							<td>
								<a 	target="_blank"
								href="<?php echo BASE_URL . 'single_post.php?post-slug=' . $post['slug'] ?>">
									<?php echo $post['title']; ?>	
								</a>
							</td>
							<td><?php echo $post['views']; ?></td>
							
							<td>
								<a class="fa fa-pencil btn edit"
									href="create.php?edit-post=<?php echo $post['id'] ?>">
								</a>
							</td>
							<td>
								<a  class="fa fa-trash btn delete" 
									href="create.php?delete-post=<?php echo $post['id'] ?>">
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
