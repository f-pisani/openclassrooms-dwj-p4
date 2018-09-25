<?php
use Lib\Config;
use Models\User;

include 'navbar.inc.php';
?>

<div id="admin-dashboard">
	<h1>Gestion des utilisateurs</h1>
	<p>Cette espace permet la gestion des utilisateurs. Vous pouvez gérer les permissions de modération.</p>

	<div id="admin-comments">
	<?php
	if(count($users_list) == 0)
	{
	?>
		<div class="msg-error"><b>Aucun utilisateur !</b><br>Le site ne contient aucun utilisateur qui ne soit pas un administrateur.</div>
	<?php
	}
	else
	{
	?>
	<table id="table-users" class="table">
		<tr>
			<th class="table-col-id">#</th>
			<th class="table-col-email">Email</th>
			<th class="table-col-role">Role</th>
			<th class="table-col-commentsCount">Nombre de commentaires</th>
			<th class="table-col-reportsCount">Nombre de commentaires signalés</th>
			<th class="table-col-createdAt">Date de création</th>
			<th class="table-col-updatedAt">Mis à jour</th>
			<th class="table-col-action">Gestion des droits</th>
		</tr>
		<?php
		foreach($users_list as $user)
		{
		?>
		<tr id="user-<?= $user['id'] ?>">
			<td><?= $user['id'] ?></td>
			<td><?= $user['email'] ?></td>
			<td><?= strtoupper($user['role']) ?></td>
			<td><?= $user['comments_count'] ?></td>
			<td><?= $user['reports_count'] ?></td>
			<td><?= date('d/m/Y H:i:s', $user['created_at']) ?></td>
			<td><?= date('d/m/Y H:i:s', $user['updated_at']) ?></td>
			<td>
			<?php
			if($user['role'] == 'user')
			{
			?>
				<a class="link-btn" href="<?= Config::get('BASE_URL').'admin/users/promote/'.$user['id'] ?>">Promouvoir modérateur</a>
			<?php
			}
			else
			{
			?>
				<a class="link-btn" href="<?= Config::get('BASE_URL').'admin/users/demote/'.$user['id'] ?>">Rétrograder utilisateur</a>
			<?php
			}
			?>
			</td>
		</tr>
		<?php
		}
		?>
	</table>
	<?php
	}
	?>
	</div>
</div>
