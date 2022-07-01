<!--Sidebar Content-->
<div class="sidebar col-md-3 col-12">
    <div class="section search">
        <h3>Поиск</h3>
            <form action="/" method="POST">
                <input type="text" name="search-term" class="text-input" placeholder="Search...">
            </form>
    </div>
    <div class="section topics">
        <h3>Категории</h3>
        <?php foreach ($topics as $topic): ?>
        <ul>
            <li>
                <a href="<?php echo BASE_URL . 'filtered_posts.php?topic=' . $topic['id'] ?>">
                    <?php echo $topic['name']; ?>
                </a>
            </li>
        </ul>
        <?php endforeach ?>
    </div>
</div>
