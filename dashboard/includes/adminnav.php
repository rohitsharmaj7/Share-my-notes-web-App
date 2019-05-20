<nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
<div class="container">
  <a class="navbar-brand" href="index.php">ShareNotes</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav ml-auto">
      <li class="nav-item active">
         <a href="index.php" class="nav-link text-white">Dashboard</a>   
      </li>
      <li class="nav-item">
         <a href="./viewprofile.php?name=<?php echo $_SESSION['username']; ?>" class="nav-link text-white"> View Profile</a>   
      </li>

      <li class="nav-item">
         <a href="./userprofile.php?section=<?php echo $_SESSION['username']; ?>" class="nav-link text-white" >Edit Profile</a>    
      </li>

      <li class="nav-item">
         <a href="./uploadnote.php" class="nav-link text-white">Upload Note</a>   
      </li>


      <li class="nav-item dropdown">              
        <a class="nav-link dropdown-toggle text-white" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          <i class="fa fa-user"></i> <?php echo $_SESSION['name']; ?> <b class="caret"></b>
        </a>
        <div class="dropdown-menu bg-dark" aria-labelledby="navbarDropdown">
          <a class="text-white ml-1" href="./userprofile.php?section=<?php echo $_SESSION['username']; ?>"><i class="fa fa-fw fa-user"></i> Account</a>
          <div class="dropdown-divider"></div>
          <a href="../logout.php" class="text-white ml-1"><i class="fa fa-fw fa-power-off"></i> Log Out</a>
        </div>
      </li>
    </ul>
  </div>
</div>
</nav>