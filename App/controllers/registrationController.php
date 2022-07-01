
<?php
    
	// REGISTER USER
	if (isset($_POST['reg_user'])) {
		// receive all input values from the form
		$username = esc($_POST['username']);
		$email = esc($_POST['email']);
		$password_1 = esc($_POST['password_1']);
		$password_2 = esc($_POST['password_2']);

		// form validation: ensure that the form is correctly filled
		if (empty($username)) {  array_push($errors, "Uhmm...We gonna need your username"); }
		if (empty($email)) { array_push($errors, "Oops.. Email is missing"); }
		if (empty($password_1)) { array_push($errors, "uh-oh you forgot the password"); }
		if ($password_1 != $password_2) { array_push($errors, "The two passwords do not match");}

		// Ensure that no user is registered twice. 
		// the email and usernames should be unique
		$user_check_query = "SELECT * FROM users WHERE username='$username' 
								OR email='$email' LIMIT 1";

		$result = mysqli_query($db, $user_check_query);
		$user = mysqli_fetch_assoc($result);

		if ($user) { // if user exists
			if ($user['username'] === $username) {
			  array_push($errors, "Username already exists");
			}
			if ($user['email'] === $email) {
			  array_push($errors, "Email already exists");
			}
		}
		// зарегистрируйте пользователя, если в форме нет ошибок
		if (count($errors) == 0) {
			$password = md5($password_1);//зашифровать пароль перед сохранением в базе данных
			$query = "INSERT INTO users (username, email, password, created_at, updated_at) 
					  VALUES('$username', '$email', '$password', now(), now())";
			mysqli_query($db, $query);

			// получить идентификатор созданного пользователя
			$reg_user_id = mysqli_insert_id($db); 

			// поместите вошедшего в систему пользователя в массив сеансов
			$_SESSION['user'] = getUserById($reg_user_id);

			// если пользователь является администратором, перенаправьте в админку
			if ( in_array($_SESSION['user']['role'], ["Admin", "User"])) {
				$_SESSION['message'] = "You are now logged in";
				// перенаправление в админку
				header('location: ' . BASE_URL . 'Admin/home.php');
				exit(0);
			} else {
				$_SESSION['message'] = "You are now logged in";
				// перенаправление в публичную зону
				header('location: ' . BASE_URL . 'index.php');				
				exit(0);
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