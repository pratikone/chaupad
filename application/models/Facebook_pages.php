<?php

class Facebook_page extends CI_Model {

        
        public $pageIdandToken = [];
        
        
        public function __construct()
        {
                parent::__construct();
                //$videoList = [];
                               
        }

        public function processPageIds( $pagesData )
        {
            foreach(  $formatted['data'] as $page  ){
                    $this->pageIdandToken[ $page['id'] ] = [
                                                            $page['id'],
                                                            $page['access_token']
                                                           ];
            }
        }
        
        
        

}





?>
