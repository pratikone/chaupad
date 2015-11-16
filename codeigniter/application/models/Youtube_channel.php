<?php

class Youtube_channel extends CI_Model {

		public $videoList = [];
		
        public function __construct()
        {
                parent::__construct();
                //$videoList = [];
                               
        }
        
        
        public function addVideo( $videoData ){
			array_push( $this->videoList, $videoData );
			
		}
		
		public function processResponse( $response ){
			foreach( $response->getrows() as $row){
		  		//echo sprintf(" <p>This data is weird : %s  %d  %s %d </p>", $response->getColumnHeaders()[0]['name'], $row[1], $response->getColumnHeaders()[1]['name'], $row[2]);
		  	
		  	
		  		$video = $this->get_video_object();
		  		$video->id = $row[0];
		  		$video->likes = $row[1];
		  		$video->views = $row[2];
		  		
		  		$this->addVideo( $video );
			}
		}
		
		public function viewVideoData(){
			$response = [];
			foreach( $this->videoList as $video ){
				array_push( $response,  $video->viewData());
			}
			
			return $response;
		}
        
        public function get_video_object(){  //for loading youtube_video class for use inside this class
			 $CI =& get_instance();
			 $CI->load->model('youtube_video');
			 return new $CI->youtube_video();
		}

}





?>
