<option value="0">Select Constituency</option>
<?php 
asort($constituency);
foreach ($constituency as $key => $value){?>
		<option value="<?php echo $key?>"><?php echo stripslashes($value)?></option>
<?php
}
?>