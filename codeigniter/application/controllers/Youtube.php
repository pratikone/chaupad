<?php

class Youtube extends CI_Controller{

	public function view($page = 'home'){
		$loc = APPPATH.'/views/pages/'.$page.'.php';
		if( !file_exists( $loc )){
			echo $loc;	
			show_404();
		}

	$data['title'] = ucfirst($page); //Capitalize it bitch

	$this->load->view('templates/header', $data );
	$this->load->view('pages/'.$page, $data);
	$this->load->view('templates/footer', $data);

	}
	
        public function analytics(){
		if (isset($_SESSION['access_token']) && $_SESSION['access_token']) {
		
		}
		else
		{		
			$this->load->view('youtube/login.php');
		}

        }     


}
