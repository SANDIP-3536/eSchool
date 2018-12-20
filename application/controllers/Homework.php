<?php
	date_default_timezone_set('Asia/Kolkata');
	class Homework extends CI_Controller
	{
		function homework_details()
		{
			if(!isset($this->session->userdata['teacher'])){
				redirect('/');
			}
			if(isset($this->session->userdata['direct'])){
				$admin['direct'] = $this->session->userdata('direct');
			}
			else{
				$admin['direct'] = 1;
			}
			$homework['flash']['active'] = $this->session->flashdata('active');
        	$homework['flash']['title'] = $this->session->flashdata('title');
        	$homework['flash']['text'] = $this->session->flashdata('text');
        	$homework['flash']['type'] = $this->session->flashdata('type');
        	
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
			$school_AY_id = $school_admin[0]['school_AY_id'];
			$homework['school_homework_sms'] = $school_admin[0]['school_homework_sms'];
			$employee_school_profile_id = $school_admin[0]['employee_school_profile_id'];
			$employee_profile_id = $school_admin[0]['employee_profile_id'];
			$homework['TCDS'] =  $this->Homework_model->fetch_TCDS($employee_school_profile_id,$school_AY_id,$employee_profile_id);
			$homework['TCD_details'] = $this->Homework_model->fetch_class_division_TCDS($employee_school_profile_id,$employee_profile_id,$school_AY_id);
			$homework['homework'] =  $this->Homework_model->fetch_homework($employee_school_profile_id,$school_AY_id);
			$nav['school_name'] = $school_admin[0]['school_name'];
			$nav['school_logo'] = $school_admin[0]['school_logo'];
			$nav['homework'] = 'homework';

			$this->load->view('Teacher/teacher_header', $admin);
			$this->load->view('Homework/homework_details',$homework);
			$this->load->view('Homework/homework_footer',$nav);
		}

		function fetch_student_acc_class_division()
		{
			$school_admin = $this->session->userdata('teacher');
			$std['student_school_profile_id'] = $school_admin[0]['employee_school_profile_id'];
			$std['AY_id'] = $school_admin[0]['school_AY_id'];
			$std['class'] = $_POST['class_id'];
			$std['division'] = $_POST['division_id'];
			$data = $this->Homework_model->fetch_student_acc_class_division($std);
			echo json_encode($data);
		}

		function homework_registration()
		{
			$school_admin = $this->session->userdata('teacher');
			$signature = $this->db->query('select institute_sender_id,institute_signature from institute where institute_profile_id=(select school_institute_profile_id from school where school_profile_id='.$school_admin[0]['employee_school_profile_id'].')')->result_array();
			$student['hw_student_profile_id'] = $this->input->post('hw_student_profile_id');
			$hw_sms_sent = $this->input->post('hw_sms_sent');
			$cnt = count($student['hw_student_profile_id']);
			if ($cnt == 0) {
				$this->session->set_flashdata('active',1);
	            $this->session->set_flashdata('title',"Please Select the student.");
	            $this->session->set_flashdata('text',"");
	            $this->session->set_flashdata('type',"warning");
	            redirect('Homework/homework_details');
			}else{
				for ($i=0; $i < $cnt; $i++) { 
					$HW['hw_student_profile_id'] = $student['hw_student_profile_id'][$i];
					$HW['hw_datetime'] = $this->input->post('hw_datetime');
					$HW['hw_TCDS_id'] = $this->input->post('hw_TCDS_id');
					$HW['hw_msg'] = $this->input->post('hw_msg');
					$HW['hw_end_date'] = $this->input->post('hw_end_date');
					$HW['hw_AY_id'] = $school_admin[0]['school_AY_id'];
					$HW['hw_school_profile_id'] = $school_admin[0]['employee_school_profile_id'];
					$con = $this->Homework_model->homework_registration($HW);
					if($hw_sms_sent == 'on'){
						$mobile_number = $this->db->query("SELECT * FROM parent join student on parent_student_profile_id = student_profile_id and parent_profile_id = student_parent_id where student_profile_id = ".$student['hw_student_profile_id'][$i]."")->result_array();
						$number = $mobile_number[0]['parent_mobile_number'];
						$msg = $HW['hw_msg'];
						$check = $this->Enquiry_model->check_sms_active($school_admin[0]['employee_school_profile_id']);
						if($school_admin[0]['school_homework_sms'] == 1 && $check[0]['institute_sms_credit'] > 0){
							$sms_status = $this->Student_model->sms($number,$msg,$signature[0]['institute_sender_id']);
							$res_explode = explode(':', $sms_status);
			
							$this->Enquiry_model->set_count($check[0]['school_institute_profile_id']);
							$sent['sent_sms_type'] = 2;
							$sent['sent_sms_sub_type'] = 16;
							$sent['sent_sms_mobile_number'] = $number;
							$sent['sent_sms_language'] = 1;
							$sent['sent_sms_MsgID'] = $res_explode[1];
							$sent['sent_sms_status'] =  $res_explode[4];
							$sent['sent_sms_count'] = 1;
							$sent['sent_sms_MSG'] = $msg ;
							$sent['sent_sms_student_profile_id'] = $student['hw_student_profile_id'][$i];
							$sent['sent_sms_school_profile_id'] = $school_admin[0]['employee_school_profile_id'];
							$this->Enquiry_model->add_sent_sms($sent);
						}
					}
				}
				$this->session->set_flashdata('active',1);
	            $this->session->set_flashdata('title',"Homework Successfully Submited");
	            $this->session->set_flashdata('text',"");
	            $this->session->set_flashdata('type',"success");
				redirect('Homework/homework_details');
			}
		}

		function edit_homework($hw_id)
		{
			$this->session->set_userdata('hw',$hw_id);
			redirect('Homework/update_hw');
		}

		function update_hw()
		{
			if(!isset($this->session->userdata['teacher'])){
				redirect('/');
			}
			if(isset($this->session->userdata['direct'])){
				$admin['direct'] = $this->session->userdata('direct');
			}
			else{
				$admin['direct'] = 1;
			}
			$homework['flash']['active'] = $this->session->flashdata('active');
        	$homework['flash']['title'] = $this->session->flashdata('title');
        	$homework['flash']['text'] = $this->session->flashdata('text');
        	$homework['flash']['type'] = $this->session->flashdata('type');
        	
			$hw_id = $this->session->userdata('hw');
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
			$homework['TCDS'] =  $this->Homework_model->fetch_TCDS($employee_school_profile_id);
			$homework['homework'] =  $this->Homework_model->homework_details($hw_id);
			$nav['school_name'] = $school_admin[0]['school_name'];
			$nav['school_logo'] = $school_admin[0]['school_logo'];
			$nav['education'] = 'education';

			$this->load->view('Teacher/teacher_header', $admin);
			$this->load->view('Homework/update_homework',$homework);
			$this->load->view('Homework/homework_footer',$nav);
		}

		function update_homework_details()
		{
			$school_admin = $this->session->userdata('teacher');
			$HW['hw_datetime'] = $this->input->post('hw_datetime').' '.date('H:i:s');
			$HW['hw_TCDS_id'] = $this->input->post('hw_TCDS_id');
			$HW['hw_id'] = $this->input->post('hw_id');
			$HW['hw_msg'] = $this->input->post('hw_msg');
			$HW['hw_end_date'] = $this->input->post('hw_end_date');
			$con = $this->Homework_model->update_homework($HW);
			if($con == 1){
				$this->session->set_flashdata('active',1);
	            $this->session->set_flashdata('title',"Homework Updated.");
	            $this->session->set_flashdata('text',"");
	            $this->session->set_flashdata('type',"warning");
	            redirect('Homework/homework_details');
			}else{
				$this->session->set_flashdata('active',1);
	            $this->session->set_flashdata('title',"Homework Not Updated.");
	            $this->session->set_flashdata('text',"");
	            $this->session->set_flashdata('type',"warning");
	            redirect('Homework/homework_details');
			}
		}
	}
 ?>