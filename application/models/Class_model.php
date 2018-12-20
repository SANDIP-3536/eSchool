<?php
	class Class_model extends CI_Model
	{
		function class_registration($class_regi)
		{
			$this->db->insert('class',$class_regi);
			return 0;
		}

		function fetch_school_class($employee_school_profile_id)
		{
			return $this->db->where('class_school_profile_id',$employee_school_profile_id)->get('class')->result_array();
		}

		function eval_registration($eval)
		{
			$this->db->insert('evaluation',$eval);
		}

		function fetch_eval($employee_school_profile_id)
		{
			return $this->db->where('eval_school_profile_id',$employee_school_profile_id)->get('evaluation')->result_array();
		}

		function detele_evaluation_details($eval_id)
		{
			$this->db->where('eval_id',$eval_id)->delete('evaluation');
			return 0;
		}
	}
 ?>