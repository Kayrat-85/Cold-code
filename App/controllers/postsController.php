<?php
	
	/* * * * * * * * * * * * * * * * *
	* Две функции для файла single_post
	* * * * * * * * * * * * * * * * */
	/* * * * * * * * * * * * * * *
    * Возвращает один пост
    * * * * * * * * * * * * * * */
    function getPost($slug){
	    global $db;
	    // Получает slug отдельного поста
	    $post_slug = $_GET['post-slug'];
	    $sql = "SELECT * FROM posts2 WHERE slug='$post_slug'";
	    $result = mysqli_query($db, $sql);

	    // извлекать результаты запроса в виде ассоциативного массива.
	    $post = mysqli_fetch_assoc($result);
	    if ($post) {
		    // найдите тему, к которой относится этот пост
		    $post['topic'] = getPostTopic($post['id']);
	    }
	    return $post;
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