<?php
use Lib\Config;

include 'navbar.inc.php';

// This view is used for creating and editing articles; Dynamically adapt form action and submit button text
$formAction = Config::get('BASE_URL') .'admin/articles/create';
if(isset($article_id) && !empty($article_id) && $article_id !== null)
	$formAction = Config::get('BASE_URL') .'admin/articles/edit/'. $article_id;

$submitText = "Créer l'article";
if(isset($article_id) && !empty($article_id) && $article_id !== null)
	$submitText = "Mettre à jour";
?>

<div id="admin-dashboard">
	<h1>Article : Mode éditeur</h1>
	<p>Cette interface vous permet de rédiger vos articles et de gérer leur état de visiblité.</p>

	<?php include 'msg.inc.php'; ?>

	<div id="admin-articleEditor">
		<a class="link-btn" href="<?= Config::get('BASE_URL').'admin/articles' ?>">Retour aux articles</a><br><br>

		<form id="form-articleEditor" class="form" action="<?= $formAction ?>" method="post">
			<div class="form-row">
				<label class="label" for="title">Titre :</label>
				<input class="input" type="text" id="title" name="title" value="<?= htmlentities($article_title, ENT_HTML5 | ENT_QUOTES ) ?? '' ?>" placeholder="Le titre de votre article.." required>
			</div>

			<div class="form-row">
				<label class="label" for="article">Contenu de l'article :</label>
				<textarea class="input" id="article" name="article"><?= $article_content ?? '' ?></textarea>
			</div>

			<div class="form-row">
				<label class="label" for="publish">Publier l'article :</label>
				<input type="checkbox" id="publish" name="publish" value="checked" <?= $article_publish ?? '' ?>>
			</div>
			<button class="btn" type="submit"><?= $submitText ?></button>
		</form>
	</div>
</div>

<script>
	tinymce.init({ width: '100%', selector:'#article' });
</script>
