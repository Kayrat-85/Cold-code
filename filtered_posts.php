<?php 
    session_start();
    include("path.php");
    include("App/database/connect.php");
    include("App/controllers/topicsController.php");
    //include("App/controllers/postsController.php");
    include("App/controllers/registrationController.php");
?>

<!-- Получить все сообщения из базы данных  -->
<?php 
    //Получить сообщения в определенной категории
	if (isset($_GET['topic'])) {
		$topic_id = $_GET['topic'];
		$posts = getPublishedPostsByTopic($topic_id);
	}
    $topics = getAllTopics();
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <?php
            include("App/include/head.php");
        ?>
        <title>Cold-code</title>
    </head>

    <body>
        <!-- Header -->
        <?php
            include('App/include/header.php');
        ?>
        <!--Блок main - начало-->
        <div class="container">
            <div class="content row">
                <!--Main Content-->
                <div class="main-content col-md-9 col-12">
                    <h2>
                        Статьи по
                        <?php echo getTopicNameById($topic_id); ?>
                    </h2>
                    <br>
                    <?php foreach ($posts as $post): ?>
                    <div class="post row">
                        <div class="img col-12 col-md-4">
                            <img src="<?php echo BASE_URL . 'Assets/images/' . $post['image']; ?>" alt="Image" class="img-thumbnail">
                        </div>
                            <div class="post_text col-12 col-md-8">
                                <a href="single_post.php?post-slug=<?php echo $post['slug']; ?>">
                                <h3>
                                    <?php echo $post['title'] ?>
                                </h3>
                                <i class="far fa-user">Имя Автора</i>
                                <i class="far fa-calendar">><?php echo date("F j, Y ", strtotime($post["created_at"])); ?></i>
                                <p class="preview-text">
                                    <span class="read_more">Читать далее...</span>
                                </p>
                                </a>
                            </div>
                        </div>
                    <?php endforeach ?> 
                </div>
                <!--Sidebar Content-->
                <?php
                    include("App/include/sidebar.php");
                ?>
            </div>
        <!--Блок main - конец-->
        </div>
        <?php
            include("App/include/footer.php");
        ?>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js" 
            integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4" crossorigin="anonymous">
        </script>
    </body>
</html>