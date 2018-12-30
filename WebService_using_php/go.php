<?php

require 'connection.php';
require 'functions.php';


$result = "error"; 



if($con){
    
$action = $_GET["action"];
 
if(isset($action))
{
    
switch ($action){  
    
    case "login":

        $email=$_GET["email"];
        $password=$_GET["password"];
    
        login($con,$email, $password);
        
        break;

          
    case "register":
        
        $fname=$_GET["fname"];
        $lname=$_GET["lname"];
        $password=$_GET["password"];
        $email=$_GET["email"];
        $mobile_num=$_GET["mobile_num"];
        $profilepic=$_GET["profilepic"];
        $birth_date=$_GET["birth_date"];
        $gander=$_GET["gander"];
        $country_id=$_GET["country_id"];
        $role=$_GET["role"];
        $status=$_GET["status"];
        $follower_count=$_GET["follower_count"];
        $creation_time=$_GET["creation_time"];
        $last_login=$_GET["last_login"];

     //   $image = base64_decode($profilepic_url);
       // file_put_contents("F:\\G.P\\images\\" .$email. ".JPG", $image);
        
        
        register($con,$fname,$lname,$password,$email,$mobile_num,$profilepic,$birth_date,$gander,$country_id,$role,$status,$follower_count,$creation_time,$last_login);
    
        break;
    
    
    case "update_profile":
        
        $id=$_GET["id"];
        $fname=$_GET["fname"];
        $lname=$_GET["lname"];
        $password=$_GET["password"];
        $email=$_GET["email"];
        $mobile_num=$_GET["mobile_num"];
        $profilepic_url=$_GET["profilepic_url"];
        $birth_date=$_GET["birth_date"];
        $gander=$_GET["gander"];
        $country_id=$_GET["country_id"];
        $role=$_GET["role"];
        $status=$_GET["status"];
        $follower_count=$_GET["follower_count"];
        $creation_time=$_GET["creation_time"];
        $last_login=$_GET["last_login"];

                
        update_profile($con,$id,$fname,$lname,$password,$email,$mobile_num,$profilepic_url,$birth_date,$gander,$country_id,$role,$status,$follower_count,$creation_time,$last_login);
    
        break;
        
    case "add_history":

        $person_id=$_GET["person_id"];
        $hashtag_name=$_GET["hashtag_name"];
        $search_time=$_GET["search_time"];
        
        add_history($con,$person_id,$hashtag_name,$search_time);

        break;
    
    case "view_users":
        view_user($con);
        break;
    
    case "delete_one_history":
        
        $person_id=$_GET["person_id"];
        $hashtag_name=$_GET["hashtag_name"];
        
        delete_one_history($con,$person_id,$hashtag_name);
        
        break;
    
    case "delete_all_history":
        
        
        $person_id=$_GET["person_id"];
        
        delete_all_history($con,$person_id);
        
        break;
        
    case "add_favourite":
  
        $person_id=$_GET["person_id"];
        $hashtag_name=$_GET["hashtag_name"];
        
        add_favourite($con,$person_id,$hashtag_name);
        break;

    
    
    default :
    
     }
    
}
}
    
