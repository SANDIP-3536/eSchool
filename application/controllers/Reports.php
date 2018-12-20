<?php 
date_default_timezone_set('Asia/Kolkata');
class Reports extends CI_Controller
{
	function enquiry_student_report()
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
		$admin['AY_name'] = $school_admin[0]['AY_name'];
		$AY_id = $school_admin[0]['school_AY_id'];
		$school_profile_id = $school_admin[0]['school_profile_id'];
		$school['user_profile_id'] = $school_admin[0]['employee_profile_id'];
		$admin['functionality'] = $this->School_model->fetch_functionality($school);
		$employee_school_profile_id = $school_admin[0]['employee_school_profile_id'];
		$report['class'] =  $this->db->query("SELECT * FROM class where class_school_profile_id = ".$employee_school_profile_id." and class_expiry_date='9999-12-31' GROUP BY class_name")->result_array();
		$report['admission_class'] =  $this->db->query("SELECT enquiry_admission_class FROM `enquiry` where enquiry_school_profile_id =".$employee_school_profile_id." group by enquiry_admission_class")->result_array();
		$report['school'] =  $this->db->query("select school.* from school where school_profile_id =".$employee_school_profile_id."")->result_array();
		$report['town'] =  $this->db->query("SELECT student_present_town FROM student where student_school_profile_id =".$employee_school_profile_id." group by student_present_town")->result_array();
		$report['genral'] =  $this->db->query("SELECT 
						student_GRN
						,student_first_name
						,student_middle_name
						,student_last_name
						,parent_first_name
						,student_religion
						,student_cast
						,student_sub_cast
						,student_birth_place
						,student_nationality
						,date_format(student_DOB,'%d-%m-%Y') as DOB
						,student_privious_school_name
						,date_format(student_admission_date,'%d-%m-%Y') as admission_date
						,class_of_admission
						,student_progress
						,student_conduct
						,date_format(student_LC_date,'%d-%m-%Y') as student_LC_date
						,student_LC_reason
						,last_AY_name
						,last_class_of_admission
						,case when student_expiry_date ='9999-12-31' then ' ' else 'Alumni' end as status
						FROM student
						join (
						select
						SCD_student_profile_id
						,AY_name
						,class_name as class_of_admission
						from student_class_division_assgn
						join academic_year
						on SCD_AY_id=AY_id
						join class
						on class_id=SCD_class_id
						where SCD_id in (
						SELECT
						min(SCD_id) as SCD_id
						FROM `student_class_division_assgn`
						where SCD_school_profile_id=".$employee_school_profile_id."

						group by SCD_student_profile_id
						)
						) as AY
						on AY.SCD_student_profile_id=student_profile_id
						join student_class_division_assgn as SCD
						on SCD.SCD_student_profile_id=student_profile_id
						and SCD.SCD_school_profile_id=".$employee_school_profile_id."
						join class
						on SCD.SCD_class_id=class_id
						join division
						on SCD.SCD_division_id=division_id
						left join parent
						on parent_student_profile_id=student_profile_id
						and parent_type=2
						left join (
						select
						SCD_student_profile_id
						,AY_name as last_AY_name
						,class_name as last_class_of_admission
						from student_class_division_assgn
						join academic_year
						on SCD_AY_id=AY_id
						join class
						on class_id=SCD_class_id
						where SCD_id in (
						SELECT
						max(SCD_id) as SCD_id
						FROM `student_class_division_assgn`
						where SCD_school_profile_id=".$employee_school_profile_id."
						and SCD_expiry_date !='9999-12-31'
						group by SCD_student_profile_id
						)
						) as last_AY
						on last_AY.SCD_student_profile_id=student_profile_id
						where student_school_profile_id=".$employee_school_profile_id."
						order by student_GRN")->result_array();
		
		
		
		//print_r($report['total_sms_report']);die();

		$nav['school_report_header'] = $school_admin[0]['school_report_header'];
		$report['school_report_footer'] = $school_admin[0]['school_report_footer'];
		$nav['school_name'] = $school_admin[0]['school_name'];
		$nav['school_logo'] = $school_admin[0]['school_logo'];
		$nav['report'] = 'student';

		$this->load->view('School/school_header', $admin);
		$this->load->view('Reports/enquiry_student_report',$report);
		$this->load->view('Reports/enquiry_student_report_footer',$nav);
	}

