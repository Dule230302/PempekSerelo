<?php
include '../koneksi.php';
//fetch_user.php

include('database_connection.php');

session_start();

$query = "
SELECT * FROM pengguna 
";

$statement = $connect->prepare($query);

$statement->execute();

$result = $statement->fetchAll();

$output = '
<table class="table table-bordered table-striped">
	<tr>
		<th width="40%">Nama</td>
		<th width="30%">Email</td>
		<th width="20%">Status</td>
		<th width="10%">Aksi</td>
	</tr>
';

foreach ($result as $row) {
	$ambil = $koneksi->query("SELECT * FROM kirimpesan where from_user_id='$row[id]' and status='1'");
	$jumlahbelumdibaca = $ambil->num_rows;
	$output .= '
	<tr>
		<td>' . $row['nama'] . '</td>
		<td>' . $row['email'] . '</td>
		<td class="text-danger">' . $jumlahbelumdibaca . ' Pesan belum di baca</td>
		<td><button type="button" class="btn btn-info start_chat" data-touserid="' . $row['id'] . '" data-tousername="' . $row['email'] . '">Detail</button></td>
	</tr>
	';
}

$output .= '</table>';

echo $output;
