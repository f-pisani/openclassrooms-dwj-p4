<?php
use Lib\Config;
include 'navbar.inc.php';
?>

<div id="admin-dashboard">
	<h1>Gestion des commentaires</h1>
	<p>Cette espace permet la suppression de commentaires, la suppression est irréversible.</p>

	<div id="admin-comments">
	<?php
	foreach($list_articles as $article)
	{
		if(count($article['comments']) > 0)
		{
	?>
		<div class="admin-comments-article">
			<div class="header"><h1><?= $article['title'] ?></h1><span><?= date('d/m/Y H:i:s', $article['created_at']) ?></span></div>
			<table class="table">
				<tr>
					<th class="table-col-comment">Commentaire</th>
					<th class="table-col-date">Date</th>
					<th class="table-col-report">Nombre de signalements</th>
					<th class="table-col-delete">Supprimer</th>
				</tr>
				<?php
				foreach($article['comments'] as $comment)
				{
				?>
				<tr>
					<td><b><?= $comment['nickname'] ?></b><br><?= $comment['content'] ?></td>
					<td><?= date('d/m/Y H:i:s', $comment['created_at']) ?></td>
					<td><?= $comment['reported_counter'] ?></td>
					<td><a href="<?= Config::get('BASE_URL')."admin/comments/delete/".$comment['id']."/".$article['id'] ?>">Supprimer</a></td>
				</tr>
				<?php
				}
				?>
			</table>
		</div>
	<?php
		}
	}
	?>
	</div>
</div>
