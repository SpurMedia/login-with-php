<?php
require_once("../config/session.php");

if (isset($_SESSION['user_status'])) {
   unset($_SESSION['user_status']);
   $_SESSION['success'] = "Logout Successful";
   return header("location:login.php");
}
