<?php

function login($con,$email,$password){
   
   $stmt = "CALL login('$email','$password')" ;
        
  $result = mysqli_query($con,$stmt);

if(! $result)
    
{ die("Error in query");}
 //get data from database
$output=array();

while($row=  mysqli_fetch_assoc($result))
{
 $output[]=$row;  //$row['id']
}

if ($output) {
    
print(json_encode($output));// this will print the output in json
 
 }
 else{
 	print("{'msg':' cannot login'}");
 }

// 4 clear
mysqli_free_result($result);
//5- close connection
mysqli_close($con);
  
}


function register($con,$fname,$lname,$password,$email,$mobile_num,$profilepic_url,$birth_date,$gender,$country_id,$role,$status,$follower_count,$creation_time,$last_login)
        {

  
 $stmt =  "INSERT INTO `person`(`fname`, `lname`, `password`, `email`, `mobile_number`, `profilepic_url`, `birthdate`, `gander`, `country_id`, `role`, `status`, `followers_count`, `creation_time`, `last_login`) VALUES ('$fname','$lname','$password','$email','$mobile_num','$profilepic_url','$birth_date','$gender','$country_id','$role','$status','$follower_count','$creation_time','$last_login')";
    
//$stmt = "CALL register ('$fname','$lname','$password','$email','$mobile_num','$profilepic_url','$birth_date','$gender','$country_id','$role','$status','$follower_count','$creation_time','$last_login')";

    
$result=  mysqli_query($con, $stmt);

if(! $result)
{$output ="{'msg':'fail'}";
}
else {
$output ="{'msg':'user is added'}";
}
 
print( $output);// this will print the output in json
 
//5- close connection
mysqli_close($con);
    
    
        }
        
function update_profile($con,$id,$fname,$lname,$password,$email,$mobile_num,$profilepic_url,$birth_date,$gander,$country_id,$role,$status,$follower_count,$creation_time,$last_login)

{
    
$stmt = "CALL update_profile ('$id','$fname','$lname','$password','$email','$mobile_num','$profilepic_url','$birth_date','$gander','$country_id','$role','$status','$follower_count','$creation_time','$last_login')";

    
$result=  mysqli_query($con, $stmt);

if(! $result)
{$output ="{'msg':'fail'}";
}
else {
$output ="{'msg':'user is updated'}";
}
 
print( $output);// this will print the output in json
 
//5- close connection
mysqli_close($con);
    
    
        }
        
function add_history($con,$person_id,$hashtag_name,$search_time){

$hashtag_id = check_hashtag($con, $hashtag_name) ;    


$stmt = "CALL add_history ('$person_id','$hashtag_id','$search_time')";
//$stmt = "INSERT INTO history(`person_id`, `hashtag_id`, `search_date`, `favourite`, `is_hidden`) VALUES (person_id,hashtag_id,0,0)" (,'$hashtag_id','$search_time')";
    
$result=  mysqli_query($con, $stmt);

if(! $result)
{
    $output ="{'msg':'fail '}";
}
else {
$output ="{'msg':'history is added'}";
}
 
print( $output);// this will print the output in json
 
//5- close connection
mysqli_close($con);
    
    
    }
    
    
function check_hashtag($con,$hashtag_name){

$stmt1="SELECT * FROM hashtag WHERE hashtag_name='$hashtag_name'";

$result1 = mysqli_query($con,$stmt1);

if(! $result1)
    
{ die("Error in query");}
 //get data from database

$res = mysqli_fetch_row($result1) ;

if($res){
 
    return $res[0];    
}
else
{
    
$stmt2="INSERT INTO hashtag(`hashtag_name`) VALUES('$hashtag_name')";


$resu = mysqli_query($con,$stmt2);


if($resu){
    
$stmt3="SELECT * FROM hashtag WHERE hashtag_name='$hashtag_name'";

$result = mysqli_query($con,$stmt3);

$res = mysqli_fetch_row($result) ;

return $res[0];        
}
    }

}         
        
function view_user($con){
    
$stmt="CALL view_users()";// $usename=$_GET['username'];
$result=  mysqli_query($con, $stmt);
if(! $result)
{ die("Error in query");}
 //get data from database
$output=array();

while($row=  mysqli_fetch_assoc($result))
{
 $output[]=$row;  //$row['id']
}

print(json_encode($output));// this will print the output in json
// 4 clear
mysqli_free_result($result);
//5- close connection
mysqli_close($con);

}

function delete_one_history($con,$person_id,$hashtag_name)
{


$stmt_final= "CALL delete_one_history ('$person_id','$hashtag_name')";

$result_final = mysqli_query($con,$stmt_final);

if(! $result_final)
    {die("error in query2");}
else{
$output ="{'msg':'one history is deleted'}";
echo $output;

mysqli_close($con);
}   
        }
        

function delete_all_history($con,$person_id)
{

$stmt_final= "CALL delete_all_history ('$person_id')";

$result_final = mysqli_query($con,$stmt_final);

if(! $result_final)
    {die("error in query2");}
else{
$output ="{'msg':'all history is deleted'}";

echo $output;

mysqli_close($con);
}   
        }
        
        

function add_favourite($con,$person_id,$hashtag_name)
{


$stmt_final= "CALL add_favourite ('$person_id','$hashtag_name')";

$result_final = mysqli_query($con,$stmt_final);

if(! $result_final)
    {die("error in query2");}
else{
$output ="{'msg':'hashtag favourite is added'}";
echo $output;
mysqli_close($con);
}   
        }
        

        