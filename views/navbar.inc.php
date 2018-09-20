<?php use Lib\Config; ?>

<header id="admin-navbar">
	<div class="brand">
		<a href="<?= Config::get('BASE_URL') ?>">Billet simple pour l'Alaska</a>
	</div>

	<nav class="links">
		<ul>
			<li><a href="<?= Config::get('BASE_URL')."admin/login" ?>">Administration</a></li>
			<li><a href="<?= Config::get('BASE_URL')."about" ?>">À propos</a></li>
		</ul>
	</nav>
</header>
