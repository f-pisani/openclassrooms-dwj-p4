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
		<thead>
			<tr>
				<th class="table-col-title">Article</th>
				<th class="table-col-createdat">Date de création</th>
				<th class="table-col-commentsCount">Nombre de commentaires</th>
				<th class="table-col-commentsReported">Nombre de commentaires signalés</th>
				<th class="table-col-show">Voir les commentaires</th>
			</tr>
		</thead>
		<tbody>

			<?php
			foreach($articles_list as $article)
			{
			?>
			<tr>
				<td data-colname="Article"><b><?= htmlentities($article['title'], ENT_HTML5 | ENT_QUOTES ) ?></b></td>
				<td data-colname="Date de création"><?= date('d/m/Y H:i:s', $article['created_at']) ?></td>
				<td data-colname="Nombre de commentaires"><?= $article['comments'] ?></td>
				<td data-colname="Nombre de commentaires signalés"><?= $article['comments_reported'] ?></td>
				<?php
				if($article['comments'] > 0)
					echo "<td data-colname=\"Voir les commentaires\"><a class=\"link-btn\" href=\"".Config::get('BASE_URL').'admin/comments/list/'.$article['id']."\">Voir les commentaires</a></td>";
				else
					echo "<td data-colname=\"Voir les commentaires\"><a class=\"link-btn link-btn-disabled\" href=\"#\">Voir les commentaires</a></td>";
				?>
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
