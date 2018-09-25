<?php
use Lib\Config;

include 'navbar.inc.php';
?>

<div id="admin-dashboard">
	<h1>Gestion des commentaires</h1>
	<p>Cet espace permet la gestion des commentaires.</p>

	<div id="admin-comments">
	<?php
	if(count($articles_list) == 0)
		echo "<div class=\"msg-error\"><b>Aucun article !</b><br>Le site ne contient aucun article.</div>";
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
		foreach($articles_list as $article)
		{
		?>
		<tr>
			<td><b><?= $article['title'] ?></b></td>
			<td><?= date('d/m/Y H:i:s', $article['created_at']) ?></td>
			<td><?= $article['comments'] ?></td>
			<td><?= $article['comments_reported'] ?></td>
			<?php
			if($article['comments'] > 0)
				echo "<td><a class=\"link-btn\" href=\"".Config::get('BASE_URL').'admin/comments/list/'.$article['id']."\">Voir les commentaires</a></td>";
			else
				echo "<td><a class=\"link-btn link-btn-disabled\" href=\"#\">Voir les commentaires</a></td>";
			?>
		</tr>
		<?php
		} // END FOREACH
		?>
	</table>
	<?php
	} // END ELSE
	?>
	</div>
</div>
