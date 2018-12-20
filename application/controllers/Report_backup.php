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
		$admin['photo'] = $school_admin[0]['employee_photo'];
		$admin['first_name'] = $school_admin[0]['employee_first_name'];
		$admin['last_name'] = $school_admin[0]['employee_last_name'];
		$admin['email_id'] = $school_admin[0]['employee_email_id'];
		$admin['username'] = $school_admin[0]['credential_username'];
		$admin['AY_name'] = $school_admin[0]['AY_name'];
		$AY_id = $school_admin[0]['school_AY_id'];
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
						where SCD_school_profile_id=3
						group by SCD_student_profile_id
						)
						) as AY
						on AY.SCD_student_profile_id=student_profile_id
						join student_class_division_assgn as SCD
						on SCD.SCD_student_profile_id=student_profile_id
						and SCD.SCD_school_profile_id=3
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

		$report['all_report'] = $this->db->query("SELECT 
							student_GRN
							,student_first_name
							,student_middle_name
							,student_last_name
							,student_gender
							,student_adhar_card_number
							,date_format(student_DOB,'%d-%m-%Y') as DOB
							,student_birth_place
							,student_blood_group
							,student_present_town
							,concat(student_permament_house_no,'A/P.',student_present_town,',Tal.',student_present_tal,',Dist.',student_present_dist,', ',student_present_state,'-',student_present_pincode) as student_address
							,date_format(student_admission_date,'%d-%m-%Y') as admission_date
							,class_name
							,division_name
							,SCD_roll_no
							,student_religion
							,student_cast
							,student_sub_cast
							,father.parent_first_name as father_first_name
							,father.parent_middle_name as father_middle_name
							,father.parent_last_name as father_last_name
							,father.parent_mobile_number as father_mobile_number
							,father.parent_email_id as father_email_id
							,mother.parent_first_name as mother_first_name
							,mother.parent_middle_name as mother_middle_name
							,mother.parent_last_name as mother_last_name
							,mother.parent_mobile_number as mother_mobile_number
							,mother.parent_email_id as mother_email_id
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

		$report['total_sms_report'] = $this->db->query("SELECT CONCAT(student_first_name,' ',student_last_name) as student_name,student_GRN,CONCAT(parent_first_name,' ',parent_last_name) as parent_name,DATE_FORMAT(sent_sms_datetime,'%d-%m-%Y') as sms_date,sent_sms.*  FROM `sent_sms` join parent on parent_profile_id = sent_sms_student_profile_id join student on parent_student_profile_id = student_profile_id WHERE sent_sms_student_profile_id != 0 and sent_sms_school_profile_id = ".$employee_school_profile_id." ORDER BY sent_sms_datetime DESC")->result_array();
		// print_r($report['government']);die();

		$report['school_report_header'] = $school_admin[0]['school_report_header'];
		$report['school_report_footer'] = $school_admin[0]['school_report_footer'];
		$nav['school_name'] = $school_admin[0]['school_name'];
		$nav['school_logo'] = $school_admin[0]['school_logo'];
		$nav['report'] = 'student';

		$this->load->view('School/school_header', $admin);
		$this->load->view('Reports/enquiry_student_report',$report);
		$this->load->view('Reports/enquiry_student_report_footer',$nav);
	}

	function fetch_class_division()
	{
		$school_admin = $this->session->userdata('school');
		$class_id = $_POST['class_id'];
		$school_id = $school_admin[0]['employee_school_profile_id'];
		$data = $this->db->query("SELECT * FROM division where division_class_id =".$class_id." and division_school_profile_id =".$school_id." and division_expiry_date = '9999-12-31' GROUP BY division_name")->result_array();
		echo json_encode($data);
	}

	function fetch_class_name()
	{
		$school_admin = $this->session->userdata('school');
		$class_id = $_POST['class_id'];
		$school_id = $school_admin[0]['employee_school_profile_id'];
		$data = $this->db->query("SELECT class_name FROM class where class_id =".$class_id." and class_school_profile_id =".$school_id." and class_expiry_date = '9999-12-31'")->result_array();
		echo json_encode($data);
	}

	function fetch_class_division_name()
	{
		$school_admin = $this->session->userdata('school');
		$division = $_POST['division'];
		$school_id = $school_admin[0]['employee_school_profile_id'];
		$data = $this->db->query("SELECT division_name FROM division where division_id =".$division." and division_school_profile_id =".$school_id." and division_expiry_date = '9999-12-31'")->result_array();
		echo json_encode($data);
	}
// --------------------------------------------------------------------------------------------- General Resister Report -----------------------------------------------------------------
	function general_all_class_report()
	{
		$school_admin = $this->session->userdata('school');
		$employee_school_profile_id = $school_admin[0]['employee_school_profile_id'];
		$school_AY_id = $school_admin[0]['school_AY_id'];
		$data = $this->db->query("SELECT student_GRN,student_adhar_card_number,CONCAT(student_last_name,' ',student_first_name,' ',student_middle_name) as student_name,student_DOB,student_gender,student_nationality,student_category,CONCAT(student_religion,'-',student_cast) as religion,CONCAT(student_present_house_no,'',student_present_town,' ',student_present_tal,' ',student_present_dist,' ',student_present_state,'',student_present_pincode)as address, class_name,division_name FROM `student` left join student_class_division_assgn on student_profile_id = SCD_student_profile_id left join class on class_id = SCD_class_id left join division on division_id = SCD_division_id where student_school_profile_id =".$employee_school_profile_id." and SCD_AY_id=".$school_AY_id." order by student_GRN")->result();
		echo json_encode($data);
	}

	function general_class_wise_report()
	{
		$school_admin = $this->session->userdata('school');
		$class_id = $_POST['class_id'];
		$school_AY_id = $school_admin[0]['school_AY_id'];
		$employee_school_profile_id = $school_admin[0]['employee_school_profile_id'];
		$data = $this->db->query("SELECT student_GRN,student_adhar_card_number,CONCAT(student_last_name,' ',student_first_name,' ',student_middle_name) as student_name,student_DOB,student_gender,student_nationality,student_category,CONCAT(student_religion,'-',student_cast) as religion,CONCAT(student_present_house_no,'',student_present_town,' ',student_present_tal,' ',student_present_dist,' ',student_present_state,'',student_present_pincode)as address, class_name,division_name FROM `student` left join student_class_division_assgn on student_profile_id = SCD_student_profile_id left join class on class_id = SCD_class_id left join division on division_id = SCD_division_id where SCD_class_id=".$class_id." and student_school_profile_id =".$employee_school_profile_id." and student_expiry_date = '9999-12-31' and SCD_AY_id=".$school_AY_id." and SCD_expiry_date ='9999-12-31' order by student_GRN")->result();
		echo json_encode($data);
	}

	function general_class_division_wise_report()
	{
		$school_admin = $this->session->userdata('school');
		$class_id = $_POST['class_id'];
		$division_id = $_POST['division_id'];
		$employee_school_profile_id = $school_admin[0]['employee_school_profile_id'];
		$data = $this->db->query("SELECT student_GRN,student_adhar_card_number,CONCAT(student_last_name,' ',student_first_name,' ',student_middle_name) as student_name,student_DOB,student_gender,student_nationality,student_category,CONCAT(student_religion,'-',student_cast) as religion,CONCAT(student_present_house_no,'',student_present_town,' ',student_present_tal,' ',student_present_dist,' ',student_present_state,'',student_present_pincode)as address, class_name,division_name FROM `student` left join student_class_division_assgn on student_profile_id = SCD_student_profile_id left join class on class_id = SCD_class_id left join division on division_id = SCD_division_id where SCD_class_id=".$class_id." and SCD_division_id=".$division_id." and student_school_profile_id =".$employee_school_profile_id." and student_expiry_date = '9999-12-31' and SCD_AY_id=".$school_AY_id." and SCD_expiry_date ='9999-12-31' order by student_GRN")->result();
		echo json_encode($data);
	}
