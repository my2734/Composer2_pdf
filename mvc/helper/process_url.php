<?php 
    class process_url{
        public function is_page($url){
            $pos = strpos($url ,'page');
            if ($pos !== false) {  
                return json_encode(true);
            } else {
                return json_encode(false);
            }
        }

        public function index_page($url){
            $find_string_page = explode('/',$url)[2];
            $number_page_index = (int)explode('=',$find_string_page)[1];
            return json_encode($number_page_index);
        }
    }
?>