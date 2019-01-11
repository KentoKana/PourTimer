<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <title>Pour Timer | Login</title>
  <?php include('inc/headEl.php')?>
</head>
<body>
  <!-- Header -->
  <?php include('inc/header.php')?>
  <main>
    <div class="section-wrap">
      <form class="login" id="form" method="post">
        <label for="userName">Username</label>
        <input type="text" name="uname" id="uname">
        <label for="passWord">Password</label>
        <input type="password" name="pass" id="pass">
        <input type="submit" name="btn-login" value="Log in">
      </form>
      <?php
      if(isset($_REQUEST['logout'])){
        echo "you have logged out!";
      }

      if(isset($_SESSION['username'])){
        header("Location: index.php");
      }

      if(isset($_POST['btn-login'])){
        $u = $_POST['uname'];
        $p = $_POST['pass'];

        if(strcmp($u, "admin") === 0 && strcmp($p,"1234") === 0){
          echo "yes";
          $_SESSION['username'] = $u;
          $_SESSION['password'] = $p;
          header("Location: index.php?login=success");
        } else {
          echo "no";
        }
      }
      ?>
    </div>
  </main>

  <!-- Footer -->
  <?php include('inc/footer.php')?>
</body>
</html>
