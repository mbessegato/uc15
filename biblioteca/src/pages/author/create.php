<?php

require_once '../../../config.php';
require_once '../../actions/author.php';
require_once '../partials/header.php';

if (isset($_POST["name"]))
    createAuthorAction($conn, $_POST["name"]);

?>

<div class="content">
    <h2 style="margin: 0px;">NOVO AUTOR</h2>
    <form name="fnewclient form" action="../../pages/author/create.php" method="POST" autocomplete="on">
        <label for="fname" class="flabel">Nome</label> <br>
        <input type="text" class="ftext" id="fname" placeholder="Nome do Autor" name="name" required> <br>
        <input type="submit" class="fbtn fbtnsave" id="fsave" value="Salvar">
    </form>
</div>

<?php require_once '../partials/footer.php'; ?>