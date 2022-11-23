<?php

	require_once '../../database/book.php';

	#Função para carregar o select de Editoras
	function readPublishersAction($conn){
		return findPublisherDb($conn);
	}

	#Função para carregar o select de Gêneros
	function readGenresAction($conn){
		return findGenreDb($conn);
	}

	#Função para carregar o select de Autores
	function readAuthorsAction($conn){
		return findAuthorDb($conn);
	}

	function findBookAction($conn, $id) {
		return findBookDb($conn, $id);
	}

	function readBookAction($conn) {
		return readBookDb($conn);
	}

	function createBookAction($conn, $title, $isbn, $pages, $language, $edition, $year, $editora, $generos, $autores) {
		$createBookDb = createBookDb($conn, $title, $isbn, $pages, $language, $edition, $year, $editora, $generos, $autores);
		$message = $createBookDb == 1 ? 'success-create' : 'error-create';
		return header("Location: ./read.php?message=$message");
	}

	function updateBookAction($conn, $id, $title, $isbn, $pages, $language, $edition, $year, $editora, $generos, $autores) {
		$updateBookDb = updateBookDb($conn, $id, $title, $isbn, $pages, $language, $edition, $year, $editora, $generos, $autores);
		$message = $updateBookDb == 1 ? 'success-update' : 'error-update';
		return header("Location: ./read.php?message=$message");
	}

	function deleteBookAction($conn, $id) {
		$deleteBookDb = deleteBookDb($conn, $id);
		$message = $deleteBookDb == 1 ? 'success-remove' : 'error-remove';
		return header("Location: ./read.php?message=$message");
	}