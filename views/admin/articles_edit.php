<?php use Lib\Config; ?>
<header id="admin-navbar">
	<div class="brand">
		<a href="<?= Config::get('BASE_URL')."admin" ?>">Administration du blog - <?= $_SESSION['user_email'] ?></a>
	</div>

	<nav class="links">
		<ul>
			<li><a href="<?= Config::get('BASE_URL')."admin/settings" ?>">Mon profil</a></li>
			<li><a href="<?= Config::get('BASE_URL')."admin/articles" ?>">Gestion des articles</a></li>
			<li><a href="<?= Config::get('BASE_URL')."admin/comments" ?>">Gestion des commentaires</a></li>
			<li><a href="<?= Config::get('BASE_URL')."admin/logout" ?>">Déconnexion</a></li>
		</ul>
	</nav>
</header>
<div id="admin-dashboard">
	<h1>Article : Mode éditeur</h1>
	<p>Cet interface vous permet de rédiger vos articles et de les publier.</p>
	<?php
	if(count($success) > 0)
	{
		foreach($success as $title => $msg)
			echo '<div class="admin-success"><b>'.$title.'</b><br>'.$msg.'</div>';
	}

	if(count($errors) > 0)
	{
		foreach($errors as $title => $msg)
			echo '<div class="admin-error"><b>'.$title.'</b><br>'.$msg.'</div>';
	}
	?>
	<div id="admin-articles-editor">
		<?php
		if(isset($article_id) && !empty($article_id) && $article_id !== null)
			echo '<form class="form-editor" action="'. Config::get('BASE_URL') .'admin/articles/edit/'. $article_id .'" method="post">';
		else
 			echo '<form class="form-editor" action="'. Config::get('BASE_URL') .'admin/articles/create" method="post">';
		?>
			<div class="form-row">
				<label for="title">Titre :</label>
				<input type="text" id="title" name="title" value="<?= $article_title ?? '' ?>" placeholder="Le titre de votre article.." required>
			</div>
			<div class="form-row">
				<label for="article">Contenu de l'article :</label>
				<textarea id="article" name="article"><?= $article_content ?? '' ?></textarea>
			</div>
			<div class="form-row">
				<label for="publish">Publier l'article :</label>
				<input type="checkbox" id="publish" name="publish" value="checked" <?= $article_publish ?? '' ?>>
			</div>
			<?php
			if(isset($article_id) && !empty($article_id) && $article_id !== null)
				echo '<button class="btn" type="submit">Mettre à jour</button>';
			else
				echo '<button class="btn" type="submit">Créer l\'article</button>';
			?>
		</form>
	</div>
</div>
<script>tinymce.init({ width: '100%', selector:'#article' });</script>
