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
      if(isset($_SESSION) and isset($_SESSION['id'])) {
        // connect to the database
        include('./config/db_connect.php');
        $id = $_SESSION['id'];
        $verify_query = mysqli_query($conn, "select * from users where id=$id");
        if(mysqli_num_rows($verify_query)){
          $row = mysqli_fetch_assoc($verify_query);
          echo "<div>
                <p>Name: {$row['name']}</p>
                <p>Email: {$row['email']}</p>
                </div>";    
        }else {
          header('Location: signin.php');
        }
      }else {
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