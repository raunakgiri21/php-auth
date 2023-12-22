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
      if(isset($_SESSION)) {
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
      <a href="signin.php"><button class="btn btn-danger">Log Out</button></a>
    </div>
  </div>
</body>
</html>