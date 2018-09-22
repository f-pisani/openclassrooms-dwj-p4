<?php
use Lib\Config;

include 'navbar.inc.php';
?>

<div id="admin-dashboard">
	<h1>Mon profil</h1>
	<p>Le formulaire ci-dessous vous permet de modifier votre mot de passe ou de changer votre pseudonyme.</p>

	<?php include 'admin/msg.inc.php'; ?>

	<form id="form-settings" class="form" action="<?= Config::get('BASE_URL').'profil' ?>" method="post">
		<div class="form-row">
			<label class="label" for="email">Email :</label>
			<input class="input" type="email" id="email" name="email" value="<?= $_SESSION['user_email'] ?>" disabled>
		</div>

		<div class="form-row">
			<label class="label" for="pwd_current">Mot de passe actuel :</label>
			<input class="input" type="password" id="pwd_current" name="pwd_current" placeholder="Votre mot de passe actuel..">
		</div>

		<div class="form-row">
			<label class="label" for="pwd_new">Nouveau mot de passe :</label>
			<input class="input" type="password" id="pwd_new" name="pwd_new" placeholder="Votre nouveau mot de passe..">
		</div>

		<div class="form-row">
			<label class="label" for="pwd_new_conf">Nouveau mot de passe confirmation :</label>
			<input class="input" type="password" id="pwd_new_conf" name="pwd_new_conf" placeholder="Votre nouveau mot de passe..">
		</div>

		<div class="form-row">
			<label class="label" for="display_name">Nom affiché :</label>
			<input class="input" type="text" id="display_name" name="display_name" value="<?= $_SESSION['user_displayName'] ?>">
		</div>
		<button class="btn" type="submit" value="Modifier">Modifier</button>
	</form>
</div>

<?php include 'footer.inc.php'; ?>
