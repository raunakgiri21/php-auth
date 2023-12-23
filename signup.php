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

        $email = $password = $confirmPassword = '';

        if(isset($_POST['submit'])){
          $name = mysqli_real_escape_string($conn, trim($_POST['name']));
          $email = mysqli_real_escape_string($conn, trim($_POST['email']));
          $password = mysqli_real_escape_string($conn, trim($_POST['password']));
          $confirmPassword = mysqli_real_escape_string($conn, trim($_POST['confirm-password']));

          if(!$name or !$email or !$password or !$confirmPassword) {
            echo "<div class='error-msg'>Fields cannot be empty!</div>";
            exit();
          }

          // verify unique email
          $verify_query = mysqli_query($conn, "select email from users where email='$email'");
          if(mysqli_num_rows($verify_query) != 0) {
            echo "<div class='error-msg'>Email already registered!</div>";
          } elseif(strlen($password)<8) {
            echo "<div class='error-msg'>Password must be at least 8 characters!</div>";
          } elseif($password !== $confirmPassword) {
            echo "<div class='error-msg'>Passwords not matching!</div>";
          } else {
            $hash = password_hash($password, PASSWORD_DEFAULT);
            mysqli_query($conn, "insert into users(name, email, password) values('$name', '$email', '$hash')");
            $_SESSION["name"] = $name;
            $_SESSION["email"] = $email;
            header('Location: index.php');
          }
        }
      ?>
      <a href="signin.php" class="switch-tab">
        <div class="sign-in-tab">
          <span>Sign In</span>
        </div>
        <div class="sign-up-tab active-tab">
          <span>Sign Up</span>
        </div>
      </a>
      <!-- Sign Up Form -->
      <form class="sign-up-form row g-3" method="POST">
        <div class="col-md-12">
          <label for="inputName" class="form-label">Name</label>
          <input type="name" class="form-control" name="name" id="name" required>
        </div>
        <div class="col-md-12">
          <label for="inputEmail4" class="form-label">Email</label>
          <input type="email" class="form-control" name="email" id="inputEmail5" required>
        </div>
        <div class="col-md-12">
          <label for="inputPassword5" class="form-label">Password</label>
          <input type="password" class="form-control" name="password" id="inputPassword5" required>
        </div>
        <div class="col-md-12">
          <label for="inputPassword6" class="form-label">Confirm Password</label>
          <input type="password" class="form-control" name="confirm-password" id="inputPassword6" required>
        </div>
        <div class="col-12">
          <input type="submit" class="btn btn-primary" name="submit" id="submit" value="Sign Up"/>
        </div>
      </form>
    </div>
  </div>
  <script src="scripts.js"></script>
</body>
</html>