<?php

require_once '../../../config.php';
require_once '../../actions/book.php';
require_once '../../../src/modules/messages.php';
require_once '../partials/header.php';

$books = readBookAction($conn);
?>

<div class="content">
    <h2 style="margin: 0px;">LIVROS</h2>
    <div class="row flex-center">
		<?php if(isset($_GET['message'])) echo(printMessage($_GET['message'])); ?>
	</div>

	<table class="table-authors">
		<tr>
			<th>TÍTULO</th>
			<th>ISBN</th>
			<th>PGs</th>
			<th>IDIOMA</th>
			<th>EDIÇÃO</th>
			<th>ANO</th>
			<th>EDITORA</th>
            <th>EDITAR</th>
            <th>DELETAR</th>
		</tr>
		<?php foreach($books as $book): ?>
		<tr>
			<td class="book-name"><?=htmlspecialchars($book['titulo'])?></td>
			<td class="book-name"><?=htmlspecialchars($book['isbn'])?></td>
			<td class="book-name"><?=htmlspecialchars($book['npgs'])?></td>
			<td class="book-name"><?=htmlspecialchars($book['idioma'])?></td>
			<td class="book-name"><?=htmlspecialchars($book['edicao'])?></td>
			<td class="book-name"><?=htmlspecialchars($book['ano'])?></td>
			<td class="book-name"><?=htmlspecialchars($book['id_editora'])?></td>
			<td>
				<a class="btn btn-primary text-white" href="./edit.php?id=<?=$book['id']?>">Editar</a>
			</td>
			<td>
				<a class="btn btn-danger text-white" href="./delete.php?id=<?=$book['id']?>">Deletar</a>
			</td>
		</tr>
		<?php endforeach; ?>
	</table>
</div>

<?php require_once '../partials/footer.php'; ?>
