<?php
	class Notification extends CI_Controller
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

		function notification_details()
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
			$noti['flash']['active'] = $this->session->flashdata('active');
        	$noti['flash']['title'] = $this->session->flashdata('title');
        	$noti['flash']['text'] = $this->session->flashdata('text');
        	$noti['flash']['type'] = $this->session->flashdata('type');
        	
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
			$noti['class_details'] =  $this->Notification_model->fetch_class($employee_school_profile_id);
			$noti['school_parentmeet_sms'] =  $school_admin[0]['school_parentmeet_sms'];
			$noti['school_newsfeed_sms'] =  $school_admin[0]['school_newsfeed_sms'];
			$noti['school_circular_sms'] =  $school_admin[0]['school_circular_sms'];
			$noti['school_event_sms'] =  $school_admin[0]['school_event_sms'];
			$noti['notification'] =  $this->Notification_model->fetch_notification($employee_school_profile_id);
			$nav['school_name'] = $school_admin[0]['school_name'];
			$nav['school_logo'] = $school_admin[0]['school_logo'];
			$nav['notification'] = 'notification';
			if (isset($this->session->userdata['school'])) {
				$this->load->view('School/school_header', $admin);
        	}elseif (isset($this->session->userdata['teacher'])) {
				$this->load->view('Teacher/teacher_header', $admin);
        	}
			$this->load->view('Notification/notification_details',$noti);
			$this->load->view('Notification/notification_footer',$nav);
		}

		function fetch_division_acc_class()
		{
			$school_admin = $this->session->userdata('school');
			$student['class_id'] = $_POST['class_id'];
			$student['employee_school_profile_id'] = $school_admin[0]['employee_school_profile_id'];
			$student['AY_id'] = $school_admin[0]['school_AY_id'];
			$data = $this->Notification_model->fetch_division_acc_class($student);
			echo json_encode($data);
		}

		function fetch_student_acor_class()
		{
			$school_admin = $this->session->userdata('school');
			$student['class_id'] = $_POST['class_id'];
			$student['employee_school_profile_id'] = $school_admin[0]['employee_school_profile_id'];
			$student['AY_id'] = $school_admin[0]['school_AY_id'];
			$data = $this->Notification_model->fetch_student_acor_class($student);
			echo json_encode($data);
		}

		function fetch_student_acor_division()
		{
			$school_admin = $this->session->userdata('school');
			$student['division_id'] = $_POST['division_id'];
			$student['employee_school_profile_id'] = $school_admin[0]['employee_school_profile_id'];
			$student['AY_id'] = $school_admin[0]['school_AY_id'];
			$data = $this->Notification_model->fetch_student_acor_division($student);
			echo json_encode($data);
		}

		function fetch_student_acor_class_division()
		{
			$school_admin = $this->session->userdata('school');
			$student['class_id'] = $_POST['class_id'];
			$student['division_id'] = $_POST['division_id'];
			$student['employee_school_profile_id'] = $school_admin[0]['employee_school_profile_id'];
			$student['AY_id'] = $school_admin[0]['school_AY_id'];
			$data = $this->Notification_model->fetch_student_acor_class_division($student);
			echo json_encode($data);
		}

		function fetch_student_acor_school()
		{
			$school_admin = $this->session->userdata('school');
			$student['employee_school_profile_id'] = $school_admin[0]['employee_school_profile_id'];
			$student['AY_id'] = $school_admin[0]['school_AY_id'];
			$data = $this->Notification_model->fetch_student_acor_school($student);
			echo json_encode($data);
		}

		function add_parent_meeting()
		{
			$school_admin = $this->session->userdata('school');
			$signature = $this->db->query('select institute_sender_id,institute_signature from institute where institute_profile_id=(select school_institute_profile_id from school where school_profile_id='.$school_admin[0]['employee_school_profile_id'].')')->result_array();
			$student['notifi_student_profile_id'] = $this->input->post('notifi_student_profile_id');
			$notifi_sms = $this->input->post('notifi_sms');
			$cnt = count($student['notifi_student_profile_id']);
			if ($cnt == 0) {
				$this->session->set_flashdata('active',1);
	            $this->session->set_flashdata('title',"Please Select the student.");
	            $this->session->set_flashdata('text',"");
	            $this->session->set_flashdata('type',"warning");
	            redirect('Notification/notification_details');
			}else{
				for ($i=0; $i < $cnt; $i++) { 
					$Notification['notifi_student_profile_id'] = $student['notifi_student_profile_id'][$i];
					$Notification['notifi_msg'] = $this->input->post('notifi_msg');
					$Notification['notifi_title'] = $this->input->post('notifi_title');
					$Notification['notifi_date'] = $this->input->post('notifi_date');
					$Notification['notifi_time'] = date("H:i", strtotime($this->input->post('notifi_time')));
					$Notification['notifi_datetime'] = date('Y-m-d H:i:s');
					$Notification['notifi_AY_id'] = $school_admin[0]['school_AY_id'];
					$Notification['notifi_type'] = '11';
					$Notification['notifi_school_profile_id'] = $school_admin[0]['employee_school_profile_id'];
					$this->Notification_model->parent_notification($Notification);
					if($notifi_sms == 'on'){
						$number = '';
						$mobile_number = $this->db->query("SELECT * FROM parent join student on parent_student_profile_id = student_profile_id and parent_profile_id = student_parent_id where student_profile_id = ".$student['notifi_student_profile_id'][$i]."")->result_array();
						// $number = "9822230351";
						$msg = "Dear Parent, \nYou are requested to attend \nParent Meeting on"." ".$Notification['notifi_date']." ".$this->input->post('notifi_time').".\nFor more information, please check notifications. \nRegards, \n".$signature[0]['institute_signature'].".";
						$check = $this->Enquiry_model->check_sms_active($school_admin[0]['employee_school_profile_id']);
						if(count($mobile_number) > 0)
						{
							$number = $mobile_number[0]['parent_mobile_number'];
						}
						else
						{
							$number = NULL;
						}
						if(!empty($number) || !is_null($number) ){
							if($school_admin[0]['school_parentmeet_sms'] == 1 && $check[0]['institute_sms_credit'] > 0){
								$sms_status = $this->Student_model->sms($number,$msg,$signature[0]['institute_sender_id']);
								$res_explode = explode(':', $sms_status);
				
								$this->Enquiry_model->set_count($check[0]['school_institute_profile_id']);
								$sent['sent_sms_type'] = 2;
								$sent['sent_sms_sub_type'] = 11;
								$sent['sent_sms_mobile_number'] = $number;
								$sent['sent_sms_language'] = 1;
								$sent['sent_sms_MsgID'] = $res_explode[1];
								$sent['sent_sms_status'] =  $res_explode[4];
								$sent['sent_sms_count'] = 1;
								$sent['sent_sms_MSG'] = $msg ;
								$sent['sent_sms_student_profile_id'] = $student['notifi_student_profile_id'][$i];
								$sent['sent_sms_school_profile_id'] = $school_admin[0]['employee_school_profile_id'];
								$this->Enquiry_model->add_sent_sms($sent);
							}
						}
					}
				}
				$this->session->set_flashdata('active',1);
	            $this->session->set_flashdata('title',"Parent Meeting Successfully Submited");
	            $this->session->set_flashdata('text',"");
	            $this->session->set_flashdata('type',"success");
				redirect('Notification/notification_details');
			}
		}

		function add_event_notification()
		{
			$school_admin = $this->session->userdata('school');
			$signature = $this->db->query('select institute_sender_id,institute_signature from institute where institute_profile_id=(select school_institute_profile_id from school where school_profile_id='.$school_admin[0]['employee_school_profile_id'].')')->result_array();
			$student['notifi_student_profile_id'] = $this->input->post('notifi_student_profile_id');
			$notifi_sms = $this->input->post('notifi_sms');
			$cnt = count($student['notifi_student_profile_id']);
			if ($cnt == 0) {
				$this->session->set_flashdata('active',1);
	            $this->session->set_flashdata('title',"Please Select the student.");
	            $this->session->set_flashdata('text',"");
	            $this->session->set_flashdata('type',"warning");
	            redirect('Notification/notification_details');
			}else{
				for ($i=0; $i < $cnt; $i++) { 
					$Notification['notifi_student_profile_id'] = $student['notifi_student_profile_id'][$i];
					$Notification['notifi_msg'] = $this->input->post('notifi_msg');
					$Notification['notifi_title'] = $this->input->post('notifi_title');
					$Notification['notifi_date'] = $this->input->post('notifi_date');
					$Notification['notifi_time'] = date("H:i", strtotime($this->input->post('notifi_time')));
					$Notification['notifi_datetime'] = date('Y-m-d H:i:s');
					$Notification['notifi_AY_id'] = $school_admin[0]['school_AY_id'];
					$Notification['notifi_type'] = '14';
					$Notification['notifi_school_profile_id'] = $school_admin[0]['employee_school_profile_id'];
					$this->Notification_model->parent_notification($Notification);
					if($notifi_sms == 'on'){
						$number = '';
						$mobile_number = $this->db->query("SELECT * FROM parent join student on parent_student_profile_id = student_profile_id and parent_profile_id = student_parent_id where student_profile_id = ".$student['notifi_student_profile_id'][$i]."")->result_array();
						// $number = "9822230351";
						$msg = "Dear Parent, \nSchool Event Details held on ".$Notification['notifi_date']." at ".$this->input->post('notifi_time').".\nFor more details please check Notification.\nRegards, \n".$signature[0]['institute_signature'].".";
						$check = $this->Enquiry_model->check_sms_active($school_admin[0]['employee_school_profile_id']);
						if(count($mobile_number) > 0)
						{
							$number = $mobile_number[0]['parent_mobile_number'];
						}
						else
						{
							$number = NULL;
						}
						if(!empty($number) || !is_null($number) ){
							if($school_admin[0]['school_event_sms'] == 1 && $check[0]['institute_sms_credit'] > 0){
								$sms_status = $this->Student_model->sms($number,$msg,$signature[0]['institute_sender_id']);
								$res_explode = explode(':', $sms_status);
				
								$this->Enquiry_model->set_count($check[0]['school_institute_profile_id']);
								$sent['sent_sms_type'] = 2;
								$sent['sent_sms_sub_type'] = 14;
								$sent['sent_sms_mobile_number'] = $number;
								$sent['sent_sms_language'] = 1;
								$sent['sent_sms_MsgID'] = $res_explode[1];
								$sent['sent_sms_status'] =  $res_explode[4];
								$sent['sent_sms_count'] = 1;
								$sent['sent_sms_MSG'] = $msg ;
								$sent['sent_sms_student_profile_id'] = $student['notifi_student_profile_id'][$i];
								$sent['sent_sms_school_profile_id'] = $school_admin[0]['employee_school_profile_id'];
								$this->Enquiry_model->add_sent_sms($sent);
							}
						}
					}
				}
				$this->session->set_flashdata('active',1);
	            $this->session->set_flashdata('title',"Event NotificationSuccessfully Submited");
	            $this->session->set_flashdata('text',"");
	            $this->session->set_flashdata('type',"success");
				redirect('Notification/notification_details');
			}
		}

		function add_circular_notification()
		{
			$school_admin = $this->session->userdata('school');
			$signature = $this->db->query('select institute_sender_id,institute_signature from institute where institute_profile_id=(select school_institute_profile_id from school where school_profile_id='.$school_admin[0]['employee_school_profile_id'].')')->result_array();
			$student['notifi_student_profile_id'] = $this->input->post('notifi_student_profile_id');
			$notifi_sms = $this->input->post('notifi_sms');
			$cnt = count($student['notifi_student_profile_id']);
			if ($cnt == 0) {
				$this->session->set_flashdata('active',1);
	            $this->session->set_flashdata('title',"Please Select the student.");
	            $this->session->set_flashdata('text',"");
	            $this->session->set_flashdata('type',"warning");
	            redirect('Notification/notification_details');
			}else{
				for ($i=0; $i < $cnt; $i++) { 
					$Notification['notifi_student_profile_id'] = $student['notifi_student_profile_id'][$i];
					$Notification['notifi_msg'] = $this->input->post('notifi_msg');
					$Notification['notifi_title'] = $this->input->post('notifi_title');
					$Notification['notifi_date'] = $this->input->post('notifi_date');
					$Notification['notifi_time'] = date("H:i", strtotime($this->input->post('notifi_time')));
					$Notification['notifi_datetime'] = date('Y-m-d H:i:s');
					$Notification['notifi_AY_id'] = $school_admin[0]['school_AY_id'];
					$Notification['notifi_img'] = $this->upload('notifi_img','notifi_img');
					$Notification['notifi_type'] = '13';
					$Notification['notifi_school_profile_id'] = $school_admin[0]['employee_school_profile_id'];
					$this->Notification_model->parent_notification($Notification);
					if($notifi_sms == 'on'){
						$number = '';
						$mobile_number = $this->db->query("SELECT * FROM parent join student on parent_student_profile_id = student_profile_id and parent_profile_id = student_parent_id where student_profile_id = ".$student['notifi_student_profile_id'][$i]."")->result_array();
						// $number = "9822230351";
						$msg = "Dear Parent, \nKindly check notifications to know about School Circular Notice with Title : "." ".$Notification['notifi_title'].". \nRegards, \n".$signature[0]['institute_signature'].".";
						$check = $this->Enquiry_model->check_sms_active($school_admin[0]['employee_school_profile_id']);
						if(count($mobile_number) > 0)
						{
							$number = $mobile_number[0]['parent_mobile_number'];
						}
						else
						{
							$number = NULL;
						}
						if(!empty($number) || !is_null($number) ){
							if($school_admin[0]['school_circular_sms'] == 1 && $check[0]['institute_sms_credit'] > 0){
								$sms_status = $this->Student_model->sms($number,$msg,$signature[0]['institute_sender_id']);
								$res_explode = explode(':', $sms_status);
				
								$this->Enquiry_model->set_count($check[0]['school_institute_profile_id']);
								$sent['sent_sms_type'] = 2;
								$sent['sent_sms_sub_type'] = 13;
								$sent['sent_sms_mobile_number'] = $number;
								$sent['sent_sms_language'] = 1;
								$sent['sent_sms_MsgID'] = $res_explode[1];
								$sent['sent_sms_status'] =  $res_explode[4];
								$sent['sent_sms_count'] = 1;
								$sent['sent_sms_MSG'] = $msg ;
								$sent['sent_sms_student_profile_id'] = $student['notifi_student_profile_id'][$i];
								$sent['sent_sms_school_profile_id'] = $school_admin[0]['employee_school_profile_id'];
								$this->Enquiry_model->add_sent_sms($sent);
							}
						}
					}
				}
				$this->session->set_flashdata('active',1);
	            $this->session->set_flashdata('title'," Circular Notification Send.");
	            $this->session->set_flashdata('text',"");
	            $this->session->set_flashdata('type',"success");
				redirect('Notification/notification_details');
			}
		}

		function add_news_notification()
		{
			$school_admin = $this->session->userdata('school');
			$signature = $this->db->query('select institute_sender_id,institute_signature from institute where institute_profile_id=(select school_institute_profile_id from school where school_profile_id='.$school_admin[0]['employee_school_profile_id'].')')->result_array();
			$student['notifi_student_profile_id'] = $this->input->post('notifi_student_profile_id');
			$notifi_sms = $this->input->post('notifi_sms');
			$Notification['notifi_img'] = $this->upload('notifi_img','notifi_img');
			$cnt = count($student['notifi_student_profile_id']);
			if ($cnt == 0) {
				$this->session->set_flashdata('active',1);
	            $this->session->set_flashdata('title',"Please Select the student.");
	            $this->session->set_flashdata('text',"");
	            $this->session->set_flashdata('type',"warning");
	            redirect('Notification/notification_details');
			}else{
				for ($i=0; $i < $cnt; $i++) { 
					$Notification['notifi_student_profile_id'] = $student['notifi_student_profile_id'][$i];
					$Notification['notifi_msg'] = $this->input->post('notifi_msg');
					$Notification['notifi_title'] = $this->input->post('notifi_title');
					$Notification['notifi_date'] = $this->input->post('notifi_date');
					$Notification['notifi_time'] = date("H:i", strtotime($this->input->post('notifi_time')));
					$Notification['notifi_datetime'] = date('Y-m-d H:i:s');
					$Notification['notifi_AY_id'] = $school_admin[0]['school_AY_id'];
					$Notification['notifi_type'] = '12';
					$Notification['notifi_school_profile_id'] = $school_admin[0]['employee_school_profile_id'];
					$this->Notification_model->parent_notification($Notification);
					if($notifi_sms == 'on'){
						$number = '';
						$mobile_number = $this->db->query("SELECT * FROM parent join student on parent_student_profile_id = student_profile_id and parent_profile_id = student_parent_id where student_profile_id = ".$student['notifi_student_profile_id'][$i]."")->result_array();
						// $number = "9822230351";
						$msg = "Dear Parent, \nKindly check notifications for updates in Newsfeed"." ".$Notification['notifi_title'].". \nRegards, \n".$signature[0]['institute_signature'].".";
						$check = $this->Enquiry_model->check_sms_active($school_admin[0]['employee_school_profile_id']);
						if(count($mobile_number) > 0)
						{
							$number = $mobile_number[0]['parent_mobile_number'];
						}
						else
						{
							$number = NULL;
						}
						if(!empty($number) || !is_null($number) ){
							if($school_admin[0]['school_newsfeed_sms'] == 1 && $check[0]['institute_sms_credit'] > 0){
								$sms_status = $this->Student_model->sms($number,$msg,$signature[0]['institute_sender_id']);
								$res_explode = explode(':', $sms_status);
				
								$this->Enquiry_model->set_count($check[0]['school_institute_profile_id']);
								$sent['sent_sms_type'] = 2;
								$sent['sent_sms_sub_type'] = 12;
								$sent['sent_sms_mobile_number'] = $number;
								$sent['sent_sms_language'] = 1;
								$sent['sent_sms_MsgID'] = $res_explode[1];
								$sent['sent_sms_status'] =  $res_explode[4];
								$sent['sent_sms_count'] = 1;
								$sent['sent_sms_MSG'] = $msg ;
								$sent['sent_sms_student_profile_id'] = $student['notifi_student_profile_id'][$i];
								$sent['sent_sms_school_profile_id'] = $school_admin[0]['employee_school_profile_id'];
								$this->Enquiry_model->add_sent_sms($sent);
							}
						}
					}
				}
				$this->session->set_flashdata('active',1);
	            $this->session->set_flashdata('title',"News Notification Successfully Send.");
	            $this->session->set_flashdata('text',"");
	            $this->session->set_flashdata('type',"success");
				redirect('Notification/notification_details');
			}
		}

		function add_personal_notification()
		{
			$school_admin = $this->session->userdata('school');
			$signature = $this->db->query('select institute_sender_id,institute_signature from institute where institute_profile_id=(select school_institute_profile_id from school where school_profile_id='.$school_admin[0]['employee_school_profile_id'].')')->result_array();
			$student['notifi_student_profile_id'] = $this->input->post('notifi_student_profile_id');
			$notifi_sms = $this->input->post('notifi_sms');
			$msg_cnt = $this->input->post('msg_cnt');
			$cnt = count($student['notifi_student_profile_id']);
			if ($cnt == 0) {
				$this->session->set_flashdata('active',1);
	            $this->session->set_flashdata('title',"Please Select the student.");
	            $this->session->set_flashdata('text',"");
	            $this->session->set_flashdata('type',"warning");
	            redirect('Notification/notification_details');
			}else{
				for ($i=0; $i < $cnt; $i++) { 
					$Notification['notifi_student_profile_id'] = $student['notifi_student_profile_id'][$i];
					$Notification['notifi_msg'] = $this->input->post('notifi_msg');
					$Notification['notifi_title'] = $this->input->post('notifi_title');
					$Notification['notifi_date'] = $this->input->post('notifi_date');
					$Notification['notifi_time'] = date("H:i", strtotime($this->input->post('notifi_time')));
					$Notification['notifi_datetime'] = date('Y-m-d H:i:s');
					$Notification['notifi_AY_id'] = $school_admin[0]['school_AY_id'];
					$Notification['notifi_type'] = '8';
					$Notification['notifi_school_profile_id'] = $school_admin[0]['employee_school_profile_id'];
					$this->Notification_model->parent_notification($Notification);
					if($notifi_sms == 'on'){
						$number = '';
						$mobile_number = $this->db->query("SELECT * FROM parent join student on parent_student_profile_id = student_profile_id and parent_profile_id = student_parent_id where student_profile_id = ".$student['notifi_student_profile_id'][$i]."")->result_array();
						$check = $this->Enquiry_model->check_sms_active($school_admin[0]['employee_school_profile_id']);
						if(count($mobile_number) > 0)
						{
							$number = $mobile_number[0]['parent_mobile_number'];
						}
						else
						{
							$number = NULL;
						}
						if(!empty($number) || !is_null($number) ){	
							if($school_admin[0]['school_newsfeed_sms'] == 1 && $check[0]['institute_sms_credit'] > 0){
								$sms_status = $this->Student_model->uni_sms($number,$Notification['notifi_msg'],$signature[0]['institute_sender_id']);
								$res_explode = explode(':', $sms_status);
								// $this->Enquiry_model->set_count($check[0]['school_institute_profile_id']);

								$this->db->query("UPDATE institute SET institute_sms_credit = institute_sms_credit - ".$msg_cnt." WHERE institute_profile_id = ".$check[0]['school_institute_profile_id']."");

								$sent['sent_sms_type'] = 2;
								$sent['sent_sms_sub_type'] = 8;
								$sent['sent_sms_mobile_number'] = $number;
								$sent['sent_sms_language'] = 1;
								$sent['sent_sms_MsgID'] = $res_explode[1];
								$sent['sent_sms_status'] =  $res_explode[4];
								$sent['sent_sms_count'] = $msg_cnt;
								$sent['sent_sms_MSG'] = $Notification['notifi_msg'] ;
								$sent['sent_sms_student_profile_id'] = $student['notifi_student_profile_id'][$i];
								$sent['sent_sms_school_profile_id'] = $school_admin[0]['employee_school_profile_id'];
						
								$this->Enquiry_model->add_sent_sms($sent);
							}
						}
					}
				}
				$this->session->set_flashdata('active',1);
	            $this->session->set_flashdata('title',"Personal Notification Successfully Send.");
	            $this->session->set_flashdata('text',"");
	            $this->session->set_flashdata('type',"success");
				redirect('Notification/notification_details');
			}
		}

		function upload($file,$folder)						
		{
			$config = array(
				'upload_path' => 'profile_photo/',
				'upload_url' => base_url().'profile_photo/',
				'allowed_types' => 'jpg|jpeg|gif|png',
				'encrypt_name' => TRUE,
				);
			$this->upload->initialize($config);
			if(!$this->upload->do_upload($file)){
				$user_photo = '';
				return $user_photo;
			}
			else{
				$upload_files = array('upload_data' => $this->upload->data());

				$user_photo = base_url().'profile_photo/'.$upload_files['upload_data']['file_name'];
				$this->upload->data();

				return $user_photo;
			}
		}
	}
 ?>