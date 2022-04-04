<?php

// start of on the session;
session_start();

if(!isset($_SESSION['user_id'])) {

   header('location: login.php');

}//