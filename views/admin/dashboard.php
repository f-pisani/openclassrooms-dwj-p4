<?php
use Lib\Config;
use Models\User;

include 'navbar.inc.php';
?>

<div id="admin-dashboard">
	<h1>Administration du blog</h1>
	<p>Retrouvez ci-dessous les différentes actions que vous pouvez réaliser depuis cet espace.</p>

	<div id="action-list">
		<?php
		if(User::role() == 'admin')
		{
			// Admin only
		?>
		<div class="action-item">
			<h2>Gestion des articles</h2>
			<i class="fas fa-3x fa-newspaper"></i>
			<p>Permet la création, l'édition ou encore la suppression d'articles.</p>
			<a href="<?= Config::get('BASE_URL')."admin/articles" ?>">Gestion des articles</a>
		</div>

		<div class="action-item">
			<h2>Gestion des utilisateurs</h2>
			<i class="fas fa-3x fa-user-plus"></i>
			<p>Permet la gestion des utilisateurs et des droits de modération.</p>
			<a href="<?= Config::get('BASE_URL')."admin/users" ?>">Gestion des utilisateurs</a>
		</div>
		<?php
		}
		?>

		<div class="action-item">
			<h2>Gestion des commentaires</h2>
			<i class="fas fa-3x fa-comments"></i>
			<p>Permet la gestion des commentaires et leur suppression.</p>
			<a href="<?= Config::get('BASE_URL')."admin/comments" ?>">Gestion des commentaires</a>
		</div>
	</div>
</div>
