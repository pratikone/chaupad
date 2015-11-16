<?php

class Youtube_video extends CI_Model {

		public  $id;
		public  $title;
		public  $description;
		public  $thumbnail_small;
		public  $thumbnail_mid;
		public  $thumbnail_big;
		
		//stats
		public $likes, $views;
		
        public function __construct()
        {
                parent::__construct();
                
        }
        
        public function viewData(){
			$str = " video id=$this->id title=$this->title description=$this->description likes=$this->likes views=$this->views thumbnail_small=$this->thumbnail_small thumbnail_mid=$this->thumbnail_mid thumbnail_big=$this->thumbnail_big ";
			return $str;
			
		}
        
        
        
        

}





?>
