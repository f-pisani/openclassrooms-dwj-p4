<?php use Lib\Config; ?>
<header id="admin-navbar">
	<div class="brand">
		Administration du blog
	</div>

	<nav class="links">
		<ul>
			<li><a href="<?= Config::get('BASE_URL')."admin/articles" ?>">Gestion des articles</a></li>
			<li><a href="<?= Config::get('BASE_URL')."admin/comments" ?>">Gestion des commentaires</a></li>
			<li><a href="<?= Config::get('BASE_URL')."admin/settings" ?>">Mon profil</a></li>
		</ul>
	</nav>
</header>
