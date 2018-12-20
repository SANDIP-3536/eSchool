<?php 
	
	defined('BASEPATH') or exit('No direct script access allowed');
	class Subject_model extends CI_Model
	{
		function subject_registration($subject_regi)
		{
			// print_r($subject_regi);die();
			return $this->db->insert('subject',$subject_regi);
		}

		function fetch_school_subject($employee_school_profile_id)
		{
			return $this->db->query("SELECT * FROM class join subject on class_id = subject_class_id where subject_expiry_date ='9999-12-31' and subject_school_profile_id = ".$employee_school_profile_id."")->result_array();
		}

		function fetch_school_subject_id($subject_id)
		{
			return $this->db->query("SELECT * FROM class join subject on class_id = subject_class_id join evaluation on subject_eval_id = eval_id where subject_id = ".$subject_id."")->result_array();
		}
	}
 ?>