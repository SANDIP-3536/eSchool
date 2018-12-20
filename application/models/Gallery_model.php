<?php 
/**
* 
*/
class Gallery_model extends CI_Model
{
	function image_gallery($school_AY_id,$employee_school_profile_id)
	{
		$query = 'SELECT gallery_datetime,gallery_big,gallery_album_name,COUNT(*) as total FROM gallery WHERE gallery_school_profile_id ='.$employee_school_profile_id.' GROUP by gallery_album_name';
		return $this->db->query($query)->result_array();
	}

	function gallery($data)
	{
		$this->db->insert('gallery',$data);
	}

	function gallery_cat($data)
	{
		$query = 'SELECT gallery_datetime,gallery_big,gallery_album_name  FROM gallery WHERE gallery_school_profile_id ='.$data['school_id'].' AND gallery_album_name="'.$data['image_cat'].'"';
		return $this->db->query($query)->result_array();
	}

	function image_gallery_album($school_AY_id,$employee_school_profile_id)
	{
		return $this->db->query("SELECT gallery_album_name FROM gallery where gallery_school_profile_id=".$employee_school_profile_id." group by gallery_album_name")->result_array();
	}
}
 ?>