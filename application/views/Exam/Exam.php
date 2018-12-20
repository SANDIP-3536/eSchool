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
			$exam['eval_type'] = $this->Exam_model->fetch_eval_type($employee_school_profile_id,$school_AY_id);
			$exam['exam_details'] = $this->Exam_model->fetch_exam($employee_school_profile_id,$school_AY_id);
			$exam['fetch_marks'] =  $this->Exam_model->fetch_marks($employee_school_profile_id,$school_AY_id);
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
			$data['exam'] = $this->db->query("SELECT exam.*,term_name,class_name,subject_name,eval_name FROM exam join term on exam_term_id= term_id join evaluation on eval_id = exam_eval_id join class on exam_class_id=class_id join subject on exam_subject_id=subject_id where exam_school_profile_id =".$employee_school_profile_id." and exam_AY_id =".$school_AY_id." AND exam_term_id = ".$term_id." AND exam_class_id = ".$class_id." AND exam_eval_id = ".$eval_id."")->result_array();
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
			$exam['exam_paper_marks'] = $_POST['exam_paper_marks'];
			$exam['exam_outoff_marks'] = $_POST['exam_outoff_marks'];
			$exam['exam_evaluation_marks'] = $_POST['exam_evaluation_marks'];

			$exam['exam_school_profile_id'] = $school_admin[0]['employee_school_profile_id'];
			$exam['exam_AY_id'] = $school_admin[0]['school_AY_id'];

			// $eval_id = $this->db->select('eval_type')->from('exam')->join('evaluation','exam_eval_id = eval_id')->where('subject_id',$exam['exam_subject_id'])->get()->result_array();
			// if($exam['exam_eval_type'] == 2)
			// {
			// 		$verify = $this->db->query("SELECT * FROM `exam` join subject on exam_subject_id=subject_id join evaluation on exam_eval_id=eval_id where eval_type=2 and exam_class_id = ".$exam['exam_class_id']." and ('".$exam['exam_start_date']."' BETWEEN EXAM_START_DATE AND EXAM_END_DATE OR '".$exam['exam_end_date']."' BETWEEN EXAM_START_DATE AND EXAM_END_DATE OR EXAM_START_DATE BETWEEN '".$exam['exam_start_date']."' AND '".$exam['exam_end_date']."' OR EXAM_END_DATE BETWEEN '".$exam['exam_start_date']."' AND '".$exam['exam_end_date']."')")->num_rows();
			// 		if($verify != 0){

			//    //          $this->session->set_flashdata('title',"Exam Already Submitted.");
			//    //          $this->session->set_flashdata('text',"Exam time conflict with register exam.");

			//    //          redirect('Exam/exam_details');
			//             $respons = 0;
			// 		}		
			// }else{
				
			$this->Exam_model->exam_registration($exam);
			// 	if($con == 1){
			// 		$respons = 1;
			// 	}else{
			// 		$respons = 2;
			// 	}

			// }

					// $respons = 1;
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

		// function print_exam_schedule()
		// {
		// 	if (isset($this->session->userdata['school'])) {
		// 		$school_admin = $this->session->userdata('school');
  //       	}elseif (isset($this->session->userdata['teacher'])) {
  //       		$school_admin = $this->session->userdata('teacher');
  //       	} 
		// 	if(isset($this->session->userdata['direct'])){
		// 		$admin['direct'] = $this->session->userdata('direct');
		// 	}
		// 	else{
		// 		$admin['direct'] = 1;
		// 	} 

		// 	$class_id = $this->input->post('printOut_class_id');
		// 	$term_id = $this->input->post('printOut_term_id');
		// 	$eval_id = $this->input->post('printOut_eval_id');
		// 	$data['exam_details'] = $this->db->query("SELECT term_name,class_name, subject_name,eval_name,DATE_FORMAT(exam_start_date,'%d %M %Y') as exam_date,exam_start_time,exam_end_time,exam_result_date FROM `exam` join term on exam_term_id = term_id join class on exam_class_id = class_id join subject on exam_subject_id = subject_id join evaluation on subject_eval_id = eval_id where exam_AY_id = ".$school_admin[0]['school_AY_id']." and exam_school_profile_id = ".$school_admin[0]['employee_school_profile_id']." and exam_subject_id IN (select subject.subject_id from subject where subject.subject_eval_id = ".$eval_id." and subject.subject_class_id = ".$class_id.") and exam_term_id =".$term_id."")->result_array();
		// 	$data['school_report_header'] = $school_admin[0]['school_report_header'];
		// 	$data['school_report_footer'] = $school_admin[0]['school_report_footer'];
		// 	// echo "<pre>";
		// 	$this->load->view('Exam/exam_schedule_print',$data);
		// }
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
			// $test = "SELECT term_name,class_name, subject_name,eval_name,DATE_FORMAT(exam_start_date,'%d %M %Y') as exam_date,exam_start_time,exam_end_time,exam_result_date FROM `exam` join term on exam_term_id = term_id join class on exam_class_id = class_id join subject on exam_subject_id = subject_id join evaluation on exam_eval_id = eval_id where exam_AY_id = ".$school_admin[0]['school_AY_id']." and exam_school_profile_id = ".$school_admin[0]['employee_school_profile_id']." and exam_subject_id IN (select subject.subject_id from subject where subject.subject_class_id = ".$class_id.") and exam_term_id =".$term_id." AND exam_eval_id IN ('".$eval_id."')";
			// echo "<pre>";
			// print_r($eval_id);
			// print_r($test);
			$data['exam_details'] = $this->db->query("SELECT term_name,class_name, subject_name,eval_name,DATE_FORMAT(exam_start_date,'%d %M %Y') as exam_date,exam_start_time,exam_end_time,exam_result_date,exam_paper_marks FROM `exam` join term on exam_term_id = term_id join class on exam_class_id = class_id join subject on exam_subject_id = subject_id join evaluation on exam_eval_id = eval_id where exam_AY_id = ".$school_admin[0]['school_AY_id']." and exam_school_profile_id = ".$school_admin[0]['employee_school_profile_id']." and exam_subject_id IN (select subject.subject_id from subject where subject.subject_class_id = ".$class_id.") and exam_term_id =".$term_id." AND exam_eval_id IN (".$eval_id.")")->result_array();
			$data['school_report_header'] = $school_admin[0]['school_report_header'];
			$data['school_report_footer'] = $school_admin[0]['school_report_footer'];
			// print_r($data);
			// die();
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

			$data = $this->db->query("SELECT term_name,class_name, subject_name,eval_name,DATE_FORMAT(exam_start_date,'%d %M %Y') as exam_date,exam_start_time,exam_end_time,exam_result_date,exam_paper_marks FROM `exam` join term on exam_term_id = term_id join class on exam_class_id = class_id join subject on exam_subject_id = subject_id join evaluation on exam_eval_id = eval_id where exam_AY_id = ".$school_admin[0]['school_AY_id']." and exam_school_profile_id = ".$school_admin[0]['employee_school_profile_id']." and exam_subject_id IN (select subject.subject_id from subject where subject.subject_class_id = ".$class_id.") and exam_term_id =".$term_id." AND exam_eval_id IN (".$eval_id.")")->result_array();

			echo json_encode($data);
		}

// ------------------------------------------------------------- Exam Marks Details --------------------------------------------------------------------------------------------

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

			$marks['marks_exam_id'] = $this->input->post('marks_exam_id');
			$marks['marks_student_id'] = $this->input->post('marks_student_id');
			$marks['marks_obtained'] = $this->input->post('marks_obtained');
			$exam_outoff_marks = $this->input->post('exam_outoff_marks');
			$exam_evaluation_marks = $this->input->post('exam_evaluation_marks');
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
					$verify = $this->db->query("SELECT * from marks where marks_exam_id =".$mark['marks_exam_id']." and marks_student_id =".$mark['marks_student_id']." and marks_AY_id =".$mark['marks_AY_id']." and marks_school_profile_id = ".$mark['marks_school_profile_id']."")->num_rows();
					if($verify == 0){
						$cnt = $this->Exam_model->mark_registration($mark);
			        }
			        else{
			        	$cnt = 0;
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
		            $this->session->set_flashdata('title',"Marks already submitted.");
		            $this->session->set_flashdata('text',"");
		            $this->session->set_flashdata('type',"warning");
		            redirect('Exam/exam_details');
			}
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