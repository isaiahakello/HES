<table class="table table-hover">
    <thead>
       <th></th> 
       <th>Intermediary Outcome</th> 
       <th>Date Added</th> 
      
    </thead>
    <tbody>
<?php
$i=1;
foreach($intermediary as $key=>$value)
{
    echo '<tr>';
 echo '<td>'.$i.'</td>';
 echo '<td>'.$value->intermediary_outcome.'</td>';
 echo '<td>'.$value->date_added.'</td>';
 echo '</tr>';
 $i++;
}
?>
        </tbody>
</table>