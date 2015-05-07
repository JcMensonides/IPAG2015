<?php
class Categories extends CI_Controller {

        public function __construct()
        {
                parent::__construct();
                $this->load->model('news_model');
                $this->load->model('Categories_model');
        }

		public function index()
		{
		        $this->load->view('templates/login');
        		$this->load->view('templates/header');
        		//$this->load->view('categories/view', $data);
        		$this->load->view('templates/footer');
		}

		public function view($slug = NULL)
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
		
		function ExistCategorie($Categorie)
		{
			if($this->Categories_model->ExistCategorie($Categorie)) {
				$this->form_validation->set_message('ExistCategorie', 'La categorie existe pas');
				return TRUE;
			}
			else {
				$this->form_validation->set_message('ExistCategorie', 'La categorie n\'existe pas');
				return FALSE;
		}
		function CreateCategorie($Categorie) 
		{
			$this->Categories_model->CreateCategorie($Categorie);
			$this->load->view('categories/categories_ajout');
		}
	}
}