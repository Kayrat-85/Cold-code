
<?php
// Авторизация
	if (isset($_POST['login_btn'])) {
		$username = esc($_POST['username']);
		$password = esc($_POST['password']);

		if (empty($username)) { array_push($errors, "Username required"); }
		if (empty($password)) { array_push($errors, "Password required"); }
		if (empty($errors)) {
			$password = md5($password); // зашифровать пароль
			$sql = "SELECT * FROM users WHERE username='$username' and password='$password' LIMIT 1";

			$result = mysqli_query($db, $sql);
			if (mysqli_num_rows($result) > 0) {
				//получить идентификатор созданного пользователя
				$reg_user_id = mysqli_fetch_assoc($result)['id']; 

				// поместить зарегистрированного пользователя в массив сеансов
				$_SESSION['user'] = getUserById($reg_user_id); 

				// если пользователь админ, перенаправить в админку
				if ( in_array($_SESSION['user']['role'], ["Admin", "User"])) {
					$_SESSION['message'] = "Вы вошли в систему";
					// перенаправить в админку
					header('location: ' . BASE_URL . '/Admin/home.php');
					exit(0);
				} else {
					$_SESSION['message'] = "Вы вошли в систему";
					// перенаправить в публичную зону
					header('location: index.php');				
					exit(0);
				}
			} else {
				array_push($errors, 'Неправильные учетные данные');
			}
		}
	}

// escape value from form
function esc(String $value)
{	
    // bring the global db connect object into function
    global $db;

    $val = trim($value); // remove empty space sorrounding string
    $val = mysqli_real_escape_string($db, $value);

    return $val;
}
// Get user info from user id
function getUserById($id)
{
    global $db;
    $sql = "SELECT * FROM users WHERE id=$id LIMIT 1";

    $result = mysqli_query($db, $sql);
    $user = mysqli_fetch_assoc($result);

    // returns user in an array format: 
    // ['id'=>1 'username' => 'Awa', 'email'=>'a@a.com', 'password'=> 'mypass']
    return $user; 
}

?>