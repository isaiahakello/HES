<?php 
if (!empty($households)) 
    {
    $rowid= $households[0]->id;
    $firstname= $households[0]->first_name;
    $middlename= $households[0]->middle_name;
    $surname= $households[0]->surname;
    $national_id= $households[0]->national_id;
    $cbo= $households[0]->cbo;
?>
 <div class="form-group">
            <label class="control-label col-md-3">Caregiver Name
                <span class="required" aria-required="true"> * </span>
            </label>
            <div class="col-md-4">
                <input type="text" class="form-control" name="caregiver" value="<?php echo $firstname. ' '.$middlename.' '.$surname; ?>">

            </div>
        </div>
        <div class="form-group">
            <label class="control-label col-md-3">ID Number
                <span class="required" aria-required="true"> * </span>
            </label>
            <div class="col-md-4">
                <input type="text" class="form-control" name="id_num" value="<?php echo $national_id; ?>">
                <input type="hidden" class="form-control" name="rowid" value="<?php echo $rowid; ?>">
            </div>
        </div>
        <div class="form-group">
            <label class="control-label col-md-3">
                <span class="required" aria-required="true">No.Of OVC's</span>
            </label>
            <div class="col-md-4">
                <input type="text" class="form-control" name="ovc" value="<?php echo $this->db->query("SELECT * FROM ovc_table WHERE caregiver_id='".$value->id."'")->num_rows();?>">

            </div>
        </div>
<div class="form-group">
            <label class="control-label col-md-3">
                <span class="required" aria-required="true">CBO</span>
            </label>
            <div class="col-md-4">
                <input type="text" class="form-control" name="cbo" value="<?php echo $cbo;?>">

            </div>
        </div>
        <div class="form-group">
            <label class="control-label col-md-3">
                <span class="required" aria-required="true">HVA Ranking</span>
            </label>
            <div class="col-md-4">
            <table class="table">
            
                
                <?php
              $hva=$this->tabledata->selectRecords(array(),'household_vulnerability_levels',array('caregiver_id'=>$rowid)); 
               foreach($hva as $key=>$value)
                {
                 if($value->level_id==0)
                 {
                  $level='Uncategorized';   
                 }
                 elseif($value->level_id==1)
                 {
                  $level='Highly Vulnerable';   
                 }
                  elseif($value->level_id==2)
                 {
                  $level='Moderately Vulnerable';   
                 }
                  elseif($value->level_id==3)
                 {
                  $level='Least Vulnerable';   
                 }
                 echo '<tr><td>'.$value->hva.'</td>'; 
                 echo  '<td>'.$level.'</td></tr>' ; 
                }
                ?>
                
            
            </table>
        </div>
        </div>
 <?php   
} else {
    ?>
    <span>
        Household Not Found
    </span>
 <?php

}
?>