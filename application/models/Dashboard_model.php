<?php

	class Dashboard_model extends CI_Model{

	function __consturct(){
	parent::__construct();
	
	}
    public function insert_tododata($data){
        $this->db->insert('to-do_list',$data);
    }
    public function GettodoInfo($userid){
        $sql = "SELECT * FROM `to-do_list` WHERE `user_id`='$userid' ORDER BY `date` DESC";
        $query=$this->db->query($sql);
        $result = $query->result();
        return $result;
    }
    public function GetRunningProject(){
        $sql = "SELECT * FROM `project` WHERE `pro_status`='running' ORDER BY `id` DESC";
        $query=$this->db->query($sql);
        $result = $query->result();
        return $result;
    }
    public function GetHolidayInfo(){
        $sql = "SELECT * FROM `holiday` ORDER BY `id` DESC LIMIT 10";
        $query=$this->db->query($sql);
        $result = $query->result();
        return $result;
    }
	public function UpdateTododata($id,$data){
		$this->db->where('id', $id);
		$this->db->update('to-do_list',$data);		
	}
	
	public function getAllLateAttendance()
	{
		$sql = "SELECT * FROM attendance WHERE logstatus = 0 and DATE(atten_date) = CURDATE()  ";
		$query= $this->db->query($sql);
		$result = $query->num_rows();
		
		return $result;
	}
	
	public function getAllOntimeAttendance()
	{
		$sql = "SELECT * FROM attendance WHERE logstatus = 1 and DATE(atten_date) = CURDATE()  ";
		$query= $this->db->query($sql);
		$result = $query->num_rows();
		
		return $result;
	}
	
	public function getOverallAttendance()
	{
		$sql = "SELECT * FROM attendance WHERE DATE(atten_date) = CURDATE()  ";
		$query= $this->db->query($sql);
		$result = $query->num_rows();
		
		return $result;
		
	}
	
	public function getAllAttendances(){
		$sql = "SELECT Count(id) as count, MONTHNAME(atten_date) as month, logstatus FROM attendance GROUP BY MONTH(atten_date),logstatus ";
		$query= $this->db->query($sql);
		$result['months'] = $query->result();
		
		return $result;
		
	}	
  }
?>