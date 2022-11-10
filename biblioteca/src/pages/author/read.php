<?php

require_once '../../../config.php';
require_once '../../../src/actions/author.php';
require_once '../../../src/modules/messages.php';
require_once '../partials/header.php';

$authors = readAuthorAction($conn);

?>

<div class="content">
    <h2 style="margin: 0px;">AUTORES</h2>
    <div class="row flex-center">
		<?php if(isset($_GET['message'])) echo(printMessage($_GET['message'])); ?>
	</div>

	<table class="table-authors">
		<tr>
			<th>NOME</th>
            <th>EDITAR</th>
            <th>DELETAR</th>
		</tr>
		<?php foreach($authors as $row): ?>
		<tr>
			<td class="author-name"><?=htmlspecialchars($row['nome'])?></td>
			<td>
				<a class="btn btn-primary text-white" href="./edit.php?id=<?=$row['id']?>">Editar</a>
			</td>
			<td>
				<a class="btn btn-danger text-white" href="./delete.php?id=<?=$row['id']?>">Deletar</a>
			</td>
		</tr>
		<?php endforeach; ?>
	</table>
</div>

<?php require_once '../partials/footer.php'; ?>
