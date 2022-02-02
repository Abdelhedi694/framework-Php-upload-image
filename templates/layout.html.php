
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $pageTitle ?></title>
    <link rel="stylesheet" href="https://bootswatch.com/5/lux/bootstrap.min.css">
    <link rel="stylesheet" href="style.css">
    
</head>
<body>

<nav class="navbar nav-expand-lg navbar-light bg-dark p-4">
    <a href="/FrameworkdebasePhp" class="navbar-brand">BAR</a>
   
</nav>


<div class="alert alert-warning alert-dismissible fade <?php if ($_GET["info"]=="deleteErreur") {
    echo "show";
} ?>" role="alert">
  <strong>Erreur</strong> id innexistant !
  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>


<div class="container">
            

            <?=  $pageContent ?>


</div>
        




<h1 class="mt-5" >FIN DE PAGE</h1>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
</body>
</html>