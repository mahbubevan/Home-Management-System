<?php

    class Format{
        
        public function format_date($date){
            return date('F j,Y,g:i a',strtotime($date));
        }

        public function validation($data){
            $data = trim($data);
            $data = stripcslashes($data);
            $data = htmlspecialchars($data);

            return $data;
        }

    }