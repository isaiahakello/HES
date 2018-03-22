<option value="0">Select CBO</option>
<?php 
asort($cbos);
foreach ($cbos as $key => $value){?>
		<option value="<?php echo $value?>"><?php echo stripslashes($value)?></option>
<?php
}
?>