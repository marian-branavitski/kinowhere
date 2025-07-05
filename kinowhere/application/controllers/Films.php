<?php 

defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * 
 */
class Films extends CI_Controller
{
	
	public function __construct()
	{
		parent ::__construct();
		$this->load->model('films_model');
	}

	public function index()
	{
		$this->load->helper('url');
		redirect('/films/admin', 'location');
	}

	public function admin($slug=NULL)
	{
		if (!$this->dx_auth->is_admin()) {
			show_404();
		}

		$this->data['title'] = "Films/Admin";
		
		$this->data['films'] = null;

		$this->load->library('pagination');

		$offset = $this->uri->segment(4);
		$row_count = 2;

		if ($slug == "all") {
			$count = count($this->films_model->getFilms());
			$p_config['base_url'] = "/films/admin/all/";
			$this->data['films'] = $this->films_model->getFilmsOnPage($row_count, $offset);
		}

		$p_config['total_rows'] = $count;
		$p_config['per_page'] = $row_count;

		$p_config['full_tag_open'] = "<ul class='pagination pagination-lg'>";
		$p_config['full_tag_close'] ="</ul>";
		$p_config['num_tag_open'] = '<li>';
		$p_config['num_tag_close'] = '</li>';
		$p_config['cur_tag_open'] = "<li class='disabled'><li class='active'><a href='#'>";
		$p_config['cur_tag_close'] = "<span class='sr-only'></span></a></li>";
		$p_config['next_tag_open'] = "<li>";
		$p_config['next_tagl_close'] = "</li>";
		$p_config['prev_tag_open'] = "<li>";
		$p_config['prev_tagl_close'] = "</li>";
		$p_config['first_tag_open'] = "<li>";
		$p_config['first_tagl_close'] = "</li>";
		$p_config['last_tag_open'] = "<li>";
		$p_config['last_tagl_close'] = "</li>";

		//initialise pagination
		$this->pagination->initialize($p_config);
		
		$this->data['pagination'] = $this->pagination->create_links();

		$this->load->view('templates/header', $this->data);
		$this->load->view('films/admin', $this->data);
		$this->load->view('templates/footer');
	}

	public function view($slug=NULL)
	{
		$this->load->model('comments_model');
		$this->load->model('save_model');
		$this->load->model('watch_model');
		$this->load->model('like_model');

		$user_id = $this->dx_auth->get_user_id();
		$this->data['films_item'] = $this->films_model->getFilms($slug);
		$this->data['library_item'] = $this->save_model->getSavedFilms($user_id);
		$this->data['watch_later_item'] = $this->watch_model->getSavedFilms($user_id);
		$this->data['like_item'] = $this->like_model->getLikedFilms($user_id);
		if (empty($this->data['films_item'])) {
			show_404();
		}

		$this->data['is_saved'] = NULL;

		foreach ($this->data['library_item'] as $key => $value) {
			if ($this->data['films_item']['id'] === $value['film_id']) {
				$this->data['is_saved'] = True;
			}
		}

		$this->data['saved_to_watch_later'] = NULL;

		foreach ($this->data['watch_later_item'] as $key => $value) {
			if ($this->data['films_item']['id'] === $value['film_id']) {
				$this->data['saved_to_watch_later'] = True;
			} 
		}

		$this->data['is_liked'] = NULL;

		foreach ($this->data['like_item'] as $key => $value) {
			if ($this->data['films_item']['id'] === $value['film_id']) {
				$this->data['is_liked'] = True;
			}
		}

		$this->data['comments'] = $this->comments_model->getComments($this->data['films_item']['id'], 100);

		$this->data['title'] = $this->data['films_item']['title'];
		$this->data['description'] = $this->data['films_item']['description'];
		$this->data['rating'] = $this->data['films_item']['rating'];
		$this->data['poster'] = $this->data['films_item']['poster'];
		$this->data['vid'] = $this->data['films_item']['vid'];
		$this->data['trailer'] = $this->data['films_item']['trailer'];
		$this->data['release_date'] = $this->data['films_item']['release_date'];
		$this->data['time_added'] = $this->data['films_item']['time_added'];
		$this->data['producer'] = $this->data['films_item']['producer'];
		$this->data['country'] = $this->data['films_item']['country'];
		$this->data['duration'] = $this->data['films_item']['duration'];
		$this->data['category_id'] = $this->data['films_item']['category_id'];
		$this->data['genre_id'] = $this->data['films_item']['genre_id'];
		$this->data['slug'] = $this->data['films_item']['slug'];

		$this->load->view('templates/header', $this->data);
		$this->load->view('films/view', $this->data);
		$this->load->view('templates/footer');
	}

