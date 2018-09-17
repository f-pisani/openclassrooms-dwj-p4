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
	<div id="admin-articles-editor">
		<form class="form-editor" action="<?= Config::get('BASE_URL')."admin/articles/create" ?>" method="post">
			<div class="form-row">
				<label for="title">Titre :</label>
				<input type="text" id="title" name="title" placeholder="Le titre de votre article..">
			</div>
			<div class="form-row">
				<label for="article">Contenu de l'article :</label>
				<textarea id="article" name="article"></textarea>
			</div>
			<div class="form-row">
				<label for="publish">Publier l'article :</label>
				<input type="checkbox" id="publish" name="publish" value="publish">
			</div>
			<button type="submit" value="Créer l'article">Créer l'article</button>
		</form>
	</div>
</div>
