<?php 

	/**
	* 
	*/
	class Lesson_model extends CI_Model
	{
		function fetch_class($employee_school_profile_id)
		{
			return $this->db->query("SELECT * FROM class where class_school_profile_id =".$employee_school_profile_id." and class_expiry_date = '9999-12-31'")->result_array();
		}

		function fetch_class_division($class)
		{
			return $this->db->query("SELECT * FROM student_class_division_assgn join division on SCD_division_id = division_id where SCD_class_id =".$class['class_id']." and SCD_school_profile_id =".$class['employee_school_profile_id']." and SCD_expiry_date = '9999-12-31' group by SCD_division_id")->result_array();
		}

		function fetch_class_division_subject($subject)
		{
			return $this->db->query("select subject_id,subject_name,eval_name from subject join teacher_class_division_subject_assgn on TCDS_subject_id = subject_id join evaluation on subject_eval_id = eval_id where TCDS_class_id =".$subject['class_id']." and TCDS_division_id =".$subject['division']." and TCDS_school_profile_id =".$subject['employee_school_profile_id']." and TCDS_expiry_date = '9999-12-31' group by subject_name,subject_id")->result_array();
		}

		function fetch_teacher($subject)
		{
			return $this->db->query("SELECT TTCDS_employee_profile_id,employee_first_name,employee_middle_name,employee_last_name FROM `teacher_class_division_subject_assgn` as TCDS JOIN employee ON employee_profile_id = TCDS_employee_profile_id where TCDS_class_id = '".$subject['class_name']."' and TCDS.TCDS_division_id = '".$subject['division']."' and TCDS.TCDS_subject_id = '".$subject['subject_id']."' and TCDS.TCDS_AY_id = '".$subject['school_AY_id']."' and TCDS.TCDS_school_profile_id = '".$subject['employee_school_profile_id']."' and TCDS.TCDS_expiry_date = '9999-12-31' group by TCDS.TCDS_employee_profile_id")->result_array();
		}

		function fetch_TCDS_id($data)
		{
			return $this->db->query('SELECT TCDS_id FROM `teacher_class_division_subject_assgn` where TCDS_employee_profile_id = '.$data['teacher_name'].' and TCDS_class_id = '.$data['class_name'].' and TCDS_division_id = '.$data['division'].' and TCDS_subject_id = '.$data['subject_name'].' and TCDS_AY_id = '.$data['school_AY_id'].' and TCDS_school_profile_id = '.$data['employee_school_profile_id'].' and TCDS_expiry_date = "9999-12-31"')->row()->TCDS_id;
		}
		function insert_lesson($data)
		{
			$this->db->insert('lesson_planning',$data);
		}
		function fetch_lesson($data)
		{
			// return $this->db->query('SELECT * FROM `lesson_planning` where LP_school_profile_id= '.$data['employee_school_profile_id'].' and LP_AY_id = '.$data['school_AY_id'].'')->result_array();
			return $this->db->query("SELECT LP_topic,LP_description,LP_date,LP_status,class_name,division_name,subject_name,employee_first_name,employee_middle_name,employee_last_name,eval_name FROM `lesson_planning` JOIN teacher_class_division_subject_assgn ON LP_TCDS_id = TCDS_id JOIN class ON TCDS_class_id = class_id JOIN division ON division_id=TCDS_division_id JOIN subject ON subject_id = TCDS_subject_id join evaluation on subject_eval_id =eval_id JOIN employee ON employee_profile_id=TCDS_employee_profile_id WHERE LP_school_profile_id = ".$data['employee_school_profile_id']." AND lesson_planning.LP_AY_id = ".$data['school_AY_id']." ORDER BY lesson_planning.LP_id DESC")->result_array();
		}
		function teacher_lesson_details($data)
		{
			return $this->db->query("SELECT LP_id,LP_topic,LP_description,LP_date,LP_status,class_name,division_name,subject_name, eval_name FROM `lesson_planning` JOIN teacher_class_division_subject_assgn as TCDS ON LP_TCDS_id=TCDS_id JOIN class ON TCDS_class_id = class_id JOIN division ON division_id=TCDS_division_id JOIN subject ON subject_id = TCDS_subject_id join evaluation on subject_eval_id =eval_id WHERE LP_school_profile_id = ".$data['employee_school_profile_id']." AND lesson_planning.LP_AY_id = ".$data['school_AY_id']." AND TCDS.TCDS_employee_profile_id = ".$data['employee_profile_id']." ORDER BY lesson_planning.LP_id DESC")->result_array();
		}
		function fetch_lesson_details($lesson)
		{
			return $this->db->query("SELECT * FROM `lesson_planning` WHERE LP_id = ".$lesson['LP_id']." AND LP_school_profile_id = ".$lesson['employee_school_profile_id']."")->row();
		}
		function update_lesson($lesson)
		{
			$this->db->set($lesson)->where('LP_id',$lesson['LP_id'])->where('LP_school_profile_id',$lesson['LP_school_profile_id'])->update("lesson_planning", $lesson);
			return true;
		}
		
	}
 ?>