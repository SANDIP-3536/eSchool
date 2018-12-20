<?php

	defined('BASEPATH') OR exit('No direct script access allowed');
	
	class Tracking extends CI_Controller
	{

		function index()
		{
			if(!isset($this->session->userdata['school']))
			{
				redirect('/');
			} 
			if(isset($this->session->userdata['direct'])){
				$admin['direct'] = $this->session->userdata('direct');
			}
			else{
				$admin['direct'] = 1;
			} 
			$nav['flash']['active'] = $this->session->flashdata('active');
        	$nav['flash']['title'] = $this->session->flashdata('title');
        	$nav['flash']['text'] = $this->session->flashdata('text');
        	$nav['flash']['type'] = $this->session->flashdata('type');
        	
			$school_admin = $this->session->userdata('school');
			$school_client_profile_id = $school_admin[0]['school_client_profile_id'];
			// echo "<pre>";print_r($school_admin);die();
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

			$tracking['class'] =  $this->db->query("SELECT * FROM class where class_school_profile_id = ".$employee_school_profile_id." and class_expiry_date='9999-12-31' GROUP BY class_name")->result_array();

			
			$nav['school_name'] = $school_admin[0]['school_name'];
			$nav['school_logo'] = $school_admin[0]['school_logo'];
			$nav['tracking'] = 'tracking';

			// echo "<pre>"; print_r($tracking);die();
			$this->load->view('School/school_header', $admin);
			if ($school_client_profile_id != 0) 
			{
				$this->load->view('Tracking/tracking_assgn',$tracking);
			}elseif ($school_client_profile_id == 0) 
			{
				$this->load->view('Tracking/tracking_assgn_null');
			}
			$this->load->view('Tracking/tracking_footer',$nav);
		}
		function fetch_class_division()
		{
			$school_admin = $this->session->userdata('school');
			$class_id = $_POST['class_id'];
			$school_id = $school_admin[0]['employee_school_profile_id'];
			$data = $this->db->query("SELECT * FROM division where division_class_id =".$class_id." and division_school_profile_id =".$school_id." and division_expiry_date = '9999-12-31' GROUP BY division_name")->result_array();
			echo json_encode($data);
		}
		function fetch_class_division_student()
		{
			$school_admin = $this->session->userdata('school');
			$student['employee_school_profile_id'] = $school_admin[0]['employee_school_profile_id'];
			$student['AY_id'] = $school_admin[0]['AY_id'];
			$student['class_id'] = $_POST['class_id'];
			// $data = $this->db->query("SELECT * FROM `student_class_division_assgn` join student on SCD_student_profile_id = student_profile_id where SCD_class_id =".$student['class_id']." and SCD_school_profile_id =".$student['employee_school_profile_id']." and SCD_expiry_date = '9999-12-31'")->result_array();
			$data = $this->db->query("SELECT student_GRN,division_name,student_first_name,student_middle_name,student_last_name,tmp1.parent_profile_id as father,tmp2.parent_profile_id as mother,tmp3.parent_profile_id as gardian,tmp1.parent_trackmee_user_id as father_user,tmp2.parent_trackmee_user_id as mother_user,tmp3.parent_trackmee_user_id as gardian_user FROM `student_class_division_assgn` join student on SCD_student_profile_id = student_profile_id 
										left join division on SCD_division_id=division_id
										LEFT JOIN (SELECT parent_profile_id,parent_trackmee_user_id,parent_student_profile_id FROM parent WHERE parent_type = 1 and parent_expiry_date='9999-12-31')as tmp1 on tmp1.parent_student_profile_id = student_profile_id
										LEFT JOIN (SELECT parent_profile_id,parent_trackmee_user_id,parent_student_profile_id FROM parent WHERE parent_type = 2 and parent_expiry_date='9999-12-31')as tmp2 on tmp2.parent_student_profile_id = student_profile_id
										LEFT JOIN (SELECT parent_profile_id,parent_trackmee_user_id,parent_student_profile_id FROM parent WHERE parent_type = 3 and parent_expiry_date='9999-12-31')as tmp3 on tmp3.parent_student_profile_id = student_profile_id
										where SCD_class_id =".$student['class_id']." and SCD_school_profile_id =".$student['employee_school_profile_id']." and SCD_AY_id= ".$student['AY_id']." and SCD_expiry_date = '9999-12-31' order by student_GRN")->result_array();
			echo json_encode($data);
		}
		function fetch_division_class_student()
		{
			$school_admin = $this->session->userdata('school');
			$student['employee_school_profile_id'] = $school_admin[0]['employee_school_profile_id'];
			$student['class_id'] = $_POST['class_id'];
			$student['division_id'] = $_POST['division_id'];
			$data = $this->db->query("SELECT * FROM `student_class_division_assgn` join student on SCD_student_profile_id = student_profile_id where SCD_class_id =".$student['class_id']." and SCD_division_id =".$student['division_id']." and SCD_school_profile_id =".$student['employee_school_profile_id']." and SCD_expiry_date = '9999-12-31'")->result_array();
			echo json_encode($data);
		}
		function assign_tracking()
		{
			$school_admin = $this->session->userdata('school');
			$school_client_profile_id = $school_admin[0]['school_client_profile_id'];

			$data['student_class'] = $this->input->post('student_class');
			$data['parent_profile_id'] = $this->input->post('parent_profile_id');

			// echo "<pre>";print_r($data);die();

			for ($i=0; $i <count($data['parent_profile_id']) ; $i++) 
			{ 
				$parent_profile_id = $data['parent_profile_id'][$i];	
				$parent = $this->db->query('SELECT * FROM `parent` WHERE parent_profile_id ='.$parent_profile_id.' ')->row();
				$parent_credential = $this->db->query('SELECT * FROM `credential` WHERE credential_user_type = "7" AND credential_profile_id = "'.$parent_profile_id.'"')->row();
				$track['user_photo'] = $parent->parent_photo;
				$track['user_first_name'] = $parent->parent_first_name;
				$track['user_middle_name'] = $parent->parent_middle_name;
				$track['user_last_name'] = $parent->parent_last_name;
				$track['user_DOB'] = $parent->parent_DOB;
				$track['user_gender'] = $parent->parent_gender;
				$track['user_address'] = $parent->parent_address;
				$track['user_mobile_number'] = $parent->parent_mobile_number;
				$track['user_email_id'] = $parent->parent_email_id;
				$track['user_effective_date'] = date('Y-m-d');
				$track['user_student_profile_id'] = $parent->parent_student_profile_id;
				$track['user_client_profile_id'] = $school_client_profile_id;

				$track['credential_username'] = urlencode($parent_credential->credential_username);
				$track['credential_password'] = urlencode($parent_credential->credential_password);
				// echo "<pre>";print_r($track);die();

				$track['user_photo'] = urlencode($track['user_photo']);
				$track['user_first_name'] = urlencode($track['user_first_name']);
				$track['user_middle_name'] = urlencode($track['user_middle_name']);
				$track['user_last_name'] = urlencode($track['user_last_name']);
				$track['user_DOB'] = urlencode($track['user_DOB']);
				$track['user_gender'] = urlencode($track['user_gender']);
				$track['user_address'] = urlencode($track['user_address']);
				$track['user_email_id'] = urlencode($track['user_email_id']);
				$track['user_effective_date'] = urlencode($track['user_effective_date']);

				$path = "https://trackmee.syntech.co.in/trackmee/api_trackmee/user_registration?user_photo=".$track['user_photo']."&user_first_name=".$track['user_first_name']."&user_middle_name=".$track['user_middle_name']."&user_last_name=".$track['user_last_name']."&user_DOB=".$track['user_DOB']."&user_gender=".$track['user_gender']."&user_address=".$track['user_address']."&user_mobile_number=".$track['user_mobile_number']."&user_email_id=".$track['user_email_id']."&user_effective_date=".$track['user_effective_date']."&user_student_profile_id=".$track['user_student_profile_id']."&user_client_profile_id=".$track['user_client_profile_id']."&credential_username=".$track['credential_username']."&credential_password=".$track['credential_password']."";
				// print_r($path);die();
			    $ch=curl_init();
			    curl_setopt($ch,CURLOPT_URL,$path);
			    curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
			    $output =curl_exec($ch);
			    $res = json_decode($output);
			    // print_r($res);die();
			    $parent_update['parent_trackmee_user_id'] = $res->user_profile_id;
			    $parent_update['parent_profile_id'] = $parent->parent_profile_id;
			    $this->db->set($parent_update)->where('parent_profile_id',$parent_update['parent_profile_id'])->update("parent", $parent_update);
			}

			$this->session->set_flashdata('active',1);
	        $this->session->set_flashdata('title',"Student Assign To Tracking Successfully.");
	        $this->session->set_flashdata('text',"");
	        $this->session->set_flashdata('type',"success");
			redirect('Tracking');
		}
		public function assign_client_id()
		{
			if(!isset($this->session->userdata['Institute']))
			{
				redirect('/');
			} 
			$institute_admin = $this->session->userdata('Institute');
			$nav['flash']['active'] = $this->session->flashdata('active');
	    	$nav['flash']['title'] = $this->session->flashdata('title');
	    	$nav['flash']['text'] = $this->session->flashdata('text');
	    	$nav['flash']['type'] = $this->session->flashdata('type');
			
			$school_institute_profile_id = $institute_admin[0]['employee_school_profile_id'];
			$admin['user'] = $institute_admin[0]['employee_pri_mobile_number'];
			$admin['photo'] = $institute_admin[0]['employee_photo'];
			$admin['first_name'] = $institute_admin[0]['employee_first_name'];
			$admin['last_name'] = $institute_admin[0]['employee_last_name'];
			$admin['email_id'] = $institute_admin[0]['employee_email_id'];
			$admin['username'] = $institute_admin[0]['credential_username'];
			$nav['institute_name'] = $institute_admin[0]['institute_name'];
			$nav['institute_logo'] = $institute_admin[0]['institute_logo'];
			$nav['insti_admin'] = "tracking";

			$school_details['all_school'] = $this->db->query("SELECT * from school where school_institute_profile_id=".$school_institute_profile_id."")->result_array();
			// echo "<pre>";print_r($school_details['all_school']);die();
			$this->load->view('Institute/institute_header', $admin);
			$this->load->view('Tracking/institute_assign_client',$school_details);
			$this->load->view('School/school_footer',$nav);
		}
		public function get_client_id()
		{
			$client['username'] = $_POST['username'];
			$client['password'] = $_POST['password'];
			$client['mob_token'] = $_POST['username'];

			$post = [
			    'username' => $client['username'],
			    'password' => $client['password'],
			    'mob_token'   => $client['mob_token'],
			];

			$ch = curl_init('https://trackmee.syntech.co.in/trackmee/api_trackmee/trackmee_login');
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
			curl_setopt($ch, CURLOPT_POSTFIELDS, $post);
			$response = curl_exec($ch);
			curl_close($ch);
			$res = json_decode($response);
			echo json_encode($res);
		}
		public function assign_school_tracking()
		{
			$assgn['school_client_profile_id'] = $this->input->post('assgn_client_id');
			$assgn['school_profile_id'] = $this->input->post('assgn_school_id');

			$this->db->set($assgn)->where('school_profile_id',$assgn['school_profile_id'])->update("school", $assgn);
			redirect('Tracking/assign_client_id');
		}
		public function remove_client_id()
		{
			$assgn['school_client_profile_id'] = "0";
			$assgn['school_profile_id'] = $_POST['school_profile_id'];

			$this->db->set($assgn)->where('school_profile_id',$assgn['school_profile_id'])->update("school", $assgn);

			// $institute_admin = $this->session->userdata('Institute');
			// $school_institute_profile_id = $institute_admin[0]['employee_school_profile_id'];
			// $school_details = $this->db->query("SELECT * from school where school_institute_profile_id=".$school_institute_profile_id."")->result_array();
			// echo json_encode($school_details);
		}

}		