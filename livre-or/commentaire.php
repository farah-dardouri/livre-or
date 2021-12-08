<?php

session_start();
 if (!empty($_POST['commentaires'])) 
    {   	
    unset ( $_SESSION ['id'] );
    unset ($_SESSION['login']);
    unset ($_SESSION['id_utilisateur']);
    unset ($_SESSION['date']);
	}
$connexion = mysqli_connect("localhost","root","","livreor");
$date = date('Y-m-d H:i:s');
$deconnecter = "";
$connecter = "";

if (isset($_SESSION['login'])) {
    $connecter = '
                    <a href="profil.php">Mon Profil</a>';

} else {
    $deconnecter = '<a href="inscription.php">Inscription</a>
                        <a href="connexion.php">Connexion</a>';
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="commentaire.css">
    <title>livre-or</title>
</head>

<body>
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
            <div class="form">
                <form action="" method="post">
                    <br>
                    <label for="text"></label>
                    <textarea name="text" id="text" cols="30" rows="10" placeholder="Rédiger un commentaire"></textarea>
                    <br>
                    <input class="bo" type="submit" name="valider" value="Valider">

                    <?php


if (empty($_POST['valider'])) {
    echo "compléter votre commentaire et cliquez sur valider";
}

if (isset($_POST['valider'])) {
    if (!empty(trim($_POST['text']))) {
        $commentaire = $_POST['text'];
        $connexion = mysqli_connect("localhost","root","","livreor");
        $query = "INSERT INTO commentaires ( commentaire, id_utilisateur,  date) ";
        $requete = mysqli_query($connexion, $query);
        header('refresh:3;url=livre-or.php');
        echo "Merci votre commentaire à bien été ajouté";
    } else {
        echo "Merci de compléter le champ commentaires";
    }

}

?>
                </form>
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