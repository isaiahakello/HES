<?php if (! defined('BASEPATH')) exit('No direct script access allowed');
// in this Model all database related method v.1.2
class TableData extends CI_Model{
	//simple select 
	public function selectRecords($fields,$tableName,$condition,$orderField='id',$orderType='desc'){
		return $this->db->select($fields)->where($condition)->order_by($orderField,$orderType)->get($tableName)->result();
	}
        public function selectRecordsXX($fields,$tableName,$condition,$orderField='date_added',$orderType='desc'){
		return $this->db->select($fields)->where($condition)->order_by($orderField,$orderType)->get($tableName)->result();
	}
        public function selectRecordsX($fields,$tableName,$condition,$orderField='uacc_id',$orderType='desc'){
		return $this->db->select($fields)->where($condition)->order_by($orderField,$orderType)->get($tableName)->result();
	}
	public function selectRecordsR($fields,$tableName,$condition,$orderField='id',$orderType='desc'){
	 $DB2 = $this->load->database('sdp', TRUE);
	 $this->db=$DB2;
		return $this->db->select($fields)->where($condition)->order_by($orderField,$orderType)->get($tableName)->result();
	}
	//select record with pagnination
	public function selectPageRecords($fields,$tableName,$condition,$num,$offset,$orderField='id',$orderType='desc'){
		return $this->db->select($fields)->where($condition)->order_by($orderField,$orderType)->get($tableName,$num,$offset)->result();
	}
	public function selectPageRecordsR($fields,$tableName,$condition,$num,$offset,$orderField='id',$orderType='desc'){
		$DB2 = $this->load->database('sdp', TRUE);
		 $this->db=$DB2;
		return $this->db->select($fields)->where($condition)->order_by($orderField,$orderType)->get($tableName,$num,$offset)->result();
	}
	//select with where_in
	public function selectCutomWhereInPage($fields,$tableName,$customCondition,$num,$offset){
		return $this->db->select($fields)->where("istandard_id in($customCondition) and vstatus='enable'",NULL,FALSE)->get($tableName,$num,$offset)->result();
	}
	//select with group by 
	public function selectGroupPageRecord($fields,$tableName,$condition,$groupBy,$num,$offset){
		return $this->db->select($fields)->where($condition)->group_by($groupBy)->get($tableName,$num,$offset)->result();
	}
	//where not 
	public function selectWhereNotIn($tableName,$fi){
		return $this->db->select($fields)->where_not_in("istandard_id",$condition)->get($tableName)->result();
	}
	//count table records
	public function countTableRecords($tableName,$condition=array()){
		$query =$this->db->where($condition)->get($tableName);
		return $query->num_rows();
	}
	//count table records2
	public function countTableRecordsR($tableName,$condition=array()){
	    $DB2 = $this->load->database('sdp', TRUE); 
		 $this->db=$DB2;
		$query =$this->db->where($condition)->get($tableName);
		return $query->num_rows();
	}
	//count table recore with custom where
	public function countTableRecordsWhere($tableName,$condition){
		$query =$this->db->where("istandard_id in($condition) and vstatus='enable'",NULL,FALSE)->get($tableName);
		return $query->num_rows();
	}
	//insert data into database
	public function insertTableData($collection,$tableName){
		$this->db->insert_batch($tableName, $collection); 
		return $this->db->insert_id();
	}
	//update table
	public function updateRecord($collection,$tableName,$condition){
		return $this->db->update($tableName, $collection,$condition);
	}
	//Fix Delete:
	public function fixDelete($tableName,$condition){
		 return $this->db->delete($tableName,$condition);
	}
	//delete or update database
	public function deleteRecord($collection,$tableName,$condition){
		return $this->db->update($tableName, $collection,$condition);
	}
	// delete record
	public function MultipleDeleterecord($tableName,$attribute,$inarray){
		$this->db->where_in($attribute,$inarray);
		$this->db->delete($tableName); 
	} 
	//delete multiple records
	public function deleteCheckedRecord($collection,$tableName,$condition){
		$field = array_keys($collection);
		$values = array_values($collection);
		$query = "UPDATE $tableName SET $field[0] ='$values[0]' where id in ($condition)";
		return $this->db->query($query);
	}
	public function deleteCheckedRecordByattribute($collection,$tableName,$condition,$tbfield){
		$field = array_keys($collection);
		$values = array_values($collection);
		$query = "UPDATE $tableName SET $field[0] ='$values[0]' where $tbfield in ($condition)";
		return $this->db->query($query);
	}
	//simple join
	public function singleJoin($masterTable,$parentTable,$select,$condition){
		$this->db->select($select);
		$this->db->from($masterTable);
		$this->db->join($parentTable,$condition);
		return $this->db->get()->result();
	}
	// mulitple joins with multiple where condition and multiple like condition 
	public function multijoins($fields,$from,$joins=array(),$where,$likes=NULL,$ordersby='',$num='',$offset=NULL,$action='',$wheretype='where',$groupby=''){
		$this->db->select($fields);
	//	$this->db->from($from);
		if($wheretype == 'where')
		{
		$this->db->where($where); 
		}
		
		if($wheretype == 'where_in')
		{
		 $field =  implode(",",(array_keys($where)));
		  $this->db->where_in(''.$field.'', $where['p.products_id']); 
		}
		if($groupby != '')
		{
		 $this->db->group_by($groupby);	
		}
		 
		foreach($joins as $key => $value)
		{
			$this->db->join($key, $value[0], $value[1]);
		}
		if($likes != NULL){
			foreach($likes as $field =>$like){
				  $this->db->like($field, $like[0],$like[1]);
			   }
		   }
		 if($ordersby != '')
		{
			$this->db->order_by(''.$ordersby.'');
		} 
		if($action == 'count')
		{
		     return	$this->db->get($from,$num,$offset)->num_rows();
		}
		else
		{
			 return $this->db->get($from,$num,$offset)->result();
		} 
		
	}
	//check duplicate
	public function checkDuplicate($tableName,$condition){
		$query = $this->db->get_where($tableName,$condition);	
		if($query->num_rows()>=1){
			return true;
		}else{
			return false;
		}
	}
	//get single record value
	public function getSingleRecord($tableName,$condition,$returnField){
		$res = $this->db->select($returnField)->where($condition)->get($tableName)->result();
		return stripslashes($res[0]->$returnField);
	}
	//sum of indivisual column
	public function sumValue($tableName,$condition,$sumbField){
		$res=$this->db->select_sum($sumbField)->where($condition)->get($tableName)->result();
		
		return stripslashes($res[0]->$sumbField);
	}
	//sum with group by
	public function submValueWithGroup($tableName,$condition,$sumbField,$groupBy){
		return $this->db->select_sum($sumbField)->where($condition)->group_by($groupBy)->get($tableName)->result();
	}
	//Get max order number Function:
	public function getMaxOrderNo($fields,$condition,$tableName){
		$res= $this->db->select_max($fields)->where($condition)->get($tableName)->result();
		return $res[0]->$fields;
	}
	//Get Data in liver serach
	public function getLivesearch($tableName,$title,$match,$option,$excond){
	   $this->db->select('*');
       $this->db->from($tableName);
	   $this->db->where($excond);
	   $this->db->like($title, $match,$option);
	   $this->db->limit(15);
	   return $this->db->get()->result();
	 }
}
?>