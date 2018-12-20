<?php 
	/**
	* 
	*/
	class Notification_model extends CI_Model
	{
		function fetch_class($employee_school_profile_id)
		{
			return $this->db->where('class_school_profile_id',$employee_school_profile_id)->where('class_expiry_date','9999-12-31')->get('class')->result_array();
		}

		function fetch_division($employee_school_profile_id)
		{
			return $this->db->where('division_school_profile_id',$employee_school_profile_id)->where('division_expiry_date','9999-12-31')->get('division')->result_array();
		}

		function fetch_division_acc_class($student)
		{
			return $this->db->from('division')->join('class','division_class_id = class_id')->where('division_school_profile_id',$student['employee_school_profile_id'])->where('division_class_id',$student['class_id'])->where('division_expiry_date','9999-12-31')->get()->result_array();
		}

		function fetch_student_acor_class($student)
		{
			return $this->db->query('SELECT * FROM student join student_class_division_assgn on student_profile_id = SCD_student_profile_id JOIN class on class_id = SCD_class_id join division on division_id = SCD_division_id where SCD_school_profile_id='.$student['employee_school_profile_id'].' AND SCD_class_id='.$student['class_id'].' AND SCD_expiry_date="9999-12-31" and SCD_AY_id ='.$student['AY_id'].'')->result_array();
		}

		function fetch_student_acor_division($student)
		{
			return $this->db->query('SELECT * FROM student join student_class_division_assgn on student_profile_id = SCD_student_profile_id JOIN class on class_id = SCD_class_id join division on division_id = SCD_division_id where SCD_school_profile_id='.$student['employee_school_profile_id'].' AND SCD_division_id='.$student['division_id'].' AND SCD_expiry_date="9999-12-31" and SCD_AY_id ='.$student['AY_id'].'')->result_array();
		}

		function fetch_student_acor_class_division($student)
		{
			return $this->db->query('SELECT * FROM student join student_class_division_assgn on student_profile_id = SCD_student_profile_id JOIN class on class_id = SCD_class_id join division on division_id = SCD_division_id where SCD_school_profile_id='.$student['employee_school_profile_id'].' AND SCD_class_id='.$student['class_id'].' AND SCD_division_id='.$student['division_id'].' AND SCD_expiry_date="9999-12-31" and SCD_AY_id ='.$student['AY_id'].'')->result_array();
		}
		function fetch_student_acor_school($student)
		{
			return $this->db->query('SELECT * FROM student join student_class_division_assgn on student_profile_id = SCD_student_profile_id JOIN class on class_id = SCD_class_id join division on division_id = SCD_division_id where SCD_school_profile_id='.$student['employee_school_profile_id'].' AND SCD_expiry_date="9999-12-31" and SCD_AY_id ='.$student['AY_id'].'')->result_array();
		}

		function parent_notification($Notification)
		{
			$this->db->insert('notification',$Notification);
		}

		function fetch_notification($employee_school_profile_id)
		{
			return $this->db->query("SELECT 
										notifi_type
									    ,date_format(notifi_datetime,'%d-%m-%Y') as date
									    ,date_format(notifi_datetime,'%H:%i') as time
									    ,notifi_title
									    ,notifi_msg
									    ,count(*) as notification_count 
									FROM notification 
									where 
										notifi_school_profile_id =".$employee_school_profile_id."
									group by 1,2,3,4,5 
									order by 
										date_format(notifi_datetime,'%Y-%m-%d') DESC
									    ,date_format(notifi_datetime,'%H:%i') DESC")->result_array();
		}
	}
 ?>