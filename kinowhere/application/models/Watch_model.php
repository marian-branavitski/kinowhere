<?php 

class Watch_model extends CI_Model
{
	
	public function __construct()
	{
		$this->load->database();
	}

	public function getSavedFilms($user_id)
	{
		$query = $this->db
			->where('user_id', $user_id)
			->get('watchlater');
			
		return $query->result_array();
	}

	public function saveToWatchFilm($user_id, $film_id)
	{
		$data = array(
			'user_id' => $user_id,
			'film_id' => $film_id 
		);

		return $this->db->insert('watchlater', $data);
	}

	public function removeFromWatchLater($user_id, $film_id)
	{
		$data = array(
			'user_id' => $user_id,
			'film_id' => $film_id 
		);

		return $this->db->delete('watchlater', $data);
	}
}