<?php

//insert_chat.php

include('database_connection.php');

session_start();

$data = array(
	':to_user_id'		=>	$_POST['to_user_id'],
	':from_user_id'		=>	$_SESSION['pengguna']['id'],
	':kirimpesan'		=>	$_POST['kirimpesan'],
	':status'			=>	'1'
);

$query = "
INSERT INTO kirimpesan 
(to_user_id, from_user_id, kirimpesan, status) 
VALUES (:to_user_id, :from_user_id, :kirimpesan, :status)
";

$statement = $connect->prepare($query);

if ($statement->execute($data)) {
	echo fetch_user_chat_history($_SESSION['user_id'], $_POST['to_user_id'], $connect);
}
