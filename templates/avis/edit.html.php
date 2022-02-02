<form action="?type=avis&action=change" method="post">
<h4>Nom de l'auteur</h4>
<input type="text" name="author" value="<?= $avis->getAuthor() ?>">
<hr>
<h4>Contenu</h4>
<textarea name="content" cols="30" rows="10"><?= $avis->getContent() ?></textarea>

<button type="submit" class="btn btn-warning" name="idEdit" value="<?= $_GET['id'] ?>">Modifier</button>

</form>