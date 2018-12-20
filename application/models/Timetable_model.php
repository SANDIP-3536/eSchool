<?php 

	/**
	* 
	*/
	class Timetable_model extends CI_Model
	{
		function fetch_class($employee_school_profile_id)
		{
			return $this->db->query("SELECT * FROM class where class_school_profile_id =".$employee_school_profile_id." and class_expiry_date = '9999-12-31'")->result_array();
		}

		function fetch_class_division($class)
		{
			return $this->db->query("SELECT * FROM  division  where division_class_id =".$class['class_id']." and division_school_profile_id =".$class['employee_school_profile_id']." and division_expiry_date = '9999-12-31' group by division_id")->result_array();
		}

		function fetch_class_division_subject($subject)
		{
			return $this->db->query("select subject_id,subject_name, eval_name from subject join teacher_class_division_subject_assgn on TCDS_subject_id = subject_id join evaluation on subject_eval_id = eval_id where TCDS_class_id =".$subject['class_id']." and TCDS_division_id =".$subject['division']." and TCDS_school_profile_id =".$subject['employee_school_profile_id']." and TCDS_expiry_date = '9999-12-31' group by subject_name,subject_id")->result_array();
		}

		function fetch_teacher($subject)
		{
			return $this->db->query("SELECT TCDS.TCDS_employee_profile_id,employee.employee_first_name,employee.employee_middle_name,employee.employee_last_name FROM `teacher_class_division_subject_assgn` as TCDS JOIN employee ON employee.employee_profile_id = TCDS.TCDS_employee_profile_id where TCDS.TCDS_class_id = '".$subject['class_name']."' and TCDS.TCDS_division_id = '".$subject['division']."' and TCDS.TCDS_subject_id = '".$subject['subject_id']."' and TCDS.TCDS_AY_id = '".$subject['school_AY_id']."' and TCDS.TCDS_school_profile_id = '".$subject['employee_school_profile_id']."' and TCDS.TCDS_expiry_date = '9999-12-31' group by TCDS.TCDS_employee_profile_id")->result_array();
		}

		function fetch_TCDS_id($data)
		{
			return $this->db->query('SELECT TCDS_id FROM `teacher_class_division_subject_assgn` where TCDS_employee_profile_id = '.$data['teacher_name'].' and TCDS_class_id = '.$data['class_name'].' and TCDS_division_id = '.$data['division'].' and TCDS_subject_id = '.$data['subject_name'].' and TCDS_AY_id = '.$data['school_AY_id'].' and TCDS_school_profile_id = '.$data['employee_school_profile_id'].' and TCDS_expiry_date = "9999-12-31"')->row()->TCDS_id;
		}
		function insert_timetable($data)
		{
			$this->db->insert('timetable',$data);
		}
		function fetch_timetable($data)
		{
			return $this->db->query('select 
										* 
									from 
									(
										select 
											* 
										from(
											select 
										tt_id
										,day as tt_day 
										,start_time as tt_start_time
										,end_time as tt_end_time
										,employee_first_name
										,employee_last_name
										,subject_name
										,eval_name
										,class_name
										,division_name
										,AY_name 
										from (
												select 
													tt_day as day
													,tt_start_time as start_time
													,tt_end_time as end_time
												from teacher_class_division_subject_assgn
												join timetable
													on tt_division_id=TCDS_division_id
												where tt_school_profile_id = '.$data['employee_school_profile_id'].' 
													AND tt_expiry_date = "9999-12-31" 
													AND tt_AY_id = '.$data['school_AY_id'].'
													TCDS_class_id = '.$data['class_name'].' 
													AND TCDS_division_id = '.$data['division'].' 
													AND TCDS_AY_id = '.$data['school_AY_id'].' 
													AND TCDS_expiry_date = "9999-12-31"
													group by 1,2,3
											)as timings
										left join timetable
											on tt_day=day
											and tt_start_time=start_time
											and tt_end_time=end_time
											and tt_TCDS_id in (
																select 
																	TCDS_id 
																from teacher_class_division_subject_assgn 
																where TCDS_class_id = '.$data['class_name'].' 
																	AND TCDS_division_id = '.$data['division'].' 
																	AND TCDS_AY_id = '.$data['school_AY_id'].' 
																	AND TCDS_expiry_date = "9999-12-31"
																)
										left join teacher_class_division_subject_assgn
											on TCDS_id=tt_TCDS_id
										left join subject
											on TCDS_subject_id=subject_id
										left join evaluation 
											on subject_eval_id = eval_id 
										left join class 
											ON TCDS_class_id = class_id 
										left join division 
											on TCDS_division_id = division_id 
										left join academic_year 
											on AY_id = TCDS_AY_id 
										left JOIN employee 
											ON TCDS_employee_profile_id=employee_profile_id 
										) as data1
										union
										select 
											*
										from
										(
											select 
												0 as tt_id
												,0 as tt_day
												,tt_start_time
												,tt_end_time
												,0 as employee_first_name
												,0 as employee_last_name
												,0 as subject_name
												,0 as eval_name
												,0 as class_name
												,0 as division_name
												,0 as AY_name 
												from teacher_class_division_subject_assgn
												join timetable
													on tt_division_id=TCDS_division_id
												where 
													tt_school_profile_id = '.$data['employee_school_profile_id'].' 
													AND tt_expiry_date = "9999-12-31" 
													AND tt_AY_id = '.$data['school_AY_id'].'
													TCDS_class_id = '.$data['class_name'].' 
													AND TCDS_division_id = '.$data['division'].' 
													AND TCDS_AY_id = '.$data['school_AY_id'].' 
													AND TCDS_expiry_date = "9999-12-31"
												group by 3,4
										)as data2
									)as data3
									ORDER BY tt_day,tt_start_time ASC')->result_array();
		}
		function fetch_class_teacher($employee_profile_id)
		{
			return $this->db->query("SELECT * FROM `class` JOIN teacher_class_division_subject_assgn ON TCDS_class_id = class_id WHERE TCDS_employee_profile_id = ".$employee_profile_id." and class_expiry_date = '9999-12-31' GROUP by class_name")->result_array();
		}
		function fetch_class_division_teacher($class)
		{
			return $this->db->query("SELECT * FROM student_class_division_assgn join division on SCD_division_id = division_id JOIN teacher_class_division_subject_assgn ON TCDS_division_id = division_id where SCD_class_id =".$class['class_id']." AND TCDS_employee_profile_id = ".$class['employee_profile_id']." and SCD_expiry_date = '9999-12-31' group by SCD_division_id")->result_array();
		}
		function fetch_timetable_teacher($data)
		{
			//return $this->db->query('SELECT tt_day,tt_start_time,tt_end_time,employee_first_name,employee_last_name,subject_name,eval_name,class_name,division_name,AY_name FROM `timetable` JOIN teacher_class_division_subject_assgn ON tt_TCDS_id = TCDS_id JOIN employee ON TCDS_employee_profile_id=employee_profile_id JOIN subject ON subject_id = TCDS_subject_id join evaluation on subject_eval_id = eval_id join class ON TCDS_class_id = class_id join division on TCDS_division_id = division_id join academic_year on AY_id = tt_AY_id WHERE TCDS_employee_profile_id = '.$data['employee_profile_id'].' AND tt_expiry_date = "9999-12-31" AND tt_AY_id = '.$data['school_AY_id'].' AND TCDS_class_id = '.$data['class_name'].' AND TCDS_division_id = '.$data['division'].' AND TCDS_AY_id = '.$data['school_AY_id'].' AND TCDS_expiry_date = "9999-12-31" ORDER BY tt_start_time ASC')->result_array();
			return $this->db->query('select 
											* 
										from 
										(
											select 
												* 
											from(
												select 
											day as tt_day 
											,start_time as tt_start_time
											,end_time as tt_end_time
											,employee_first_name
											,employee_last_name
											,subject_name
											,eval_name
											,class_name
											,division_name
											,AY_name 
											from (
													select 
														tt_day as day
														,tt_start_time as start_time
														,tt_end_time as end_time
													from teacher_class_division_subject_assgn
													join timetable
														on tt_division_id=TCDS_division_id
													where TCDS_employee_profile_id = '.$data['employee_profile_id'].'
														AND TCDS_AY_id = '.$data['school_AY_id'].'
														AND TCDS_expiry_date = "9999-12-31"
														group by 1,2,3
												)as timings
											left join timetable
												on tt_day=day
												and tt_start_time=start_time
												and tt_end_time=end_time
												and tt_TCDS_id in (
																	select 
																		TCDS_id 
																	from teacher_class_division_subject_assgn 
																	where TCDS_AY_id = '.$data['school_AY_id'].' 
																		and TCDS_employee_profile_id='.$data['employee_profile_id'].'
																		AND TCDS_expiry_date = "9999-12-31"
																	)
											left join teacher_class_division_subject_assgn
												on TCDS_id=tt_TCDS_id
											left join subject
												on TCDS_subject_id=subject_id
											left join evaluation 
												on subject_eval_id = eval_id 
											left join class 
												ON TCDS_class_id = class_id 
											left join division 
												on TCDS_division_id = division_id 
											left join academic_year 
												on AY_id = TCDS_AY_id 
											left JOIN employee 
												ON TCDS_employee_profile_id=employee_profile_id 
											) as data1
											union
											select 
												*
											from
											(
												select 
													0 as tt_day
													,tt_start_time
													,tt_end_time
													,0 as employee_first_name
													,0 as employee_last_name
													,0 as subject_name
													,0 as eval_name
													,0 as class_name
													,0 as division_name
													,0 as AY_name 
													from teacher_class_division_subject_assgn
													join timetable
														on tt_division_id=TCDS_division_id
													where TCDS_employee_profile_id = '.$data['employee_profile_id'].' 
														AND TCDS_AY_id = '.$data['school_AY_id'].' 
														AND TCDS_expiry_date = "9999-12-31"
													group by 2,3
											)as data2
										)as data3
										ORDER BY tt_day,tt_start_time ASC')->result_array();
		}
	}
 ?>