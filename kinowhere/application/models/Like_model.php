<?php 

class Like_model extends CI_Model
{
	
	public function __construct()
	{
		$this->load->database();
	}

	public function getLikedFilms($user_id)
	{
		$query = $this->db
			->where('user_id', $user_id)
			->get('liked');
			
		return $query->result_array();
	}

	public function addLike($user_id, $film_id)
	{
		$data = array(
			'user_id' => $user_id,
			'film_id' => $film_id 
		);

		return $this->db->insert('liked', $data);
	}

	public function removeLike($user_id, $film_id)
	{
		$data = array(
			'user_id' => $user_id,
			'film_id' => $film_id 
		);

		return $this->db->delete('liked', $data);
	}
}