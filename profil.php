<?php
//boutique/profil.php
require_once('inc/init.inc.php');

// Est-ce user est connecté sinon... redirection !! 
if(!userConnecte()){ // Si c'est false
	header('location:connexion.php');
}


//debug($_SESSION);

extract($_SESSION['membre']);



$page = 'Profil';
require_once('inc/header.inc.php');

?>
<div class="row">
	<h1>Profil de <?= $pseudo ?></h1>
	<div class="col-md-6 col-xs-12">
		<h2>Infos De profil</h2>
		<ul>
			<li>Prénom : <b><?= $prenom ?></b></li>
			<li>Nom : <b><?= $nom ?></b></li>
			<li>Civilite : <b><?= ($civilite == 'm') ? 'Homme' : 'Femme' ?></b></li>
			<li>Email : <b><?= $email ?></b></li>
			<li>Statut : <b><?= ($statut == '0') ? 'Client' : 'Admin' ?></b></li>
		</ul>
	</div>
	<div class="col-md-6 col-xs-12">
		<h2>Adresse de livraison</h2>
		<p>
		<b><?= $nom ?> <?= $prenom ?></b><br/>
		<?= $adresse ?><br/>
		<?= $code_postal ?> <?= $ville ?>
		</p>
	</div>
</div>
	<h2>Historique des commandes</h2>
	<table class="table table-fluid table-dark">
		<tr>	
			<th>Commande N°</th>
			<th>Montant</th>
			<th>Date</th>
			<th>Statut</th>
		</tr>
<?php

$id_membre = $_SESSION['membre']['id_membre'];
$commande = $pdo -> prepare("SELECT * FROM commande WHERE id_membre = $id_membre");
$commande -> execute();

while ($row = $commande->fetch(PDO::FETCH_ASSOC)){   //Creates a loop to loop through results

		echo"<tr>";
			echo"<td>"; echo $row['id_commande']; echo "</td>";
			echo"<td>"; echo $row['montant']; echo "</td>";
			echo"<td>"; echo $row['date_enregistrement']; echo "</td>";
			echo"<td>"; echo $row['etat']; echo "</td>";
		echo "</tr>";
		
		}

echo "</table>";
?>


<?php
require_once('inc/footer.inc.php');
?>
