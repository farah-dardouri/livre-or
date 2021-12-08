<?php
 
session_start();
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "livreor";
$sql = mysqli_connect($servername, $username, $password, $dbname);
$login = $_SESSION['login'];
$req = mysqli_query($sql, "SELECT * FROM utilisateurs WHERE login='$login'");
$info = mysqli_fetch_assoc($req);
$modifier = "";
$change_user = "";
$change_pass = "";
$delete = "";
$pass_ok = "";
$sam_pass = "";
$wrong = "";
$vide = "";

if (!isset($_SESSION['login'])) {
    header("Location: connexion.php");
}

if (isset($_POST['modifier'])) {
    $modifier = '
        <div class="profil">
                <div>
                    <h2>Modifier mes informations</h2>
                    <p>que voulez vous changer</p>
                    <div>
                        <form action="" method="post" class="form_profil">
                            <div>
                                <input type="submit" name="user" value="Username">
                            </div>
                            <div>
                                <input type="submit" name="password" value="Mot de passe">
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        ';
}
if (isset($_POST['user'])) {
    $change_user = '
                        <div class="profil">
                            <div>
                                <h2>Modifier mes informations</h2>
                                <p>que voulez vous changer</p>
                                <div>
                                    <form action="" method="post" class="form_profil">
                                        <div>
                                            <input type="submit" name="user" value="Username">
                                        </div>
                                        <div>
                                            <input type="submit" name="password" value="Mot de passe">
                                        </div>
                                    </form>
                                </div>
                                <div>
                                    <form method="post" class="change">
                                        <label for="new_user"></label>
                                        <input type="text" name="new_user" id="new_user" placeholder="Nouveau Username">
                                        <br>
                                        <input type="submit" name="chang_user" value="Valider">
                                    </form>
                                </div>
                            </div>
                        </div>
                        ';
}
if (isset($_POST['chang_user'])) {
    $new_user = $_POST['new_user'];
    $sql_u = "SELECT login FROM utilisateurs WHERE login = '$new_user'";
    $res_u = mysqli_query($sql, $sql_u);

    if (!empty($new_user)) {
        if ($new_user == $login) {
            $same = " <span id=\"error\">Merci de saisir un autre username que $login</span>";
        } elseif (mysqli_num_rows($res_u) == 0) {
            $query = "UPDATE utilisateurs SET login='$new_user' WHERE login='$login'";
            mysqli_query($sql, $query);
            $_SESSION['login'] = $new_user;
            $ok = "<span id=\"yellow\">Votre Username a bien été changé</span>";

        } else {
            $existe = "<span id=\"error\">Le username que vous avez saisi est déjà utilisé</span>";
        }

    } else {
        $vide = "<span id=\"error\">Merci de remplir tous les champs !!</span>";
    }

    $change_user = '
                        <div class="profil">
                            <div>
                                <h2>Modifier mes informations</h2>
                                <p>que voulez vous changer</p>
                                <div>
                                    <form action="" method="post" class="form_profil">
                                        <div>
                                            <input type="submit" name="user" value="Username">
                                        </div>
                                        <div>
                                            <input type="submit" name="password" value="Mot de passe">
                                        </div>
                                    </form>
                                </div>
                                <div>
                                    <form action="profil.php" class="change">'
        . $ok . $same . $existe . $vide .
        '<br>
                                        <input type="submit" name="exite" value="sortir">
                                    </form>
                                </div>
                            </div>
                        </div>
                        ';

}
if (isset($_POST['password'])) {
    $change_pass = '
    <div class="profil">
        <div>
            <h2>Modifier mes informations</h2>
            <p>que voulez vous changer</p>
            <div>
                <form action="" method="post" class="form_profil">
                    <div>
                        <input type="submit" name="user" value="Username">
                    </div>
                    <div>
                        <input type="submit" name="password" value="Mot de passe">
                    </div>
                </form>
            </div>
            <div>
                <form action="" method="post" class="change">
                    <label for="old_pass"></label>
                    <input type="password" name="old_pass" id="old_pass" placeholder="Ancien mot de passe">
                    <br>
                    <label for="new_pass"></label>
                    <input type="password" name="new_pass" id="new_pass" placeholder="Nouveau mot de passe">
                    <br>
                    <label for="confirm_pass"></label>
                    <input type="password" name="confirm_pass" id="confirm_pass" placeholder="confirmer le mot de passe">
                    <br>
                    <input type="submit" name="chang_pass" value="Valider">
                </form>
            </div>
        </div>
    </div>
    ';
}

