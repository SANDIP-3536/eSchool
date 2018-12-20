<?php 
	class DayBook extends CI_Controller
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
	
		function dayBook_details()
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

			$acc['flash']['active'] = $this->session->flashdata('active');
	    	$acc['flash']['title'] = $this->session->flashdata('title');
	    	$acc['flash']['text'] = $this->session->flashdata('text');
	    	$acc['flash']['type'] = $this->session->flashdata('type');
	    	
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
			$acc['acc_group'] =  $this->DayBook_model->fetch_acc_group($employee_school_profile_id,$school_AY_id);
			$acc['voc_master'] = $this->DayBook_model->fetch_voc_master($employee_school_profile_id,$school_AY_id);
			$acc['voc_head'] =  $this->DayBook_model->fetch_voc_head($employee_school_profile_id,$school_AY_id);
			$acc['cre_vocher'] = $this->DayBook_model->fetch_cre_vocher($employee_school_profile_id,$school_AY_id);
			$nav['school_name'] = $school_admin[0]['school_name'];
			$nav['school_logo'] = $school_admin[0]['school_logo'];
			$nav['dayBook'] = 'dayBook';

			$this->load->view('School/school_header', $admin);
			$this->load->view('dayBook/dayBook_details',$acc);
			$this->load->view('dayBook/dayBook_footer',$nav);
		}

// ------------------------------------------------------ Account Group Details -----------------------------------------------------------------------------------

		function acc_group_registration()
		{
			if (isset($this->session->userdata['school'])) {
				$school_admin = $this->session->userdata('school');
        	}
			if(isset($this->session->userdata['direct'])){
				$admin['direct'] = $this->session->userdata('direct');
			}
			else{
				$admin['direct'] = 1;
			} 
			$acc_group['acc_grp_name'] = $this->input->post('acc_grp_name');
			$acc_group['acc_grp_acc_grp_id'] = $this->input->post('acc_grp_acc_grp_id');
			$acc_group['acc_grp_open_balance'] = $this->input->post('acc_grp_open_balance');
			$acc_group['acc_group_school_profile_id'] = $school_admin[0]['employee_school_profile_id'];
			$acc_group['acc_group_AY_id'] = $school_admin[0]['school_AY_id'];
			$this->db->query("INSERT INTO acc_group select NULL,'".$acc_group['acc_grp_name']."',".$acc_group['acc_grp_open_balance'].",".$acc_group['acc_grp_acc_grp_id'].",acc_grp_name,".$acc_group['acc_group_AY_id'].",".$acc_group['acc_group_school_profile_id']." FROM acc_group WHERE acc_grp_id =".$acc_group['acc_grp_acc_grp_id']."");
			$this->session->set_flashdata('active',1);
            $this->session->set_flashdata('title',"Account Group Added Successfully.");
            $this->session->set_flashdata('text',""); 
            $this->session->set_flashdata('type',"success");
			redirect('DayBook/dayBook_details');
		}

		function delete_acc_group($acc_grp_id)
		{
			$this->session->set_userdata('account_records',$acc_grp_id);
			redirect('DayBook/delete_account_records');
		}

		function delete_account_records()
		{
			$acc_grp_id = $this->session->userdata('account_records');
			$this->db->where('acc_grp_id',$acc_grp_id)->delete('acc_group');
			$this->session->set_flashdata('active',1);
            $this->session->set_flashdata('title',"Account Deleted Successfully.");
            $this->session->set_flashdata('text',""); 
            $this->session->set_flashdata('type',"success");
			redirect('DayBook/dayBook_details');
		}

// ------------------------------------------------------------- Vocher Master Details ----------------------------------------------------------------------------
		
		function voc_master_registration()
		{
			if (isset($this->session->userdata['school'])) {
				$school_admin = $this->session->userdata('school');
        	}
			if(isset($this->session->userdata['direct'])){
				$admin['direct'] = $this->session->userdata('direct');
			}
			else{
				$admin['direct'] = 1;
			} 
			$voc_master['voc_master_name'] = $this->input->post('voc_master_name');
			$voc_master['voc_master_type'] = $this->input->post('voc_master_type');
			$voc_master['voc_master_school_profile_id'] = $school_admin[0]['employee_school_profile_id'];
			$voc_master['voc_master_AY_id'] = $school_admin[0]['school_AY_id'];
			$this->DayBook_model->dayBook_registration('vocher_master',$voc_master);
			$this->session->set_flashdata('active',1);
            $this->session->set_flashdata('title',"Vocher Master Added Successfully.");
            $this->session->set_flashdata('text',""); 
            $this->session->set_flashdata('type',"success");
			redirect('DayBook/dayBook_details');
		}

		function delete_voc_master($voc_master_id)
		{
			$this->session->set_userdata('master_records',$voc_master_id);
			redirect('DayBook/delete_master_records');
		}

		function delete_master_records()
		{
			$voc_master_id = $this->session->userdata('master_records');
			$this->db->where('voc_master_id',$voc_master_id)->delete('vocher_master');
			$this->session->set_flashdata('active',1);
            $this->session->set_flashdata('title',"Vocher Master Deleted Successfully.");
            $this->session->set_flashdata('text',""); 
            $this->session->set_flashdata('type',"success");
			redirect('DayBook/dayBook_details');
		}

