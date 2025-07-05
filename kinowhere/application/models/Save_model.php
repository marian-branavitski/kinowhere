<?php 

class Save_model extends CI_Model
{
	
	public function __construct()
	{
		$this->load->database();
	}

	public function getSavedFilms($user_id)
	{
		$query = $this->db
			->where('user_id', $user_id)
			->get('saved');
			
		return $query->result_array();
	}

	public function saveFilm($user_id, $film_id)
	{
		$data = array(
			'user_id' => $user_id,
			'film_id' => $film_id 
		);

		return $this->db->insert('saved', $data);
	}
}