<?php

class Organization_model extends CI_Model{

    	function __consturct(){
    	   parent::__construct();
    	
    	}
    public function depselect(){
        $query = $this->db->get('department');
        $result = $query->result();
        return $result;
        }
      public function Add_Department($data){
        $this->db->insert('department',$data);
      }

      public function department_delete($dep_id){
        $this->db->delete('department',array('id' => $dep_id ));
      }

      public function department_edit($dep){
          $sql    = "SELECT * FROM `department` WHERE `id`='$dep'";
          $query  = $this->db->query($sql);
          $result = $query->row();
          return $result;
      }
      public function Update_Department($id, $data){
        $this->db->where('id',$id);
        $this->db->update('department',$data);
      }

      public function Add_Designation($data){
        $this->db->insert('designation',$data);
      }
    public function designation_delete($des_id){
        $this->db->delete('designation',array('id'=> $des_id));
    }

      public function designation_edit($des){
          $sql    = "SELECT * FROM `designation` WHERE `id`='$des'";
          $query  = $this->db->query($sql);
          $result = $query->row();
          return $result;
      }
      public function Update_Designation($id, $data){
        $this->db->where('id',$id);
        $this->db->update('designation',$data);
      }
    public function desselect(){
        $query = $this->db->get('designation');
        $result = $query->result();
        return $result;
    }  
	 public function Add_Branch($data){
        $this->db->insert('branch',$data);
      }
    public function branch_delete($bra_id){
        $this->db->delete('branch',array('id'=> $bra_id));
    }

      public function branch_edit($bra){
          $sql    = "SELECT * FROM `branch` WHERE `id`='$bra'";
          $query  = $this->db->query($sql);
          $result = $query->row();
          return $result;
      }
      public function Update_Branch($id, $data){
        $this->db->where('id',$id);
        $this->db->update('branch',$data);
      }
    public function braselect(){
        $query = $this->db->get('branch');
        $result = $query->result();
        return $result;
    }  

	public function Add_Schedule($data){
        $this->db->insert('attendance_schedules',$data);
      }
    public function sched_delete($sched_id){
        $this->db->delete('attendance_schedules',array('id'=> $sched_id));
    }

      public function sched_edit($sched){
          $sql    = "SELECT * FROM `attendance_schedules` WHERE `id`='$sched'";
          $query  = $this->db->query($sql);
          $result = $query->row();
          return $result;
      }
      public function Update_Schedule($id, $data){
        $this->db->where('id',$id);
        $this->db->update('attendance_schedules',$data);
      }
    public function schedselect(){
        $query = $this->db->get('attendance_schedules');
        $result = $query->result();
        return $result;
    }    
		
}
?>