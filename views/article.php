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
		<h1 class="title">&nbsp;&nbsp;&nbsp;<?= $article['title'] ?></h1>
		<div class="content"><?= $article['content'] ?></div>
		<div class="footer">
			<span class="author">Par <b><?= $article['user_displayName'] ?></b> publié le <?= date('d/m/Y \à H:i', $article['created_at']) ?></span>
		</div>
	</div>
	<div id="comments">
		<h1 class="title">&nbsp;&nbsp;&nbsp;Commentaire(s)</h1>
		<p><?= count($article['comments']) ?> commentaire(s) pour cet article. Laissez nous votre ressenti !</p>
		<!--
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
		-->
		<?php
		foreach($article['comments'] as $comment)
		{
		?>
		<div class="comment">
			<span class="author">Par <b><?= $comment['nickname'] ?></b> le <?= date('d/m/Y à H:i:s', $comment['created_at']) ?></span>
			<div class="content"><?= $comment['content'] ?></div>
			<div class="footer">
				<a href="<?= Config::get('BASE_URL')."report/".$article['id']."/".$comment['id'] ?>"><i class="fas fa-exclamation-triangle"></i> Signaler</a>
			</div>
		</div>
		<?php
		}
		?>
		<a id="showMoreComments" class="link-btn" href="javascript:void(0)" onClick="showMoreComments()">Voir plus de commentaires...</a>
	</div>
	<?php
	}
	?>
</div>

<script>
	var showMoreComments_offset = 5; // Number of comments to show
	var currentComments_displayed = showMoreComments_offset;

	function showMoreComments()
	{
		currentComments_displayed += showMoreComments_offset;

		$("#comments .comment").each(function(i, item){
			if(i+1 <= currentComments_displayed)
			{
				$("#comments .comment:nth-of-type("+(i+1)+")").slideDown(500).css('display', 'block');
			}
		});

		$('html, body').animate({
			 scrollTop: $("#comments .comment:nth-of-type("+currentComments_displayed+")").offset().top
		 }, 500);

		if(currentComments_displayed == $("#comments .comment").length)
			$("a#showMoreComments").hide(500).css('display', 'none');
	}

	//
	$(window).bind("mousewheel", function() {
		$("html, body").stop(true, false);
	});

	$(document).ready(function(){
		$("#comments .comment").each(function(i, item){
			if(i+1 > currentComments_displayed)
			{
				$("#comments .comment:nth-of-type("+(i+1)+")").hide(500).css('display', 'none');
			}
		});

		if($("#comments .comment").length == 0)
			$("a#showMoreComments").hide(500).css('display', 'none');
	});
</script>
<?php include 'footer.inc.php'; ?>
