<?php
  //session_start();
  
  include("../models/allModels.php");
?>

<?php 

/* - - - - - - - - - - 
-  Post functions
- - - - - - - - - - -*/
// get all posts from DB
function getAllPosts()
{
	global $db;
	
	// Admin can view all posts
	// Author can only view their posts
	if ($_SESSION['user']['role'] == "Admin") {
		$sql = "SELECT * FROM posts2";
	} 
	elseif ($_SESSION['user']['role'] == "User") {
		$user_id = $_SESSION['user']['id'];
		$sql = "SELECT * FROM posts2 WHERE user_id=$user_id";
	}
	$result = mysqli_query($db, $sql);
	$posts = mysqli_fetch_all($result, MYSQLI_ASSOC);

	$final_posts = array();
	foreach ($posts as $post) {
		$post['user'] = getPostAuthorById($post['user_id']);
		array_push($final_posts, $post);
	}
	return $final_posts;
}
// get the author/username of a post
function getPostAuthorById($user_id)
{
	global $db;
	$sql = "SELECT username FROM users WHERE id=$user_id";
	$result = mysqli_query($db, $sql);
	if ($result) {
		// return username
		return mysqli_fetch_assoc($result)['username'];
	} else {
		return null;
	}
}

/* - - - - - - - - - - 
-  Действия при создании поста
- - - - - - - - - - -*/
// если пользователь нажимает кнопку создания сообщения
if (isset($_POST['create_post'])) { 
	createPost($_POST); 
}
// если пользователь нажимает кнопку «Редактировать сообщение»
if (isset($_GET['edit-post'])) {
	$isEditingPost = true;
	$post_id = $_GET['edit-post'];
	editPost($post_id);
}
// если пользователь нажимает кнопку обновления сообщения
if (isset($_POST['update_post'])) {
	updatePost($_POST);
}
// если пользователь нажимает кнопку Удалить сообщение
if (isset($_GET['delete-post'])) {
	$post_id = $_GET['delete-post'];
	deletePost($post_id);
}

/* - - - - - - - - - - - - - - -
-  Функции для создания постов
- - - - - - - - - - - - - - - -*/
function createPost($request_values)
{
	global $db, $errors, $title, $featured_image, $topic_id, $body;
	$title = e($request_values['title']);
	$body = htmlentities(e($request_values['body']));
	if (isset($request_values['topic_id'])) {
		$topic_id = e($request_values['topic_id']);
	}

	// создать Slug если заголовок поста, вернуть текст как Slug
	$post_slug = makeSlug($title);
	// проверить форму
	if (empty($title)) { array_push($errors, "Заголовок поста обязателен"); }
	if (empty($body)) { array_push($errors, "Укажите тело сообщения."); }
	if (empty($topic_id)) { array_push($errors, "Тема сообщения обязательна"); }

	// Получить имя изображения
	$featured_image = $_FILES['featured_image']['name'];
	if (empty($featured_image)) { array_push($errors, "Обязательное изображение"); }
	// директория с файлами изображений
	$target = "../../Assets/images/" . basename($featured_image);
	if (!move_uploaded_file($_FILES['featured_image']['tmp_name'], $target)) {
		array_push($errors, "Не удалось загрузить изображение. Пожалуйста, проверьте настройки файла для вашего сервера");
	}
	// Убедитесь, что ни один пост не сохраняется дважды. 
	$post_check_query = "SELECT * FROM posts2 WHERE slug='$post_slug' LIMIT 1";
	$result = mysqli_query($db, $post_check_query);

	if (mysqli_num_rows($result) > 0) { // если пост существует
		array_push($errors, "Пост с таким названием уже существует.");
	}
	// создать пост, если в форме нет ошибок
	if (count($errors) == 0) {
		$query = "INSERT INTO posts2 (user_id, title, slug, image, body, created_at, updated_at) 
			VALUES(1, '$title', '$post_slug', '$featured_image', '$body', now(), now())";
		if(mysqli_query($db, $query)){ // если пост создан успешно
			$inserted_post_id = mysqli_insert_id($db);
			// создать связь между постом и категорией
			$sql = "INSERT INTO post_topic (post_id, topic_id) VALUES($inserted_post_id, $topic_id)";
			mysqli_query($db, $sql);

			$_SESSION['message'] = "Сообщение успешно создано";
			header('location: index.php');	
			exit(0);
		}
	}
}

	/* * * * * * * * * * * * * * * * * * * * *
	* - Принимает идентификатор поста в качестве параметра
	* - Получает сообщение из базы данных
	* - устанавливает поля сообщения на форме для редактирования
	* * * * * * * * * * * * * * * * * * * * * */
