<?php
	class DayBook_model extends CI_Model
	{
		function dayBook_registration($table,$data)
		{
			$this->db->insert($table,$data);
			return 0;
		}

		function fetch_acc_group($employee_school_profile_id,$school_AY_id)
		{
			return $this->db->where('acc_grp_school_profile_id',$employee_school_profile_id)->get('acc_group')->result_array();
		}

		function fetch_voc_master($employee_school_profile_id,$school_AY_id)
		{
			return $this->db->where('voc_master_school_profile_id',$employee_school_profile_id)->get('vocher_master')->result_array();
		}

		function fetch_voc_head($employee_school_profile_id,$school_AY_id)
		{
			return $this->db->query("SELECT vocher_head.* FROM vocher_head where voc_head_AY_id =".$school_AY_id." and voc_head_school_profile_id =".$employee_school_profile_id."")->result_array();
		}

		function fetch_cre_vocher($employee_school_profile_id,$school_AY_id)
		{
			return $this->db->query("SELECT create_vocher.* FROM `create_vocher` where cre_vocher_AY_id =".$school_AY_id." and cre_vocher_school_profile_id =".$employee_school_profile_id."")->result_array();
		}
	}
 ?>