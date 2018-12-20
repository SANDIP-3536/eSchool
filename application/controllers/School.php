<?php
	defined('BASEPATH') OR exit('No direct script access allowed');
	
	class School extends CI_Controller
	{
		function index()
		{
			if(!isset($this->session->userdata['school']))
			{
				redirect('/');
			} 
			if(isset($this->session->userdata['direct'])){
				$school['direct'] = $this->session->userdata('direct');
			}
			else{
				$school['direct'] = 1;
			}
			$school_admin = $this->session->userdata('school');
			// print_r($school_admin);die();
			$school['user'] = $school_admin[0]['employee_pri_mobile_number'];
			$school['user_profile_id'] = $school_admin[0]['employee_profile_id'];
			$school['employee_type'] = $school_admin[0]['employee_type'];
			$school['photo'] = $school_admin[0]['employee_photo'];
			$employee_school_profile_id = $school_admin[0]['employee_school_profile_id'];
			$school_AY_id = $school_admin[0]['school_AY_id'];
			$school['first_name'] = $school_admin[0]['employee_first_name'];
			$school['last_name'] = $school_admin[0]['employee_last_name'];
			$school['email_id'] = $school_admin[0]['employee_email_id'];
			$school['username'] = $school_admin[0]['credential_username'];
			$school['AY_name'] = $school_admin[0]['AY_name'];
			$date = date('Y-m-d');
			$school['functionality'] = $this->School_model->fetch_functionality($school);
			$school['total_student'] = $this->db->where('student_school_profile_id',$employee_school_profile_id)->where('student_expiry_date','9999-12-31')->get('student')->num_rows();
			$school['total_teacher'] = $this->db->where('employee_school_profile_id',$employee_school_profile_id)->where('employee_expiry_date','9999-12-31')->where('employee_type','5')->get('employee')->num_rows();
			$school['total_employee'] = $this->db->query("SELECT * FROM `employee` where employee_expiry_date = '9999-12-31' and employee_school_profile_id =".$employee_school_profile_id." and employee_type not in(1,2,3)")->num_rows();
			$school['student_birthday'] = $this->db->query("SELECT * FROM student WHERE DATE_FORMAT(student_DOB, '%m-%d') = DATE_FORMAT('".$date."', '%m-%d') and student_school_profile_id=".$employee_school_profile_id."")->num_rows();
			$school['employee_birthday'] = $this->db->query("SELECT * FROM employee WHERE DATE_FORMAT(employee_DOB, '%m-%d') = DATE_FORMAT('".$date."', '%m-%d') and employee_school_profile_id=".$employee_school_profile_id." and employee_type not in(1,2,3)")->num_rows();
			$school['student_birthday_list'] = $this->db->query("SELECT concat(student_first_name,' ',student_middle_name,' ',student_last_name) as name, DATE_FORMAT(student_DOB, '%d-%m-%Y') as student_DOB,student_photo FROM student WHERE DATE_FORMAT(student_DOB, '%m-%d') = DATE_FORMAT('".$date."', '%m-%d') and student_school_profile_id=".$employee_school_profile_id."")->result_array();
			$school['employee_birthday_list'] = $this->db->query("SELECT * FROM employee WHERE DATE_FORMAT(employee_DOB, '%m-%d') = DATE_FORMAT('".$date."', '%m-%d') and employee_school_profile_id=".$employee_school_profile_id." and employee_type not in(1,2,3)")->result_array();
			$school['absent'] = "0";
			$school['present'] = "0";
			$attendance = $this->db->query("SELECT attend_status,count(*) as count FROM `attendance`where cast(attend_datetime as date)='".$date."' and attend_school_profile_id= ".$employee_school_profile_id." group by attend_status")->result_array();
			for ($i=0; $i <count($attendance) ; $i++) 
			{ 
				if ($attendance[$i]['attend_status'] == "A") 
				{
					$school['absent'] = $attendance[$i]['count'];				
				}
				if ($attendance[$i]['attend_status'] == "P") 
				{
					$school['present'] = $attendance[$i]['count'];				
				}		
			}

			$school['present_absent'] = $this->db->query("SELECT cd.class_id,cd.class_name,cd.division_id,cd.division_name,total,case when present.present_count is NULL then '0' else present.present_count end as present_count ,case when absent.absent_count is NULL then '0' else absent.absent_count end as absent_count from
											(SELECT class_id,class_name,division_id,division_name,count(*) as total FROM student_class_division_assgn  join class on class_id=SCD_class_id join division on division_id=SCD_division_id where SCD_school_profile_id=".$employee_school_profile_id." and SCD_Expiry_date='9999-12-31' group by class_id,division_id)as cd
											left join 
											(SELECT class_id,class_name,division_id,division_name,count(*) as present_count,' ' as absent_count FROM `attendance` join student_class_division_assgn on attend_SCD_id=SCD_id join class on class_id=SCD_class_id join division on division_id=SCD_division_id where cast(attend_datetime as date)='".$date."' and attend_school_profile_id=".$employee_school_profile_id." and attend_status='P' group by class_id,division_id,attend_status)as present
											on cd.class_id=present.class_id and cd.division_id=present.division_id
											left join
											(SELECT class_id,class_name,division_id,division_name,' ' as present_count,count(*) as absent_count FROM `attendance` join student_class_division_assgn on attend_SCD_id=SCD_id join class on class_id=SCD_class_id join division on division_id=SCD_division_id where cast(attend_datetime as date)='".$date."' and attend_school_profile_id=".$employee_school_profile_id." and attend_status='A' group by class_id,division_id,attend_status) as absent
											on cd.class_id=absent.class_id and cd.division_id=absent.division_id
											order by cd.class_id,cd.division_id")->result_array();

			// echo "<pre>"; print_r($school['present_absent']);die();
			$school['pending_sms'] = "0";
			$school['used_sms'] = "0";
			$sms = $this->db->query("select institute_sms_credit,count,(institute_sms_credit+count) as total from (select institute_sms_credit from institute where institute_profile_id=".$school_admin[0]['school_institute_profile_id'].") as data left join (select sum(sent_sms_count) as count from sent_sms where sent_sms_school_profile_id in (select school_profile_id from institute left join school on school_institute_profile_id=institute_profile_id where institute_profile_id=".$school_admin[0]['school_institute_profile_id'].")) as data2 on 1=1")->result_array();
			$school['pending_sms'] = $sms[0]['institute_sms_credit'];	
			$school['used_sms'] = $sms[0]['count'];	
			$school['total_sms'] = $sms[0]['total'];	
			$school['class_cnt'] = $this->db->query("
													SELECT 
														SCD_class_id
														,count(*) as std_count
														,class_name 
													from student_class_division_assgn 
													JOIN class 
														ON class_id = SCD_class_id 
													where 
														SCD_school_profile_id=".$employee_school_profile_id." 
														and SCD_expiry_date='9999-12-31' 
														and SCD_AY_id=".$school_AY_id." 
													group by 
														SCD_class_id"
													)->result_array();
			$school['fee_report'] = $this->db->query("
													SELECT 
														data1.class_name
														,received_amount as received
														,case 
															when fee_waiver_total is NULL then 0 
															else fee_waiver_total 
														end as fee_waiver_total
														,case 
															when fee_waiver_total is null then (total-received_amount) 
															else (total-received_amount-fee_waiver_total)  
														end as pending 
													from
													(
														SELECT 
															class_name
															,sum(total_fee_amount) as total
														FROM student_class_division_assgn 
														join total_fees 
															on SCD_student_profile_id=total_fee_student_profile_id
														join class
															on SCD_class_id=class_id
														WHERE 
															SCD_expiry_date='9999-12-31'
															and SCD_AY_id=".$school_AY_id."
															and SCD_school_profile_id=".$employee_school_profile_id."
														group by 
															class_name
													) as data1
													left join 
													(
														SELECT 
															class_name
															,sum(fee_waiver_amount) as fee_waiver_total
														FROM student_class_division_assgn 
														join fee_waiver 
															on SCD_student_profile_id=fee_waiver_student_profile_id
														join class
															on SCD_class_id=class_id
														WHERE 
															SCD_expiry_date='9999-12-31'
															and SCD_AY_id=".$school_AY_id."
															and SCD_school_profile_id=".$employee_school_profile_id."
														group by 
															class_name
													) as data3
														on data3.class_name=data1.class_name
													left join 
													(
														select 
															class_name
															,case 
																when received is NULL and advance_payment is null then 0 
																when received is NULL then advance_payment
																when  advance_payment is NULL then received
																else (received + advance_payment)
															end as received_amount
														from 
														(	SELECT 
																class_name
																,sum(fee_amount) as received
																,sum(student_total_advance_payment) as advance_payment
															FROM student_class_division_assgn 
															left join  fee
																on SCD_student_profile_id=fee_student_profile_id
															join class
																on SCD_class_id=class_id
															join  student
																on SCD_student_profile_id=student_profile_id
															WHERE 
																SCD_expiry_date='9999-12-31'
																and SCD_AY_id=".$school_AY_id."
																and SCD_school_profile_id=".$employee_school_profile_id."
															group by 
																class_name

														) as inner_data2
													)as data2 
														on data1.class_name=data2.class_name
													")->result_array();
			$school['today_fee_collection_sum'] = $this->db->query("SELECT SUM(fee_amount) as total FROM `fee` WHERE fee_school_profile_id = ".$employee_school_profile_id." AND fee_AY_id = ".$school_AY_id." AND CAST(fee_datetime AS DATE) = '".$date."'")->row()->total;
			$school['today_fee_collection'] = $this->db->query("SELECT student_GRN,student_first_name,student_middle_name,student_last_name,fee_amount,fee_payment_mode,fee_narration FROM `fee` JOIN student ON student_profile_id = fee_student_profile_id WHERE fee_school_profile_id = ".$employee_school_profile_id." AND fee_AY_id = ".$school_AY_id." AND CAST(fee_datetime AS DATE) = '".$date."'")->result_array();
			// echo "<pre>"; print_r($school['today_fee_collection']);die();
			$school['remainder'] = $this->db->query("SELECT * FROM `remainder` WHERE remainder_AY_id = ".$school_AY_id." AND remainder_school_profile_id = ".$employee_school_profile_id." AND remainder_status ='1' AND remainder_date <= '".$date."' ORDER BY remainder_date DESC")->result_array();
			$school['flash']['active'] = $this->session->flashdata('active');
	    	$school['flash']['title'] = $this->session->flashdata('title');
	    	$school['flash']['text'] = $this->session->flashdata('text');
	    	$school['flash']['type'] = $this->session->flashdata('type');
	    	$school['school_name'] = $school_admin[0]['school_name'];
			$school['school_logo'] = $school_admin[0]['school_logo'];

	    	$school['dashboard'] = 'dashboard';
	    	$school['events'] = $this->db->where('holiday_school_profile_id',$employee_school_profile_id)->where('holiday_AY_id',$school_AY_id)->get('holiday')->result_array();

	    	$school['student_fee_remainder'] = $this->db->query("SELECT 
														* 
													from
													(
														select 
															CONCAT(Student_first_name,' ',Student_middle_name,' ',student_last_name) as student_name
															,parent_mobile_number 
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
													where balance > 0 ")->result_array();

	    	// echo "<pre>";print_r($school['remainder']);die();
			$this->load->view('School/school_header', $school);
			$this->load->view('School/school_dashboard',$school);
		}
		function refresh_remainder_table()
		{
			$school_admin = $this->session->userdata('school');
			$school_AY_id = $school_admin[0]['school_AY_id'];
			$employee_school_profile_id = $school_admin[0]['employee_school_profile_id'];
			$date = date('Y-m-d');

			$remainder = $this->db->query("SELECT * FROM `remainder` WHERE remainder_AY_id = ".$school_AY_id." AND remainder_school_profile_id = ".$employee_school_profile_id." AND remainder_status ='1' AND remainder_date <= '".$date."' ORDER BY remainder_date DESC")->result_array();

			echo json_encode($remainder);
		}
		function add_remainder()
		{
			$school_admin = $this->session->userdata('school');

			$data['remainder_school_profile_id'] = $school_admin[0]['employee_school_profile_id'];
			$data['remainder_AY_id'] = $school_admin[0]['school_AY_id'];
			$data['remainder_type'] = $_POST['remainder_type'];
			$data['remainder_date'] = $_POST['remainder_date'];
			$data['remainder_time'] = $_POST['remainder_time'];
			$data['remainder_title'] = $_POST['remainder_title'];
			$data['remainder_message'] = $_POST['remainder_message'];

			$this->db->insert('remainder',$data);

			echo json_encode($data);
		}
		function other_remainder_done()
		{
			$remainder_id = $_POST['remainder_id'];
			$this->db->query('UPDATE remainder set remainder_status = "0" where remainder_id= "'.$remainder_id.'" ');
			echo json_encode($remainder_id);
		}
		function reshedule_fee_remainder()
		{
			$remainder_id = $_POST['remainder_id'];
			$data['remainder_id'] = $remainder_id;
			$data['remainder_status'] = "0";
			$data['remainder_remark'] = "Resheduled";
			$this->db->set($data)->where('remainder_id',$data['remainder_id'])->update("remainder", $data);

			$data = $this->db->query("SELECT * FROM remainder where remainder_id= ".$remainder_id." ")->result_array();
			$new_msg = str_replace($data[0]['remainder_date'],$_POST['new_date'],$data[0]['remainder_message']);
			$re['remainder_type'] = $data[0]['remainder_type'];
			$re['remainder_date'] = $_POST['new_date'];
			$re['remainder_time'] = $data[0]['remainder_time'];
			$re['remainder_title'] = $data[0]['remainder_title'];
			$re['remainder_message'] = $new_msg;
			$re['remainder_AY_id'] = $data[0]['remainder_AY_id'];
			$re['remainder_school_profile_id'] = $data[0]['remainder_school_profile_id'];

			$this->db->insert('remainder',$re);
			// $pr['new_msg'] = $new_msg;
			// $pr['remainder_date'] = $data[0]['remainder_date'];
			// $pr['new_date'] = $_POST['new_date'];
			echo json_encode($remainder_id);
		}
		function remark_meeting_remainder()
		{
			$remainder_id = $_POST['remainder_id'];
			
			$data['remainder_id'] = $remainder_id;
			$data['remainder_status'] = "0";
			$data['remainder_remark'] = $_POST['remark'];
			$this->db->set($data)->where('remainder_id',$data['remainder_id'])->update("remainder", $data);

			echo json_encode($remainder_id);
		}
		
		function today_fee_collection()
		{
			$school_admin = $this->session->userdata('school');
			$employee_school_profile_id = $school_admin[0]['employee_school_profile_id'];
			$school_AY_id = $school_admin[0]['school_AY_id'];
			$date = $_POST['select_date'];

			$school['today_fee_collection_sum'] = $this->db->query("SELECT SUM(fee_amount) as total FROM `fee` WHERE fee_school_profile_id = ".$employee_school_profile_id." AND fee_AY_id = ".$school_AY_id." AND CAST(fee_datetime AS DATE) = '".$date."'")->row()->total;
			$school['today_fee_collection'] = $this->db->query("SELECT student_GRN,student_first_name,student_middle_name,student_last_name,fee_amount,fee_payment_mode,fee_narration FROM `fee` JOIN student ON student_profile_id = fee_student_profile_id WHERE fee_school_profile_id = ".$employee_school_profile_id." AND fee_AY_id = ".$school_AY_id." AND CAST(fee_datetime AS DATE) = '".$date."'")->result_array();
			// echo "<pre>"; print_r($school['today_fee_collection']);die();	
			echo json_encode($school);
		}
		function view_stu_attendance()
		{
			$school_admin = $this->session->userdata('school');
			$employee_school_profile_id = $school_admin[0]['employee_school_profile_id'];
			$date = $_POST['select_date'];
			$school['absent'] = "0";
			$school['present'] = "0";
			$attendance = $this->db->query("SELECT attend_status,count(*) as count FROM `attendance`where cast(attend_datetime as date)='".$date."' and attend_school_profile_id= ".$employee_school_profile_id." group by attend_status")->result_array();
			for ($i=0; $i <count($attendance) ; $i++) 
			{ 
				if ($attendance[$i]['attend_status'] == "A") 
				{
					$school['absent'] = $attendance[$i]['count'];				
				}
				if ($attendance[$i]['attend_status'] == "P") 
				{
					$school['present'] = $attendance[$i]['count'];				
				}		
			}

			$school['present_absent'] = $this->db->query("SELECT cd.class_id,cd.class_name,cd.division_id,cd.division_name,total,case when present.present_count is NULL then '0' else present.present_count end as present_count ,case when absent.absent_count is NULL then '0' else absent.absent_count end as absent_count from
											(SELECT class_id,class_name,division_id,division_name,count(*) as total FROM student_class_division_assgn  join class on class_id=SCD_class_id join division on division_id=SCD_division_id where SCD_school_profile_id=".$employee_school_profile_id." and SCD_Expiry_date='9999-12-31' group by class_id,division_id)as cd
											left join 
											(SELECT class_id,class_name,division_id,division_name,count(*) as present_count,' ' as absent_count FROM `attendance` join student_class_division_assgn on attend_SCD_id=SCD_id join class on class_id=SCD_class_id join division on division_id=SCD_division_id where cast(attend_datetime as date)='".$date."' and attend_school_profile_id=".$employee_school_profile_id." and attend_status='P' and SCD_Expiry_date='9999-12-31' group by class_id,division_id,attend_status)as present
											on cd.class_id=present.class_id and cd.division_id=present.division_id
											left join
											(SELECT class_id,class_name,division_id,division_name,' ' as present_count,count(*) as absent_count FROM `attendance` join student_class_division_assgn on attend_SCD_id=SCD_id join class on class_id=SCD_class_id join division on division_id=SCD_division_id where cast(attend_datetime as date)='".$date."' and attend_school_profile_id=".$employee_school_profile_id." and attend_status='A'and SCD_Expiry_date='9999-12-31'  group by class_id,division_id,attend_status) as absent
											on cd.class_id=absent.class_id and cd.division_id=absent.division_id
											order by cd.class_id,cd.division_id")->result_array();
			echo json_encode($school);
		}

		function school_registration()
		{
			if(!isset($this->session->userdata['Institute']))
			{
				redirect('/');
			} 

			$institute_admin = $this->session->userdata('Institute');
			$admin['user'] = $institute_admin[0]['employee_pri_mobile_number'];
			$admin['photo'] = $institute_admin[0]['employee_photo'];
			$admin['first_name'] = $institute_admin[0]['employee_first_name'];
			$admin['last_name'] = $institute_admin[0]['employee_last_name'];
			$admin['email_id'] = $institute_admin[0]['employee_email_id'];
			$admin['username'] = $institute_admin[0]['credential_username'];
			$nav['institute_name'] = $institute_admin[0]['institute_name'];
			$nav['institute_logo'] = $institute_admin[0]['institute_logo'];
			$school_institute_profile_id = $institute_admin[0]['employee_school_profile_id'];
			$school_details['acadmic_year'] = $this->db->query("SELECT * FROM `academic_year` where AY_institute_profile_id =".$school_institute_profile_id." and AY_expiry_date = '9999-12-31' group by AY_name")->result_array();
			$school_details['school_sms'] = $institute_admin[0]['institute_school_sms'];
			$nav['insti_admin'] = "school";
			$nav['key'] = "AIzaSyCFITe1W91pItJO46rwqOPjw_U10-5WR3E";
			$this->load->view('Institute/institute_header', $admin);
			$this->load->view('School/school_registration',$school_details);
			$this->load->view('School/school_footer',$nav);
		}

		function view_school()
		{	

			if(!isset($this->session->userdata['Institute']))
			{
				redirect('/');
			} 
			$institute_admin = $this->session->userdata('Institute');
			$admin['user'] = $institute_admin[0]['employee_pri_mobile_number'];
			$admin['photo'] = $institute_admin[0]['employee_photo'];
			$school_institute_profile_id = $institute_admin[0]['employee_school_profile_id'];
			$admin['first_name'] = $institute_admin[0]['employee_first_name'];
			$admin['last_name'] = $institute_admin[0]['employee_last_name'];
			$admin['email_id'] = $institute_admin[0]['employee_email_id'];
			$admin['username'] = $institute_admin[0]['credential_username'];

			$school_details['flash']['active'] = $this->session->flashdata('active');
	    	$school_details['flash']['title'] = $this->session->flashdata('title');
	    	$school_details['flash']['text'] = $this->session->flashdata('text');
	    	$school_details['flash']['type'] = $this->session->flashdata('type');
			
			$school_details['school'] = $this->School_model->fetch_school($school_institute_profile_id);
			$school_details['all_school'] = $this->db->query("SELECT * from school where school_institute_profile_id=".$school_institute_profile_id."")->result_array();
			$school_details['all_employee'] = $this->db->query("SELECT employee.* FROM `employee` join school on employee_school_profile_id = school_profile_id join institute on school_institute_profile_id = institute_profile_id where employee_school_profile_id =".$school_institute_profile_id." and employee_type IN(3,4)")->result_array();
			$nav['institute_name'] = $institute_admin[0]['institute_name'];
			$nav['institute_logo'] = $institute_admin[0]['institute_logo'];
			$nav['insti_admin'] = "school";

			$this->load->view('Institute/institute_header',$admin);
			$this->load->view('School/view_school',$school_details);
			$this->load->view('School/school_footer',$nav);
		}

		function add_school_registration()
		{
			$institute_admin = $this->session->userdata('Institute');
			$school_registration['school_name'] = $this->input->post('school_name');
			$school_registration['school_address'] = $this->input->post('school_address');
			$school_registration['school_latitude'] = $this->input->post('school_latitude');
			$school_registration['school_longitude'] = $this->input->post('school_longitude');
			$school_registration['school_mobile_number'] = $this->input->post('school_mobile_number');
			$school_registration['school_phone_number'] = $this->input->post('school_phone_number');
			$school_registration['school_email_id'] = $this->input->post('school_email_id');
			$school_registration['school_AY_id'] = $this->input->post('school_AY_id');
			$school_registration['school_website'] = $this->input->post('school_website');
			$absent = $this->input->post('school_student_absent_sms');
			if($absent == 'on'){
				$school_registration['school_student_absent_sms'] = "1";
			}else{
				$school_registration['school_student_absent_sms'] = "0";
			}
			$birth = $this->input->post('school_student_birth_sms');
			if($birth == 'on'){
				$school_registration['school_student_birth_sms'] = "1";
			}else{
				$school_registration['school_student_birth_sms'] = "0";
			}
			$salary = $this->input->post('school_employee_salary_sms');
			if($salary == 'on'){
				$school_registration['school_employee_salary_sms'] = "1";
			}else{
				$school_registration['school_employee_salary_sms'] = "0";
			}
			$fee_remainder = $this->input->post('school_student_fee_remainder_sms');
			if($fee_remainder == 'on'){
				$school_registration['school_student_fee_remainder_sms'] = "1";
			}else{
				$school_registration['school_student_fee_remainder_sms'] = "0";
			}
			$authentiction_details = $this->input->post('school_authentication_details_sms');
			if($authentiction_details == 'on'){
				$school_registration['school_authentication_details_sms'] = "1";
			}else{
				$school_registration['school_authentication_details_sms'] = "0";
			}
			$parent = $this->input->post('school_parent_birth_sms');
			if($parent == 'on'){
				$school_registration['school_parent_birth_sms'] = "1";
			}else{
				$school_registration['school_parent_birth_sms'] = "0";
			}
			$employee_birthday = $this->input->post('school_employee_birth_sms');
			if($employee_birthday == 'on'){
				$school_registration['school_employee_birth_sms'] = "1";
			}else{
				$school_registration['school_employee_birth_sms'] = "0";
			}
			$homework = $this->input->post('school_homework_sms');
			if($homework == 'on'){
				$school_registration['school_homework_sms'] = "1";
			}else{
				$school_registration['school_homework_sms'] = "0";
			}
			$parentmeet = $this->input->post('school_parentmeet_sms');
			if($parentmeet == 'on'){
				$school_registration['school_parentmeet_sms'] = "1";
			}else{
				$school_registration['school_parentmeet_sms'] = "0";
			}
			$newsfeed = $this->input->post('school_newsfeed_sms');
			if($newsfeed == 'on'){
				$school_registration['school_newsfeed_sms'] = "1";
			}else{
				$school_registration['school_newsfeed_sms'] = "0";
			}
			$circular = $this->input->post('school_circular_sms');
			if($circular == 'on'){
				$school_registration['school_circular_sms'] = "1";
			}else{
				$school_registration['school_circular_sms'] = "0";
			}
			$event = $this->input->post('school_event_sms');
			if($event == 'on'){
				$school_registration['school_event_sms'] = "1";
			}else{
				$school_registration['school_event_sms'] = "0";
			}
			$holiday = $this->input->post('school_holiday_sms');
			if($holiday == 'on'){
				$school_registration['school_holiday_sms'] = "1";
			}else{
				$school_registration['school_holiday_sms'] = "0";
			}
			$school_registration['school_effective_date'] = date('Y-m-d');
			$school_registration['school_update_date'] = date('Y-m-d');
			$verify = $this->db->query("select * from school where school_name = '".$school_registration['school_name']."' and school_phone_number = ".$school_registration['school_phone_number']." or school_email_id ='".$school_registration['school_email_id']."' and school_expiry_date = '9999-12-31'")->num_rows();
			if ($verify != 0) {
				$this->session->set_flashdata('active',1);
	            $this->session->set_flashdata('title',"School Already Registered.");
	            $this->session->set_flashdata('text',""); 
	            $this->session->set_flashdata('type',"warning");
				redirect('School/view_school');
			}else{
				$school_registration['school_institute_profile_id'] = $institute_admin[0]['employee_school_profile_id'];
				if($school_profile_id == 0){
					$this->session->set_flashdata('active',1);
		            $this->session->set_flashdata('title',"School Added Successfully.");
		            $this->session->set_flashdata('text',""); 
		            $this->session->set_flashdata('type',"success");
					redirect('School/view_school');
				}
				else{
					$this->session->set_flashdata('active',1);
		            $this->session->set_flashdata('title',"Error...");
		            $this->session->set_flashdata('text',"Not Added...");
		            $this->session->set_flashdata('type',"warning");
					redirect('School/view_school');
		        }
		    }
		}

		function school_user_details($school_profile_id)
		{
			$this->session->set_userdata('school_data', $school_profile_id);
			redirect('School/school_user_detailss');
		}


		function school_user_detailss()
		{
			if(!isset($this->session->userdata['Institute']))
			{
				redirect('/');
			} 
			$school_details['flash']['active'] = $this->session->flashdata('active');
	    	$school_details['flash']['title'] = $this->session->flashdata('title');
	    	$school_details['flash']['text'] = $this->session->flashdata('text');
	    	$school_details['flash']['type'] = $this->session->flashdata('type');

			$institute_admin = $this->session->userdata('Institute');

			$admin['user'] = $institute_admin[0]['employee_pri_mobile_number'];
			$admin['photo'] = $institute_admin[0]['employee_photo'];
			$admin['institute_profile_id'] = $institute_admin[0]['employee_profile_id'];
			$admin['first_name'] = $institute_admin[0]['employee_first_name'];
			$admin['last_name'] = $institute_admin[0]['employee_last_name'];
			$admin['email_id'] = $institute_admin[0]['employee_email_id'];
			$admin['username'] = $institute_admin[0]['credential_username'];
			$school_profile_id = $this->session->userdata('school_data');
			
			$nav['institute_name'] = $institute_admin[0]['institute_name'];
			$nav['institute_logo'] = $institute_admin[0]['institute_logo'];
			$school_details['school'] = $this->School_model->school_details($school_profile_id);
			$school_details['school_user'] = $this->School_model->user_details($school_profile_id);
			$school_details['admin_count'] = count($school_details['school_user']);
			$school_details['school_principle'] = $this->School_model->principle_details($school_profile_id);
			$school_details['principle_count'] = count($school_details['school_principle']);
			$nav['insti_admin'] = "school";
			$this->load->view('Institute/institute_header', $admin);
			$this->load->view('School/school_user_details', $school_details);
			$this->load->view('School/school_footer',$nav);
		}

		function update_school_details($school_profile_id)
		{
			$this->session->set_userdata('school_data1', $school_profile_id);
			redirect('School/update_school');
		}

		function update_school()
		{
			$institute_admin = $this->session->userdata('Institute');

			$admin['photo'] = $institute_admin[0]['employee_photo'];
			$admin['institute_profile_id'] = $institute_admin[0]['employee_profile_id'];
			$admin['first_name'] = $institute_admin[0]['employee_first_name'];
			$admin['last_name'] = $institute_admin[0]['employee_last_name'];
			$admin['email_id'] = $institute_admin[0]['employee_email_id'];
			$admin['username'] = $institute_admin[0]['credential_username'];
			$school_institute_profile_id = $institute_admin[0]['employee_school_profile_id'];
			$id = $this->session->userdata('school_data1');
			$data['schooll'] = $this->School_model->fetch_school_id($id);
			$data['acadmic_year'] = $this->db->query("SELECT * FROM `academic_year` where AY_id NOT IN(select school_AY_id from school where school_profile_id = ".$school_institute_profile_id.") and AY_expiry_date ='9999-12-31' group by AY_name")->result_array();
			$nav['institute_name'] = $institute_admin[0]['institute_name'];
			$nav['institute_logo'] = $institute_admin[0]['institute_logo'];
			$nav['insti_admin'] = "school";
			$this->load->view('Institute/institute_header',$admin);
			$this->load->view('School/update_school_details', $data);
			$this->load->view('School/school_footer',$nav);
		}

		function school_deactive($school_profile_id)
		{
			$this->session->set_userdata('school_deactive',$school_profile_id);
			redirect('School/school_disable');
		}

		function school_disable(){
			$data['school_profile_id'] = $this->session->userdata('school_deactive');
			$data['school_expiry_date'] = date('Y-m-d');
			$con = $this->School_model->school_disable($data);
			if($con == 0){
				$this->session->set_flashdata('active',1);
	            $this->session->set_flashdata('title',"School Deactivated.");
	            $this->session->set_flashdata('text',""); 
	            $this->session->set_flashdata('type',"success");	
				redirect('School/school_user_detailss');
			}
			else{
				$this->session->set_flashdata('active',1);
	            $this->session->set_flashdata('title',"Error...");
	            $this->session->set_flashdata('text',"Not Added...");
	            $this->session->set_flashdata('type',"warning");	
				redirect('School/school_user_detailss');
			}
		}

		function school_active($school_profile_id)
		{
			$this->session->set_userdata('school_active',$school_profile_id);
			redirect('School/school_enable');
		}

		function school_enable(){
			$data['school_profile_id'] = $this->session->userdata('school_active');
			$data['school_expiry_date'] = '9999-12-31';
			$con = $this->School_model->school_enable($data);
			if($con == 0){
				$this->session->set_flashdata('active',1);
	            $this->session->set_flashdata('title',"School Activated.");
	            $this->session->set_flashdata('text',""); 
	            $this->session->set_flashdata('type',"success");	
				redirect('School/school_user_detailss');
			}
			else{
				$this->session->set_flashdata('active',1);
	            $this->session->set_flashdata('title',"Error...");
	            $this->session->set_flashdata('text',"Not Added...");
	            $this->session->set_flashdata('type',"warning");	
				redirect('School/school_user_detailss');
			}
		}
		
		function add_school_user()
		{
			$institute_admin = $this->session->userdata('Institute');
			$admin['school_name'] = $this->input->post('school_name');
			$num['profile'] =$this->input->post('school_profile_id');
			$num['mobile'] =$this->input->post('employee_pri_mobile_number');
			$mobile = $this->School_model->already_exits_mobile($num);
			$email['profile'] =$this->input->post('school_profile_id');
			$email['mail'] =  $this->input->post('employee_email_id');
			$email_id = $this->School_model->already_exits_email($email);

			if ($mobile != 0) {

				$this->session->set_flashdata('active',1);
		        $this->session->set_flashdata('title',"Mobile No Already Registered.");
		        $this->session->set_flashdata('text',"Please Fill again with another Mobile Number");
		        $this->session->set_flashdata('type',"warning");
				redirect('School/school_user_detailss');
			}
			elseif($email_id != 0){

				$this->session->set_flashdata('active',1);
		        $this->session->set_flashdata('title',"Email ID Already Registered.");
		        $this->session->set_flashdata('text',"Please Fill again with another Email ID."); 
		        $this->session->set_flashdata('type',"warning");
				redirect('School/school_user_detailss');
			}
			else{

				$school_employee['employee_type'] = $this->input->post('employee_type');
				$school_employee['employee_photo'] = $this->upload('employee_photo', 'profile_photo');
				$school_employee['employee_first_name'] = $this->input->post('employee_first_name');
				$school_employee['employee_middle_name'] = $this->input->post('employee_middle_name');
				$school_employee['employee_last_name'] = $this->input->post('employee_last_name');
				$school_employee['employee_address'] = $this->input->post('employee_address');
				$school_employee['employee_DOB'] = $this->input->post('employee_DOB');
				$school_employee['employee_gender'] = $this->input->post('employee_gender');
				$school_employee['employee_higher_education'] = $this->input->post('employee_higher_education');
				$school_employee['employee_experiance'] = $this->input->post('employee_experiance');
				$school_employee['employee_pri_mobile_number'] = $this->input->post('employee_pri_mobile_number');
				$school_employee['employee_email_id'] = $this->input->post('employee_email_id');
				$school_employee['employee_effective_date'] = date('Y-m-d');
				$school_employee['employee_school_profile_id'] = $this->input->post('school_profile_id');
				$school_details['school_name'] = $this->input->post('school_name');

				// school credential Details
				$school_credential['credential_user_type'] = $this->input->post('employee_type');
				$school_credential['credential_update_date'] = date('Y-m-d');

				$count = $this->db->get('employee')->num_rows();

				$cnt = $count+1;
				$user_type = 3;
				$admin_id = $this->input->post('school_profile_id');
				$mobile = $this->input->post('employee_pri_mobile_number');
				$mobile1 = $mobile[5];
				$mobile2 = $mobile[6];
				$mobile3 = $mobile[7];
				$mobile4 = $mobile[8];
				$mobile5 = $mobile[9];
				$username = array($user_type,$admin_id,$cnt,$mobile1,$mobile2,$mobile3,$mobile4,$mobile5);
				$school_credential['credential_username'] = implode($username);
				$signature = $this->db->query('select institute_sender_id,institute_signature from institute where institute_profile_id=(select school_institute_profile_id from school where school_profile_id='.$institute_admin[0]['employee_school_profile_id'].')')->result_array();

				$pas = str_split($this->input->post('employee_first_name'));
				$pass = $pas[0];
				$pass1 = $pas[1];
				$pas1 = str_split($this->input->post('employee_last_name'));
				$pas12 = $pas1[0];
				$pas13 = $pas1[1];
				$pas2 = str_split($this->input->post('employee_pri_mobile_number'));
				$pas21 = $pas2['0'];
				$pas22 = $pas2['1'];
				$pas23 = $pas2['2'];
				$pas24 = $pas2['3'];
				$pas25 = $pas2['4'];
				$pas26 = $pas2['5'];
				$arr1 = array($pas12,$pas24,$pas13,$pass1,$pas23,$pas21,$pas25,$pas26,$pas22,$pass);
				$school_credential1['credential_password1'] = implode($arr1);
				$school_credential['credential_password'] = md5(implode($arr1)); 

				$message = "Hi,\nYour profile has been created with eSchool.\nYour Credential are as follows:\nUsername :".$school_credential['credential_username']."\nPassword :".$school_credential1['credential_password1']."\nRegards,\n".$signature[0]['institute_signature'].".";
				$number = $school_employee['employee_pri_mobile_number'];
			

				$config['protocol'] = $this->config->item('protocol');
				$config['smtp_host'] = $this->config->item('smtp_host');
				$config['smtp_port'] = $this->config->item('smtp_port');
				$config['smtp_timeout'] = $this->config->item('smtp_timeout');
				$config['smtp_user'] = $this->config->item('smtp_user');
				$config['smtp_pass'] = $this->config->item('smtp_pass');
				$config['charset'] = $this->config->item('charset');
				$config['newline'] = $this->config->item('newline');
				$config['mailtype'] = $this->config->item('mailtype');
				$config['validation'] = $this->config->item('validation');

				$this->email->initialize($config);
				$this->email->from('no-reply@trackmee.syntech.co.in',''.$school_details['school_name'].'');			// $this->email->from($email,$name);
				$this->email->to(''.$school_employee['employee_email_id'].'');
				$this->email->subject('Welcome To '.$school_details['school_name'].' Authencation Details');
				$this->email->message("Hi,<br>Your profile has been created with ".$school_details['school_name'].". Your credentials are as follows:<br>  <p> Username: ".$school_credential['credential_username']."<br> <p>  Password: ".$school_credential1['credential_password1']."<br><br>   Regards,<br>".$signature[0]['institute_signature'].".");

				if($this->email->send()){
					$check = $this->Enquiry_model->check_sms_active($num['profile']);
					if($check[0]['institute_school_sms'] == 1 && $check[0]['school_authentication_details_sms'] == 1 && $check[0]['institute_sms_credit'] > 0)
					{
						$sms_status = $this->Enquiry_model->sms($number,$message,$signature[0]['institute_sender_id']);
						$res_explode = explode(':', $sms_status);
			
						$this->Enquiry_model->set_count($check[0]['school_institute_profile_id']);
						$sent['sent_sms_type'] = 2;
						$sent['sent_sms_sub_type'] = 7;
						$sent['sent_sms_mobile_number'] = $school_employee['employee_pri_mobile_number'];
						$sent['sent_sms_language'] = 1;
						$sent['sent_sms_MsgID'] = $res_explode[1];
						$sent['sent_sms_status'] =  $res_explode[4];
						$sent['sent_sms_count'] = 1;
						$sent['sent_sms_MSG'] = $message ;
						$sent['sent_sms_school_profile_id'] = $num['profile'];
						$this->Enquiry_model->add_sent_sms($sent);
					}

		            $employee_profile_id = $this->School_model->add_school_user($school_employee);

					$school_credential['credential_profile_id'] = $employee_profile_id[0]['employee_profile_id'];
					$this->School_model->school_user_credential($school_credential);
					$this->session->set_flashdata('active',1);
		            $this->session->set_flashdata('title',"Credential send on your register Email and mobile Number.");
		            $this->session->set_flashdata('text',"Successfully Sending Authentication Details.");
		            $this->session->set_flashdata('type',"success");
					redirect('School/school_user_detailss');
				}
				else{
					$this->session->set_flashdata('active',1);
		            $this->session->set_flashdata('title',"SMS Not Send");
		            $this->session->set_flashdata('text',"In Sending Authentication Details..Please Try ahain");
		            $this->session->set_flashdata('type',"warning");
					redirect('School/school_user_detailss');	
				}
			}
		}

		function update_school_user($employee_profile_id)
		{
			$this->session->set_userdata('employee_profile_id', $employee_profile_id);
			redirect('School/update_user');
		}

		function update_user()	
		{
			$update_school_user['flash']['active'] = $this->session->flashdata('active');
	    	$update_school_user['flash']['title'] = $this->session->flashdata('title');
	    	$update_school_user['flash']['text'] = $this->session->flashdata('text');
	    	$update_school_user['flash']['type'] = $this->session->flashdata('type');

			$employee_profile_id = $this->session->userdata('employee_profile_id');
			$institute_admin = $this->session->userdata('Institute');
			$admin['user'] = $institute_admin['employee_pri_mobile_number'];
			$admin['photo'] = $institute_admin['employee_photo'];
			$admin['first_name'] = $institute_admin[0]['employee_first_name'];
			$admin['last_name'] = $institute_admin[0]['employee_last_name'];
			$admin['email_id'] = $institute_admin[0]['employee_email_id'];
			$admin['username'] = $institute_admin[0]['credential_username'];
			$update_school_user['school_user'] = $this->School_model->user_fetch($employee_profile_id);
			$nav['institute_name'] = $institute_admin[0]['institute_name'];
			$nav['institute_logo'] = $institute_admin[0]['institute_logo'];
			$nav['insti_admin'] = "school";
			$this->load->view('Institute/institute_header',$admin);
			$this->load->view('School/update_school_user', $update_school_user);
			$this->load->view('School/school_footer',$nav);
		}

		function disable_school_user($employee_profile_id)
		{
			$this->session->set_userdata('user_disable', $employee_profile_id);
			redirect('School/disable_user_school');			
		}

		function disable_user_school()
		{
			$disable_employee['employee_profile_id'] = $this->session->userdata('user_disable');
			$disable_employee['employee_expiry_date'] = date('Y-m-d');
			$con = $this->School_model->school_user_disable($disable_employee);
			if($con == 0){
				$this->session->set_flashdata('active',1);
	            $this->session->set_flashdata('title',"User Deactivated.");
	            $this->session->set_flashdata('text',"Institute User Deactivated"); 
	            $this->session->set_flashdata('type',"success");	
				redirect('School/school_user_detailss');
			}
			else{
				$this->session->set_flashdata('active',1);
	            $this->session->set_flashdata('title',"Error...");
	            $this->session->set_flashdata('text',"Not Added...");
	            $this->session->set_flashdata('type',"warning");	
				redirect('School/school_user_detailss');
			}
		}

		function enable_school_user($employee_profile_id)
		{
			$this->session->set_userdata('user_enable', $employee_profile_id);
			redirect('School/enable_user_school');			
		}

		function enable_user_school()
		{
			$enable_employee['employee_profile_id'] = $this->session->userdata('user_enable');
			$enable_employee['employee_expiry_date'] = '9999-12-31';
			$con = $this->School_model->school_user_enable($enable_employee);
			if($con == 0){
				$this->session->set_flashdata('active',1);
	            $this->session->set_flashdata('title',"User Activated.");
	            $this->session->set_flashdata('text',"Institute User Activated"); 
	            $this->session->set_flashdata('type',"success");	
				redirect('School/school_user_detailss');
			}
			else{
				$this->session->set_flashdata('active',1);
	            $this->session->set_flashdata('title',"Error...");
	            $this->session->set_flashdata('text',"Not Added...");
	            $this->session->set_flashdata('type',"warning");	
				redirect('School/school_user_detailss');
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
				$user_photo = base_url().'profile_photo/default_employee_image.png';
				return $user_photo;
			}
			else{
				$upload_files = array('upload_data' => $this->upload->data());

				$school_photo = base_url().'profile_photo/'.$upload_files['upload_data']['file_name'];
				$this->upload->data();

				return $school_photo;
			}
		}

		function upload_certificates($file,$folder)						
		{
			$config = array(
				'upload_path' => 'document/certificates/',
				'upload_url' => base_url().'document/certificates/',
				'allowed_types' => 'jpg|jpeg|gif|png',
				'encrypt_name' => TRUE,
				);
			$this->upload->initialize($config);
			if($this->upload->do_upload($file)){
				$upload_files = array('upload_data' => $this->upload->data());

				$school_photo = base_url().'document/certificates/'.$upload_files['upload_data']['file_name'];
				$this->upload->data();

				return $school_photo;
			}
		}


		function school_user()
		{
			$data2 = $this->session->userdata('institute');

			$data1['user'] = $data2['credential_username'];
			$data1['photo'] = $data2['user_photo'];
			$data1['institute_profile_id'] = $data2['user_profile_id'];
			$data['school'] = $this->session->userdata('school_session');	
			$nav['institute_name'] = $institute_admin[0]['institute_name'];
			$nav['institute_logo'] = $institute_admin[0]['institute_logo'];
			$nav['insti_admin'] = "school";
			$this->load->view('Institute/institute_header', $data1);
			$this->load->view('School/school_user', $data);
			$this->load->view('School/school_footer',$nav);
		}

		function update_user_details()
		{
			$data['user_profile_id'] = $this->input->post('user_profile_id');
			$data['user_first_name'] = $this->input->post('user_first_name');
			$data['user_middle_name'] = $this->input->post('user_middle_name');
			$data['user_last_name'] = $this->input->post('user_last_name');
			$data['user_mobile_number'] = $this->input->post('user_mobile_number');
			$data['user_email_id'] = $this->input->post('user_email_id');
			$data['user_update_date'] = date('Y-m-d');
			$con = $this->School_model->update_user_details($data);
			if($con == 0){
				$this->session->set_flashdata('active',1);
	            $this->session->set_flashdata('title',"Details Updated");
	            $this->session->set_flashdata('text',""); 
	            $this->session->set_flashdata('type',"success");
				redirect('School');
			}
			else{
				$this->session->set_flashdata('active',1);
	            $this->session->set_flashdata('title',"Error...");
	            $this->session->set_flashdata('text',"Not Added...");
	            $this->session->set_flashdata('type',"warning");
				redirect('School');
			}
		}	

		function update_details_school()
		{
			$school_update = $this->input->post();
			$absent = $this->input->post('school_student_absent_sms');
			if($absent == 'on'){
				$school_update['school_student_absent_sms'] = "1";
			}else{
				$school_update['school_student_absent_sms'] = "0";
			}
			$birth = $this->input->post('school_student_birth_sms');
			if($birth == 'on'){
				$school_update['school_student_birth_sms'] = "1";
			}else{
				$school_update['school_student_birth_sms'] = "0";
			}
			$salary = $this->input->post('school_employee_salary_sms');
			if($salary == 'on'){
				$school_update['school_employee_salary_sms'] = "1";
			}else{
				$school_update['school_employee_salary_sms'] = "0";
			}
			$fee_remainder = $this->input->post('school_student_fee_remainder_sms');
			if($fee_remainder == 'on'){
				$school_update['school_student_fee_remainder_sms'] = "1";
			}else{
				$school_update['school_student_fee_remainder_sms'] = "0";
			}
			$authentiction_details = $this->input->post('school_authentication_details_sms');
			if($authentiction_details == 'on'){
				$school_update['school_authentication_details_sms'] = "1";
			}else{
				$school_update['school_authentication_details_sms'] = "0";
			}
			$parent = $this->input->post('school_parent_birth_sms');
			if($parent == 'on'){
				$school_update['school_parent_birth_sms'] = "1";
			}else{
				$school_update['school_parent_birth_sms'] = "0";
			}
			$employee_birthday = $this->input->post('school_employee_birth_sms');
			if($employee_birthday == 'on'){
				$school_update['school_employee_birth_sms'] = "1";
			}else{
				$school_update['school_employee_birth_sms'] = "0";
			}
			$homework = $this->input->post('school_homework_sms');
			if($homework == 'on'){
				$school_update['school_homework_sms'] = "1";
			}else{
				$school_update['school_homework_sms'] = "0";
			}
			$parentmeet = $this->input->post('school_parentmeet_sms');
			if($parentmeet == 'on'){
				$school_update['school_parentmeet_sms'] = "1";
			}else{
				$school_update['school_parentmeet_sms'] = "0";
			}
			$newsfeed = $this->input->post('school_newsfeed_sms');
			if($newsfeed == 'on'){
				$school_update['school_newsfeed_sms'] = "1";
			}else{
				$school_update['school_newsfeed_sms'] = "0";
			}
			$circular = $this->input->post('school_circular_sms');
			if($circular == 'on'){
				$school_update['school_circular_sms'] = "1";
			}else{
				$school_update['school_circular_sms'] = "0";
			}
			$event = $this->input->post('school_event_sms');
			if($event == 'on'){
				$school_update['school_event_sms'] = "1";
			}else{
				$school_update['school_event_sms'] = "0";
			}
			$holiday = $this->input->post('school_holiday_sms');
			if($holiday == 'on'){
				$school_update['school_holiday_sms'] = "1";
			}else{
				$school_update['school_holiday_sms'] = "0";
			}
			$school_update['school_update_date'] = date('Y-m-d');
			$con = $this->School_model->update_details_school($school_update);
			$this->session->set_userdata('school_data', $school_update['school_profile_id']);
			if($con == 0){
				$this->session->set_flashdata('active',1);
	            $this->session->set_flashdata('title',"School Details Updated");
	            $this->session->set_flashdata('text',""); 
	            $this->session->set_flashdata('type',"success");
				redirect('School/school_user_detailss');
			}
			else{
				$this->session->set_flashdata('active',1);
	            $this->session->set_flashdata('title',"Error...");
	            $this->session->set_flashdata('text',"Not Added...");
	            $this->session->set_flashdata('type',"warning");
				redirect('School/school_user_detailss');
			}
		}

		function add_new_user1($school_profile_id)
		{
			$this->session->set_userdata('school_id', $school_profile_id);
			redirect('School/add_new_user');
		}

		function add_new_user()
		{
			$data2 = $this->session->userdata('institute');

			$data1['user'] = $data2['credential_username'];
			$data1['photo'] = $data2['user_photo'];
			$data1['institute_profile_id'] = $data2['user_profile_id'];
			$school_profile_id = $this->session->userdata('school_id');
			$data['user_details'] = $this->School_model->user_details($school_profile_id);
			$data['school'] = $this->School_model->school_details($school_profile_id);
			$nav['institute_name'] = $institute_admin[0]['institute_name'];
			$nav['institute_logo'] = $institute_admin[0]['institute_logo'];
			$nav['insti_admin'] = "school";
			$this->load->view('Institute/institute_header',$data1);
			$this->load->view('School/school_new_user', $data);
			$this->load->view('School/school_footer',$nav);
		}


		function already_exits_mobile()
		{
			$num['profile_id'] = $_POST['profile'];
			$num['mobile'] = $_POST['num'];
			$data = $this->School_model->already_exits_mobile($num);
			echo json_decode($data);
		}

		function already_exits_email()
		{
			$email['profile_id'] =  $_POST['profile'];
			$email['mail'] = $_POST['email'];
			$data = $this->School_model->already_exits_email($email);
			echo json_decode($data);
		}

		function forgot_password()
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
			$school_admin = $this->session->userdata('school');
			$data1['user'] = $school_admin[0]['credential_username'];
			$admin['user_profile_id'] = $school_admin[0]['employee_profile_id'];
			$admin['employee_type'] = $school_admin[0]['employee_type'];
			$admin['photo'] = $school_admin[0]['employee_photo'];
			$admin['first_name'] = $school_admin[0]['employee_first_name'];
			$admin['last_name'] = $school_admin[0]['employee_last_name'];
			$admin['email_id'] = $school_admin[0]['employee_email_id'];
			$admin['username'] = $school_admin[0]['credential_username'];
			$admin['functionality'] = $this->School_model->fetch_functionality($admin);
			$admin['AY_name'] = $school_admin[0]['AY_name'];
			$nav['institute_name'] = $school_admin[0]['school_name'];
			$nav['institute_logo'] = $school_admin[0]['school_logo'];
			$nav['insti_admin'] = "school";
			$this->load->view('School/school_header',$admin);
			$this->load->view('School/forgot_password',$data1);
			$this->load->view('School/school_footer',$nav);
		}

		function edit_profile()
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
			$school_admin = $this->session->userdata('school');
			$admin['user'] = $school_admin[0]['credential_username'];
			$admin['user_profile_id'] = $school_admin[0]['employee_profile_id'];
			$admin['employee_type'] = $school_admin[0]['employee_type'];
			$admin['photo'] = $school_admin[0]['employee_photo'];
			$admin['first_name'] = $school_admin[0]['employee_first_name'];
			$admin['last_name'] = $school_admin[0]['employee_last_name'];
			$admin['email_id'] = $school_admin[0]['employee_email_id'];
			$admin['username'] = $school_admin[0]['credential_username'];
			$admin['AY_name'] = $school_admin[0]['AY_name'];
			$admin['functionality'] = $this->School_model->fetch_functionality($admin);
			$nav['institute_name'] = $school_admin[0]['school_name'];
			$nav['institute_logo'] = $school_admin[0]['school_logo'];

			$data2['user_details'] = $this->School_model->user_profile($admin);
			$nav['insti_admin'] = "school";
			$this->load->view('School/school_header',$admin);
			$this->load->view('School/edit_profile',$data2);
			$this->load->view('School/school_footer',$nav);
		}

		function school_change_password()
		{
			$data['credential_profile_id'] = $this->input->post('user_profile_id');
			$data12 = $this->School_model->fetch_user_update_mail($data);
			$data1['employee_email_id'] = $data12[0]['employee_email_id'];
			$data1['employee_pri_mobile_number'] = $data12[0]['employee_pri_mobile_number'];
			$data['credential_password'] = md5($this->input->post('password'));
			$data1['credential_password'] = $this->input->post('password');
			$data['credential_update_date'] = date('Y-m-d');
			$this->School_model->forgot_password($data);

			$config['protocol'] = $this->config->item('protocol');
			$config['smtp_host'] = $this->config->item('smtp_host');
			$config['smtp_port'] = $this->config->item('smtp_port');
			$config['smtp_timeout'] = $this->config->item('smtp_timeout');
			$config['smtp_user'] = $this->config->item('smtp_user');
			$config['smtp_pass'] = $this->config->item('smtp_pass');
			$config['charset'] = $this->config->item('charset');
			$config['newline'] = $this->config->item('newline');
			$config['mailtype'] = $this->config->item('mailtype');
			$config['validation'] = $this->config->item('validation');

			$this->email->initialize($config);
			$this->email->from('no-reply@trackmee.syntech.co.in');			// $this->email->from($email,$name);
			$this->email->to(''.$data1['employee_email_id'].'');
			$this->email->subject('Updated Authencation Details');
			$this->email->message("Hi,<br>Your profile has been created with System Your credentials are as follows:<br> <p>  Password: ".$data1['credential_password']."<br><br>  Thanks & Regards,<br>  ");
			if($this->email->send()){
				$this->session->set_flashdata('active',1);
		        $this->session->set_flashdata('title',"Password Updated.");
		        $this->session->set_flashdata('text',"User updated password are send On Email ID."); 
		        $this->session->set_flashdata('type',"success");
				redirect('School');	
			}
			else{
				$this->session->set_flashdata('active',1);
		        $this->session->set_flashdata('title',"Error...");
		        $this->session->set_flashdata('text',"Not Added...");
		        $this->session->set_flashdata('type',"warning");
				redirect('School');	
			}
		}

		
		function update_school_logo()
		{
			$data['school_profile_id'] = $this->input->post('school_profile_id');
			$data['school_logo'] = $this->upload('school_logo', 'profile_photo');
			$data['school_update_date'] = date('Y-m-d');
			$con = $this->School_model->update_school_logo($data);
			if($con == 0){
				$this->session->set_flashdata('active',1);
	            $this->session->set_flashdata('title',"School Logo Updated.");
	            $this->session->set_flashdata('text',""); 
	            $this->session->set_flashdata('type',"success");	
				redirect('School/school_user_detailss');
			}
			else{
				$this->session->set_flashdata('active',1);
	            $this->session->set_flashdata('title',"Error...");
	            $this->session->set_flashdata('text',"Not Added...");
	            $this->session->set_flashdata('type',"warning");	
				redirect('School/school_user_detailss');
			}
		}

		function activate_school($school_profile_id){
			$this->session->set_userdata('activated_school',$school_profile_id);
			redirect('School/school_activate');
		}

		function school_activate(){
			if(!isset($this->session->userdata['Institute']))
			{
				redirect('/');
			}
			else{
				$admin['direct'] = 1;
			}  
			$school_admin = $this->session->userdata('Institute');
			$school_profile_id = $this->session->userdata('activated_school');	
			$data = $this->School_model->school_activate($school_profile_id);
			if($data == 1){
				$this->session->set_flashdata('active',1);
	            $this->session->set_flashdata('title',"School Activated.");
	            $this->session->set_flashdata('text',""); 
	            $this->session->set_flashdata('type',"success");	
				redirect('School/view_school');
			}else{
				$this->session->set_flashdata('active',1);
	            $this->session->set_flashdata('title',"School Not Activated.");
	            $this->session->set_flashdata('text',"warning"); 
	            $this->session->set_flashdata('type',"success");	
				redirect('School/view_school');
			}
		}

		function deactivate_school($school_profile_id){
			$this->session->set_userdata('deactivated_school',$school_profile_id);
			redirect('School/school_deactivate');
		}

		function school_deactivate(){
			if(!isset($this->session->userdata['Institute']))
			{
				redirect('/');
			}
			else{
				$admin['direct'] = 1;
			}  
			$school_admin = $this->session->userdata('Institute');
			$school_profile_id = $this->session->userdata('deactivated_school');	
			$data = $this->School_model->school_deactivate($school_profile_id);
			if($data == 1){
				$this->session->set_flashdata('active',1);
	            $this->session->set_flashdata('title',"School Deactivated.");
	            $this->session->set_flashdata('text',""); 
	            $this->session->set_flashdata('type',"success");	
				redirect('School/view_school');
			}else{
				$this->session->set_flashdata('active',1);
	            $this->session->set_flashdata('title',"School Not Deactivated.");
	            $this->session->set_flashdata('text',"warning"); 
	            $this->session->set_flashdata('type',"success");	
				redirect('School/view_school');
			}
		}

		function activate_employee($employee_profile_id){
			$this->session->set_userdata('activated_employee',$employee_profile_id);
			redirect('School/employee_activate');
		}

		function employee_activate(){
			if(!isset($this->session->userdata['Institute']))
			{
				redirect('/');
			}
			else{
				$admin['direct'] = 1;
			}  
			$school_admin = $this->session->userdata('Institute');
			$employee_profile_id = $this->session->userdata('activated_employee');	
			$employee = $this->db->query("SELECT employee_type,employee_school_profile_id FROM employee where employee_profile_id =".$employee_profile_id."")->result_array(); 
			$verify = $this->db->query("SELECT * FROM employee where employee_type =".$employee[0]['employee_type']." and employee_expiry_date = '9999-12-31' and employee_school_profile_id = ".$employee[0]['employee_school_profile_id']."")->num_rows();
			if ($verify >= 1) {
				$this->session->set_flashdata('active',1);
	            $this->session->set_flashdata('title',"Employee Already Register.");
	            $this->session->set_flashdata('text',"Please remove and register."); 
	            $this->session->set_flashdata('type',"warning");	
				redirect('School/view_school');
			}else{
				$data = $this->School_model->employee_activate($employee_profile_id);
				if($data == 1){
					$this->session->set_flashdata('active',1);
		            $this->session->set_flashdata('title',"Employee Activated.");
		            $this->session->set_flashdata('text',""); 
		            $this->session->set_flashdata('type',"success");	
					redirect('School/view_school');
				}else{
					$this->session->set_flashdata('active',1);
		            $this->session->set_flashdata('title',"Employee Not Activated.");
		            $this->session->set_flashdata('text',""); 
		            $this->session->set_flashdata('type',"success");	
					redirect('School/view_school');
				}
			}
		}

		function deactivate_employee($employee_profile_id){
			$this->session->set_userdata('deactivated_employee',$employee_profile_id);
			redirect('School/employee_deactivate');
		}

		function employee_deactivate(){
			if(!isset($this->session->userdata['Institute']))
			{
				redirect('/');
			}
			else{
				$admin['direct'] = 1;
			}  
			$school_admin = $this->session->userdata('Institute');
			$employee_profile_id = $this->session->userdata('deactivated_employee');
			$data = $this->School_model->employee_deactivate($employee_profile_id);
			if($data == 1){
				$this->session->set_flashdata('active',1);
	            $this->session->set_flashdata('title',"Employee Deactivated.");
	            $this->session->set_flashdata('text',""); 
	            $this->session->set_flashdata('type',"success");	
				redirect('School/view_school');
			}else{
				$this->session->set_flashdata('active',1);
	            $this->session->set_flashdata('title',"Employee Not Deactivated.");
	            $this->session->set_flashdata('text',"warning"); 
	            $this->session->set_flashdata('type',"success");	
				redirect('School/view_school');
			}
		}

		function certificates_header_details(){
			$cert['school_profile_id'] = $this->input->post('school_profile_id');
			$doc = $this->input->post('document_type');
			switch ($doc) {
				case '1':
					$cert['doc_type'] = 'school_report_header';
					break;
				case '2':
					$cert['doc_type'] = 'school_report_footer';
					break;
				case '3':
					$cert['doc_type'] = 'school_leaving_certificate_header';
					break;
				case '4':
					$cert['doc_type'] = 'school_leaving_certificate_footer';
					break;
				case '5':
					$cert['doc_type'] = 'school_bonafied_certificate_header';
					break;
				case '6':
					$cert['doc_type'] = 'school_bonafied_certificate_footer';
					break;
			}
			$cert['doc_photo'] = $this->upload_certificates('document_photo', 'document');
			$this->db->set($cert['doc_type'],$cert['doc_photo'])->where('school_profile_id',$cert['school_profile_id'])->update('school');
			$this->session->set_userdata('school_data', $cert['school_profile_id']);
			$this->session->set_flashdata('active',1);
            $this->session->set_flashdata('title',"".$cert['doc_type']." Added Successfully.");
            $this->session->set_flashdata('text',""); 
            $this->session->set_flashdata('type',"success");	
			redirect('School/school_user_detailss');
		}

		function disable_school_cerificates($school)
		{
			$this->session->set_userdata('delete_cert',$school);
			redirect('School/delete_school_certificates');
		}

		function delete_school_certificates()
		{
			$data = $this->session->userdata('delete_cert');
			$res = str_split($data);
			$doc = $res[0];
			switch ($doc) {
				case '1':
					$cert['doc_type'] = 'school_report_header';
					break;
				case '2':
					$cert['doc_type'] = 'school_report_footer';
					break;
				case '3':
					$cert['doc_type'] = 'school_leaving_certificate_header';
					break;
				case '4':
					$cert['doc_type'] = 'school_leaving_certificate_footer';
					break;
				case '5':
					$cert['doc_type'] = 'school_bonafied_certificate_header';
					break;
				case '6':
					$cert['doc_type'] = 'school_bonafied_certificate_footer';
					break;
			}
			$school_profile_id = $res[1];
			$this->db->set($cert['doc_type'],'')->where('school_profile_id',$school_profile_id)->update('school');
			$this->session->set_userdata('school_data', $school_profile_id);
			$this->session->set_flashdata('active',1);
            $this->session->set_flashdata('title',"".$cert['doc_type']." delete Successfully.");
            $this->session->set_flashdata('text',""); 
            $this->session->set_flashdata('type',"success");	
			redirect('School/school_user_detailss');
		}
	}
?>