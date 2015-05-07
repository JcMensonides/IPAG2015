<?php
class News extends CI_Controller {

        public function __construct()
        {
                parent::__construct();
                $this->load->model('news_model');
        }

		public function index()
		{
		        $data['news'] = $this->news_model->get_news();
		        $data['title'] = 'News archive';
		
		        $this->load->view('templates/login');
		        $this->load->view('templates/header', $data);
		        $this->load->view('news/index', $data);
		        $this->load->view('templates/footer');
		}


public function view()

{
        $data['news_item'] = $this->news_model->get_news($slug);

        if (empty($data['news_item']))
        {
        		echo "c'est vide";
                show_404();
        }

        $data['title'] = $data['news_item']['Boursier'];




        $this->load->view('templates/header', $data);
        $this->load->view('news/view', $data);
        $this->load->view('templates/footer');
}
}