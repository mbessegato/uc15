<?php

require_once '../../../config.php';
require_once '../../actions/author.php';
require_once '../partials/header.php';

if(isset($_POST['id']))
    deleteAuthorAction($conn, $_POST['id']);

?>
<div class="content">
    <h2 style="margin: 0px;">NOVO AUTOR</h2>
    <form name="fremoveclient form" action="../../pages/author/delete.php" method="POST">
        <br>
        <label class="fdelete">Realmente deseja excluir esse Autor?</label> <br>
        <input type="hidden" name="id" value="<?=$_GET['id']?>" required/>
        <input type="submit" class="fbtn fbtncancel" id="fcancel" value="SIM">
        <input type="submit" class="fbtn fbtnsave" id="fsave" value="NÃO">        
    </form>
</div>

<?php require_once '../partials/footer.php'; ?>