<?php include 'includes/connection.php';?>
<?php include 'includes/header.php';?>

<?php include 'includes/navbar_signup.php';?>

<?php
if (isset($_POST['signup'])) {
require "gump.class.php";
$gump = new GUMP();
$_POST = $gump->sanitize($_POST); 

$gump->validation_rules(array(
  'username'    => 'required|alpha_numeric|max_len,20|min_len,4',
  'name'        => 'required|alpha_space|max_len,30|min_len,5',
  'email'       => 'required|valid_email',
  'password'    => 'required|max_len,50|min_len,6',
));
$gump->filter_rules(array(
  'username' => 'trim|sanitize_string',
  'name'     => 'trim|sanitize_string',
  'password' => 'trim',
  'email'    => 'trim|sanitize_email',
  ));
$validated_data = $gump->run($_POST);

if($validated_data === false) {
  ?>
  <center><font color="red" > <?php echo $gump->get_readable_errors(true); ?> </font></center>
  <?php
}
else if ($_POST['password'] !== $_POST['repassword']) 
{
  echo  "<center><font color='red'>Passwords do not match </font></center>";
}
else {
      $username = $validated_data['username'];
      $checkusername = "SELECT * FROM users WHERE username = '$username'";
      $run_check = mysqli_query($conn , $checkusername) or die(mysqli_error($conn));
      $countusername = mysqli_num_rows($run_check); 
      if ($countusername > 0 ) {
    echo  "<center><font color='red'>Username is already taken! try a different one</font></center>";
}
$email = $validated_data['email'];
$checkemail = "SELECT * FROM users WHERE email = '$email'";
      $run_check = mysqli_query($conn , $checkemail) or die(mysqli_error($conn));
      $countemail = mysqli_num_rows($run_check); 
      if ($countemail > 0 ) {
    echo  "<center><font color='red'>Email is already taken! try a different one</font></center>";
}

  else {
      $name = $validated_data['name'];
      $email = $validated_data['email'];
      $pass = $validated_data['password'];
      $password = password_hash("$pass" , PASSWORD_DEFAULT);
      $role = $_POST['role'];
      $course = $_POST['course'];
      $gender = $_POST['gender'];
      $joindate = date("F j, Y");
      $query = "INSERT INTO users(username,name,email,password,role,course,gender,joindate,token) VALUES ('$username' , '$name' , '$email', '$password' , '$role', '$course', '$gender' , '$joindate' , '' )";
      $result = mysqli_query($conn , $query) or die(mysqli_error($conn));
      if (mysqli_affected_rows($conn) > 0) { 
        echo "<script>alert('SUCCESSFULLY REGISTERED');
        window.location.href='index.php';</script>";
}
else {
  echo "<script>alert('Error Occured');</script>";
}
}
}
}
?>
<br>
    
    <div class="container pb-4">
      <div class="row">
        <div class="col-md-6 offset-md-3">
        <form id="contactform" class="bg-dark p-4 rounded" method="POST"> 
           <h1 class="text-white text-center">Sign up</h1>
           <div class="form-group">
             <label for="name" class="text-white">Name</label>
             <input id="name" name="name" placeholder="First and last name" required="" tabindex="1" type="text" value="<?php if(isset($_POST['signup'])) { echo $_POST['name']; } ?>" class="form-control"> 
           </div>
           
           <div class="form-group">
            <label for="email" class="text-white">Email</label>
            <input id="email" name="email" placeholder="example@domain.com" required="" type="email" value="<?php if(isset($_POST['signup'])) { echo $_POST['email']; } ?>" class="form-control"> 
           </div>

           <div class="form-group">     
            <label for="username" class="text-white">Create a username</label> 
            <input id="username" name="username" placeholder="username" required="" tabindex="2" type="text" value="<?php if(isset($_POST['signup'])) { echo $_POST['username']; } ?>" class="form-control"> 
           </div>

           <div class="form-group"> 
            <label for="password" class="text-white">Create a password</label>
            <input type="password" id="password" name="password" required="" class="form-control">
           </div> 
           
           <div class="form-group">
            <label for="repassword" class="text-white">Confirm your password</label>
            <input type="password" id="repassword" name="repassword" required="" class="form-control"> 
          </div>

          <div class="form-group">
            <label for="gender" class="text-white">Gender </label>
            <select class="select-style gender form-control" name="gender">
            <option value="Male">Male</option>
            <option value="Female">Female</option>
            </select>
          </div>

          <div class="form-group">  
            <label for="role" class="text-white">I am a..</label> 
            <select class="select-style gender form-control" name="role">
            <option value="teacher">Teacher</option>
            <option value="student">Student</option>
            </select>
          </div>
          
          <div class="form-group">
            <label for="course" class="text-white">I teach/study..</label>
            <select class="select-style gender form-control" name="course">
            <option value="Computer Science">Computer Sc Engineering</option>
            <option value="Electrical">Electrical Engineering</option>
            <option value="Mechanical">Mechanical Engineering</option>
            </select>
          </div>

          <input class="btn btn-primary btn-block" name="signup" id="submit" tabindex="5" value="Sign me up!" type="submit">    
        </form>
        </div>   
     </div>
</div>

</body>
</html>