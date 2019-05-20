<?php
   include ('includes/connection.php');
   include ('includes/adminheader.php');
   
   if($_SESSION['role']=='admin')
   {
    include 'includes/adminroot.php';
   }
   else
   {
    include 'includes/adminnav.php';
   }
?>

<?php 
  if(isset($_GET['name'])) 
  {
    $user = mysqli_real_escape_string($conn , $_GET['name']);
    $query = "SELECT * FROM users WHERE username= '$user' ";
    $run_query = mysqli_query($conn, $query) or die(mysqli_error($conn)) ;
      if (mysqli_num_rows($run_query) > 0 ) 
      {
        while ($row = mysqli_fetch_array($run_query)) 
        {
        	$name = $row['name'];
        	$email = $row['email'];
        	$course = $row['course'];
        	$role = $row['role'];
        	$bio = $row['about'];
        	$image = $row['image'];
            $joindate = $row['joindate'];
            $gender = $row['gender'];
        }
      }
      else 
      {
        	$name = "N/A";
        	$email = "N/A";
        	$course = "N/A";
        	$role = "N/A";
        	$bio = "N/A";
        	$image = "profile.jpg";
            $gender = "N/A";
            $joindate = "N/A";
      }
?>



<div class="container p-5 mt-5">
	<div class="row">
		<div class="col-md-6 offset-md-3">
		    <div class="row bg-dark rounded">
		        <div class="col-md-6 float-right text-center my-auto p-3">
		            <img src="profilepics/<?php echo $image; ?>" class='img-fluid'style="border-radius: 20px;"/>
		        </div>
		                
		        <div class="col-md-6 p-3">
		            <h4 class="text-white"><?php echo $name; ?></h4>
		              <p class="text-white"><b>Department : </b><?php echo $course; ?></p>
		              <p class="text-white"><b>Role : </b><?php echo $role; ?></p>
		              <p class="text-white"><b>Gender : </b><?php echo $gender; ?></p>
		              <p class="text-white"><b>Email : </b><?php echo $email; ?></p>
		              <p class="text-white"><b>Join Date : </b><?php echo $joindate; ?></p>
		              <p class="text-white"><b>Bio : </b><?php echo $bio; ?></p>                    
		        </div>
		    </div>
		</div>
	</div>
</div>

<?php include('includes/footeradmin.php');?>
</body>
</html>
<?php 
 } 
 else 
 {
    header("location:index.php");
 } 
?>