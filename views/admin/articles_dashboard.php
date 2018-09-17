<?php use Lib\Config; ?>
<header id="admin-navbar">
	<div class="brand">
		<a href="<?= Config::get('BASE_URL')."admin" ?>">Administration du blog - <?= $_SESSION['user_email'] ?></a>
	</div>

	<nav class="links">
		<ul>
			<li><a href="<?= Config::get('BASE_URL')."admin/settings" ?>">Mon profil</a></li>
			<li><a href="<?= Config::get('BASE_URL')."admin/articles" ?>">Gestion des articles</a></li>
			<li><a href="<?= Config::get('BASE_URL')."admin/comments" ?>">Gestion des commentaires</a></li>
			<li><a href="<?= Config::get('BASE_URL')."admin/logout" ?>">Déconnexion</a></li>
		</ul>
	</nav>
</header>
<div id="admin-dashboard">
	<h1>Gestion des articles</h1>
	<p>Ici vous pouvez créer, éditer ou encore supprimer des articles.</p>
	<div id="admin-articles">
		<a class="link-btn" href="<?= Config::get('BASE_URL')."admin/articles/create" ?>">Nouvel article</a><br><br>
		<table>
			<tr>
				<th style="width: 5%;">ID</th>
				<th style="width: 20%;">Titre</th>
				<th style="width: 40%;">Extrait</th>
				<th style="width: 15%;">Date de création</th>
				<th style="width: 15%;">Dernière modification</th>
				<th style="width: 5%;">Modifier</th>
			</tr>
			<tr>
				<td>ID</td>
				<td>Titre</td>
				<td>Extrait</td>
				<td>Date de création</td>
				<td>Dernière modification</td>
				<td>Modifier</td>
			</tr>
		</table>
	</div>
</div>
