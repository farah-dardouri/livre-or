<?php
session_start();
 if (!empty($_POST['formdeconexion'])) 
    {   	
    unset ( $_SESSION ['id'] );
    unset ($_SESSION['login']);
	}
$connexion = mysqli_connect("localhost","root","","livreor");
?>
<html>
	<head>
		<meta charset="utf-8">
		<title>livre-or</title>
		<link href="inscription.css" rel="stylesheet">
	</head>

<?php
if (isset($_POST['inscription']))
	{				
		$login = htmlspecialchars($_POST['login']) ;
	 	$password = sha1($_POST['password']);
	 	$password2 = sha1($_POST['password2']);
	if ( !empty($_POST["login"])  && !empty($_POST["password"]) && !empty($_POST["password2"]) && (strlen($_POST["password"])) >3 && (strlen($_POST["password2"]) >3)) 
		{
			$reqdoublon = "SELECT `login` FROM `utilisateurs` where login=\"$login\";";
			$verifdoublon = mysqli_query($connexion, $reqdoublon);
			$result = mysqli_fetch_array($verifdoublon);
	 		$loginlength = strlen($login);
	 		if($loginlength <= 255)
	 		{
	 			if ($password == $password2)
	 			 {  
	 			 if (!isset ($_SESSION['login'])&&$result==NULL)
	 		 		{
	 				$requete="INSERT INTO utilisateurs(login,password)
	 			 				VALUES (\"$login\",\"$password\")";
	 			 	$inser= mysqli_query($connexion, $requete);
					$erreur= "votre compte a bien était créer !";
	 				header("location: connexion.php");
	 				}
	 				else
	 				{
	 				$erreur= "login deja existant !";
	 				} 			
	 			}
	 			else
	 			{
	 			$erreur = "vos mots de passe sont different !";
	 			}
	 	}
 		else     
			 {
		 	$erreur = "votre pseudo ne doit pas dépasser 255 caractère  ! ";
			 }
		}
	else
	{
	$erreur = "<br/>.tous les champ doivent etre complétés et le mot de passe doit contenir plus de 3 caractere !";
	}
 } 
?>
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
		<h1>dress-christ</h1>
		<h2>inscription</h2>
		<section class="inscription">	
		    <h3>remplissez le formulaire</h3>
			<form  method="POST" action="" >
				<input type="text" name="login" placeholder="login*" value="<?php if(isset($login)){echo $login;} ?>">
				<br>
				<input type="password" name="password" placeholder="mot de passe*">
				<br>
				<input type="password" name="password2" placeholder="confirmation mot de passe*">
				<br>
				<input type="submit" name="inscription" value="s'inscrire" >		
			</form>
		<?php
			if (isset($erreur))
			{
				echo "<strong>".'<font size= "5px" color="white">'.$erreur.'</font>'."</strong>";
			}
		?> 
		</section>
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
	</main>

	</body>
</html>