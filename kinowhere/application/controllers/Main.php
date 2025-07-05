<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Main extends MY_Controller
{
	
	public function __construct()
	{
		parent::__construct();
		$this->load->model('films_model');
	}

	public function index()
	{
		$this->data['title'] = "Home page";

		$this->data['film'] = $this->films_model->getLimitedFilms(false, 4);
		$this->data['film_by_rating'] = $this->films_model->getFilmsByRating(2);

		$this->load->view('templates/header', $this->data);
		$this->load->view('main/index', $this->data);
		$this->load->view('templates/footer');
	}
}