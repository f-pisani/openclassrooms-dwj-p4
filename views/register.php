<?php
use Lib\Config;

include 'navbar.inc.php';
?>

<div id="blog">
	<h1>Inscription</h1>
	<p>Rejoignez la communauté ! L'inscription vous permet de laisser des commentaires sur le site.</p>

	<?php include 'admin/msg.inc.php'; ?>

	<form id="form-register" class="form" action="<?= Config::get('BASE_URL')."register" ?>" method="post">
		<div class="form-row">
			<label class="label" for="email">Votre email :</label>
			<input type="email" class="input" id="email" name="email" placeholder="martin.dupont@gmail.com"
			value="<?= $data['email'] ?? '' ?>" required>
		</div>

		<div class="form-row">
			<label class="label" for="nickname">Votre pseudonyme :</label>
			<input type="text" class="input" id="nickname" name="nickname" placeholder="Le pseudo qui sera affiché.."
			value="<?= $data['nickname'] ?? '' ?>" required>
		</div>

		<div class="form-row">
			<label class="label" for="pwd">Votre mot de passe :</label>
			<input type="password" class="input" id="pwd" name="pwd" required>
		</div>

		<div class="form-row">
			<label class="label" for="pwd_conf">Confirmez votre mot de passe :</label>
			<input type="password" class="input" id="pwd_conf" name="pwd_conf" required>
		</div>

		<button class="btn" name="register" value="true">Je m'inscris !</button>
	</form>
</div>

<?php include 'footer.inc.php'; ?>
