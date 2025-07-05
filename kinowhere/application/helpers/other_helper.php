<?php 

if (!function_exists('getUserNameById')) {
	function getUserNameById($user_id)
	{
		$ci =& get_instance();

		$ci->load->model('dx_auth/users');
		$query = $ci->users->get_user_by_id($user_id);

		$result = $query->row();
		return $result;
	}
}

if (!function_exists('getFilmById')) {
	function getFilmById($film_id)
	{
		$ci =& get_instance();

		$ci->load->model('films_model');
		$query = $ci->films_model->getFilmsById($film_id);

		$result = $query->row();
		return $result;
	}
}

if (!function_exists('show_active_menu')) {
	function show_active_menu($slug)
	{
		$ci =& get_instance();

		$result = "";

		if ($ci->uri->segment(1, 0) === $slug) {
			$result = "class='active'";
		}

		if ($slug === 'library' && $ci->uri->segment(1,0)==='films' && $ci->uri->segment(2,0)==='library') {
			$result = "class='active'";
		}

		if ($slug === 'liked' && $ci->uri->segment(1,0)==='films' && $ci->uri->segment(2,0)==='liked') {
			$result = "class='active'";
		}

		if ($slug === 'watch_later' && $ci->uri->segment(1,0)==='films' && $ci->uri->segment(2,0)==='watch_later') {
			$result = "class='active'";
		}

		return $result;
	}
}

if (!function_exists('check_if_saved')) {
	function check_if_saved($film_id)
	{
		$ci =& get_instance();

		$ci->load->model('watch_model');
		$ci->load->model('dx_auth/users');
		$user_id = $ci->dx_auth->get_user_id();
		$watch_later_item = $ci->watch_model->getSavedFilms($user_id);

		$results = "";

		foreach ($watch_later_item as $key => $value) {
			if ($value['film_id'] === $film_id) {
				$results = True;
			} 
		}

		return $results;

	}
}