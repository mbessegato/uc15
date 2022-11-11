<?php

require_once '../../../config.php';
require_once '../../actions/author.php';
require_once '../partials/header.php';

if (isset($_POST["id"], $_POST["name"]))
    updateAuthorAction($conn, $_POST["id"], $_POST["name"]);

$author = findAuthorAction($conn, $_GET['id']);

?>
<div class="content">
    <h2 style="margin: 0px;">EDITAR AUTOR</h2>
    <form name="fnewclient form" action="../../pages/author/edit.php" method="POST" autocomplete="on">
        <input type="hidden" name="id" value="<?=$author['id']?>" required/>
        <label for="fname" class="flabel">Nome</label> <br>
        <input type="text" class="ftext" id="fname" placeholder="Nome do Autor" name="name" value="<?=htmlspecialchars($author['nome'])?>" required> <br>
        <input type="submit" class="fbtn fbtnsave" id="fsave" value="Salvar">
    </form>
</div>

<?php require_once '../partials/footer.php'; ?>