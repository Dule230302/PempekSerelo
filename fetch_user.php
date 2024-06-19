<?php

//fetch_user.php

include('database_connection.php');

session_start();

$query = "
SELECT * FROM pengguna limit 1
";

$statement = $connect->prepare($query);

$statement->execute();

$result = $statement->fetchAll();

$output = '
<table class="table table-bordered table-striped">
<tr>
';
$no = 1;
foreach ($result as $row) {
    $output .= '
        <td><button type="button" class="btn btn-success btn-xs start_chat" data-touserid="' . $row['id'] . '" data-tousername="' . $row['email'] . '">Chat Sekarang</button></td>
    ';
    $no++;
}


$output .= '</tr>
</table>';

echo $output;
