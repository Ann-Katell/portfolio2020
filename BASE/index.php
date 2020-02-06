    <?php
    // compteur de visite 
    // Instruction 1
    $fp = fopen ("compteur.txt", "r+");
    // Instruction 2
    $nb_visites = fgets ($fp, 11);
    // Instruction 3
    $nb_visites = $nb_visites + 1;
    // Instruction 4
    fseek ($fp, 0);
    // Instruction 5
    fputs ($fp, $nb_visites);
    // Instruction 6
    fclose ($fp);
    // Instruction 7
    echo 'Ce site compte '.$nb_visites.' visiteurs !';
    ?>

/*formulaire
<html>
<head>
<title>Ma page de test</title>
</head>
<body>
<form action = "traitement.php" method="post">
Votre nom : <input type = "text" name = "nom"><br />
Votre fonction : <input type = "text" name = "fonction"><br />
<input type = "submit" value = "Envoyer">
</form>
</body>
</html>

/* page traitement.php */

<html>
<head>
<title>Ma page de traitement</title>
</head>
<body>
    <?php
    // on teste la déclaration de nos variables
    if (isset($_POST['nom']) && isset($_POST['fonction'])) {
        // on affiche nos résultats
        echo 'Votre nom est '.$_POST['nom'].' et votre fonction est '.$_POST['fonction'];
    }
    ?>
</body>
</html>
/* page avec fichier à télécharger */
<html>
<head>
<title>Ma page de test</title>
</head>
<body>
<form action = "traitement.php" method="post" enctype="multipart/form-data">
Votre fichier : <input type = "file" name = "mon_fichier"><br />
<input type = "hidden" name="MAX_FILE_SIZE" value="20000">
<input type = "submit" value = "Envoyer">
</form>
</body>
</html>
/* pour récupérer le fichier */
$_FILES['mon_fichier']['tmp_name'] : le nom temporaire du fichier sur le serveur
$_FILES['mon_fichier']['name'] : le nom original du fichier sur la machine cliente
$_FILES['mon_fichier']['type'] : le type MIME du fichier
$_FILES['mon_fichier']['size'] : la taille du fichier

/*se connecter à sa base de donnees */
La chaîne de caractères mon_serveur doit être remplacée par celle qui correspond au nom de votre serveur (en règle générale, il s'agit de localhost ; si ce n'est pas le cas, veuillez contacter votre hébergeur pour de plus amples informations).
login correspond à votre login pour accéder à votre base.
password, votre mot de passe.
Et ma_base_de_donnees correspond au nom de votre base de données.
Mon conseil : faites-vous un fichier connect_base.php.inc ou apparaîtra seulement ce morceau de code, et dans chaque page ou vous souhaitez utiliser votre base de données, vous n'aurez alors qu'à include() ce fichier de connexion.

1.	<?php
2.	$base = mysql_connect ('mon_serveur', 'login', 'password');
3.	mysql_select_db ('ma_base_de_donnees', $base) ;
4.	?>
/* connection a la base  */

<?php
// on se connecte à notre base
    $base = mysql_connect ('serveur', 'login', 'pass');
    mysql_select_db ('ma_base', $base) ;
    ?>
<html>
<head>
<title>Numéro de téléphone de LA GLOBULE</title>
</head>
<body>
    <?php
    // lancement de la requete
    $sql = 'SELECT telephone FROM liste_proprietaire WHERE nom = "LA GLOBULE"';

    // on lance la requête (mysql_query) et on impose un message d'erreur si la requête ne se passe pas bien (or die)
    $req = mysql_query($sql) or die('Erreur SQL !<br />'.$sql.'<br />'.mysql_error());

    // on recupere le resultat sous forme d'un tableau
    $data = mysql_fetch_array($req);

    // on libère l'espace mémoire alloué pour cette interrogation de la base
    mysql_free_result ($req);
    mysql_close ();
    ?>
Le numéro de téléphone de LA GLOBULE est :<br />
<?php echo $data['telephone']; ?>
</body>
</html>
/*nom et tel des membres*/
6.	<html>
7.	<head>
8.	<title>Nom et tél des membres</title>
9.	</head>
10.	<body>
11.	<?php
12.	// lancement de la requête (on impose aucune condition puisque l'on désire obtenir la liste complète des propriétaires
13.	$sql = 'SELECT telephone, nom FROM liste_proprietaire';
14.	
15.	// on lance la requête (mysql_query) et on impose un message d'erreur si la requête ne se passe pas bien (or die)
16.	$req = mysql_query($sql) or die('Erreur SQL !<br />'.$sql.'<br />'.mysql_error());
17.	
18.	// on va scanner tous les tuples un par un
19.	while ($data = mysql_fetch_array($req)) {
20.		// on affiche les résultats
21.		echo 'Nom : '.$data['nom'].'<br />';
22.		echo 'Son tél : '.$data['telephone'].'<br /><br />';
23.	}
24.	mysql_free_result ($req);
25.	mysql_close ();
26.	?>
27.	</body>
28.	</html>

/*retrouver le numero de tel d un proprio*/
1.	<?php
2.	// on se connecte à notre base
3.	$base = mysql_connect ('serveur', 'login', 'pass');
4.	mysql_select_db ('ma_base', $base) ;
5.	?>
6.	<html>
7.	<head>
8.	<title>Numéro de téléphone du membre choisi</title>
9.	</head>
10.	<body>
11.	<?php
12.	// on teste si notre variable est déclarée
13.	if (isset($_POST['nom_proprio'])) {
14.	
15.		// lancement de la requête
16.		$sql = 'SELECT telephone FROM liste_proprietaire WHERE nom = "'.$_POST['nom_proprio'].'"';
17.	
18.		// on lance la requête (mysql_query) et on impose un message d'erreur si la requête ne se passe pas bien (or die)
19.		$req = mysql_query($sql) or die('Erreur SQL !<br />'.$sql.'<br />'.mysql_error());
20.	
21.		// on récupère le résultat sous forme d'un tableau
22.		$data = mysql_fetch_array($req);
23.	
24.		// on libère l'espace mémoire alloué pour cette interrogation de la base
25.		mysql_free_result ($req);
26.		mysql_close ();
27.	
28.	// on affiche le résultat
29.		echo 'Le numéro de téléphone est : '.$data['telephone'];
30.	}
31.	else {
32.		echo 'La variable nom_proprio n\'est pas déclarée';
33.	}
34.	?>
35.	</body>
36.	</html>
La table liste_proprietaire :
N. du propriétaire	Propriétaire	N. tél
1	LA GLOBULE	06-48-85-20-54
2	Jeremy	06-85-98-78-12
3	Luc	06-47-01-59-36


