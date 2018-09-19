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
