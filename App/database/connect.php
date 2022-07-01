<?php
  session_start();
  // инициализация переменных и массива.
  $username = "";
  $email    = "";
  $errors = array(); 
    
  
  /*
 * Делаем константы для хранения данных о базе данных
 * HOST - адрес для подключения к БД
 * USER - логин для доступа к БД
 * PASSWORD - пароль для доступа к БД
 * DATABASE - название базы данных, к которой мы подключаемся
 */
  define('HOST', 'localhost');
  define('USER', 'root');
  define('PASSWORD', '');
  define('DATABASE', 'kobalt85');

  // подключение к базе данных
  //логин, пароль, название БД
  $db = mysqli_connect(HOST, USER, PASSWORD, DATABASE);
      
  /*
 * Делаем проверку соединения
 * Если есть ошибки, останавливаем код и выводим сообщение с ошибкой
 */
  if (!$db) {
		die("Ошибка подключения к базе данных: " . mysqli_connect_error());
	}

?>
