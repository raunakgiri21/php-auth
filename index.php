<?php
  include("./components/header.php")
?>
<body>
  <?php
    include("./components/nav.php");
  ?>
  <div class="my-container home-section">
    <h1>Welcome</h1>
    <?php
      session_start();
      if(isset($_POST['logout'])) {
        session_unset();
        session_destroy();
      }
      if(isset($_SESSION) and isset($_SESSION['name'])) {
        echo "<div>
                <p>Name: {$_SESSION['name']}</p>
                <p>Email: {$_SESSION['email']}</p>
              </div>";
      } else {
        print_r($_SESSION);
        header('Location: signin.php');
      }
    ?>
    <div class="logout-container">
      <form method="POST">
        <input type="submit" class="btn btn-danger" name="logout" value="Log Out">
      </form>
    </div>
  </div>
</body>
</html>