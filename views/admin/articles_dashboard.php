<?php
use Lib\Config;

include 'navbar.inc.php';
?>

<div id="admin-dashboard">
	<h1>Gestion des articles</h1>
	<p>Ici vous pouvez créer, éditer ou encore supprimer vos articles.</p>

	<div id="admin-articles">
		<a class="link-btn" href="<?= Config::get('BASE_URL')."admin/articles/create" ?>">Nouvel article</a><br><br>

		<?php
		if(count($articles_list) == 0)
			echo "<div class=\"msg-error\"><b>Aucun article !</b><br>Vous n'avez pas encore crée d'article.</div>";
		else
		{
		?>
		<table class="table">
			<thead>
				<tr>
					<th class="table-col-article">Article</th>
					<th class="table-col-statut">Statut</th>
					<th class="table-col-createdat">Date de création</th>
					<th class="table-col-updatedat">Dernière modification</th>
					<th class="table-col-edit">Modifier</th>
					<th class="table-col-delete">Supprimer</th>
				</tr>
			</thead>
			<tbody>
				<?php
				foreach($articles_list as $article)
				{
				?>

				<tr>
					<td data-colname="Article"><b><?= $article['title'] ?></b><br><?= substr(strip_tags($article['content']), 0, 256) ?>..</td>
					<td data-colname="Statut"><?= ($article['published'] == 1) ? 'Publié' : 'Brouillon' ?></td>
					<td data-colname="Date de création"><?= date('d/m/Y H:i:s', $article['created_at']) ?></td>
					<td data-colname="Dernière modification"><?= date('d/m/Y H:i:s', $article['updated_at']) ?></td>
					<td data-colname="Modifier"><a class="link-flat" href="<?= Config::get('BASE_URL')."admin/articles/edit/".$article['id'] ?>">Modifier</a></td>
					<td data-colname="Supprimer"><a class="link-flat" href="<?= Config::get('BASE_URL')."admin/articles/delete/".$article['id'] ?>">Supprimer</a></td>
				</tr>

				<?php
				} // END FOREACH
				?>
			</tbody>
		</table>
		<?php
		} // END ELSE
		?>
	</div>
</div>
