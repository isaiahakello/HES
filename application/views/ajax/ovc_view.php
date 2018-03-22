<table class="table table-bordered table-striped" >
    <thead>
    <th>OVC Id</th>
    <th>OVC Name</th>
    <th>Gender</th>
    <th>Age</th>
    <th></th>
</thead>
<?php if (!empty($ovcs)) { ?>
    <tbody>
        <?php
        foreach ($ovcs as $key => $value) {
            ?>
            <tr>
                <td>
                    <?php echo $value->ovc_id; ?>
                </td>
                <td>
                    <?php echo $value->first_name.' '.$value->middle_name.' '.$value->surname; ?>
                </td>
                								

                <td>
                    <?php echo $value->gender; ?>
                </td>
                <td>
                    <?php
                    //Diffrence between dates
                    $d1 = (new \DateTime())->format('Y-m-d');
$d2 = (new DateTime($value->dob))->format('Y-m-d');

$diff = $d2->diff($d1);

echo $diff->y;
                     ?>
                </td>

<td><a href="javascript:;">More Details</a></td>
            </tr>
        <?php } ?>
    </tbody>

    </table>
<?php } else { ?>
    <table>
        <tbody>
            <tr>
                <td colspan="7" class="highlight_red">

                    No OVC's Found.
                </td>
            </tr>
        </tbody>
    </table>
<?php } ?>
                                                                  
