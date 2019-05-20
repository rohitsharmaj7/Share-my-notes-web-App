<?php include 'includes/connection.php';?>
<?php include 'includes/adminheader.php';?>

<?php 
 if (isset($_SESSION['role']) && $_SESSION['role'] == 'admin') 
 {
   header("location: index.php");
 }
?>
<?php include 'includes/adminnav.php';?>

<?php
    if (isset($_POST['upload'])) 
    {
        require "../gump.class.php";
        $gump = new GUMP();
        $_POST = $gump->sanitize($_POST); 

        $gump->validation_rules(array(
            'title'    => 'required|max_len,60|min_len,3',
            'description'   => 'required|max_len,150|min_len,3',
        ));
        $gump->filter_rules(array(
            'title' => 'trim|sanitize_string',
            'description' => 'trim|sanitize_string',
            ));
        $validated_data = $gump->run($_POST);

        if($validated_data === false) 
        {
?>
        <center><font color="red" > <?php echo $gump->get_readable_errors(true); ?> </font></center>
<?php 
        $file_title = $_POST['title'];
        $file_description = $_POST['description'];
}
        else 
        {
         $file_title = $validated_data['title'];
         $file_description = $validated_data['description'];
         if (isset($_SESSION['id'])) 
         {
          $file_uploader = $_SESSION['username'];
          $file_uploaded_to = $_SESSION['course'];
         }

          $file = $_FILES['file']['name'];
          $ext = pathinfo($file, PATHINFO_EXTENSION);
          $validExt = array ('pdf', 'txt', 'doc', 'docx', 'ppt' , 'zip');
    
         if (empty($file)) 
         {
          echo "<script>alert('Attach a file');</script>";
         }
         else if ($_FILES['file']['size'] <= 0 || $_FILES['file']['size'] > 30720000 )
         {
          echo "<script>alert('file size is not proper');</script>";
         }
         else if (!in_array($ext, $validExt))
         {
          echo "<script>alert('Not a valid file');</script>";
         }
         else 
         {
          $folder  = 'allfiles/';
          $fileext = strtolower(pathinfo($file, PATHINFO_EXTENSION) );
          $notefile = rand(1000 , 1000000) .'.'.$fileext;
          
          if(move_uploaded_file($_FILES['file']['tmp_name'], $folder.$notefile))
          {
            $query = "INSERT INTO uploads(file_name, file_description, file_type, file_uploader, file_uploaded_to, file) VALUES ('$file_title' , '$file_description' , '$fileext' , '$file_uploader' , '$file_uploaded_to' , '$notefile')";
            $result = mysqli_query($conn , $query) or die(mysqli_error($conn));
          
            if (mysqli_affected_rows($conn) > 0)
            {
                echo "<script> alert('file uploaded successfully.It will be published after admin approves it');
                window.location.href='notes.php';</script>";
            }
            else
            {
                "<script> alert('Error while uploading..try again');</script>";
            }
        }
    }
}
}
?>

<div class="container mt-5">
    <div class="row">
        <div class="col-md-6 offset-md-3">
          <form role="form" action="" class="bg-dark p-3 mt-5 rounded" method="POST" enctype="multipart/form-data">
            <h1 class="text-white">Upload your notes here</h1>
            <hr>
        	<div class="form-group">
        		<label for="post_title" class="text-white">Title for the notes</label>
        		<input type="text" name="title" class="form-control" placeholder="Eg: Php Tutorial File"  value = "<?php if(isset($_POST['upload'])) {
                    echo $file_title; } ?>" required="">
        	</div>

        	<div class="form-group">
        		<label for="post_tags" class="text-white">Short Description</label>
        		<input type="text" name="description" class="form-control" placeholder="Eg: Php Tutorial File includes basic php programming ...." value="<?php if(isset($_POST['upload'])) {
                    echo $file_description;  } ?>" required="" ">
        	</div>

        	<div class="form-group">
                <label for="post_image" class="text-white">Select File</label><font color="grey"> (allowed file type: 'pdf','doc','ppt','txt','zip' | allowed maximum size: 30 mb ) </font>
        		<input type="file" name="file" class="text-white"> 
             </div>

            <button type="submit" name="upload" class="btn btn-primary" value="Upload Note">Upload Note</button>
          </form>
        </div>
    </div>
</div>





<?php include('includes/footeradmin.php');?>
</body>
</html>