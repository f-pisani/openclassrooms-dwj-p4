<?php
use Lib\Config;

include 'navbar.inc.php';
?>

<div id="blog">
	<h1>Connexion</h1>
	<p>Si vous n'avez pas encore de compte, vous pouvez <a href="<?= Config::get('BASE_URL').'register' ?>">en créer un ici !</a></p>

	<?php include 'admin/msg.inc.php'; ?>

	<form id="form-login" class="form" action="<?= Config::get('BASE_URL').'login' ?>" method="post">
		<div class="form-row">
			<label class="label" for="email">Email :</label>
			<input class="input" type="email" id="email" name="email" placeholder="martin.dupont@gmail.com" required>
		</div>

		<div class="form-row">
			<label class="label" for="pwd">Mot de passe :</label>
			<input class="input" type="password" id="pwd" name="pwd" required>
		</div>

		<button class="btn" type="submit" name="login" value="true">Se connecter</button>
	</form>
</div>

<?php include 'footer.inc.php'; ?>
