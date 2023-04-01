<?php
require_once("../config/session.php");
require_once("../function/function.php");

$username = $_POST['username'];
$password = $_POST['password'];

try {
   $data = get_all_users();
   foreach ($data as $key => $value) {
      if (trim($value) == trim($username)) {
         $id = trim($data[$key - 1]);
         $db_password = $data[$key + 1];
         if (trim($db_password) == trim(sha1($password))) {
            $_SESSION['success'] = "Login Successful";
            $_SESSION['user_status'] = $id;
            return header("location:profile.php");
         }
      }
   }
   throw new Exception("Invalid username and password combination", 1);
} catch (\Exception $e) {
   $_SESSION['error'] = $e->getMessage();
   return header('location:login.php');
}
