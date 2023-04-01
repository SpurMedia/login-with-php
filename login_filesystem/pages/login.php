<?php
require_once("../config/session.php");
if (isset($_SESSION['user_status'])) {
   $_SESSION['success'] = "You are already logged in";
   return header("location:profile.php");
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Document</title>
   <link rel="stylesheet" href="../assets/bootstrap/css/bootstrap.min.css">
</head>

<body>
   <div class="container">
      <div class="row">
         <div class="col-sm-12 col-md-12 col-lg-6 offset-lg-3">

            <?php if (isset($_SESSION['error'])) : ?>
               <div class="alert alert-danger mt-3 mb-3"><?= $_SESSION['error'] ?></div>
            <?php endif; ?>
            <?php if (isset($_SESSION['success'])) : ?>
               <div class="alert alert-success mt-3 mb-3"><?= $_SESSION['success'] ?></div>
            <?php endif; ?>

            <form action="authenticate.php" method="post">
               <div class="card">
                  <div class="card-header">
                     Login
                  </div>
                  <div class="card-body">
                     <div class="form-group">
                        <label for="username">Username</label>
                        <input class="form-control" type="text" name="username" id="username">
                     </div>
                     <div class="form-group">
                        <label for="password">Password</label>
                        <input class="form-control" type="text" name="password" id="password">
                     </div>
                  </div>
                  <div class="card-footer">
                     <button class="btn btn-primary" type="submit">Login</button>
                  </div>
               </div>
            </form>
         </div>
      </div>
   </div>
</body>

</html>
<?php unset(
   $_SESSION['success'],
   $_SESSION['error']
) ?>