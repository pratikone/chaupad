<?php

class Facebook_pages extends CI_Model {

        
        public $pageIdandToken = [];
        
        
        public function __construct()
        {
                parent::__construct();
                //$videoList = [];
                               
        }

        public function processPageIds( $pagesData )
        {
            foreach(  $pagesData['data'] as $page  ){
                    $fb_page = $this->get_fb_page_object();
                    $fb_page->page_id = $page['id'];
                    $fb_page->page_access_token = $page['access_token'];
                    $fb_page->page_name = $page['name'];

                    $this->pageIdandToken[ $page['id'] ] = $fb_page;
            }
        }
        
        
        public function get_fb_page_object(){  //for loading facebook_page class for use inside this class
             $CI =& get_instance();
             $CI->load->model('facebook_single_page');
             return new $CI->facebook_single_page();
        }

}





?>
