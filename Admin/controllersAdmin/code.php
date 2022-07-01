<?php 
   require_once '../../App/database/connect.php';

    // Post variables
    $post_id = 0;
    $topic_id = 0;
    $title = "";
    $post_slug = "";
    $body = "";
    $featured_image = "";
    $isEditingPost = false;
    $published = 0;

    // general variables
    $errors = [];


    if (isset($_POST['create_post'])) { 

        $title = $_POST['title'];
        $body = $_POST['body'];
        $topic_id = $_POST['topic_id'];
        //$published = $_POST['publish'];

        // Получить имя изображения
	    $featured_image = $_FILES['featured_image']['name'];
	    if (empty($featured_image)) { array_push($errors, "Обязательное изображение"); }
	    // директория с файлами изображений
	    $target = "../../Assets/images/" . basename($featured_image);
	    if (!move_uploaded_file($_FILES['featured_image']['tmp_name'], $target)) {
		    array_push($errors, "Не удалось загрузить изображение. Пожалуйста, проверьте настройки файла для вашего сервера");
	    }
        // создать Slug если заголовок поста, вернуть текст как Slug
	    $post_slug = makeSlug($title);


        // создать пост, если в форме нет ошибок
	    if (count($errors) == 0) {
            mysqli_query($db, "INSERT INTO posts2 (user_id, title, slug, image, body, created_at, updated_at) 
                VALUES(1, '$title', '$post_slug', '$featured_image', '$body', now(), now())");

            $_SESSION['message'] = "Сообщение успешно создано";
            header('location: create_posts.php');
            exit(0);
        }
    }

    // Получает строку типа "Some Sample String"
    // и возвращает "какую-то строку-образец"
    function makeSlug(String $string){
	    $string = strtolower($string);
	    $slug = preg_replace('/[^A-Za-z0-9-]+/', '-', $string);
	    return $slug;
    }

    
    /* - - - - - - - - - - 
    - Функции категории
    - - - - - - - - - - -*/
    // получить все категории из БД
    function getAllTopics() {
	    global $db;
	    $sql = "SELECT * FROM topics";
	    $result = mysqli_query($db, $sql);
	    $topics = mysqli_fetch_all($result, MYSQLI_ASSOC);
	    return $topics;
    }

?>