La table liste_disque :
N. du propriétaire	Auteur	Titre
1	Cassius	Au rêve
1	Daft Punk	Discovery
2	Cassius	Au rêve
2	Télépopmusik	Genetic world
3	Clamaran	Release yourself
2	Bob Sinclar	Paradise

INSERT INTO liste_proprietaire VALUES ('','tibo','06-98-42-01-36');


1.	<?php
2.	// on se connecte à notre base
3.	$base = mysql_connect ('serveur', 'login', 'pass');
4.	mysql_select_db ('ma_base', $base) ;
5.	?>
6.	<html>
7.	<head>
8.	<title>Insertion de tibo dans la base</title>
9.	</head>
10.	<body>
11.	<?php
12.	// lancement de la requete
13.	$sql = 'INSERT INTO liste_proprietaire VALUES ("", "tibo", "06-98-42-01-36")';
14.	
15.	// on insere le tuple (mysql_query) et au cas où, on écrira un petit message d'erreur si la requête ne se passe pas bien (or die)
16.	mysql_query ($sql) or die ('Erreur SQL !'.$sql.'<br />'.mysql_error());
17.	
18.	// on ferme la connexion à la base
19.	mysql_close();
20.	?>
21.	Tibo vient d'être inseré dans la base.
22.	</body>
23.	</html>
1.	<?php
2.	// on se connecte à notre base
3.	$base = mysql_connect ('serveur', 'login', 'pass');
4.	mysql_select_db ('ma_base', $base) ;
5.	?>
6.	<html>
7.	<head>
8.	<title>Insertion de Tibo et d'un nouveau disque dans la base</title>
9.	</head>
10.	<body>
11.	<?php
12.	// on prépare la requête
13.	$sql = 'INSERT INTO liste_proprietaire VALUES("", "tibo", "06-98-42-01-36")';
14.	
15.	// on insère le tuple (mysql_query) et au cas où, on écrira un petit message d'erreur si la requête ne se passe pas bien (or die)
16.	mysql_query ($sql) or die ('Erreur SQL !'.$sql.'<br />'.mysql_error());
17.	
18.	// on récupère le dernier numéro inséré, soit le numéro de tibo
19.	$numero_insere = mysql_insert_id();
20.	
21.	// on insère le tuple (mysql_query) et au cas où, on écrira un petit message d'erreur si la requête ne se passe pas bien (or die)
22.	$sql = 'INSERT INTO liste_disque VALUES ("'.$numero_insere.'", "The supermen lovers", "The player")';
23.	
24.	// on insère le tuple (mysql_query) et au cas où, on écrira un petit message d'erreur si la requête ne se passe pas bien (or die)
25.	mysql_query ($sql) or die ('Erreur SQL !'.$sql.'<br />'.mysql_error());
26.	
27.	// on ferme la connexion à la base
28.	mysql_close();
29.	?>
30.	Tibo vient d'être inseré dans la base, ainsi que son nouveau disque : The player des Supermen lovers.
31.	</body>
32.	</html>
1.	<?php
2.	// on se connecte à notre base
3.	$base = mysql_connect ('serveur', 'login', 'pass');
4.	mysql_select_db ('ma_base', $base) ;
5.	?>
6.	<html>
7.	<head>
8.	<title>Insertion de nouveaux disques dans la base</title>
9.	</head>
10.	<body>
11.	<?php
12.	// on teste si les variables du formulaire sont bien déclarées
13.	if (isset($_POST['proprio']) && isset($_POST['interprete']) && isset($_POST['titre'])) {
14.	
15.		// on prépare la requête pour récupérer le numero du propriétaire
16.		$sql = 'SELECT numero FROM liste_proprietaire WHERE nom = "'.$_POST['proprio'].'"';
17.	
18.		// on lance la requête (mysql_query) et on impose un message d'erreur si la requête ne se passe pas bien (or die)
19.		$req = mysql_query($sql) or die('Erreur SQL !<br />'.$sql.'<br />'.mysql_error());
20.	
21.		// on récupère le résultat sous forme d'un tableau
22.		$data = mysql_fetch_array($req);
23.	
24.		// on libère l'espace mémoire alloué pour cette interrogation de la base
25.		mysql_free_result ($req);
26.	
27.		// on insère le tuple (mysql_query) et au cas où, on écrira un petit message d'erreur si la requête ne se passe pas bien (or die)
28.		$sql = 'INSERT INTO liste_disque VALUES("'.$data['numero'].'", "'.$_POST['interprete'].'", "'.$_POST['titre'].'")';
29.	
30.		// on insère le tuple (mysql_query) et au cas où, on écrira un petit message d'erreur si la requête ne se passe pas bien (or die)
31.		mysql_query ($sql) or die ('Erreur SQL !'.$sql.'<br />'.mysql_error());
32.	
33.		// on ferme la connexion à la base
34.		mysql_close();
35.	
36.		echo 'Nous venons d\'insérer un nouveau disque : '.$_POST['titre'].' de '.$_POST['interprete'].' appartenant à '.$_POST['proprio'];
37.	}
38.	else {
39.		echo 'Les variables du formulaire ne sont pas déclarées';
40.	}
41.	?>
42.	</body>
43.	</html>
UPDATE liste_proprietaire SET telephone="06-55-99-10-00" WHERE nom="Luc";
UPDATE liste_proprietaire SET adresse="3, rue des tulipes", age="65" WHERE nom="Luc";
1.	<?php
2.	// on se connecte à notre base
3.	$base = mysql_connect ('serveur', 'login', 'pass');
4.	mysql_select_db ('ma_base', $base) ;
5.	?>
6.	<html>
7.	<head>
8.	<title>Modification du tél et de l'adresse deLuc</title>
9.	</head>
10.	<body>
11.	<?php
12.	// lancement de la requête
13.	$sql ='UPDATE liste_proprietaire SET adresse="3, rue des tulipes", age="65" WHERE nom="Luc"';
14.	
15.	// on exécute la requête (mysql_query) et on affiche un message au cas où la requête ne se passait pas bien (or die)
16.	mysql_query($sql) or die('Erreur SQL !'.$sql.'<br />'.mysql_error());
17.	
18.	// on ferme la connexion à la base
19.	mysql_close();
20.	?>
21.	L'adresse et l'age de Luc viennent d'être modifiés.
22.	</body>
23.	</html>