	public function type($slug=NULL)
	{
		$this->load->library('pagination');

		$this->data['films_data'] = null;

		$offset = (int) $this->uri->segment(4);

		$row_count = 3;

		$count = 0;

		if ($slug == "films") {
			$count = count($this->films_model->getFilmsByCategory(1));
			$p_config['base_url'] = "/films/type/films/";
			$this->data['title'] = "Films";
			$this->data['logo'] = "film.png";
			$this->data['films_data'] = $this->films_model->getFilmsByCategoryOnPage($row_count, $offset, 1);
		}

		if ($slug == "serials") {
			$count = count($this->films_model->getFilmsByCategory(2));
			$p_config['base_url'] = "/films/type/serials/";
			$this->data['title'] = "Serials";
			$this->data['logo'] = "serials.png";
			$this->data['films_data'] = $this->films_model->getFilmsByCategoryOnPage($row_count, $offset, 2);
		}

		if ($slug == "family") {
			$count = count($this->films_model->getFilmsByGenre(1));
			$p_config['base_url'] = "/films/type/family/";
			$this->data['title'] = "Family";
			$this->data['logo'] = "family.png";
			$this->data['films_data'] = $this->films_model->getFilmsByGenreOnPage($row_count, $offset, 1);
		}

		if ($slug == "children") {
			$count = count($this->films_model->getFilmsByGenre(2));
			$p_config['base_url'] = "/films/type/children/";
			$this->data['title'] = "Children";
			$this->data['logo'] = "children.png";
			$this->data['films_data'] = $this->films_model->getFilmsByGenreOnPage($row_count, $offset, 2);
		}

		if ($slug == "adults") {
			$count = count($this->films_model->getFilmsByGenre(3));
			$p_config['base_url'] = "/films/type/adults/";
			$this->data['title'] = "Adults";
			$this->data['logo'] = "adults.png";
			$this->data['films_data'] = $this->films_model->getFilmsByGenreOnPage($row_count, $offset, 3);
		}

		if ($slug == "2022") {
			$current_year = date("Y");
			$year = $current_year - 1;
			$count = count($this->films_model->getFilmsByYear($year));
			$p_config['base_url'] = "/films/type/2022/";
			$this->data['title'] = $year;
			$this->data['logo'] = "calendar.png";
			$this->data['films_data'] = $this->films_model->getFilmsByYearOnPage($row_count, $offset, $year);
		}

		if ($slug == "2021") {
			$year = date("Y",strtotime("-2 year"));
			// $prev_year = $year - 1;
			$count = count($this->films_model->getFilmsByYear($year));
			$p_config['base_url'] = "/films/type/2021/";
			$this->data['title'] = $year;
			$this->data['logo'] = "calendar.png"; 
			$this->data['films_data'] = $this->films_model->getFilmsByYearOnPage($row_count, $offset, $year);
		}

		// Pagination config
		$p_config['total_rows'] = $count;
		$p_config['per_page'] = $row_count;

		$p_config['full_tag_open'] = "<ul class='pagination pagination-lg'>";
		$p_config['full_tag_close'] ="</ul>";
		$p_config['num_tag_open'] = '<li>';
		$p_config['num_tag_close'] = '</li>';
		$p_config['cur_tag_open'] = "<li class='disabled'><li class='active'><a href='#'>";
		$p_config['cur_tag_close'] = "<span class='sr-only'></span></a></li>";
		$p_config['next_tag_open'] = "<li>";
		$p_config['next_tagl_close'] = "</li>";
		$p_config['prev_tag_open'] = "<li>";
		$p_config['prev_tagl_close'] = "</li>";
		$p_config['first_tag_open'] = "<li>";
		$p_config['first_tagl_close'] = "</li>";
		$p_config['last_tag_open'] = "<li>";
		$p_config['last_tagl_close'] = "</li>";

		$this->pagination->initialize($p_config);

		$this->data['pagination'] = $this->pagination->create_links();

		$this->load->view('templates/header', $this->data);
		$this->load->view('films/type', $this->data);
		$this->load->view('templates/footer');
	}

