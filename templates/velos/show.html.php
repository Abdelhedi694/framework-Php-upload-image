<hr>
    <img src="images/<?= $velo->getImage() ?>" style="max-width:200px" alt="">
    <h2>Nom du vélo : </h2>
    <p><?= $velo->getName() ?></p>
    <h2>Description du vélo : </h2>
    <p><?= $velo->getDescription() ?></p>
    <h2>Prix : </h2>
    <p><?= $velo->getPrice() ?>€</p>
    <form action="?type=velo&action=delete" method="post">
            <button type="submit" name="id" value="<?= $velo->getId() ?>" class="btn btn-danger">Supprimer ce vélo</button>
        </form>
        <a href="?type=velo&action=change&id=<?= $velo->getId() ?>" class="btn btn-warning">Modifier</a>
<hr>

<?php foreach ($avis as $unAvis) :?>
<div class="bg-success mb-1 p-1">
  <h4><?= $unAvis->getAuthor() ?></h4>
  <p><?= $unAvis->getContent() ?></p>
  <form action="?type=avis&action=delete" method="post">
            <button type="submit" name="id" value="<?= $unAvis->getId() ?>" class="btn btn-danger">Supprimer cet avis</button>
            <input type="hidden" name="idVelo" value="<?= $velo->getId() ?>">
        </form>
        <a href="?type=avis&action=change&id=<?= $unAvis->getId() ?>" class="btn btn-warning">Modifier</a>
</div>

<?php endforeach ?>

<?php 

if (!$avis) {
  
echo "<p>Aucun message existe soyez le premier a poster !!</p>";
}
?>

<form action="?type=avis&action=new" method="post" class="formMessage">
  <label for="author" class="mt-4"><h5>Auteur</h5></label>
  <input type="text" name="author" id="author" class="mb-2">

<label for="content"><h5>Contenu de votre avis</h5></label>
<textarea name="content" id="content" cols="30" rows="10" class="mb-2"></textarea>


<button type="submit" class="btn btn-primary" name="id" value="<?= $velo->getId() ?>">Poster</button>
</form>