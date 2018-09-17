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
	<h1>Mon profil</h1>
	<p>Le formulaire ci-dessous vous permet de modifier votre mot de passe ou de changer le nom d'auteur des articles
	que vous avez écrits.</p>
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
	<form class="settings-form" action="<?= Config::get('BASE_URL')."admin/settings" ?>" method="post">
		<div class="form-row">
			<label for="email">Email :</label>
			<input type="email" id="email" name="email" value="<?= $_SESSION['user_email'] ?>" disabled>
		</div>
		<div class="form-row">
			<label for="pwd_current">Mot de passe actuel :</label>
			<input type="password" id="pwd_current" name="pwd_current" placeholder="Votre mot de passe actuel..">
		</div>
		<div class="form-row">
			<label for="pwd_new">Nouveau mot de passe :</label>
			<input type="password" id="pwd_new" name="pwd_new" placeholder="Votre nouveau mot de passe..">
		</div>
		<div class="form-row">
			<label for="pwd_new_conf">Nouveau mot de passe confirmation :</label>
			<input type="password" id="pwd_new_conf" name="pwd_new_conf" placeholder="Votre nouveau mot de passe..">
		</div>
		<div class="form-row">
			<label for="display_name">Nom affiché :</label>
			<input type="text" id="display_name" name="display_name" value="<?= $_SESSION['user_displayName'] ?>">
		</div>
		<button type="submit" value="Modifier">Modifier</button>
	</form>
</div>
