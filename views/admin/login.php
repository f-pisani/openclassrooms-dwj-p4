<?php use Lib\Config; ?>

<div id="login-wrapper">
	<form class="login-form" action="<?= Config::get('BASE_URL').'admin/login' ?>" method="post">
		<h1>Identification</h1>
		<div class="form-row">
			<label for="login">Utilisateur :</label>
			<input type="text" name="login" id="login" placeholder="Votre identifiant..">
		</div>
		<div class="form-row">
			<label for="pwd">Password :</label>
			<input type="password" name="pwd" id="pwd" placeholder="Votre mot de passe..">
		</div>
		<button type="submit" value="Se connecter">Se connecter</button>
	</form>
</div>
