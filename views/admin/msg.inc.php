<?php
// Display success message
if(isset($success) && count($success) > 0)
{
	foreach($success as $t => $msg)
		echo '<div class="msg-success"><b>'.$t.'</b><br>'.$msg.'</div>';
}

// Display errors message
if(isset($errors) && count($errors) > 0)
{
	foreach($errors as $t => $msg)
		echo '<div class="msg-error"><b>'.$t.'</b><br>'.$msg.'</div>';
}
?>
