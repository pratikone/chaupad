<?php

class Youtube_video extends CI_Model {

		public  $id;
		public  $title;
		public  $description;
		public  $thumbnail_small;
		public  $thumbnail_medium;
		public  $thumbnail_high;
		
		//stats
		public $likes, $views, $shares;
		
        public function __construct()
        {
                parent::__construct();
                
        }
        
        public function viewData(){
			$arr = [
					'id'=>$this->id,
					'title'=>$this->title,
					'description'=>$this->description,
					'likes'=>$this->likes,
					'views'=>$this->views,
					'shares'=>$this->shares,
					'thumbnail_small'=>$this->thumbnail_small,
					'thumbnail_medium'=>$this->thumbnail_medium,
					'thumbnail_high'=>$this->thumbnail_high
				   ];
			return $arr;
			
		}
        
        
        
        

}





?>
