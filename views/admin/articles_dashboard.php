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
				<th style="width: 20%;">Titre</th>
				<th style="width: 30%;">Extrait</th>
				<th style="width: 10%;">Publié</th>
				<th style="width: 15%;">Date de création</th>
				<th style="width: 15%;">Dernière modification</th>
				<th style="width: 5%;">Modifier</th>
				<th style="width: 5%;">Supprimer</th>
			</tr>
			<?php
			foreach($list_articles as $article)
			{
				echo '<tr>';
				echo '<td>'. $article['title'] .'</td>';
				echo '<td>'. substr($article['content'], 0, 128) .'..</td>';
				if($article['published'] == 1)
					echo '<td>Publié</td>';
				else
					echo '<td>Brouillon</td>';
				echo '<td>'. date('d/m/Y H:i:s', $article['created_at']) .'</td>';
				echo '<td>'. date('d/m/Y H:i:s', $article['updated_at']) .'</td>';
				echo '<td><a href="'. Config::get('BASE_URL')."admin/articles/edit/".$article['id'] .'">Modifier</a></td>';
				echo '<td><a href="'. Config::get('BASE_URL')."admin/articles/delete/".$article['id'] .'">Supprimer</a></td>';
				echo '</tr>';
			}
			?>
		</table>
	</div>
</div>
