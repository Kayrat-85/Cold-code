<?php
//include("App/database/connect.php");

/* * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * 
* Две функции для отображения темы, в которой создан пост
* * * * * * * * * * * * * * * ** * * * * * * * * * * * * * * *  */
/* * * * * * * * * * * * * * *
* Возвращает все опубликованные посты
* * * * * * * * * * * * * * */
function getPublishedPosts() {
	// используйте глобальную переменную $db в функции
	global $db;
	$sql = "SELECT * FROM posts2";
	$result = mysqli_query($db, $sql);
	// извлеките все записи в виде ассоциативного массива с именем $posts
	$posts = mysqli_fetch_all($result, MYSQLI_ASSOC);

	$final_posts = array();
	foreach ($posts as $post) {
		$post['topic'] = getPostTopic($post['id']); 
		array_push($final_posts, $post);
	}
	return $final_posts;
}
/* * * * * * * * * * * * * * *
* Получает идентификатор записи и
* Возвращает категорию сообщения
* * * * * * * * * * * * * * */
function getPostTopic($post_id){
	global $db;
	$sql = "SELECT * FROM topics WHERE id=
			(SELECT topic_id FROM post_topic WHERE post_id=$post_id) LIMIT 1";
	$result = mysqli_query($db, $sql);
	$topic = mysqli_fetch_assoc($result);
	return $topic;
}

/* * * * * * * * * * * * * * * * *
* Две функции для файла filtered_posts
* * * * * * * * * * * * * * * * */
/* * * * * * * * * * * * * * * * *
* Возвращает все сообщения в категории
* * * * * * * * * * * * * * * * */
function getPublishedPostsByTopic($topic_id) {
	global $db;
	$sql = "SELECT * FROM posts2 ps 
			WHERE ps.id IN 
			(SELECT pt.post_id FROM post_topic pt 
				WHERE pt.topic_id=$topic_id GROUP BY pt.post_id 
				HAVING COUNT(1) = 1)";
	$result = mysqli_query($db, $sql);
	// извлеките все записи в виде ассоциативного массива с именем $posts
	$posts = mysqli_fetch_all($result, MYSQLI_ASSOC);

	$final_posts = array();
	foreach ($posts as $post) {
		$post['topic'] = getPostTopic($post['id']); 
		array_push($final_posts, $post);
	}
	return $final_posts;
}
/* * * * * * * * * * * * * * * *
* Возвращает название категории по идентификатору
* * * * * * * * * * * * * * * * */
function getTopicNameById($id)
{
	global $db;
	$sql = "SELECT name FROM topics WHERE id=$id";
	$result = mysqli_query($db, $sql);
	$topic = mysqli_fetch_assoc($result);
	return $topic['name'];
}

    /* * * * * * * * * * * *
    *  Возвращает все категории
    * * * * * * * * * * * * */
    function getAllTopics()
    {
	    global $db;
	    $sql = "SELECT * FROM topics";
	    $result = mysqli_query($db, $sql);
	    $topics = mysqli_fetch_all($result, MYSQLI_ASSOC);
	    return $topics;
    }

?>