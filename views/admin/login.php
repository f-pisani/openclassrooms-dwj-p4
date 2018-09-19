<?php use Lib\Config; ?>

<div id="login-wrapper">
	<?php include 'msg.inc.php'; ?>

	<form id="form-login" class="form" action="<?= Config::get('BASE_URL').'admin/login' ?>" method="post">
		<h1>Connexion</h1>
		<p>Accès à l'espace d'administration.</p>

		<div class="form-row">
			<label class="label" for="email">E-mail :</label>
			<input class="input" type="email" id="email" name="email" placeholder="martin.dupont@fai.fr" required>
		</div>

		<div class="form-row">
			<label class="label" for="pwd">Mot de passe :</label>
			<input class="input" type="password" id="pwd" name="pwd" required>
		</div>

		<button class="btn" type="submit" value="Se connecter">Se connecter</button>
		<p><a href="<?= Config::get('BASE_URL') ?>">Retour au site</a></p>
	</form>
</div>
