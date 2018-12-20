<?php 
	defined('BASEPATH') OR exit('No direct script access allowed');

	class Fee_model extends CI_Model
	{
		function fee_category($fee)
		{
			$this->db->insert('fee_category',$fee);
			return 1; 
		}

		function fee_waiver($fee)
		{
			$this->db->insert('fee_waiver',$fee);
			return 1; 
		}

		function fee_types($fee)
		{ 
			$this->db->insert('fees_type',$fee); 
			return $this->db->insert_id();
		}

		function fetch_fee_category($employee_school_profile_id)
		{
			return $this->db->query("SELECT * FROM fee_category where fee_category_school_profile_id =".$employee_school_profile_id." and fee_category_expiry_date ='9999-12-31'")->result_array();
		}

		function fetch_fee_types($employee_school_profile_id,$school_AY_id)
		{
			return $this->db->query("(select fees_type.*,fee_category_name,case when class_name is NULL then 'All' else class_name end as class_name from class 
						right join fees_type on class_id = fees_type_class_id 
						join fee_category on fee_category_id = fees_type_fee_category_id 
						where fees_type_school_profile_id =".$employee_school_profile_id." and fees_type_expiry_date = '9999-12-31' and fees_type_AY_id = ".$school_AY_id." and fees_type_name IN ('Default') order by fees_type_name)
						union
						(select fees_type.*,fee_category_name,case when class_name is NULL then 'All Class' else class_name end as class_name from class 
						right join fees_type on class_id = fees_type_class_id 
						join fee_category on fee_category_id = fees_type_fee_category_id 
						where fees_type_school_profile_id =".$employee_school_profile_id." and fees_type_expiry_date = '9999-12-31' and fees_type_AY_id = ".$school_AY_id." and fees_type_name NOT IN ('Default') order by fees_type_name)")->result_array();
		}

		function fetch_fee_waiver($employee_school_profile_id,$school_AY_id)
		{
			return $this->db->query("SELECT * FROM fee_waiver join student on fee_waiver_student_profile_id = student_profile_id join fees_type on fees_type_id = fee_waiver_fee_type_id join fee_category on fee_category_id = fees_type_fee_category_id join student_class_division_assgn on SCD_student_profile_id = student_profile_id join class on class_id = SCD_class_id where fee_waiver_AY_id =".$school_AY_id." and fee_waiver_school_profile_id =".$employee_school_profile_id."")->result_array();
		}

		function fetch_fee_types_detials($fees_type_id)
		{
			return $this->db->query("SELECT fees_type.*,fee_category_name,case when class_name is null then 'All Class' else class_name end as class_name from class right join fees_type on class_id = fees_type_class_id join fee_category on fees_type_fee_category_id = fee_category_id where fees_type_id=".$fees_type_id."")->result_array();
		}

		function update_fee_types($fee)
		{
			$this->db->set('fees_type_amount',$fee['fees_type_amount'])->where('fees_type_id',$fee['fees_type_id'])->update('fees_type');
			$this->db->set('total_fee_amount',$fee['fees_type_amount'])->where('total_fee_type_id',$fee['fees_type_id'])->update('total_fees');
			return 1;
		}

		function delete_fees_details($fees_type_id)
		{
			$this->db->query("DELETE FROM `fees_type` where fees_type_id = ".$fees_type_id."");
			$this->db->query("DELETE FROM `total_fees` where total_fee_type_id = ".$fees_type_id."");
		}

		function fetch_class_division($class)
		{
			return $this->db->query("SELECT * FROM student_class_division_assgn join division on SCD_division_id = division_id where SCD_class_id =".$class['class_id']." and SCD_school_profile_id =".$class['employee_school_profile_id']." and SCD_expiry_date = '9999-12-31' group by SCD_division_id")->result_array();
		}

		function fetch_class_division_student($student)
		{
			return $this->db->query("SELECT * FROM `student_class_division_assgn` join student on SCD_student_profile_id = student_profile_id where SCD_class_id =".$student['class_id']." and SCD_school_profile_id =".$student['employee_school_profile_id']." and SCD_expiry_date = '9999-12-31'")->result_array();
		}

		function fetch_division_class_student($student)
		{
			return $this->db->query("SELECT * FROM `student_class_division_assgn` join student on SCD_student_profile_id = student_profile_id where SCD_class_id =".$student['class_id']." and SCD_division_id =".$student['division_id']." and SCD_school_profile_id =".$student['employee_school_profile_id']." and SCD_expiry_date = '9999-12-31'")->result_array();
		}

		function fetch_student_payments($payment)
		{
			return $this->db->query("SELECT fee_category_name,total_fee_type_id ,case when fees_type_name='Default' then 'All' else fees_type_name end as fees_type_name,total_fee_amount,case  when fee_waiver_name is NULL then '-' else fee_waiver_name end as fee_waiver_name,case  when fee_waiver_amount is NULL then '0' else fee_waiver_amount end as fee_waiver_amount from student 
									join school on student_school_profile_id=school_profile_id left join total_fees on total_fee_student_profile_id=student_profile_id and total_fee_AY_id=school_AY_id left join fees_type on total_fee_type_id=fees_type_id and fees_type_AY_id=school_AY_id left join fee_waiver on fee_waiver_student_profile_id=student_profile_id 
									and fee_waiver_AY_id=school_AY_id and total_fee_type_id=fee_waiver_fee_type_id join fee_category on fee_category_id = fees_type_fee_category_id where student_profile_id=".$payment['student_profile_id']." and student_school_profile_id=".$payment['employee_school_profile_id']." and student_expiry_date='9999-12-31' order by fees_type_name")->result_array();
		}

		function fetch_student_total_payments($payment)
		{
			return $this->db->query("SELECT Student_profile_id,student_total_advance_payment,case  when total_fee_amount is NULL then '0' else total_fee_amount end as total_fee_amount , case  when fee_waiver_amount is NULL then '0' else fee_waiver_amount end as fee_waiver_amount , case  when fee_amount is NULL then '0' else fee_amount end as fee_amount , case when fee_waiver_amount is NULL and fee_amount is NULL and total_fee_amount is Null then '0' when fee_waiver_amount is NULL and fee_amount is NULL then (total_fee_amount-student_total_advance_payment) when fee_waiver_amount is NULL then (total_fee_amount-fee_amount-student_total_advance_payment) when fee_amount is NULL then (total_fee_amount-fee_waiver_amount-student_total_advance_payment) else (total_fee_amount-fee_waiver_amount-fee_amount-student_total_advance_payment) end as balance from student join school on student_school_profile_id=school_profile_id left join (select total_fee_student_profile_id,sum(total_fee_amount) as total_fee_amount,total_fee_AY_id from total_fees group by total_fee_student_profile_id) as total_fees on total_fee_student_profile_id=student_profile_id and total_fee_AY_id=school_AY_id left join (select fee_waiver_student_profile_id,sum(fee_waiver_amount) as fee_waiver_amount,fee_waiver_AY_id from fee_waiver group by fee_waiver_student_profile_id) as fee_waiver on fee_waiver_student_profile_id=student_profile_id and fee_waiver_AY_id=school_AY_id left join (select fee_student_profile_id,sum(fee_amount) as fee_amount,fee_AY_id from fee group by fee_student_profile_id) as fee on fee_student_profile_id=student_profile_id and fee_AY_id=school_AY_id where student_school_profile_id=".$payment['employee_school_profile_id']." and student_profile_id=".$payment['student_profile_id']." and student_expiry_date='9999-12-31'")->result_array();
		}

		function add_student_payment($payment)
		{
			$this->db->insert('fee',$payment);
			return 1;
		}

		function add_advance_student_payment($payment)
		{
			$this->db->insert('advance_payment',$payment);
			// return $payment;
		}

		function payment_history($PH)
		{
			return $this->db->query("SELECT * from (SELECT 
					concat('FR-',fee_id) as fee_receipt_id
					,fee_id
					,'0' as type
					,'Regular Fee' as type_name
					,fee_datetime
					,fee_student_profile_id
					,fee_amount
					,fee_payment_mode
					,fee_transaction_number
					,fee_AY_id
					,fee_narration
					,fee_school_profile_id
				FROM fee 
				where fee_student_profile_id=".$PH['student_profile_id']." 
				and fee_AY_id=".$PH['fee_AY_id']." 
				and fee_school_profile_id=".$PH['fee_school_profile_id']."
				union all
				SELECT 	
					concat('AR-',advance_id) as fee_receipt_id
					,advance_id  as fee_id
					,'1' as type
					,'Advance Fee' as type_name
					,advance_datetime as fee_datetime
					,advance_student_profile_id as fee_student_profile_id
					,advance_amount as fee_amount
					,advance_payment_mode as fee_payment_mode
					,advance_transaction_number as fee_transaction_number
					,advance_AY_id as fee_AY_id
					,advance_narration as fee_narration
					,advance_school_profile_id as fee_school_profile_id
				FROM advance_payment
				where advance_student_profile_id=".$PH['student_profile_id']." 
				and advance_AY_id=".$PH['fee_AY_id']." 
				and advance_school_profile_id=".$PH['fee_school_profile_id']."
				) as data order by fee_datetime")->result_array();
		}

		function advance_payment_history($PH)
		{
			return $this->db->query("SELECT advance_payment.*,student_total_advance_payment FROM advance_payment join student on advance_student_profile_id = student_profile_id where advance_student_profile_id=".$PH['student_profile_id']." and advance_school_profile_id=".$PH['advance_school_profile_id']."")->result_array();
		}
	}
 ?>