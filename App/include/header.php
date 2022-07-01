
<!-- Меню шапка сайта -->
<div class="container-fluid">
  <div class="row">
    <nav class="navbar navbar-expand-lg navbar-dark navbar-default">
      <a class="navbar-brand" href="<?php echo BASE_URL?>">Cold-code</a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#main_nav"  aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="main_nav">
        <ul class="navbar-nav">
          <li class="nav-item active"> <a class="nav-link" href="<?php echo BASE_URL?>">Главная</a> </li>
          <?php foreach ($topics as $topic): ?>
          <?php if($topic['id'] == 1): ?>
          <li class="nav-item">
            <a class="nav-link" href="<?php echo BASE_URL . 'filtered_posts.php?topic=' . $topic['id'] ?>">
              <?php echo $topic['name']; ?>
            </a>
          </li>
          <?php elseif($topic['id'] == 2): ?>
          <li class="nav-item">
            <a class="nav-link" href="<?php echo BASE_URL . 'filtered_posts.php?topic=' . $topic['id'] ?>">
              <?php echo $topic['name']; ?>
            </a>
          </li>
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" data-bs-toggle="dropdown">Программирование</a>
            <ul class="dropdown-menu fade-up">
              <?php elseif($topic['id'] == 3): ?>
              <li>
                <a class="dropdown-item" href="<?php echo BASE_URL . 'filtered_posts.php?topic=' . $topic['id'] ?>">
                  <?php echo $topic['name']; ?>
                </a>
              </li>
              <?php elseif($topic['id'] == 4): ?>
              <li>
                <a class="dropdown-item" href="<?php echo BASE_URL . 'filtered_posts.php?topic=' . $topic['id'] ?>">
                  <?php echo $topic['name']; ?>
                </a>
              </li>
              <?php elseif($topic['id'] == 5): ?>
              <li>
                <a class="dropdown-item" href="<?php echo BASE_URL . 'filtered_posts.php?topic=' . $topic['id'] ?>">
                  <?php echo $topic['name']; ?>
                </a>
              </li>
            </ul>
            <?php endif?>
            <?php endforeach ?>
          </li>
          <li class="nav-item dropdown">
          <?php if (isset($_SESSION['user']['username'])) : ?>
            <a class="nav-link dropdown-toggle" href="#" data-bs-toggle="dropdown">
              <i class="fa fa-user"></i>
              <?php echo $_SESSION['user']['username']; ?>
            </a>
            <ul class="dropdown-menu fade-up">
              <li><a class="dropdown-item" href="<?php echo BASE_URL . 'logout.php' ?>">Выйти</a></li>
            </ul>
          </li>
          <?php else: ?>
            <li class="nav-item">
              <a class="nav-link" href="login.php"> 
                <i class="fa fa-user"></i>  
                  Войти
              </a>
            </li>
          <?php endif; ?>
        </ul>
      </div> <!-- navbar-collapse.// -->
             <!-- container-fluid.// -->
    </nav>
  </div>
</div><!-- container //  -->