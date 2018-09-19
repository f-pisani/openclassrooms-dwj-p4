<?php
// Display success message
if(isset($success) && count($success) > 0)
{
	foreach($success as $title => $msg)
		echo '<div class="msg-success"><b>'.$title.'</b><br>'.$msg.'</div>';
}

// Display errors message
if(isset($errors) && count($errors) > 0)
{
	foreach($errors as $title => $msg)
		echo '<div class="msg-error"><b>'.$title.'</b><br>'.$msg.'</div>';
}
?>
