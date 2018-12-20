<?php
	class Exam_model extends CI_Model
	{
// ------------------------------------------- term Details  ---------------------------------------------------------------------------------------------------------------------------------------------------
		function term_registration($term)
		{
			$this->db->insert('term',$term);
			return 1;
		}

		function term_verifi($term)
		{
			return $this->db->query("SELECT case when term_end_date<='".$term['term_start_date']."' then '1' else '0' end as status FROM term where term_AY_id=".$term['term_AY_id']." and term_school_profile_id=".$term['term_school_profile_id']." order by term_name desc limit 1")->result_array();
		}

		function fetch_term($employee_school_profile_id,$school_AY_id)
		{
			return $this->db->query("SELECT * FROM term where term_school_profile_id =".$employee_school_profile_id." and term_AY_id =".$school_AY_id."")->result_array();
		}

// ------------------------------------------- Grade Details  -------------------------------------------------------------------------------------------------------------------------------------------------
		function grade_registration($GC_grade)
		{
			$this->db->insert('grade_scale',$GC_grade);
			return 1;
		}

		function fetch_grade($employee_school_profile_id,$school_AY_id)
		{
			return $this->db->query("SELECT * FROM grade_scale where GC_school_profile_id =".$employee_school_profile_id." and GC_AY_id =".$school_AY_id."")->result_array();
		}

		function grade_mark_verify($GC_grade)
		{
			return $this->db->query("SELECT case when GC_lower_mark_range<".$GC_grade['GC_higher_mark_range']." then '1' else '0' end as status FROM grade_scale where GC_AY_id=".$GC_grade['GC_AY_id']." and GC_school_profile_id=".$GC_grade['GC_school_profile_id']." order by GC_grade desc limit 1")->result_array();
		}

// ---------------------------------------------- Exam Deatils ---------------------------------------------------------------------------------------------------------
		function fetch_school_class($employee_school_profile_id)
		{
			return $this->db->query("SELECT * FROM class where class_school_profile_id =".$employee_school_profile_id." and class_expiry_date='9999-12-31' group by class_id")->result_array();
		}

		function exam_registration($exam)
		{
			$this->db->insert('exam',$exam);
			return 1;
		}

		function fetch_exam($employee_school_profile_id,$school_AY_id)
		{
			return $this->db->query("SELECT 
											exam.*
											,case 
												when exam_result_date='9999-12-31' then 'NA'
												else date_format(exam_result_date,'%D %m %Y')
											end as result_date
											,date_format(exam_start_date,'%d-%m-%Y') as start_date
											,date_format(exam_end_date,'%d-%m-%Y') as end_date
											,date_format(exam_start_time,'%h:%i %p') as start_time
											,date_format(exam_end_time,'%h:%i %p') as end_time
											,term_name
											,class_name
											,subject_name
											,eval_name
											,case 
												when count is NULL then std_count
												else std_count-count
											end as std_count
											,case 
												when count is NULL then '0'
												else count
											end as count
											,std_count as total
										FROM exam 
										join term 
											on exam_term_id= term_id 
										join evaluation 
											on eval_id = exam_eval_id 
										join class 
											on exam_class_id=class_id 
										join subject 
											on exam_subject_id=subject_id 
										left join 
										(
											SELECT 
												SCD_class_id
												,count(*) as std_count 
											FROM student_class_division_assgn
											where 
												SCD_expiry_date='9999-12-31' 
											group by 
												SCD_class_id
										) as std
											on SCD_class_id=class_id
										left join 
										(
											SELECT 
												marks_exam_id
												,count(*) as count 
											FROM `marks` 
											group by 
												marks_exam_id
										)as marks
											on exam_id=marks_exam_id
										where 
											exam_school_profile_id =".$employee_school_profile_id." 
											and exam_AY_id =".$school_AY_id."
										")->result_array();
		}

		function fetch_eval_type($employee_school_profile_id,$school_AY_id)
		{
			return $this->db->where("eval_school_profile_id",$employee_school_profile_id)->get("evaluation")->result_array();
		}

// -------------------------------------------------- Exam Marks Deatils ---------------------------------------------------------------------------------------------------

		function fetch_school_class_division($employee_school_profile_id,$school_AY_id,$employee_profile_id)
		{
			if (isset($this->session->userdata['school'])) {
				return $this->db->query("SELECT * FROM division join class on division_class_id = class_id where class_school_profile_id =".$employee_school_profile_id." and class_expiry_date='9999-12-31' group by class_id,division_id")->result_array();
        	}elseif (isset($this->session->userdata['teacher'])) {
        		return $this->db->query("SELECT * FROM teacher_class_division_subject_assgn join class on TCDS_class_id = class_id join division on TCDS_division_id = division_id where TCDS_school_profile_id =".$employee_school_profile_id." and TCDS_AY_id = ".$school_AY_id." and TCDS_expiry_date='9999-12-31' and TCDS_employee_profile_id = ".$employee_profile_id." group by TCDS_class_id,TCDS_division_id")->result_array();
        	}
		}

		function fetch_school_subject($subject)
		{
			return $this->db->query("SELECT subject_id,subject_name from subject where subject_school_profile_id =".$subject['subject_school_profile_id']." and subject_expiry_date = '9999-12-31' and subject_class_id =".$subject['class_id']."")->result_array();
		}

		function fetch_school_division_subject($subject)
		{
			return $this->db->query("SELECT exam_id,subject_name,eval_name FROM exam join subject on exam_subject_id = subject_id and exam_class_id = subject_class_id join evaluation on exam_eval_id = eval_id where exam_class_id = ".$subject['class_id']." and exam_school_profile_id = ".$subject['subject_school_profile_id']." and exam_AY_id = ".$subject['AY_id']."")->result_array();
		}

		function fetch_school_division_subject1($subject)
		{
			return $this->db->query("SELECT exam_subject_id,subject_name FROM exam join subject on exam_subject_id = subject_id and exam_class_id = subject_class_id where exam_class_id = ".$subject['class_id']." and exam_school_profile_id = ".$subject['subject_school_profile_id']." and exam_AY_id = ".$subject['AY_id']." group by 1")->result_array();
		}

		function fetch_school_division_student($subject)
		{
			return $this->db->query("SELECT SCD_Roll_No,marks_status,student_profile_id,student_first_name,student_middle_name,student_last_name,case when marks_obtained is NULL then 'NA' else  marks_obtained end as marks_obtain,exam_outoff_marks FROM exam join student_class_division_assgn on exam_class_id=SCD_class_id and exam_AY_id= SCD_AY_id and exam_school_profile_id = SCD_school_profile_id and SCD_division_id=".$subject['division_id']."
				join student on SCD_student_profile_id=student_profile_id and SCD_expiry_date='9999-12-31'
				left join
				marks on marks_student_id=student_profile_id and marks_exam_id=exam_id and exam_AY_id= marks_AY_id and exam_school_profile_id = marks_school_profile_id
				where exam_id=".$subject['exam_id']." and exam_AY_id =".$subject['AY_id']." and exam_school_profile_id =".$subject['subject_school_profile_id']."
				order by SCD_Roll_No")->result_array();
		}

		function fetch_school_mark_student($subject)
		{
			return $this->db->query("SELECT 
										marks_id
										,SCD_Roll_No
										,student_first_name
										,student_middle_name
										,student_last_name
										,case 
											when marks_obtained is NULL then '-'
											else marks_obtained
										end as marks_obtained
										,exam_outoff_marks
										,exam_evaluation_marks
										,case 
											when marks_evaluation is NULL then '-'
											else marks_evaluation
										end as marks_evaluation
										,exam_marksheet_marks
										,case 
											when marks_marksheet is NULL then '-'
											else marks_marksheet
										end as marks_marksheet
										,case 
											when marks_status='1' then 'Verified' 
											when marks_status='0' then 'Not Verified' 
										END as marks_status_details
										,marks_status 
									FROM exam 
									join student_class_division_assgn 
										on exam_class_id=SCD_class_id 
										and exam_AY_id= SCD_AY_id 
										and exam_school_profile_id = SCD_school_profile_id 
										and SCD_division_id=".$subject['division_id']."
									join student 
										on SCD_student_profile_id=student_profile_id 
										and SCD_expiry_date='9999-12-31'
									left join marks 
										on marks_student_id=student_profile_id 
										and marks_exam_id=exam_id 
										and exam_AY_id= marks_AY_id 
										and exam_school_profile_id = marks_school_profile_id
									where 
										exam_id=".$subject['exam_id']." 
										and exam_AY_id =".$subject['AY_id']." 
										and exam_school_profile_id =".$subject['subject_school_profile_id']."
									order by 
										SCD_Roll_No")->result_array();
		}

		function fetch_school_division_teacher($subject)
		{
			return $this->db->query("SELECT employee.* FROM `exam` join teacher_subject_assgn on exam_subject_id =TS_subject_id and exam_AY_id = TS_AY_id join employee on employee_profile_id =TS_employee_profile_id where TS_expiry_date = '9999-12-31' and exam_id = ".$subject['exam_id']." and exam_school_profile_id = ".$subject['subject_school_profile_id']." and exam_AY_id = ".$subject['AY_id']."")->result_array();
		}

		function fetch_school_division_exam_deatils($subject)
		{
			return $this->db->query("SELECT exam_outoff_marks,exam_evaluation_marks,exam_marksheet_marks FROM `exam` where exam_id = ".$subject['exam_id']." and exam_school_profile_id = ".$subject['subject_school_profile_id']." and exam_AY_id = ".$subject['AY_id']."")->result_array();
		}

		function mark_registration($marks)
		{
			$this->db->insert('marks',$marks);
			return 1;
		}

		function fetch_marks($employee_school_profile_id,$school_AY_id)
		{
			return $this->db->query("SELECT * from marks join exam on exam_id = marks_exam_id join student on student_profile_id = marks_student_id where marks_school_profile_id =".$employee_school_profile_id." and marks_AY_id=".$school_AY_id."")->result_array();
		}

// ------------------------------------------------------------------ Evaluation Process ----------------------------------------------------------------------------
		function fetch_eval_term($employee_school_profile_id,$school_AY_id)
		{
			return $this->db->query("SELECT exam_term_id,term_name from exam join term on exam_term_id = term_id where exam_AY_id=".$school_AY_id." AND exam_school_profile_id =".$employee_school_profile_id." and exam_evaluation_status ='0' group by exam_term_id")->result_array();
		}

		function check_division_evaluation_process($eval)
		{
			return $this->db->query("SELECT division_id,division_name,case when std_count is NULL then 0 else std_count end as std_count FROM division left join (SELECT SCD_division_id,count(*) as std_count
					FROM student_class_division_assgn where SCD_class_id=".$eval['class']." and SCD_AY_id=".$eval['AY_id']." and SCD_expiry_date='9999-12-31' and SCD_school_profile_id=".$eval['subject_school_profile_id']." group by SCD_class_id)as SCD on SCD_division_id=division_id where division_class_id=".$eval['class']." and division_expiry_date='9999-12-31' and division_school_profile_id=".$eval['subject_school_profile_id']."")->result_array();
		}

		function check_division_exam_evaluation_process($eval)
		{
			return $this->db->query("SELECT total_exam,evaluation_status,exam_evaluation_status,sum(balance) as button_status,marks_verification_cnt from (SELECT count(exam_id) as total_exam FROM exam where exam_term_id=".$eval['term']." and exam_class_id=".$eval['class']." and exam_AY_id=".$eval['AY_id']." and exam_school_profile_id =".$eval['subject_school_profile_id'].") as data1,
				(SELECT case when exam_evaluation_status = '0' then 'Evaluation Pending' when exam_evaluation_status = '1' then 'Evaluation Under Process' else 'Evaluation Done' end as evaluation_status,exam_evaluation_status FROM exam where exam_term_id=".$eval['term']." and exam_class_id=".$eval['class']." and exam_AY_id=".$eval['AY_id']." and exam_school_profile_id =".$eval['subject_school_profile_id']." order by exam_evaluation_status limit 1) as data2,
				(SELECT std_count,case when marks_std_cnt is NULL then 0 else marks_std_cnt end as marks_std_cnt,case when marks_std_cnt is NULL then std_count else (std_count-marks_std_cnt) end as balance  from (SELECT exam_id,exam_subject_id,subject_name,eval_name,exam_result_date,exam_evaluation_status FROM exam join subject on subject_id=exam_subject_id
				join evaluation on subject_eval_id=eval_id	where exam_term_id=".$eval['term']." and exam_class_id=".$eval['class'].") as exam_data
				cross join
				(SELECT	division_id,division_name,case when std_count is NULL then 0 else std_count end as std_count FROM division	left join (SELECT SCD_division_id,count(*) as std_count	FROM student_class_division_assgn where SCD_class_id=".$eval['class']." and SCD_AY_id=".$eval['AY_id']." and SCD_expiry_date='9999-12-31' and SCD_school_profile_id=".$eval['subject_school_profile_id']." group by SCD_class_id)as SCD on SCD_division_id=division_id	where division_class_id=1 and division_expiry_date='9999-12-31'
					and division_school_profile_id=".$eval['subject_school_profile_id'].") as std_count_data
				left join 
				(SELECT marks_exam_id,SCD_division_id,count(*) as marks_std_cnt	from (select marks_exam_id,marks_student_id,SCD_division_id	from marks left join student_class_division_assgn
					on marks_student_id=SCD_student_profile_id	and SCD_class_id=1	and SCD_AY_id=".$eval['AY_id']." and SCD_expiry_date='9999-12-31' and SCD_school_profile_id=".$eval['subject_school_profile_id'].") as marks_data group by marks_exam_id,SCD_division_id ) as marks_info on exam_id=marks_exam_id and division_id=SCD_division_id order by division_id,subject_name,exam_id) as data3,
					(select count(marks_id) as marks_verification_cnt from marks where marks_exam_id in (SELECT exam_id FROM exam  where exam_term_id=".$eval['term']." and exam_class_id=".$eval['class']." and exam_AY_id=".$eval['AY_id']." and exam_school_profile_id =".$eval['subject_school_profile_id'].") and marks_status='0') as data4
					")->result_array();
		}

		function check_evaluation_process($eval)
		{
			return $this->db->query("SELECT * from (SELECT division_id,division_name,exam_id,exam_subject_id,subject_name,eval_name,exam_result_date,exam_evaluation_status,std_count,case when marks_std_cnt is NULL then 0 else marks_std_cnt end as marks_std_cnt,case when marks_std_cnt is NULL then std_count else (std_count-marks_std_cnt) end as balance  from (SELECT exam_id,exam_subject_id,subject_name,eval_name,exam_result_date,exam_evaluation_status FROM exam join subject on subject_id=exam_subject_id
				join evaluation on subject_eval_id=eval_id	where exam_term_id=".$eval['term']." and exam_class_id=".$eval['class'].") as exam_data
				cross join
				(SELECT	division_id,division_name,case when std_count is NULL then 0 else std_count end as std_count FROM division	left join (SELECT SCD_division_id,count(*) as std_count	FROM student_class_division_assgn where SCD_class_id=".$eval['class']." and SCD_AY_id=".$eval['AY_id']." and SCD_expiry_date='9999-12-31' and SCD_school_profile_id=".$eval['subject_school_profile_id']."	group by SCD_class_id)as SCD on SCD_division_id=division_id	where division_class_id=1 and division_expiry_date='9999-12-31'
					and division_school_profile_id=".$eval['subject_school_profile_id'].") as std_count_data
				left join 
				(SELECT marks_exam_id,SCD_division_id,count(*) as marks_std_cnt	from (select marks_exam_id,marks_student_id,SCD_division_id	from marks left join student_class_division_assgn
					on marks_student_id=SCD_student_profile_id	and SCD_class_id=".$eval['class']."	and SCD_AY_id=".$eval['AY_id']." and SCD_expiry_date='9999-12-31' and SCD_school_profile_id=".$eval['subject_school_profile_id'].") as marks_data group by marks_exam_id,SCD_division_id ) as marks_info on exam_id=marks_exam_id and division_id=SCD_division_id order by division_id,subject_name,exam_id )as data where division_id =".$eval['division']."")->result_array();	
		}

		function check_student_evaluation_process($eval)
		{
			return $this->db->query("SELECT SCD_student_profile_id,SCD_Roll_No,concat(student_first_name,' ',student_middle_name,' ',student_last_name) as student_name,marks_teacher_id,concat(employee_first_name,' ',employee_middle_name,' ',employee_last_name) as teacher_name,marks_obtained,exam_outoff_marks,marks_evaluation,exam_evaluation_marks,CASE WHEN marks_status='1' then 'Verified' else 'Not Verified' end as status FROM student_class_division_assgn
				join student on SCD_student_profile_id=student_profile_id left join marks on SCD_student_profile_id=marks_student_id and marks_exam_id=".$eval['exam']." join employee on marks_teacher_id=employee_profile_id
				and employee_type=5 join exam on marks_exam_id=exam_id where SCD_class_id=".$eval['class']." and SCD_AY_id=".$eval['AY_id']." and SCD_expiry_date='9999-12-31'  and SCD_school_profile_id=".$eval['subject_school_profile_id']." and SCD_division_id=".$eval['division']."")->result_array();	
		}

		function start_evaluation_process($eval)
		{
			return $this->db->query("UPDATE exam SET exam_evaluation_status ='".$eval['eval']."' where exam_term_id =".$eval['term']." and exam_class_id =".$eval['class']." and exam_AY_id =".$eval['AY_id']." and exam_school_profile_id =".$eval['subject_school_profile_id']."")->result_array();
		}

		// function exam_update($exam)
		// {
		// 	$this->db->where('exam_id',$exam['exam_id'])->update('exam_schedule',$exam);
		// 	return 1;
		// }


		// function fetch_teacher_class_subject($employee_school_profile_id,$school_AY_id,$employee_profile_id)
		// {
		// 	return $this->db->query("SELECT TCDS_id,class_name,division_name,subject_name,case when subject_type = 1 then 'Theory' when subject_type = 2 then 'Practical' when subject_type = 3 then 'Project' when subject_type = 4 then 'Oral' when subject_type = 5 then 'Assignment' end as subject_type FROM `teacher_class_division_subject_assgn` join class on class_id = TCDS_class_id join division on division_id = TCDS_division_id join subject on TCDS_subject_id = subject_id where TCDS_Ay_id =".$school_AY_id." and TCDS_school_profile_id =".$employee_school_profile_id." and TCDS_employee_profile_id =".$employee_profile_id." group by class_name,division_name,subject_name,subject_type")->result_array();
		// }


		// function fetch_exam_schedule_wise_exam($exam)
		// {
		// 	return $this->db->query("SELECT * FROM exam_schedule where exam_sched_exam_id =".$exam['exam_id']." and exam_sched_expiry_date ='9999-12-31' and exam_sched_AY_id =".$exam['school_AY_id']." and exam_sched_school_profile_id =".$exam['employee_school_profile_id']."")->result_array();
		// }

		// function fetch_teacher_student($employee_school_profile_id,$school_AY_id,$employee_profile_id)
		// {
		// 	return $this->db->query("SELECT * from student join(select * from student_class_division_assgn join teacher_class_division_subject_assgn on TCDS_class_id = SCD_class_id and TCDS_division_id = SCD_division_id where TCDS_school_profile_id =".$employee_school_profile_id." and TCDS_AY_id=".$school_AY_id." and TCDS_expiry_date='9999-12-31' and TCDS_employee_profile_id =".$employee_profile_id." group by SCD_student_profile_id) as student_class on student_profile_id = SCD_student_profile_id and student_expiry_date = student_class.TCDS_expiry_date and student_class.TCDS_school_profile_id = student_school_profile_id")->result_array();
		// }

		// function fetch_school_class($employee_school_profile_id,$employee_profile_id,$school_AY_id)
		// {
		// 	return $this->db->query("SELECT * FROM `teacher_class_division_subject_assgn` join class on class_id = TCDS_class_id join subject on subject_id = TCDS_subject_id where TCDS_school_profile_id =".$employee_school_profile_id." and TCDS_expiry_date='9999-12-31' and TCDS_AY_id =".$school_AY_id." and TCDS_employee_profile_id =".$employee_profile_id." group by class_name")->result_array();
		// }

		// function fetch_school_subject($employee_school_profile_id,$employee_profile_id,$school_AY_id)
		// {
		// 	return $this->db->query("SELECT * FROM `teacher_class_division_subject_assgn` join class on class_id = TCDS_class_id join subject on subject_id = TCDS_subject_id where TCDS_school_profile_id =".$employee_school_profile_id." and TCDS_expiry_date='9999-12-31' and TCDS_AY_id =".$school_AY_id." and TCDS_employee_profile_id =".$employee_profile_id." group by subject_name,subject_type")->result_array();
		// }
	}
 ?>