// ------------------------------------------------------------------------- Class Reports -----------------------------------------------------------------------------
	function class_all_class_report()
	{
		$school_admin = $this->session->userdata('school');
		$employee_school_profile_id = $school_admin[0]['employee_school_profile_id'];
		$school_AY_id = $school_admin[0]['school_AY_id'];
		$data = $this->db->query("SELECT student_GRN,student_adhar_card_number,student_admission_date,CONCAT(student_last_name,' ',student_first_name,' ',student_middle_name) as student_name,father_name,mother_name,student_DOB,student_gender,student_nationality,student_category,CONCAT(student_religion,'-',student_cast) as religion,CONCAT(student_present_house_no,'',student_present_town,' ',student_present_tal,' ',student_present_dist,' ',student_present_state,'',student_present_pincode)as address, class_name,division_name FROM `student` left join student_class_division_assgn on student_profile_id = SCD_student_profile_id left join class on class_id = SCD_class_id left join division on division_id = SCD_division_id 
			join 
			(SELECT father_student,father_name,mother_name from((select parent_student_profile_id as father_student,CONCAT(parent_last_name,' ',parent_first_name,' ',parent_middle_name) as father_name from student join parent on student_profile_id = parent_student_profile_id WHERE parent_type = '1') as father join (select parent_student_profile_id as mother_student,CONCAT(parent_last_name,' ',parent_first_name,' ',parent_middle_name) as mother_name from student join parent on student_profile_id = parent_student_profile_id WHERE parent_type = '2') as mother on father_student = mother_student))as parent on student_profile_id = father_student where student_school_profile_id =".$employee_school_profile_id." and student_expiry_date = '9999-12-31' and SCD_AY_id=".$school_AY_id." and SCD_expiry_date ='9999-12-31' order by class_name,student_GRN")->result();
		echo json_encode($data);
	}

	function class_class_wise_report()
	{
		$school_admin = $this->session->userdata('school');
		$class_id = $_POST['class_id'];
		$school_AY_id = $school_admin[0]['school_AY_id'];
		$employee_school_profile_id = $school_admin[0]['employee_school_profile_id'];
		$data = $this->db->query("SELECT  student_GRN,student_adhar_card_number,student_admission_date,CONCAT(student_last_name,' ',student_first_name,' ',student_middle_name) as student_name,father_name,mother_name,student_DOB,student_gender,student_nationality,student_category,CONCAT(student_religion,'-',student_cast) as religion,CONCAT(student_present_house_no,'',student_present_town,' ',student_present_tal,' ',student_present_dist,' ',student_present_state,'',student_present_pincode)as address,class_name,division_name FROM `student` left join student_class_division_assgn on student_profile_id = SCD_student_profile_id left join class on class_id = SCD_class_id left join division on division_id = SCD_division_id 
			join 
			(SELECT father_student,father_name,mother_name from((select parent_student_profile_id as father_student,CONCAT(parent_last_name,' ',parent_first_name,' ',parent_middle_name) as father_name from student join parent on student_profile_id = parent_student_profile_id WHERE parent_type = '1') as father join (select parent_student_profile_id as mother_student,CONCAT(parent_last_name,' ',parent_first_name,' ',parent_middle_name) as mother_name from student join parent on student_profile_id = parent_student_profile_id WHERE parent_type = '2') as mother on father_student = mother_student))as parent on student_profile_id = father_student where SCD_class_id=".$class_id." and student_school_profile_id =".$employee_school_profile_id." and student_expiry_date = '9999-12-31' and SCD_AY_id=".$school_AY_id." and SCD_expiry_date ='9999-12-31' order by class_name,student_GRN")->result();
		echo json_encode($data);
	}

	function class_class_division_wise_report()
	{
		$school_admin = $this->session->userdata('school');
		$class_id = $_POST['class_id'];
		$division_id = $_POST['division_id'];
		$employee_school_profile_id = $school_admin[0]['employee_school_profile_id'];
		$school_AY_id = $school_admin[0]['school_AY_id'];
		$data = $this->db->query("SELECT student_GRN,student_adhar_card_number,student_admission_date,CONCAT(student_last_name,' ',student_first_name,' ',student_middle_name) as student_name,father_name,mother_name,student_DOB,student_gender,student_nationality,student_category,CONCAT(student_religion,'-',student_cast) as religion,CONCAT(student_present_house_no,'',student_present_town,' ',student_present_tal,' ',student_present_dist,' ',student_present_state,'',student_present_pincode)as address, class_name,division_name FROM `student` left join student_class_division_assgn on student_profile_id = SCD_student_profile_id left join class on class_id = SCD_class_id left join division on division_id = SCD_division_id 
			join 
			(SELECT father_student,father_name,mother_name from((select parent_student_profile_id as father_student,CONCAT(parent_last_name,' ',parent_first_name,' ',parent_middle_name) as father_name from student join parent on student_profile_id = parent_student_profile_id WHERE parent_type = '1') as father join (select parent_student_profile_id as mother_student,CONCAT(parent_last_name,' ',parent_first_name,' ',parent_middle_name) as mother_name from student join parent on student_profile_id = parent_student_profile_id WHERE parent_type = '2') as mother on father_student = mother_student))as parent on student_profile_id = father_student
			where SCD_class_id=".$class_id." and SCD_division_id=".$division_id." and student_school_profile_id =".$employee_school_profile_id." and student_expiry_date = '9999-12-31' and SCD_AY_id=".$school_AY_id." and SCD_expiry_date ='9999-12-31' order by division_name,class_name,student_GRN")->result();
		echo json_encode($data);
	}
// ------------------------------------------------------------------------------------------- Division Reports --------------------------------------------------------------------------------
	function division_all_class_report()
	{
		$school_admin = $this->session->userdata('school');
		$employee_school_profile_id = $school_admin[0]['employee_school_profile_id'];
		$school_AY_id = $school_admin[0]['school_AY_id'];
		$data = $this->db->query("SELECT student_GRN,student_adhar_card_number,CONCAT(student_last_name,' ',student_first_name,' ',student_middle_name) as student_name,student_DOB,student_gender,student_nationality,student_category,CONCAT(student_religion,'-',student_cast) as religion,CONCAT(student_present_house_no,'',student_present_town,' ',student_present_tal,' ',student_present_dist,' ',student_present_state,'',student_present_pincode)as address, class_name,division_name FROM `student` left join student_class_division_assgn on student_profile_id = SCD_student_profile_id left join class on class_id = SCD_class_id left join division on division_id = SCD_division_id where student_school_profile_id =".$employee_school_profile_id." and student_expiry_date = '9999-12-31' and SCD_AY_id=".$school_AY_id." and SCD_expiry_date ='9999-12-31' order by division_name,class_name,student_GRN")->result();
		echo json_encode($data);
	}

	function division_class_wise_report()
	{
		$school_admin = $this->session->userdata('school');
		$class_id = $_POST['class_id'];
		$school_AY_id = $school_admin[0]['school_AY_id'];
		$employee_school_profile_id = $school_admin[0]['employee_school_profile_id'];
		$school_AY_id = $school_admin[0]['school_AY_id'];
		$data = $this->db->query("SELECT  class_name,student_GRN,student_adhar_card_number,CONCAT(student_last_name,' ',student_first_name,' ',student_middle_name) as student_name,student_DOB,student_gender,student_nationality,student_category,CONCAT(student_religion,'-',student_cast) as religion,CONCAT(student_present_house_no,'',student_present_town,' ',student_present_tal,' ',student_present_dist,' ',student_present_state,'',student_present_pincode)as address,division_name FROM `student` left join student_class_division_assgn on student_profile_id = SCD_student_profile_id left join class on class_id = SCD_class_id left join division on division_id = SCD_division_id where SCD_class_id=".$class_id." and student_school_profile_id =".$employee_school_profile_id." and student_expiry_date = '9999-12-31' and SCD_AY_id=".$school_AY_id." and SCD_expiry_date ='9999-12-31' order by division_name,class_name,student_GRN")->result();
		echo json_encode($data);
	}

	function division_class_division_wise_report()
	{
		$school_admin = $this->session->userdata('school');
		$class_id = $_POST['class_id'];
		$division_id = $_POST['division_id'];
		$employee_school_profile_id = $school_admin[0]['employee_school_profile_id'];
		$school_AY_id = $school_admin[0]['school_AY_id'];
		$data = $this->db->query("SELECT student_GRN,student_adhar_card_number,CONCAT(student_last_name,' ',student_first_name,' ',student_middle_name) as student_name,student_DOB,student_gender,student_nationality,student_category,CONCAT(student_religion,'-',student_cast) as religion,CONCAT(student_present_house_no,'',student_present_town,' ',student_present_tal,' ',student_present_dist,' ',student_present_state,'',student_present_pincode)as address, class_name,division_name FROM `student` left join student_class_division_assgn on student_profile_id = SCD_student_profile_id left join class on class_id = SCD_class_id left join division on division_id = SCD_division_id where SCD_class_id=".$class_id." and SCD_division_id=".$division_id." and student_school_profile_id =".$employee_school_profile_id." and student_expiry_date = '9999-12-31' and SCD_AY_id=".$school_AY_id." and SCD_expiry_date ='9999-12-31' order by class_name,student_GRN")->result();
		echo json_encode($data);
	}

// --------------------------------------------------------------------------------------- Gender Report --------------------------------------------------------------------------------------
	function gender_all_class_report()
	{
		$school_admin = $this->session->userdata('school');
		$employee_school_profile_id = $school_admin[0]['employee_school_profile_id'];
		$school_AY_id = $school_admin[0]['school_AY_id'];
		$gender = $_POST['gender'];
		$data = $this->db->query("SELECT student_GRN,student_adhar_card_number,CONCAT(student_last_name,' ',student_first_name,' ',student_middle_name) as student_name,student_DOB,student_gender,student_nationality,student_category,CONCAT(student_religion,'-',student_cast) as religion,CONCAT(student_present_house_no,'',student_present_town,' ',student_present_tal,' ',student_present_dist,' ',student_present_state,'',student_present_pincode)as address, class_name,division_name FROM `student` left join student_class_division_assgn on student_profile_id = SCD_student_profile_id left join class on class_id = SCD_class_id left join division on division_id = SCD_division_id where student_school_profile_id =".$employee_school_profile_id." and student_gender='".$gender."' and student_expiry_date = '9999-12-31' and SCD_AY_id=".$school_AY_id." and SCD_expiry_date ='9999-12-31' order by student_GRN")->result();
		echo json_encode($data);
	}

	function gender_class_wise_report()
	{
		$school_admin = $this->session->userdata('school');
		$class_id = $_POST['class_id'];
		$gender = $_POST['gender'];
		$school_AY_id = $school_admin[0]['school_AY_id'];
		$employee_school_profile_id = $school_admin[0]['employee_school_profile_id'];
		$data = $this->db->query("SELECT  class_name,student_GRN,student_adhar_card_number,CONCAT(student_last_name,' ',student_first_name,' ',student_middle_name) as student_name,student_DOB,student_gender,student_nationality,student_category,CONCAT(student_religion,'-',student_cast) as religion,CONCAT(student_present_house_no,'',student_present_town,' ',student_present_tal,' ',student_present_dist,' ',student_present_state,'',student_present_pincode)as address,division_name FROM `student` left join student_class_division_assgn on student_profile_id = SCD_student_profile_id left join class on class_id = SCD_class_id left join division on division_id = SCD_division_id where SCD_class_id=".$class_id." and student_school_profile_id =".$employee_school_profile_id." and student_gender='".$gender."' and student_expiry_date = '9999-12-31' and SCD_AY_id=".$school_AY_id." and SCD_expiry_date ='9999-12-31' order by student_GRN")->result();
		echo json_encode($data);
	}

	function gender_class_division_wise_report()
	{
		$school_admin = $this->session->userdata('school');
		$class_id = $_POST['class_id'];
		$division_id = $_POST['division_id'];
		$gender = $_POST['gender'];
		$employee_school_profile_id = $school_admin[0]['employee_school_profile_id'];
		$school_AY_id = $school_admin[0]['school_AY_id'];
		$data = $this->db->query("SELECT student_GRN,student_adhar_card_number,CONCAT(student_last_name,' ',student_first_name,' ',student_middle_name) as student_name,student_DOB,student_gender,student_nationality,student_category,CONCAT(student_religion,'-',student_cast) as religion,CONCAT(student_present_house_no,'',student_present_town,' ',student_present_tal,' ',student_present_dist,' ',student_present_state,'',student_present_pincode)as address, class_name,division_name FROM `student` left join student_class_division_assgn on student_profile_id = SCD_student_profile_id left join class on class_id = SCD_class_id left join division on division_id = SCD_division_id where SCD_class_id=".$class_id." and SCD_division_id=".$division_id." and student_school_profile_id =".$employee_school_profile_id." and student_gender='".$gender."' and student_expiry_date = '9999-12-31' and SCD_AY_id=".$school_AY_id." and SCD_expiry_date ='9999-12-31' order by student_GRN")->result();
		echo json_encode($data);
	}

// --------------------------------------------------------------------------------------- CAST Report -----------------------------------------------------------------------------------------
	function cast_all_class_report()
	{
		$school_admin = $this->session->userdata('school');
		$employee_school_profile_id = $school_admin[0]['employee_school_profile_id'];
		$school_AY_id = $school_admin[0]['school_AY_id'];
		$cast = $_POST['cast'];
		$data = $this->db->query("SELECT student_GRN,student_adhar_card_number,CONCAT(student_last_name,' ',student_first_name,' ',student_middle_name) as student_name,student_DOB,student_gender,student_nationality,student_category,CONCAT(student_religion,'-',student_cast) as religion,CONCAT(student_present_house_no,' ',student_present_town,' ',student_present_tal,' ',student_present_dist,' ',student_present_state,'',student_present_pincode)as address, class_name,division_name FROM `student` left join student_class_division_assgn on student_profile_id = SCD_student_profile_id left join class on class_id = SCD_class_id left join division on division_id = SCD_division_id where student_school_profile_id =".$employee_school_profile_id." and student_category='".$cast."' and student_expiry_date = '9999-12-31' and SCD_AY_id=".$school_AY_id." and SCD_expiry_date ='9999-12-31' order by student_GRN")->result();
		echo json_encode($data);
	}

	function cast_class_wise_report()
	{
		$school_admin = $this->session->userdata('school');
		$class_id = $_POST['class_id'];
		$cast = $_POST['cast'];
		$school_AY_id = $school_admin[0]['school_AY_id'];
		$employee_school_profile_id = $school_admin[0]['employee_school_profile_id'];
		$data = $this->db->query("SELECT  class_name,student_GRN,student_adhar_card_number,CONCAT(student_last_name,' ',student_first_name,' ',student_middle_name) as student_name,student_DOB,student_gender,student_nationality,student_category,CONCAT(student_religion,'-',student_cast) as religion,CONCAT(student_present_house_no,' ',student_present_town,' ',student_present_tal,' ',student_present_dist,' ',student_present_state,'',student_present_pincode)as address,division_name FROM `student` left join student_class_division_assgn on student_profile_id = SCD_student_profile_id left join class on class_id = SCD_class_id left join division on division_id = SCD_division_id where SCD_class_id=".$class_id." and student_school_profile_id =".$employee_school_profile_id." and student_category='".$cast."' and student_expiry_date = '9999-12-31' and SCD_AY_id=".$school_AY_id." and SCD_expiry_date ='9999-12-31' order by student_GRN")->result();
		echo json_encode($data);
	}

	function cast_class_division_wise_report()
	{
		$school_admin = $this->session->userdata('school');
		$class_id = $_POST['class_id'];
		$division_id = $_POST['division_id'];
		$cast = $_POST['cast'];
		$employee_school_profile_id = $school_admin[0]['employee_school_profile_id'];
		$school_AY_id = $school_admin[0]['school_AY_id'];
		$data = $this->db->query("SELECT student_GRN,student_adhar_card_number,CONCAT(student_last_name,' ',student_first_name,' ',student_middle_name) as student_name,student_DOB,student_gender,student_nationality,student_category,CONCAT(student_religion,'-',student_cast) as religion,CONCAT(student_present_house_no,' ',student_present_town,' ',student_present_tal,' ',student_present_dist,' ',student_present_state,'',student_present_pincode)as address, class_name,division_name FROM `student` left join student_class_division_assgn on student_profile_id = SCD_student_profile_id left join class on class_id = SCD_class_id left join division on division_id = SCD_division_id where SCD_class_id=".$class_id." and SCD_division_id=".$division_id." and student_school_profile_id =".$employee_school_profile_id." and student_category='".$cast."' and student_expiry_date = '9999-12-31' and SCD_AY_id=".$school_AY_id." and SCD_expiry_date ='9999-12-31' order by student_GRN")->result();
		echo json_encode($data);
	}


// ------------------------------------------------------------------------------------ Town Wise Report ------------------------------------------------------------------------------------

	function town_all_class_report()
	{
		$school_admin = $this->session->userdata('school');
		$employee_school_profile_id = $school_admin[0]['employee_school_profile_id'];
		$school_AY_id = $school_admin[0]['school_AY_id'];
		$town = $_POST['town'];
		$data = $this->db->query("SELECT student_GRN,student_adhar_card_number,CONCAT(student_last_name,' ',student_first_name,' ',student_middle_name) as student_name,student_DOB,student_gender,student_nationality,student_category,CONCAT(student_religion,'-',student_cast) as religion,CONCAT(student_present_house_no,' ',student_present_town,' ',student_present_tal,' ',student_present_dist,' ',student_present_state,'',student_present_pincode)as address, class_name,division_name FROM `student` left join student_class_division_assgn on student_profile_id = SCD_student_profile_id left join class on class_id = SCD_class_id left join division on division_id = SCD_division_id where student_school_profile_id =".$employee_school_profile_id." and student_present_town='".$town."' and student_expiry_date = '9999-12-31' and SCD_AY_id=".$school_AY_id." and SCD_expiry_date ='9999-12-31' order by student_GRN")->result();
		echo json_encode($data);
	}

	function town_class_wise_report()
	{
		$school_admin = $this->session->userdata('school');
		$class_id = $_POST['class_id'];
		$town = $_POST['town'];
		$school_AY_id = $school_admin[0]['school_AY_id'];
		$employee_school_profile_id = $school_admin[0]['employee_school_profile_id'];
		$data = $this->db->query("SELECT  class_name,student_GRN,student_adhar_card_number,CONCAT(student_last_name,' ',student_first_name,' ',student_middle_name) as student_name,student_DOB,student_gender,student_nationality,student_category,CONCAT(student_religion,'-',student_cast) as religion,CONCAT(student_present_house_no,'',student_present_town,' ',student_present_tal,' ',student_present_dist,' ',student_present_state,'',student_present_pincode)as address,division_name FROM `student` left join student_class_division_assgn on student_profile_id = SCD_student_profile_id left join class on class_id = SCD_class_id left join division on division_id = SCD_division_id where SCD_class_id=".$class_id." and student_school_profile_id =".$employee_school_profile_id." and student_present_town='".$town."' and student_expiry_date = '9999-12-31' and SCD_AY_id=".$school_AY_id." and SCD_expiry_date ='9999-12-31' order by student_GRN")->result();
		echo json_encode($data);
	}

	function town_class_division_wise_report()
	{
		$school_admin = $this->session->userdata('school');
		$class_id = $_POST['class_id'];
		$division_id = $_POST['division_id'];
		$town = $_POST['town'];
		$employee_school_profile_id = $school_admin[0]['employee_school_profile_id'];
		$school_AY_id = $school_admin[0]['school_AY_id'];
		$data = $this->db->query("SELECT student_GRN,student_adhar_card_number,CONCAT(student_last_name,' ',student_first_name,' ',student_middle_name) as student_name,student_DOB,student_gender,student_nationality,student_category,CONCAT(student_religion,'-',student_cast) as religion,CONCAT(student_present_house_no,'',student_present_town,' ',student_present_tal,' ',student_present_dist,' ',student_present_state,'',student_present_pincode)as address, class_name,division_name FROM `student` left join student_class_division_assgn on student_profile_id = SCD_student_profile_id left join class on class_id = SCD_class_id left join division on division_id = SCD_division_id where SCD_class_id=".$class_id." and SCD_division_id=".$division_id." and student_school_profile_id =".$employee_school_profile_id." and student_present_town='".$town."' and student_expiry_date = '9999-12-31' and SCD_AY_id=".$school_AY_id." and SCD_expiry_date ='9999-12-31' order by student_GRN")->result();
		echo json_encode($data);
	}

// ------------------------------------------------------------------------------------ Contact Wise Report ------------------------------------------------------------------------------------

	function contact_all_class_report()
	{
		$school_admin = $this->session->userdata('school');
		$employee_school_profile_id = $school_admin[0]['employee_school_profile_id'];
		$school_AY_id = $school_admin[0]['school_AY_id'];
		$data = $this->db->query("SELECT @a:=@a+1 as serial_number,student_GRN,student_name,father_name,father_mobile_number,mother_name,mother_mobile_number from (select student_profile_id,student_GRN,concat(student_last_name,' ',student_first_name,' ',student_middle_name)as student_name,concat(parent_last_name,' ',parent_first_name,' ',parent_middle_name)as father_name,parent_mobile_number as father_mobile_number, parent_type from  student_class_division_assgn join student on SCD_student_profile_id = student_profile_id join parent on student_profile_id = parent_student_profile_id where SCD_AY_id = ".$school_AY_id." and SCD_expiry_date ='9999-12-31' and SCD_school_profile_id = ".$employee_school_profile_id." and parent_type = '1') as father_data,
			(SELECT student_profile_id,concat(parent_last_name,' ',parent_first_name,' ',parent_middle_name)as mother_name,parent_type,parent_mobile_number as mother_mobile_number from  student_class_division_assgn join student on SCD_student_profile_id = student_profile_id join parent on student.student_profile_id = parent.parent_student_profile_id where  SCD_AY_id = ".$school_AY_id." and SCD_expiry_date ='9999-12-31' and SCD_school_profile_id = ".$employee_school_profile_id." and parent_type = '2') as mother_data,(SELECT @a:= 0) AS a where father_data.student_profile_id = mother_data.student_profile_id order by student_GRN")->result();
		echo json_encode($data);
	}

	function contact_class_division_wise_report()
	{
		$school_admin = $this->session->userdata('school');
		$class_id = $_POST['class_id'];
		$school_AY_id = $school_admin[0]['school_AY_id'];
		$employee_school_profile_id = $school_admin[0]['employee_school_profile_id'];
		$data = $this->db->query("SELECT @a:=@a+1 as serial_number,student_GRN,student_name,father_name,father_mobile_number,mother_name,mother_mobile_number from (select student_profile_id,student_GRN,concat(student_last_name,' ',student_first_name,' ',student_middle_name)as student_name,concat(parent_last_name,' ',parent_first_name,' ',parent_middle_name)as father_name,parent_mobile_number as father_mobile_number, parent_type from  student_class_division_assgn join student on SCD_student_profile_id = student_profile_id join parent on student_profile_id = parent_student_profile_id where SCD_class_id = ".$class_id." and SCD_AY_id = ".$school_AY_id." and SCD_expiry_date ='9999-12-31' and SCD_school_profile_id = ".$employee_school_profile_id." and parent_type = '1') as father_data,
			(SELECT student_profile_id,concat(parent_last_name,' ',parent_first_name,' ',parent_middle_name)as mother_name,parent_type,parent_mobile_number as mother_mobile_number from  student_class_division_assgn join student on SCD_student_profile_id = student_profile_id join parent on student.student_profile_id = parent.parent_student_profile_id where SCD_class_id = ".$class_id." and SCD_AY_id = ".$school_AY_id." and SCD_expiry_date ='9999-12-31' and SCD_school_profile_id = ".$employee_school_profile_id." and parent_type = '2') as mother_data,(SELECT @a:= 0) AS a where father_data.student_profile_id = mother_data.student_profile_id order by student_GRN")->result();
		echo json_encode($data);
	}

// ---------------------------------------------------------------- Enquiry Report ---------------------------------------------------------------------------------------------------------
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

// ------------------------------------------------------------------------------------ Fee Reports --------------------------------------------------------------------------------
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
		$report['admission_class'] =  $this->db->query("SELECT enquiry_admission_class FROM `enquiry` where enquiry_school_profile_id =".$employee_school_profile_id." group by enquiry_admission_class")->result_array();
		$report['school'] =  $this->db->query("select school.* from school where school_profile_id =".$employee_school_profile_id."")->result_array();
		$report['fee_category'] =  $this->db->query("SELECT * FROM fee_category where fee_category_expiry_date='9999-12-31' and fee_category_school_profile_id =".$employee_school_profile_id."")->result_array();

		$report['school_report_header'] = $school_admin[0]['school_report_header'];
		$report['school_report_footer'] = $school_admin[0]['school_report_footer'];
		$nav['school_name'] = $school_admin[0]['school_name'];
		$nav['school_logo'] = $school_admin[0]['school_logo'];
		$nav['report'] = 'fee';

		$this->load->view('School/school_header', $admin);
		$this->load->view('Reports/fee_report',$report);
		$this->load->view('Reports/fee_report_footer',$nav);
	}

	function class_division_total_fee_report()
	{
		$school_admin = $this->session->userdata('school');
		$school_id = $school_admin[0]['employee_school_profile_id'];
		$class_id= $_POST['class_id'];
		$division= $_POST['division'];
		$data = $this->db->query("select Student_profile_id,student_GRN,CONCAT(Student_first_name,' ',student_last_name) as student_name,student_gender,parent_profile_id,CONCAT(parent_first_name,' ',parent_last_name) as parent_name ,parent_mobile_number ,case  when class_id is NULL then '0' else class_id end as class_id ,case  when class_name is NULL then 'N/A' else class_name end as class_name ,case  when division_id is NULL then '0' else division_id end as division_id ,case  when division_name is NULL then 'N/A' else division_name end as division_name ,case  when total_fee_amount is NULL then '0' else total_fee_amount end as total_fee_amount ,case  when fee_waiver_amount is NULL then '0' else fee_waiver_amount end as fee_waiver_amount ,case  when fee_amount is NULL then '0' else fee_amount end as fee_amount, case when fee_waiver_amount is NULL and fee_amount is NULL AND total_fee_amount is NULL then '0' when fee_waiver_amount is NULL and fee_amount is NULL then total_fee_amount when fee_waiver_amount is NULL then (total_fee_amount-fee_amount) when fee_amount is NULL then (total_fee_amount-fee_waiver_amount) else (total_fee_amount-fee_waiver_amount-fee_amount) end as balance from student
								join school on student_school_profile_id=school_profile_id left join parent on parent_profile_id=student_parent_id left join student_class_division_assgn on SCD_student_profile_id=student_profile_id and SCD_AY_id=school_AY_id and SCD_expiry_date='9999-12-31' left join class on SCD_class_id=class_id and class_expiry_date='9999-12-31' left join division on SCD_division_id=division_id and division_expiry_date='9999-12-31' left join (select total_fee_student_profile_id,sum(total_fee_amount) as total_fee_amount,total_fee_AY_id from total_fees group by total_fee_student_profile_id) as total_fees on total_fee_student_profile_id=student_profile_id and total_fee_AY_id=school_AY_id left join (select fee_waiver_student_profile_id,sum(fee_waiver_amount) as fee_waiver_amount,fee_waiver_AY_id from fee_waiver group by fee_waiver_student_profile_id) as fee_waiver on fee_waiver_student_profile_id=student_profile_id and fee_waiver_AY_id=school_AY_id left join (select fee_student_profile_id,sum(fee_amount) as fee_amount,fee_AY_id from fee group by fee_student_profile_id) as fee on fee_student_profile_id=student_profile_id and fee_AY_id=school_AY_id where student_school_profile_id=".$school_id." and student_expiry_date='9999-12-31' order by student_GRN")->result();
		echo json_encode($data);		
	}

	function class_all_division_fee_report()
	{
		$school_admin = $this->session->userdata('school');
		$school_id = $school_admin[0]['employee_school_profile_id'];
		$class_id = $_POST['class_id'];
		$data = $this->db->query("select Student_profile_id,student_GRN,CONCAT(Student_first_name,' ',student_last_name) as student_name,student_gender,parent_profile_id,CONCAT(parent_first_name,' ',parent_last_name) as parent_name ,parent_mobile_number ,case  when class_id is NULL then '0' else class_id end as class_id ,case  when class_name is NULL then 'N/A' else class_name end as class_name ,case  when division_id is NULL then '0' else division_id end as division_id ,case  when division_name is NULL then 'N/A' else division_name end as division_name ,case  when total_fee_amount is NULL then '0' else total_fee_amount end as total_fee_amount ,case  when fee_waiver_amount is NULL then '0' else fee_waiver_amount end as fee_waiver_amount ,case  when fee_amount is NULL then '0' else fee_amount end as fee_amount, case when fee_waiver_amount is NULL and fee_amount is NULL AND total_fee_amount is NULL then '0' when fee_waiver_amount is NULL and fee_amount is NULL then total_fee_amount when fee_waiver_amount is NULL then (total_fee_amount-fee_amount) when fee_amount is NULL then (total_fee_amount-fee_waiver_amount) else (total_fee_amount-fee_waiver_amount-fee_amount) end as balance from student
								join school on student_school_profile_id=school_profile_id left join parent on parent_profile_id=student_parent_id left join student_class_division_assgn on SCD_student_profile_id=student_profile_id and SCD_AY_id=school_AY_id and SCD_expiry_date='9999-12-31' left join class on SCD_class_id=class_id and class_expiry_date='9999-12-31' left join division on SCD_division_id=division_id and division_expiry_date='9999-12-31' left join (select total_fee_student_profile_id,sum(total_fee_amount) as total_fee_amount,total_fee_AY_id from total_fees group by total_fee_student_profile_id) as total_fees on total_fee_student_profile_id=student_profile_id and total_fee_AY_id=school_AY_id left join (select fee_waiver_student_profile_id,sum(fee_waiver_amount) as fee_waiver_amount,fee_waiver_AY_id from fee_waiver group by fee_waiver_student_profile_id) as fee_waiver on fee_waiver_student_profile_id=student_profile_id and fee_waiver_AY_id=school_AY_id left join (select fee_student_profile_id,sum(fee_amount) as fee_amount,fee_AY_id from fee group by fee_student_profile_id) as fee on fee_student_profile_id=student_profile_id and fee_AY_id=school_AY_id where student_school_profile_id=".$school_id." and class_id=".$class_id." and student_expiry_date='9999-12-31' order by student_GRN")->result();
		echo json_encode($data);		
	}

	function division_class_total_fee_report()
	{
		$school_admin = $this->session->userdata('school');
		$school_id = $school_admin[0]['employee_school_profile_id'];
		$class_id = $_POST['class_id'];
		$division = $_POST['division'];
		$data = $this->db->query("select Student_profile_id,student_GRN,CONCAT(Student_first_name,' ',student_last_name) as student_name,student_gender,parent_profile_id,CONCAT(parent_first_name,' ',parent_last_name) as parent_name ,parent_mobile_number ,case  when class_id is NULL then '0' else class_id end as class_id ,case  when class_name is NULL then 'N/A' else class_name end as class_name ,case  when division_id is NULL then '0' else division_id end as division_id ,case  when division_name is NULL then 'N/A' else division_name end as division_name ,case  when total_fee_amount is NULL then '0' else total_fee_amount end as total_fee_amount ,case  when fee_waiver_amount is NULL then '0' else fee_waiver_amount end as fee_waiver_amount ,case  when fee_amount is NULL then '0' else fee_amount end as fee_amount, case when fee_waiver_amount is NULL and fee_amount is NULL AND total_fee_amount is NULL then '0' when fee_waiver_amount is NULL and fee_amount is NULL then total_fee_amount when fee_waiver_amount is NULL then (total_fee_amount-fee_amount) when fee_amount is NULL then (total_fee_amount-fee_waiver_amount) else (total_fee_amount-fee_waiver_amount-fee_amount) end as balance from student
								join school on student_school_profile_id=school_profile_id left join parent on parent_profile_id=student_parent_id left join student_class_division_assgn on SCD_student_profile_id=student_profile_id and SCD_AY_id=school_AY_id and SCD_expiry_date='9999-12-31' left join class on SCD_class_id=class_id and class_expiry_date='9999-12-31' left join division on SCD_division_id=division_id and division_expiry_date='9999-12-31' left join (select total_fee_student_profile_id,sum(total_fee_amount) as total_fee_amount,total_fee_AY_id from total_fees group by total_fee_student_profile_id) as total_fees on total_fee_student_profile_id=student_profile_id and total_fee_AY_id=school_AY_id left join (select fee_waiver_student_profile_id,sum(fee_waiver_amount) as fee_waiver_amount,fee_waiver_AY_id from fee_waiver group by fee_waiver_student_profile_id) as fee_waiver on fee_waiver_student_profile_id=student_profile_id and fee_waiver_AY_id=school_AY_id left join (select fee_student_profile_id,sum(fee_amount) as fee_amount,fee_AY_id from fee group by fee_student_profile_id) as fee on fee_student_profile_id=student_profile_id and fee_AY_id=school_AY_id where student_school_profile_id=".$school_id." and class_id=".$class_id." and division_id=".$division." and student_expiry_date='9999-12-31' order by student_GRN")->result();
		echo json_encode($data);		
	}

	function class_division_due_fee_report()
	{
		$school_admin = $this->session->userdata('school');
		$school_id = $school_admin[0]['employee_school_profile_id'];
		$data = $this->db->query("select * from(select Student_profile_id,student_GRN,CONCAT(Student_first_name,' ',student_last_name) as student_name,student_gender,parent_profile_id,CONCAT(parent_first_name,' ',parent_last_name) as parent_name ,parent_mobile_number ,case  when class_id is NULL then '0' else class_id end as class_id ,case  when class_name is NULL then 'N/A' else class_name end as class_name ,case  when division_id is NULL then '0' else division_id end as division_id ,case  when division_name is NULL then 'N/A' else division_name end as division_name ,case  when total_fee_amount is NULL then '0' else total_fee_amount end as total_fee_amount ,case  when fee_waiver_amount is NULL then '0' else fee_waiver_amount end as fee_waiver_amount ,case  when fee_amount is NULL then '0' else fee_amount end as fee_amount, case when fee_waiver_amount is NULL and fee_amount is NULL AND total_fee_amount is NULL then '0' when fee_waiver_amount is NULL and fee_amount is NULL then total_fee_amount when fee_waiver_amount is NULL then (total_fee_amount-fee_amount) when fee_amount is NULL then (total_fee_amount-fee_waiver_amount) else (total_fee_amount-fee_waiver_amount-fee_amount) end as balance from student
								join school on student_school_profile_id=school_profile_id left join parent on parent_profile_id=student_parent_id left join student_class_division_assgn on SCD_student_profile_id=student_profile_id and SCD_AY_id=school_AY_id and SCD_expiry_date='9999-12-31' left join class on SCD_class_id=class_id and class_expiry_date='9999-12-31' left join division on SCD_division_id=division_id and division_expiry_date='9999-12-31' left join (select total_fee_student_profile_id,sum(total_fee_amount) as total_fee_amount,total_fee_AY_id from total_fees group by total_fee_student_profile_id) as total_fees on total_fee_student_profile_id=student_profile_id and total_fee_AY_id=school_AY_id left join (select fee_waiver_student_profile_id,sum(fee_waiver_amount) as fee_waiver_amount,fee_waiver_AY_id from fee_waiver group by fee_waiver_student_profile_id) as fee_waiver on fee_waiver_student_profile_id=student_profile_id and fee_waiver_AY_id=school_AY_id left join (select fee_student_profile_id,sum(fee_amount) as fee_amount,fee_AY_id from fee group by fee_student_profile_id) as fee on fee_student_profile_id=student_profile_id and fee_AY_id=school_AY_id where student_school_profile_id=".$school_id." and student_expiry_date='9999-12-31') as data where balance != 0 order by student_GRN")->result();
		echo json_encode($data);
	}

	function class_all_division_due_fee_report()
	{
		$school_admin = $this->session->userdata('school');
		$school_id = $school_admin[0]['employee_school_profile_id'];
		$class_id = $_POST['class_id'];
		$data = $this->db->query("select * from(select Student_profile_id,student_GRN,CONCAT(Student_first_name,' ',student_last_name) as student_name,student_gender,parent_profile_id,CONCAT(parent_first_name,' ',parent_last_name) as parent_name ,parent_mobile_number ,case  when class_id is NULL then '0' else class_id end as class_id ,case  when class_name is NULL then 'N/A' else class_name end as class_name ,case  when division_id is NULL then '0' else division_id end as division_id ,case  when division_name is NULL then 'N/A' else division_name end as division_name ,case  when total_fee_amount is NULL then '0' else total_fee_amount end as total_fee_amount ,case  when fee_waiver_amount is NULL then '0' else fee_waiver_amount end as fee_waiver_amount ,case  when fee_amount is NULL then '0' else fee_amount end as fee_amount, case when fee_waiver_amount is NULL and fee_amount is NULL AND total_fee_amount is NULL then '0' when fee_waiver_amount is NULL and fee_amount is NULL then total_fee_amount when fee_waiver_amount is NULL then (total_fee_amount-fee_amount) when fee_amount is NULL then (total_fee_amount-fee_waiver_amount) else (total_fee_amount-fee_waiver_amount-fee_amount) end as balance from student
								join school on student_school_profile_id=school_profile_id left join parent on parent_profile_id=student_parent_id left join student_class_division_assgn on SCD_student_profile_id=student_profile_id and SCD_AY_id=school_AY_id and SCD_expiry_date='9999-12-31' left join class on SCD_class_id=class_id and class_expiry_date='9999-12-31' left join division on SCD_division_id=division_id and division_expiry_date='9999-12-31' left join (select total_fee_student_profile_id,sum(total_fee_amount) as total_fee_amount,total_fee_AY_id from total_fees group by total_fee_student_profile_id) as total_fees on total_fee_student_profile_id=student_profile_id and total_fee_AY_id=school_AY_id left join (select fee_waiver_student_profile_id,sum(fee_waiver_amount) as fee_waiver_amount,fee_waiver_AY_id from fee_waiver group by fee_waiver_student_profile_id) as fee_waiver on fee_waiver_student_profile_id=student_profile_id and fee_waiver_AY_id=school_AY_id left join (select fee_student_profile_id,sum(fee_amount) as fee_amount,fee_AY_id from fee group by fee_student_profile_id) as fee on fee_student_profile_id=student_profile_id and fee_AY_id=school_AY_id where student_school_profile_id=".$school_id." and class_id=".$class_id." and student_expiry_date='9999-12-31') as data where balance != 0 order by studen_GRN")->result();
		echo json_encode($data);		
	}

	function division_class_due_fee_report()
	{
		$school_admin = $this->session->userdata('school');
		$school_id = $school_admin[0]['employee_school_profile_id'];
		$class_id = $_POST['class_id'];
		$division_id = $_POST['division_id'];
		$data = $this->db->query("select * from(select Student_profile_id,student_GRN,CONCAT(Student_first_name,' ',student_last_name) as student_name,student_gender,parent_profile_id,CONCAT(parent_first_name,' ',parent_last_name) as parent_name ,parent_mobile_number ,case  when class_id is NULL then '0' else class_id end as class_id ,case  when class_name is NULL then 'N/A' else class_name end as class_name ,case  when division_id is NULL then '0' else division_id end as division_id ,case  when division_name is NULL then 'N/A' else division_name end as division_name ,case  when total_fee_amount is NULL then '0' else total_fee_amount end as total_fee_amount ,case  when fee_waiver_amount is NULL then '0' else fee_waiver_amount end as fee_waiver_amount ,case  when fee_amount is NULL then '0' else fee_amount end as fee_amount, case when fee_waiver_amount is NULL and fee_amount is NULL AND total_fee_amount is NULL then '0' when fee_waiver_amount is NULL and fee_amount is NULL then total_fee_amount when fee_waiver_amount is NULL then (total_fee_amount-fee_amount) when fee_amount is NULL then (total_fee_amount-fee_waiver_amount) else (total_fee_amount-fee_waiver_amount-fee_amount) end as balance from student
								join school on student_school_profile_id=school_profile_id left join parent on parent_profile_id=student_parent_id left join student_class_division_assgn on SCD_student_profile_id=student_profile_id and SCD_AY_id=school_AY_id and SCD_expiry_date='9999-12-31' left join class on SCD_class_id=class_id and class_expiry_date='9999-12-31' left join division on SCD_division_id=division_id and division_expiry_date='9999-12-31' left join (select total_fee_student_profile_id,sum(total_fee_amount) as total_fee_amount,total_fee_AY_id from total_fees group by total_fee_student_profile_id) as total_fees on total_fee_student_profile_id=student_parent_id and total_fee_AY_id=school_AY_id left join (select fee_waiver_student_profile_id,sum(fee_waiver_amount) as fee_waiver_amount,fee_waiver_AY_id from fee_waiver group by fee_waiver_student_profile_id) as fee_waiver on fee_waiver_student_profile_id=student_parent_id and fee_waiver_AY_id=school_AY_id left join (select fee_student_profile_id,sum(fee_amount) as fee_amount,fee_AY_id from fee group by fee_student_profile_id) as fee on fee_student_profile_id=student_profile_id and fee_AY_id=school_AY_id where student_school_profile_id=".$school_id." and class_id=".$class_id." and division_id=".$division_id." and student_expiry_date='9999-12-31 order by GRN') as data where balance != 0")->result();
		echo json_encode($data);		
	}

	function class_division_paid_fee_report()
	{
		$school_admin = $this->session->userdata('school');
		$school_id = $school_admin[0]['employee_school_profile_id'];
		$data = $this->db->query("select * from(select Student_profile_id,student_GRN,CONCAT(Student_first_name,' ',student_last_name) as student_name,student_gender,parent_profile_id,CONCAT(parent_first_name,' ',parent_last_name) as parent_name ,parent_mobile_number ,case  when class_id is NULL then '0' else class_id end as class_id ,case  when class_name is NULL then 'N/A' else class_name end as class_name ,case  when division_id is NULL then '0' else division_id end as division_id ,case  when division_name is NULL then 'N/A' else division_name end as division_name ,case  when total_fee_amount is NULL then '0' else total_fee_amount end as total_fee_amount ,case  when fee_waiver_amount is NULL then '0' else fee_waiver_amount end as fee_waiver_amount ,case  when fee_amount is NULL then '0' else fee_amount end as fee_amount, case when fee_waiver_amount is NULL and fee_amount is NULL AND total_fee_amount is NULL then '0' when fee_waiver_amount is NULL and fee_amount is NULL then total_fee_amount when fee_waiver_amount is NULL then (total_fee_amount-fee_amount) when fee_amount is NULL then (total_fee_amount-fee_waiver_amount) else (total_fee_amount-fee_waiver_amount-fee_amount) end as balance from student join school on student_school_profile_id=school_profile_id left join parent on parent_profile_id=student_parent_id join student_class_division_assgn on SCD_student_profile_id=student_profile_id and SCD_AY_id=school_AY_id and SCD_expiry_date='9999-12-31' join class on SCD_class_id=class_id and class_expiry_date='9999-12-31' left join division on SCD_division_id=division_id and division_expiry_date='9999-12-31' left join (select total_fee_student_profile_id,sum(total_fee_amount) as total_fee_amount,total_fee_AY_id from total_fees group by total_fee_student_profile_id) as total_fees on total_fee_student_profile_id=student_profile_id and total_fee_AY_id=school_AY_id left join (select fee_waiver_student_profile_id,sum(fee_waiver_amount) as fee_waiver_amount,fee_waiver_AY_id from fee_waiver group by fee_waiver_student_profile_id) as fee_waiver on fee_waiver_student_profile_id=student_profile_id and fee_waiver_AY_id=school_AY_id left join (select fee_student_profile_id,sum(fee_amount) as fee_amount,fee_AY_id from fee group by fee_student_profile_id) as fee on fee_student_profile_id=student_profile_id and fee_AY_id=school_AY_id where student_school_profile_id=".$school_id." and student_expiry_date='9999-12-31') as data where balance = 0 order by student_GRN")->result();
		echo json_encode($data);
	}

	function class_all_division_paid_fee_report()
	{
		$school_admin = $this->session->userdata('school');
		$school_id = $school_admin[0]['employee_school_profile_id'];
		$class_id = $_POST['class_id'];
		$data = $this->db->query("select * from(select Student_profile_id,student_GRN,CONCAT(Student_first_name,' ',student_last_name) as student_name,student_gender,parent_profile_id,CONCAT(parent_first_name,' ',parent_last_name) as parent_name ,parent_mobile_number ,case  when class_id is NULL then '0' else class_id end as class_id ,case  when class_name is NULL then 'N/A' else class_name end as class_name ,case  when division_id is NULL then '0' else division_id end as division_id ,case  when division_name is NULL then 'N/A' else division_name end as division_name ,case  when total_fee_amount is NULL then '0' else total_fee_amount end as total_fee_amount ,case  when fee_waiver_amount is NULL then '0' else fee_waiver_amount end as fee_waiver_amount ,case  when fee_amount is NULL then '0' else fee_amount end as fee_amount, case when fee_waiver_amount is NULL and fee_amount is NULL AND total_fee_amount is NULL then '0' when fee_waiver_amount is NULL and fee_amount is NULL then total_fee_amount when fee_waiver_amount is NULL then (total_fee_amount-fee_amount) when fee_amount is NULL then (total_fee_amount-fee_waiver_amount) else (total_fee_amount-fee_waiver_amount-fee_amount) end as balance from student
								join school on student_school_profile_id=school_profile_id left join parent on parent_profile_id=student_parent_id join student_class_division_assgn on SCD_student_profile_id=student_profile_id and SCD_AY_id=school_AY_id and SCD_expiry_date='9999-12-31' join class on SCD_class_id=class_id and class_expiry_date='9999-12-31' left join division on SCD_division_id=division_id and division_expiry_date='9999-12-31' left join (select total_fee_student_profile_id,sum(total_fee_amount) as total_fee_amount,total_fee_AY_id from total_fees group by total_fee_student_profile_id) as total_fees on total_fee_student_profile_id=student_profile_id and total_fee_AY_id=school_AY_id left join (select fee_waiver_student_profile_id,sum(fee_waiver_amount) as fee_waiver_amount,fee_waiver_AY_id from fee_waiver group by fee_waiver_student_profile_id) as fee_waiver on fee_waiver_student_profile_id=student_profile_id and fee_waiver_AY_id=school_AY_id left join (select fee_student_profile_id,sum(fee_amount) as fee_amount,fee_AY_id from fee group by fee_student_profile_id) as fee on fee_student_profile_id=student_profile_id and fee_AY_id=school_AY_id where student_school_profile_id=".$school_id." and class_id=".$class_id." and student_expiry_date='9999-12-31') as data where balance = 0 order by student_GRN")->result();
		echo json_encode($data);		
	}

	function division_class_paid_fee_report()
	{
		$school_admin = $this->session->userdata('school');
		$school_id = $school_admin[0]['employee_school_profile_id'];
		$class_id = $_POST['class_id'];
		$division_id = $_POST['division_id'];
		$data = $this->db->query("select * from(select Student_profile_id,student_GRN,CONCAT(Student_first_name,' ',student_last_name) as student_name,student_gender,parent_profile_id,CONCAT(parent_first_name,' ',parent_last_name) as parent_name ,parent_mobile_number ,case  when class_id is NULL then '0' else class_id end as class_id ,case  when class_name is NULL then 'N/A' else class_name end as class_name ,case  when division_id is NULL then '0' else division_id end as division_id ,case  when division_name is NULL then 'N/A' else division_name end as division_name ,case  when total_fee_amount is NULL then '0' else total_fee_amount end as total_fee_amount ,case  when fee_waiver_amount is NULL then '0' else fee_waiver_amount end as fee_waiver_amount ,case  when fee_amount is NULL then '0' else fee_amount end as fee_amount, case when fee_waiver_amount is NULL and fee_amount is NULL AND total_fee_amount is NULL then '0' when fee_waiver_amount is NULL and fee_amount is NULL then total_fee_amount when fee_waiver_amount is NULL then (total_fee_amount-fee_amount) when fee_amount is NULL then (total_fee_amount-fee_waiver_amount) else (total_fee_amount-fee_waiver_amount-fee_amount) end as balance from student
								join school on student_school_profile_id=school_profile_id left join parent on parent_profile_id=student_parent_id join student_class_division_assgn on SCD_student_profile_id=student_profile_id and SCD_AY_id=school_AY_id and SCD_expiry_date='9999-12-31' join class on SCD_class_id=class_id and class_expiry_date='9999-12-31' left join division on SCD_division_id=division_id and division_expiry_date='9999-12-31' left join (select total_fee_student_profile_id,sum(total_fee_amount) as total_fee_amount,total_fee_AY_id from total_fees group by total_fee_student_profile_id) as total_fees on total_fee_student_profile_id=student_profile_id and total_fee_AY_id=school_AY_id left join (select fee_waiver_student_profile_id,sum(fee_waiver_amount) as fee_waiver_amount,fee_waiver_AY_id from fee_waiver group by fee_waiver_student_profile_id) as fee_waiver on fee_waiver_student_profile_id=student_profile_id and fee_waiver_AY_id=school_AY_id left join (select fee_student_profile_id,sum(fee_amount) as fee_amount,fee_AY_id from fee group by fee_student_profile_id) as fee on fee_student_profile_id=student_profile_id and fee_AY_id=school_AY_id where student_school_profile_id=".$school_id." and class_id=".$class_id." and division_id=".$division_id." and student_expiry_date='9999-12-31') as data where balance = 0 order by student_GRN")->result();
		echo json_encode($data);		
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

	function class_division_waiver_fee_report()
	{
		$school_admin = $this->session->userdata('school');
		$school_id = $school_admin[0]['employee_school_profile_id'];
		$AY_id = $school_admin[0]['AY_id'];
		$data = $this->db->query("select student_GRN,CONCAT(student_first_name,' ',student_last_name) as student_name, CONCAT(parent_first_name,' ',parent_last_name) as parent_name ,student_gender,parent_mobile_number,fee_waiver_name,fee_waiver_amount,fees_type_name,fees_type_amount,class_name,division_name from student join parent on student_parent_id = parent_profile_id left join fee_waiver on fee_waiver_student_profile_id = student_profile_id join fees_type on fee_waiver_fee_type_id = fees_type_id and fees_type_AY_id = fee_waiver_AY_id left join student_class_division_assgn on student_profile_id = SCD_student_profile_id and SCD_AY_id = fee_waiver_AY_id
									left join class on class_id = SCD_class_id left join division on division_id = SCD_division_id where student_expiry_date = '9999-12-31' and fee_waiver_AY_id =".$AY_id." and student_school_profile_id =".$school_id." order by student_GRN")->result();
		echo json_encode($data);
	}

	function class_all_division_waiver_fee_report()
	{
		$school_admin = $this->session->userdata('school');
		$school_id = $school_admin[0]['employee_school_profile_id'];
		$AY_id = $school_admin[0]['AY_id'];
		$class_id = $_POST['class_id'];
		$data = $this->db->query("select student_GRN,CONCAT(student_first_name,' ',student_last_name) as student_name, CONCAT(parent_first_name,' ',parent_last_name) as parent_name ,student_gender,parent_mobile_number,fee_waiver_name,fee_waiver_amount,fees_type_name,fees_type_amount,class_name,division_name from student join parent on student_parent_id = parent_profile_id left join fee_waiver on fee_waiver_student_profile_id = student_profile_id join fees_type on fee_waiver_fee_type_id = fees_type_id and fees_type_AY_id = fee_waiver_AY_id left join student_class_division_assgn on student_profile_id = SCD_student_profile_id and SCD_AY_id = fee_waiver_AY_id
									left join class on class_id = SCD_class_id left join division on division_id = SCD_division_id where student_expiry_date = '9999-12-31' and fee_waiver_AY_id =".$AY_id." and student_school_profile_id =".$school_id." and class_id=".$class_id." order by student_GRN")->result();
		echo json_encode($data);		
	}

	function division_class_waiver_fee_report()
	{
		$school_admin = $this->session->userdata('school');
		$school_id = $school_admin[0]['employee_school_profile_id'];
		$class_id = $_POST['class_id'];
		$division_id = $_POST['division_id'];
		$AY_id = $school_admin[0]['AY_id'];
		$data = $this->db->query("select student_GRN,CONCAT(student_first_name,' ',student_last_name) as student_name, CONCAT(parent_first_name,' ',parent_last_name) as parent_name ,student_gender,parent_mobile_number,fee_waiver_name,fee_waiver_amount,fees_type_name,fees_type_amount,class_name,division_name from student join parent on student_parent_id = parent_profile_id left join fee_waiver on fee_waiver_student_profile_id = student_profile_id join fees_type on fee_waiver_fee_type_id = fees_type_id and fees_type_AY_id = fee_waiver_AY_id left join student_class_division_assgn on student_profile_id = SCD_student_profile_id and SCD_AY_id = fee_waiver_AY_id
									left join class on class_id = SCD_class_id left join division on division_id = SCD_division_id where student_expiry_date = '9999-12-31' and fee_waiver_AY_id = ".$AY_id." and student_school_profile_id=".$school_id." and class_id=".$class_id." and division_id=".$division_id." order by student_GRN")->result();
		echo json_encode($data);		
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
						and fee_school_profile_id = ".$school_id." 
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
			and fee_school_profile_id = ".$school_id." order by student_GRN")->result();
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
		// $report['admission_class'] =  $this->db->query("SELECT enquiry_admission_class FROM `enquiry` where enquiry_school_profile_id =".$employee_school_profile_id." group by enquiry_admission_class")->result_array();
		// $report['school'] =  $this->db->query("select school.* from school where school_profile_id =".$employee_school_profile_id."")->result_array();

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