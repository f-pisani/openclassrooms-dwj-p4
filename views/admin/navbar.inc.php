<?php
use Lib\Config;
use Models\User;
?>

<header id="admin-navbar">
	<div class="brand">
		<a href="<?= Config::get('BASE_URL')."admin" ?>">Administration du site - <?= $_SESSION['user_email'] ?></a>
	</div>

	<nav class="links">
		<ul>
			<li><a href="<?= Config::get('BASE_URL') ?>">Retour au site</a></li>
			<li><a href="<?= Config::get('BASE_URL')."profil" ?>">Mon profil</a></li>
			<?php
			if(User::role() == 'admin')
			{
			?>
			<li><a href="<?= Config::get('BASE_URL')."admin/articles" ?>">Gestion des articles</a></li>
			<?php
			}
			?>
			<li><a href="<?= Config::get('BASE_URL')."admin/comments" ?>">Gestion des commentaires</a></li>
			<li><a href="<?= Config::get('BASE_URL')."logout" ?>">Déconnexion</a></li>
		</ul>
	</nav>
</header>
