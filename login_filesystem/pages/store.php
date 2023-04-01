<?php
require_once("../config/session.php");
require_once("../function/function.php");
$username = $_POST['username'];
$password = $_POST['password'];
$primary_key =  trim(uniqid(rand(500, 1000)));

try {
   if ($username == "" || $password == "") {
      throw new Exception("Error Processing Request Input Cannot Be Empty", 1);
   } else {
      $profile = file_upload($username);
      create_user_data($primary_key, $username, $password, $profile);
      $_SESSION['user_status'] = $primary_key;
      $_SESSION['success'] = "Account created";
      return header('location:profile.php');
   }
} catch (\Exception $e) {
   $_SESSION['values'] = [
      'username' => $username
   ];
   $_SESSION['error'] = $e->getMessage();
   return header('location:signup.php');
}
