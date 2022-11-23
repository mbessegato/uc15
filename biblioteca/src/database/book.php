<?php

#Função para carregar o select de Editoras
function findPublisherDb($conn)
{
	$publishers = [];

	$sql = "SELECT * FROM editora";
	$result = mysqli_query($conn, $sql);

	$result_check = mysqli_num_rows($result);

	if ($result_check > 0)
		$publishers = mysqli_fetch_all($result, MYSQLI_ASSOC);

	//	mysqli_close($conn);
	return $publishers;
}

#Função para carregar o select de Gêneros
function findGenreDb($conn)
{
	$genres = [];

	$sql = "SELECT * FROM genero";
	$result = mysqli_query($conn, $sql);

	$result_check = mysqli_num_rows($result);

	if ($result_check > 0)
		$genres = mysqli_fetch_all($result, MYSQLI_ASSOC);

	//mysqli_close($conn);
	return $genres;
}

#Função para carregar o select de Editoras
function findAuthorDb($conn)
{
	$authors = [];

	$sql = "SELECT * FROM autor";
	$result = mysqli_query($conn, $sql);

	$result_check = mysqli_num_rows($result);

	if ($result_check > 0)
		$authors = mysqli_fetch_all($result, MYSQLI_ASSOC);

	//mysqli_close($conn);
	return $authors;
}

function findBookDb($conn, $id)
{
	$id = mysqli_real_escape_string($conn, $id);

	$sql = "SELECT * FROM livro WHERE id = ?";
	$stmt = mysqli_stmt_init($conn);

	if (!mysqli_stmt_prepare($stmt, $sql))
		exit('SQL error');

	mysqli_stmt_bind_param($stmt, 'i', $id);
	mysqli_stmt_execute($stmt);

	$book = mysqli_fetch_assoc(mysqli_stmt_get_result($stmt));

	mysqli_close($conn);
	return $book;
}

function createBookDb($conn, $title, $isbn, $pages, $language, $edition, $year, $editora, $generos, $autores){
	$title = mysqli_real_escape_string($conn, $title);
	$isbn = mysqli_real_escape_string($conn, $isbn);
	$pages = mysqli_real_escape_string($conn, $pages);
	$language = mysqli_real_escape_string($conn, $language);
	$edition = mysqli_real_escape_string($conn, $edition);
	$year = mysqli_real_escape_string($conn, $year);
	$editora = mysqli_real_escape_string($conn, $editora);

	if ($title && $isbn && $pages && $language && $edition && $year && $editora && $generos && $autores) {
		$sql = "INSERT INTO livro (titulo, isbn, npgs, idioma, edicao, ano, id_editora) VALUES ('$title', '$isbn', '$pages', '$language', '$edition', '$year', '$editora')";
		$result = mysqli_query($conn, $sql);
		foreach ($generos as $genero) {
			$genero = mysqli_real_escape_string($conn, $genero);
			$sql = "INSERT INTO livro_has_genero (id_livro, id_genero) VALUES ((SELECT max(id) FROM livro), '$genero')";
			$result = mysqli_query($conn, $sql);
		}
		foreach ($autores as $autor) {
			$autor = mysqli_real_escape_string($conn, $autor);
			$sql = "INSERT INTO livro_has_autor (id_livro, id_autor) VALUES ((SELECT max(id) FROM livro), '$autor')";
			$sql_run = mysqli_query($conn, $sql);
		}
		mysqli_close($conn);
		return true;
	}
}

function readBookDb($conn){
	$books = [];

	$sql = "SELECT * FROM livro";
	$result = mysqli_query($conn, $sql);

	$result_check = mysqli_num_rows($result);

	if ($result_check > 0)
		$books = mysqli_fetch_all($result, MYSQLI_ASSOC);

	mysqli_close($conn);
	return $books;
}

function updateBookDb($conn, $id, $title, $isbn, $pages, $language, $edition, $year, $editora, $generos, $autores){
	$id = mysqli_real_escape_string($conn, $id);
	$title = mysqli_real_escape_string($conn, $title);
	$isbn = mysqli_real_escape_string($conn, $isbn);
	$pages = mysqli_real_escape_string($conn, $pages);
	$language = mysqli_real_escape_string($conn, $language);
	$edition = mysqli_real_escape_string($conn, $edition);
	$year = mysqli_real_escape_string($conn, $year);
	$editora = mysqli_real_escape_string($conn, $editora);

	if ($id && $title && $isbn && $pages && $language && $edition && $year && $editora && $generos && $autores) {
		//primeiro, remover os registros de gênero e autor
		$sql = "DELETE FROM livro_has_genero WHERE id_livro = '$id'";
		$result = mysqli_query($conn, $sql);
		$sql = "DELETE FROM livro_has_autor WHERE id_livro = '$id'";
		$result = mysqli_query($conn, $sql);

		//segundo, atualizar o registro de livro
		$sql = "UPDATE livro SET titulo = '$title', isbn = '$isbn', npgs = '$pages', idioma = '$language', edicao = '$edition', ano = '$year', id_editora = '$editora' WHERE id = '$id'";
		$result = mysqli_query($conn, $sql);

		//terceiro, cadastrar gêneros e autores novamente
		foreach ($generos as $genero) {
			$genero = mysqli_real_escape_string($conn, $genero);
			$sql = "INSERT INTO livro_has_genero (id_livro, id_genero) VALUES ('$id', '$genero')";
			$result = mysqli_query($conn, $sql);
		}
		foreach ($autores as $autor) {
			$autor = mysqli_real_escape_string($conn, $autor);
			$sql = "INSERT INTO livro_has_autor (id_livro, id_autor) VALUES ('$id', '$autor')";
			$result = mysqli_query($conn, $sql);
		}
		mysqli_close($conn);
		return true;
	}
}

function deleteBookDb($conn, $id){
	$id = mysqli_real_escape_string($conn, $id);

	if ($id) {
		$sql = "DELETE FROM livro_has_genero WHERE id_livro = '$id'";
		$result = mysqli_query($conn, $sql);
		$sql = "DELETE FROM livro_has_autor WHERE id_livro = '$id'";
		$result = mysqli_query($conn, $sql);
		$sql = "DELETE FROM livro WHERE id = '$id'";
		$result = mysqli_query($conn, $sql);

		return true;
	}
}