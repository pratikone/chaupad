<?php

class Facebook_post extends CI_Model {

        
        public $id;
        public $message;
        
        
        
        public function __construct()
        {
                parent::__construct();
                               
        }

        public function processPostData( $postData )
        {
            foreach(  $postData['data'] as $post  ){
                    $this->postList[ $post['id'] ] = [
                                                            $page['id'],
                                                            $page['access_token']
                                                           ];
            }
        }
        
        
        

}





?>
