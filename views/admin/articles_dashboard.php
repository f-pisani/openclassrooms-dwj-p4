<?php
use Lib\Config;

include 'navbar.inc.php';
?>

<div id="admin-dashboard">
	<h1>Gestion des articles</h1>
	<p>Ici vous pouvez créer, éditer ou encore supprimer des articles.</p>

	<div id="admin-articles">
		<a class="link-btn" href="<?= Config::get('BASE_URL')."admin/articles/create" ?>">Nouvel article</a><br><br>
		<?php
		if(count($list_articles) == 0)
		{
		?>
			<div class="msg-error"><b>Aucun article !</b><br>Le site ne contient aucun article.</div>
		<?php
		}
		else
		{
		?>
		<table class="table">
			<tr>
				<th class="table-col-article">Article</th>
				<th class="table-col-statut">Statut</th>
				<th class="table-col-createdat">Date de création</th>
				<th class="table-col-updatedat">Dernière modification</th>
				<th class="table-col-edit">Modifier</th>
				<th class="table-col-delete">Supprimer</th>
			</tr>
			<?php
			foreach($list_articles as $article)
			{
			?>
			<tr>
				<td><b><?= $article['title'] ?></b><br><?= substr(strip_tags($article['content']), 0, 256) ?>..</td>
				<td><?= ($article['published'] == 1) ? 'Publié' : 'Brouillon' ?></td>
				<td><?= date('d/m/Y H:i:s', $article['created_at']) ?></td>
				<td><?= date('d/m/Y H:i:s', $article['updated_at']) ?></td>
				<td><a href="<?= Config::get('BASE_URL')."admin/articles/edit/".$article['id'] ?>">Modifier</a></td>
				<td><a href="<?= Config::get('BASE_URL')."admin/articles/delete/".$article['id'] ?>">Supprimer</a></td>
			</tr>
			<?php
			}
			?>
		</table>
		<?php
		}
		?>
	</div>
</div>
