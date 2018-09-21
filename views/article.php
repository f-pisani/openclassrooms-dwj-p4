<?php
use Lib\Config;

include 'navbar.inc.php';
?>

<div id="blog">
	<?php
	foreach($list_articles as $article)
	{
	?>
	<div id="post">
		<h1><?= $article['title'] ?></h1>
		<div class="content"><?= $article['content'] ?></div>
		<div class="footer">
			<span class="author">Par <b><?= $article['user_displayName'] ?></b> publié le <?= date('d/m/Y \à H:i', $article['created_at']) ?></span>
		</div>
	</div>
	<div id="comments">
		<h1><?= count($article['comments']) ?> commentaire(s)</h1>
		<form id="form-comment" class="form" action="<?= Config::get('BASE_URL')."articles/".$article['id'] ?>#comments" method="post">
			<div class="form-row">
				<label class="label" for="nickname">Pseudo :</label>
				<input type="text" class="input" id="nickname" name="nickname" placeholder="Votre pseudo.. (sinon Anonyme)">
			</div>
			<div class="form-row">
				<label class="label" for="comment">Commentaire :</label>
				<textarea class="input" id="comment" name="comment" placeholder="Très bon chapitre, j'attends la suite avec impatience !"></textarea>
			</div>
			<button type="submit" class="btn">Envoyer mon commentaire</button>
		</form>
		<?php
		foreach($article['comments'] as $comment)
		{
		?>
		<div class="comment">
			<span class="author"><?= $comment['nickname'] ?></span>
			<div class="content"><?= $comment['content'] ?></div>
			<div class="footer">
				<span><?= date('d/m/Y à H:i:s', $comment['created_at']) ?></span>
				<a href="<?= Config::get('BASE_URL')."report/".$article['id']."/".$comment['id'] ?>">Signaler</a>
			</div>
		</div>
		<?php
		}
		?>
	</div>
	<?php
	}
	?>
</div>

<?php include 'footer.inc.php'; ?>
