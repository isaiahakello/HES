<table class="table table-">
    <thead>
       <th></th> 
       <th>Outcome</th> 
       <th>Date Added</th> 
      
    </thead>
    <tbody>
<?php
$i=1;
foreach($outcomes as $key=>$value)
{
    echo '<tr>';
 echo '<td>'.$i.'</td>';
 echo '<td>'.$value->outcome.'</td>';
 echo '<td>'.$value->date_added.'</td>';
 echo '</tr>';
 $i++;
}
?>
        </tbody>
</table> 