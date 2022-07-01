<?php
  session_start();
  include("../../App/database/connect.php");
  include("../models/allModels.php");
?>

<?php 

/* - - - - - - - - - - 
-  Действия администратора
- - - - - - - - - - -*/
// если пользователь нажимает кнопку создания администратора
if (isset($_POST['create_admin'])) {
	createAdmin($_POST);
}
// если пользователь нажимает кнопку «Редактировать администратора»
if (isset($_GET['edit-admin'])) {
	$isEditingUser = true;
	$admin_id = $_GET['edit-admin'];
	editAdmin($admin_id);
}
// если пользователь нажимает кнопку обновления администратора
if (isset($_POST['update_admin'])) {
	updateAdmin($_POST);
}
// если пользователь нажимает кнопку Удалить администратора
if (isset($_GET['delete-admin'])) {
	$admin_id = $_GET['delete-admin'];
	deleteAdmin($admin_id);
}


/* * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *
* -Возвращает всех пользователей-администраторов и их соответствующие роли
* * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * */
function getAdminUsers(){
	global $db, $roles;
	$sql = "SELECT * FROM users WHERE role IS NOT NULL";
	$result = mysqli_query($db, $sql);
	$users = mysqli_fetch_all($result, MYSQLI_ASSOC);

	return $users;
}
/* * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *
* -Экранирует представленное значение формы, следовательно, предотвращает внедрение SQL
* * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * */
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

/* - - - - - - - - - - - -
-  Функции администратора
- - - - - - - - - - - - -*/
/* * * * * * * * * * * * * * * * * * * * * * *
* Получает новые данные администратора из формы
* Создать нового администратора
* Возвращает всех пользователей-администраторов с их ролями
* * * * * * * * * * * * * * * * * * * * * * */
function createAdmin($request_values){
	global $db, $errors, $role, $username, $email;
	$username = esc($request_values['username']);
	$email = esc($request_values['email']);
	$password_1 = esc($request_values['password_1']);
	$password_2 = esc($request_values['password_2']);

	if(isset($request_values['role'])){
		$role = esc($request_values['role']);
	}
	// проверка формы: убедитесь, что форма заполнена правильно
	if (empty($username)) { array_push($errors, "Uhmm...We gonna need the username"); }
	if (empty($email)) { array_push($errors, "Oops.. Email is missing"); }
	if (empty($role)) { array_push($errors, "Role is required for admin users");}
	if (empty($password_1)) { array_push($errors, "uh-oh you forgot the password"); }
	if ($password_1 != $password_2) { array_push($errors, "The two passwords do not match"); }
	// Убедитесь, что ни один пользователь не зарегистрирован дважды. 
	// электронная почта и имена пользователей должны быть уникальными
	$user_check_query = "SELECT * FROM users WHERE username='$username' 
							OR email='$email' LIMIT 1";
	$result = mysqli_query($db, $user_check_query);
	$user = mysqli_fetch_assoc($result);

	if ($user) { // если пользователь существует
		if ($user['username'] === $username) {
		  array_push($errors, "Username already exists");
		}
		if ($user['email'] === $email) {
		  array_push($errors, "Email already exists");
		}
	}

	// зарегистрируйте пользователя, если в форме нет ошибок
	if (count($errors) == 0) {
		$password_1 = md5($password_1);//зашифровать пароль перед сохранением в базе данных
		$query = "INSERT INTO users (username, email, role, password, created_at, updated_at) 
				  VALUES('$username', '$email', '$role', '$password_1', now(), now())";
		mysqli_query($db, $query);

		$_SESSION['message'] = "Admin user created successfully";
		header('location: create.php');
		exit(0);
	}
}
/* * * * * * * * * * * * * * * * * * * * * * * * * * * * *
* Принимает идентификатор администратора в качестве параметра
* Получает администратора из базы данных
* устанавливает админ поля на форме для редактирования
* * * * * * * * * * * * * * * * * * * * * * * * * * * * * */
function editAdmin($admin_id)
{
	global $db, $username, $role, $isEditingUser, $admin_id, $email;

	$sql = "SELECT * FROM users WHERE id=$admin_id LIMIT 1";
	$result = mysqli_query($db, $sql);
	$admin = mysqli_fetch_assoc($result);

	// установить значения формы ($username и $email) в форме для обновления
	$username = $admin['username'];
	$email = $admin['email'];
}

/* * * * * * * * * * * * * * * * * * * * * * * * * * * * * * 
* Получает запрос администратора из формы и обновляет базу данных
* * * * * * * * * * * * * * * * * * * * * * * * * * * * * * */
function updateAdmin($request_values){
	global $db, $errors, $role, $username, $isEditingUser, $admin_id, $email;
	// получить идентификатор администратора для обновления
	$admin_id = $request_values['admin_id'];
	// установить состояние редактирования на false
	$isEditingUser = false;

	$username = esc($request_values['username']);
	$email = esc($request_values['email']);
	$password_1 = esc($request_values['password_1']);
	$password_2 = esc($request_values['password_2']);
	if(isset($request_values['role'])){
		$role = $request_values['role'];
	}
	// зарегистрируйте пользователя, если в форме нет ошибок
	if (count($errors) == 0) {
		//зашифровать пароль (в целях безопасности)
		$password_1 = md5($password_1);

		$query = "UPDATE users SET username='$username', email='$email', role='$role', password='$password_1' WHERE id=$admin_id";
		mysqli_query($db, $query);

		$_SESSION['message'] = "Admin user updated successfully";
		header('location: create.php');
		exit(0);
	}
}
// удалить пользователя администратора
function deleteAdmin($admin_id) {
	global $db;
	$sql = "DELETE FROM users WHERE id=$admin_id";
	if (mysqli_query($db, $sql)) {
		$_SESSION['message'] = "User successfully deleted";
		header("location: create.php");
		exit(0);
	}
}

?>
