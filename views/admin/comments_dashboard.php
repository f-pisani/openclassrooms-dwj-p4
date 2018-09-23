<?php
use Lib\Config;

include 'navbar.inc.php';
?>

<div id="admin-dashboard">
	<h1>Gestion des commentaires</h1>
	<p>Cette espace permet la gestion des commentaires.</p>

	<div id="admin-comments">
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
			<th class="table-col-title">Article</th>
			<th class="table-col-createdat">Date de création</th>
			<th class="table-col-commentsCount">Nombre de commentaires</th>
			<th class="table-col-commentsReported">Nombre de commentaires signalés</th>
			<th class="table-col-show">Voir les commentaires</th>
		</tr>
		<?php
		foreach($list_articles as $article)
		{
		?>
		<tr>
			<td><b><?= $article['title'] ?></b></td>
			<td><?= date('d/m/Y H:i:s', $article['created_at']) ?></td>
			<td><?= count($article['comments']) ?></td>
			<td><?= $article['comments_reported'] ?></td>
			<?php
			if(count($article['comments']) > 0)
			{
			?>
			<td><a class="link-btn" href="<?= Config::get('BASE_URL')."admin/comments/list/".$article['id'] ?>">Voir les commentaires</a></td>
			<?php
			}
			else
			{
			?>
			<td><a class="link-btn link-btn-disabled" href="#">Voir les commentaires</a></td>
			<?php
			}
			?>
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