if (isset($_POST['chang_pass'])) {
    $old_pass = $_POST['old_pass'];
    $new_pass = $_POST['new_pass'];
    $confirm_pass = $_POST['confirm_pass'];

    if (!empty($old_pass) && !empty($new_pass) && !empty($confirm_pass)) {

        if (password_verify($old_pass, $info['password']) == $old_pass) {

            if ($_POST['new_pass'] == $_POST['confirm_pass']) {

                $info['password'] = $new_pass;
                $cryptedpass = password_hash($new_pass, PASSWORD_BCRYPT);
                $query = "UPDATE utilisateurs SET password='$cryptedpass' WHERE login='$login'";

                mysqli_query($sql, $query);
                header('location:profil.php');

                $pass_ok = "<span id=\"yellow\">Le mot de passe a bien été changé</span>";

            } else {
                $sam_pass = "<span id=\"error\">La confirmation du mot de passe n'est pas correct</span>";
            }

        } else {
            $wrong = "<span id=\"error\">Le mot de passe n'est pas correct</span>";
        }

    } else {
        $vide = "<span id=\"error\">Merci de remplir tous les champs !!</span>";
    }

    $change_pass = '
                    <div class="profil">
                        <div>
                            <h2>Modifier mes informations</h2>
                            <p>que voulez vous changer</p>
                            <div>
                                <form action="" method="post" class="form_profil">
                                    <div>
                                        <input type="submit" name="user" value="Username">
                                    </div>
                                    <div>
                                        <input type="submit" name="password" value="Mot de passe">
                                    </div>
                                </form>
                            </div>
                            <div>
                                <form action="profil.php" class="change">'
        . $pass_ok . $sam_pass . $wrong . $vide .
        '<br>
                                    <input type="submit" name="pass_exite" value="sortir">
                                </form>
                            </div>
                        </div>
                    </div>
                    ';
}

if (isset($_POST['logout'])) {
    unset($_SESSION['login']);
    header("Location: connexion.php");
}

if (isset($_POST['delete'])) {
    $delete = '
    <div class="profil">
        <div>
            <h2>Supprimer mon compte</h2>
            <p>Etes vous sûr de vouloir supprimer <br>votre compte ?</p>
            <div>
                <form action="" method="post" class="form_profil">
                    <div>
                        <input type="submit" name="yes" value="OUI">
                    </div>
                    <div>
                        <input type="submit" name="no" value="NON">
                    </div>
                </form>
            </div>
        </div>
    </div>
    ';
}
if (isset($_POST['yes'])) {
    mysqli_query($sql, "DELETE FROM utilisateurs WHERE login = '$login'");
    session_unset();
    $oui = '<span id="error" style="font-size:20px;">votre compte a bien été supprimer<br>c\'est triste de vous voir partir :(</span>';
    header("Refresh:5");

    $delete = '
    <div class="profil">
        <div>
            <h2>Supprimer mon compte</h2>
            <p>Etes vous sûr de vouloir supprimer <br>votre compte ?</p>
            <div>
                <form action="" method="post" class="form_profil">
                    <div>
                        <input type="submit" name="yes" value="OUI">
                    </div>
                    <div>
                        <input type="submit" name="NO" value="NON">
                    </div>
                </form>'
        . $oui;
    '</div>
        </div>
    </div>
    ';
}

if (isset($_POST['comment'])) {
    header("Location: livre-or.php");
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="profil.css">
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
        <section class="section1">
            <div class="profil">
                <div>
                    <h2>Bonjour <span class="maj"><?php echo $_SESSION['login'] ?></span></h2>
                    <p>Voici vos informations personnelles</p>
                </div>
                <div class="infoperso">
                    <p>votre username est: <?php echo $_SESSION['login'] ?></p>
                </div>
                <div>
                    <form action="" method="post" class="form_profil">
                        <div>
                            <input type="submit" name="logout" value="Se déconnecter">
                            <br>
                            <input type="submit" name="delete" value="Supprimer mon compte">
                        </div>
                        <div>
                            <input type="submit" name="comment" value="Voir les commentaires">
                            <br>
                            <input type="submit" name="modifier" value="Modifier mes infos">
                        </div>
                    </form>
                </div>
            </div>
            <?php echo $modifier ?>
            <?php echo $change_user ?>
            <?php echo $change_pass ?>
            <?php echo $delete ?>
        </section>
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