<?php

function findAuthorDb($conn, $id) {
    $id = mysqli_real_escape_string($conn, $id);

	$sql = "SELECT * FROM autor WHERE id = ?";
	$stmt = mysqli_stmt_init($conn);

	if(!mysqli_stmt_prepare($stmt, $sql))
		exit('SQL error');

	mysqli_stmt_bind_param($stmt, 'i', $id);
	mysqli_stmt_execute($stmt);
	
	$author = mysqli_fetch_assoc(mysqli_stmt_get_result($stmt));

	mysqli_close($conn);
	return $author;
}

function createAuthorDb($conn, $name) {
	$name = mysqli_real_escape_string($conn, $name);

	if($name) {
		$sql = "INSERT INTO autor (nome) VALUES (?)";
		$stmt = mysqli_stmt_init($conn);

		if(!mysqli_stmt_prepare($stmt, $sql)) 
			exit('SQL error');
		
		mysqli_stmt_bind_param($stmt, 's', $name);
		mysqli_stmt_execute($stmt);
		mysqli_close($conn);
		return true;
	}
}

function readAuthorDb($conn) {
    $authors = [];

	$sql = "SELECT * FROM autor";
	$result = mysqli_query($conn, $sql);

	$result_check = mysqli_num_rows($result);
	
	if($result_check > 0)
		$authors = mysqli_fetch_all($result, MYSQLI_ASSOC);

	mysqli_close($conn);
	return $authors;
}

function updateAuthorDb($conn, $id, $name) {
    if($id && $name) {
		$sql = "UPDATE autor SET nome = ? WHERE id = ?";
		$stmt = mysqli_stmt_init($conn);

		if(!mysqli_stmt_prepare($stmt, $sql))
			exit('SQL error');

		mysqli_stmt_bind_param($stmt, 'si', $name, $id);
		mysqli_stmt_execute($stmt);
		mysqli_close($conn);
		return true;
	}
}

function deleteAuthorDb($conn, $id) {
    $id = mysqli_real_escape_string($conn, $id);

	if($id) {
		$sql = "DELETE FROM autor WHERE id = ?";
		$stmt = mysqli_stmt_init($conn);

		if(!mysqli_stmt_prepare($stmt, $sql))
			exit('SQL error');

		mysqli_stmt_bind_param($stmt, 'i', $id);
		mysqli_stmt_execute($stmt);
		return true;
	}
}