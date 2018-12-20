<?php
	class Attendance_model extends CI_Model
	{
		function fetch_class_division_TCDS($employee_school_profile_id,$employee_profile_id,$school_AY_id)
		{
			if (isset($this->session->userdata['school'])) {
				return $this->db->query("SELECT * FROM `teacher_class_division_subject_assgn` join class on class_id = TCDS_class_id join division on division_id = TCDS_division_id where TCDS_expiry_date = '9999-12-31' and TCDS_AY_id =".$school_AY_id." and TCDS_school_profile_id = ".$employee_school_profile_id." group by class_name,division_name")->result_array();
			}elseif (isset($this->session->userdata['teacher'])) {
				return $this->db->query("SELECT * FROM `teacher_class_division_subject_assgn` join class on class_id = TCDS_class_id join division on division_id = TCDS_division_id where TCDS_expiry_date = '9999-12-31' and TCDS_AY_id =".$school_AY_id." and TCDS_school_profile_id = ".$employee_school_profile_id." and TCDS_employee_profile_id = ".$employee_profile_id." group by class_name,division_name")->result_array();
			}
		}

		function fetch_student_acor_SCD($fetch,$date)
		{
			return $this->db->query("SELECT case when SCD_Roll_No is NULL then 'N/A' else SCD_Roll_No end as SCD_Roll_No,division_name,class_name,SCD_id,CONCAT(student_last_name,' ',student_first_name,' ',student_middle_name)as student_name,attend_status,attend_id from student JOIN student_class_division_assgn on student_profile_id = SCD_student_profile_id left join attendance on attend_SCD_id = SCD_id and attend_AY_id = ".$fetch['AY_id']." AND date_format(attend_datetime,'%Y-%m-%d') = '".$date."' join class on class_id= SCD_class_id join division on division_id = SCD_division_id  where SCD_class_id =".$fetch['class_id']." AND SCD_division_id =".$fetch['division_id']." and SCD_expiry_date ='9999-12-31' AND SCD_school_profile_id =".$fetch['profile_id']." AND SCD_AY_id =".$fetch['AY_id']." order by CAST(SCD_Roll_No as SIGNED)")->result_array();
		}

		function fetch_teacher_acor_SCD($fetch)
		{
			return $this->db->query("SELECT TCDS_id,employee_first_name,employee_middle_name,employee_last_name FROM teacher_class_division_subject_assgn join  employee on TCDS_employee_profile_id=employee_profile_id where TCDS_expiry_date = '9999-12-31' and TCDS_AY_id =".$fetch['AY_id']." and TCDS_school_profile_id =".$fetch['profile_id']." and TCDS_class_id =".$fetch['class_id']." and TCDS_division_id =".$fetch['division_id']." and TCDS_subject_id = 0")->result_array();
		}

		function fetch_att_records($att)
		{
			return $this->db->query("SELECT SCD_Roll_No,attend_id,concat(student_first_name,' ',student_middle_name,' ',student_last_name) as name,case when DATE_FORMAT(attend_datetime,'%h:%I:%s %p') is NULL then '-----' when DATE_FORMAT(attend_datetime,'%H:%i:%s')='00:00:00' then '-----'  else DATE_FORMAT(attend_datetime,'%h:%I:%s %p') end as in_time,case when DATE_FORMAT(attend_out_datetime,'%h:%I:%s %p') is NULL then '-----' when DATE_FORMAT(attend_out_datetime,'%H:%i:%s')='00:00:00' then '-----'  else DATE_FORMAT(attend_out_datetime,'%h:%I:%s %p') end as out_time, case when attend_status='P' then 'Prsent' when attend_status='H' then 'Holiday' when attend_status='W' then 'Weekend' else 'ABSENT' end as attend_status_name FROM `attendance` join student_class_division_assgn on SCD_id = attend_SCD_id and attend_AY_id = SCD_AY_id and attend_AY_id = SCD_Ay_id join student on SCD_student_profile_id = student_profile_id WHERE SCD_class_id=".$att['class_id']." and SCD_division_id=".$att['div_id']."  and attend_AY_id = ".$att['attend_AY_id']." and attend_school_profile_id = ".$att['attend_school_profile_id']." and CAST(attend_datetime as date)='".$att['date']."' order by SCD_Roll_No")->result_array();
		}
		
		function fetch_class_name_records($att)
		{
			return $this->db->query("SELECT class_name,division_name FROM teacher_class_division_subject_assgn join class on TCDS_class_id=class_id left join division on TCDS_division_id=division_id where TCDS_id='".$att['TCDS_id']."'")->result_array();
		}
	}
 ?>