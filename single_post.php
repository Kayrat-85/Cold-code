<?php
    include("path.php");
    include("App/database/connect.php");
    include("App/controllers/postsController.php");
    include("App/controllers/registrationController.php");
?>
<?php 
	if (isset($_GET['post-slug'])) {
		$post = getPost($_GET['post-slug']);
	}
	$topics = getAllTopics();
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <?php
            include("App/include/head.php");
        ?>
        <title><?php echo $post['title'] ?>|Could-code</title>
    </head>

    <body>
        <!-- Header -->
        <?php
            include("App/include/header.php");
        ?>
        <br>
        <!--Блок main - начало-->
        <div class="container">
            <div class="content row">
                <!--Main Content-->
                <div class="main-content col-md-9 col-12">
                    <h2><?php echo $post['title']; ?></h2>  
                    <div class="single_post row">
                        <img src="<?php echo BASE_URL . 'Assets/images/' . $post['image'];?>" alt="Image" class="img-thumbnail">
                        <div class="info"> 
                            <i class="far fa-user">Имя Автора</i>
                            <i class="far fa-calendar">Mar 11, 2019</i>
                        </div>
                        <div class="post_text col-12">
                            <?php echo html_entity_decode($post['body']); ?>
                        </div>
                    </div>
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