1.	<?php
2.	// on se connecte à notre base
3.	$base = mysql_connect ('serveur', 'login', 'pass');
4.	mysql_select_db ('ma_base', $base) ;
5.	?>
6.	<html>
7.	<head>
8.	<title>Modification de l'adresse d'un propriétaire</title>
9.	</head>
10.	<body>
11.	<?php
12.	// on teste si les variables du formulaire sont déclarées
13.	if (isset($_POST['nouvelle_adresse']) && isset($_POST['proprio'])) {
14.	
15.		// lancement de la requête
16.		$sql = 'UPDATE liste_proprietaire SET adresse="'.$_POST['nouvelle_adresse'].'" WHERE nom="'.$_POST['proprio'].'"';
17.	
18.		// on exécute la requête (mysql_query) et on affiche un message au cas où la requête ne se passait pas bien (or die)
19.		mysql_query($sql) or die('Erreur SQL !'.$sql.'<br />'.mysql_error());
20.	
21.		// on ferme la connexion à la base
22.		mysql_close();
23.	
24.		// un petit message permettant de se rendre compte de la modification effectuée
25.		echo 'La nouvelle adresse de '.$_POST['proprio'].' est : '.$_POST['nouvelle_adresse'];
26.	}
27.	else {
28.		echo 'Les variables du formulaire ne sont pas déclarées';
29.	}
30.	?>
31.	</body>
32.	</html>
DELETE from liste_proprietaire WHERE nom="Tibo";
1.	<?php
2.	// on se connecte à notre base
3.	$base = mysql_connect ('serveur', 'login', 'pass');
4.	mysql_select_db ('ma_base', $base) ;
5.	?>
6.	<html>
7.	<head>
8.	<title>Suppression de Tibo de la base</title>
9.	</head>
10.	<body>
11.	<?php
12.	// lancement de la requête pour effacer Tibo
13.	$sql ='DELETE from liste_proprietaire WHERE nom="Tibo"';
14.	
15.	// on exécute la requête (mysql_query) et on affiche un message au cas où la requête ne se passait pas bien (or die)
16.	mysql_query($sql) or die('Erreur SQL !'.$sql.'<br />'.mysql_error());
17.	
18.	// lancement de la requête pour effacer les disques de Tibo (je vous rappelle que Tibo à le numéro 4)
19.	$sql ='DELETE from liste_disque WHERE numero="4"';
20.	
21.	// on exécute la requête (mysql_query) et on affiche un message au cas où la requête ne se passait pas bien (or die)
22.	mysql_query($sql) or die('Erreur SQL !'.$sql.'<br />'.mysql_error());
23.	
24.	// on ferme la connexion à la base
25.	mysql_close();
26.	?>
27.	Tibo et tous ces disques ont étés supprimés de la base de données.
28.	</body>
29.	</html>

1.	<?php
2.	// on se connecte à notre base
3.	$base = mysql_connect ('serveur', 'login', 'pass');
4.	mysql_select_db ('ma_base', $base) ;
5.	?>
6.	<html>
7.	<head>
8.	<title>Suppression d'un membre de la base</title>
9.	</head>
10.	<body>
11.	<?php
12.	// on teste si la variable du formulaire est bien déclarée
13.	if (isset($_POST['proprio'])) {
14.	
15.		// on recherche le numero du membre à supprimer
16.		$sql = 'SELECT numero FROM liste_proprietaire WHERE nom = "'.$_POST[proprio].'"';
17.	
18.		// on lance la requête (mysql_query) et on impose un message d'erreur si la requête ne se passe pas bien (or die)
19.		$req = mysql_query($sql) or die('Erreur SQL !<br />'.$sql.'<br />'.mysql_error());
20.	
21.		// on recupere le resultat sous forme d'un tableau
22.		$data = mysql_fetch_array($req);
23.	
24.		// on recupere la valeur qui nous intersse
25.		$numero_du_proprio = $data['numero'];
26.	
27.		// on libère l'espace mémoire alloué pour cette interrogation de la base
28.		mysql_free_result ($req);
29.	
30.		// lancement de la requête pour effacer notre membre
31.		$sql ='DELETE from liste_proprietaire WHERE nom="'.$_POST['proprio'].'"';
32.	
33.		// on exécute la requête (mysql_query) et on affiche un message au cas où la requête ne se passait pas bien (or die)
34.		mysql_query($sql) or die('Erreur SQL !'.$sql.'<br />'.mysql_error());
35.	
36.		// lancement de la requête pour effacer les disques de notre membre
37.		$sql ='DELETE from liste_disque WHERE numero="'.$numero_proprio.'"';
38.	
39.		// on exécute la requête (mysql_query) et on affiche un message au cas où la requête ne se passait pas bien (or die)
40.		mysql_query($sql) or die('Erreur SQL !'.$sql.'<br />'.mysql_error());
41.	
42.		// on ferme la connexion à la base
43.		mysql_close();
44.	
45.		// un petit message afin de voir ce qui s'est passé
46.		echo 'Nous venons de supprimer '.$_POST['proprio'].' de la base ainsi que tous ces disques';
47.	}
48.	else {
49.		echo 'La variable de notre formulaire n\'est pas initialisée.';
50.	}
51.	?>
52.	</body>
53.	</html>
/*cookie*/
1.	<?php
2.	// on définit une durée de vie de notre cookie (en secondes), donc un an dans notre cas
3.	$temps = 365*24*3600;
4.	
5.	// on envoie un cookie de nom pseudo portant la valeur LA GLOBULE
6.	setcookie ("pseudo", "LA GLOBULE", time() + $temps);
7.	?>
1.	<html>
2.	<head>
3.	<title>Index du site</title>
4.	<body>
5.	
6.	<?
7.	// on teste la déclaration de notre cookie
8.	if (isset($_COOKIE['pseudo'])) {
9.		echo 'Bonjour '.$_COOKIE['pseudo'].' !';
10.	}
11.	else {
12.		echo 'Notre cookie n\'est pas déclaré.';
13.	
14.		// si le cookie n'existe pas, on affiche un formulaire permettant au visiteur de saisir son nom
15.		echo '<form action="./traitement.php" method="post">';
16.		echo 'Votre nom : <input type = "texte" name = "nom"><br />';
17.		echo '<input type = "submit" value = "Envoyer">';
18.	}
19.	?>
20.	
21.	</body>
22.	</html>

