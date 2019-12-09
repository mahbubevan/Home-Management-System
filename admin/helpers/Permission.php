<?php
    class Permission{
        public static function owner(){
            if(Session::get('status')==1){
                echo "<script>window.location='index.php'</script>";            
            }else{
    
            }
        }

        public static function varatia_profile_check(){
            if(Session::get('status')==1){
                return true;
            }

        return false;
        }
        
    }

//var_dump(Permission::owner());