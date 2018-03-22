<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
echo '<table class="table table-striped table-bordered table-hover">';
echo '<thead>';
echo '<th>CBO Name</th>';
echo '<th>County</th>';
echo '<th>Subcounty</th>';
echo '<th>Ward</th>';

echo '</thead>';
foreach($cbos as $key=>$value)
{
  echo '<tr>'; 
  echo '<td>'.$value->cbo_name.'</td>';
  echo '<td>'.$value->county.'</td>';
   echo '<td>'.$value->sub_county.'</td>';
    echo '<td>'.$value->ward.'</td>';
   echo '</tr>'; 
}
echo '</table>';