function editPost($role_id)
{
	global $db, $title, $post_slug, $body, $isEditingPost, $post_id;
	
	$sql = "SELECT * FROM posts2 WHERE id=$role_id LIMIT 1";
	$result = mysqli_query($db, $sql);
	$post = mysqli_fetch_assoc($result);
	//установить значения формы в форме для обновления
	$title = $post['title'];
	$body = $post['body'];
	
}

function updatePost($request_values)
{
	global $db, $errors, $post_id, $title, $featured_image, $topic_id, $body;

	$title = e($request_values['title']);
	$body = e($request_values['body']);
	$post_id = e($request_values['post_id']);
	if (isset($request_values['topic_id'])) {
		$topic_id = e($request_values['topic_id']);
	}
	// создать Slug: если заголовок «Буря окончена», вернуть «буря окончена» как Slug
	$post_slug = makeSlug($title);

	if (empty($title)) { array_push($errors, "Заголовок поста обязателен"); }
	if (empty($body)) { array_push($errors, "Укажите тело сообщения."); }
	// если было предоставлено новое избранное изображение
	if (isset($_POST['featured_image'])) {
		// Получить имя изображения
		$featured_image = $_FILES['featured_image']['name'];
		// директория с файлами изображений
		$target = "../../Assets/images/" . basename($featured_image);
		if (!move_uploaded_file($_FILES['featured_image']['tmp_name'], $target)) {
		  	array_push($errors, "Не удалось загрузить изображение. Пожалуйста, проверьте настройки файла для вашего сервера");
		}
	}

	// зарегистрируйтесь в категории, если в форме нет ошибок
	if (count($errors) == 0) {
		$query = "UPDATE posts2 SET title='$title', slug='$post_slug', views=0, image='$featured_image', body='$body', updated_at=now() WHERE id=$post_id";
		// прикрепить категорию к сообщению в таблице post_topic
		if(mysqli_query($db, $query)){ //если пост создан успешно
			if (isset($topic_id)) {
				$inserted_post_id = mysqli_insert_id($db);
				// создать связь между постом и категорией
				$sql = "INSERT INTO post_topic (post_id, topic_id) VALUES($inserted_post_id, $topic_id)";
				mysqli_query($db, $sql);
				$_SESSION['message'] = "Сообщение успешно создано";
				header('location: create.php');
				exit(0);
			}
		}
		$_SESSION['message'] = "Сообщение успешно обновлено";
		header('location: create.php');
		exit(0);
	}
}
// удалить сообщение в блоге
function deletePost($post_id)
{
	global $db;
	$sql = "DELETE FROM posts2 WHERE id=$post_id";
	if (mysqli_query($db, $sql)) {
		$_SESSION['message'] = "Сообщение успешно удалено";
		header("location: create.php");
		exit(0);
	}
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

/* * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *
* Экранирует представленное значение формы, следовательно, предотвращает внедрение SQL
* * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * */
function e(String $value){
	// привести глобальный объект подключения к базе данных в функцию
	global $db;
	// удалить пустое пространство вокруг строки
	$val = trim($value); 
	$val = mysqli_real_escape_string($db, $value);
	return $val;
}
// Получает строку типа "Some Sample String"
// и возвращает "какую-то строку-образец"
function makeSlug(String $string){
	$string = strtolower($string);
	$slug = preg_replace('/[^A-Za-z0-9-]+/', '-', $string);
	return $slug;
}

?>
