<table class="table table-hover">
    <thead>
       <th></th> 
       <th>Output</th> 
       <th>Date Added</th> 
      
    </thead>
    <tbody>
<?php
$i=1;
foreach($outputs as $key=>$value)
{
    echo '<tr>';
 echo '<td>'.$i.'</td>';
 echo '<td>'.$value->output.'</td>';
 echo '<td>'.$value->date_added.'</td>';
 echo '</tr>';
 $i++;
}
?>
        </tbody>
</table>