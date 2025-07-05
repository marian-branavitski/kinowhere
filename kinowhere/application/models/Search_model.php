<?php 

class Search_model extends CI_Model
{
	
	public function search($q, $row_count, $offset)
	{
		$array_search = array(
			'title' => $q,
			'slug' => $q 
		);

		$query = $this->db 
			->or_like($array_search)
			->get('films', $row_count, $offset);

		return $query->result_array();
	}
}