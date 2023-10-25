<?php

#===============[Path]====================#

$baseDir = 'path'; // put your directory here

#===============[Acsess]====================#

//require to login before access to file downloader
$login = true; //set true to enable login

#===============[Login info]====================#
//set your username and password here
 $users = array(
    'admin' => array('password' => 'admin'),
);

// if you want muliti login account here for example
// $users = array(
//     'username1' => array('password' => 'password1'),
//     'username2' => array('password' => 'password1'),
//     'username3' => array('password' => 'password1'),  
// );

#===============[Support info]====================#
$url = "https://github.com/Corey-Stowe"; //your website url here where you want to support

?>