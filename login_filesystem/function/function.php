<?php

function create_user_data($primary_key, $username, $password, $profile)
{

   $location = "../storage/user.txt";
   $open = fopen($location, 'a');
   fwrite($open, $primary_key . "\n" . $username . "\n" . sha1($password) . "\n" . $profile . "\n");
   fclose($open);
}

function get_all_users()
{
   $location = "../storage/user.txt";
   $fopen = fopen($location, 'r');
   $data = [];
   if ($fopen) {
      while (($line = fgets($fopen)) != false) {
         array_push($data, $line);
      }
      fclose($fopen);
   }
   return $data;
}
function file_upload($username)
{
   $name = $_FILES['profile']['name'];
   $tmp_name = $_FILES['profile']['tmp_name'];
   $size = $_FILES['profile']['size'];
   $type = $_FILES['profile']['type'];
   $allowed_format = ['jpeg', 'png'];
   $file_type = explode('/', $type);
   $location = "../uploads/";
   $encrypted_name = $username . md5($name) . rand(500, 60000) . '.' . $file_type[1];
   if (!empty($name)) {
      if ($size <= 2000000) {
         if (getimagesize($tmp_name)) {
            if (in_array($file_type[1], $allowed_format)) {
               if (!file_exists($location . $encrypted_name)) {
                  if (move_uploaded_file($tmp_name, $location . $encrypted_name)) {
                     return $encrypted_name;
                  } else {
                     throw new Exception("Error Processing Request there was an error while uploading the file", 1);
                  }
               } else {
                  throw new Exception("Error Processing Request file already exists", 1);
               }
            } else {
               throw new Exception("Error Processing Request please only jpeg is allowed", 1);
            }
         } else {
            throw new Exception("Error Processing Request file is not an image", 1);
         }
      } else {
         throw new Exception("Error Processing Request file size too large", 1);
      }
   } else {
      throw new Exception("Error Processing Request please select an image to upload", 1);
   }
}