	function government_report()
	{
		$school_admin = $this->session->userdata('school');
		$employee_school_profile_id = $school_admin[0]['employee_school_profile_id'];
		$school_profile_id = $school_admin[0]['school_profile_id'];

		$report['government'] = $this->db->query("SELECT student_GRN,AY.AY_name as AY_name,class_name,division_name,student_first_name,student_middle_name,student_gender
						,student_last_name
						,date_format(student_DOB,'%d-%m-%Y') as DOB
						,parent_first_name
						,parent_middle_name
						,parent_last_name
						,'27350504907' as UDISE_number
						,'No' as Semi_English
						,date_format(student_admission_date,'%d-%m-%Y') as admission_date
						,class_of_admission
						,student_category
						,student_religion
						,student_cast
						,student_sub_cast
						,'No' as BPL
						FROM student
						join (
						select
						SCD_student_profile_id
						,AY_name
						,class_name as class_of_admission
						from student_class_division_assgn
						join academic_year
						on SCD_AY_id=AY_id
						join class
						on class_id=SCD_class_id
						where SCD_id in (
						SELECT
						min(SCD_id) as SCD_id
						FROM `student_class_division_assgn`
						where SCD_school_profile_id=".$school_profile_id."
						group by SCD_student_profile_id
						)
						) as AY
						on AY.SCD_student_profile_id=student_profile_id
						join student_class_division_assgn as SCD
						on SCD.SCD_student_profile_id=student_profile_id
						and SCD.SCD_school_profile_id=".$school_profile_id."
						and SCD.SCD_expiry_date='9999-12-31'
						join class
						on SCD.SCD_class_id=class_id
						join division
						on SCD.SCD_division_id=division_id
						left join parent
						on parent_student_profile_id=student_profile_id
						and parent_type=2
						where student_expiry_date='9999-12-31'
						and student_school_profile_id=".$employee_school_profile_id."
						order by student_GRN")->result_array();

		echo json_encode($report);
	}
	function all_report()
	{
		$school_admin = $this->session->userdata('school');
		$employee_school_profile_id = $school_admin[0]['employee_school_profile_id'];

		$report['all_report'] = $this->db->query("SELECT 
							student_GRN
							,concat(student_last_name,' ',student_first_name,' ',student_middle_name) as student_name
							,student_gender
							,student_adhar_card_number
							,date_format(student_DOB,'%d-%m-%Y') as DOB
							,student_birth_place
							,student_blood_group
							,student_present_town
							,concat(student_permament_house_no,'A/P.',student_present_town,' ','Tal.',student_present_tal,',Dist.',student_present_dist,' ',student_present_state,'-',student_present_pincode) as student_address
							,date_format(student_admission_date,'%d-%m-%Y') as admission_date
							,class_name
							,division_name
							,SCD_roll_no
							,student_religion
							,student_cast
							,student_sub_cast
							,father.parent_first_name as father_name
							,father.parent_mobile_number as father_mobile_number
							,mother.parent_first_name as mother_name
							,mother.parent_mobile_number as mother_mobile_number
							,student_category
							FROM student
							join student_class_division_assgn
							on SCD_student_profile_id=student_profile_id
							and SCD_school_profile_id=".$employee_school_profile_id."
							and SCD_expiry_date='9999-12-31'
							join class
							on SCD_class_id=class_id
							join division
							on SCD_division_id=division_id
							left join (select * from parent where parent_type=1) as father
							on father.parent_student_profile_id=student_profile_id
							left join (select * from parent where parent_type=2) as mother
							on mother.parent_student_profile_id=student_profile_id
							where student_school_profile_id=".$employee_school_profile_id."
							and student_expiry_date='9999-12-31'
							order by student_GRN")->result_array();

		echo json_encode($report);
	}

	function sms_report()
	{
		$school_admin = $this->session->userdata('school');
		$employee_school_profile_id = $school_admin[0]['employee_school_profile_id'];
		
		$report['total_sms_report'] = $this->db->query("SELECT * from (SELECT 
													sent_sms_datetime
												    ,DATE_FORMAT(sent_sms_datetime,'%d-%m-%Y') as sms_date
												    ,DATE_FORMAT(sent_sms_datetime,'%H:%i-%s') as sms_time
												    ,'student' as type               
												    ,case when sent_sms_sub_type='3' then 'Absent SMS'
												    when sent_sms_sub_type='4' then 'Student Birthday'
												    when sent_sms_sub_type='7' then 'Authentication Details'
												    when sent_sms_sub_type='8' then 'Prsonalised SMS'
												    when sent_sms_sub_type='11' then 'Parent Meet'
												    when sent_sms_sub_type='12' then 'News Feed'
												    when sent_sms_sub_type='13' then 'Circular Notice'
												    when sent_sms_sub_type='14' then 'Event SMS'
												    when sent_sms_sub_type='15' then 'Holiday'
												    when sent_sms_sub_type='16' then 'Enquiry SMS'
												    else 'NA' end as sms_type
												    ,sent_sms_mobile_number
												    ,CONCAT(student_first_name,' ',student_last_name) as name
												    ,sent_sms_MsgID
												    ,sent_sms_count
												    ,sent_sms_MSG
												FROM sent_sms 
												left join student 
													on sent_sms_student_profile_id = student_profile_id 
												WHERE sent_sms_student_profile_id != 0 
												and sent_sms_school_profile_id = ".$employee_school_profile_id." ) as std
												union 
												select * from (SELECT 
													sent_sms_datetime
												    ,DATE_FORMAT(sent_sms_datetime,'%d-%m-%Y') as sms_date
												    ,DATE_FORMAT(sent_sms_datetime,'%H:%i-%s') as sms_time
													,'Employee' as type               
												    ,case when sent_sms_sub_type='9' then 'Employee Birthday'
												    else 'NA' end as sms_type
												    ,sent_sms_mobile_number
												    ,CONCAT(employee_first_name,' ',employee_last_name) as name
												    ,sent_sms_MsgID
												    ,sent_sms_count
												    ,sent_sms_MSG
												FROM sent_sms
												left join employee 
													on sent_sms_employee_profile_id = employee_profile_id 
												WHERE sent_sms_student_profile_id = 0 
												and sent_sms_school_profile_id = ".$employee_school_profile_id." )as emp
												order by sent_sms_datetime DESC,sms_time DESC")->result_array();
		echo json_encode($report);
	}

	function doc_report()
	{
		$school_admin = $this->session->userdata('school');
		$employee_school_profile_id = $school_admin[0]['employee_school_profile_id'];

		$report['doc_report'] = $this->db->query("SELECT student_GRN,concat(student_first_name,' ',student_middle_name,' ',student_last_name) as student_name,class_name    ,division_name
			,case when student_photo like '%profile_photo/default_student_image.png' then '-' else 'Yes' end as student_photo_status
			,case when father.parent_photo is NULL then '-' else 'Yes' end as father_photo_status
			,case when mother.parent_photo is NULL then '-' else 'Yes' end as mother_photo_status
			,case when aadhar.doc_file is NULL then '-' else 'Yes' end as aadhar_card_status
			,case when transfer.doc_file is NULL then '-' else 'Yes' end as transfer_certificate_status
			,case when leaving.doc_file is NULL then '-' else 'Yes' end as leaving_certificate_status
			,case when birth.doc_file is NULL then '-' else 'Yes' end as birth_certificate_status
			,case when medicle.doc_file is NULL then '-' else 'Yes' end as medicle_certificate_status
			FROM student
			left join student_class_division_assgn
			on SCD_student_profile_id=student_profile_id
			left join class
			on SCD_class_id=class_id
			left join division
			on SCD_division_id=division_id
			left join (select parent_photo,parent_student_profile_id from parent where parent_type=1 and parent_expiry_date='9999-12-31' and parent_photo not like '%profile_photo/default_parent_image.png') as father
			on father.parent_student_profile_id=student_profile_id
			left join (select parent_photo,parent_student_profile_id from parent where parent_type=2 and parent_expiry_date='9999-12-31' and parent_photo not like '%profile_photo/default_parent_image.png') as mother
			on mother.parent_student_profile_id=student_profile_id
			left join (select doc_user,doc_file from document where doc_name='Adhar_Card' and doc_expiry_date='9999-12-31' and doc_user_type='8') as aadhar
			on aadhar.doc_user=student_profile_id
			left join (select doc_user,doc_file from document where doc_name='Transfer_Certificate' and doc_expiry_date='9999-12-31' and doc_user_type='8') as transfer
			on transfer.doc_user=student_profile_id
			left join (select doc_user,doc_file from document where doc_name='Birth_Certificate' and doc_expiry_date='9999-12-31' and doc_user_type='8') as birth
			on birth.doc_user=student_profile_id
			left join (select doc_user,doc_file from document where doc_name='Leaving_Certificate' and doc_expiry_date='9999-12-31' and doc_user_type='8') as leaving
			on leaving.doc_user=student_profile_id
			left join (select doc_user,doc_file from document where doc_name='Medical_Certificate' and doc_expiry_date='9999-12-31' and doc_user_type='8') as medicle
			on medicle.doc_user=student_profile_id
			where student_expiry_date='9999-12-31'
			and student_school_profile_id=".$employee_school_profile_id." ORDER BY student_GRN")->result_array();

		echo json_encode($report);
	}

	function fetch_class_division()
	{
		$school_admin = $this->session->userdata('school');
		$class_id = $_POST['class_id'];
		$school_id = $school_admin[0]['employee_school_profile_id'];
		$data = $this->db->query("SELECT * FROM division where division_class_id =".$class_id." and division_school_profile_id =".$school_id." and division_expiry_date = '9999-12-31' GROUP BY division_name")->result_array();
		echo json_encode($data);
	}

// ---------------------------------------------------------------- Enquiry Report ----------------------------------------------------------------------------
	function school_enquiry_report()
	{
		$school_admin = $this->session->userdata('school');
		$enquiry_school['school_id'] = $_POST['school_id'];
		$data = $this->db->query("SELECT * FROM `enquiry` where enquiry_school_profile_id =".$enquiry_school['school_id']."")->result();
		echo json_encode($data);
	}

	function enquiry_admission_class_report()
	{
		$school_admin = $this->session->userdata('school');
		$admission_class['class'] = $_POST['admission_class'];
		$admission_class['school_id'] = $school_admin[0]['employee_school_profile_id'];
		$data = $this->db->query("SELECT * FROM `enquiry` where enquiry_admission_class = '".$admission_class['class']."' and enquiry_school_profile_id =".$admission_class['school_id']."")->result();
		echo json_encode($data);
	}

// -----------------------------------------------------------------  Fee Reports ------------------------------------------------------------------------------
	function fee_report()
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
		$admin['AY_name'] = $school_admin[0]['AY_name'];
		$admin['AY_id'] = $school_admin[0]['AY_id'];
		$school['user_profile_id'] = $school_admin[0]['employee_profile_id'];
		$admin['functionality'] = $this->School_model->fetch_functionality($school);
		$employee_school_profile_id = $school_admin[0]['employee_school_profile_id'];
		$report['class'] =  $this->db->query("SELECT * FROM class where class_school_profile_id = ".$employee_school_profile_id." and class_expiry_date='9999-12-31' GROUP BY class_name")->result_array();
		$report['admission_class'] =  $this->db->query("SELECT enquiry_admission_class FROM `enquiry` where enquiry_school_profile_id =".$employee_school_profile_id." group by enquiry_admission_class")->result_array();
		$report['school'] =  $this->db->query("select school.* from school where school_profile_id =".$employee_school_profile_id."")->result_array();
		$report['fee_category'] =  $this->db->query("SELECT * FROM fee_category where fee_category_expiry_date='9999-12-31' and fee_category_school_profile_id =".$employee_school_profile_id."")->result_array();
		
		$nav['school_report_header'] = $school_admin[0]['school_report_header'];
		$nav['school_report_footer'] = $school_admin[0]['school_report_footer'];
		$nav['school_name'] = $school_admin[0]['school_name'];
		$nav['school_logo'] = $school_admin[0]['school_logo'];
		$nav['report'] = 'fee';

		$this->load->view('School/school_header', $admin);
		$this->load->view('Reports/fee_report',$report);
		$this->load->view('Reports/fee_report_footer',$nav);
	}

	function send_fee_sms()
	{
		$Student_profile_id = $_POST['Student_profile_id'];
		$balance = $_POST['balance'];

		$school_admin = $this->session->userdata('school');
		$signature = $this->db->query('select institute_sender_id,institute_signature from institute where institute_profile_id=(select school_institute_profile_id from school where school_profile_id='.$school_admin[0]['employee_school_profile_id'].')')->result_array();
			
		$number = '';
		$mobile_number = $this->db->query("SELECT * FROM parent join student on parent_student_profile_id = student_profile_id and parent_profile_id = student_parent_id where student_profile_id = ".$Student_profile_id."")->result_array();
						
		$msg = "Dear parent, \nYou are requested to pay School balance fees of Rs.".$balance." as soon as possible. \nRegards, \n".$signature[0]['institute_signature'].".";
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

	function total_fee_report()
	{
		$school_admin = $this->session->userdata('school');
		$employee_school_profile_id = $school_admin[0]['employee_school_profile_id'];
		
		$report['total_fee_report'] = $this->db->query("SELECT 
															Student_profile_id
															,student_GRN,CONCAT(Student_first_name,' ',Student_middle_name,' ',student_last_name) as student_name
															,parent_mobile_number 
															,case  
																when class_id is NULL then '0' 
																else class_id 
															end as class_id 
															,case  
																when class_name is NULL then 'N/A' 
																else class_name 
															end as class_name 
															,case  
																when division_id is NULL then '0' 
																else division_id 
															end as division_id 
															,case  
																when division_name is NULL then 'N/A' 
																else division_name 
															end as division_name 
															,case  
																when total_fee_amount is NULL then '0' 
																else total_fee_amount 
															end as total_fee_amount 
															,case  
																when fee_waiver_amount is NULL then '0' 
																else fee_waiver_amount 
															end as fee_waiver_amount 
															,case  
																when fee_amount is NULL then student_total_advance_payment 
																else (fee_amount+student_total_advance_payment) 
															end as fee_amount
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
															left join parent 
																on parent_profile_id=student_parent_id 
															left join student_class_division_assgn 
																on SCD_student_profile_id=student_profile_id 
																and SCD_AY_id=school_AY_id 
																and SCD_expiry_date='9999-12-31' 
															left join class 
																on SCD_class_id=class_id 
																and class_expiry_date='9999-12-31' 
															left join division 
																on SCD_division_id=division_id 
																and division_expiry_date='9999-12-31' 
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
															order by student_GRN")->result_array();
		
		echo json_encode($report);
	}
	function fee_due_report()
	{
		$school_admin = $this->session->userdata('school');
		$employee_school_profile_id = $school_admin[0]['employee_school_profile_id'];
		$report['fee_due_report'] = $this->db->query("SELECT 
														* 
													from
													(
														select 
															Student_profile_id
															,student_GRN
															,CONCAT(Student_first_name,' ',Student_middle_name,' ',student_last_name) as student_name
															,parent_mobile_number 
															,case  
																when class_id is NULL then '0' 
																else class_id 
															end as class_id 
															,case  
																when class_name is NULL then 'N/A' 
																else class_name 
															end as class_name 
															,case  
																when division_id is NULL then '0' 
																else division_id 
															end as division_id 
															,case  
																when division_name is NULL then 'N/A' 
																else division_name 
															end as division_name 
															,case  
																when total_fee_amount is NULL then '0' 
																else total_fee_amount 
															end as total_fee_amount
															,case  
															 	when fee_waiver_amount is NULL then '0' 
															 	else fee_waiver_amount 
															 end as fee_waiver_amount 
															,case  
															 	when fee_amount is NULL then student_total_advance_payment
															 	else (fee_amount+student_total_advance_payment) 
															 end as fee_amount
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
															left join parent 
																on parent_profile_id=student_parent_id 
															left join student_class_division_assgn 
																on SCD_student_profile_id=student_profile_id 
																and SCD_AY_id=school_AY_id 
																and SCD_expiry_date='9999-12-31' 
															left join class 
																on SCD_class_id=class_id 
																and class_expiry_date='9999-12-31' 
															left join division 
																on SCD_division_id=division_id 
																and division_expiry_date='9999-12-31' 
															left join 
															(
																select 
																	total_fee_student_profile_id
																	,sum(total_fee_amount) as total_fee_amount,total_fee_AY_id 
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
														where student_school_profile_id=".$employee_school_profile_id."

														and student_expiry_date='9999-12-31'
													) as data 
													where balance > 0 
													order by student_GRN")->result_array();
$report['fee_due_report_balance'] = $this->db->query("SELECT sum(balance) as balance
													from
													(
														select 
															Student_profile_id
															,student_GRN
															,CONCAT(Student_first_name,' ',Student_middle_name,' ',student_last_name) as student_name
															,parent_mobile_number 
															,case  
																when class_id is NULL then '0' 
																else class_id 
															end as class_id 
															,case  
																when class_name is NULL then 'N/A' 
																else class_name 
															end as class_name 
															,case  
																when division_id is NULL then '0' 
																else division_id 
															end as division_id 
															,case  
																when division_name is NULL then 'N/A' 
																else division_name 
															end as division_name 
															,case  
																when total_fee_amount is NULL then '0' 
																else total_fee_amount 
															end as total_fee_amount
															,case  
															 	when fee_waiver_amount is NULL then '0' 
															 	else fee_waiver_amount 
															 end as fee_waiver_amount 
															,case  
															 	when fee_amount is NULL then student_total_advance_payment
															 	else (fee_amount+student_total_advance_payment) 
															 end as fee_amount
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
															left join parent 
																on parent_profile_id=student_parent_id 
															left join student_class_division_assgn 
																on SCD_student_profile_id=student_profile_id 
																and SCD_AY_id=school_AY_id 
																and SCD_expiry_date='9999-12-31' 
															left join class 
																on SCD_class_id=class_id 
																and class_expiry_date='9999-12-31' 
															left join division 
																on SCD_division_id=division_id 
																and division_expiry_date='9999-12-31' 
															left join 
															(
																select 
																	total_fee_student_profile_id
																	,sum(total_fee_amount) as total_fee_amount,total_fee_AY_id 
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
														where student_school_profile_id=".$employee_school_profile_id."

														and student_expiry_date='9999-12-31'
													) as data 
													where balance > 0 
													")->result_array();
		echo json_encode($report);
	}
	function paid_fee_report()
	{
		$school_admin = $this->session->userdata('school');
		$employee_school_profile_id = $school_admin[0]['employee_school_profile_id'];
		$AY_id = $school_admin[0]['AY_id'];
		$report['paid_fee_report'] = $this->db->query("SELECT * from(select Student_profile_id,student_GRN,CONCAT(Student_first_name,' ',Student_middle_name,' ',student_last_name) as student_name,parent_mobile_number ,case  when class_id is NULL then '0' else class_id end as class_id ,case  when class_name is NULL then 'N/A' else class_name end as class_name ,case  when division_id is NULL then '0' else division_id end as division_id ,case  when division_name is NULL then 'N/A' else division_name end as division_name ,case  when total_fee_amount is NULL then '0' else total_fee_amount end as total_fee_amount ,case  when fee_waiver_amount is NULL then '0' else fee_waiver_amount end as fee_waiver_amount ,case  when fee_amount is NULL then student_total_advance_payment else (fee_amount+student_total_advance_payment) end as fee_amount, case when fee_waiver_amount is NULL and fee_amount is NULL AND total_fee_amount is NULL then '0' when fee_waiver_amount is NULL and fee_amount is NULL then (total_fee_amount-student_total_advance_payment) when fee_waiver_amount is NULL then (total_fee_amount-fee_amount-student_total_advance_payment) when fee_amount is NULL then (total_fee_amount-fee_waiver_amount-student_total_advance_payment) else (total_fee_amount-fee_waiver_amount-fee_amount-student_total_advance_payment) end as balance from student join school on student_school_profile_id=school_profile_id left join parent on parent_profile_id=student_parent_id join student_class_division_assgn on SCD_student_profile_id=student_profile_id and SCD_AY_id=school_AY_id and SCD_expiry_date='9999-12-31' join class on SCD_class_id=class_id and class_expiry_date='9999-12-31' left join division on SCD_division_id=division_id and division_expiry_date='9999-12-31' left join (select total_fee_student_profile_id,sum(total_fee_amount) as total_fee_amount,total_fee_AY_id from total_fees group by total_fee_student_profile_id) as total_fees on total_fee_student_profile_id=student_profile_id and total_fee_AY_id=school_AY_id left join (select fee_waiver_student_profile_id,sum(fee_waiver_amount) as fee_waiver_amount,fee_waiver_AY_id from fee_waiver group by fee_waiver_student_profile_id) as fee_waiver on fee_waiver_student_profile_id=student_profile_id and fee_waiver_AY_id=school_AY_id left join (select fee_student_profile_id,sum(fee_amount) as fee_amount,fee_AY_id from fee group by fee_student_profile_id) as fee on fee_student_profile_id=student_profile_id and fee_AY_id=school_AY_id where student_school_profile_id=".$employee_school_profile_id." and student_expiry_date='9999-12-31') as data where balance <= 0 order by student_GRN")->result_array();
		
		echo json_encode($report);
	}
	function fee_category_report()
	{
		$school_admin = $this->session->userdata('school');
		$employee_school_profile_id = $school_admin[0]['employee_school_profile_id'];
		$admin['AY_id'] = $school_admin[0]['AY_id'];
		$report['fee_category_report'] = $this->db->query("SELECT student_profile_id,student_GRN,CONCAT(student_first_name,' ',Student_middle_name,' ',student_last_name) as student_name,parent_mobile_number,total_fee_type_id,total_fee_amount,fees_type_name,class_name,division_name,fee_category_name from student join parent on student_parent_id = parent_profile_id join total_fees on total_fee_student_profile_id = student_profile_id  and total_fee_AY_id =".$admin['AY_id']." join fees_type on fees_type_id = total_fee_type_id and total_fee_AY_id = fees_type_AY_id join  student_class_division_assgn on student_profile_id = SCD_student_profile_id and SCD_AY_id = total_fee_AY_id and SCD_expiry_date = '9999-12-31' join fee_category on fees_type_fee_category_id = fee_category_id join class on class_id = SCD_class_id join division on division_id = SCD_division_id where student_expiry_date = '9999-12-31' and student_school_profile_id =".$employee_school_profile_id." order by student_GRN")->result_array();
		
		echo json_encode($report);
	}
	function fee_waiver_report()
	{
		$school_admin = $this->session->userdata('school');
		$employee_school_profile_id = $school_admin[0]['employee_school_profile_id'];
		$admin['AY_id'] = $school_admin[0]['AY_id'];

		$report['fee_waiver_report'] = $this->db->query("SELECT 
															student_GRN
															,CONCAT(student_first_name,' ',student_middle_name,' ',student_last_name) as student_name
															,class_name
															,division_name 
															,total_fee_amount
															,fee_waiver_amount 
															from student 
															left join student_class_division_assgn 
																on student_profile_id = SCD_student_profile_id 
																and SCD_AY_id = ".$admin['AY_id']." 
															left join class 
																on class_id = SCD_class_id 
															left join division 
																on division_id = SCD_division_id 
															left join 
															(
																select 
																	total_fee_student_profile_id
																	,sum(total_fee_amount) as total_fee_amount
																from total_fees 
																where total_fee_AY_id=".$admin['AY_id']." 
																group by total_fee_student_profile_id
															) as total_fees 
																on total_fee_student_profile_id=student_profile_id 
															left join 
															(
																select 
																	fee_waiver_student_profile_id
																	,sum(fee_waiver_amount) as fee_waiver_amount
																from fee_waiver 
																where fee_waiver_AY_id=".$admin['AY_id']." 
																group by fee_waiver_student_profile_id
															) as fee_waiver 
																on fee_waiver_student_profile_id=student_profile_id 
															where student_expiry_date = '9999-12-31' 
															and student_school_profile_id =".$employee_school_profile_id." 
															and fee_waiver_amount is NOT NULL
															order by student_GRN")->result_array();
		
		echo json_encode($report);
	}
	function daily_report_data()
	{
		$school_admin = $this->session->userdata('school');
		$employee_school_profile_id = $school_admin[0]['employee_school_profile_id'];
		$admin['AY_id'] = $school_admin[0]['AY_id'];
		$report['daily_report'] = $this->db->query("SELECT 
														@a:=@a+1 serial_number
														,data.* 
													from
													(
														SELECT 
															student_GRN
															,DATE_FORMAT(fee_datetime,'%d/%m/%Y') as date	
															,DATE_FORMAT(fee_datetime,'%H:%i:%s') as time	
															,CONCAT(student_last_name,' ',student_first_name,' ',student_middle_name) as student_name
															,class_name
															,division_name
															,fee_amount
														FROM 
														(
															SELECT 
																fee_id
																,fee_datetime
																,fee_student_profile_id
																,fee_amount
																,fee_payment_mode
																,fee_transaction_number
																,fee_AY_id
																,fee_narration
																,fee_school_profile_id 
															FROM fee 
															union all 
															select 	
																advance_id as  fee_id 
																,advance_datetime as fee_datetime
																,advance_student_profile_id as fee_student_profile_id
																,advance_amount as fee_amount
																,advance_payment_mode as fee_payment_mode 
																,advance_transaction_number as fee_transaction_number
																,advance_AY_id as fee_AY_id
																,advance_narration as fee_narration
																,advance_school_profile_id as fee_school_profile_id 
															FROM advance_payment
														) as fee 
														join student 
															on student_profile_id = fee_student_profile_id 
														join student_class_division_assgn 
															on SCD_student_profile_id = fee_student_profile_id 
														join class 	
															on SCD_class_id = class_id 
														join division 
															on SCD_division_id = division_id 
														where 
															fee_AY_id=".$admin['AY_id']." 
															and fee_school_profile_id =".$employee_school_profile_id." 
														order by 
															fee_datetime DESC
															,student_GRN ASC
													) as data,
													(
														SELECT @a:= 0
													) AS a" )->result_array();

		$report['fee_amount'] = $this->db->query("		SELECT 
											SUM(fee_amount) AS fee_amount
										FROM 
										(
											SELECT 
												fee_id
												,fee_datetime
												,fee_student_profile_id
												,fee_amount
												,fee_payment_mode
												,fee_transaction_number
												,fee_AY_id
												,fee_narration
												,fee_school_profile_id 
											FROM fee 
											union all 
											select 	
												advance_id as  fee_id 
												,advance_datetime as fee_datetime
												,advance_student_profile_id as fee_student_profile_id
												,advance_amount as fee_amount
												,advance_payment_mode as fee_payment_mode 
												,advance_transaction_number as fee_transaction_number
												,advance_AY_id as fee_AY_id
												,advance_narration as fee_narration
												,advance_school_profile_id as fee_school_profile_id 
											FROM advance_payment
										) as fee 
										where 
											fee_AY_id=".$admin['AY_id']."  
											and fee_school_profile_id =".$employee_school_profile_id."")->result_array();
		echo json_encode($report);
	}

	function fetch_fee_types()
	{
		$school_admin = $this->session->userdata('school');
		$school_id = $school_admin[0]['employee_school_profile_id'];
		$AY_id = $school_admin[0]['AY_id'];
		$class_id = $_POST['class_id'];
		$data = $this->db->query("select fees_type_name,fees_type_id from fees_type where fees_type_class_id =".$class_id." and fees_type_AY_id =".$AY_id." and fees_type_expiry_date='9999-12-31' and fees_type_school_profile_id =".$school_id."")->result_array();
		echo json_encode($data);
	}

	function class_division_category_fee_report()
	{
		$school_admin = $this->session->userdata('school');
		$school_id = $school_admin[0]['employee_school_profile_id'];
		$AY_id = $school_admin[0]['AY_id'];
		$data = $this->db->query("select student_profile_id,student_GRN,CONCAT(student_first_name,' ',student_last_name) as student_name, CONCAT(parent_first_name,' ',parent_last_name) as parent_name ,student_gender,parent_mobile_number,total_fee_type_id,total_fee_amount,fees_type_name,class_name,division_name from student join parent on student_parent_id = parent_profile_id join total_fees on total_fee_student_profile_id = student_profile_id  and total_fee_AY_id =".$AY_id." join fees_type on fees_type_id = total_fee_type_id and total_fee_AY_id = fees_type_AY_id join  student_class_division_assgn on student_profile_id = SCD_student_profile_id and SCD_AY_id = total_fee_AY_id and SCD_expiry_date = '9999-12-31' 
									join class on class_id = SCD_class_id join division on division_id = SCD_division_id where student_expiry_date = '9999-12-31' and student_school_profile_id =".$school_id." order by student_GRN")->result();
		echo json_encode($data);
	}

	function class_all_division_category_fee_report()
	{
		$school_admin = $this->session->userdata('school');
		$school_id = $school_admin[0]['employee_school_profile_id'];
		$AY_id = $school_admin[0]['AY_id'];
		$class_id = $_POST['class_id'];
		$fee_type = $_POST['fee_type'];
		$data = $this->db->query("select student_profile_id,student_GRN,CONCAT(student_first_name,' ',student_last_name) as student_name, CONCAT(parent_first_name,' ',parent_last_name) as parent_name ,student_gender,parent_mobile_number,total_fee_type_id,total_fee_amount,fees_type_name,class_name,division_name from student join parent on student_parent_id = parent_profile_id join total_fees on total_fee_student_profile_id = student_profile_id  and total_fee_AY_id =".$AY_id." join fees_type on fees_type_id = total_fee_type_id and total_fee_AY_id = fees_type_AY_id and fees_type_fee_category_id = ".$fee_type." join  student_class_division_assgn on student_profile_id = SCD_student_profile_id and SCD_AY_id = total_fee_AY_id and SCD_expiry_date = '9999-12-31' 
									join class on class_id = SCD_class_id join division on division_id = SCD_division_id where student_expiry_date = '9999-12-31' and student_school_profile_id =".$school_id." and SCD_class_id =".$class_id." order by student_GRN")->result();
		echo json_encode($data);		
	}

	function division_class_category_fee_report()
	{
		$school_admin = $this->session->userdata('school');
		$school_id = $school_admin[0]['employee_school_profile_id'];
		$AY_id = $school_admin[0]['AY_id'];
		$class_id = $_POST['class_id'];
		$division_id = $_POST['division_id'];
		$fee_type = $_POST['fee_type'];
		// $data = $this->db->query("select student_profile_id,student_GRN,CONCAT(student_first_name,' ',student_last_name) as student_name, CONCAT(parent_first_name,' ',parent_last_name) as parent_name ,student_gender,parent_mobile_number,total_fee_type_id,total_fee_amount,fees_type_name,class_name,division_name from student join parent on student_parent_id = parent_profile_id join total_fees on total_fee_student_profile_id = student_profile_id  and total_fee_AY_id =".$AY_id." join fees_type on fees_type_id = total_fee_type_id and total_fee_AY_id = fees_type_AY_id and fees_type_fee_category_id = ".$fee_type." join  student_class_division_assgn on student_profile_id = SCD_student_profile_id and SCD_AY_id = total_fee_AY_id and SCD_expiry_date = '9999-12-31' 
									// join class on class_id = SCD_class_id join division on division_id = SCD_division_id where student_expiry_date = '9999-12-31' and student_school_profile_id =".$school_id." and SCD_class_id =".$class_id." and SCD_division_id =".$division_id."")->result();
		echo json_encode($class_id);		
	}

	function fetch_daily_payment()
	{
		$school_admin = $this->session->userdata('school');
		$school_id = $school_admin[0]['employee_school_profile_id'];
		$date = $_POST['date'];
		$AY_id = $school_admin[0]['AY_id'];
		$data = $this->db->query("SELECT 
				@a:=@a+1 serial_number
				,data.*
			    from(SELECT 
						student_GRN
						,CONCAT(student_last_name,' ',student_first_name,' ',student_middle_name) as student_name
						,class_name
						,division_name
						,DATE_FORMAT(fee_datetime,'%d/%m/%Y') as date
						,fee_amount 
					FROM `fee` 
					join student 
						on student_profile_id = fee_student_profile_id 
					join student_class_division_assgn 
						on SCD_student_profile_id = fee_student_profile_id 
					join class 
						on SCD_class_id = class_id 
					join division 
						on SCD_division_id = division_id 
					where DATE_FORMAT(fee_datetime,'%Y-%m-%d') = '".$date."' 
						and fee_AY_id=".$AY_id." 
						and fee_school_profile_id = ".$school_id." order by student_GRN
					) as data,
					(SELECT 
						@a:= 0
					) AS a
			UNION ALL
			SELECT 
				' ' as serial_number
				,' ' as student_GRN
				,'Total Amount ' as student_name
				,' ' as class_name
				,' ' as division_name
				,'' as date
				,sum(fee_amount) as total_amount 
			FROM `fee` 
			where DATE_FORMAT(fee_datetime,'%Y-%m-%d') = '".$date."' 
			and fee_AY_id=".$AY_id." 
			and fee_school_profile_id = ".$school_id."")->result();
		echo json_encode($data);		
	}
	function fetch_daily_payment_daterange()
	{
		$school_admin = $this->session->userdata('school');
		$school_id = $school_admin[0]['employee_school_profile_id'];
		$start_date = $_POST['start_date'];
		$end_date = $_POST['end_date'];
		$AY_id = $school_admin[0]['AY_id'];
		$data['daily_report'] = $this->db->query("	SELECT 
										@a:=@a+1 serial_number
										,data.* 
									from
									(
										SELECT 
											student_GRN
											,DATE_FORMAT(fee_datetime,'%d/%m/%Y') as date	
											,DATE_FORMAT(fee_datetime,'%H:%i:%s') as time	
											,CONCAT(student_last_name,' ',student_first_name,' ',student_middle_name) as student_name
											,class_name
											,division_name
											,fee_amount
										FROM 
										(
											SELECT 
												fee_id
												,fee_datetime
												,fee_student_profile_id
												,fee_amount
												,fee_payment_mode
												,fee_transaction_number
												,fee_AY_id
												,fee_narration
												,fee_school_profile_id 
											FROM fee 
											union all 
											select 	
												advance_id as  fee_id 
												,advance_datetime as fee_datetime
												,advance_student_profile_id as fee_student_profile_id
												,advance_amount as fee_amount
												,advance_payment_mode as fee_payment_mode 
												,advance_transaction_number as fee_transaction_number
												,advance_AY_id as fee_AY_id
												,advance_narration as fee_narration
												,advance_school_profile_id as fee_school_profile_id 
											FROM advance_payment
										) as fee 
										join student 
											on student_profile_id = fee_student_profile_id 
										join student_class_division_assgn 
											on SCD_student_profile_id = fee_student_profile_id 
										join class 	
											on SCD_class_id = class_id 
										join division 
											on SCD_division_id = division_id 
										where 
											fee_AY_id=".$AY_id."  
											and fee_school_profile_id =".$school_id." 
											and DATE_FORMAT(fee_datetime,'%Y-%m-%d') between '".$start_date."'  and '".$end_date."' 
										order by 
											fee_datetime DESC
											,student_GRN ASC
									) as data,
									(
										SELECT @a:= 0
									) AS a")->result_array();

			$data['fee_amount'] = $this->db->query("		SELECT 
											SUM(fee_amount) AS fee_amount
										FROM 
										(
											SELECT 
												fee_id
												,fee_datetime
												,fee_student_profile_id
												,fee_amount
												,fee_payment_mode
												,fee_transaction_number
												,fee_AY_id
												,fee_narration
												,fee_school_profile_id 
											FROM fee 
											union all 
											select 	
												advance_id as  fee_id 
												,advance_datetime as fee_datetime
												,advance_student_profile_id as fee_student_profile_id
												,advance_amount as fee_amount
												,advance_payment_mode as fee_payment_mode 
												,advance_transaction_number as fee_transaction_number
												,advance_AY_id as fee_AY_id
												,advance_narration as fee_narration
												,advance_school_profile_id as fee_school_profile_id 
											FROM advance_payment
										) as fee 
										where 
											fee_AY_id=".$AY_id."  
											and fee_school_profile_id =".$school_id." 
											and DATE_FORMAT(fee_datetime,'%Y-%m-%d') between '".$start_date."'  and '".$end_date."'")->result_array();

		echo json_encode($data);		
	}
	
	function exam_report()
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
		$admin['AY_name'] = $school_admin[0]['AY_name'];
		$school['user_profile_id'] = $school_admin[0]['employee_profile_id'];
		$admin['functionality'] = $this->School_model->fetch_functionality($school);
		$employee_school_profile_id = $school_admin[0]['employee_school_profile_id'];
		$report['class'] =  $this->db->query("SELECT * FROM class where class_school_profile_id = ".$employee_school_profile_id." and class_expiry_date='9999-12-31' GROUP BY class_name")->result_array();
		$report['school_report_header'] = $school_admin[0]['school_report_header'];
		$report['school_report_footer'] = $school_admin[0]['school_report_footer'];
		$nav['school_name'] = $school_admin[0]['school_name'];
		$nav['school_logo'] = $school_admin[0]['school_logo'];
		$nav['report'] = 'exam_report';

		$this->load->view('School/school_header', $admin);
		$this->load->view('Reports/exam_report',$report);
		$this->load->view('Reports/exam_report_footer',$nav);
	}

}

 ?>