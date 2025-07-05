<?php 

class Comments_model extends CI_Model
{
	
	public function __construct()
	{
		$this->load->database();
	}

	public function getComments($film_id, $limit)
	{
		$query = $this->db
			->where('film_id', $film_id)
			->limit($limit)
			->order_by('time_added', 'desc')
			->get('comments');

		return $query->result_array(); 
	}

	public function getCommentsById($id)
	{
		$query = $this->db
			->where('id', $id)
			->get('comments');

		return $query->row_array();
	}

	public function setComments($user_id, $film_id, $text, $time_added)
	{
		$data = array(
			'user_id' => $user_id,
			'film_id' => $film_id,
			'text' => $text,
			'time_added' => $time_added
		);

		return $this->db->insert('comments', $data);
	}

	public function deleteComments($id)
	{
		return $this->db->delete('comments', array('id' => $id));
	}
}