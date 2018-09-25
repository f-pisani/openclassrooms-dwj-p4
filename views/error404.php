<?php
use Lib\Config;

include 'navbar.inc.php';
?>

<div id="error404">
	<h1>404 No Found</h1>

	<p>La ressource n'existe pas.</p>
	<br><br>
	<a class="link-btn" href="<?= Config::get('BASE_URL') ?>">Retour au site</a>
</div>

<?php include 'footer.inc.php'; ?>
