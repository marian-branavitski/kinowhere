<?php 

class Films_model extends CI_Model
{
	
	public function __construct()
	{
		$this->load->database();
	}

	public function getFilms($slug=FALSE)
	{
		if ($slug === FALSE) {
			$query = $this->db->get('films');
			return $query->result_array();
		}

		$query = $this->db->get_where('films', array('slug'=>$slug));
		return $query->row_array();
	}

	public function getFilmsById($film_id)
	{
		$this->db->select('*');
		$this->db->from('films');
		$this->db->where('id', $film_id);
		$query = $this->db->get();
		return $query;
	}

	public function getLimitedFilms($slug=FALSE, $limit=4)
	{
		if ($slug === FALSE) {
			$query = $this->db
				->order_by('time_added', 'desc')
				->limit($limit)
				->get('films');
			return $query->result_array();
		}

		$query = $this->db->get_where('films', array('slug'=>$slug));
		return $query->row_array();
	}

	public function getFilmsByRating($limit=2)
	{
		$query = $this->db
			->order_by('release_date', 'desc')
			->order_by('rating','desc')
			->limit($limit)
			->get('films');

		return $query->result_array();
	}

	public function getFilmsByCategory($type=1)
	{
		$query = $this->db 
			->order_by('release_date', 'desc')
			->order_by('rating', 'desc')
			->where('category_id', $type)
			->get('films');

		return $query->result_array();
	}

	public function getFilmsOnPage($row_count, $offset)
	{
		$query = $this->db 
			->order_by('release_date', 'desc')
			->order_by('rating', 'desc')
			->get('films', $row_count, $offset);

		return $query->result_array();
	}

	public function getFilmsByCategoryOnPage($row_count, $offset, $type=1)
	{
		$query = $this->db 
			->order_by('release_date', 'desc')
			->order_by('rating', 'desc')
			->where('category_id', $type)
			->get('films', $row_count, $offset);

		return $query->result_array();
	}

	public function getFilmsByGenre($type=1)
	{
		$query = $this->db 
			->order_by('release_date', 'desc')
			->order_by('rating', 'desc')
			->where('genre_id', $type)
			->get('films');

		return $query->result_array();
	}

	public function getFilmsByGenreOnPage($row_count, $offset, $type=1)
	{
		$query = $this->db 
			->order_by('release_date', 'desc')
			->order_by('rating', 'desc')
			->where('genre_id', $type)
			->get('films', $row_count, $offset);

		return $query->result_array();
	}

	public function getFilmsByYear($year)
	{
		$query = $this->db 
			// ->order_by('rating', 'desc')
			// ->order_by('time_added', 'desc')
			->where('release_date', $year)
			->get('films');

		return $query->result_array();
	}

	public function getFilmsByYearOnPage($row_count, $offset, $year)
	{
		$query = $this->db 
			// ->order_by('rating', 'desc')
			// ->order_by('time_added', 'desc')
			->where('release_date', $year)
			->get('films', $row_count, $offset);

		return $query->result_array();
	}

	public function setFilms($title, $slug, $description, $poster, $vid, $trailer, $release_date, $time_added, $rating, $producer, $country, $duration, $category_id, $genre_id)
	{
		$data = array(
			'title' => $title,
			'slug' => $slug,
			'description' => $description,
			'poster' => $poster,
			'vid' => $vid,
			'trailer' => $trailer,
			'release_date' => $release_date,
			'time_added' => $time_added,
			'rating' => $rating,
			'producer' => $producer,
			'country' => $country,
			'duration' => $duration,
			'category_id' => $category_id,
			'genre_id' => $genre_id 
		);

		return $this->db->insert('films', $data);
	}

	public function updateFilms($title, $slug, $description, $poster, $vid, $trailer, $release_date, $time_added, $rating, $producer, $country, $duration, $category_id, $genre_id)
	{
		$data = array(
			'title' => $title,
			'slug' => $slug,
			'description' => $description,
			'poster' => $poster,
			'vid' => $vid,
			'trailer' => $trailer,
			'release_date' => $release_date,
			'time_added' => $time_added,
			'rating' => $rating,
			'producer' => $producer,
			'country' => $country,
			'duration' => $duration,
			'category_id' => $category_id,
			'genre_id' => $genre_id 
		);

		return $this->db->update('films', $data, array('slug' => $slug));
	}

	public function deleteFilms($slug)
	{
		return $this->db->delete('films', array('slug' => $slug));
	}
}