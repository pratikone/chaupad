<?php

class Youtube_channel extends CI_Model {

		public $videoList = [];
		public $monthlyChannelList = [];
		public $email, $name, $picture, $profile_link;
		public $subscribersData = [];
		public $countryViews = [];
		//stats
		public $channel_likes, $channel_views, $channel_shares, $channel_comments;

		
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
		
		//this api does not support multiple channels under the same username. Should be fixed later as low priority
		public function processChannelResponse( $response ){
			foreach( $response->getrows() as $row){
		  		//echo sprintf(" <p>This data is weird : %s  %d  %s %d </p>", $response->getColumnHeaders()[0]['name'], $row[1], $response->getColumnHeaders()[1]['name'], $row[2]);
		  		$this->channel_likes = $row[0];	//video id can be used for youtube.com?v=id
		  		$this->channel_views = $row[1];
		  		$this->channel_shares = $row[2];
		  		$this->channel_comments = $row[3];
			}
		}

		public function processChannelCountriesResponse( $response ){
			
			foreach( $response->getrows() as $row){
		  		//echo sprintf(" <p>This data is weird : %s  %d  %s %d </p>", $response->getColumnHeaders()[0]['name'], $row[1], $response->getColumnHeaders()[1]['name'], $row[2]);
		  		$this->countryViews[$row[0]] = $row[1];  // IN =>1241
			}

			return $this->countryViews;
		}
		
		
		public function processChannelSubscribersResponse( $response ){
			if($response->getrows() == null)
				return;

			foreach( $response->getrows() as $row){
		  		//echo sprintf(" <p>This data is weird : %s  %d  %s %d </p>", $response->getColumnHeaders()[0]['name'], $row[1], $response->getColumnHeaders()[1]['name'], $row[2]);
		  		$this->subscribersData[$row[0]] = [		   // Y-m-d time
		  										$row[1],  //subscribers gained
		  										$row[2]	  //subscribers lost
		  											];
			}
		}


		public function processChannelMonthlyResponse( $response ){
			//print_r($response);
			foreach( $response->getrows() as $row){
		  		//echo sprintf(" <p>This data is weird : %s  %d  %s %d </p>", $response->getColumnHeaders()[0]['name'], $row[1], $response->getColumnHeaders()[1]['name'], $row[2]);
		  		$this->monthlyChannelList[ $row[0] ] = [
		  												$row[1],
		  												$row[2],
		  												$row[3]
		  											 ]; //likes,shares,views
			}
			
		}

		public function processGoogleProfileResponse( $response ){
			$this->email = $response->email;
			$this->name = $response->name;
			$this->profile_link = $response->link;
			$this->picture = $response->picture;	
		}


		public function viewChannelData(){
			$arr = [
					'likes'=>$this->channel_likes,
					'views'=>$this->channel_views,
					'shares'=>$this->channel_shares,
					'comments'=>$this->channel_comments,
				   ];
			return $arr;
		}

		public function viewChannelSubscribersData(){
			return $this->subscribersData;
		}
        
		        

		public function viewGoogleProfileData(){
			$arr = [
					'email'=>$this->email,
					'name'=>$this->name,
					'profile_link'=>$this->profile_link,
					'picture'=>$this->picture,
				   ];
			return $arr;
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
