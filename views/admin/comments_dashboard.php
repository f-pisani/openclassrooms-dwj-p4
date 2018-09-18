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
	<h1>Gestion des commentaires</h1>
	<p>Ici vous pouvez supprimer des commentaires.</p>
	<div id="admin-comments">
	<?php
	foreach($list_articles as $article)
	{
	?>
		<div class="admin-comments-article">
			<div class="header"><h1><?= $article['title'] ?></h1><span><?= date('d/m/Y H:i:s', $article['created_at']) ?></span></div>
			<table>
				<tr>
					<th>Auteur</th>
					<th>Contenu</th>
					<th>Date</th>
					<th>Nombre de signalements</th>
					<th>Supprimer</th>
				</tr>
				<?php
				foreach($article['comments'] as $comment)
				{
				?>
				<tr>
					<td><?= $comment['nickname'] ?></td>
					<td><?= $comment['content'] ?></td>
					<td><?= date('d/m/Y H:i:s', $comment['created_at']) ?></td>
					<td><?= $comment['reported_counter'] ?></td>
					<td><a href="<?= Config::get('BASE_URL')."admin/comments/delete/".$comment['id'] ?>">Supprimer</a></td>
				</tr>
				<?php
				}
				?>
			</table>
		</div>
	<?php
	}
	?>
	</div>
</div>
