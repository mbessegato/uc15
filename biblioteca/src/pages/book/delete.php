<?php

require_once '../../../config.php';
require_once '../../actions/book.php';
require_once '../partials/header.php';

if(isset($_POST['id']))
    deleteBookAction($conn, $_POST['id']);

?>
<div class="content">
    <h2 style="margin: 0px;">DELETAR LIVRO</h2>
    <form name="fremovebook form" action="../../pages/book/delete.php" method="POST">
        <br>
        <label class="fdelete">Realmente deseja excluir esse Livro?</label> <br>
        <input type="hidden" name="id" value="<?=$_GET['id']?>" required/>
        <input type="submit" class="fbtn fbtncancel" id="fcancel" value="SIM">
        <input type="submit" class="fbtn fbtnsave" id="fsave" value="NÃO">        
    </form>
</div>

<?php require_once '../partials/footer.php'; ?>