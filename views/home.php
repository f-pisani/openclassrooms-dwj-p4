<?php
use Lib\Config;

include 'navbar.inc.php';
?>

<div id="blog">
	<h1>Liste des chapitres</h1>
	<div id="articles-list">
	<?php
	foreach($list_articles as $article)
	{
	?>
	<div class="articles-list-item">
		<h2 class="title">&nbsp;&nbsp;&nbsp;<a href="<?= Config::get('BASE_URL').'articles/'.$article['id'] ?>"><i class="fas fa-bookmark"></i> <?= $article['title'] ?></a></h2>
		<div class="excerp"><?= substr(strip_tags($article['content']), 0, 512) ?>..</div>
		<div class="footer">
			<span class="author">Par <b><?= $article['user_displayName'] ?></b> publié le <?= date('d/m/Y \à H:i', $article['created_at']) ?></span>
			<span class="comments"><?= count($article['comments']) ?> commentaire(s)</span>
		</div>
	</div>
	<?php
	}
	?>
	</div>
</div>

<?php include 'footer.inc.php'; ?>
