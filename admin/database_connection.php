<?php

$connect = new PDO("mysql:host=localhost;dbname=pempekserelo;charset=utf8mb4", "root", "");

date_default_timezone_set('Asia/Jakarta');


function fetch_user_chat_history($from_user_id, $to_user_id, $connect)
{
	$query = "
	SELECT * FROM kirimpesan 
	WHERE (from_user_id = '" . $from_user_id . "' 
	AND to_user_id = '" . $to_user_id . "') 
	OR (from_user_id = '" . $to_user_id . "' 
	AND to_user_id = '" . $from_user_id . "') 
	ORDER BY timestamp ASC
	";
	$statement = $connect->prepare($query);
	$statement->execute();
	$result = $statement->fetchAll();
	$output = '<ul class="list-unstyled">';
	foreach ($result as $row) {
		$user_name = '';
		$dynamic_background = '';
		$kirimpesan = '';
		if ($row["from_user_id"] == $from_user_id) {
			if ($row["status"] == '2') {
				$kirimpesan = '<em>This message has been removed</em>';
				$user_name = '<b class="text-success">You</b>';
			} else {
				$kirimpesan = $row['kirimpesan'];
				$user_name = '<b class="text-white">Anda</b>';
			}
			$dynamic_background = 'background-color:#00b075;';
			$output .= '
			<li style="border-bottom:1px dotted #ccc;padding-top:8px; padding-left:8px; padding-right:8px;' . $dynamic_background . '">
				<p class="text-white" align="right">' . $user_name . ' - ' . $kirimpesan . '
					<div align="right">
						- <small class="text-white"><em>' . $row['timestamp'] . '</em></small>
					</div>
				</p>
				<br>
			</li>
			<br>
			';
		} else {
			if ($row["status"] == '2') {
				$kirimpesan = '<em>This message has been removed</em>';
			} else {
				$kirimpesan = $row["kirimpesan"];
			}
			$user_name = '<b class="text-danger">' . get_user_name($row['from_user_id'], $connect) . '</b>';
			$dynamic_background = 'background-color:#848484;';
			$output .= '
			<li style="border-bottom:1px dotted #ccc;padding-top:8px; padding-left:8px; padding-right:8px;' . $dynamic_background . '">
				<p class="text-white">' . $user_name . ' - ' . $kirimpesan . '
					<div>
						- <small class="text-white"><em>' . $row['timestamp'] . '</em></small>
					</div>
				</p>
				<br>
			</li>
			<br>
			';
		}
	}
	$output .= '</ul>';
	$query = "
	UPDATE kirimpesan 
	SET status = '0' 
	WHERE from_user_id = '" . $to_user_id . "' 
	AND to_user_id = '" . $from_user_id . "' 
	AND status = '1'
	";
	$statement = $connect->prepare($query);
	$statement->execute();
	return $output;
}

function get_user_name($user_id, $connect)
{
	$query = "SELECT email FROM tb_admin WHERE idadmin = '$user_id'";
	$statement = $connect->prepare($query);
	$statement->execute();
	$result = $statement->fetchAll();
	foreach ($result as $row) {
		return $row['email'];
	}
}

function count_unseen_message($from_user_id, $to_user_id, $connect)
{
	$query = "
	SELECT * FROM kirimpesan 
	WHERE from_user_id = '$from_user_id' 
	AND to_user_id = '$to_user_id' 
	AND status = '1'
	";
	$statement = $connect->prepare($query);
	$statement->execute();
	$count = $statement->rowCount();
	$output = '';
	if ($count > 0) {
		$output = '<span class="label label-success">' . $count . '</span>';
	}
	return $output;
}

function fetch_is_type_status($user_id, $connect)
{
	return '';
}

function fetch_group_chat_history($connect)
{
	$query = "
	SELECT * FROM kirimpesan 
	WHERE to_user_id = '0'  
	ORDER BY timestamp DESC
	";

	$statement = $connect->prepare($query);

	$statement->execute();

	$result = $statement->fetchAll();

	$output = '<ul class="list-unstyled">';
	foreach ($result as $row) {
		$user_name = '';
		$dynamic_background = '';
		$kirimpesan = '';
		if ($row["from_user_id"] == $_SESSION["user_id"]) {
			if ($row["status"] == '2') {
				$kirimpesan = '<em>This message has been removed</em>';
				$user_name = '<b class="text-success">You</b>';
			} else {
				$kirimpesan = $row["kirimpesan"];
			}

			$dynamic_background = 'background-color:#ffe6e6;';
		} else {
			if ($row["status"] == '2') {
				$kirimpesan = '<em>This message has been removed</em>';
			} else {
				$kirimpesan = $row["kirimpesan"];
			}
			$user_name = '<b class="text-danger">' . get_user_name($row['from_user_id'], $connect) . '</b>';
			$dynamic_background = 'background-color:#ffffe6;';
		}

		$output .= '

		<li style="border-bottom:1px dotted #ccc;padding-top:8px; padding-left:8px; padding-right:8px;' . $dynamic_background . '">
			<p>' . $user_name . ' - ' . $kirimpesan . ' 
				<div align="right">
					- <small><em>' . $row['timestamp'] . '</em></small>
				</div>
			</p>
		</li>
		';
	}
	$output .= '</ul>';
	return $output;
}
