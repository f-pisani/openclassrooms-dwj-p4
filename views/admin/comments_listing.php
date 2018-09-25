<?php
use Lib\Config;
include 'navbar.inc.php';
?>

<div id="admin-dashboard">
	<h1>Gestion des commentaires</h1>
	<p>Cet espace permet la suppression de commentaires, la suppression est irréversible.</p>

	<div id="admin-comments">
	<?php
	foreach($articles_list as $article)
	{
		if(count($article['comments']) > 0)
		{
	?>
		<div class="admin-comments-article">
			<div class="header"><h1><?= $article['title'] ?></h1><span><?= date('d/m/Y H:i:s', $article['created_at']) ?></span></div>
			<a id="toggleComments" class="link-btn" href="javascript:void(0)" onClick="showOnlyReportedComments()">Afficher uniquement les commentaires signalés</a>
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
				<tr data-reports="<?= $comment['reported_counter'] ?>">
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

<script>
var allComments = true;

function showOnlyReportedComments()
{
	if(allComments)
	{
		$(".table tr").each((i, item) => {
			if($(".table tr:nth-child("+(i+1)+")").data('reports') == 0)
			{
				$(".table tr:nth-child("+(i+1)+")").hide(250);
			}
		});

		allComments = false;
		$("#toggleComments").text('Afficher tous les commentaires');
	}
	else
	{
		$(".table tr").each((i, item) => {
			$(".table tr:nth-child("+(i+1)+")").show(250);
		});

		allComments = true;
		$("#toggleComments").text('Afficher uniquement les commentaires signalés');
	}
}
</script>
