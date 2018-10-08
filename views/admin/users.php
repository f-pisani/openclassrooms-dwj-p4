<?php
use Lib\Config;
use Models\User;

include 'navbar.inc.php';
?>

<div id="admin-dashboard">
	<h1>Gestion des utilisateurs</h1>
	<p>Cette espace permet la gestion des utilisateurs. Vous pouvez gérer les permissions de modération.</p>

	<div id="admin-users">
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
		<thead>
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
		</thead>
		<tbody>
			<?php
			foreach($users_list as $user)
			{
			?>

			<tr id="user-<?= $user['id'] ?>">
				<td data-colname="#"><?= $user['id'] ?></td>
				<td data-colname="Email"><?= $user['email'] ?></td>
				<td data-colname="Role"><?= strtoupper($user['role']) ?></td>
				<td data-colname="Commentaires"><?= $user['comments_count'] ?></td>
				<td data-colname="Signalements"><?= $user['reports_count'] ?></td>
				<td data-colname="Date de création"><?= date('d/m/Y H:i:s', $user['created_at']) ?></td>
				<td data-colname="Mis à jour"><?= date('d/m/Y H:i:s', $user['updated_at']) ?></td>
				<td data-colname="Gestion des droits">
				<?php
				if($user['role'] == 'user')
					echo "<a class=\"link-btn\" href=\"". Config::get('BASE_URL').'admin/users/promote/'.$user['id'] ."\">Promouvoir modérateur</a>";
				else
					echo "<a class=\"link-btn\" href=\"". Config::get('BASE_URL').'admin/users/demote/'.$user['id'] ."\">Rétrograder utilisateur</a>";
				?>
				</td>
			</tr>

			<?php
			}
			?>
		</tbody>
	</table>
	<?php
	}
	?>
	</div>
</div>
