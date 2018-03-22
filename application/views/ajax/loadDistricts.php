<option value="0">Select District</option>
<?php 
asort($districts);
foreach ($districts as $key => $value){?>
		<option value="<?php echo $key?>"><?php echo stripslashes($value)?></option>
<?php
}
?>