<?php

class Facebook_single_page extends CI_Model {

        
        public $postList = [];
        public $page_id, $page_access_token;
        
        public function __construct()
        {
                parent::__construct();
                               
        }

        public function processPosts( $postsData )
        {
            foreach(  $postsData['data'] as $post  ){
                    $fb_post = $this->get_fb_post_object();
                    $fb_post->id = $post['id'];
                    $fb_post->message = $post['message'];
                    $this->postList[ $post['id'] ] = $fb_post;   //key value post_id => post object
            }
        }
        
        


        public function get_fb_post_object(){  //for loading facebook_post class for use inside this class
             $CI =& get_instance();
             $CI->load->model('facebook_post');
             return new $CI->facebook_post();
        }
        

}





?>
