<?php
    include 'lib/Session.php';
    Session::check_login();
    include 'config/config.php';
    include 'lib/Database.php';
    include 'helpers/Format.php';

    $db = new Database();
    $fm = new Format();

    if($_SERVER['REQUEST_METHOD']=='POST'){
        //var_dump($_POST['password']);
        if(empty($_POST['username'])){
            echo '<span class="text-danger text-lg">Username Required</span>';
        }elseif(empty($_POST['password'])){
            echo '<span class="text-danger text-lg">Password Required</span>';
        }else{
            $username = $fm->validation($_POST['username']);
            $password = $fm->validation($_POST['password']);

            $username = mysqli_real_escape_string($db->connectDB(),$username);
            $password = mysqli_real_escape_string($db->connectDB(),$password);

            $query = "SELECT * FROM `user` 
                        WHERE 
                        `username` = '$username'
                        AND
                        `password` = '$password'
                    ";
            
            $result = $db->select($query);
            if($result){
                while($value = $result->fetch_assoc()){
                    Session::set("login",true);
                    Session::set("username",$value['username']);
                    Session::set("id",$value['id']);
                    Session::set("status",$value['status']);
                    header('Location:index.php');
                }
            }else{
                echo "<span style='color:red;font-size:18px'>Username or Password not matched.... </span>";
            }

        }
    }else{
        echo '<script> window.location = "user_login.html" </script>';
    }