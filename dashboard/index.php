<?php include ('includes/connection.php'); ?>
<?php include ('includes/adminheader.php'); ?>

<div class="container">
    <h1 class="page-header text-center">
        Welcome <small><?php echo $_SESSION['name']; ?></small> 
    </h1>
</div>

 <?php 
    if($_SESSION['role'] == 'admin') 
    {
     include ('includes/adminroot.php');
 ?>
    <h3 class="page-header text-center">
        Notes Uploaded by the various users
    </h3>

<div class="container">
<div class="row">
  <div class="col-lg-12">
        <div class="table-responsive">
            <form action="" method="post">
              <table class="table table-dark">
                 <thead>
                    <tr>
                        <th>Notes Title</th>
                        <th>Description</th>
                        <th>Type </th>
                        <th>Uploaded on</th>
                        <th>Uploaded by </th>
                        <th>Status</th>
                        <th>View</th>
                        <th>Approve</th>
                        <th>Delete</th>
                        
                    </tr>
                  </thead>
              
    <tbody>
    <?php

        $query = "SELECT * FROM uploads ORDER BY file_uploaded_on DESC";
        $run_query = mysqli_query($conn, $query) or die(mysqli_error($conn));
        
        if (mysqli_num_rows($run_query) > 0) 
        {
                while ($row = mysqli_fetch_array($run_query)) 
                {
                    $file_id = $row['file_id'];
                    $file_name = $row['file_name'];
                    $file_description = $row['file_description'];
                    $file_type = $row['file_type'];
                    $file_date = $row['file_uploaded_on'];
                    $file_uploader = $row['file_uploader'];
                    $file_status = $row['status'];
                    $file = $row['file'];

                    echo "<tr>";
                    echo "<td>$file_name</td>";
                    echo "<td>$file_description</td>";
                    echo "<td>$file_type</td>";
                    echo "<td>$file_date</td>";
                    echo "<td><a href='viewprofile.php?name=$file_uploader' target='_blank' class='text-white'> $file_uploader </a></td>";
                    echo "<td>$file_status</td>";
                    echo "<td><a href='allfiles/$file' target='_blank' style='color:green' class='text-white'>View </a></td>";
                    echo "<td><a class='text-white' onClick=\"javascript: return confirm('Are you sure you want to approve this note?')\"href='?approve=$file_id'><i class='fas fa-check-circle'></i>&nbsp;Approve</a></td>";

                    echo "<td><a class='text-white' onClick=\"javascript: return confirm('Are you sure you want to delete this post?')\" href='?del=$file_id'><i class='fas fa-times-circle'></i>&nbsp;delete</a></td>";

                    echo "</tr>";

                }
        }
    ?>
    </tbody>
    </table>
    </form>
</div>
</div>
</div>
</div>

<?php 
    if (isset($_GET['del'])) 
    {
        $note_del = mysqli_real_escape_string($conn, $_GET['del']);
        $file_uploader = $_SESSION['username'];
        $del_query = "DELETE FROM uploads WHERE file_id='$note_del'";
        $run_del_query = mysqli_query($conn, $del_query) or die (mysqli_error($conn));
        
        if (mysqli_affected_rows($conn) > 0) 
        {
            echo "<script>alert('note deleted successfully');
            window.location.href='index.php';</script>";
        }
        else 
        {
         echo "<script>alert('error occured.try again!');</script>";   
        }
    }

    if (isset($_GET['approve'])) 
    {
        $note_approve = mysqli_real_escape_string($conn,$_GET['approve']);
        $approve_query = "UPDATE uploads SET status='approved' WHERE file_id='$note_approve'";
        $run_approve_query = mysqli_query($conn, $approve_query) or die (mysqli_error($conn));
        if (mysqli_affected_rows($conn) > 0) 
        {
            echo "<script>alert('note approved successfully');
            window.location.href='index.php';</script>";
        }
        else 
        {
         echo "<script>alert('error occured.try again!');</script>";   
        }
    }
?>

<?php 
 }
 else 
 {
?>
<?php include ('includes/adminnav.php'); ?>
<h3 class="page-header text-center">
    All Notes uploaded by the users
</h3>

<div class="container">
<div class="row">
    <div class="table-responsive">
        <form action="" method="post">
            <table class="table table-dark">
            <thead>
                <tr>
                    <th>Notes title</th>
                    <th>Description</th>
                    <th>Type </th>
                    <th>Uploaded by</th>
                    <th>Uploaded on</th>
                    <th>Download</th>     
                </tr>
            </thead>
            
            <tbody>
              <?php
                 $currentusercourse = $_SESSION['course'];
                 $query = "SELECT * FROM uploads WHERE file_uploaded_to = '$currentusercourse' AND status = 'approved' ORDER BY file_uploaded_on DESC";
                 $run_query = mysqli_query($conn, $query) or die(mysqli_error($conn));
                 
                 if (mysqli_num_rows($run_query) > 0) 
                 {
                   while ($row = mysqli_fetch_array($run_query)) 
                   {
                     $file_id = $row['file_id'];
                     $file_name = $row['file_name'];
                     $file_description = $row['file_description'];
                     $file_type = $row['file_type'];
                     $file_date = $row['file_uploaded_on'];
                     $file = $row['file'];
                     $file_uploader = $row['file_uploader'];

                     echo "<tr>";
                     echo "<td>$file_name</td>";
                     echo "<td>$file_description</td>";
                     echo "<td>$file_type</td>";
                     echo "<td><a href='viewprofile.php?name=$file_uploader' target='_blank' style='color:white'> $file_uploader </a></td>";
                     echo "<td>$file_date</td>";
                     echo "<td><a href='allfiles/$file' target='_blank' style='color:white'>Download </a></td>";
                     echo "</tr>";
                   }
                }
              ?>
            </tbody>
            </table>
        </form>
    </div>
  </div>
</div>
</div>

<?php 
}
  include('includes/footeradmin.php'); 
?>
</body>
</html>