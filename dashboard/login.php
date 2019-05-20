<?php
 session_start();
 include ('includes/connection.php');
 include ('includes/navbar.php');
 include ('includes/header.php');
 
 if(isset($_POST['login'])) 
 {
  $username  = $_POST['user'];
  $password = $_POST['pass'];
  mysqli_real_escape_string($conn, $username);
  mysqli_real_escape_string($conn, $password);
  
  $query = "SELECT * FROM users WHERE username = '$username'";
  $result = mysqli_query($conn , $query) or die (mysqli_error($conn));
  
 if(mysqli_num_rows($result) > 0) 
 {
   while ($row = mysqli_fetch_array($result)) 
   {
    $id = $row['id'];
    $user = $row['username'];
    $pass = $row['password'];
    $name = $row['name'];
    $email = $row['email'];
    $role= $row['role'];
    $course = $row['course'];
    
    if(password_verify($password, $pass )) 
    {
      $_SESSION['id'] = $id;
      $_SESSION['username'] = $username;
      $_SESSION['name'] = $name;
      $_SESSION['email']  = $email;
      $_SESSION['role'] = $role;
      $_SESSION['course'] = $course;
      header('location: dashboard/');
    }
    else 
    {
      echo "<script>alert('invalid username/password');
      window.location.href= 'login.php';</script>";

    }
   }
 }
 else 
 {
     echo "<script>alert('invalid username/password');
     window.location.href= 'login.php';</script>";
 }
}
?>

    <header id="home-section" class="container-fluid bg-primary p-4">
        <div class="container p-5">
          <div class="row p-3">
            <div class="col-lg-8 d-none d-lg-block">
              <h1 class="display-4">Sharing <strong>Notes</strong> made easy <strong></strong></h1>
              <div class="d-flex flex-row">
                <div class="p-4 align-self-start">
                  <i class="fa fa-check"></i>
                </div>
                <div class="p-4 align-self-end">
                  In today's era, hoarding knowledge ultimately erodes your power. If you know something very important, the way to get power is by actually sharing it.
                </div>
              </div>

              <div class="d-flex flex-row">
                <div class="p-4 align-self-start">
                  <i class="fa fa-check"></i>
                </div>
                <div class="p-4 align-self-end">
                  Now carry all your important notes in your pocket and have access to them anywhere anytime.
                </div>
              </div>

              <div class="d-flex flex-row">
                <div class="p-4 align-self-start">
                  <i class="fa fa-check"></i>
                </div>
                <div class="p-4 align-self-end">
                  Upload or download the notes at your convinience within just a single click.
                </div>
              </div>
            </div>
            <div class="col-lg-4">
              <div class="card bg-dark card-form">
                <div class="card-body">
                   <form class="bg-dark rounded p-2" method="post">
                      <div class="form-group">
                        <h4 class="text-white text-center">Login</h4>
                      </div>
                      <div class="form-group">
                        <label for="exampleInputUsername" class="text-white">Username</label>
                        <input type="text" class="form-control" name="user" placeholder="Username" required="">
                      </div>
                      
                      <div class="form-group">
                        <label for="exampleInputPassword1" class="text-white">Password</label>
                        <input type="password" class="form-control" name="pass" placeholder="Password" required="">
                      </div>
                      
                      <input type="submit" name="login" class="login login-submit btn-success btn-block form-control" value="login">   
                      <div class="login-help">
                        <a href="recoverpassword.php" class="text-white">Forgot Password</a>
                      </div>
                     </form>
                </div>
              </div>
            </div>
          </div>
        </div>
   </header>
   
   <div class="container-fluid p-2 d-none d-lg-block" style="background-color: #343A40;">
     <h6 class="text-center text-white">Made by Rohit Sharma | Btech Cse Lpu</h6>
   </div>

<?php
 include('includes/footer.php')
?>