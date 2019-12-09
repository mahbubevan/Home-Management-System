<?php

    class Session{
        public static function init(){
            session_start();
        }

        public static function set($key,$value){
            $_SESSION[$key] = $value;
        }

        public static function get($key){
            if(!empty($_SESSION[$key])){
                return $_SESSION[$key];
            }else{
                return false;
            }
        }

        public static function check_session(){
            self::init();
            if(self::get("login")==false){
                self::destroy();
            }
        }

        public static function destroy(){
            session_destroy();
            header('Location:user_login.html');
        }

        public function check_login(){
            self::init();
            if(self::get("login")==true){
                header('Location:index.php');
            }
        }
    }