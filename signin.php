<?php
  include("./components/header.php")
?>
<body>
  <?php
    include("./components/nav.php");
  ?>
  <div class="my-container">
    <div class="my-form">
      <?php
        session_start();
        // connect to the database
        include('./config/db_connect.php');

        $email = $password = '';

        if(isset($_POST['submit'])){
          $email = mysqli_real_escape_string($conn, $_POST['email']);
          $password = mysqli_real_escape_string($conn, $_POST['password']);
          
          // verify unique email
          $verify_query = mysqli_query($conn, "select * from users where email='$email'");
          if(mysqli_num_rows($verify_query) == 0) {
            echo "<div class='error-msg'>Incorrect Credentials!</div>";
          } else {
            $row = mysqli_fetch_assoc($verify_query);
            if(!password_verify($password, $row['password'])) {
              echo "<div class='error-msg'>Incorrect Password!</div>";
            }else {
              $_SESSION['name'] = $row['name'];
              $_SESSION['email'] = $row['email'];
              header('Location: index.php');
            }
          }
        }
      ?>
      <a href="signup.php" class="switch-tab">
        <div class="sign-in-tab active-tab">
          <span>Sign In</span>
        </div>
        <div class="sign-up-tab">
          <span>Sign Up</span>
        </div>
      </a>
      <!-- Sign In Form -->
      <form class="sign-in-form row g-3" action="" method="POST">
        <div class="col-md-12">
          <label for="email" class="form-label">Email</label>
          <input type="email" class="form-control" name="email" id="email" required>
        </div>
        <div class="col-md-12">
          <label for="password" class="form-label">Password</label>
          <input type="password" class="form-control" name="password" id="password" required>
        </div>
        <div class="col-12">
          <input type="submit" class="btn btn-primary" name="submit" id="submit" value="Sign In"/>
        </div>
      </form>
    </div>
  </div>
</body>
</html>