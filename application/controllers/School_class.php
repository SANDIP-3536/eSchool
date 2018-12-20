<?php
	class School_class extends CI_Controller
	{
		function class_details()
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
			$class_details['flash']['active'] = $this->session->flashdata('active');
        	$class_details['flash']['title'] = $this->session->flashdata('title');
        	$class_details['flash']['text'] = $this->session->flashdata('text');
        	$class_details['flash']['type'] = $this->session->flashdata('type');
        	
			$school_admin = $this->session->userdata('school');
			$admin['user'] = $school_admin[0]['employee_pri_mobile_number'];
			$admin['user_profile_id'] = $school_admin[0]['employee_profile_id'];
			$admin['employee_type'] = $school_admin[0]['employee_type'];
			$admin['photo'] = $school_admin[0]['employee_photo'];
			$admin['first_name'] = $school_admin[0]['employee_first_name'];
			$admin['last_name'] = $school_admin[0]['employee_last_name'];
			$admin['email_id'] = $school_admin[0]['employee_email_id'];
			$admin['username'] = $school_admin[0]['credential_username'];
			$school['user_profile_id'] = $school_admin[0]['employee_profile_id'];
			$admin['AY_name'] = $school_admin[0]['AY_name'];
			$admin['functionality'] = $this->School_model->fetch_functionality($school);
			$employee_school_profile_id = $school_admin[0]['employee_school_profile_id'];
			$class_details['school_class'] =  $this->Class_model->fetch_school_class($employee_school_profile_id);
			$class_details['school_subject'] =  $this->Subject_model->fetch_school_subject($employee_school_profile_id);
			$class_details['school_division'] =  $this->Division_model->fetch_school_division($employee_school_profile_id);
			$nav['school_name'] = $school_admin[0]['school_name'];
			$nav['school_logo'] = $school_admin[0]['school_logo'];
			$nav['config'] = 'config';

			$this->load->view('School/school_header', $admin);
			$this->load->view('Class/class_details',$class_details);
			$this->load->view('Class/class_footer',$nav);
		}

		function class_registration()
		{
			$school_admin = $this->session->userdata('school');
			$class_regi['class_name'] = $this->input->post('class_name');
			$class_regi['class_minimum_attendance'] = $this->input->post('class_minimum_attendance');
			$class_regi['class_attendance_type'] = $this->input->post('class_attendance_type');
			$class_regi['class_effective_date'] = date('Y-m-d');
			$class_regi['class_school_profile_id'] = $school_admin[0]['employee_school_profile_id'];
			$verify = $this->db->where('class_name',$class_regi['class_name'])->where('class_expiry_date','9999-12-31')->where('class_school_profile_id',$class_regi['class_school_profile_id'])->get('class')->num_rows();
			if ($verify != 0) {
				$this->session->set_flashdata('active',1);
	            $this->session->set_flashdata('title',"Class Already Register..");
	            $this->session->set_flashdata('text',"");
	            $this->session->set_flashdata('type',"warning");
	            redirect('School_class/class_details');
			}
			$con = $this->Class_model->class_registration($class_regi);
			if($con != 0){
				$this->session->set_flashdata('active',1);
	            $this->session->set_flashdata('title',"Class Not Submitted...");
	            $this->session->set_flashdata('text',"");
	            $this->session->set_flashdata('type',"warning");
	            redirect('School_class/class_details');
			}else{
				$this->session->set_flashdata('active',1);
	            $this->session->set_flashdata('title',"Class Added Successfully.");
	            $this->session->set_flashdata('text',"");
	            $this->session->set_flashdata('type',"success");
				redirect('School_class/class_details');
			}
		}

		function division_details()
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

			$division_details['flash']['active'] = $this->session->flashdata('active');
        	$division_details['flash']['title'] = $this->session->flashdata('title');
        	$division_details['flash']['text'] = $this->session->flashdata('text');
        	$division_details['flash']['type'] = $this->session->flashdata('type');
        	
			$school_admin = $this->session->userdata('school');
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
			$division_details['school_division'] =  $this->Division_model->fetch_school_division($employee_school_profile_id);
			$division_details['school_class'] =  $this->Division_model->fetch_school_class($employee_school_profile_id);
			$nav['school_name'] = $school_admin[0]['school_name'];
			$nav['school_logo'] = $school_admin[0]['school_logo'];
			$nav['config'] = 'config';

			$this->load->view('School/school_header', $admin);
			$this->load->view('Division/division_details',$division_details);
			$this->load->view('Division/division_footer',$nav);
		}

		function division_registration()
		{
			$school_admin = $this->session->userdata('school');
			$division_regi['division_name'] = $this->input->post('division_name');
			$division_regi['division_class_id'] = $this->input->post('division_class_id');
			$division_regi['division_effective_date'] = date('Y-m-d');
			$division_regi['division_school_profile_id'] = $school_admin[0]['employee_school_profile_id'];
			$verify = $this->db->where('division_name',$division_regi['division_name'])->where('division_class_id',$division_regi['division_class_id'])->where('division_expiry_date','9999-12-31')->where('division_school_profile_id',$division_regi['division_school_profile_id'])->get('division')->num_rows();
			// print_r($verify);die();
			if ($verify != 0) {
				$this->session->set_flashdata('active',1);
	            $this->session->set_flashdata('title',"Division Alredy Register with Class...");
	            $this->session->set_flashdata('text',"");
	            $this->session->set_flashdata('type',"warning");
	            redirect('School_class/division_details');
			}
			$con = $this->Division_model->division_registration($division_regi);
			if($con != 0){
				$this->session->set_flashdata('active',1);
	            $this->session->set_flashdata('title',"Division Not Submitted...");
	            $this->session->set_flashdata('text',"");
	            $this->session->set_flashdata('type',"warning");
	            redirect('School_class/division_details');
			}else{
				$this->session->set_flashdata('active',1);
	            $this->session->set_flashdata('title',"Division Added Successfully.");
	            $this->session->set_flashdata('text',"");
	            $this->session->set_flashdata('type',"success");
				redirect('School_class/division_details');
			}
		}

		function subject_details()
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
			$subject_details['flash']['active'] = $this->session->flashdata('active');
        	$subject_details['flash']['title'] = $this->session->flashdata('title');
        	$subject_details['flash']['text'] = $this->session->flashdata('text');
        	$subject_details['flash']['type'] = $this->session->flashdata('type');
        	
			$school_admin = $this->session->userdata('school');
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
			$subject_details['school_subject'] =  $this->Subject_model->fetch_school_subject($employee_school_profile_id);
			$subject_details['school_class'] =  $this->Division_model->fetch_school_class($employee_school_profile_id);
			$subject_details['eval'] =  $this->Class_model->fetch_eval($employee_school_profile_id);
			$nav['school_name'] = $school_admin[0]['school_name'];
			$nav['school_logo'] = $school_admin[0]['school_logo'];
			$nav['config'] = 'config';

			$this->load->view('School/school_header', $admin);
			$this->load->view('Subject/subject_details',$subject_details);
			$this->load->view('Subject/subject_footer',$nav);
		}

		function subject_registration()
		{
			$school_admin = $this->session->userdata('school');
			$subject['eval_id'] = $this->input->post('eval_id[]');
			$cnt = count($subject['eval_id']);
			for ($i=0; $i < $cnt; $i++) { 
				$subject_regi['subject_name'] = $this->input->post('subject_name');
				$subject_regi['subject_class_id'] = $this->input->post('subject_class_id');
				$subject_regi['subject_eval_id'] = $subject['eval_id'][$i];
				$subject_regi['subject_effective_date'] = date('Y-m-d');
				$subject_regi['subject_school_profile_id'] = $school_admin[0]['employee_school_profile_id'];
				print_r($subject_regi);
				$verify = $this->db->query("SELECT * FROM subject where subject_expiry_date ='9999-12-31' and subject_school_profile_id =".$subject_regi['subject_school_profile_id']." and subject_name ='".$subject_regi['subject_name']."' and subject_eval_id =".$subject_regi['eval_id']." and subject_class_id = ".$subject_regi['subject_class_id']."")->num_rows();
				if($verify != 0){
					$this->session->set_flashdata('active',1);
		            $this->session->set_flashdata('title',"Subject Already register...");
		            $this->session->set_flashdata('text',"");
		            $this->session->set_flashdata('type',"warning");
					redirect('School_class/subject_details');
				}
				else{
					$con = $this->Subject_model->Subject_registration($subject_regi);
				}
			}
			$this->session->set_flashdata('active',1);
            $this->session->set_flashdata('title',"Subject Added Successfully.");
            $this->session->set_flashdata('text',"");
            $this->session->set_flashdata('type',"success");
			redirect('School_class/subject_details');
		}

		function eval_details()
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
			$eval_details['flash']['active'] = $this->session->flashdata('active');
        	$eval_details['flash']['title'] = $this->session->flashdata('title');
        	$eval_details['flash']['text'] = $this->session->flashdata('text');
        	$eval_details['flash']['type'] = $this->session->flashdata('type');
        	
			$school_admin = $this->session->userdata('school');
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
			$eval_details['eval'] =  $this->Class_model->fetch_eval($employee_school_profile_id);
			$nav['school_name'] = $school_admin[0]['school_name'];
			$nav['school_logo'] = $school_admin[0]['school_logo'];
			$nav['config'] = 'evaluation';

			$this->load->view('School/school_header', $admin);
			$this->load->view('Subject/evaluation_type',$eval_details);
			$this->load->view('Subject/subject_footer',$nav);
		}

		function eval_registration()
		{
			$school_admin = $this->session->userdata('school');
			$eval['eval_type'] = $this->input->post('eval_type');
			$eval['eval_name'] = $this->input->post('eval_name');
			$eval['eval_school_profile_id'] = $school_admin[0]['employee_school_profile_id'];
			$verify = $this->db->query("SELECT * FROM evaluation where eval_school_profile_id =".$eval['eval_school_profile_id']." and eval_name ='".$eval['eval_name']."' and eval_type =".$eval['eval_type']."")->num_rows();
			if($verify != 0){
				$this->session->set_flashdata('active',1);
	            $this->session->set_flashdata('title',"Evaluation type Already register...");
	            $this->session->set_flashdata('text',"");
	            $this->session->set_flashdata('type',"warning");
				redirect('School_class/eval_details');
			}
			else{
				$con = $this->Class_model->eval_registration($eval);
			}
			$this->session->set_flashdata('active',1);
            $this->session->set_flashdata('title',"Evaluation Added Successfully.");
            $this->session->set_flashdata('text',"");
            $this->session->set_flashdata('type',"success");
			redirect('School_class/eval_details');
		}

		function delete_eval($eval_id)
		{
			$this->session->set_userdata('evaluation',$eval_id);
			redirect('School_class/detele_evaluation_details');
		}

		function detele_evaluation_details()
		{
			$eval_id = $this->session->userdata('evaluation');
			$school_admin = $this->session->userdata('school');
			$eval['eval_school_profile_id'] = $school_admin[0]['employee_school_profile_id'];
			$verify = $this->db->query("SELECT * FROM subject where subject_school_profile_id =".$eval['eval_school_profile_id']." and subject_eval_id =".$eval_id." and subject_expiry_date='9999-12-31'")->num_rows();
			switch ($verify) {
				case '0':
					$con = $this->Class_model->detele_evaluation_details($eval_id);
					if($con == 0){
						$this->session->set_flashdata('active',1);
			            $this->session->set_flashdata('title',"Evaluation Deleted Successfully.");
			            $this->session->set_flashdata('text',"");
			            $this->session->set_flashdata('type',"success");
						redirect('School_class/eval_details');
					}
				default:
					$this->session->set_flashdata('active',1);
		            $this->session->set_flashdata('title',"Evaluation Can't Deleted.");
		            $this->session->set_flashdata('text',"Please contact to admin.");
		            $this->session->set_flashdata('type',"warning");
					redirect('School_class/eval_details');
			}
			
		}
	}
 ?>