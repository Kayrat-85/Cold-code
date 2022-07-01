<?php
    include("../../path.php");
?>

<div class="sidebar col-2">
    <ul>
        <li>
            <a href="<?php echo BASE_URL . 'Admin/posts/index.php'?>">Статьи</a>
        </li>
        <li>
            <a href="<?php echo BASE_URL . 'Admin/topics/index.php'?>">Категории</a>
        </li>
        <li>
            <a href="<?php echo BASE_URL . 'Admin/users/index.php'?>">Пользователи</a>
        </li>
        <li>
            <a href="<?php echo BASE_URL . 'Admin/archive/create_posts.php'?>">Архив</a>
        </li>
    </ul>
</div>