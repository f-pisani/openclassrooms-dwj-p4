<?php
	use Lib\Config;
	use Models\User;
?>

<header id="admin-navbar">
	<div class="brand">
		<a href="<?= Config::get('BASE_URL') ?>"><i class="fas fa-book-open"></i> Billet simple pour l'Alaska</a>
	</div>

	<nav class="links">
		<ul>
			<?php
			if(User::isLogged())
			{
				if(in_array(User::role(), ['admin', 'mod']))
				{
				?>
				<li><a href="<?= Config::get('BASE_URL')."admin" ?>"><i class="fas fa-user-secret"></i> Administration</a></li>
				<?php
				}
			?>
			<li><a href="<?= Config::get('BASE_URL')."profil" ?>"><i class="fas fa-user"></i> Mon Profil</a></li>
			<li><a href="<?= Config::get('BASE_URL')."logout" ?>"><i class="fas fa-sign-out-alt"></i> Déconnexion</a></li>
			<?php
			}
			else
			{
			?>
			<li><a href="<?= Config::get('BASE_URL')."register" ?>"><i class="fas fa-user-plus"></i> Inscription</a></li>
			<li><a href="<?= Config::get('BASE_URL')."login" ?>"><i class="fas fa-sign-in-alt"></i> Connexion</a></li>
			<?php
			}
			?>
		</ul>
	</nav>
</header>

<div id="alaska-header">
	<img src="<?= Config::get('BASE_URL').'img/alaska.png' ?>" alt="Billet simple pour l'Alaska..">
</div>