	public function create()
	{
		$this->data['title'] = "Add a film";

		if ($this->input->post('title') && $this->input->post('slug') && $this->input->post('description') && $this->input->post('poster') && $this->input->post('trailer') && $this->input->post('release_date') && $this->input->post('time_added') && $this->input->post('rating') && $this->input->post('producer') && $this->input->post('country') && $this->input->post('duration') && $this->input->post('category_id') && $this->input->post('genre_id') && !empty($_FILES['vid'])) {
			
			//Adding video
			$f_name = $_FILES['vid']['name'];
			$target_dir = dirname(__FILE__)."\..\..\upload\\";
			$target_file = $target_dir . basename($_FILES["vid"]["name"]);

			$vid = '/upload/' . basename($_FILES["vid"]["name"]);

			$temp_name = $_FILES['vid']['tmp_name'];

			//Select file type
			$videoFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
			//Valid file extensions
			$extensions_arr = array("mp4", "mov");
			//Check extension
			if (in_array($videoFileType, $extensions_arr)) {
				move_uploaded_file($temp_name, $target_file);					
			}

			$title = $this->input->post('title');
			$slug = $this->input->post('slug');
			$description = $this->input->post('description');
			$poster = $this->input->post('poster');
			$trailer = $this->input->post('trailer');
			$release_date = $this->input->post('release_date');
			$time_added = $this->input->post('time_added');
			$rating = $this->input->post('rating');
			$producer = $this->input->post('producer');
			$country = $this->input->post('country');
			$duration = $this->input->post('duration');
			$category_id = $this->input->post('category_id');
			$genre_id = $this->input->post('genre_id');

			if ($this->films_model->setFilms($title, $slug, $description, $poster, $vid, $trailer, $release_date, $time_added, $rating, $producer, $country, $duration, $category_id, $genre_id)) {
				$this->load->view('templates/header', $this->data);
				$this->load->view('films/success_add', $this->data);
				$this->load->view('templates/footer');
			}
		} else {
			$this->load->view('templates/header', $this->data);
			$this->load->view('films/create', $this->data);
			$this->load->view('templates/footer');	
		}


	}

	public function edit($slug=NULL)
	{
		$this->data['title'] = "Edit film";

		$this->data['film_item'] = $this->films_model->getFilms($slug);

		$this->data['film_title'] = $this->data['film_item']['title'];
		$this->data['film_slug'] = $this->data['film_item']['slug'];
		$this->data['film_description'] = $this->data['film_item']['description'];
		$this->data['film_poster'] = $this->data['film_item']['poster'];
		$this->data['film_trailer'] = $this->data['film_item']['trailer'];
		$this->data['film_release_date'] = $this->data['film_item']['release_date'];
		$this->data['film_time_added'] = $this->data['film_item']['time_added'];
		$this->data['film_rating'] = $this->data['film_item']['rating'];
		$this->data['film_producer'] = $this->data['film_item']['producer'];
		$this->data['film_country'] = $this->data['film_item']['country'];
		$this->data['film_duration'] = $this->data['film_item']['duration'];
		$this->data['film_category'] = $this->data['film_item']['category_id'];
		$this->data['film_genre'] = $this->data['film_item']['genre_id'];

		if ($this->input->post('title') && $this->input->post('slug') && $this->input->post('description') && $this->input->post('poster') && $this->input->post('trailer') && $this->input->post('release_date') && $this->input->post('time_added') && $this->input->post('rating') && $this->input->post('producer') && $this->input->post('country') && $this->input->post('duration') && $this->input->post('category_id') && $this->input->post('genre_id') && !empty($_FILES['vid'])) {
			
			$f_name = $_FILES['vid']['name'];
			$target_dir = dirname(__FILE__)."\..\..\upload\\";
			$target_file = $target_dir . basename($_FILES['vid']['name']);

			$vid = '/upload/' . basename($_FILES['vid']['name']);

			$temp_name = $_FILES['vid']['tmp_name'];

			//Select file type
			$videoFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
			//Valid file extensions
			$extensions_arr = array("mp4", "mov");
			//Check extension
			if (in_array($videoFileType, $extensions_arr)) {
				move_uploaded_file($temp_name, $target_file);					
			}

			$title = $this->input->post('title');
			$slug = $this->input->post('slug');
			$description = $this->input->post('description');
			$poster = $this->input->post('poster');
			$trailer = $this->input->post('trailer');
			$release_date = $this->input->post('release_date');
			$time_added = $this->input->post('time_added');
			$rating = $this->input->post('rating');
			$producer = $this->input->post('producer');
			$country = $this->input->post('country');
			$duration = $this->input->post('duration');
			$category_id = $this->input->post('category_id');
			$genre_id = $this->input->post('genre_id');

			if ($this->films_model->updateFilms($title, $slug, $description, $poster, $vid, $trailer, $release_date, $time_added, $rating, $producer, $country, $duration, $category_id, $genre_id)) {
				$this->data['film_title'] = $title;
				$this->data['film_slug'] = $slug;
				$this->data['film_description'] = $description; 
				$this->data['film_poster'] = $poster;
				$this->data['film_trailer'] = $trailer;
				$this->data['film_release_date'] = $release_date;
				$this->data['film_time_added'] = $time_added;
				$this->data['film_rating'] = $rating;
				$this->data['film_producer'] = $producer;
				$this->data['film_country'] = $country;
				$this->data['film_duration'] = $duration;
				$this->data['film_category'] = $category_id;
				$this->data['film_genre'] = $genre_id;

				$this->load->view('templates/header', $this->data);
				$this->load->view('films/edit_success', $this->data);
				$this->load->view('templates/footer');	
			}
		} else {
			$this->load->view('templates/header', $this->data);
			$this->load->view('films/edit', $this->data);
			$this->load->view('templates/footer');	
		}
	}

