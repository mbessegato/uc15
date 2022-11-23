<?php

require_once '../../../config.php';
require_once '../../actions/book.php';
require_once '../partials/header.php';

$publishers = readPublishersAction($conn);
$genres = readGenresAction($conn);
$authors = readAuthorsAction($conn);

if (isset($_POST["title"]) && isset($_POST["isbn"]) && isset($_POST["pages"]) && isset($_POST["language"]) && isset($_POST["edition"]) && isset($_POST["year"]) && isset($_POST["editora"]) && isset($_POST["generos"]) && isset($_POST["autores"])) {
    createBookAction($conn, $_POST["title"], $_POST["isbn"], $_POST["pages"], $_POST["language"], $_POST["edition"], $_POST["year"], $_POST["editora"], $_POST["generos"], $_POST["autores"]);
}
?>

<div class="content">
    <h2 style="margin: 0px;">NOVO LIVRO</h2>
    <form name="fnewbook form" action="../../pages/book/create.php" method="POST" autocomplete="on">

        <label for="ftitulo" class="flabel">Título</label> <br>
        <input type="text" class="ftext" id="ftitulo" placeholder="Título do Livro" name="title" required> <br>
        <label for="fisbn" class="flabel">ISBN</label> <br>
        <input type="number" class="ftext" id="fisbn" placeholder="1234567890123" name="isbn" required> <br>
        <label for="fnpgs" class="flabel">Nº Páginas</label> <br>
        <input type="number" class="ftext" id="fnpgs" placeholder="188" name="pages" required> <br>
        <label for="fidioma" class="flabel">Idioma</label> <br>
        <input type="text" class="ftext" id="fidioma" placeholder="Português" name="language" required> <br>
        <label for="fedicao" class="flabel">Edição</label> <br>
        <input type="number" class="ftext" id="fcep" placeholder="4" name="edition" required> <br>
        <label for="fano" class="flabel">Ano Lançamento</label> <br>
        <input type="number" class="ftext" id="fano" placeholder="1888" name="year" required> <br>

        <label for="feditora" class="flabel">Editora</label> <br>
        <select class="ftext" name="editora" id="feditora">
            <option selected="selected">Selecione: </option>
            <?php
            foreach ($publishers as $publisher) { ?>
                <option value="<?= $publisher['id'] ?>"><?= $publisher['nome'] ?></option>
            <?php
            } ?>
        </select> <br>

        <label for="fgeneros" class="flabel fselect">Gêneros</label> <br>
        <select class="ftext select" name="generos[]" id="fgenero" multiple>
            <option selected="selected">Selecione: </option>
            <?php
            foreach ($genres as $genre) { ?>
                <option value="<?= $genre['id'] ?>"><?= $genre['genero'] ?></option>
            <?php
            } ?>
        </select> <br>

        <label for="fautores" class="flabel fselect">Autores</label> <br>
        <select class="ftext select" name="autores[]" id="fautores" multiple>
            <option selected="selected">Selecione: </option>
            <?php
            foreach ($authors as $author) { ?>
                <option value="<?= $author['id'] ?>"><?= $author['nome'] ?></option>
            <?php
            } ?>
        </select> <br>

        <input type="submit" class="fbtn fbtnsave" id="fsave" value="Salvar">
        <input type="submit" class="fbtn fbtncancel" id="fcancel" value="Cancelar">
    </form>
</div>

<!--<?php require_once '../partials/footer.php'; ?>-->