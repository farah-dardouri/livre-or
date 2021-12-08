<?php
session_start();
?>
<!DOCTYPE html>
<html lang="fr">
  <head>
      <meta charset="UTF-8">
      <title>livre-or</title>
      <link href="index.css" rel="stylesheet">
  </head>
  <body >
    <header>
      <nav class="principale">
        <a href="index.php">Accueil</a>
        <a href="livre-or.php">Livre d'or</a>
        <?php if (isset($_SESSION['id'] )) {?> 
        <a href="profil.php?id=" <?php $_SESSION['id'] ?> >Profil</a>
        <?php }  else { ?>
        <a href='inscription.php'>Inscription</a>
        <?php } ?>
        <?php if (isset($_SESSION['id'] )) {?> 
        <a href="deconnexion.php">Deconnexion</a>
        <?php }  else { ?>
          <a href="connexion.php">Connexion</a>
        <?php } if (isset($_SESSION['id'] )){ ?> 
        <a href="deconnexion.php">Deconnexion</a>
        <?php }  else { ?>
          <a href="commentaire.php">Commentaire</a>
        <?php } ?> 
      </nav>
    </header>
    <main>
      <h1>Dress-Christ</h1>
      <p class="in">À la recherche de la tenue parfaite pour les fêtes de fin d'année ?
        <br> Avec nos superbes robes de Noël et de réveillon, émerveillez le père Noël et dansez jusqu'à l'aube.</p>
        <h2>Robes </h2>
      <div>
        <img class="marg" src="image/rm1.jpg" width="200" height="400">
        <img class="marg" src="image/rm2.jpg" width="200" height="400">
        <img class="marg" src="image/rm3.jpg" width="200" height="400">
        <img class="marg" src="image/rm4.jpg" width="200" height="400">
      </div>
      <h2>Combinaison </h2>
      <div>
        <img class="marg" src="image/c1.jpg" width="200" height="350">
        <img class="marg" src="image/c2.jpg" width="200" height="350">
        <img class="marg" src="image/c3.jpg" width="200" height="350">
        <img class="marg" src="image/c4.jpg" width="200" height="350">
      </div>
    </main>
    <footer>
    <nav class="a">
        <a href="index.php">Accueil</a>
        <a href="livre-or.php">Livre d'or</a>
        <?php if (isset($_SESSION['id'] )) {?> 
        <a href="profil.php?id=" <?php $_SESSION['id'] ?> >Profil</a>
        <?php }  else { ?>
        <a href='inscription.php'>Inscription</a>
        <?php } ?>
        <?php if (isset($_SESSION['id'] )) {?> 
        <a href="deconnexion.php">Deconnexion</a>
        <?php }  else { ?>
          <a href="connexion.php">Connexion</a>
        <?php } if (isset($_SESSION['id'] )){ ?> 
        <a href="deconnexion.php">Deconnexion</a>
        <?php }  else { ?>
          <a href="commentaire.php">Commentaire</a>
        <?php } ?> 
      </nav>
    </footer>   
  </body>
</html>