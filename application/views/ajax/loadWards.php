<option value="0">Select Ward</option>
<?php 
asort($ward);
foreach ($ward as $key => $value){?>
		<option value="<?php echo $key;?>"><?php echo stripslashes($value)?></option>
<?php
}
?>