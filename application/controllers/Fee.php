<?php 

	defined('BASEPATH') OR exit('No direct script access allowed');

	class Fee extends CI_Controller
	{
		function fee_setup()
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
			$fee['flash']['active'] = $this->session->flashdata('active');
        	$fee['flash']['title'] = $this->session->flashdata('title');
        	$fee['flash']['text'] = $this->session->flashdata('text');
        	$fee['flash']['type'] = $this->session->flashdata('type');
        	
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
			$fee['functionality'] = $this->School_model->fetch_functionality($school);
			$employee_school_profile_id = $school_admin[0]['employee_school_profile_id'];
			$school_AY_id = $school_admin[0]['school_AY_id'];
			$fee['class_details'] =  $this->Notification_model->fetch_class($employee_school_profile_id);
			$fee['fee_types'] =  $this->Fee_model->fetch_fee_types($employee_school_profile_id,$school_AY_id);
			$fee['fee_waiver'] =  $this->Fee_model->fetch_fee_waiver($employee_school_profile_id,$school_AY_id);
			$fee['fee_category'] =  $this->Fee_model->fetch_fee_category($employee_school_profile_id);
			$fee['term'] =  $this->Exam_model->fetch_term($employee_school_profile_id,$school_AY_id);
			$nav['school_name'] = $school_admin[0]['school_name'];
			$nav['school_logo'] = $school_admin[0]['school_logo'];
			$nav['fee'] = 'fee';

			$this->load->view('School/school_header', $admin);
			$this->load->view('Fee/fee_setup',$fee);
			$this->load->view('Fee/fee_footer',$nav);
		}

		function fee_details()
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
			$fee['flash']['active'] = $this->session->flashdata('active');
        	$fee['flash']['title'] = $this->session->flashdata('title');
        	$fee['flash']['text'] = $this->session->flashdata('text');
        	$fee['flash']['type'] = $this->session->flashdata('type');
        	
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
			$fee['functionality'] = $this->School_model->fetch_functionality($school);
			$employee_school_profile_id = $school_admin[0]['employee_school_profile_id'];
			$school_AY_id = $school_admin[0]['school_AY_id'];
			$fee['class_details'] =  $this->Notification_model->fetch_class($employee_school_profile_id);
			$fee['fee_types'] =  $this->Fee_model->fetch_fee_types($employee_school_profile_id,$school_AY_id);
			$fee['fee_waiver'] =  $this->Fee_model->fetch_fee_waiver($employee_school_profile_id,$school_AY_id);
			$fee['fee_category'] =  $this->Fee_model->fetch_fee_category($employee_school_profile_id);
			$nav['school_name'] = $school_admin[0]['school_name'];
			$nav['school_logo'] = $school_admin[0]['school_logo'];
			$nav['fee'] = 'fee';

			$this->load->view('School/school_header', $admin);
			$this->load->view('Fee/fee_details',$fee);
			$this->load->view('Fee/fee_footer',$nav);
		}

		function add_fee_category()
		{
			$school_admin = $this->session->userdata('school');
			$Fee['fee_category_name'] = $this->input->post('fee_category_name');
			$Fee['fee_category_effective_date'] = date('Y-m-d');
			$Fee['fee_category_school_profile_id'] = $school_admin[0]['employee_school_profile_id'];
			$verify = $this->db->query("SELECT * from fee_category where fee_category_name = '".$Fee['fee_category_name']."' and fee_category_school_profile_id =".$Fee['fee_category_school_profile_id']." and fee_category_expiry_date = '9999-12-31'")->num_rows();
			if($verify != 0){
				$this->session->set_flashdata('active',1);
	            $this->session->set_flashdata('title',"Fee Category Already Registered.");
	            $this->session->set_flashdata('text',"");
	            $this->session->set_flashdata('type',"warning");
				redirect('Fee/fee_setup');
			}else{
				$cnt = $this->Fee_model->fee_category($Fee);
				if ($cnt == 1) {
					$this->session->set_flashdata('active',1);
		            $this->session->set_flashdata('title',"Fee Category Added Successfully.");
		            $this->session->set_flashdata('text',"");
		            $this->session->set_flashdata('type',"success");
					redirect('Fee/fee_setup');
				}
				else{
					$this->session->set_flashdata('active',1);
		            $this->session->set_flashdata('title',"Not Added.");
		            $this->session->set_flashdata('text',"");
		            $this->session->set_flashdata('type',"success");
					redirect('Fee/fee_setup');
				}
			}
		}		

		function add_fee_waiver()
		{
			$school_admin = $this->session->userdata('school');
			$Fee['fee_waiver_student_profile_id'] = $this->input->post('fee_waiver_student_profile_id');
			$Fee['fee_waiver_fee_type_id'] = $this->input->post('fee_waiver_fee_type_id');
			$Fee['fee_waiver_name'] = $this->input->post('fee_waiver_name');
			$Fee['fee_waiver_amount'] = $this->input->post('fee_waiver_amount');
			$Fee['fee_waiver_effective_date'] = date('Y-m-d');
			$Fee['fee_waiver_school_profile_id'] = $school_admin[0]['employee_school_profile_id'];
			$Fee['fee_waiver_AY_id'] = $school_admin[0]['school_AY_id'];
			$verify = $this->db->query("select * from fee_waiver where fee_waiver_student_profile_id = ".$Fee['fee_waiver_student_profile_id']." and fee_waiver_AY_id = ".$Fee['fee_waiver_AY_id']." and fee_waiver_fee_type_id=".$Fee['fee_waiver_fee_type_id']." and fee_waiver_school_profile_id = ".$Fee['fee_waiver_school_profile_id']."")->num_rows();
			if ($verify != 0) {
				$amount = $this->db->query("select sum(fee_waiver_amount) as total_waiver_amount,fee_waiver_id from fee_waiver where fee_waiver_student_profile_id = ".$Fee['fee_waiver_student_profile_id']." and fee_waiver_AY_id = ".$Fee['fee_waiver_AY_id']." and fee_waiver_fee_type_id=".$Fee['fee_waiver_fee_type_id']." and fee_waiver_school_profile_id = ".$Fee['fee_waiver_school_profile_id']."")->result_array();				
				$total_waiver_amount = $amount[0]['total_waiver_amount'] + $Fee['fee_waiver_amount'];
				$fee_waiver_id = $amount[0]['fee_waiver_id'];
				$this->db->query("UPDATE fee_waiver set fee_waiver_amount =".$total_waiver_amount." where fee_waiver_id = ".$fee_waiver_id."");
				$this->session->set_flashdata('active',1);
	            $this->session->set_flashdata('title',"Fee Waiver Updated Successfully.");
	            $this->session->set_flashdata('text',"");
	            $this->session->set_flashdata('type',"success");
				redirect('Fee/fee_setup');
			}
			else{
				$this->Fee_model->fee_waiver($Fee);
				$this->session->set_flashdata('active',1);
	            $this->session->set_flashdata('title',"Fee Waiver Added Successfully.");
	            $this->session->set_flashdata('text',"");
	            $this->session->set_flashdata('type',"success");
				redirect('Fee/fee_setup');
			}
		}

		function delete_fee_waiver($fee_waiver_id)
		{
			$this->session->set_userdata('waiver_id',$fee_waiver_id);
			redirect('Fee/delete_waiver_record');
		}

		function delete_waiver_record()
		{
			$fee_waiver_id = $this->session->userdata('waiver_id');
			$this->db->where('fee_waiver_id',$fee_waiver_id)->delete('fee_waiver');
			$this->session->set_flashdata('active',1);
            $this->session->set_flashdata('title',"Fee Waiver Deleted Successfully.");
            $this->session->set_flashdata('text',"");
            $this->session->set_flashdata('type',"success");
			redirect('Fee/fee_setup');
		}

		function fee_type_details()
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
			$fee['flash']['active'] = $this->session->flashdata('active');
        	$fee['flash']['title'] = $this->session->flashdata('title');
        	$fee['flash']['text'] = $this->session->flashdata('text');
        	$fee['flash']['type'] = $this->session->flashdata('type');
        	
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
			$fee['functionality'] = $this->School_model->fetch_functionality($school);
			$employee_school_profile_id = $school_admin[0]['employee_school_profile_id'];
			$school_AY_id = $school_admin[0]['school_AY_id'];
			$fee['class_details'] =  $this->Notification_model->fetch_class($employee_school_profile_id);
			$fee['fee_types'] =  $this->Fee_model->fetch_fee_types($employee_school_profile_id,$school_AY_id);
			$fee['fee_category'] =  $this->Fee_model->fetch_fee_category($employee_school_profile_id);
			$fee['term'] =  $this->Exam_model->fetch_term($employee_school_profile_id,$school_AY_id);
			$nav['school_name'] = $school_admin[0]['school_name'];
			$nav['school_logo'] = $school_admin[0]['school_logo'];
			$nav['fee'] = 'fee_type';

			$this->load->view('School/school_header', $admin);
			$this->load->view('Fee/fee_type_details',$fee);
			$this->load->view('Fee/fee_footer',$nav);
		}

		function add_fee_types()
		{
			$school_admin = $this->session->userdata('school');
			$Fee['fees_type_name'] = $this->input->post('fees_type_name');
			$Fee['fees_type_class_id'] = $this->input->post('fees_type_class_id');
			$Fee['fees_type_fee_category_id'] = $this->input->post('fees_type_fee_category_id');
			$Fee['fees_type_amount'] = $this->input->post('fees_type_amount');
			$Fee['fees_type_period'] = $this->input->post('fees_type_period');
			$Fee['fees_type_total_amount'] = $this->input->post('fees_type_total_amount');
			$Fee['fees_type_effective_date'] = date('Y-m-d');
			$Fee['fees_type_school_profile_id'] = $school_admin[0]['employee_school_profile_id'];
			$Fee['fees_type_AY_id'] = $school_admin[0]['school_AY_id'];
			$total_fee['student_profile_id'] = $this->input->post('student_profile_id[]');
			$verify = $this->db->query("SELECT * from fees_type where fees_type_fee_category_id = '".$Fee['fees_type_fee_category_id']."' and fees_type_name = '".$Fee['fees_type_name']."' and fees_type_class_id IN(".$Fee['fees_type_class_id'].",0) and fees_type_school_profile_id =".$Fee['fees_type_school_profile_id']." and fees_type_AY_id =".$Fee['fees_type_AY_id']." and fees_type_expiry_date = '9999-12-31'")->num_rows();
			if($verify != 0){
				$this->session->set_flashdata('active',1);
	            $this->session->set_flashdata('title',"Fee Type Already Registered.");
	            $this->session->set_flashdata('text',"");
	            $this->session->set_flashdata('type',"warning");
				redirect('Fee/fee_setup');
			}else{
				$fee_type_id = $this->Fee_model->fee_types($Fee);
				$cnt = count($total_fee['student_profile_id']);
				for ($i=0; $i < $cnt; $i++) { 
					$total['total_fee_student_profile_id'] = $total_fee['student_profile_id'][$i];
					$total['total_fee_type_id'] = $fee_type_id;
					$total['total_fee_amount'] = $Fee['fees_type_amount'];
					$total['total_fee_AY_id'] = $Fee['fees_type_AY_id'];
					$total['total_fee_school_profile_id'] = $Fee['fees_type_school_profile_id'];
					$this->db->insert('total_fees',$total);
				}
				$this->session->set_flashdata('active',1);
	            $this->session->set_flashdata('title',"Fee Type Added Successfully.");
	            $this->session->set_flashdata('text',"");
	            $this->session->set_flashdata('type',"success");
				redirect('Fee/fee_setup');
			}
		}

		function update_fee_type($fees_type_id)
		{
			$this->session->set_userdata('fee_type',$fees_type_id);
			redirect('Fee/edit_fees');
		}

		function edit_fees()
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
			$noti['flash']['active'] = $this->session->flashdata('active');
        	$noti['flash']['title'] = $this->session->flashdata('title');
        	$noti['flash']['text'] = $this->session->flashdata('text');
        	$noti['flash']['type'] = $this->session->flashdata('type');
        	
			$fees_type_id = $this->session->userdata('fee_type');
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
			$AY_id = $school_admin[0]['AY_id'];
			$employee_school_profile_id = $school_admin[0]['employee_school_profile_id'];
			$fee['fee_types'] =  $this->Fee_model->fetch_fee_types_detials($fees_type_id);
			$fee['student_details'] = $this->db->query("SELECT student_GRN,class_name,concat(student_last_name,' ',student_first_name,' ',student_middle_name) as student_name,student_profile_id,class_name,total_fee_amount FROM `total_fees` join student on total_fee_student_profile_id = student_profile_id join student_class_division_assgn on SCD_student_profile_id = total_fee_student_profile_id and SCD_AY_id = total_fee_AY_id and SCD_school_profile_id = total_fee_school_profile_id join class on SCD_class_id = class_id where total_fee_type_id = ".$fees_type_id." and total_fee_AY_id=".$AY_id." and total_fee_school_profile_id =".$employee_school_profile_id."")->result_array();
			$fee['total_fee_amount'] = $this->db->query("SELECT sum(total_fee_amount) as total_amount,count(total_fee_amount) as total_new_fee_amount FROM `total_fees` where total_fee_type_id = ".$fees_type_id." and total_fee_AY_id=".$AY_id." and total_fee_school_profile_id =".$employee_school_profile_id."")->result_array();
			$nav['school_name'] = $school_admin[0]['school_name'];
			$nav['school_logo'] = $school_admin[0]['school_logo'];
			$nav['fee'] = 'fee';

			$this->load->view('School/school_header', $admin);
			$this->load->view('Fee/update_fee_type',$fee);
			$this->load->view('Fee/fee_footer',$nav);
		}

		function delete_student_fee_types_details()
		{
			$school_admin = $this->session->userdata('school');
			$employee_school_profile_id = $school_admin[0]['employee_school_profile_id'];
			$AY_id = $school_admin[0]['school_AY_id'];
			$fees_type_id = $_POST['id'];
			$data = $this->db->query("SELECT student_GRN,class_name,concat(student_last_name,' ',student_first_name,' ',student_middle_name) as student_name,student_profile_id,class_name,total_fee_amount FROM `total_fees` join student on total_fee_student_profile_id = student_profile_id join student_class_division_assgn on SCD_student_profile_id = total_fee_student_profile_id and SCD_AY_id = total_fee_AY_id and SCD_school_profile_id = total_fee_school_profile_id join class on SCD_class_id = class_id where total_fee_type_id = ".$fees_type_id." and total_fee_AY_id=".$AY_id." and total_fee_school_profile_id =".$employee_school_profile_id."")->result_array();
			echo json_encode($data);
		}

		function delete_fees_details()
		{
			$fees_type_id = $this->input->post('delete_fee_type');
			$this->Fee_model->delete_fees_details($fees_type_id);
			$this->session->set_flashdata('active',1);
	        $this->session->set_flashdata('title',"Fee Type Deleted Successfully.");
	        $this->session->set_flashdata('text',"");
	        $this->session->set_flashdata('type',"success");
	        redirect('Fee/fee_details');
		}

		function fee_types_edit()
		{
			$school_admin = $this->session->userdata('school');
			$Fee['fees_type_id'] = $this->input->post('fees_type_id');
			$Fee['fees_type_amount'] = $this->input->post('fees_type_amount');
			$this->Fee_model->update_fee_types($Fee);
			$this->session->set_flashdata('active',1);
            $this->session->set_flashdata('title',"Fee Type Updated Successfully.");
            $this->session->set_flashdata('text',"");
            $this->session->set_flashdata('type',"success");
			redirect('Fee/fee_setup');
		}

		function fetch_class_division()
		{
			$school_admin = $this->session->userdata('school');
			$class['employee_school_profile_id'] = $school_admin[0]['employee_school_profile_id'];
			$class['class_id'] = $_POST['class_id'];
			$data = $this->Fee_model->fetch_class_division($class);
			echo json_encode($data);
		}

		function bulk_student_already_assign_fee_types()
		{
			$school_admin = $this->session->userdata('school');
			$employee_school_profile_id = $school_admin[0]['employee_school_profile_id'];
			$AY_id = $school_admin[0]['school_AY_id'];
			$fee_type_class_id = $_POST['fee_type_class_id'];
			$fee_type_id = $_POST['fee_type_id'];
			if($fee_type_class_id == 0){
				$data = $this->db->query("SELECT student_GRN,concat(student_last_name,' ',student_first_name,' ',student_middle_name) as student_name,student_profile_id FROM `fees_type` join total_fees on total_fee_type_id=fees_type_id join student on total_fee_student_profile_id=student_profile_id where fees_type_id = ".$fee_type_id." and fees_type_AY_id=".$AY_id." and fees_type_school_profile_id=".$employee_school_profile_id."")->result_array();
			}else{
				$data = $this->db->query("SELECT student_GRN,concat(student_last_name,' ',student_first_name,' ',student_middle_name) as student_name,student_profile_id FROM `fees_type` join total_fees on total_fee_type_id=fees_type_id join student on total_fee_student_profile_id=student_profile_id where fees_type_id = ".$fee_type_id." and fees_type_class_id=".$fee_type_class_id." and fees_type_AY_id=".$AY_id." and fees_type_school_profile_id=".$employee_school_profile_id."")->result_array();
			}
			echo json_encode($data);
		}

		function bulk_student_not_assign_fee_types()
		{
			$school_admin = $this->session->userdata('school');
			$employee_school_profile_id = $school_admin[0]['employee_school_profile_id'];
			$AY_id = $school_admin[0]['school_AY_id'];
			$fee_type_class_id = $_POST['fee_type_class_id'];
			$fee_type_id = $_POST['fee_type_id'];
			if($fee_type_class_id == 0){
				$data = $this->db->query("SELECT student_GRN,concat(student_last_name,' ',student_first_name,' ',student_middle_name) as student_name,student_profile_id FROM student_class_division_assgn join student on SCD_student_profile_id = student_profile_id where SCD_student_profile_id NOT IN (SELECT student_profile_id FROM `fees_type` join total_fees on total_fee_type_id=fees_type_id join student on total_fee_student_profile_id=student_profile_id where fees_type_id = ".$fee_type_id.") and SCD_school_profile_id =".$employee_school_profile_id." and SCD_expiry_date = '9999-12-31' and SCD_AY_id =".$AY_id."")->result_array();
			}else{
				$data = $this->db->query("SELECT student_GRN,concat(student_last_name,' ',student_first_name,' ',student_middle_name) as student_name,student_profile_id FROM student_class_division_assgn join student on SCD_student_profile_id = student_profile_id where SCD_student_profile_id NOT IN (SELECT student_profile_id FROM `fees_type` join total_fees on total_fee_type_id=fees_type_id join student on total_fee_student_profile_id=student_profile_id where fees_type_id = ".$fee_type_id.") and SCD_class_id =".$fee_type_class_id." and SCD_school_profile_id =".$employee_school_profile_id." and SCD_expiry_date = '9999-12-31' and SCD_AY_id =".$AY_id."")->result_array();
			}
			echo json_encode($data);
		}

		function bulk_student_fee_assign()
		{
			$school_admin = $this->session->userdata('school');
			$employee_school_profile_id = $school_admin[0]['employee_school_profile_id'];
			$AY_id = $school_admin[0]['school_AY_id'];
			$bulk['fee_type_id'] = $this->input->post('fees_type_id');
			$bulk['fee_type_amount'] = $this->input->post('fees_type_amount');
			$bulk['student_profile_id'] = $this->input->post('student_profile_id[]');
			$cnt = count($bulk['student_profile_id']);
			for ($i=0; $i < $cnt; $i++) { 
				$bulk_stud['total_fee_type_id'] = $bulk['fee_type_id'];
				$bulk_stud['total_fee_student_profile_id'] = $bulk['student_profile_id'][$i];
				$bulk_stud['total_fee_amount'] = $bulk['fee_type_amount'];
				$bulk_stud['total_fee_AY_id'] = $AY_id;
				$bulk_stud['total_fee_school_profile_id'] = $employee_school_profile_id;
				$this->db->insert('total_fees',$bulk_stud);
			}
			$this->session->set_flashdata('active',1);
            $this->session->set_flashdata('title',"Fee  Assign Successfully.");
            $this->session->set_flashdata('text',"");
            $this->session->set_flashdata('type',"success");
			redirect('Fee/fee_setup');
		}


		function fetch_class_division_student()
		{
			$school_admin = $this->session->userdata('school');
			$student['employee_school_profile_id'] = $school_admin[0]['employee_school_profile_id'];
			$student['class_id'] = $_POST['class_id'];
			$data = $this->Fee_model->fetch_class_division_student($student);
			echo json_encode($data);
		}

		function fetch_division_class_student()
		{
			$school_admin = $this->session->userdata('school');
			$student['employee_school_profile_id'] = $school_admin[0]['employee_school_profile_id'];
			$student['class_id'] = $_POST['class_id'];
			$student['division_id'] = $_POST['division_id'];
			$data = $this->Fee_model->fetch_division_class_student($student);
			echo json_encode($data);
		}

		function fee_type_amount_verification_for_fee_waiver()
		{
			$type_id = $_POST['type_id'];
			$student_id = $_POST['student_id'];
			$data = $this->db->query("select 
				case when fee_waiver_amount is NULL then total_fee_amount else (total_fee_amount-fee_waiver_amount) end as fee_amount 
				from 
				total_fees
				left join 
				fee_waiver on total_fee_type_id = fee_waiver_fee_type_id 
				and total_fee_student_profile_id = fee_waiver_student_profile_id
				where total_fee_type_id = ".$type_id."
				and total_fee_student_profile_id=".$student_id."")->result_array();
			echo json_encode($data);
		}

		function fee_type_wise_student()
		{
			$student_id = $_POST['student_id'];
			$data = $this->db->query("SELECT * from total_fees join fees_type on total_fee_type_id = fees_type_id join fee_category on fees_type_fee_category_id = fee_category_id where total_fee_student_profile_id=".$student_id."")->result_array();
			echo json_encode($data);
		}

		function assign_fee_alredy_assign_all_student()
		{
			$school_admin = $this->session->userdata('school');
			$employee_school_profile_id = $school_admin[0]['employee_school_profile_id'];
			$school_AY_id = $school_admin[0]['school_AY_id'];
			$data = $this->db->query("select student_GRN,class_name,
				concat(student_last_name,' ',student_first_name,' ',student_last_name) as student_name
				,student_profile_id
				from 
				student_class_division_assgn 
				join student
				on SCD_student_profile_id = student_profile_id
				and SCD_school_profile_id = student_school_profile_id
				join class on SCD_class_id =class_id
				where 
				SCD_AY_id =".$school_AY_id."
				and SCD_expiry_date ='9999-12-31'
				and SCD_school_profile_id = ".$employee_school_profile_id."
				group by student_profile_id order by class_id")->result_array();
			echo json_encode($data);
		}

		function assign_fee_alredy_assign_student()
		{
			$school_admin = $this->session->userdata('school');
			$employee_school_profile_id = $school_admin[0]['employee_school_profile_id'];
			$school_AY_id = $school_admin[0]['school_AY_id'];
			$class_id = $_POST['class_id'];
			$data = $this->db->query("select student_GRN,class_name,
				concat(student_last_name,' ',student_first_name,' ',student_last_name) as student_name
				,student_profile_id
				from 
				student_class_division_assgn 
				join student
				on SCD_student_profile_id = student_profile_id
				and SCD_school_profile_id = student_school_profile_id
				join class on SCD_class_id =class_id
				where 
				SCD_AY_id =".$school_AY_id."
				and SCD_expiry_date ='9999-12-31'
				and SCD_class_id = ".$class_id."
				and SCD_school_profile_id = ".$employee_school_profile_id."
				group by student_profile_id")->result_array();
			echo json_encode($data);
		}

		function fetch_student_payments()
		{
			$school_admin = $this->session->userdata('school');
			$payment['employee_school_profile_id'] = $school_admin[0]['employee_school_profile_id'];
			$payment['class_id'] = $_POST['class_id'];
			$payment['student_profile_id'] = $_POST['student_profile_id'];
			$data = $this->Fee_model->fetch_student_payments($payment);
			$this->session->set_userdata('fetch_student_payments',$data);
			echo json_encode($data);
		}

		function fetch_student_total_payments()
		{
			$school_admin = $this->session->userdata('school');
			$payment['employee_school_profile_id'] = $school_admin[0]['employee_school_profile_id'];
			$payment['class_id'] = $_POST['class_id'];
			$payment['student_profile_id'] = $_POST['student_profile_id'];
			$data = $this->Fee_model->fetch_student_total_payments($payment);
			$this->session->set_userdata('fetch_student_total_payments',$data);
			echo json_encode($data);

			$this->session->set_userdata('student_total_payments',$data);
		}


		function add_student_payment()
		{
			$school_admin = $this->session->userdata('school');
			$payment['fee_student_profile_id'] = $_POST['fee_student_profile_id'];
			// $payment['fee_type_id'] = $_POST['fee_type_id'];
			$payment['fee_amount'] = $_POST['fee_amount'];
			$remain_amt = $_POST['remain_amt'] - $payment['fee_amount'];
			$payment['fee_payment_mode'] = $_POST['fee_payment_mode'];
			$payment['fee_transaction_number'] = $_POST['fee_transaction_number'];
			$payment['fee_narration'] = $_POST['fee_narration'];
			$payment['fee_datetime'] = $_POST['fee_datetime'];
			$payment['fee_school_profile_id'] = $school_admin[0]['employee_school_profile_id'];
			$payment['fee_AY_id'] = $school_admin[0]['school_AY_id'];
			if($payment['fee_payment_mode'] == 4){
				$student_advance_payment = $this->db->select('student_total_advance_payment')->where('student_profile_id',$payment['fee_student_profile_id'])->from('student')->get()->result_array();
				if($student_advance_payment[0]['student_total_advance_payment'] >= $payment['fee_amount']){
					$total_advance_payment = intval($student_advance_payment[0]['student_total_advance_payment']) - intval($payment['fee_amount']);
					$this->db->set('student_total_advance_payment',$total_advance_payment)->where('student_profile_id',$payment['fee_student_profile_id'])->update('student');
					$fee_id = $this->Fee_model->add_student_payment($payment);
				}
				//else{
				// 	$this->session->set_flashdata('active',1);
			 //        $this->session->set_flashdata('title',"Advance Payment Not Available.");
			 //        $this->session->set_flashdata('text',"");
			 //        $this->session->set_flashdata('type',"success");
			 //        redirect('Fee/fee_details');
				// }
			}else{
				$fee_id = $this->Fee_model->add_student_payment($payment);
			}



				$Student_profile_id = $payment['fee_student_profile_id'];

				$signature = $this->db->query('select institute_sender_id,institute_signature from institute where institute_profile_id=(select school_institute_profile_id from school where school_profile_id='.$school_admin[0]['employee_school_profile_id'].')')->result_array();
					
				$number = '';
				$mobile_number = $this->db->query("SELECT * FROM parent join student on parent_student_profile_id = student_profile_id and parent_profile_id = student_parent_id where student_profile_id = ".$Student_profile_id."")->result_array();
								
				$msg = "Dear parent, \nSchool has received fee amount of Rs. ".$payment['fee_amount'].". \nBalance fee amount is Rs.".$remain_amt.". \nRegards, \n".$signature[0]['institute_signature'].".";
				$check = $this->Enquiry_model->check_sms_active($school_admin[0]['employee_school_profile_id']);
				if(count($mobile_number) > 0)
				{
					$number = $mobile_number[0]['parent_mobile_number'];
				}
				else
				{
					$number = NULL;
				}
				// $number = "9822230351";
				if(!empty($number) || !is_null($number) ){
					if($school_admin[0]['school_parentmeet_sms'] == 1 && $check[0]['institute_sms_credit'] > 0){
						$sms_status = $this->Student_model->sms($number,$msg,$signature[0]['institute_sender_id']);
						$res_explode = explode(':', $sms_status);

						$this->Enquiry_model->set_count($check[0]['school_institute_profile_id']);
						$sent['sent_sms_type'] = 2;
						$sent['sent_sms_sub_type'] = 6;
						$sent['sent_sms_mobile_number'] = $number;
						$sent['sent_sms_language'] = 1;
						$sent['sent_sms_MsgID'] = $res_explode[1];
						$sent['sent_sms_status'] =  $res_explode[4];
						$sent['sent_sms_count'] = 1;
						$sent['sent_sms_MSG'] = $msg ;
						$sent['sent_sms_student_profile_id'] = $Student_profile_id;
						$sent['sent_sms_school_profile_id'] = $school_admin[0]['employee_school_profile_id'];
						$this->Enquiry_model->add_sent_sms($sent);
					}
				}

			echo json_encode($Student_profile_id);

		}

		function add_advance_student_payment()
		{
			$school_admin = $this->session->userdata('school');
			$payment['advance_student_profile_id'] = $_POST['advance_student_profile_id'];
			// $payment['fee_type_id'] = $_POST['fee_type_id'];
			$payment['advance_amount'] = $_POST['advance_amount'];
			$payment['advance_narration'] = $_POST['advance_narration'];
			$payment['advance_datetime'] = $_POST['advance_datetime'];
			$payment['advance_payment_mode'] = $_POST['advance_payment_mode'];
			$payment['advance_school_profile_id'] = $school_admin[0]['employee_school_profile_id'];
			if($payment['advance_payment_mode'] == '3'){
				$payment['advance_transaction_number'] = $_POST['advance_transaction_number'];
			}
			else{
				$payment['advance_transaction_number'] = $_POST['advance_transaction_number1'];
			}
			$payment['advance_AY_id'] = $school_admin[0]['school_AY_id'];
			$student_advance_payment = $this->db->select('student_total_advance_payment')->where('student_profile_id',$payment['advance_student_profile_id'])->from('student')->get()->result_array();
			$total_advance_payment = intval($student_advance_payment[0]['student_total_advance_payment']) + intval($payment['advance_amount']);
			$this->db->set('student_total_advance_payment',$total_advance_payment)->where('student_profile_id',$payment['advance_student_profile_id'])->update('student');
			$advance_payment = $this->Fee_model->add_advance_student_payment($payment);
			// echo json_encode($advance_payment);


				$Student_profile_id = $payment['advance_student_profile_id'];

				$signature = $this->db->query('select institute_sender_id,institute_signature from institute where institute_profile_id=(select school_institute_profile_id from school where school_profile_id='.$school_admin[0]['employee_school_profile_id'].')')->result_array();
					
				$number = '';
				$mobile_number = $this->db->query("SELECT * FROM parent join student on parent_student_profile_id = student_profile_id and parent_profile_id = student_parent_id where student_profile_id = ".$Student_profile_id."")->result_array();
								
				$msg = "Dear parent, \nSchool has received advance fee amount of Rs. ".$payment['advance_amount'].". \nRegards, \n".$signature[0]['institute_signature'].".";
				$check = $this->Enquiry_model->check_sms_active($school_admin[0]['employee_school_profile_id']);
				if(count($mobile_number) > 0)
				{
					$number = $mobile_number[0]['parent_mobile_number'];
				}
				else
				{
					$number = NULL;
				}
				// $number = "9822230351";
				if(!empty($number) || !is_null($number) ){
					if($school_admin[0]['school_parentmeet_sms'] == 1 && $check[0]['institute_sms_credit'] > 0){
						$sms_status = $this->Student_model->sms($number,$msg,$signature[0]['institute_sender_id']);
						$res_explode = explode(':', $sms_status);

						$this->Enquiry_model->set_count($check[0]['school_institute_profile_id']);
						$sent['sent_sms_type'] = 2;
						$sent['sent_sms_sub_type'] = 6;
						$sent['sent_sms_mobile_number'] = $number;
						$sent['sent_sms_language'] = 1;
						$sent['sent_sms_MsgID'] = $res_explode[1];
						$sent['sent_sms_status'] =  $res_explode[4];
						$sent['sent_sms_count'] = 1;
						$sent['sent_sms_MSG'] = $msg ;
						$sent['sent_sms_student_profile_id'] = $Student_profile_id;
						$sent['sent_sms_school_profile_id'] = $school_admin[0]['employee_school_profile_id'];
						$this->Enquiry_model->add_sent_sms($sent);
					}
				}

		}

		function payment_history()
		{
			$school_admin = $this->session->userdata('school');
			$PH['fee_AY_id'] = $school_admin[0]['school_AY_id'];
			$PH['fee_school_profile_id'] = $school_admin[0]['employee_school_profile_id'];
			$PH['student_profile_id'] = $_POST['student_profile_id'];
			$data = $this->Fee_model->payment_history($PH);
			$this->session->set_userdata('payment_history',$data);
			echo json_encode($data);
		}

		function advance_payment_history()
		{
			$school_admin = $this->session->userdata('school');
			$PH['advance_AY_id'] = $school_admin[0]['school_AY_id'];
			$PH['advance_school_profile_id'] = $school_admin[0]['employee_school_profile_id'];
			$PH['student_profile_id'] = $_POST['student_profile_id'];
			$data = $this->Fee_model->advance_payment_history($PH);
			$this->session->set_userdata('advance_payment_history',$data);
			echo json_encode($data);
		}

		function delete_fee_payment_receipt($fee_id)		
		{
			$this->session->set_userdata('delete_fee_receipt_id',$fee_id);
			redirect('Fee/delete_fee_receipt');
		}

		function delete_fee_receipt()
		{
			$fee_id = $this->session->userdata('delete_fee_receipt_id');
			$this->db->where('fee_id',$fee_id)->delete('fee');
			$this->session->set_flashdata('active',1);
	        $this->session->set_flashdata('title',"Payment Receipt Deleted Successfully.");
	        $this->session->set_flashdata('text',"");
	        $this->session->set_flashdata('type',"success");
			redirect('Fee/fee_details');
		}

		function delete_advance_payment_receipt($advance_id)		
		{
			$this->session->set_userdata('delete_advance_receipt_id',$advance_id);
			redirect('Fee/delete_advance_receipt');
		}

		function delete_advance_receipt()
		{
			$advance_id = $this->session->userdata('delete_advance_receipt_id');
			$amount = $this->db->query("SELECT advance_amount,advance_student_profile_id FROM `advance_payment` where advance_id =".$advance_id."")->result_array();
			$student = $this->db->query("SELECT student_profile_id,student_total_advance_payment FROM `student` where student_profile_id = ".$amount[0]['advance_student_profile_id']."")->result_array();
			$update_advance = intval($student[0]['student_total_advance_payment']) - intval($amount[0]['advance_amount']);
			$this->db->set('student_total_advance_payment',$update_advance)->where('student_profile_id',$amount[0]['advance_student_profile_id'])->update('student');
			// echo "<pre>";
			// print_r($amount);
			// print_r($student);
			// print_r($update_advance);die();
			$this->db->where('advance_id',$advance_id)->delete('advance_payment');
			$this->session->set_flashdata('active',1);
	        $this->session->set_flashdata('title',"Advance Payment Receipt Deleted Successfully.");
	        $this->session->set_flashdata('text',"");
	        $this->session->set_flashdata('type',"success");
			redirect('Fee/fee_details');
		}

		function fee_payment_receipt($fee_id)
		{
			$this->session->set_userdata('fee_receipt_id',$fee_id);
			redirect('Fee/fee_receipt');
		}

		function fee_receipt()
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
			$fee['flash']['active'] = $this->session->flashdata('active');
        	$fee['flash']['title'] = $this->session->flashdata('title');
        	$fee['flash']['text'] = $this->session->flashdata('text');
        	$fee['flash']['type'] = $this->session->flashdata('type');
        	
			$fees_type_id = $this->session->userdata('fee');
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
			$fee['fee_id'] = $this->session->userdata('fee_receipt_id');
	
			$fee['fee_details'] =  $this->db->query("SELECT fee.*,student_first_name,student_middle_name,student_last_name,student_present_address,student_GRN,class_name,division_name,school_report_header,school_report_footer,academic_year.AY_name FROM fee join student  on  fee_student_profile_id = student_profile_id join school on student_school_profile_id = school_profile_id join  student_class_division_assgn on  SCD_student_profile_id = fee_student_profile_id  join  class on  SCD_class_id = class_id  left join  division on  SCD_division_id = division_id JOIN academic_year ON fee.fee_AY_id = academic_year.AY_id where  fee_id =".$fee['fee_id']."")->result_array();
			$nav['school_name'] = $school_admin[0]['school_name'];
			$nav['school_logo'] = $school_admin[0]['school_logo'];
			$nav['fee'] = 'fee';

			$fee['student_total_payments'] = $this->session->userdata('student_total_payments');
			$fee['fetch_student_payments'] = $this->session->userdata('fetch_student_payments');
			$fee['fetch_student_total_payments'] = $this->session->userdata('fetch_student_total_payments');
			$fee['payment_history'] = $this->session->userdata('payment_history');
			$fee['amt_in_words'] = $this->num_to_str($fee['fee_details'][0]['fee_amount']);

			// $this->load->view('School/school_header', $admin);
			$this->load->view('Fee/fee_receipt',$fee);
			// $this->load->view('Fee/fee_footer',$nav);		
		}

		function advance_payment_receipt($advance_id)
		{
			$this->session->set_userdata('advance_receipt_id',$advance_id);
			redirect('Fee/advance_receipt');
		}

		function advance_receipt()
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
			$fee['flash']['active'] = $this->session->flashdata('active');
        	$fee['flash']['title'] = $this->session->flashdata('title');
        	$fee['flash']['text'] = $this->session->flashdata('text');
        	$fee['flash']['type'] = $this->session->flashdata('type');
        	
			// $fees_type_id = $this->session->userdata('fee');
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
			$employee_school_profile_id = $school_admin[0]['employee_school_profile_id'];
			$fee['advance_id'] = $this->session->userdata('advance_receipt_id');
	
			
			$fee['fee_details'] =  $this->db->query("SELECT advance_payment.*,student_first_name,student_middle_name,student_last_name,student_present_address,student_GRN,class_name,division_name,school_report_header,school_report_footer,AY_name FROM advance_payment join student  on  advance_student_profile_id = student_profile_id join school on student_school_profile_id = school_profile_id join  student_class_division_assgn on  SCD_student_profile_id = advance_student_profile_id  join  class on  SCD_class_id = class_id  left join  division on  SCD_division_id = division_id JOIN academic_year ON advance_AY_id = AY_id where  advance_id =".$fee['advance_id']."")->result_array();
			$fee['advance_payment'] =  $this->db->query("SELECT student_total_advance_payment FROM advance_payment join student  on  advance_student_profile_id = student_profile_id where  advance_id =".$fee['advance_id']."")->result_array();
			$nav['school_name'] = $school_admin[0]['school_name'];
			$nav['school_logo'] = $school_admin[0]['school_logo'];
			$nav['fee'] = 'fee';

			$fee['student_total_payments'] = $this->session->userdata('student_total_payments');
			// $fee['fetch_student_payments'] = $this->session->userdata('fetch_student_payments');
			$fee['fetch_student_total_payments'] = $this->session->userdata('fetch_student_total_payments');
			$fee['payment_history'] = $this->session->userdata('advance_payment_history');
			$fee['amt_in_words'] = $this->num_to_str($fee['fee_details'][0]['advance_amount']);

			// $this->load->view('School/school_header', $admin);
			$this->load->view('Fee/advance_fee_receipt',$fee);
			// $this->load->view('Fee/fee_footer',$nav);		
		}

		function num_to_str($number)
		{
			   $no = round($number);
			   $point = round($number - $no, 2) * 100;
			   $hundred = null;
			   $digits_1 = strlen($no);
			   $i = 0;
			   $str = array();
			   $words = array('0' => '', '1' => 'one', '2' => 'two',
			    '3' => 'three', '4' => 'four', '5' => 'five', '6' => 'six',
			    '7' => 'seven', '8' => 'eight', '9' => 'nine',
			    '10' => 'ten', '11' => 'eleven', '12' => 'twelve',
			    '13' => 'thirteen', '14' => 'fourteen',
			    '15' => 'fifteen', '16' => 'sixteen', '17' => 'seventeen',
			    '18' => 'eighteen', '19' =>'nineteen', '20' => 'twenty',
			    '30' => 'thirty', '40' => 'forty', '50' => 'fifty',
			    '60' => 'sixty', '70' => 'seventy',
			    '80' => 'eighty', '90' => 'ninety');
			   $digits = array('', 'hundred', 'thousand', 'lakh', 'crore');
			   while ($i < $digits_1) {
			     $divider = ($i == 2) ? 10 : 100;
			     $number = floor($no % $divider);
			     $no = floor($no / $divider);
			     $i += ($divider == 10) ? 1 : 2;
			     if ($number) {
			        $plural = (($counter = count($str)) && $number > 9) ? 's' : null;
			        $hundred = ($counter == 1 && $str[0]) ? ' and ' : null;
			        $str [] = ($number < 21) ? $words[$number] .
			            " " . $digits[$counter] . $plural . " " . $hundred
			            :
			            $words[floor($number / 10) * 10]
			            . " " . $words[$number % 10] . " "
			            . $digits[$counter] . $plural . " " . $hundred;
			     } else $str[] = null;
			  }
			  $str = array_reverse($str);
			  $result = implode('', $str);
			  $points = ($point) ?
			    "." . $words[$point / 10] . " " . 
			          $words[$point = $point % 10] : '';
			  $str = $result . "Rupees  " . $points . " Paise";
			  return $str;
		}
	}
 ?>