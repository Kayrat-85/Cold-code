<?php
  session_start();
  include("../../App/database/connect.php");
  include("../models/allModels.php");
?>

<?php 

/* - - - - - - - - - - - - - -
-  Действия над категориями
- - - - - - - - - - -- - - -*/
// если пользователь нажимает кнопку создания категории
if (isset($_POST['create_topic'])) { createTopic($_POST); }
// если пользователь нажимает кнопку "Редактировать категорию"
if (isset($_GET['edit-topic'])) {
	$isEditingTopic = true;
	$topic_id = $_GET['edit-topic'];
	editTopic($topic_id);
}
// если пользователь нажимает кнопку обновления категории
if (isset($_POST['update_topic'])) {
	updateTopic($_POST);
}
// если пользователь нажимает кнопку Удалить категории
if (isset($_GET['delete-topic'])) {
	$topic_id = $_GET['delete-topic'];
	deleteTopic($topic_id);
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

function createTopic($request_values){
	global $db, $errors, $topic_name;
	$topic_name = esc($request_values['topic_name']);
	// создать Slug: если тема «Советы по жизни», вернуть «советы по жизни» как слаг
	$topic_slug = makeSlug($topic_name);
	// проверить форму
	if (empty($topic_name)) { 
		array_push($errors, "Topic name required"); 
	}
	//Убедитесь, что ни одна категория не сохраняется дважды. 
	$topic_check_query = "SELECT * FROM topics WHERE slug='$topic_slug' LIMIT 1";
	$result = mysqli_query($db, $topic_check_query);
	if (mysqli_num_rows($result) > 0) { // если категория существует
		array_push($errors, "Topic already exists");
	}
	// зарегистрируйтесь в категории, если в форме нет ошибок
	if (count($errors) == 0) {
		$query = "INSERT INTO topics (name, slug) 
				  VALUES('$topic_name', '$topic_slug')";
		mysqli_query($db, $query);

		$_SESSION['message'] = "Topic created successfully";
		header('location: create.php');
		exit(0);
	}
}
/* * * * * * * * * * * * * * * * * * * * *
* Принимает идентификатор категории в качестве параметра
* извлекает тему из базы данных
* устанавливает поля категории на форме для редактирования
* * * * * * * * * * * * * * * * * * * * * */
function editTopic($topic_id) {
	global $db, $topic_name, $isEditingTopic, $topic_id;
	$sql = "SELECT * FROM topics WHERE id=$topic_id LIMIT 1";
	$result = mysqli_query($db, $sql);
	$topic = mysqli_fetch_assoc($result);
	// установить значения формы ($topic_name) в форме для обновления
	$topic_name = $topic['name'];
}

function updateTopic($request_values) {
	global $db, $errors, $topic_name, $topic_id;
	$topic_name = esc($request_values['topic_name']);
	$topic_id = esc($request_values['topic_id']);
	
	$topic_slug = makeSlug($topic_name);
	// проверить форму
	if (empty($topic_name)) { 
		array_push($errors, "Topic name required"); 
	}
	// зарегистрируйтесь в категории, если в форме нет ошибок
	if (count($errors) == 0) {
		$query = "UPDATE topics SET name='$topic_name', slug='$topic_slug' WHERE id=$topic_id";
		mysqli_query($db, $query);

		$_SESSION['message'] = "Topic updated successfully";
		header('location: create.php');
		exit(0);
	}
}

// удалить категорию
function deleteTopic($topic_id) {
	global $db;
	$sql = "DELETE FROM topics WHERE id=$topic_id";
	if (mysqli_query($db, $sql)) {
		$_SESSION['message'] = "Topic successfully deleted";
		header("location: create.php");
		exit(0);
	}
}

/* * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *
* Экранирует представленное значение формы, следовательно, предотвращает внедрение SQL
* * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * */
function esc(String $value){
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
