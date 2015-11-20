<?php

class Youtube_channel extends CI_Model {

		public $videoList = [];
		
        public function __construct()
        {
                parent::__construct();
                //$videoList = [];
                               
        }
        
        
        public function addVideo( $videoData ){
			$this->videoList[$videoData->id] = $videoData; //key value array
			
		}
		
		public function processAnalyticsResponse( $response ){
			foreach( $response->getrows() as $row){
		  		//echo sprintf(" <p>This data is weird : %s  %d  %s %d </p>", $response->getColumnHeaders()[0]['name'], $row[1], $response->getColumnHeaders()[1]['name'], $row[2]);
		  		$video = $this->get_video_object();
		  		$video->id = $row[0];	//video id can be used for youtube.com?v=id
		  		$video->likes = $row[1];
		  		$video->views = $row[2];
		  		$video->shares = $row[3];
		  		$video->comments = $row[4];
		  		
		  		$this->addVideo( $video );
			}
		}
		
		//to be always called after processAnalyticsResponse as objects are not created here
		public function processVideoIds( $response ){
			foreach( $response->getitems() as $item){ //adding values to each video entry
		  		$video = $this->videoList[ $item["id"] ]; //finding video by id in key value array
		  		$video->title = $item["snippet"]["title"];
		  		$video->description = $item["snippet"]["description"];
		  		$video->thumbnail_small = $item["snippet"]["thumbnails"]["default"]["url"];
		  		$video->thumbnail_medium = $item["snippet"]["thumbnails"]["medium"]["url"];
		  		$video->thumbnail_high = $item["snippet"]["thumbnails"]["high"]["url"];
			}
		}		
		
		
		public function viewVideoData(){
			$response = [];
			foreach( $this->videoList as $video ){
				array_push( $response,  $video->viewData());
			}
			
			return $response;
		}
        
        public function getVideoIds(){  //returns video  id in form of comma separated stringd
			$str = "";
			
			foreach( $this->videoList as $video ){
				$str .= $video->id.",";
			}
			
			$str = rtrim( $str, ',' ); //right trim
			
			return $str; //to be consumed by api to find video data from Youtube Data API
		}
        
        
        
        public function get_video_object(){  //for loading youtube_video class for use inside this class
			 $CI =& get_instance();
			 $CI->load->model('youtube_video');
			 return new $CI->youtube_video();
		}

}





?>
