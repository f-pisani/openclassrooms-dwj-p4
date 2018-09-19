<?php
use Lib\Config;

include 'navbar.inc.php';
?>

<div id="admin-dashboard">
	<h1>Administration du blog</h1>
	<p>Retrouvez ci-dessous les différentes actions que vous pouvez réaliser depuis cet espace.</p>

	<div id="action-list">
		<div class="action-item">
			<h2>Mon profil</h2>
			<i class="fas fa-3x fa-cogs"></i>
			<p>Permet de configurer certains paramètres liés au compte d'administration.</p>
			<a href="<?= Config::get('BASE_URL')."admin/settings" ?>">Mon profil</a>
		</div>

		<div class="action-item">
			<h2>Gestion des articles</h2>
			<i class="fas fa-3x fa-newspaper"></i>
			<p>Permet de la création, l'édition ou encore la suppression d'articles.</p>
			<a href="<?= Config::get('BASE_URL')."admin/articles" ?>">Gestion des articles</a>
		</div>

		<div class="action-item">
			<h2>Gestion des commentaires</h2>
			<i class="fas fa-3x fa-comments"></i>
			<p>Permet la gestion des commentaires, visualiser les commentaires qui ont étés signalés et la possibilité
				de les supprimer.</p>
			<a href="<?= Config::get('BASE_URL')."admin/comments" ?>">Gestion des commentaires</a>
		</div>

		<div class="action-item">
			<h2>Déconnexion</h2>
			<i class="fas fa-3x fa-sign-out-alt"></i>
			<p>Permet de quitter l'espace d'administration en toute sécuritée.</p>
			<a href="<?= Config::get('BASE_URL')."admin/logout" ?>">Déconnexion</a>
		</div>
	</div>
</div>
