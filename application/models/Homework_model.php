<?php
	class Homework_model extends CI_Model
	{
		function fetch_TCDS($employee_school_profile_id,$school_AY_id,$employee_profile_id)
		{
			return $this->db->query('SELECT * from employee join teacher_class_division_subject_assgn on employee_profile_id = TCDS_employee_profile_id join subject on subject_id = TCDS_subject_id join evaluation on subject_eval_id =eval_id where TCDS_school_profile_id ='.$employee_school_profile_id.' and TCDS_AY_id ='.$school_AY_id.' and TCDS_employee_profile_id ='.$employee_profile_id.' and TCDS_expiry_date = "9999-12-31"')->result_array();
		}

		function fetch_class_division_TCDS($employee_school_profile_id,$employee_profile_id,$school_AY_id)
		{
			return $this->db->query('SELECT * from teacher_class_division_subject_assgn join class on class_id = TCDS_class_id join division on division_id =TCDS_division_id where TCDS_school_profile_id ='.$employee_school_profile_id.' and TCDS_AY_id ='.$school_AY_id.' and TCDS_employee_profile_id ='.$employee_profile_id.' and TCDS_expiry_date = "9999-12-31" group by class_id,division_id')->result_array();
		}

		function fetch_student_acc_class_division($std)		
		{
			return $this->db->query("SELECT SCD_Roll_No,student_first_name,student_middle_name,student_last_name,student_profile_id,class_name,division_name FROM student join student_class_division_assgn on student_profile_id = SCD_student_profile_id JOIN class on class_id = SCD_class_id join division on division_id = SCD_division_id where SCD_school_profile_id=".$std['student_school_profile_id']." AND SCD_class_id=".$std['class']." AND SCD_division_id=".$std['division']." AND SCD_expiry_date='9999-12-31' and SCD_AY_id =".$std['AY_id']."")->result_array();
		}

		function homework_registration($HW)
		{
			$this->db->insert('homework',$HW);
			return 1;
		}

		function fetch_homework($employee_school_profile_id,$school_AY_id)
		{
			return $this->db->query("SELECT * FROM homework join teacher_class_division_subject_assgn on TCDS_id = hw_TCDS_id join employee on TCDS_employee_profile_id = employee_profile_id JOIN subject ON subject_id = TCDS_subject_id join evaluation on subject_eval_id = eval_id where hw_school_profile_id =".$employee_school_profile_id." and hw_AY_id =".$school_AY_id."")->result_array();
		}

		function homework_details($hw_id)
		{
			return $this->db->query("SELECT * FROM homework join teacher_class_division_subject_assgn on TCDS_id = hw_TCDS_id join employee on TCDS_employee_profile_id = employee_profile_id JOIN subject ON subject_id = TCDS_subject_id where hw_school_profile_id =".$hw_id."")->result_array();
		}

		function update_homework($HW)			
		{
			$this->db->where('hw_id',$HW['hw_id'])->update('homework',$HW);
			return 1;
		}
	}
 ?>