	public function delete($slug=NULL)
	{
		$this->data['title'] = "Delete film";

		$this->data['films'] = $this->films_model->getFilms($slug);

		if (empty($this->data['films'])) {
			show_404();
		}

		$this->data['result'] = "An error was encountered while attempting to delete ".$this->data['films']['title'];

		if ($this->films_model->deleteFilms($slug)) {
			$this->data['result'] = $this->data['films']['title']." was deleted successfully!";
		}

		$this->load->view('templates/header', $this->data);
		$this->load->view('films/delete', $this->data);
		$this->load->view('templates/footer');	
	}

	public function comment($slug=NULL)
	{
		$this->load->model('comments_model');

		$this->data['title'] = "Add a comment";
		$this->data['films_item'] = $this->films_model->getFilms($slug);

		$this->data['films_slug'] = $this->data['films_item']['slug'];

		$this->load->helper('date');
		$format = "%Y-%m-%d %h:%i %a";

		if ($this->input->post('text')) {
			$user_id = $this->dx_auth->get_user_id();				
			$time_added = mdate($format);
			$text = $this->input->post('text');
			$film_id = $this->data['films_item']['id'];

			if ($this->comments_model->setComments($user_id, $film_id, $text, $time_added)) {
				$this->data['result'] = "Comment was added successfully";
				$this->load->helper('url');
				redirect('/films/view/'.$this->data['films_slug'], 'location');
			}
			$this->load->view('templates/header', $this->data);
			$this->load->view('films/comment', $this->data);
			$this->load->view('templates/footer');
		}
	}

	public function comment_delete($id=NULL)
	{
		$this->load->model('comments_model');
		$this->data['title'] = "Delete comment";

		$this->data['comment_delete'] = $this->comments_model->getCommentsById($id);

		if (empty($this->data['comment_delete'])) {
			$this->data['result'] = "An error has been accured while attempting to delete the comment. The comment is likely to be missing from the database.";
		}

		$this->data['result'] = "An error has accured while attempting to delete the following comment: ".$this->data['comment_delete']['text'];

		if ($this->comments_model->deleteComments($id)) {
			$this->data['result'] = "The following comment: ".$this->data['comment_delete']['text']." has been successfully removed";
		}

		$this->load->view('templates/header', $this->data);
		$this->load->view('films/comment_delete', $this->data);
		$this->load->view('templates/footer');
	}

	public function save($slug=NULL)
	{
		$this->load->model('save_model');

		$this->data['title'] = "Save to the library";
		$this->data['films_item'] = $this->films_model->getFilms($slug);

		$this->data['films_slug'] = $this->data['films_item']['slug'];

		if (isset($_POST['save_button'])) {
			$user_id = $this->dx_auth->get_user_id();
			$film_id = $this->data['films_item']['id'];

			if ($this->save_model->saveFilm($user_id, $film_id)) {
				$this->data['result'] = "Film was saved successfully";
			}

			$this->load->view('templates/header', $this->data);
			$this->load->view('films/save', $this->data);
			$this->load->view('templates/footer');
		}
	}

	public function library()
	{
		$this->load->model('save_model');

		$this->data['title'] = "Library";

		$user_id = $this->dx_auth->get_user_id();

		$this->data['library_item'] = $this->save_model->getSavedFilms($user_id);

		$this->load->view('templates/header', $this->data);
		$this->load->view('films/library', $this->data);
		$this->load->view('templates/footer');
	}

