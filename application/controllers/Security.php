<?php
	defined('BASEPATH') OR exit('No direct script access allowed');
	date_default_timezone_set('Asia/Kolkata');
	class Security extends CI_Controller
	{
		function index()
		{
			if(!isset($this->session->userdata['security']))
			{
				redirect('/');
			} 
			$security_admin = $this->session->userdata('security');
			// print_r($security_admin);die();
			$security['user'] = $security_admin[0]['employee_pri_mobile_number'];
			$security['user_profile_id'] = $security_admin[0]['employee_profile_id'];
			$security['employee_type'] = $security_admin[0]['employee_type'];
			$security['photo'] = $security_admin[0]['employee_photo'];
			$employee_security_profile_id = $security_admin[0]['employee_school_profile_id'];
			$school_AY_id = $security_admin[0]['school_AY_id'];
			$security['first_name'] = $security_admin[0]['employee_first_name'];
			$security['last_name'] = $security_admin[0]['employee_last_name'];
			$security['email_id'] = $security_admin[0]['employee_email_id'];
			$security['username'] = $security_admin[0]['credential_username'];
			$security['AY_name'] = $security_admin[0]['AY_name'];
			$security['flash']['active'] = $this->session->flashdata('active');
	    	$security['flash']['title'] = $this->session->flashdata('title');
	    	$security['flash']['text'] = $this->session->flashdata('text');
	    	$security['flash']['type'] = $this->session->flashdata('type');

	    	$data['student'] = $this->db->query("SELECT student_profile_id,concat(student_last_name,' ',student_first_name,' ',student_middle_name)as student_name FROM `student` join school on student_school_profile_id = school_profile_id join institute on school_institute_profile_id = institute_profile_id where institute_profile_id = ".$security_admin[0]['institute_profile_id']." and institute_expiry_date = '9999-12-31'")->result_array();
	    	$data['token'] = $this->db->query("select number.* from (select	1	as no UNION select	2	as no UNION select	3	as no UNION select	4	as no UNION select	5	as no UNION select	6	as no UNION select	7	as no UNION select	8	as no UNION select	9	as no UNION select	10	as no UNION select	11	as no UNION select	12	as no UNION select	13	as no UNION select	14	as no UNION select	15	as no UNION select	16	as no UNION select	17	as no UNION select	18	as no UNION select	19	as no UNION select	20	as no UNION select	21	as no UNION select	22	as no UNION select	23	as no UNION select	24	as no UNION select	25	as no UNION select	26	as no UNION select	27	as no UNION select	28	as no UNION select	29	as no UNION select	30	as no UNION select	31	as no UNION select	32	as no UNION select	33	as no UNION select	34	as no UNION select	35	as no UNION select	36	as no UNION select	37	as no UNION select	38	as no UNION select	39	as no UNION select	40	as no UNION select	41	as no UNION select	42	as no UNION select	43	as no UNION select	44	as no UNION select	45	as no UNION select	46	as no UNION select	47	as no UNION select	48	as no UNION select	49	as no UNION select	50	as no) as number where no NOT IN (select visitor_token from visitor where visitor.visitor_checkout_time IS Null and visitor_institute_id = ".$security_admin[0]['institute_profile_id']." )")->result_array();

	    	$data['visitor'] = $this->db->query("SELECT * FROM `visitor` where visitor_checkout_time is NULL and visitor_institute_id = ".$security_admin[0]['institute_profile_id']."")->result_array();
	    	$nav['institute_name'] = $security_admin[0]['institute_name'];
			$nav['institute_logo'] = $security_admin[0]['institute_logo'];

	    	// $school['dashboard'] = 'dashboard';
			$this->load->view('Security/security_header', $security);
			$this->load->view('Security/security_details',$data);
			$this->load->view('Security/security_footer',$nav);
		}

		function visitor(){
			if(!isset($this->session->userdata['school']))
			{
				redirect('/');
			} 
			if(isset($this->session->userdata['direct'])){
				$visitor['direct'] = $this->session->userdata('direct');
			}
			else{
				$visitor['direct'] = 1;
			}
			$school_admin = $this->session->userdata('school');
			// print_r($school_admin);die();
			$visitor['user'] = $school_admin[0]['employee_pri_mobile_number'];
			$visitor['user_profile_id'] = $school_admin[0]['employee_profile_id'];
			$visitor['employee_type'] = $school_admin[0]['employee_type'];
			$visitor['photo'] = $school_admin[0]['employee_photo'];
			$employee_school_profile_id = $school_admin[0]['employee_school_profile_id'];
			$school_AY_id = $school_admin[0]['school_AY_id'];
			$visitor['first_name'] = $school_admin[0]['employee_first_name'];
			$visitor['last_name'] = $school_admin[0]['employee_last_name'];
			$visitor['email_id'] = $school_admin[0]['employee_email_id'];
			$visitor['username'] = $school_admin[0]['credential_username'];
			$visitor['AY_name'] = $school_admin[0]['AY_name'];

			$visitor['flash']['active'] = $this->session->flashdata('active');
	    	$visitor['flash']['title'] = $this->session->flashdata('title');
	    	$visitor['flash']['text'] = $this->session->flashdata('text');
	    	$visitor['flash']['type'] = $this->session->flashdata('type');
	    	$visitor['school_name'] = $school_admin[0]['school_name'];
			$visitor['school_logo'] = $school_admin[0]['school_logo'];
			$visitor['visitor_token'] = $this->db->query("SELECT * FROM `visitor` where visitor_institute_id = (SELECT school_institute_profile_id from school where school_profile_id =".$school_admin[0]['employee_school_profile_id'].") and visitor_checkout_time is NULL")->result_array();
			$visitor['student'] = $this->db->query("SELECT student_profile_id,concat(student_last_name,' ',student_first_name,' ',student_middle_name)as student_name FROM `student` join school on student_school_profile_id = school_profile_id join institute on school_institute_profile_id = institute_profile_id where institute_profile_id = (SELECT school_institute_profile_id from school where school_profile_id =".$school_admin[0]['employee_school_profile_id'].") and institute_expiry_date = '9999-12-31'")->result_array();
			$visitor['visitor_data'] = $this->db->query("SELECT visitor.*,case when student_first_name is NULL then 'Unregister Student' else CONCAT(student_last_name,' ',student_first_name,' ',student_middle_name) end as student_name,get_pass_reason,get_pass_id FROM `visitor` left join student on visitor_student_id = student_profile_id left join get_pass on visitor_id = get_pass_visitor_id where visitor_institute_id = (SELECT school_institute_profile_id from school where school_profile_id = ".$school_admin[0]['employee_school_profile_id'].")")->result_array();
			// print_r($visitor['visitor_token']);die();

	    	$visitor['visitor'] = 'visitor';
			$this->load->view('School/school_header', $visitor);
			$this->load->view('Security/visitor_get_pass',$visitor);
		}

		function add_visitor_checkin()
		{
			if(!isset($this->session->userdata['security']))
			{
				redirect('/');
			} 
			$security_admin = $this->session->userdata('security');
			$visitor['visitor_student_id'] = $this->input->post('visitor_student_id');
			$visitor['visitor_photo'] = $this->visitor_upload('visitor_photo');
			$visitor['visitor_id_card_photo'] = $this->visitor_upload_ID('visitor_id_card_photo');
			$visitor['visitor_token'] = $this->input->post('visitor_token');
			$visitor['visitor_comment'] = $this->input->post('visitor_comment');
			$visitor['visitor_date'] = date('Y-m-d');
			$visitor['visitor_checkin_time'] = date('h:i a');
			$visitor['visitor_institute_id'] = $security_admin[0]['institute_profile_id'];
			$this->db->insert('visitor',$visitor);
			$this->session->set_flashdata('active',1);
            $this->session->set_flashdata('title',"Visitor Check IN Successfully.");
            $this->session->set_flashdata('text',"");
            $this->session->set_flashdata('type',"success");
			redirect('Security');
		}

		function visitor_upload($file)
		{
			$config = array(
				'upload_path' => 'Visitors/visitor_photo/',
				'upload_url' => base_url().'Visitors/visitor_photo/',
				'allowed_types' => 'jpg|jpeg|gif|png',
				'encrypt_name' => TRUE,
				);
			$this->upload->initialize($config);
			if($this->upload->do_upload($file)){
				$upload_files = array('upload_data' => $this->upload->data());
				$user_photo = base_url().'Visitors/visitor_photo/'.$upload_files['upload_data']['file_name'];
				$this->upload->data();

				return $user_photo;
			}
		}

		function visitor_upload_ID($file)
		{
			$config = array(
				'upload_path' => 'Visitors/visitor_id_card/',
				'upload_url' => base_url().'Visitors/visitor_id_card/',
				'allowed_types' => 'jpg|jpeg|gif|png',
				'encrypt_name' => TRUE,
				);
			$this->upload->initialize($config);
			if($this->upload->do_upload($file)){
				$upload_files = array('upload_data' => $this->upload->data());
				$user_photo = base_url().'Visitors/visitor_id_card/'.$upload_files['upload_data']['file_name'];
				$this->upload->data();

				return $user_photo;
			}	
		}

		function add_visitor_checkout()
		{
			$visitor_id = $this->input->post('visitor_id');
			$visitor_checkout_time =  date('h:i a');
			$this->db->set('visitor_checkout_time',$visitor_checkout_time)->where('visitor_id',$visitor_id)->update('visitor');
			$this->db->set('get_pass_security_check','1')->where('get_pass_visitor_id',$visitor_id)->update('get_pass');
			$this->session->set_flashdata('active',1);
            $this->session->set_flashdata('title',"Visitor Check OUT Successfully.");
            $this->session->set_flashdata('text',"");
            $this->session->set_flashdata('type',"success");
			redirect('Security');
		}

		function visitor_details()
		{
			$visitor = $_POST['visitor'];
			$data = $this->db->query("SELECT visitor.*,student_photo,CONCAT(student_last_name,' ',student_first_name,' ',student_middle_name)as student_name,class_name,division_name,CONCAT(date_format(visitor_date,'%d %M %Y'),' ',visitor_checkin_time)as checkin FROM `visitor` left join student on visitor_student_id = student_profile_id left join student_class_division_assgn on SCD_student_profile_id = visitor_student_id left join class on SCD_class_id = class_id left join division on SCD_division_id = division_id where visitor_id = ".$visitor."")->result_array();
			echo json_encode($data);
		}

		function get_gate_pass()
		{
			if(!isset($this->session->userdata['school']))
			{
				redirect('/');
			} 
			if(isset($this->session->userdata['direct'])){
				$visitor['direct'] = $this->session->userdata('direct');
			}
			else{
				$visitor['direct'] = 1;
			}
			$school_admin = $this->session->userdata('school');
			
			$visitor['school_report_header'] = $school_admin[0]['school_report_header'];
			$visitor['school_report_footer'] = $school_admin[0]['school_report_footer'];
			$get_pass['get_pass_visitor_id'] = $this->input->post('visitor_id');
			$get_pass['get_pass_date'] = date('Y-m-d');
			$get_pass['get_pass_time'] = date('h:i a');
			$get_pass['get_pass_reason'] = $this->input->post('get_pass_reason');
			$get_pass['get_pass_institute_id'] = $school_admin[0]['school_institute_profile_id'];
			$this->db->insert('get_pass',$get_pass);
			$get_pass_id = $this->db->insert_id();
			$visitor_student_id = $this->input->post('visitor_student_id');

			$visitor['pass_details'] = $this->db->query("SELECT get_pass_id,get_pass_visitor_id,visitor_token,get_pass_reason,date_format(get_pass_date,'%d/%m/%Y')as get_pass_date,CONCAT(get_pass_time)as get_pass FROM `get_pass` join visitor on get_pass_visitor_id = visitor_id where get_pass_id = ".$get_pass_id."")->result_array();
			$visitor['student_details'] = $this->db->query("SELECT CONCAT(student_last_name,' ',student_first_name,' ',student_middle_name)as student_name,student_photo FROM  student where student_profile_id = ".$visitor_student_id."")->result_array();
			// echo "<pre>";
			// print_r($visitor['student_details']);
			// print_r($visitor['pass_details']);die();

			$this->load->view('Security/print_get_pass',$visitor);
		}

		function visitor_pass_details()
		{
			$visitor_id = $_POST['visitor'];
			$data = $this->db->query("SELECT get_pass.*,CONCAT(date_format(visitor_date,'%d %M %Y'),' ',visitor_checkin_time)as visitor_checkin,concat(student_last_name,' ',student_first_name,' ',student_middle_name)as student_name,student_photo FROM get_pass join visitor on visitor_id = get_pass_visitor_id left join student on visitor_student_id = student_profile_id where visitor_id = ".$visitor_id." ORDER BY get_pass_id DESC LIMIT 1")->result_array();
			echo json_encode($data);
		}
	}
?>