•	l'envoie d'un cookie doit être la première fonction PHP que vous utilisez dans votre script, 
ce qui veut dire que vous devez utiliser la fonction setcookie() tout en haut de votre script 
(AUCUN AFFICHAGE ET AUCUN CODE CODE HTML AVANT UN SETCOOKIE).<br> 
Si d'autres fonctions interviennent avant l'envoie du cookie, celui-ci ne fonctionnera pas.

Et le code pour la page traitement.php :
exemple3.php
1.	<?php
2.	If (isset($_POST['nom'])) {
3.		// on définit une durée de vie de notre cookie (en secondes), donc un an dans notre cas
4.		$temps = 365*24*3600;
5.	
6.		// on envoie un cookie de nom pseudo portant la valeur de la variable $nom, c'est-à-dire la valeur qu'a saisi la personne qui a rempli le formulaire
7.		setcookie ("pseudo", $_POST['nom'], time() + $temps);
8.	
9.		// fonction nous permettant de faire des redirections
10.		function redirection($url){
11.			if (headers_sent()){
12.			print('<meta http-equiv="refresh" content="0;URL='.$url.'">');
13.			}
14.			else {
15.			header("Location: $url");
16.			}
17.		}
18.	
19.		// on effectue une redirection vers la page d'accueil
20.		redirection ('index.php');
21.	}
22.	else {
23.		echo 'La variable du formulaire n\'est pas déclarée.';
24.	}
25.	?>

1.	<html>
2.	<head>
3.	<title>Formulaire d'identification</title>
4.	</head>
5.	
6.	<body>
7.	<form action="login.php" method="post">
8.	Votre login : <input type="text" name="login">
9.	<br />
10.	Votre mot de passe : <input type="password" name="pwd"><br />
11.	<input type="submit" value="Connexion">
12.	</form>
13.	
14.	</body>
15.	</html>
On aura alors par exemple (page login.php) :
exemple2.php
1.	<?php
2.	// On définit un login et un mot de passe de base pour tester notre exemple. Cependant, vous pouvez très bien interroger votre base de données afin de savoir si le visiteur qui se connecte est bien membre de votre site
3.	$login_valide = "moi";
4.	$pwd_valide = "lemien";
5.	
6.	// on teste si nos variables sont définies
7.	if (isset($_POST['login']) && isset($_POST['pwd'])) {
8.	
9.		// on vérifie les informations du formulaire, à savoir si le pseudo saisi est bien un pseudo autorisé, de même pour le mot de passe
10.		if ($login_valide == $_POST['login'] && $pwd_valide == $_POST['pwd']) {
11.			// dans ce cas, tout est ok, on peut démarrer notre session
12.	
13.			// on la démarre :)
14.			session_start ();
15.			// on enregistre les paramètres de notre visiteur comme variables de session ($login et $pwd) (notez bien que l'on utilise pas le $ pour enregistrer ces variables)
16.			$_SESSION['login'] = $_POST['login'];
17.			$_SESSION['pwd'] = $_POST['pwd'];
18.	
19.			// on redirige notre visiteur vers une page de notre section membre
20.			header ('location: page_membre.php');
21.		}
22.		else {
23.			// Le visiteur n'a pas été reconnu comme étant membre de notre site. On utilise alors un petit javascript lui signalant ce fait
24.			echo '<body onLoad="alert(\'Membre non reconnu...\')">';
25.			// puis on le redirige vers la page d'accueil
26.			echo '<meta http-equiv="refresh" content="0;URL=index.htm">';
27.		}
28.	}
29.	else {
30.		echo 'Les variables du formulaire ne sont pas déclarées.';
31.	}
32.	?>
Voyons alors le code de la page de notre section membre, la page page_membre.php.
On a :
exemple3.php
1.	<?php
2.	// On démarre la session (ceci est indispensable dans toutes les pages de notre section membre)
3.	session_start ();
4.	
5.	// On récupère nos variables de session
6.	if (isset($_SESSION['login']) && isset($_SESSION['pwd'])) {
7.	
8.		// On teste pour voir si nos variables ont bien été enregistrées
9.		echo '<html>';
10.		echo '<head>';
11.		echo '<title>Page de notre section membre</title>';
12.		echo '</head>';
13.	
14.		echo '<body>';
15.		echo 'Votre login est '.$_SESSION['login'].' et votre mot de passe est '.$_SESSION['pwd'].'.';
16.		echo '<br />';
17.	
18.		// On affiche un lien pour fermer notre session
19.		echo '<a href="./logout.php">Déconnection</a>';
20.	}
21.	else {
22.		echo 'Les variables ne sont pas déclarées.';
23.	}
24.	?>
Voyons alors le code de la page permettant au membre de se déconnecter (la page logout.php).
On aura alors :
exemple4.php
1.	<?php
2.	// On démarre la session
3.	session_start ();
4.	
5.	// On détruit les variables de notre session
6.	session_unset ();
7.	
8.	// On détruit notre session
9.	session_destroy ();
10.	
11.	// On redirige le visiteur vers la page d'accueil
12.	header ('location: index.htm');
13.	?>
/*page html*/
1.	<html>
2.	<head>
3.	<title>Formulaire d'identification</title>
4.	</head>
5.	
6.	<body>
7.	<form action="login.php" method="get">
8.	Votre identifiant : <input type="text" name="login">
9.	<br />
10.	Votre mot de passe : <input type="password" name="pwd"><br />
11.	<input type="submit" value="Connexion">
12.	</form>
13.	
14.	</body>
15.	</html>
/*recup Pour récupérer nos variables correspondant aux champs login et pwd, nous allons utiliser le tableau associatif $_GET.*/

On aura lors, par exemple, la page login.php suivante :
exemple2.php
1.	<html>
2.	<head>
3.	<title>Page de récupération des variables</title>
4.	</head>
5.	
6.	<body>
7.	<?php
8.	// On teste si nos variables sont déclarées
9.	if (isset($_GET['login']) && isset($_GET['pwd'])) {
10.	
11.		// On fait ce que l'on veut ensuite :)
12.		echo 'Votre login est '.$_GET['login'].' Et votre mot de passe est '.$_GET['pwd'];
13.	}
14.	else {
15.		echo 'Les variables du formulaire ne sont pas déclarées.';
16.	}
17.	?>
18.	</body>
19.	</html>
/*meme chose avec $post*/
1.	<html>
2.	<head>
3.	<title>Formulaire d'identification</title>
4.	</head>
5.	
6.	<body>
7.	<form action="login.php" method="post">
8.	Votre identifiant : <input type="text" name="login">
9.	<br />
10.	Votre mot de passe : <input type="password" name="pwd"><br />
11.	<input type="submit" value="Connexion">
12.	</form>
13.	
14.	</body>
15.	</html>