// ------------------------------------------------------------- Vocher Head Details -------------------------------------------------------------------------------
		
		function voc_head_registration()
		{
			if (isset($this->session->userdata['school'])) {
				$school_admin = $this->session->userdata('school');
        	}
			if(isset($this->session->userdata['direct'])){
				$admin['direct'] = $this->session->userdata('direct');
			}
			else{
				$admin['direct'] = 1;
			} 
			$voc_head['voc_head_name'] = $this->input->post('voc_head_name');
			$voc_head['voc_head_voc_master_id'] = $this->input->post('voc_head_voc_master_id');
			$voc_head['voc_head_acc_grp_id'] = $this->input->post('voc_head_acc_grp_id');
			$voc_head['voc_head_number'] = $this->input->post('voc_head_number');
			$voc_head['voc_head_school_profile_id'] = $school_admin[0]['employee_school_profile_id'];
			$voc_head['voc_head_AY_id'] = $school_admin[0]['school_AY_id'];
			$this->db->query("INSERT INTO vocher_head SELECT NULL,'".$voc_head['voc_head_name']."',".$voc_head['voc_head_voc_master_id'].",voc_master_name,".$voc_head['voc_head_acc_grp_id'].",acc_grp_name,".$voc_head['voc_head_number'].",".$voc_head['voc_head_AY_id'].",".$voc_head['voc_head_school_profile_id']." from acc_group, vocher_master where acc_grp_id =".$voc_head['voc_head_acc_grp_id']." and voc_master_id = ".$voc_head['voc_head_voc_master_id']."");
			$this->session->set_flashdata('active',1);
            $this->session->set_flashdata('title',"Vocher Head Added Successfully.");
            $this->session->set_flashdata('text',""); 
            $this->session->set_flashdata('type',"success");
			redirect('DayBook/dayBook_details');
			
		}

		function delete_voc_head($voc_head_id)
		{
			$this->session->set_userdata('voc_head_records',$voc_head_id);
			redirect('DayBook/delete_head_records');
		}

		function delete_head_records()
		{
			$voc_head_id = $this->session->userdata('voc_head_records');
			$this->db->where('voc_head_id',$voc_head_id)->delete('vocher_head');
			$this->session->set_flashdata('active',1);
            $this->session->set_flashdata('title',"Vocher Head Deleted Successfully.");
            $this->session->set_flashdata('text',""); 
            $this->session->set_flashdata('type',"success");
			redirect('DayBook/dayBook_details');
		}

