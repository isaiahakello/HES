<?php if (!empty($households)) { ?>
    <div class="table-toolbar">
        
           <div class="row">
                                                    <div class="col-md-6">
                                                        <h3>Caregiver Name
                                                          <span class="label label-danger"><?php echo $this->tabledata->getSingleRecord('caregivers',array('id'=>$household),'first_name').' '
                            . ' '.$this->tabledata->getSingleRecord('caregivers',array('id'=>$household),'middle_name').''
                            . ' '.$this->tabledata->getSingleRecord('caregivers',array('id'=>$household),'surname');
                            
                       
                            ?></span>
                                                        </h3></div>
                                                    <div class="col-md-6"><h3>ID Number
                                                               <span class="label label-danger"><?php echo $this->tabledata->getSingleRecord('caregivers',array('id'=>$household),'national_id') ?> </span>
                
                                                        </h3></div> 
                                                   
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-6"><h3>GRI Score
                                                           <span class="label label-danger"> <?php echo $this->tabledata->sumValue('gri_scoring_meta',array('household_id'=>$household),'score');?> /180</span>
                
                                                        
                                                        </h3></div> 
                                                    <div class="col-md-6"><h3>GRI Outcome
                                                            <span class="label label-danger"></span>
                                                        </h3></div>  
                                                </div>
    </div>
    <div class="portlet-body util-btn-margin-bottom-5 ">
        <table class="table table-striped table-bordered table-hover">
            <thead>
                <tr>
                    <th></th>
                    <th>Criteria</th>
                    <th>Indicator</th>
                    <th>Max Score</th>
                    <th>Option Selected</th>                                            
                    <th>Score</th>
                    <th>Percentage Score</th>
                </tr>
            </thead>

            <tbody>
                <?php
                $i=1;
                foreach ($households as $key => $value) {
                    $percentage = (($value->score) / ($value->max_score) * 100);
                    echo '<tr>';
                    echo '<td>'.$i.'</td>';
                    echo '<td>' . $value->indicator_title . '</td>';
                    echo '<td>' . $value->indicator_desc . '</td>';
                    echo '<td>' . $value->max_score . '</td>';
                    echo '<td>' . $value->option_name . '</td>';
                    echo '<td>' . $value->score . '</td>';
                    echo '<td>' . $percentage .'%'. '</td>';
                    echo '</tr>';
                    $i++;
                }
                ?>                      
            </tbody>
        </table>
    </div>
    <?php
} else {
    ?>

    <span class="bg-warning"> <h2>No household Found.</h2></span>

    <
<?php } ?>