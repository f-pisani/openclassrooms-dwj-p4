<?php use Lib\Config; ?>

<header id="admin-navbar">
	<div class="brand">
		<a href="<?= Config::get('BASE_URL') ?>">Billet simple pour l'Alaska</a>
	</div>

	<nav class="links">
		<ul>
			<li><a href="<?= Config::get('BASE_URL')."admin/login" ?>">Administration</a></li>
		</ul>
	</nav>
</header>

<div id="alaska-header">
	<img src="<?= Config::get('BASE_URL').'img/alaska.png' ?>" alt="Billet simple pour l'Alaska..">
</div>
