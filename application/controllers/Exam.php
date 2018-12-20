<?php 
	class Exam extends CI_Controller
	{
		function __construct()
		{
			parent::__construct();
			if(isset($this->session->userdata['school'])){

			}elseif(isset($this->session->userdata['teacher'])) {

			}else{
				redirect('/');
			}
		}
// ------------------------------------------------------------- Term Details ----------------------------------------------------------------------		
		function term_details()
		{
			if(!isset($this->session->userdata['school'])){
				redirect('/');
			}
			if(isset($this->session->userdata['direct'])){
				$admin['direct'] = $this->session->userdata('direct');
			}
			else{
				$admin['direct'] = 1;
			} 

			$exam['flash']['active'] = $this->session->flashdata('active');
	    	$exam['flash']['title'] = $this->session->flashdata('title');
	    	$exam['flash']['text'] = $this->session->flashdata('text');
	    	$exam['flash']['type'] = $this->session->flashdata('type');
	    	
			$school_admin = $this->session->userdata('school');
			$admin['user'] = $school_admin[0]['employee_pri_mobile_number'];
			$admin['user_profile_id'] = $school_admin[0]['employee_profile_id'];
			$admin['employee_type'] = $school_admin[0]['employee_type'];
			$admin['photo'] = $school_admin[0]['employee_photo'];
			$admin['first_name'] = $school_admin[0]['employee_first_name'];
			$admin['last_name'] = $school_admin[0]['employee_last_name'];
			$admin['email_id'] = $school_admin[0]['employee_email_id'];
			$admin['username'] = $school_admin[0]['credential_username'];
			$admin['user_type'] = $school_admin[0]['employee_type'];
			$admin['AY_name'] = $school_admin[0]['AY_name'];
			$school['user_profile_id'] = $school_admin[0]['employee_profile_id'];
			$admin['functionality'] = $this->School_model->fetch_functionality($school);
			$employee_school_profile_id = $school_admin[0]['employee_school_profile_id'];
			$employee_profile_id = $school_admin[0]['employee_profile_id'];
			$school_AY_id = $school_admin[0]['school_AY_id'];
			$exam['term_details'] = $this->Exam_model->fetch_term($employee_school_profile_id,$school_AY_id);
			$nav['school_name'] = $school_admin[0]['school_name'];
			$nav['school_logo'] = $school_admin[0]['school_logo'];
			$nav['exam'] = 'term';
			$this->load->view('School/school_header', $admin);
			$this->load->view('Exam/term_details',$exam);
			$this->load->view('Exam/exam_footer',$nav);
		}
		
		function term_registration()
		{
			$school_admin = $this->session->userdata('school');
			$term['term_name'] = $this->input->post('term_name');
			$term['term_start_date'] = $this->input->post('term_start_date');
			$term['term_end_date'] = $this->input->post('term_end_date');
			$term['term_school_profile_id'] = $school_admin[0]['employee_school_profile_id'];
			$term['term_AY_id'] = $school_admin[0]['school_AY_id'];
			$acadmic_year = $this->db->query("SELECT * FROM academic_year where AY_id =".$term['term_AY_id']."")->result_array();
			$acadmic_year_split = $acadmic_year[0]['AY_name'];
			$academic_year = explode("-",$acadmic_year_split);
			$acadmic_start_date = $academic_year[0].'-'.$acadmic_year[0]['AY_start_month'].'-01';
			$acadmic_end_date = '20'.$academic_year[1].'-'.$acadmic_year[0]['AY_end_month'].'-01';
			$d = new DateTime($acadmic_end_date); 
			$end_date =  $d->format( 'Y-m-t' );
			if ((strtotime($term['term_start_date']) >= strtotime($acadmic_start_date)) && (strtotime($term['term_end_date']) <= strtotime($end_date)))
		    {
		    	$date_veri = $this->Exam_model->term_verifi($term);

				if (!empty($date_veri)) 
				{
						
			    	if($date_veri[0]['status'] == 1){
				    	$verify = $this->db->where('term_name',$term['term_name'])->where('term_AY_id',$term['term_AY_id'])->where('term_school_profile_id',$term['term_school_profile_id'])->get('term')->num_rows();
				    	if($verify != 0){
				    		$this->session->set_flashdata('active',1);
				            $this->session->set_flashdata('title',"Term Already Register.");
				            $this->session->set_flashdata('text',"");
				            $this->session->set_flashdata('type',"warning");
				            redirect('Exam/term_details');
				    	}
				    	else{
					      	$con = $this->Exam_model->term_registration($term);
							if($con == 1){
								$this->session->set_flashdata('active',1);
					            $this->session->set_flashdata('title',"Term submitted.");
					            $this->session->set_flashdata('text',"");
					            $this->session->set_flashdata('type',"success");
					            redirect('Exam/term_details');
					        }else{
								$this->session->set_flashdata('active',1);
					            $this->session->set_flashdata('title',"Term Not Submitted.");
					            $this->session->set_flashdata('text',"");
					            $this->session->set_flashdata('type',"warning");
					            redirect('Exam/term_details');
							}
						}
					}
					else{
				      	$this->session->set_flashdata('active',1);
			            $this->session->set_flashdata('title',"Term Duration confict with other term.");
			            $this->session->set_flashdata('text',"");
			            $this->session->set_flashdata('type',"warning");
			            redirect('Exam/term_details');
					}
				}else{
					$con = $this->Exam_model->term_registration($term);
					if($con == 1){
						$this->session->set_flashdata('active',1);
			            $this->session->set_flashdata('title',"Term submitted.");
			            $this->session->set_flashdata('text',"");
			            $this->session->set_flashdata('type',"success");
			            redirect('Exam/term_details');
			        }else{
						$this->session->set_flashdata('active',1);
			            $this->session->set_flashdata('title',"Term Not Submitted.");
			            $this->session->set_flashdata('text',"");
			            $this->session->set_flashdata('type',"warning");
			            redirect('Exam/term_details');
					}
				}
		    }
		    else
		    {
		      	$this->session->set_flashdata('active',1);
	            $this->session->set_flashdata('title',"Please choose right acadmic year.");
	            $this->session->set_flashdata('text',"");
	            $this->session->set_flashdata('type',"warning");
	            redirect('Exam/term_details');
		    }
		}

		function delete_term($term_id)
		{
			$this->session->set_userdata('term_delete',$term_id);
			redirect('Exam/delete_term_details');
		}

		function delete_term_details()
		{
			$term_id = $this->session->userdata('term_delete');
			$this->db->where('term_id',$term_id)->delete('term');
			$this->session->set_flashdata('active',1);
            $this->session->set_flashdata('title',"Term Deleted Successfully.");
            $this->session->set_flashdata('text',"");
            $this->session->set_flashdata('type',"success");
            redirect('Exam/term_details');
		}

// ------------------------------------------------------------- Grade Details -----------------------------------------------------------------
		function grade_details()
		{
			if(!isset($this->session->userdata['school'])){
				redirect('/');
			}
			if(isset($this->session->userdata['direct'])){
				$admin['direct'] = $this->session->userdata('direct');
			}
			else{
				$admin['direct'] = 1;
			} 

			$exam['flash']['active'] = $this->session->flashdata('active');
	    	$exam['flash']['title'] = $this->session->flashdata('title');
	    	$exam['flash']['text'] = $this->session->flashdata('text');
	    	$exam['flash']['type'] = $this->session->flashdata('type');
	    	
			$school_admin = $this->session->userdata('school');
			$admin['user'] = $school_admin[0]['employee_pri_mobile_number'];
			$admin['user_profile_id'] = $school_admin[0]['employee_profile_id'];
			$admin['employee_type'] = $school_admin[0]['employee_type'];
			$admin['photo'] = $school_admin[0]['employee_photo'];
			$admin['first_name'] = $school_admin[0]['employee_first_name'];
			$admin['last_name'] = $school_admin[0]['employee_last_name'];
			$admin['email_id'] = $school_admin[0]['employee_email_id'];
			$admin['username'] = $school_admin[0]['credential_username'];
			$admin['user_type'] = $school_admin[0]['employee_type'];
			$admin['AY_name'] = $school_admin[0]['AY_name'];
			$school['user_profile_id'] = $school_admin[0]['employee_profile_id'];
			$admin['functionality'] = $this->School_model->fetch_functionality($school);
			$employee_school_profile_id = $school_admin[0]['employee_school_profile_id'];
			$employee_profile_id = $school_admin[0]['employee_profile_id'];
			$school_AY_id = $school_admin[0]['school_AY_id'];
			$exam['grade_details'] = $this->Exam_model->fetch_grade($employee_school_profile_id,$school_AY_id);
			$nav['school_name'] = $school_admin[0]['school_name'];
			$nav['school_logo'] = $school_admin[0]['school_logo'];
			$nav['exam'] = 'grade';
			$this->load->view('School/school_header', $admin);
			$this->load->view('Exam/grade_details',$exam);
			$this->load->view('Exam/exam_footer',$nav);
		}

		function grade_registration()
		{
			$school_admin = $this->session->userdata('school');
			$GC_grade['GC_grade'] = $this->input->post('GC_grade');
			$GC_grade['GC_higher_mark_range'] = $this->input->post('GC_higher_mark_range');
			$GC_grade['GC_lower_mark_range'] = $this->input->post('GC_lower_mark_range');
			$GC_grade['GC_AY_id'] = $school_admin[0]['school_AY_id'];
			$GC_grade['GC_school_profile_id'] = $school_admin[0]['employee_school_profile_id'];
			$mark_verify = $this->Exam_model->grade_mark_verify($GC_grade);
			if($mark_verify[0]['status'] == 1){
				$this->session->set_flashdata('active',1);
	            $this->session->set_flashdata('title',"Grade Mark confict with other grade.");
	            $this->session->set_flashdata('text',"");
	            $this->session->set_flashdata('type',"warning");
	            redirect('Exam/grade_details');
			}
			else{
				$verify = $this->db->where('GC_grade',$GC_grade['GC_grade'])->where('GC_AY_id',$GC_grade['GC_AY_id'])->where('GC_school_profile_id',$GC_grade['GC_school_profile_id'])->get('grade_scale')->num_rows();
				if($verify != 0){
					$this->session->set_flashdata('active',1);
			            $this->session->set_flashdata('title',"Grade Already Submitted.");
			            $this->session->set_flashdata('text',"");
			            $this->session->set_flashdata('type',"warning");
			            redirect('Exam/grade_details');
				}
				else{
					$con = $this->Exam_model->grade_registration($GC_grade);
					if($con == 1){
						$this->session->set_flashdata('active',1);
			            $this->session->set_flashdata('title',"Grade submitted.");
			            $this->session->set_flashdata('text',"");
			            $this->session->set_flashdata('type',"success");
			            redirect('Exam/grade_details');
					}else{
						$this->session->set_flashdata('active',1);
			            $this->session->set_flashdata('title',"Grade Not Submitted.");
			            $this->session->set_flashdata('text',"");
			            $this->session->set_flashdata('type',"warning");
			            redirect('Exam/grade_details');
					}
				}
			}
		}

		function delete_grade($grade_id)
		{
			$this->session->set_userdata('grade_delete',$grade_id);
			redirect('Exam/delete_grade_details');
		}

		function delete_grade_details()
		{
			$grade_id = $this->session->userdata('grade_delete');
			$this->db->where('GC_id',$grade_id)->delete('grade_scale');
			$this->session->set_flashdata('active',1);
            $this->session->set_flashdata('title',"Grade Deleted Successfully.");
            $this->session->set_flashdata('text',"");
            $this->session->set_flashdata('type',"success");
            redirect('Exam/grade_details');
		}

// ------------------------------------------------------------- Exam Details -----------------------------------------------------------------------		
		function exam_details()
		{
			if (isset($this->session->userdata['school'])) {
				$school_admin = $this->session->userdata('school');
        	}elseif (isset($this->session->userdata['teacher'])) {
        		$school_admin = $this->session->userdata('teacher');
        	} 
			if(isset($this->session->userdata['direct'])){
				$admin['direct'] = $this->session->userdata('direct');
			}
			else{
				$admin['direct'] = 1;
			} 

			$exam['flash']['active'] = $this->session->flashdata('active');
	    	$exam['flash']['title'] = $this->session->flashdata('title');
	    	$exam['flash']['text'] = $this->session->flashdata('text');
	    	$exam['flash']['type'] = $this->session->flashdata('type');
	    	
			$admin['user'] = $school_admin[0]['employee_pri_mobile_number'];
			$admin['user_profile_id'] = $school_admin[0]['employee_profile_id'];
			$admin['employee_type'] = $school_admin[0]['employee_type'];
			$admin['photo'] = $school_admin[0]['employee_photo'];
			$admin['first_name'] = $school_admin[0]['employee_first_name'];
			$admin['last_name'] = $school_admin[0]['employee_last_name'];
			$admin['email_id'] = $school_admin[0]['employee_email_id'];
			$admin['username'] = $school_admin[0]['credential_username'];
			$admin['user_type'] = $school_admin[0]['employee_type'];
			$admin['AY_name'] = $school_admin[0]['AY_name'];
			$school['user_profile_id'] = $school_admin[0]['employee_profile_id'];
			$employee_school_profile_id = $school_admin[0]['employee_school_profile_id'];
			$employee_profile_id = $school_admin[0]['employee_profile_id'];
			$school_AY_id = $school_admin[0]['school_AY_id'];
			$exam['school_class'] =  $this->Exam_model->fetch_school_class($employee_school_profile_id);
			$exam['school_class_division'] =  $this->Exam_model->fetch_school_class_division($employee_school_profile_id,$school_AY_id,$employee_profile_id);
			$exam['school_term'] =  $this->Exam_model->fetch_term($employee_school_profile_id,$school_AY_id);
			$this->session->set_userdata('term_for_print',$exam['school_term']);
			$exam['eval_type'] = $this->Exam_model->fetch_eval_type($employee_school_profile_id,$school_AY_id);
			$exam['exam_details'] = $this->Exam_model->fetch_exam($employee_school_profile_id,$school_AY_id);
			$exam['fetch_marks'] =  $this->Exam_model->fetch_marks($employee_school_profile_id,$school_AY_id);

			$exam['school_report_header'] = $school_admin[0]['school_report_header'];
			$exam['school_report_footer'] = $school_admin[0]['school_report_footer'];

			$nav['school_name'] = $school_admin[0]['school_name'];
			$nav['school_logo'] = $school_admin[0]['school_logo'];
			$nav['exam'] = 'exam';

			if (isset($this->session->userdata['school'])) {
				$this->load->view('School/school_header', $admin);
        	}elseif (isset($this->session->userdata['teacher'])) {
				$this->load->view('Teacher/teacher_header', $admin);
        	}
        	// echo "<pre>";print_r($exam);die();
			$this->load->view('Exam/exam_details',$exam);
			$this->load->view('Exam/exam_footer',$nav);
		}

		function view_all()
		{
			if (isset($this->session->userdata['school'])) {
				$school_admin = $this->session->userdata('school');
        	}elseif (isset($this->session->userdata['teacher'])) {
        		$school_admin = $this->session->userdata('teacher');
        	} 

			$employee_school_profile_id = $school_admin[0]['employee_school_profile_id'];
			$school_AY_id = $school_admin[0]['school_AY_id'];

			$term_id = $_POST['term_id'];

			$subject_class = $_POST['class_id'];
			$result = explode('-',$subject_class);
			$class_id = $result[0];
			$division_id = $result[1];

			$data['subject'] = $this->db->query("SELECT 
												   exam_subject_id
												   ,subject_name
												   ,count(*) as eval_count
												from exam
												join subject
												   on exam_subject_id=subject_id
												where
												   exam_school_profile_id=".$employee_school_profile_id."
												    and exam_term_id=".$term_id."
												    and exam_class_id=".$class_id."
												    and exam_eval_id in (
												        select
												            eval_id
												        from evaluation
												        WHERE
												            eval_school_profile_id=".$employee_school_profile_id."
												            and eval_type='2'
												    )
												group by
												   exam_subject_id
												order by
												   exam_subject_id")->result_array();


			$data['evaluation'] = $this->db->query("SELECT 
													exam_subject_id
													    ,exam_eval_id
													    ,subject_name
													    ,eval_name
													,exam_outoff_marks as exam_marksheet_marks
													from exam
													join subject
													on exam_subject_id=subject_id
													join evaluation
													on exam_eval_id=eval_id
													    and eval_type=2
													where
													exam_school_profile_id=".$employee_school_profile_id."
													    and exam_term_id=".$term_id."
													    and exam_class_id=".$class_id."
													order by
													exam_subject_id
													    ,eval_name DESC")->result_array();

			
			$data['student'] = $this->db->query("SELECT 
													student_profile_id
													    ,concat(student_first_name,' ',student_middle_name,' ',student_last_name) as student_name
													    ,division_name
													,SCD_Roll_No
													,student_GRN
													,exam_id
													,exam_subject_id
													,eval_name
													,case when marks_obtained is NULL then '-' else marks_obtained end as marks_marksheet
													,exam_outoff_marks as exam_marksheet_marks
													FROM student_class_division_assgn
													join student
													on student_profile_id=SCD_student_profile_id
													join division
													on division_id=SCD_division_id
													cross join
													(
													select
													exam_id
													,exam_subject_id
													,eval_id
													,eval_name
													,exam_outoff_marks
													from exam
													join evaluation
													on exam_eval_id=eval_id
													and eval_type=2
													where
													exam_school_profile_id=".$employee_school_profile_id."
													and exam_term_id=".$term_id."
													and exam_class_id=".$class_id."
													)as subject
													left join marks
													on marks_exam_id=exam_id
													and marks_student_id=student_profile_id
													and marks_status='1'
													where
													SCD_school_profile_id=".$employee_school_profile_id."
													and SCD_class_id=".$class_id."
													    and SCD_division_id=".$division_id."
													    and SCD_AY_id=".$school_AY_id."
													    and SCD_expiry_date='9999-12-31'
													order by
													division_name
													    ,SCD_Roll_No
													,student_GRN
													,exam_subject_id
													,eval_name DESC")->result_array();
			echo json_encode($data);
		}

		function view_all_report()
		{
			if (isset($this->session->userdata['school'])) {
				$school_admin = $this->session->userdata('school');
        	}elseif (isset($this->session->userdata['teacher'])) {
        		$school_admin = $this->session->userdata('teacher');
        	} 

			$employee_school_profile_id = $school_admin[0]['employee_school_profile_id'];
			$school_AY_id = $school_admin[0]['school_AY_id'];

			$term_id = $_POST['term_id'];
			$data['term_id'] = $term_id;

			$subject_class = $_POST['class_id'];
			$result = explode('-',$subject_class);
			$class_id = $result[0];
			$data['class_id'] = $class_id;
			$division_id = $result[1];
			$data['division_id'] = $division_id;

			$data['subject_report'] = $this->db->query("SELECT 
												   exam_subject_id
												   ,subject_name
												from exam
												join subject
												   on exam_subject_id=subject_id
												where
												   exam_school_profile_id=".$employee_school_profile_id."
												    and exam_term_id=".$term_id."
												    and exam_class_id=".$class_id."
												    and exam_eval_id in (
												        select
												            eval_id
												        from evaluation
												        WHERE
												            eval_school_profile_id=".$employee_school_profile_id."
												            and eval_type='2'
												    )
												group by
												   exam_subject_id
												order by
												   exam_subject_id")->result_array();

			$data['student_grades'] = $this->db->query("select 
															result_data.* 
															,GC_grade
														from 
														(
															SELECT
																data.*
																,case when mark is NULL then 0 else mark end as marks
																,case when total_mark is NULL then 0 else total_mark end as total_marks
															from
															(
																SELECT 
																	student_profile_id
																	,concat(student_first_name,' ',student_middle_name,' ',student_last_name) as student_name
																	,SCD_Roll_No
																	,student_GRN
																	,exam_subject_id
																	,sum(marks_obtained) as mark
																	,sum(exam_outoff_marks) as total_mark
																	,SF_id
																	,SF_special_remark_1
																	,SF_Int_Hob_1
																	,SF_Improvement_need_1
																	,balance
																FROM student_class_division_assgn
																join student
																	on student_profile_id=SCD_student_profile_id
																join division
																	on division_id=SCD_division_id
																left join student_feedback
																	on SF_student_profile_id=student_profile_id
																	and sf_term_id=".$term_id."
																cross join
																(
																	select
																		exam_id
																		,exam_subject_id
																		,eval_id
																		,eval_name
																		,exam_outoff_marks
																	from exam
																	join evaluation
																		on exam_eval_id=eval_id
																		and eval_type=2
																	where
																		exam_school_profile_id=".$employee_school_profile_id."
																		and exam_term_id=".$term_id."
																		and exam_class_id=".$class_id."
																)as subject
																left join marks
																	on marks_exam_id=exam_id
																	and marks_student_id=student_profile_id
																	and marks_status='1'
																left join
																(
																	SELECT 
																	Student_profile_id as std_id
																	,case 
																		when fee_waiver_amount is NULL and fee_amount is NULL AND total_fee_amount is NULL then '0' 
																		when fee_waiver_amount is NULL and fee_amount is NULL then (total_fee_amount-student_total_advance_payment) 
																		when fee_waiver_amount is NULL then (total_fee_amount-fee_amount-student_total_advance_payment) 
																		when fee_amount is NULL then (total_fee_amount-fee_waiver_amount-student_total_advance_payment) 
																		else (total_fee_amount-fee_waiver_amount-fee_amount-student_total_advance_payment) 
																	end as balance 
																	from student
																	join school 
																		on student_school_profile_id=school_profile_id 
																	left join 
																	(
																		select 
																			total_fee_student_profile_id,sum(total_fee_amount) as total_fee_amount
																			,total_fee_AY_id 
																		from total_fees 
																		group by total_fee_student_profile_id
																	) as total_fees 
																		on total_fee_student_profile_id=student_profile_id 
																		and total_fee_AY_id=school_AY_id 
																	left join 
																	(
																		select 
																			fee_waiver_student_profile_id
																			,sum(fee_waiver_amount) as fee_waiver_amount
																			,fee_waiver_AY_id 
																		from fee_waiver 
																		group by fee_waiver_student_profile_id
																	) as fee_waiver 
																		on fee_waiver_student_profile_id=student_profile_id 
																		and fee_waiver_AY_id=school_AY_id 
																	left join 
																	(
																		select 
																			fee_student_profile_id
																			,sum(fee_amount) as fee_amount
																			,fee_AY_id 
																		from fee 
																		group by fee_student_profile_id
																	) as fee 
																		on fee_student_profile_id=student_profile_id 
																		and fee_AY_id=school_AY_id 
																	where 
																		student_school_profile_id=".$employee_school_profile_id."
																		and student_expiry_date='9999-12-31' 
																	order by student_GRN
																)as fee_status
																	on Student_profile_id=std_id	
																where
																	SCD_school_profile_id=".$employee_school_profile_id."
																	and SCD_class_id=".$class_id."
																	and SCD_division_id=".$division_id."
																	and SCD_AY_id=".$school_AY_id."
																	and SCD_expiry_date='9999-12-31'
																group by 
																	student_profile_id
																	,exam_subject_id
																order by
																	SCD_Roll_No
																	,student_GRN
																	,exam_subject_id
															)as data
															order by
																	SCD_Roll_No
																	,student_GRN
																	,exam_subject_id
														)as result_data,grade_scale 
														where (marks*100)/total_marks between GC_lower_mark_range and GC_higher_mark_range
														and  GC_AY_id=".$school_AY_id." and GC_school_profile_id=".$employee_school_profile_id."
														order by
																	SCD_Roll_No
																	,student_GRN
																	,exam_subject_id
															")->result_array();
			echo json_encode($data);
		}

		

		function fetch_class_report_student()
		{
			if (isset($this->session->userdata['school'])) {
				$school_admin = $this->session->userdata('school');
        	}elseif (isset($this->session->userdata['teacher'])) {
        		$school_admin = $this->session->userdata('teacher');
        	} 

			$employee_school_profile_id = $school_admin[0]['employee_school_profile_id'];
			$school_AY_id = $school_admin[0]['school_AY_id'];

			$term_id = $_POST['term_id'];

			$subject_class = $_POST['class_id'];
			$result = explode('-',$subject_class);
			$class_id = $result[0];
			$division_id = $result[1];

			$data['student'] = $this->db->query("SELECT 
														student_profile_id
													    ,concat(student_first_name,' ',student_middle_name,' ',student_last_name) as student_name
													FROM student_class_division_assgn
													join student
														on student_profile_id=SCD_student_profile_id
													where
													SCD_school_profile_id=".$employee_school_profile_id."
														and SCD_class_id=".$class_id."
													    and SCD_division_id=".$division_id."
													    and SCD_AY_id=".$school_AY_id."
													    and SCD_expiry_date='9999-12-31'
													order by
														SCD_Roll_No")->result_array();
			echo json_encode($data);
		}

		function eval_details()
		{
			if (isset($this->session->userdata['school'])) {
				$school_admin = $this->session->userdata('school');
        	}elseif (isset($this->session->userdata['teacher'])) {
        		$school_admin = $this->session->userdata('teacher');
        	} 

			$employee_school_profile_id = $school_admin[0]['employee_school_profile_id'];
			$school_AY_id = $school_admin[0]['school_AY_id'];
			$data['user_type'] = $school_admin[0]['employee_type'];

			$term_id = $_POST['term_id'];
			$class_id = $_POST['class_id'];
			$eval_id = $_POST['eval_id'];
			$data['exam'] = $this->db->query("
												SELECT 
													exam.*
													,term_name
													,class_name
													,subject_name
													,eval_name 
												FROM exam 
												join term 
													on exam_term_id= term_id 
												join evaluation 
													on eval_id = exam_eval_id 
												join class 
													on exam_class_id=class_id 
												join subject 
													on exam_subject_id=subject_id 
												where 
													exam_school_profile_id =".$employee_school_profile_id." 
													and exam_AY_id =".$school_AY_id." 
													AND exam_term_id = ".$term_id." 
													AND exam_class_id = ".$class_id." 
													AND exam_eval_id = ".$eval_id."
											")->result_array();
			$data['subject'] = $this->db->query("SELECT 
												subject_id
												,subject_name
												from subject
												left join exam
												on exam_subject_id=subject_id
												    and exam_AY_id=".$school_AY_id."
												and exam_term_id=".$term_id."
												and exam_eval_id=".$eval_id."
												where
												subject_school_profile_id=".$employee_school_profile_id."
												and subject_expiry_date='9999-12-31'
												and subject_class_id=".$class_id."
												and exam_id is NULL")->result_array();
			echo json_encode($data);
		}
		function eval_details_class()
		{
			if (isset($this->session->userdata['school'])) {
				$school_admin = $this->session->userdata('school');
        	}elseif (isset($this->session->userdata['teacher'])) {
        		$school_admin = $this->session->userdata('teacher');
        	} 

			$employee_school_profile_id = $school_admin[0]['employee_school_profile_id'];
			$school_AY_id = $school_admin[0]['school_AY_id'];
			$data['user_type'] = $school_admin[0]['employee_type'];

			$term_id = $_POST['term_id'];
			$class_id = $_POST['class_id'];
			// $eval_id = $_POST['eval_id'];
			$data['exam'] = $this->db->query("SELECT exam.*,term_name,class_name,subject_name,eval_name FROM exam join term on exam_term_id= term_id join evaluation on eval_id = exam_eval_id join class on exam_class_id=class_id join subject on exam_subject_id=subject_id where exam_school_profile_id =".$employee_school_profile_id." and exam_AY_id =".$school_AY_id." AND exam_term_id = ".$term_id." AND exam_class_id = ".$class_id." ")->result_array();
			$data['subject'] = $this->db->query("SELECT 
												subject_id
												,subject_name
												from subject
												left join exam
												on exam_subject_id=subject_id
												    and exam_AY_id=".$school_AY_id."
												and exam_term_id=".$term_id."
												where
												subject_school_profile_id=".$employee_school_profile_id."
												and subject_expiry_date='9999-12-31'
												and subject_class_id=".$class_id."
												and exam_id is NULL")->result_array();
			echo json_encode($data);
		}
		function eval_details_term()
		{
			if (isset($this->session->userdata['school'])) {
				$school_admin = $this->session->userdata('school');
        	}elseif (isset($this->session->userdata['teacher'])) {
        		$school_admin = $this->session->userdata('teacher');
        	} 

			$employee_school_profile_id = $school_admin[0]['employee_school_profile_id'];
			$school_AY_id = $school_admin[0]['school_AY_id'];
			$data['user_type'] = $school_admin[0]['employee_type'];

			$term_id = $_POST['term_id'];
			// $class_id = $_POST['class_id'];
			// $eval_id = $_POST['eval_id'];
			$data['exam'] = $this->db->query("SELECT exam.*,term_name,class_name,subject_name,eval_name FROM exam join term on exam_term_id= term_id join evaluation on eval_id = exam_eval_id join class on exam_class_id=class_id join subject on exam_subject_id=subject_id where exam_school_profile_id =".$employee_school_profile_id." and exam_AY_id =".$school_AY_id." AND exam_term_id = ".$term_id." ")->result_array();
			$data['subject'] = $this->db->query("SELECT 
												subject_id
												,subject_name
												from subject
												left join exam
												on exam_subject_id=subject_id
												    and exam_AY_id=".$school_AY_id."
												and exam_term_id=".$term_id."
												where
												subject_school_profile_id=".$employee_school_profile_id."
												and subject_expiry_date='9999-12-31'
												and exam_id is NULL")->result_array();
			echo json_encode($data);
		}

		function eval_details_default()
		{
			if (isset($this->session->userdata['school'])) {
				$school_admin = $this->session->userdata('school');
        	}elseif (isset($this->session->userdata['teacher'])) {
        		$school_admin = $this->session->userdata('teacher');
        	} 

			$employee_school_profile_id = $school_admin[0]['employee_school_profile_id'];
			$school_AY_id = $school_admin[0]['school_AY_id'];
			$data['user_type'] = $school_admin[0]['employee_type'];

			$data['exam'] = $this->Exam_model->fetch_exam($employee_school_profile_id,$school_AY_id);
			$data['subject'] = $this->db->query("SELECT 
												subject_id
												,subject_name
												from subject
												left join exam
												on exam_subject_id=subject_id
												    and exam_AY_id=".$school_AY_id."
												where
												subject_school_profile_id=".$employee_school_profile_id."
												and subject_expiry_date='9999-12-31'
												and exam_id is NULL")->result_array();
			echo json_encode($data);
		}


		function subject_details_class()
		{
			$school_admin = $this->session->userdata('school');
			$subject['subject_school_profile_id'] = $school_admin[0]['employee_school_profile_id'];
			$subject['class_id'] = $_POST['class_id'];
			$data['subject'] = $this->Exam_model->fetch_school_subject($subject);
			$data['eval'] = $this->db->query("SELECT * FROM `evaluation` WHERE eval_school_profile_id = ".$subject['subject_school_profile_id']."")->result_array();

			// $data = "SELECT subject_id,subject_name,eval_name from subject join evaluation on subject_eval_id = eval_id where subject_school_profile_id =".$subject['subject_school_profile_id']." and subject_expiry_date = '9999-12-31' and subject_class_id =".$subject['class_id']."";
			echo json_encode($data);
		}

		function exam_registration()
		{
			if (isset($this->session->userdata['school'])) {
				$school_admin = $this->session->userdata('school');
        	}elseif (isset($this->session->userdata['teacher'])) {
        		$school_admin = $this->session->userdata('teacher');
        	} 
			if(isset($this->session->userdata['direct'])){
				$admin['direct'] = $this->session->userdata('direct');
			}
			else{
				$admin['direct'] = 1;
			} 

			$exam['exam_term_id'] = $_POST['exam_term_id'];
			$exam['exam_class_id'] = $_POST['class_details'];
			$exam['exam_subject_id'] = $_POST['class_subject'];
			$exam['exam_eval_id'] = $_POST['eval_details'];
			$exam['exam_result_date'] = $_POST['exam_result_date'];
			$exam['exam_start_date'] = $_POST['exam_start_date'];
			$exam['exam_end_date'] = $_POST['exam_end_date'];
			$exam['exam_start_time'] = $_POST['exam_start_time'];
			$exam['exam_end_time'] = $_POST['exam_end_time'];
			$exam['exam_marksheet_marks'] = $_POST['exam_marksheet_marks'];
			$exam['exam_outoff_marks'] = $_POST['exam_outoff_marks'];
			$exam['exam_evaluation_marks'] = $_POST['exam_evaluation_marks'];

			$exam['exam_school_profile_id'] = $school_admin[0]['employee_school_profile_id'];
			$exam['exam_AY_id'] = $school_admin[0]['school_AY_id'];

			
			$this->Exam_model->exam_registration($exam);
			echo json_encode($exam);
		}

		function delete_exam($exam_id)
		{
			$this->session->set_userdata('exam',$exam_id);
			redirect('Exam/delete_exam_details');
		}

		function delete_exam_details()
		{
			$exam_id = $this->session->userdata('exam');
			$con = $this->db->where('exam_id',$exam_id)->delete('exam');
			$this->session->set_flashdata('active',1);
            $this->session->set_flashdata('title',"Exam Deleted Successfully.");
            $this->session->set_flashdata('text',"");
            $this->session->set_flashdata('type',"success");
            redirect('Exam/exam_details');
		}
		function print_exam_schedule()
		{
			if (isset($this->session->userdata['school'])) {
				$school_admin = $this->session->userdata('school');
        	}elseif (isset($this->session->userdata['teacher'])) {
        		$school_admin = $this->session->userdata('teacher');
        	} 
			if(isset($this->session->userdata['direct'])){
				$admin['direct'] = $this->session->userdata('direct');
			}
			else{
				$admin['direct'] = 1;
			} 

			$class_id = $this->input->post('printOut_class_id');
			$term_id = $this->input->post('printOut_term_id');
			$eval_id = implode(',', $this->input->post('printOut_eval_id'));
			$data['exam_details'] = $this->db->query("SELECT term_name,class_name, subject_name,eval_name,DATE_FORMAT(exam_start_date,'%d %M %Y') as exam_date,exam_start_time,exam_end_time,exam_result_date,exam_marksheet_marks FROM `exam` join term on exam_term_id = term_id join class on exam_class_id = class_id join subject on exam_subject_id = subject_id join evaluation on exam_eval_id = eval_id where exam_AY_id = ".$school_admin[0]['school_AY_id']." and exam_school_profile_id = ".$school_admin[0]['employee_school_profile_id']." and exam_subject_id IN (select subject.subject_id from subject where subject.subject_class_id = ".$class_id.") and exam_term_id =".$term_id." AND exam_eval_id IN (".$eval_id.")")->result_array();
			$data['school_report_header'] = $school_admin[0]['school_report_header'];
			$data['school_report_footer'] = $school_admin[0]['school_report_footer'];
			$this->load->view('Exam/exam_schedule_print',$data);
		}
		function print_exam_schedule_view()
		{
			if (isset($this->session->userdata['school'])) {
				$school_admin = $this->session->userdata('school');
        	}elseif (isset($this->session->userdata['teacher'])) {
        		$school_admin = $this->session->userdata('teacher');
        	} 
			if(isset($this->session->userdata['direct'])){
				$admin['direct'] = $this->session->userdata('direct');
			}
			else{
				$admin['direct'] = 1;
			} 

			$class_id = $_POST['printOut_class_id'];
			$term_id = $_POST['printOut_term_id'];
			$eval_id = $_POST['printOut_eval_id'];

			$data = $this->db->query("SELECT term_name,class_name, subject_name,eval_name,DATE_FORMAT(exam_start_date,'%d %M %Y') as exam_date,exam_start_time,exam_end_time,exam_result_date,exam_marksheet_marks FROM `exam` join term on exam_term_id = term_id join class on exam_class_id = class_id join subject on exam_subject_id = subject_id join evaluation on exam_eval_id = eval_id where exam_AY_id = ".$school_admin[0]['school_AY_id']." and exam_school_profile_id = ".$school_admin[0]['employee_school_profile_id']." and exam_subject_id IN (select subject.subject_id from subject where subject.subject_class_id = ".$class_id.") and exam_term_id =".$term_id." AND exam_eval_id IN (".$eval_id.")")->result_array();

			echo json_encode($data);
		}

		function save_remark()
		{
			$data['SF_student_profile_id'] = $_POST['student_profile_id'];
			$data['sf_term_id'] = $_POST['term_id'];
			$SF_id = $_POST['SF_id'];
			$data['SF_special_remark_1 '] = $_POST['SF_SR'];
			$data['SF_Int_Hob_1'] = $_POST['SF_IH'];
			$data['SF_Improvement_need_1'] = $_POST['SF_IN'];

			if ($SF_id == "0")
			{
				$this->db->insert('student_feedback',$data);
			}else{
				$data['SF_id'] = $SF_id;
				$this->db->set($data)->where('SF_id',$data['SF_id'])->update("student_feedback", $data);
			}

			echo json_encode($SF_id);
		}

		function set_print_data()
		{
			$data['student_profile_id'] = $_POST['student_profile_id'];
			$data['term_id'] = $_POST['term_id'];
			$data['class_id'] = $_POST['class_id'];
			$data['division_id'] = $_POST['division_id'];

			$this->session->set_userdata('data',$data);

			echo json_encode($data);
		}

		function report_card_student()
		{
			if (isset($this->session->userdata['school'])) {
				$school_admin = $this->session->userdata('school');
        	}elseif (isset($this->session->userdata['teacher'])) {
        		$school_admin = $this->session->userdata('teacher');
        	} 

			$employee_school_profile_id = $school_admin[0]['employee_school_profile_id'];
			$school_AY_id = $school_admin[0]['school_AY_id'];

			$data1 = $this->session->userdata('data');

			$student_id = $data1['student_profile_id'];
			$term_id = $data1['term_id'];
			$class_id = $data1['class_id'];
			$division_id = $data1['division_id'];

			$data['query1'] = $this->db->query("SELECT 
												student_profile_id
												,student_GRN
												,concat(student_last_name,' ',student_first_name,' ',student_middle_name) as student_name
												,date_format(student_DOB,'%W, %D %M %Y') as DOB
												,student_adhar_card_number
												,student_photo
												,student_birth_place
												,student_nationality
												,student_category
												,student_gender
												,class_name
												,division_name
												,SCD_Roll_No
												,father_name
												,mother_name
												,case 
													when student_present_house_no='' or student_present_house_no is NULL then concat(student_present_town,', ',student_present_tal,', ',student_present_dist,' - ',student_present_pincode)
													else concat(student_present_house_no,', ',student_present_town,', ',student_present_tal,', ',student_present_dist,'- ',student_present_pincode) 
												end as address
												from student_class_division_assgn
												join student
												on SCD_student_profile_id=student_profile_id
												and SCD_student_profile_id=".$student_id."
												join class
												on class_id=SCD_class_id
												join division
												on division_id=SCD_division_id
												left join
												(
												select
												parent_student_profile_id as father_std_id
												,concat(parent_last_name,' ',parent_first_name,' ',parent_middle_name) as father_name
												from parent
												where
												parent_type=1
												and parent_student_profile_id= ".$student_id."
												and parent_expiry_date='9999-12-31'
												)as father
												on father_std_id=student_profile_id
												left join
												(
												select
												parent_student_profile_id as mother_std_id
												,concat(parent_last_name,' ',parent_first_name,' ',parent_middle_name) as mother_name
												from parent
												where
												parent_student_profile_id= ".$student_id."
												and parent_expiry_date='9999-12-31'
												and parent_type=2
												)as mother
												on mother_std_id=student_profile_id")->result_array();

			$data['query3'] = $this->db->query("SELECT 
												SCD_student_profile_id
												,present6
												,present7
												,present8
												,present9
												,present10
												,present11
												,present12
												,present1
												,present2
												,present3
												,present4
												,absent6
												,absent7
												,absent8
												,absent9
												,absent10
												,absent11
												,absent12
												,absent1
												,absent2
												,absent3
												,absent4
												,holiday6
												,holiday7
												,holiday8
												,holiday9
												,holiday10
												,holiday11
												,holiday12
												,holiday1
												,holiday2
												,holiday3
												,holiday4
												,c6_count
												,c7_count
												,c8_count
												,c9_count
												,c10_count
												,c11_count
												,c12_count
												,c1_count
												,c2_count
												,c3_count
												,c4_count
												from student_class_division_assgn
												left join
												(
												SELECT
												attend_SCD_id as p6
												,count(*) as present6
												FROM attendance
												where
												attend_school_profile_id=".$employee_school_profile_id."
												and attend_status='P'
												and date_format(attend_datetime,'%Y-%m') in (SELECT concat(SUBSTRING(AY_name, 1, 4),'-06') FROM `academic_year` where AY_id=2)
												group by 1
												order by 1
												)as p_jun
												on p6=scd_id
												left join
												(
												SELECT
												attend_SCD_id as p7
												,count(*) as present7
												FROM `attendance`
												where
												attend_school_profile_id=".$employee_school_profile_id."
												and attend_status='P'
												and date_format(attend_datetime,'%Y-%m') in (SELECT concat(SUBSTRING(AY_name, 1, 4),'-07') FROM `academic_year` where AY_id=2)
												group by 1
												order by 1
												)as p_jul
												on p7=scd_id
												left join
												(
												SELECT
												attend_SCD_id as p8
												,count(*) as present8
												FROM `attendance`
												where
												attend_school_profile_id=".$employee_school_profile_id."
												and attend_status='P'
												and date_format(attend_datetime,'%Y-%m') in (SELECT concat(SUBSTRING(AY_name, 1, 4),'-08') FROM `academic_year` where AY_id=".$school_AY_id.")
												group by 1
												order by 1
												)as p_p_ug
												on p8=scd_id
												left join
												(
												SELECT
												attend_SCD_id as p9
												,count(*) as present9
												FROM `attendance`
												where
												attend_school_profile_id=".$employee_school_profile_id."
												and attend_status='P'
												and date_format(attend_datetime,'%Y-%m') in (SELECT concat(SUBSTRING(AY_name, 1, 4),'-09') FROM `academic_year` where AY_id=".$school_AY_id.")
												group by 1
												order by 1
												)as p_sep
												on p9=scd_id
												left join
												(
												SELECT
												attend_SCD_id as p10
												,count(*) as present10
												FROM `attendance`
												where
												attend_school_profile_id=".$employee_school_profile_id."
												and attend_status='P'
												and date_format(attend_datetime,'%Y-%m') in (SELECT concat(SUBSTRING(AY_name, 1, 4),'-10') FROM `academic_year` where AY_id=".$school_AY_id.")
												group by 1
												order by 1
												)as p_oct
												on p10=scd_id
												left join
												(
												SELECT
												attend_SCD_id as p11
												,count(*) as present11
												FROM `attendance`
												where
												attend_school_profile_id=".$employee_school_profile_id."
												and attend_status='P'
												and date_format(attend_datetime,'%Y-%m') in (SELECT concat(SUBSTRING(AY_name, 1, 4),'-11') FROM `academic_year` where AY_id=".$school_AY_id.")
												group by 1
												order by 1
												)as p_nov
												on p11=scd_id
												left join
												(
												SELECT
												attend_SCD_id as p12
												,count(*) as present12
												FROM `attendance`
												where
												attend_school_profile_id=".$employee_school_profile_id."
												and attend_status='P'
												and date_format(attend_datetime,'%Y-%m') in (SELECT concat(SUBSTRING(AY_name, 1, 4),'-12') FROM `academic_year` where AY_id=".$school_AY_id.")
												group by 1
												order by 1
												)as p_decem
												on p12=scd_id
												left join
												(
												SELECT
												attend_SCD_id as p1
												,count(*) as present1
												FROM `attendance`
												where
												attend_school_profile_id=".$employee_school_profile_id."
												and attend_status='P'
												and date_format(attend_datetime,'%Y-%m') in (SELECT concat(SUBSTRING(AY_name, 6, 4),'-01') FROM `academic_year` where AY_id=".$school_AY_id.")
												group by 1
												order by 1
												)as p_jan
												on p1=scd_id
												left join
												(
												SELECT
												attend_SCD_id as p2
												,count(*) as present2
												FROM `attendance`
												where
												attend_school_profile_id=".$employee_school_profile_id."
												and attend_status='P'
												and date_format(attend_datetime,'%Y-%m') in (SELECT concat(SUBSTRING(AY_name, 6, 4),'-02') FROM `academic_year` where AY_id=".$school_AY_id.")
												group by 1
												order by 1
												)as p_feb
												on p2=scd_id
												left join
												(
												SELECT
												attend_SCD_id as p3
												,count(*) as present3
												FROM `attendance`
												where
												attend_school_profile_id=".$employee_school_profile_id."
												and attend_status='P'
												and date_format(attend_datetime,'%Y-%m') in (SELECT concat(SUBSTRING(AY_name, 6, 4),'-03') FROM `academic_year` where AY_id=".$school_AY_id.")
												group by 1
												order by 1
												)as p_mar
												on p3=scd_id
												left join
												(
												SELECT
												attend_SCD_id as p4
												,count(*) as present4
												FROM `attendance`
												where
												attend_school_profile_id=".$employee_school_profile_id."
												and attend_status='P'
												and date_format(attend_datetime,'%Y-%m') in (SELECT concat(SUBSTRING(AY_name, 6, 4),'-04') FROM `academic_year` where AY_id=".$school_AY_id.")
												group by 1
												order by 1
												)as p_p_pr
												on p4=scd_id
												left join
												(
												SELECT
												attend_SCD_id as a6
												,count(*) as absent6
												FROM attendance
												where
												attend_school_profile_id=".$employee_school_profile_id."
												and attend_status='A'
												and date_format(attend_datetime,'%Y-%m') in (SELECT concat(SUBSTRING(AY_name, 1, 4),'-06') FROM `academic_year` where AY_id=".$school_AY_id.")
												group by 1
												order by 1
												)as a_jun
												on a6=scd_id
												left join
												(
												SELECT
												attend_SCD_id as a7
												,count(*) as absent7
												FROM `attendance`
												where
												attend_school_profile_id=".$employee_school_profile_id."
												and attend_status='A'
												and date_format(attend_datetime,'%Y-%m') in (SELECT concat(SUBSTRING(AY_name, 1, 4),'-07') FROM `academic_year` where AY_id=".$school_AY_id.")
												group by 1
												order by 1
												)as a_jul
												on a7=scd_id
												left join
												(
												SELECT
												attend_SCD_id as a8
												,count(*) as absent8
												FROM `attendance`
												where
												attend_school_profile_id=".$employee_school_profile_id."
												and attend_status='A'
												and date_format(attend_datetime,'%Y-%m') in (SELECT concat(SUBSTRING(AY_name, 1, 4),'-08') FROM `academic_year` where AY_id=".$school_AY_id.")
												group by 1
												order by 1
												)as a_aug
												on a8=scd_id
												left join
												(
												SELECT
												attend_SCD_id as a9
												,count(*) as absent9
												FROM `attendance`
												where
												attend_school_profile_id=".$employee_school_profile_id."
												and attend_status='A'
												and date_format(attend_datetime,'%Y-%m') in (SELECT concat(SUBSTRING(AY_name, 1, 4),'-09') FROM `academic_year` where AY_id=".$school_AY_id.")
												group by 1
												order by 1
												)as a_sep
												on a9=scd_id
												left join
												(
												SELECT
												attend_SCD_id as a10
												,count(*) as absent10
												FROM `attendance`
												where
												attend_school_profile_id=".$employee_school_profile_id."
												and attend_status='A'
												and date_format(attend_datetime,'%Y-%m') in (SELECT concat(SUBSTRING(AY_name, 1, 4),'-10') FROM `academic_year` where AY_id=".$school_AY_id.")
												group by 1
												order by 1
												)as a_oct
												on a10=scd_id
												left join
												(
												SELECT
												attend_SCD_id as a11
												,count(*) as absent11
												FROM `attendance`
												where
												attend_school_profile_id=".$employee_school_profile_id."
												and attend_status='A'
												and date_format(attend_datetime,'%Y-%m') in (SELECT concat(SUBSTRING(AY_name, 1, 4),'-11') FROM `academic_year` where AY_id=".$school_AY_id.")
												group by 1
												order by 1
												)as a_nov
												on a11=scd_id
												left join
												(
												SELECT
												attend_SCD_id as a12
												,count(*) as absent12
												FROM `attendance`
												where
												attend_school_profile_id=".$employee_school_profile_id."
												and attend_status='A'
												and date_format(attend_datetime,'%Y-%m') in (SELECT concat(SUBSTRING(AY_name, 1, 4),'-12') FROM `academic_year` where AY_id=".$school_AY_id.")
												group by 1
												order by 1
												)as a_decem
												on a12=scd_id
												left join
												(
												SELECT
												attend_SCD_id as a1
												,count(*) as absent1
												FROM `attendance`
												where
												attend_school_profile_id=".$employee_school_profile_id."
												and attend_status='A'
												and date_format(attend_datetime,'%Y-%m') in (SELECT concat(SUBSTRING(AY_name, 6, 4),'-01') FROM `academic_year` where AY_id=".$school_AY_id.")
												group by 1
												order by 1
												)as a_jan
												on a1=scd_id
												left join
												(
												SELECT
												attend_SCD_id as a2
												,count(*) as absent2
												FROM `attendance`
												where
												attend_school_profile_id=".$employee_school_profile_id."
												and attend_status='A'
												and date_format(attend_datetime,'%Y-%m') in (SELECT concat(SUBSTRING(AY_name, 6, 4),'-02') FROM `academic_year` where AY_id=".$school_AY_id.")
												group by 1
												order by 1
												)as a_feb
												on a2=scd_id
												left join
												(
												SELECT
												attend_SCD_id as a3
												,count(*) as absent3
												FROM `attendance`
												where
												attend_school_profile_id=".$employee_school_profile_id."
												and attend_status='A'
												and date_format(attend_datetime,'%Y-%m') in (SELECT concat(SUBSTRING(AY_name, 6, 4),'-03') FROM `academic_year` where AY_id=".$school_AY_id.")
												group by 1
												order by 1
												)as a_mar
												on a3=scd_id
												left join
												(
												SELECT
												attend_SCD_id as a4
												,count(*) as absent4
												FROM `attendance`
												where
												attend_school_profile_id=".$employee_school_profile_id."
												and attend_status='A'
												and date_format(attend_datetime,'%Y-%m') in (SELECT concat(SUBSTRING(AY_name, 6, 4),'-04') FROM `academic_year` where AY_id=".$school_AY_id.")
												group by 1
												order by 1
												)as a_apr
												on a4=scd_id
												left join
												(
												SELECT
												attend_SCD_id as h6
												,count(*) as holiday6
												FROM attendance
												where
												attend_school_profile_id=".$employee_school_profile_id."
												and attend_status in ('H','W')
												and date_format(attend_datetime,'%Y-%m') in (SELECT concat(SUBSTRING(AY_name, 1, 4),'-06') FROM `academic_year` where AY_id=".$school_AY_id.")
												group by 1
												order by 1
												)as h_jun
												on h6=scd_id
												left join
												(
												SELECT
												attend_SCD_id as h7
												,count(*) as holiday7
												FROM `attendance`
												where
												attend_school_profile_id=".$employee_school_profile_id."
												and attend_status in ('H','W')
												and date_format(attend_datetime,'%Y-%m') in (SELECT concat(SUBSTRING(AY_name, 1, 4),'-07') FROM `academic_year` where AY_id=".$school_AY_id.")
												group by 1
												order by 1
												)as h_jul
												on h7=scd_id
												left join
												(
												SELECT
												attend_SCD_id as h8
												,count(*) as holiday8
												FROM `attendance`
												where
												attend_school_profile_id=".$employee_school_profile_id."
												and attend_status in ('H','W')
												and date_format(attend_datetime,'%Y-%m') in (SELECT concat(SUBSTRING(AY_name, 1, 4),'-08') FROM `academic_year` where AY_id=".$school_AY_id.")
												group by 1
												order by 1
												)as h_aug
												on h8=scd_id
												left join
												(
												SELECT
												attend_SCD_id as h9
												,count(*) as holiday9
												FROM `attendance`
												where
												attend_school_profile_id=".$employee_school_profile_id."
												and attend_status in ('H','W')
												and date_format(attend_datetime,'%Y-%m') in (SELECT concat(SUBSTRING(AY_name, 1, 4),'-09') FROM `academic_year` where AY_id=".$school_AY_id.")
												group by 1
												order by 1
												)as h_sep
												on h9=scd_id
												left join
												(
												SELECT
												attend_SCD_id as h10
												,count(*) as holiday10
												FROM `attendance`
												where
												attend_school_profile_id=".$employee_school_profile_id."
												and attend_status in ('H','W')
												and date_format(attend_datetime,'%Y-%m') in (SELECT concat(SUBSTRING(AY_name, 1, 4),'-10') FROM `academic_year` where AY_id=".$school_AY_id.")
												group by 1
												order by 1
												)as h_oct
												on h10=scd_id
												left join
												(
												SELECT
												attend_SCD_id as h11
												,count(*) as holiday11
												FROM `attendance`
												where
												attend_school_profile_id=".$employee_school_profile_id."
												and attend_status in ('H','W')
												and date_format(attend_datetime,'%Y-%m') in (SELECT concat(SUBSTRING(AY_name, 1, 4),'-11') FROM `academic_year` where AY_id=".$school_AY_id.")
												group by 1
												order by 1
												)as h_nov
												on h11=scd_id
												left join
												(
												SELECT
												attend_SCD_id as h12
												,count(*) as holiday12
												FROM `attendance`
												where
												attend_school_profile_id=".$employee_school_profile_id."
												and attend_status in ('H','W')
												and date_format(attend_datetime,'%Y-%m') in (SELECT concat(SUBSTRING(AY_name, 1, 4),'-12') FROM `academic_year` where AY_id=".$school_AY_id.")
												group by 1
												order by 1
												)as h_decem
												on h12=scd_id
												left join
												(
												SELECT
												attend_SCD_id as h1
												,count(*) as holiday1
												FROM `attendance`
												where
												attend_school_profile_id=".$employee_school_profile_id."
												and attend_status in ('H','W')
												and date_format(attend_datetime,'%Y-%m') in (SELECT concat(SUBSTRING(AY_name, 6, 4),'-01') FROM `academic_year` where AY_id=".$school_AY_id.")
												group by 1
												order by 1
												)as h_jan
												on h1=scd_id
												left join
												(
												SELECT
												attend_SCD_id as h2
												,count(*) as holiday2
												FROM `attendance`
												where
												attend_school_profile_id=".$employee_school_profile_id."
												and attend_status in ('H','W')
												and date_format(attend_datetime,'%Y-%m') in (SELECT concat(SUBSTRING(AY_name, 6, 4),'-02') FROM `academic_year` where AY_id=".$school_AY_id.")
												group by 1
												order by 1
												)as h_feb
												on h2=scd_id
												left join
												(
												SELECT
												attend_SCD_id as h3
												,count(*) as holiday3
												FROM `attendance`
												where
												attend_school_profile_id=".$employee_school_profile_id."
												and attend_status in ('H','W')
												and date_format(attend_datetime,'%Y-%m') in (SELECT concat(SUBSTRING(AY_name, 6, 4),'-03') FROM `academic_year` where AY_id=".$school_AY_id.")
												group by 1
												order by 1
												)as h_mar
												on h3=scd_id
												left join
												(
												SELECT
												attend_SCD_id as h4
												,count(*) as holiday4
												FROM `attendance`
												where
												attend_school_profile_id=".$employee_school_profile_id."
												and attend_status in ('H','W')
												and date_format(attend_datetime,'%Y-%m') in (SELECT concat(SUBSTRING(AY_name, 6, 4),'-04') FROM `academic_year` where AY_id=".$school_AY_id.")
												group by 1
												order by 1
												)as h_apr
												on h4=scd_id
												left join
												(
												select
												SCD_id as c6_id
												,day as c6_count
												from student_class_division_assgn
												cross join AY_year
												where
												month in (SELECT concat(SUBSTRING(AY_name, 1, 4),'-06') FROM `academic_year` where AY_id=".$school_AY_id.")
												)as c6
												on c6_id=scd_id
												left join
												(
												select
												SCD_id as c7_id
												,day as c7_count
												from student_class_division_assgn
												cross join AY_year
												where
												month in (SELECT concat(SUBSTRING(AY_name, 1, 4),'-07') FROM `academic_year` where AY_id=".$school_AY_id.")
												)as c7
												on c7_id=scd_id
												left join
												(
												select
												SCD_id as c8_id
												,day as c8_count
												from student_class_division_assgn
												cross join AY_year
												where
												month in (SELECT concat(SUBSTRING(AY_name, 1, 4),'-08') FROM `academic_year` where AY_id=".$school_AY_id.")
												)as c8
												on c8_id=scd_id
												left join
												(
												select
												SCD_id as c9_id
												,day as c9_count
												from student_class_division_assgn
												cross join AY_year
												where
												month in (SELECT concat(SUBSTRING(AY_name, 1, 4),'-09') FROM `academic_year` where AY_id=".$school_AY_id.")
												)as c9
												on c9_id=scd_id
												left join
												(
												select
												SCD_id as c10_id
												,day as c10_count
												from student_class_division_assgn
												cross join AY_year
												where
												month in (SELECT concat(SUBSTRING(AY_name, 1, 4),'-10') FROM `academic_year` where AY_id=".$school_AY_id.")
												)as c10
												on c10_id=scd_id
												left join
												(
												select
												SCD_id as c11_id
												,day as c11_count
												from student_class_division_assgn
												cross join AY_year
												where
												month in (SELECT concat(SUBSTRING(AY_name, 1, 4),'-11') FROM `academic_year` where AY_id=".$school_AY_id.")
												)as c11
												on c11_id=scd_id
												left join
												(
												select
												SCD_id as c12_id
												,day as c12_count
												from student_class_division_assgn
												cross join AY_year
												where
												month in (SELECT concat(SUBSTRING(AY_name, 1, 4),'-12') FROM `academic_year` where AY_id=".$school_AY_id.")
												)as c12
												on c12_id=scd_id
												left join
												(
												select
												SCD_id as c1_id
												,day as c1_count
												from student_class_division_assgn
												cross join AY_year
												where
												month in (SELECT concat(SUBSTRING(AY_name, 6, 4),'-01') FROM `academic_year` where AY_id=".$school_AY_id.")
												)as c1
												on c1_id=scd_id
												left join
												(
												select
												SCD_id as c2_id
												,day as c2_count
												from student_class_division_assgn
												cross join AY_year
												where
												month in (SELECT concat(SUBSTRING(AY_name, 6, 4),'-02') FROM `academic_year` where AY_id=".$school_AY_id.")
												)as c2
												on c2_id=scd_id
												left join
												(
												select
												SCD_id as c3_id
												,day as c3_count
												from student_class_division_assgn
												cross join AY_year
												where
												month in (SELECT concat(SUBSTRING(AY_name, 6, 4),'-03') FROM `academic_year` where AY_id=".$school_AY_id.")
												)as c3
												on c3_id=scd_id
												left join
												(
												select
												SCD_id as c4_id
												,day as c4_count
												from student_class_division_assgn
												cross join AY_year
												where
												month in (SELECT concat(SUBSTRING(AY_name, 6, 4),'-04') FROM `academic_year` where AY_id=".$school_AY_id.")
												)as c4
												on c4_id=scd_id
												where
												SCD_student_profile_id=".$student_id."
												and SCD_AY_id=".$school_AY_id."")->result_array();

			$term_list = $this->session->userdata('term_for_print');
			
        	for ($i=0; $i < count($term_list) ; $i++) 
        	{ 

				$data['query4'][] = $this->db->query("SELECT 
																result_data.* 
																,GC_grade
															from 
															(
																SELECT
																	data.*
																	,case when mark is NULL then 0 else mark end as marks
																	,case when total_mark is NULL then 0 else total_mark end as total_marks
																from
																(
																	SELECT 
																		student_profile_id
																		,concat(student_first_name,' ',student_middle_name,' ',student_last_name) as student_name
																		,SCD_Roll_No
																		,student_GRN
																		,exam_subject_id
																		,subject_name
																		,sum(marks_obtained) as mark
																		,sum(exam_outoff_marks) as total_mark
																		,SF_id
																		,SF_special_remark_1
																		,SF_Int_Hob_1
																		,SF_Improvement_need_1
																	FROM student_class_division_assgn
																	join student
																		on student_profile_id=SCD_student_profile_id
																	join division
																		on division_id=SCD_division_id
																	
																	left join student_feedback
																		on SF_student_profile_id=student_profile_id
																		and sf_term_id=".$term_list[$i]['term_id']."
																	cross join
																	(
																		select
																			exam_id
																			,exam_subject_id
																			,eval_id
																			,subject_name
																			,eval_name
																			,exam_outoff_marks
																		from exam
																		join subject
																			on exam_subject_id=subject_id
																		join evaluation
																			on exam_eval_id=eval_id
																		where
																			exam_school_profile_id=".$employee_school_profile_id."
																			and exam_term_id=".$term_list[$i]['term_id']."
																			and exam_class_id=".$class_id."
																	)as subject
																	left join marks
																		on marks_exam_id=exam_id
																		and marks_student_id=student_profile_id
																		and marks_status='1'
																	where
																		SCD_school_profile_id=".$employee_school_profile_id."
																		and SCD_class_id=".$class_id."
																		and SCD_division_id=".$division_id."
																		and SCD_AY_id=".$school_AY_id."
																		and SCD_expiry_date='9999-12-31'
																		and SCD_student_profile_id=".$student_id."
																	group by 
																		student_profile_id
																		,exam_subject_id
																	order by
																		SCD_Roll_No
																		,student_GRN
																		,exam_subject_id
																)as data
																order by
																		SCD_Roll_No
																		,student_GRN
																		,exam_subject_id
															)as result_data,grade_scale 
															where (marks*100)/total_marks between GC_lower_mark_range and GC_higher_mark_range
															and  GC_AY_id=".$school_AY_id." and GC_school_profile_id=".$employee_school_profile_id."
															order by
																		SCD_Roll_No
																		,student_GRN
																		,exam_subject_id
																")->result_array();

				// print_r($data['query4']);
			}

			$data['query5'] = $this->db->query("SELECT * FROM `grade_scale` WHERE GC_AY_id =".$school_AY_id." AND GC_school_profile_id = ".$employee_school_profile_id."")->result_array();
			// echo "<pre>";
			// print_r($data);die();
			$data['school_leaving_certificate_header'] = $school_admin[0]['school_leaving_certificate_header'];
			$data['school_report_footer'] = $school_admin[0]['school_report_footer'];

			$data['acadamic_name'] = $this->db->query("SELECT AY_name FROM `academic_year` WHERE AY_id = ".$school_AY_id."")->row()->AY_name;

			$this->load->view('Exam/page1',$data);
		}


		function subject_details_class_division()
		{
			if (isset($this->session->userdata['school'])) {
				$school_admin = $this->session->userdata('school');
        	}elseif (isset($this->session->userdata['teacher'])) {
        		$school_admin = $this->session->userdata('teacher');
        		$subject['teacher_id'] = $school_admin[0]['employee_profile_id'];
        	}
			$subject['subject_school_profile_id'] = $school_admin[0]['employee_school_profile_id'];
			$subject['AY_id'] = $school_admin[0]['school_AY_id'];
			$subject_class = $_POST['class_id'];
			$result = explode('-',$subject_class);
			$subject['class_id'] = $result[0];
			$subject['division_id'] = $result[1];
			$data = $this->Exam_model->fetch_school_division_subject($subject);
			echo json_encode($data);
		}
		function subject_details_class_division1()
		{
			if (isset($this->session->userdata['school'])) {
				$school_admin = $this->session->userdata('school');
        	}elseif (isset($this->session->userdata['teacher'])) {
        		$school_admin = $this->session->userdata('teacher');
        		$subject['teacher_id'] = $school_admin[0]['employee_profile_id'];
        	}
			$subject['subject_school_profile_id'] = $school_admin[0]['employee_school_profile_id'];
			$subject['AY_id'] = $school_admin[0]['school_AY_id'];
			$subject_class = $_POST['class_id'];
			$result = explode('-',$subject_class);
			$subject['class_id'] = $result[0];
			$subject['division_id'] = $result[1];
			$data = $this->Exam_model->fetch_school_division_subject1($subject);
			echo json_encode($data);
		}

		function student_details_class_division()
		{
			if (isset($this->session->userdata['school'])) {
				$school_admin = $this->session->userdata('school');
        	}elseif (isset($this->session->userdata['teacher'])) {
        		$school_admin = $this->session->userdata('teacher');
        	}
			$subject['subject_school_profile_id'] = $school_admin[0]['employee_school_profile_id'];
			$subject['AY_id'] = $school_admin[0]['school_AY_id'];
			$subject_class = $_POST['class_id'];
			$result = explode('-',$subject_class);
			$subject['class_id'] = $result[0];
			$subject['division_id'] = $result[1];
			$subject['exam_id'] = $_POST['exam_id'];
			$data = $this->Exam_model->fetch_school_division_student($subject);
			echo json_encode($data);
		}


		function teacher_details_class_division()
		{
			if (isset($this->session->userdata['school'])) {
				$school_admin = $this->session->userdata('school');
        	}elseif (isset($this->session->userdata['teacher'])) {
        		$school_admin = $this->session->userdata('teacher');
        	}
			$subject['subject_school_profile_id'] = $school_admin[0]['employee_school_profile_id'];
			$subject['AY_id'] = $school_admin[0]['school_AY_id'];
			$subject['exam_id'] = $_POST['exam_id'];
			$data = $this->Exam_model->fetch_school_division_teacher($subject);
			echo json_encode($data);
		}

		function fetch_exam_details()
		{
			if (isset($this->session->userdata['school'])) {
				$school_admin = $this->session->userdata('school');
        	}elseif (isset($this->session->userdata['teacher'])) {
        		$school_admin = $this->session->userdata('teacher');
        	}
			$subject['subject_school_profile_id'] = $school_admin[0]['employee_school_profile_id'];
			$subject['AY_id'] = $school_admin[0]['school_AY_id'];
			$subject['exam_id'] = $_POST['exam_id'];
			$data = $this->Exam_model->fetch_school_division_exam_deatils($subject);
			echo json_encode($data);
		}
		
		function mark_registration()
		{
			if (isset($this->session->userdata['school'])) {
				$school_admin = $this->session->userdata('school');
				$marks['marks_teacher_id'] = $this->input->post('marks_teacher_id');
        	}elseif (isset($this->session->userdata['teacher'])) {
        		$school_admin = $this->session->userdata('teacher');
				$marks['marks_teacher_id'] = $school_admin[0]['employee_profile_id'];
        	}

			// $marks['pri_status'] = $this->input->post('pri_status');
			$marks['marks_exam_id'] = $this->input->post('marks_exam_id');
			$marks['marks_student_id'] = $this->input->post('marks_student_id');
			$marks['marks_obtained'] = $this->input->post('marks_obtained');
			$exam_outoff_marks = $this->input->post('exam_outoff_marks');
			$exam_evaluation_marks = $this->input->post('exam_evaluation_marks');
			$exam_marksheet_marks = $this->input->post('exam_marksheet_marks');
			$marks['marks_AY_id'] = $school_admin[0]['school_AY_id'];
			$marks['marks_school_profile_id'] = $school_admin[0]['employee_school_profile_id'];
			$count = count($marks['marks_obtained']);
			for ($i=0; $i < $count; $i++) { 
				$mark['marks_exam_id'] = $marks['marks_exam_id'];
				$mark['marks_student_id'] = $marks['marks_student_id'][$i];
				$mark['marks_obtained'] = $marks['marks_obtained'][$i];
				$mark['marks_teacher_id'] = $marks['marks_teacher_id'];
				$mark['marks_AY_id'] = $marks['marks_AY_id'];
				$mark['marks_school_profile_id'] = $marks['marks_school_profile_id'];
				if($mark['marks_obtained'] != 0 ||$mark['marks_obtained'] != ''){
					$mark['marks_evaluation'] = round((intval($exam_evaluation_marks)*intval($mark['marks_obtained']))/intval($exam_outoff_marks));
					$mark['marks_marksheet'] = round((intval($exam_marksheet_marks)*intval($mark['marks_obtained']))/intval($exam_outoff_marks));

					$verify = $this->db->query("SELECT * from marks where marks_exam_id =".$mark['marks_exam_id']." and marks_student_id =".$mark['marks_student_id']." and marks_AY_id =".$mark['marks_AY_id']." and marks_school_profile_id = ".$mark['marks_school_profile_id']."")->num_rows();
					if($verify == 0){
						$cnt = $this->Exam_model->mark_registration($mark);
			        }
			        else{
			        	$cnt = 0;
			        	$this->db->set($mark)->where('marks_exam_id',$mark['marks_exam_id'])->where('marks_student_id',$mark['marks_student_id'])->where('marks_AY_id',$mark['marks_AY_id'])->where('marks_school_profile_id',$mark['marks_school_profile_id'])->update("marks", $mark);
			        }
				}
			}
			switch ($cnt) {
				case '1':
					$this->session->set_flashdata('active',1);
		            $this->session->set_flashdata('title',"Exam Marks submitted.");
		            $this->session->set_flashdata('text',"");
		            $this->session->set_flashdata('type',"success");
		            redirect('Exam/exam_details');
				case '0':
					$this->session->set_flashdata('active',1);
		            $this->session->set_flashdata('title',"Exam Marks submitted.");
		            $this->session->set_flashdata('text',"");
		            $this->session->set_flashdata('type',"success");
		            redirect('Exam/exam_details');
			}
		}

		function fetch_sub_eval()
		{
			if (isset($this->session->userdata['school'])) {
				$school_admin = $this->session->userdata('school');
        	}elseif (isset($this->session->userdata['teacher'])) {
        		$school_admin = $this->session->userdata('teacher');
        	} 

			$employee_school_profile_id = $school_admin[0]['employee_school_profile_id'];
			$school_AY_id = $school_admin[0]['school_AY_id'];
			// $data['user_type'] = $school_admin[0]['employee_type'];

			$subject_id = $_POST['subject_id'];
			$term_id = $_POST['term_id'];

			$subject_class = $_POST['class_id'];
			$result = explode('-',$subject_class);
			$class_id = $result[0];
			$division_id = $result[1];


			$data['eval_type'] = $this->db->query("SELECT eval_id,eval_name,exam_outoff_marks FROM `exam` join evaluation on exam_eval_id=eval_id WHERE exam_subject_id = ".$subject_id."
													AND exam_class_id = ".$class_id."
													AND exam_term_id = ".$term_id."
													AND exam_AY_id = ".$school_AY_id." order by eval_name DESC")->result_array();

			$data['stu_data'] = $this->db->query("SELECT 
													student_profile_id
													    ,concat(student_first_name,' ',student_middle_name,' ',student_last_name) as student_name
													    ,division_name
													,SCD_Roll_No
													,student_GRN
													,exam_id
													,exam_subject_id
													,eval_name
													,marks_status
													,case when marks_obtained is NULL then '-' else marks_obtained end as marks_obtained
													,exam_outoff_marks
													FROM student_class_division_assgn
													join student
													on student_profile_id=SCD_student_profile_id
													join division
													on division_id=SCD_division_id
													cross join
													(
													select
													exam_id
													,exam_subject_id
													,eval_id
													,eval_name
													,exam_outoff_marks
													from exam
													join evaluation
													on exam_eval_id=eval_id
													where
													exam_school_profile_id=".$employee_school_profile_id."
													and exam_term_id=".$term_id."
													and exam_class_id=".$class_id."
													and exam_subject_id= ".$subject_id."
													)as subject
													left join marks
													on marks_exam_id=exam_id
													and marks_student_id=student_profile_id
													where
													SCD_school_profile_id=".$employee_school_profile_id."
													and SCD_class_id=".$class_id."
													    and SCD_division_id=".$division_id."
													    and SCD_AY_id=".$school_AY_id."
													    and SCD_expiry_date='9999-12-31'
													order by
													division_name
													    ,SCD_Roll_No
													,student_GRN
													,exam_subject_id
													,eval_name DESC")->result_array();

			echo json_encode($data);
		}

		public function update_sub_verification_status()
		{
			if (isset($this->session->userdata['school'])) {
				$school_admin = $this->session->userdata('school');
        	}elseif (isset($this->session->userdata['teacher'])) {
        		$school_admin = $this->session->userdata('teacher');
        	} 

			$employee_school_profile_id = $school_admin[0]['employee_school_profile_id'];
			$school_AY_id = $school_admin[0]['school_AY_id'];
			$subject_id = $_POST['subject_id'];
			$term_id = $_POST['term_id'];
			$subject_class = $_POST['class_id'];

			$result = explode('-',$subject_class);
			$class_id = $result[0];
			$division_id = $result[1];
			$sql = "insert into marks
								select 
									marks_id
									,exam_id
									,0 as teacher_id
									,SCD_student_profile_id
									,0 as marks_obtain
									,0 as marksheetmarks
									,0 as evaluation_marks
									,0 as marks_status
									,SCD_AY_id
									,SCD_school_profile_id
								from student_class_division_assgn
								cross  join 
								(
									select 
								        exam_id 
										,exam_subject_id
										,exam_eval_id
								    from exam 
								    where 
								        exam_term_id=".$term_id."
								        and exam_school_profile_id=".$employee_school_profile_id."
								        and exam_class_id=".$class_id."
								        and exam_subject_id=".$subject_id."
								        and exam_AY_id=".$school_AY_id."
								) as exam 
								left join
								(
									select 
								    	*
								    from marks
								    WHERE
								    	marks_AY_id=".$school_AY_id."
								    	and marks_school_profile_id=".$employee_school_profile_id."
								)as marks
									on marks_student_id=SCD_student_profile_id
									and marks_exam_id=exam_id
									and marks_status='0'
								where 
									SCD_school_profile_id=".$employee_school_profile_id."
								    and SCD_AY_id=".$school_AY_id."
								    and SCD_class_id=".$class_id."
								    and SCD_division_id=".$division_id."
								    and SCD_expiry_date='9999-12-31'
									and marks_id is NULL";


				$sql_1 =	"update marks 
									set marks_status='1' 
								where 
									marks_exam_id in
								    				(
								                        select 
								                        	exam_id 
								                        from exam 
								                        where 
								                        	exam_term_id=".$term_id."
								                        	and exam_school_profile_id=".$employee_school_profile_id."
								                        	and exam_class_id=".$class_id."
								                        	and exam_subject_id=".$subject_id."
								                        	and exam_AY_id=".$school_AY_id."
								                    )
									and marks_student_id in 
								    				(
								                        select 
								                        	SCD_student_profile_id 
								                       	from student_class_division_assgn
								                        WHERE	
								                        	SCD_class_id=".$class_id."
								                        	and SCD_division_id=".$division_id."
								                        	and SCD_AY_id=".$school_AY_id."
								                        	and SCD_school_profile_id=".$employee_school_profile_id."
								                        	and SCD_expiry_date='9999-12-31')";
			$status_res = $this->db->query($sql);
			$status_res_1 = $this->db->query($sql_1);					                    


		echo json_encode($status_res_1);

		}

		function fetch_student_marks_division()
		{
			if (isset($this->session->userdata['school'])) {
				$school_admin = $this->session->userdata('school');
        	}elseif (isset($this->session->userdata['teacher'])) {
        		$school_admin = $this->session->userdata('teacher');
        	}
			$subject['subject_school_profile_id'] = $school_admin[0]['employee_school_profile_id'];
			$subject['AY_id'] = $school_admin[0]['school_AY_id'];
			$subject_class = $_POST['class_id'];
			$result = explode('-',$subject_class);
			$subject['class_id'] = $result[0];
			$subject['division_id'] = $result[1];
			$subject['exam_id'] = $_POST['exam_id'];
			$data = $this->Exam_model->fetch_school_mark_student($subject);
			echo json_encode($data);
		}

		function edit_exam($exam_id)
		{
			$this->session->set_userdata('exam',$exam_id);
			redirect('Exam/update_exam');
		}

		function update_exam()
		{
			$exam_id = $this->session->userdata('exam');
			if(!isset($this->session->userdata['teacher'])){
				redirect('/');
			}
			if(isset($this->session->userdata['direct'])){
				$admin['direct'] = $this->session->userdata('direct');
			}
			else{
				$admin['direct'] = 1;
			} 

			$exam['flash']['active'] = $this->session->flashdata('active');
	    	$exam['flash']['title'] = $this->session->flashdata('title');
	    	$exam['flash']['text'] = $this->session->flashdata('text');
	    	$exam['flash']['type'] = $this->session->flashdata('type');
	    	
			$school_admin = $this->session->userdata('teacher');
			$admin['user'] = $school_admin[0]['employee_pri_mobile_number'];
			$admin['user_profile_id'] = $school_admin[0]['employee_profile_id'];
			$admin['employee_type'] = $school_admin[0]['employee_type'];
			$admin['photo'] = $school_admin[0]['employee_photo'];
			$admin['first_name'] = $school_admin[0]['employee_first_name'];
			$admin['last_name'] = $school_admin[0]['employee_last_name'];
			$admin['email_id'] = $school_admin[0]['employee_email_id'];
			$admin['username'] = $school_admin[0]['credential_username'];
			$admin['AY_name'] = $school_admin[0]['AY_name'];
			$school['user_profile_id'] = $school_admin[0]['employee_profile_id'];
			$admin['functionality'] = $this->School_model->fetch_functionality($school);
			$employee_school_profile_id = $school_admin[0]['employee_school_profile_id'];
			$employee_profile_id = $school_admin[0]['employee_profile_id'];
			$school_AY_id = $school_admin[0]['school_AY_id'];
			$exam['teacher_class'] =  $this->Exam_model->fetch_teacher_class($employee_school_profile_id,$employee_profile_id,$school_AY_id);
			$exam['teacher_subject'] =  $this->Exam_model->fetch_teacher_subject($employee_school_profile_id,$employee_profile_id,$school_AY_id);
			$exam['exam_details'] = $this->Exam_model->fetch_exam($exam_id,$school_AY_id);
			$nav['school_name'] = $school_admin[0]['school_name'];
			$nav['school_logo'] = $school_admin[0]['school_logo'];
			$nav['exam'] = 'exam';

			$this->load->view('Teacher/teacher_header', $admin);
			$this->load->view('Exam/update_exam',$exam);
			$this->load->view('Exam/exam_footer',$nav);
		}

		function update_exam_details()
		{
			$school_admin = $this->session->userdata('teacher');
			$exam['exam_id'] = $this->input->post('exam_id');
			$exam['exam_name'] = $this->input->post('exam_name');
			$exam['exam_subject_id'] = $this->input->post('exam_subject_id');
			$exam['exam_class_id'] = $this->input->post('exam_class_id');
			$exam['exam_date'] = $this->input->post('exam_date');
			$exam['exam_start_time'] = $this->input->post('exam_start_time');
			$exam['exam_end_time'] = $this->input->post('exam_end_time');
			$exam['exam_max_marks'] = $this->input->post('exam_max_marks');
			$exam['exam_result_datetime'] = $this->input->post('exam_result_datetime');
			$con = $this->Exam_model->exam_update($exam);
			if($con == 1){
				$this->session->set_flashdata('active',1);
	            $this->session->set_flashdata('title',"Exam Updated.");
	            $this->session->set_flashdata('text',"");
	            $this->session->set_flashdata('type',"success");
	            redirect('Exam/exam_details');
			}else{
				$this->session->set_flashdata('active',1);
	            $this->session->set_flashdata('title',"Exam Not Updated.");
	            $this->session->set_flashdata('text',"");
	            $this->session->set_flashdata('type',"warning");
	            redirect('Exam/exam_details');
			}
		}

// ------------------------------------------------------------- Evaluation Process -------------------------------------------------------------------------------------------

		function check_division_evaluation_process()
		{
			if (isset($this->session->userdata['school'])) {
				$school_admin = $this->session->userdata('school');
        	}
			$eval['subject_school_profile_id'] = $school_admin[0]['employee_school_profile_id'];
			$eval['AY_id'] = $school_admin[0]['school_AY_id'];
			$eval['term'] = $_POST['term'];
			$eval['class'] = $_POST['class'];
			$data = $this->Exam_model->check_division_evaluation_process($eval);
			echo json_encode($data);
		}

		function check_division_exam_evaluation_process()
		{
			if (isset($this->session->userdata['school'])) {
				$school_admin = $this->session->userdata('school');
        	}
			$eval['subject_school_profile_id'] = $school_admin[0]['employee_school_profile_id'];
			$eval['AY_id'] = $school_admin[0]['school_AY_id'];
			$eval['term'] = $_POST['term'];
			$eval['class'] = $_POST['class'];
			$data = $this->Exam_model->check_division_exam_evaluation_process($eval);
			echo json_encode($data);
		}

		function check_evaluation_process()
		{
			if (isset($this->session->userdata['school'])) {
				$school_admin = $this->session->userdata('school');
        	}
			$eval['subject_school_profile_id'] = $school_admin[0]['employee_school_profile_id'];
			$eval['AY_id'] = $school_admin[0]['school_AY_id'];
			$eval['term'] = $_POST['term'];
			$eval['class'] = $_POST['class'];
			$eval['division'] = $_POST['division'];
			$data = $this->Exam_model->check_evaluation_process($eval);
			echo json_encode($data);
		}

		function check_student_evaluation_process()
		{
			if (isset($this->session->userdata['school'])) {
				$school_admin = $this->session->userdata('school');
        	}
			$eval['subject_school_profile_id'] = $school_admin[0]['employee_school_profile_id'];
			$eval['AY_id'] = $school_admin[0]['school_AY_id'];
			$eval['term'] = $_POST['term'];
			$eval['class'] = $_POST['class'];
			$eval['division'] = $_POST['division'];
			$eval['exam'] = $_POST['exam'];
			$data = $this->Exam_model->check_student_evaluation_process($eval);
			echo json_encode($data);
		}


		function check_button_status_acc_student()
		{
			$school_admin = $this->session->userdata('school');
			$eval['subject_school_profile_id'] = $school_admin[0]['employee_school_profile_id'];
			$eval['AY_id'] = $school_admin[0]['school_AY_id'];
			$eval['term'] = $_POST['term'];
			$eval['class'] = $_POST['class'];
			$data = $this->Exam_model->check_button_status_acc_student($eval);
			echo json_encode($data);
		}

		function start_evaluation_process()
		{
			$school_admin = $this->session->userdata('school');
			$eval['subject_school_profile_id'] = $school_admin[0]['employee_school_profile_id'];
			$eval['AY_id'] = $school_admin[0]['school_AY_id'];
			$eval['term'] = $_POST['term'];
			$eval['class'] = $_POST['class'];
			$eval['eval'] = $_POST['eval_type'];
			$data = $this->db->query("UPDATE exam SET exam_evaluation_status ='".$eval['eval']."' where exam_term_id =".$eval['term']." and exam_class_id =".$eval['class']." and exam_AY_id =".$eval['AY_id']." and exam_school_profile_id =".$eval['subject_school_profile_id']."")->result_array();
			echo json_encode($data);
		}

		function complete_evaluation_process()
		{
			$school_admin = $this->session->userdata('school');
			$eval['subject_school_profile_id'] = $school_admin[0]['employee_school_profile_id'];
			$eval['AY_id'] = $school_admin[0]['school_AY_id'];
			$eval['term'] = $_POST['term'];
			$eval['class'] = $_POST['class'];
			$eval['eval'] = $_POST['eval_type'];
			$this->db->query("UPDATE exam SET exam_evaluation_status ='".$eval['eval']."' where exam_term_id =".$eval['term']." and exam_class_id =".$eval['class']." and exam_AY_id =".$eval['AY_id']." and exam_school_profile_id =".$eval['subject_school_profile_id']."");
			$data = $this->db->query("insert into result select exam_term_id 
						,exam_class_id
						,marks_student_id
						,subject_name
						,eval_type_1_marks
						,eval_type_1_total
						,eval_type_2_marks
						,eval_type_2_total
						,total_obtained
						,total
						,GC_grade
						,0 as status
						,".$eval['AY_id']." as AY_id
						,".$eval['subject_school_profile_id']." as school_id
						from (select
						exam_term_id_1 as exam_term_id
						,exam_class_id_1 as exam_class_id
						,marks_student_id_1 as marks_student_id
						,subject_name_1 as subject_name
						,eval_type_1_marks
						,eval_type_1_total
						,eval_type_2_marks
						,eval_type_2_total
						,(eval_type_1_marks+eval_type_2_marks)as total_obtained
						,(eval_type_1_total+eval_type_2_total)as total
						from (select
						exam_term_id_1
						,exam_class_id_1
						,marks_student_id_1
						,subject_name_1
						,sum(marks_evaluation_1) as eval_type_1_marks
						,sum(exam_evaluation_marks_1)as eval_type_1_total
						from (
						SELECT
						exam_id as exam_id_1
						,exam_term_id as exam_term_id_1
						,exam_class_id as exam_class_id_1
						,marks_student_id as marks_student_id_1
						,exam_subject_id as exam_subject_id_1
						,subject_name as subject_name_1
						,eval_name as eval_name_1
						,eval_type as eval_type_1
						,marks_evaluation as marks_evaluation_1
						,exam_evaluation_marks  as exam_evaluation_marks_1
						FROM marks
						left join exam
						on marks_exam_id=exam_id
						and marks_AY_id=exam_AY_id
						join subject
						on exam_subject_id=subject_id
						join evaluation
						on subject_eval_id=eval_id
						where exam_term_id=".$eval['term']."
						and exam_class_id=".$eval['class']."
						and exam_AY_id=".$eval['AY_id']."
						and exam_school_profile_id=".$eval['subject_school_profile_id']."
						and eval_type=1
						) as eval_type_1
						group by exam_term_id_1
						,exam_class_id_1
						,marks_student_id_1
						,subject_name_1) as type1,
						(select
						exam_term_id_2
						,exam_class_id_2
						,marks_student_id_2
						,subject_name_2
						,sum(marks_evaluation_2) as eval_type_2_marks
						,sum(exam_evaluation_marks_2)as eval_type_2_total
						from (
						SELECT
						exam_id as exam_id_2
						,exam_term_id as exam_term_id_2
						,exam_class_id as exam_class_id_2
						,marks_student_id as marks_student_id_2
						,exam_subject_id as exam_subject_id_2
						,subject_name as subject_name_2
						,eval_name as eval_name_2
						,eval_type as eval_type_2
						,marks_evaluation as marks_evaluation_2
						,exam_evaluation_marks  as exam_evaluation_marks_2
						FROM marks
						left join exam
						on marks_exam_id=exam_id
						and marks_AY_id=exam_AY_id
						join subject
						on exam_subject_id=subject_id
						join evaluation
						on subject_eval_id=eval_id
						where exam_term_id=".$eval['term']."
						and exam_class_id=".$eval['class']."
						and exam_AY_id=".$eval['AY_id']."
						and exam_school_profile_id=".$eval['subject_school_profile_id']."
						and eval_type=2
						) as eval_type_1
						group by exam_term_id_2
						,exam_class_id_2
						,marks_student_id_2
						,subject_name_2) as type2
						where
						exam_term_id_1=exam_term_id_2
						and exam_class_id_1=exam_class_id_2
						and marks_student_id_1=marks_student_id_2
						and subject_name_1=subject_name_2)as final_data
						left join grade_scale
						on total_obtained between GC_lower_mark_range and GC_higher_mark_range
						and GC_AY_id=".$eval['AY_id']."
						and GC_school_profile_id=".$eval['subject_school_profile_id']."");
			echo json_encode($data);
		}

		function evaluation_status_update()
		{
			$marks_id = $this->input->post('marks_id');
			$marks_obtained = $this->input->post('marks_obtained');
			$marks_evaluation = $this->input->post('marks_evaluation');
			$marks_status = $this->input->post('marks_status');
			if($marks_status == 2){
				$status = '0';
			}else{
				$status = '1';
			}
			$this->db->set('marks_obtained',$marks_obtained)->set('marks_evaluation',$marks_evaluation)->set('marks_status',$status)->where('marks_id',$marks_id)->update('marks');
			$this->session->set_flashdata('active',1);
            $this->session->set_flashdata('title',"Evaluation Successfully Updated.");
            $this->session->set_flashdata('text',"");
            $this->session->set_flashdata('type',"success");
            redirect('Exam/exam_details');
		}

		function direct_verify_marks($marks_id)					
		{
			$this->session->set_userdata('marks',$marks_id);
			redirect('Exam/verify_marks');
		}

		function verify_marks(){
			$marks_id = $this->session->userdata('marks'); 
			$this->db->set('marks_status','1')->where('marks_id',$marks_id)->update('marks');
			$this->session->set_flashdata('active',1);
            $this->session->set_flashdata('title',"Evaluation Successfully Updated.");
            $this->session->set_flashdata('text',"");
            $this->session->set_flashdata('type',"success");
            redirect('Exam/exam_details');
		}
	}
 ?>