la page login.php

exemple5.php
1.	<html>
2.	<head>
3.	<title>Page de récupération des variables</title>
4.	</head>
5.	
6.	<body>
7.	<?php
8.	// On teste nos deux variables
9.	if (isset($_POST['login']) && isset($_POST['pwd'])) {
10.	
11.		// On fait ce que l'on veut ensuite :)
12.		echo 'Votre login est '.$_POST['login'].' Et votre mot de passe est '.$_POST['pwd'];
13.	}
14.	else {
15.		'Les variables du formulaire ne sont pas déclarées.';
16.	}
17.	?>
18.	</body>
19.	</html>
Récupération d'un fichier par le biais d'un formulaire

Supposons que l'on dispose d'un formulaire nous permettant d'envoyer un fichier.
On pourrait alors très bien avoir une page index.htm ressemblant à :
exemple6.php
1.	<html>
2.	<head>
3.	<title>Formulaire permettant d'envoyer un fichier</title>
4.	</head>
5.	
6.	<body>
7.	<form action="send_fichier.php" method="post" ENCTYPE="multipart/form-data">
8.	Votre fichier : <input type="file" name="mon_fichier">
9.	<INPUT TYPE="hidden" name="MAX_FILE_SIZE" value="20000">
10.	<input type="submit" value="Envoyer">
11.	</form>
12.	
13.	</body>
14.	</html>
Pour afficher ces valeurs, on pourrait très bien le code de la page send_fichier.php qui ressemble à :
exemple7.php
1.	<html>
2.	<head>
3.	<title>Page de récupération du fichier</title>
4.	</head>
5.	
6.	<body>
7.	<?php
8.	// On teste les différentes valeurs
9.	if (isset($_FILES['mon_fichier']['name']) && isset($_FILES['mon_fichier']['size']) && isset($_FILES['mon_fichier']['tmp_name']) && isset($_FILES['mon_fichier']['type']) && isset($_FILES['mon_fichier']['error'])) {
10.	
11.		// On affiche ces différentes valeurs
12.		echo  'Nom d\'origine : '.$_FILES['mon_fichier']['name'].'<br />';
13.		echo  'Taille : '.$_FILES['mon_fichier']['size'].'<br />';
14.		echo  'Nom sur le serveur : '.$_FILES['mon_fichier']['tmp_name'].'<br />';
15.		echo  'Type de fichier : '.$_FILES['mon_fichier']['type'].'<br />';
16.		echo  'Code erreur : '.$_FILES['mon_fichier']['error'].'<br />';
17.	}
18.	else {
19.		echo 'Nos variables ne sont pas déclarées.';
20.	}
21.	?>
22.	</body>
23.	</html>


Les cookies

Supposons que nous disposons d'une page send_cookie.php qui nous permet d'envoyer un cookie contenant le nom d'un visiteur.
On aurait alors par exemple :
exemple8.php
1.	<?php
2.	$temps = 365*24*5500;
3.	setcookie ("pseudo", "LA GLOBULE", time() + $temps);
4.	
5.	header ('Location : index.php');
6.	?>

Ensuite, nous allons récupérer la valeur du cookie dans la page index.php, grâce au tableau associatif $_COOKIE.
On pourrait alors avoir le code suivant :
exemple9.php
1.	<html>
2.	<head>
3.	<title>Page de récupération du cookie</title>
4.	</head>
5.	
6.	<body>
7.	<?
8.	// On teste notre cookie
9.	if (isset($_COOKIE['pseudo'])) {
10.		echo 'Votre nom est '.$_COOKIE['pseudo'];
11.	}
12.	else {
13.		echo 'Cookie non déclaré';
14.	}
15.	?>
16.	</body>
17.	</html>

Les variables de sessions

Supposons que l'on a le même formulaire d'identification que dans le tutorial consacré aux sessions.
On aura alors :
la page index.htm

exemple10.php
1.	<html>
2.	<head>
3.	<title>Formulaire d'identification</title>
4.	</head>
5.	
6.	<body>
7.	<form action="login.php" method="post">
8.	Votre login : <input type="text" name="login">
9.	<br />
10.	Votre mot de passé : <input type="password" name="pwd"><br />
11.	<input type="submit" value="Connexion">
12.	</form>
13.	
14.	</body>
15.	</html>

1.	<?php
2.	// On teste nos variables du formulaire d'authentification par le biais du tableau associatif $_POST
3.	if (isset($_POST['login']) && isset($_POST['pwd'])) {
4.	
5.		// On définit un login et un mot de passe de base pour tester notre exemple. Cependant, vous pouvez très bien interroger votre base de données afin de savoir si le visiteur qui se connecte est bien membre de votre site
6.		$login_valide = "moi";
7.		$pwd_valide = "lemien";
8.	
9.		// on vérifie les informations du formulaire, à savoir si le pseudo saisi est bien un pseudo autorisé, de même pour le mot de passe
10.		if ($login == $_POST['login'] && $pwd == $_POST['pwd']) {
11.			// dans ce cas, tout est ok, on peut démarrer notre session
12.	
13.			// on la démarre :)
14.			session_start ();
15.			// on enregistre les paramètres de notre visiteur comme variables de session ($_POST['login'] et $_POST['pwd'])
16.			$_SESSION['login'] = $_POST['login'];
17.			$_SESSION['pwd'] = $_POST['pwd'];
18.	
19.			// on redirige notre visiteur vers une page de notre section membre
20.			header ('location : page_membre.php');
21.		}
22.		else {
23.			// Le visiteur n'a pas été reconnu comme étant membre de notre site. On utilise alors un petit javascript lui signalant ce fait
24.			echo '<body onLoad="alert('Membre non reconnu...')">';
25.			// puis on le redirige vers la page d'accueil
26.			header ('location : index.htm');
27.		}
28.	}
29.	else {
30.		echo 'Les variables du formulaire ne sont pas déclarées.';
31.	}
32.	?>
1.	<?php
2.	// On démarre la session (ceci est indispensable dans toutes les pages de notre section membre)
3.	session_start ();
4.	
5.	// On teste pour voir si nos variables ont bien été enregistrées
6.	echo '<html>';
7.	echo '<head>';
8.	echo '<title>Page de notre section member</title>';
9.	echo '</head>';
10.	
11.	echo '<body>';
12.	
13.	// On teste nos variables de session
14.	if (isset($_SESSION['login']) && isset($_SESSION['pwd'])) {
15.	
16.		// On gère notre affichage
17.		echo 'Votre login est '.$_SESSION['login'].' et votre mot de passe est '.$_SESSION['pwd'].'.';
18.		echo '<br />';
19.	
20.		// On affiche un lien pour fermer notre session
21.		echo '<a href="./logout.php">Déconnection</a>';
22.	}
23.	else {
24.		echo 'Les variables de sessions ne sont pas déclarées.';
25.	}
26.	echo '</body>';
27.	echo '</html>';
28.	?>