	public function savetowatch($slug=NULL)
	{
		$this->load->model('watch_model');

		$this->data['title'] = "Save to watch later";

		$this->data['films_item'] = $this->films_model->getFilms($slug);
		$this->data['films_slug'] = $this->data['films_item']['slug'];

		if (isset($_POST['watch_later_button'])) {
			$user_id = $this->dx_auth->get_user_id();
			$film_id = $this->data['films_item']['id'];

			if ($this->watch_model->saveToWatchFilm($user_id, $film_id)) {
				$this->data['result'] = "Film is saved to watch later";
			}

			$this->load->view('templates/header', $this->data);
			$this->load->view('films/savetowatch', $this->data);
			$this->load->view('templates/footer');
		}
	}

	public function watch_later()
	{
		$this->load->model('watch_model');

		$this->data['title'] = "Watch later";

		$user_id = $this->dx_auth->get_user_id();

		$this->data['watch_later_item'] = $this->watch_model->getSavedFilms($user_id);

		$this->load->view('templates/header', $this->data);
		$this->load->view('films/watch_later', $this->data);
		$this->load->view('templates/footer');
	}

	public function remove_watch_later($slug=NULL)
	{
		$this->load->model('watch_model');

		$this->data['title'] = "Remove from watch later";

		$this->data['film_item'] = $this->films_model->getFilms($slug);
		$film_id = $this->data['film_item']['id'];
		$user_id = $this->dx_auth->get_user_id();

		$this->data['result'] = "An error was encountered while attempting to remove this film from your watch later list";

		if ($this->watch_model->removeFromWatchLater($user_id, $film_id)) {
			$this->data['result'] = "Films was successfully removed from your watch later list";
		}

		$this->load->view('templates/header', $this->data);
		$this->load->view('films/remove_watch_later', $this->data);
		$this->load->view('templates/footer');
	}

	public function addlike($slug=NULL)
	{
		$this->load->model('like_model');

		$this->data['title'] = "Add a like";

		$this->data['films_item'] = $this->films_model->getFilms($slug);
		$this->data['films_slug'] = $this->data['films_item']['slug'];

		if (isset($_POST['like_button'])) {
			$user_id = $this->dx_auth->get_user_id();
			$film_id = $this->data['films_item']['id'];

			if ($this->like_model->addLike($user_id, $film_id)) {
				$this->data['result'] = "Film is saved to watch later";
			}

			$this->load->view('templates/header', $this->data);
			$this->load->view('films/addlike', $this->data);
			$this->load->view('templates/footer');
		}

	}

	public function liked()
	{
		$this->load->model('like_model');

		$this->data['title'] = "Liked";

		$user_id = $this->dx_auth->get_user_id();

		$this->data['like_item'] = $this->like_model->getLikedFilms($user_id);

		$this->load->view('templates/header', $this->data);
		$this->load->view('films/liked', $this->data);
		$this->load->view('templates/footer');
	}

	public function remove_like($slug=NULL)
	{
		$this->load->model('like_model');

		$this->data['title'] = "Remove like";

		$this->data['film_item'] = $this->films_model->getFilms($slug);
		$film_id = $this->data['film_item']['id'];
		$user_id = $this->dx_auth->get_user_id();

		$this->data['result'] = "An error was encountered while attempting to remove like from that film";

		if ($this->like_model->removeLike($user_id, $film_id)) {
			$this->data['result'] = "Like was successfully removed";
		}

		$this->load->view('templates/header', $this->data);
		$this->load->view('films/remove_like', $this->data);
		$this->load->view('templates/footer');
	}

	public function download_film($slug=NULL)
	{
		$this->data['films_item'] = $this->films_model->getFilms($slug);
		$this->load->helper('download');

		if (!empty($this->data['films_item']['vid'])) {
			
			$relative_file_path = $this->data['films_item']['vid'];
			$relative_file_path = str_replace('/upload', 'upload', $relative_file_path);
			$relative_file_path = str_replace('/', DIRECTORY_SEPARATOR, $relative_file_path);
			$absolute_file_path = realpath($relative_file_path);

			//$full_file_path = FCPATH . $relative_file_path;

			// var_dump($full_file_path);

			// var_dump($absolute_file_path);
			// echo ".<br>";
			// print_r($relative_file_path);

			// if (file_exists($relative_file_path)) {
			// 	echo "File has been found";
			// } else {
			// 	echo "File not found";
			// }

			if ($absolute_file_path && file_exists($absolute_file_path)) {
				$mime_type = mime_content_type($absolute_file_path);
				header('Content-Type: '.$mime_type);

				header('Content-Disposition: filename="'.basename($absolute_file_path)."'");
				header('Content-Length: '.filesize($absolute_file_path));

				readfile($absolute_file_path);
				exit;
			} else {
				echo "File not found or invalid path ";
				echo $absolute_file_path;
				echo $relative_file_path;
			}
		} else {
			echo "File path not available in the database";
		}

		
	}
}