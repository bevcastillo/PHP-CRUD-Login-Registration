<!DOCTYPE html>
<html>
  <head>
    <title>Login Form</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
  </head>
  <body>
  <?php require_once 'process.php'; ?>
    <div class="container">
        <div class="row">
            <div class="col-lg-6 m-auto">
                <div class="card border-dark text-center mt-5">
                    <h5 class="card-header">Login Form</h5>

                    <?php
                      if(isset($_SESSION['message'])): ?>          
                       <div class="alert alert-<?=$_SESSION['msg_type']?>">
                    <?php
                      echo $_SESSION['message'];
                      unset($_SESSION['message']);
                    ?>
                      </div>
                    <?php endif ?>

                    <div class="card-body">
                      <form action="process.php" method="POST">
                            <input type="text" class="form-control mb-2" name="signuname" placeholder="Enter username">
                            <input type="password" class="form-control mb-2" name="signpass" placeholder="Enter password">
                            <button type="submit" class="btn btn-success btn-block" name="login">Login</button>
                            <h6>or</h6>
                            <a href="signup.php" class=" btn btn-link">Signup here</a>
                      </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
  
  </body>
</html>