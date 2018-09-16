<?php use Lib\Config; ?>

<div id="login-wrapper">
	<?php
		if(count($errors) > 0)
		{
			foreach($errors as $title => $msg)
				echo '<div class="login-error"><b>'.$title.'</b><br>'.$msg.'</div>';
		}
	?>
	<form class="login-form" action="<?= Config::get('BASE_URL').'admin/login' ?>" method="post">
		<h1>Identification</h1>
		<div class="form-row">
			<label for="email">E-mail :</label>
			<input type="email" name="email" id="email" placeholder="Votre email..">
		</div>
		<div class="form-row">
			<label for="pwd">Password :</label>
			<input type="password" name="pwd" id="pwd" placeholder="Votre mot de passe..">
		</div>
		<button type="submit" value="Se connecter">Se connecter</button>
	</form>
</div>
