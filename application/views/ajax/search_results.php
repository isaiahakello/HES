<table class="table table-bordered table-striped table-condensed">
    <thead class="bg-blue">
        <tr>

            <th>
                <a href="javascript:;">Caregiver Name</a>
            </th>
            <th>
                <a href="javascript:;">Household Level</a>
            </th>
            <th>
                <a href="javascript:;">Interventions</a>
            </th>
            <th>
                <a href="javascript:;">Action</a>
            </th>
        </tr>
    </thead>
    <?php if (!empty($households)) { ?>
        <tbody>
            <?php
            foreach ($households as $key => $value)
                {
                ?>
                <tr>

                    <td class="table-title font-blue">
                        <a href="javascript:;"><?php echo $value->first_name . ' ' . $value->middle_name . ' ' . $value->surname; ?></a>
                        <p>National ID:
                            <a href="javascript:;"><?php echo $value->national_id; ?></a>

                        </p>
                        <p>HIV Status:
                            <a href="javascript:;"><?php echo $value->hiv_status; ?></a>

                        </p>
                        <p>No of OVCs:
                            <a href="javascript:;"><?php echo $this->db->query("SELECT * FROM ovc_table WHERE caregiver_id='".$value->id."'")->num_rows(); ?></a>
                        </p>
                    </td>
                    <td class="table-status midtext">
        <?php if ($value->category == 1) { ?>
                            <h4 class="font-red">
                                Highly Vulnerable
                            </h4>
        <?php } elseif ($value->category == 2) { ?>
                            <h4 class="font-green">
                                Moderately Vulnerable
                            </h4>
        <?php } elseif ($value->category == 3) { ?>
                            <h4 class="font-orange">
                                Least Vulnerable
                            </h4>
        <?php } elseif (empty($value->category)) { ?>
                            <h4 class="font-red font-dark">
                                Uncategorized
                            </h4>

        <?php } ?>
                    </td>
                    <td class="table-desc">
                        <ul class="list-group-item-info  list-unstyled">
        <?php
        $activities = $this->db->query("SELECT * FROM interventions_table WHERE level_id='" . $value->category . "'")->result();
        foreach ($activities as $k => $v) {
            
           $id=$this->db->query("SELECT * FROM household_interventions WHERE caregiver_id='" . $value->id . "' AND intervention_id='".$v->id."'")->row()->intervention_id; 
           
           ?>
<li><input type="checkbox" name="activity"  value="<?php echo $v->id;?>"  <?php echo ($id== $v->id)?'checked':'' ?> /><span class="span4"></span><?php echo $v->activity; ?></li>

        <?php }//} ?>
                        </ul>
                    </td>
                    <td class="midtext">
                        <input type="hidden" name="caregiver" id="caregiver" value="<?php echo $value->id;?>">
                        <button class="btn btn-danger btn-lg" type="button" onclick="save_activity()">Save Interventions</button>
                        <span id="response"></span>
                        <span id="loading"></span>
                    </td>
                </tr>
    <?php } ?>      
        </tbody>
    </table>
        <?php } else { ?>
    <table>
        <tbody>
            <tr>
                <td colspan="7" class="highlight_red">
                    No household Found.
                </td>
            </tr>
        </tbody>
    </table>
<?php } ?>