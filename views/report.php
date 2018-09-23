<?php
use Lib\Config;

include 'navbar.inc.php';
?>

<div id="blog">
	<div id="comments">
		<h1>Signaler un commentaire</h1>

		<?php include('admin/msg.inc.php'); ?>

		<form id="form-comment" class="form" action=""="<?= Config::get('BASE_URL')."report/".$comment['post_id']."/".$comment['id'] ?>" method="post">
			<div class="comment">
				<span class="author">Par <b><?= $comment['nickname'] ?></b> le <?= date('d/m/Y à H:i:s', $comment['created_at']) ?></span>
				<div class="content"><?= $comment['content'] ?></div>
			</div>
			<button class="btn" name="confirm" value="true">Confirmer le signalement</button>
		</form>
		<br><br>
		<a class="link-btn" href="<?= Config::get('BASE_URL')."articles/".$comment['post_id'] ?>#comments">Retour à l'article</a>
	</div>
</div>

<?php include 'footer.inc.php'; ?>