Les variables d'environnement

Dans ce cas, rien de plus simple, puisque pour afficher le contenu d'une variable d'environnement, il suffit d'écrire $_ENV puis le nom de la variable que l'on désire afficher entre crochet.

Exemples :
exemple13.php
1.	<?php
2.	echo 'Système d\'exploitation : '.$_ENV['OS'];
3.	echo '<br /><br />';
4.	echo 'Chemin du profil utilisateur : '.$_ENV['USERPROFILE'];
5.	?>


Les variables de serveur

On procède de la même manière que pour les variables d'environnement.

Exemples :
exemple14.php
1.	<?php
2.	echo 'Chemin du script courant : '.$_SERVER['PHP_SELF'];
3.	echo '<br /><br />';
4.	echo 'Adresse IP du client : '.$_SERVER['REMOTE_ADDR'];
5.	?>
Pour récupérer plus rapidement ces variables
(dans la page login.php, en tout début de page) :

1.	<?php
2.	extract ($_POST, EXTR, OVERWRITE);
3.	?>
1.	<html>
2.	<head>
3.	<title>Formulaire d'identification</title>
4.	</head>
5.	
6.	<body>
7.	<form action="login.php" method="post">
8.	Votre identifiant : <input type="text" name="login">
9.	<br />
10.	Votre mot de passe : <input type="password" name="pwd"><br />
11.	<input type="submit" value="Connexion">
12.	</form>
13.	
14.	</body>
15.	</html>

la page login.php

exemple17.php
1.	<html>
2.	<head>
3.	<title>Page de récupération des variables</title>
4.	</head>
5.	
6.	<body>
7.	<?php
8.	// On récupère nos deux variables
9.	extract ($_POST, EXTR, OVERWRITE);
10.	
11.	// On fait ce que l'on veut ensuite :)
12.	echo 'Votre login est '.$login.' Et votre mot de passe est '.$pwd;
13.	?>
14.	</body>
15.	</html>

/*indentation*/
1.	<?php
2.	$toto = 2;
3.	if ($toto == 2) {
4.	echo '$toto vaut 2';
5.	}
6.	elseif ($toto == 3) {
7.		echo '$toto vaut 3';
8.	}
9.	else {
10.		echo '$toto n\'est pas égal à 2 ou 3';
11.	}
12.	?>
/*debogage*/
exemple (afin de voir si la variable ne contient pas en début ou en fin de chaîne un espace qui peut être source de bug).
exemple6.php
1.	<?php
2.	$chaine = " test";
3.	echo '.'.$chaine.'.';
4.	?>
En ce qui concerne les variables de type tableau (array), vous pouvez visualiser leur contenu à l'aide de la fonction print_r.

Exemple :
exemple7.php
1.	<?php
2.	$tablo = array ('a' => 'pomme', 'b' => 'banane', 'c' => array ('x', 'y', 'z'));
3.	print_r ($tablo);
4.	?>
Prenez également attention aux tests de votre conditionnelle.

En effet, en écrivant par exemple :
exemple8.php
1.	<?php
2.	$toto = 5;
3.	if ($toto == 4) {
4.		echo '$toto vaut 4';
5.	}
6.	?>
Si par contre votre boucle effectue des traitements non voulus sur vos données, prenez l'habitude de placer un echo dans votre boucle afin de voir la valeur de vos variables à chaque passage de boucle.
Pour pourrez ainsi mieux apprécier le comportement de votre boucle sur vos variables.

Exemple :
exemple9.php
1.	<?php
2.	$toto = 2;
3.	for ($i = 0; $i < 5; $i++) {
4.		$resultat = $toto * $i;
5.		echo 'Passage numéro '.$i.' => multiplication = '.$resultat;
6.		echo '<br />';
7.	}
8.	?>
/*requetesql test*/
1.	<?php
2.	$sql = 'SELECT toto FROM table WHERE test="ok"';
3.	$req = mysql_query($sql) or die('Erreur SQL !<br />'.$sql.'<br />'.mysql_error());
4.	$nb = mysql_num_rows ($req);
5.	
6.	if ($nb == 0) {
7.		echo 'Aucun résultat retourné.';
8.	}
9.	else {
10.		// Récupération des résultats et affichage
11.	}
12.	mysql_free_result ($req);
13.	?>

Les messages d'erreurs fréquents

