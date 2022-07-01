<!-- Меню шапка Админ-панели -->
<header class="container-fluid">
  <div class="container">
    <div class="row">
      <div class="col-6 col-md-3">
        <h1>
          <a href="<?php echo BASE_URL . "index.php"?>">Cold-code</a>
        </h1>
      </div>
      <nav class="col-md-9 col-sm-12">
        <ul>
          <li>
            <a href="<?php echo BASE_URL . "Admin/home.php"?>">Home</a>
          </li>
          <?php if (isset($_SESSION['user'])): ?>
          <li>
            <a href="#">
              <i class="fa fa-user"></i>
              <?php echo $_SESSION['user']['username'] ?>
            </a>
          </li>     
          <li>
            <a href="<?php echo BASE_URL . "logout.php"; ?>" class="logout-btn">Выход</a>
          </li>
          <?php endif ?>
        </ul>
       
      </nav>
    </div>
  </div>
</header> 
