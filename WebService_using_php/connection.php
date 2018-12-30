<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */


    $dbname="hashtagydb";
    $user="root";
    $pwd="";
    $host="localhost";

    $con= mysqli_connect($host,$user,$pwd,$dbname);


    if(!$con){
    
        return FALSE; 
    }
    else {
    
        return TRUE;
}


     