Enfin, si malgré toutes ces précautions, il vous arrive de bloquer sur une erreur, voici un tableau regroupant les erreurs les plus communes que l'on peut avoir en programmant avec PHP accompagnées de petits indices vous permettant de les résoudre.
Erreur	Remède
Parse error: parse error in xxxx.php on line y	Il s'agit d'une erreur de syntaxe. Vérifiez si vous n'avez pas oublié un ; marquant la fin d'une instruction. Vérifier également si il ne manque pas un $ (dollar) devant le nom d'une variable. N'hésitez pas à contrôler les lignes précédentes. L'erreur se trouve souvent juste au-dessus.
Warning: php_SetCookie called after header has been sent in xxxx.php on line y	Vous avez tenté d'initialiser un cookie après que l'entête HTTP soit envoyé au client. Vérifiez si une sortie (echo, print, message d'erreur, ligne blanche, code html avant les tags php) ne se fait pas avant votre initialisation de cookie
Warning: MySQL Connection Failed: Access denied for user: ....	Erreur de connexion à la base MySQL. Vérifiez vos paramètres de connexion
Warning: Unable to create [chemin] No such file or directory in your script on line [numero]	Le chemin vers le répertoire sensé contenir le fichier ou bien le chemin du répertoire dans lequel le fichier doit être crée est incorrect
Warning: 0 is not a MySQL result index in xxxx.php on line y	Erreur probable au niveau de la requête SQL. Vérifiez votre requête SQL : en particulier les champs manipulés, le nom de ou des tables impliquées, etc...
Warning: Variable $zzzz is not an array or string in xxxx.php on line y	Vous tentez de manipuler une valeur numérique avec une fonction dédiée aux chaînes ou aux tableaux.
Warning: Variable $zzzz is not an array or object in xxxx.php on line y	Vous tentez de manipuler une valeur numérique avec une fonction dédiée aux tableaux ou aux objets.
Warning: Cannot add header information headers already sent in xxxx.php on line y	Vous avez tenté d'effectuer un Header après que l'entête HTTP ait envoyé au client. Vérifiez si une sortie (echo, print, message d'erreur, voir même du code html) ne s'exécute pas avant votre Header
Fatal error: Maximum execution time exceeded in xxxx.php on line y	PHP dispose d'un mécanisme permettant de se prémunir des scripts susceptibles d'engendrer un temps d'exécution trop important pouvant saturer un serveur. Par défaut, ce temps est de 30 secondes.
Fatal error: Allowed memory size of 8388608 bytes exhausted (tried to allocate x bytes) in yyyy.php on line z	PHP dispose d'un mécanisme permettant de se prémunir des scripts susceptibles d'engendrer une consommation mémoire trop importante pouvant saturer un serveur. Par défaut, une limite est fixée à environ 8 Mo (8388608 octets).
Fatal Error: Call to undefined function: xxxx() in yyy.php on line z	La fonction que vous appelez n'existe pas. Ce peut-être une fonction liée à une librairie externe (GD, Zlib, PDF, etc.). Dans ce cas, un simple phpinfo() vous renseignera sur les paramètres de compilation de votre version de PHP. Peut-être s'agit-il sinon d'une de vos propres fonctions. Vérifiez alors qu'elle existe (notamment si votre script y accéde bien si elle se trouve dans un autre fichier). Et dans tous les cas, contrôlez de plus près le nom de la fonction appelée (orthographe, etc.). Une erreur de frappe est vite arrivée.
Fatal Error: Cannot redeclare xxxx() in yyy.php on line z	Vous avez certainement déclaré plusieurs fois la même fonction. Contrôlez à nouveau l'ensemble des fonctions que vous avez créées. Et n'hésitez pas à vérifier également dans les éventuels fichiers inclus. C'est souvent dans un script secondaire que vous trouverez le doublon. Veillez aussi à ne pas utiliser le nom d'une fonction propre à PHP ou à l'une de ses librairies. 
Fatal error: Input in flex scanner failed in xxxx on line y	Vérifiez vos include et require. Il y a fort à croire que vous avez indiqué un chemin incomplet (genre /usr/local/ sans préciser de fichier). 
Failed opening '%s' for inclusion (include_path='%s')	Le fichier n'a pas pu être inclus dans votre script, car PHP n'a pas pu y accéder : vérifiez les droits (utilisateur PHP, droits du fichier), les noms et chemins du fichier inclus.
file("%s") - Bad file descriptor	Problème d'accès à un fichier avec la fonction file(). Vérifiez bien que l'URL est valide. (l'URL "http://www.super.php") est invalide alors qu'une erreur de type 404 sera valide.
Wrong parameter count for %s()	La fonction est appelée avec un nombre insuffisant de paramètre, ou bien avec trop de paramètres. Certaines fonctions ont besoin d'un minimum de paramètres (array()), et généralement d'un maximum. 
stat failed for %s (errno=%d - %s)	Impossible d'accéder au fichier (problème de droits ou de chemin d'accès).



Pour savoir si la librairie GD est installée sur votre serveur, vous devez faire un phpinfo. Pour cela, créer un fichier, par exemple phpinfo.php, dans lequel vous allez placer le code suivant :
exemple1.php
1.	<?php
2.	phpinfo();
3.	?>
/*travail sur image*/
1.	<html>
2.	<head>
3.	<title>Notre page de test</title>
4.	</head>
5.	
6.	<body>
7.	<img src="./mon_image.php">
8.	</body>
9.	
10.	</html>
Voyons à présent le code de la page mon_image.php.
1.	<?php
2.	// on spécifie le type de document que l'on va créer (ici une image au format PNG
3.	header ("Content-type: image/png");
4.	
5.	// on dessine une image vide de 200 pixels sur 100
6.	$image = @ImageCreate (200, 100) or die ("Erreur lors de la création de l'image");
7.	
8.	// on applique à cette image une couleur de fond, les couleurs étant au format RVB, on aura donc ici une couleur rouge
9.	$couleur_fond = ImageColorAllocate ($image, 255, 0, 0);
10.	
11.	// on dessine notre image PNG
12.	ImagePng ($image);
13.	?>
/*choisir la couleur de l image*/
1.	<html>
2.	<head>
3.	<title>Notre page de test</title>
4.	</head>
5.	
6.	<body>
7.	Sélectionner l'intensité des différentes teintes :<br />
8.	<form action="./mon_image.php" method="post">
9.	Rouge (un nombre entre 0 et 255) : <input type="text" name="rouge"><br />
10.	Vert (un nombre entre 0 et 255) : <input type="text" name="vert"><br />
11.	Bleu (un nombre entre 0 et 255) : <input type="text" name="bleu"><br />
12.	<input type="submit" value="Voir">
13.	</form>
14.	</body>
15.	
16.	</html>

Et prenons par exemple le code suivant pour la page mon_image.php (nous ne ferons pas ici la vérification des champs du formulaire : en effet, on supposera que l'utilisateur saisi bien à chaque fois un nombre entre 0 et 255) :
exemple7.php
1.	<?php
2.	// on teste nos 3 variables pour nos couleurs
3.	if (isset($_POST['rouge']) && isset($_POST['vert']) && isset($_POST['bleu'])) {
4.	
5.		// on spécifie le type de document que l'on va créer (ici une image au format PNG
6.		header ("Content-type: image/png");
7.	
8.		// on dessine une image vide de 200 pixels sur 100
9.		$image = @ImageCreate (200, 100) or die ("Erreur lors de la création de l'image");
10.	
11.		// on applique à cette image une couleur de fond, les couleurs étant 	au format RVB, on obtiendra ici la couleur que l'utilisateur aura spécifié en paramètre du formulaire
12.		$couleur_fond = ImageColorAllocate ($image, $_POST['rouge'], $_POST['vert'], $_POST['bleu']);
13.	
14.		// on dessine notre image PNG
15.		ImagePng ($image);
16.	}
17.	else {
18.		echo 'Les variables du formulaire ne sont pas déclarées.';
19.	}
20.	?>
/*protection des photos*/
1.	<?php
2.	// on spécifie le type de fichier créer (ici une image de type jpeg)
3.	header ("Content-type: image/jpeg");
4.	
5.	// on crée deux variables contenant les chemins d'accès à nos deux fichiers : $fichier_source contenant le lien vers l'image à "copyrighter", $fichier_copyright contenant le lien vers la petite vignette contenant le copyright (bien sur, on prendra soin de placer les images sources dans un répertoire "caché" sinon le copyright ne sert à rien si les visiteurs ont accès aux images sources)
6.	$fichier_source = "./gd.jpg";
7.	$fichier_copyright = "./copyright.jpg";
8.	
9.	// on crée nos deux ressources de type image (par le biais de la fonction ImageCreateFromJpeg)
10.	$im_source = ImageCreateFromJpeg ($fichier_source);
11.	$im_copyright = ImageCreateFromJpeg ($fichier_copyright);
12.	
13.	// on calcule la largeur de l'image qui va être copyrightée
14.	$larg_destination = imagesx ($im_source);
15.	
16.	// on calcule la largeur de l'image correspondant à la vignette de copyright
17.	$larg_copyright = imagesx ($im_copyright);
18.	// on calcule la hauteur de l'image correspondant à la vignette de copyright
19.	$haut_copyright = imagesy ($im_copyright);
20.	
21.	// on calcule la position sur l'axe des abscisses de la vignette
22.	$x_destination_copyright = $larg_destination - $larg_copyright;
23.	
24.	// on réalise la superposition, le dernier paramètre étant le degré de transparence de la vignette (cependant, allez voir la fin de ce même tutorial pour une définition complète de tous les arguments de cette fonction)
25.	@imageCopyMerge ($im_source, $im_copyright,
26.		$x_destination_copyright, 0, 0, 0, $larg_copyright,
27.		$haut_copyright, 70);
28.	
29.	// on affiche notre image copyrightée
30.	Imagejpeg ($im_source);
31.	?>

puis afficher l'image dans une page	<img src="./mon_image.php">
/*créér des images miniatures*/
1.	<?php
2.	// on donne à PHP le lien vers notre image à miniaturiser
3.	$Image = "metaeffect_001.jpg";
4.	
5.	// on impose la taille de la largeur ou de la hauteur de la photo (le choix entre la largeur ou la hauteur se fait automatiquement, suivant que la photo est "horizontale" ou "verticale")
6.	$ratio = 150;
7.	
8.	// on crée une ressource représentant en fait l'image à miniaturiser
9.	$src=imagecreatefromjpeg($Image);
10.	
11.	// on récupère les paramètres de notre image (getimagesize est une fonction qui retourne un tableau contenant les paramètres d'une image : sa largeur, son hauteur, son type, etc...)
12.	$size = getimagesize($Image);
13.	
14.	// on test si la largeur de l'image est supérieur à sa longueur
15.	if ($size[0] > $size[1]) {
16.		// on crée une ressource pour notre miniature
17.		$im=imagecreate(round(($ratio/$size[1])*$size[0]), $ratio);
18.		// on place dans la ressource que nous venons de créer une copie de l'image originelle, redimensionnée et réechantillonée
19.		imagecopyresampled($im, $src, 0, 0, 0, 0, round(($ratio/$size[1])*$size[0]),$ratio, $size[0], $size[1]);
20.	}
21.	else {
22.		// si la largeur est inférieure ou égale à la hauteur, on entre dans ce cas
23.		// on crée une ressource pour notre miniature
24.		$im=imagecreate($ratio, round(($ratio/$size[0])*$size[1]));
25.		// on place dans la ressource que nous venons de créer une copie de l'image originelle, redimensionnée et réechantillonée
26.		imagecopyresampled($im, $src, 0, 0, 0, 0, $ratio, round($size[1]*($ratio/$size[0])), $size[0], $size[1]);
27.	}
28.	
29.	// on définit le nom de notre miniature
30.	$miniature = "mini_$Image";
31.	
32.	// on crée notre miniature
33.	ImageJpeg ($im, $miniature);
34.	?>
puis afficher la mini:	<img src="mini_metaeffect_001.jpg ">
/*send mail */
Afin de commencer sur de bonnes bases, je vous conseille de stocker votre classe de mails dans un fichier PHP, comme par exemple sendmail.class.php, puis d'include ce fichier dans vos scripts lorsque vous en aurez besoin.

Attaquons tout de suite le code de notre classe !

Voici les premières lignes de code de notre classe :
exemple1.php
1.	<?php
2.	class SendMail {
3.		var $destinataire;
4.		var $objet;
5.		var $texte;
6.	}
7.	?>
1.	<?php
2.	// on inclut le code de notre classe
3.	include ("./sendmail.class.php");
4.	
5.	// on déclare notre objet (en fait, dans le langage objet, on dit que l'on crée une instance de la classe SendMail)
6.	$message = new SendMail ();
7.	
8.	// on affecte des valeurs aux attributs de notre objet
9.	$message->destinataire = "toto@toto.com";
10.	$message->objet = "Scoop mondial !";
11.	$message->texte = "Voici mon premier mail utilisant une classe mail :)";
12.	?>
Pour envoyer notre mail, nous allons écrire une méthode pour notre classe qui utilisera la fonction mail de PHP ainsi que les attributs de notre objet.

On aura alors (pour notre classe) :

1.	<?php
2.	class SendMail {
3.		var $destinataire;
4.		var $objet;
5.		var $texte;
6.	
7.		function envoyer() {
8.			mail ($this->destinataire, $this->objet, $this->texte);
9.		}
10.	}
11.	?>
Envoyons maintenant notre mail grâce à notre méthode envoyer() :
exemple5.php
1.	<?php
2.	include ("./sendmail.class.php");
3.	
4.	$message = new SendMail ();
5.	
6.	$message->destinataire = "toto@toto.com";
7.	$message->objet = "Scoop mondial !";
8.	$message->texte = "Voici mon premier mail utilisant une classe mail :)";
9.	
10.	// on applique la méthode envoyer() à notre objet $message grâce à l'opérateur ->
11.	$message->envoyer();
12.	?>