// ------------------------------------------------------------- Create Vocher Details ---------------------------------------------------------------------------
		
		function fetch_vocher_head_by_master()
		{
			if (isset($this->session->userdata['school'])) {
				$school_admin = $this->session->userdata('school');
				$school_profile_id = $school_admin[0]['employee_school_profile_id'];
				$school_AY_id = $school_admin[0]['school_AY_id'];
        	}
			$master_id = $_POST['master_id'];
			$data = $this->db->query("SELECT * FROM `vocher_head` where voc_head_voc_master_id =".$master_id." and voc_head_AY_id =".$school_AY_id." and voc_head_school_profile_id =".$school_profile_id."")->result_array();

			echo json_encode($data);

		}
		function cre_vocher_registration()
		{
			if (isset($this->session->userdata['school'])) {
				$school_admin = $this->session->userdata('school');
        	}
			if(isset($this->session->userdata['direct'])){
				$admin['direct'] = $this->session->userdata('direct');
			}
			else{
				$admin['direct'] = 1;
			} 
			$cre_vocher['cre_vocher_date'] = $this->input->post('cre_vocher_date');
			$cre_vocher['cre_vocher_master_id'] = $this->input->post('cre_vocher_master_id');
			$cre_vocher['cre_vocher_head'] = $this->input->post('cre_vocher_head');
			$cre_vocher['cre_vocher_credit_legder_acc'] = $this->input->post('cre_vocher_credit_legder_acc');
			$cre_vocher['cre_vocher_debit_legder_acc'] = $this->input->post('cre_vocher_debit_legder_acc');
			$cre_vocher['cre_vocher_payment_mode'] = $this->input->post('cre_vocher_payment_mode');
			$cre_vocher['cre_vocher_amount'] = $this->input->post('cre_vocher_amount');
			$cre_vocher['cre_vocher_narration'] = $this->input->post('cre_vocher_narration');
			$cre_vocher['cre_vocher_school_profile_id'] = $school_admin[0]['employee_school_profile_id'];
			$cre_vocher['cre_vocher_AY_id'] = $school_admin[0]['school_AY_id'];
			$this->db->query("insert into create_vocher select NULL,'".$cre_vocher['cre_vocher_date']."',".$cre_vocher['cre_vocher_master_id'].",voc_master_name,".$cre_vocher['cre_vocher_head'].",voc_head_name,".$cre_vocher['cre_vocher_credit_legder_acc'].",creditor_grp_name,".$cre_vocher['cre_vocher_debit_legder_acc'].",acc_grp_name,".$cre_vocher['cre_vocher_payment_mode'].",".$cre_vocher['cre_vocher_amount'].",'".$cre_vocher['cre_vocher_narration']."',".$cre_vocher['cre_vocher_AY_id'].",".$cre_vocher['cre_vocher_school_profile_id']." from vocher_master,vocher_head,acc_group,(select acc_grp_name as creditor_grp_name from acc_group where acc_grp_id =".$cre_vocher['cre_vocher_credit_legder_acc']." ) as creditor where voc_master_id=".$cre_vocher['cre_vocher_master_id']." and voc_head_id =".$cre_vocher['cre_vocher_head']." and acc_grp_id =".$cre_vocher['cre_vocher_debit_legder_acc']."");
			$this->session->set_flashdata('active',1);
            $this->session->set_flashdata('title',"Vocher Added Successfully.");
            $this->session->set_flashdata('text',""); 
            $this->session->set_flashdata('type',"success");
			redirect('DayBook/dayBook_details');
		}

		function delete_cre_vocher($cre_vocher_id)
		{
			$this->session->set_userdata('vocher_records',$cre_vocher_id);
			redirect('DayBook/delete_vocher_records');
		}

		function delete_vocher_records()
		{
			$cre_vocher_id = $this->session->userdata('vocher_records');
			$this->db->where('cre_vocher_id',$cre_vocher_id)->delete('create_vocher');
			$this->session->set_flashdata('active',1);
            $this->session->set_flashdata('title',"Vocher Deleted Successfully.");
            $this->session->set_flashdata('text',""); 
            $this->session->set_flashdata('type',"success");
			redirect('DayBook/dayBook_details');
		}

		function update_cre_vocher($cre_vocher_id)
		{
			$this->session->set_userdata('update_vocher_records',$cre_vocher_id);
			redirect('DayBook/update_vocher_records');
		}

		function update_vocher_records()
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

			$acc['flash']['active'] = $this->session->flashdata('active');
	    	$acc['flash']['title'] = $this->session->flashdata('title');
	    	$acc['flash']['text'] = $this->session->flashdata('text');
	    	$acc['flash']['type'] = $this->session->flashdata('type');
	    	
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
			$acc['acc_group'] =  $this->DayBook_model->fetch_acc_group($employee_school_profile_id,$school_AY_id);
			$acc['voc_master'] = $this->DayBook_model->fetch_voc_master($employee_school_profile_id,$school_AY_id);
			$acc['voc_head'] =  $this->DayBook_model->fetch_voc_head($employee_school_profile_id,$school_AY_id);
			$acc['cre_vocher'] = $this->DayBook_model->fetch_cre_vocher($employee_school_profile_id,$school_AY_id);
			$nav['school_name'] = $school_admin[0]['school_name'];
			$nav['school_logo'] = $school_admin[0]['school_logo'];
			$cre_vocher_id = $this->session->userdata('update_vocher_records');
			$acc['vocher_details'] = $this->db->where('cre_vocher_id',$cre_vocher_id)->get('create_vocher')->result_array();
			$nav['dayBook'] = 'dayBook';

			$this->load->view('School/school_header', $admin);
			$this->load->view('dayBook/update_dayBook_details',$acc);
			$this->load->view('dayBook/dayBook_footer',$nav);
		}

		function update_cre_vocher_registration()
		{
			$cre_vocher_id = $this->input->post('cre_vocher_id');
			$cre_vocher['cre_vocher_credit_legder_acc'] = $this->input->post('cre_vocher_credit_legder_acc');
			$cre_vocher['cre_vocher_debit_legder_acc'] = $this->input->post('cre_vocher_debit_legder_acc');
			$cre_vocher['cre_vocher_payment_mode'] = $this->input->post('cre_vocher_payment_mode');
			$cre_vocher['cre_vocher_amount'] = $this->input->post('cre_vocher_amount');
			$cre_vocher['cre_vocher_narration'] = $this->input->post('cre_vocher_narration');
			$cre_vocher_credit_legder_acc_name = $this->db->query("SELECT acc_grp_name from acc_group where acc_grp_id = ".$cre_vocher['cre_vocher_credit_legder_acc']."")->result_array();
			$cre_vocher['cre_vocher_credit_legder_acc_name'] = $cre_vocher_credit_legder_acc_name[0]['acc_grp_name'];
			$cre_vocher_debit_legder_acc_name = $this->db->query("SELECT acc_grp_name from acc_group where acc_grp_id = ".$cre_vocher['cre_vocher_debit_legder_acc']."")->result_array();
			$cre_vocher['cre_vocher_debit_legder_acc_name'] = $cre_vocher_debit_legder_acc_name[0]['acc_grp_name'];
			$this->db->where('cre_vocher_id',$cre_vocher_id)->update('create_vocher',$cre_vocher);
			$this->session->set_flashdata('active',1);
            $this->session->set_flashdata('title',"Vocher Updated Successfully.");
            $this->session->set_flashdata('text',""); 
            $this->session->set_flashdata('type',"success");
			redirect('DayBook/dayBook_details');
		}
	}
 ?>