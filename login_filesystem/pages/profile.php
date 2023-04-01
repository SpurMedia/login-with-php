<?php
require_once("../config/session.php");
require_once("../function/function.php");
if (!isset($_SESSION['user_status'])) {
   $_SESSION['error'] = "Please login to continue";
   return header("location:login.php");
}

$user_id = $_SESSION['user_status'];
echo $user_id;
$data = get_all_users();
?>
<!DOCTYPE html>
<html lang="en">

<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Profile</title>
   <link rel="stylesheet" href="../assets/bootstrap/css/bootstrap.min.css">
</head>

<body>
   <div class="container">

      <?php if (isset($_SESSION['error'])) : ?>
         <div class="alert alert-danger mt-3 mb-3"><?= $_SESSION['error'] ?></div>
      <?php endif; ?>
      <?php if (isset($_SESSION['success'])) : ?>
         <div class="alert alert-success mt-3 mb-3"><?= $_SESSION['success'] ?></div>
      <?php endif; ?>
      <div class="card">
         <div class="card-header d-flex justify-content-between">
            <div>
               Users List
            </div>
            <div>
               <a href="logout.php">Logout</a>
            </div>
         </div>
         <div class="card-body">
            <table class="table table-stripped table-bordered">
               <tr>
                  <th>Username</th>
                  <th>Password</th>
                  <th>Profile</th>
               </tr>
               <?php foreach ($data as $key => $values) : ?>
                  <?php if (trim($values) == trim($user_id)) : ?>
                     <?php if ($key % 4 == 0) : ?>
                        <tr>
                           <td><?= $data[$key + 1] ?></td>
                           <td><?= $data[$key + 2] ?></td>
                           <td><img class="img-fluid w-25" src="../uploads/<?= $data[$key + 3] ?>" alt="" srcset=""></td>
                        </tr>
                     <?php endif; ?>
                  <?php endif; ?>
               <?php endforeach; ?>
            </table>
         </div>
      </div>
   </div>
</body>

</html>
<?php unset(
   $_SESSION['success'],
   $_SESSION['error']
) ?>