<?php session_start();
require 'DBConfig.php';
?>


<!DOCTYPE html>
<html lang="en">

<head>
   <meta charset="UTF-8" />
   <meta name="viewport" content="width=device-width, initial-scale=1.0" />
   <meta http-equiv="X-UA-Compatible" content="ie=edge" />
   <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.13/css/all.css"
      integrity="sha384-DNOHZ68U8hZfKXOrtjWvjxusGo9WQnrNx2sqG0tfsghAvtVlRW3tvkXWZh58N9jp" crossorigin="anonymous" />
   <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css"
      integrity="sha384-WskhaSGFgHYWDcbwN70/dfYBj47jz9qbsMId/iRN3ewGhXQFZCSftd1LZCfmhktB" crossorigin="anonymous" />
   <link rel="stylesheet" href="css/style.css" />
   <title>ODAS</title>
</head>

<body>
   <!-- START HERE -->
   <nav class="navbar navbar-expand-sm navbar-white bg-white p-0">
      <div class="container">
         <a href="index.php" class="navbar-brand"><img id="imgLogo" alt="ODAS Logo" src="img/logo.JPG" /></a>

         <button class="navbar-toggler" data-toggle="collapse" data-target="#navbarCollapse">
            <span class="navbar-toggler-icon"></span>
         </button>
         <div class="collapse navbar-collapse" id="navbarCollapse">
            <ul class="navbar-nav">
               <li class="nav-item px-2">
                  <a href="index.php" class="nav-link active">Dashboard</a>
               </li>
               <li class="nav-item px-2">
                  <a href="requests.php" class="nav-link">Requests</a>
               </li>
               <li class="nav-item px-2">
                  <a href="documents.php" class="nav-link">Documents</a>
               </li>
               <li class="nav-item px-2">
                  <a href="students.php" class="nav-link">Students</a>
               </li>
            </ul>
            <ul class="navbar-nav ml-auto">
               <li class="nav-item dropdown mr-3">
                  <a href="#" data-toggle="dropdown" class="nav-link dropdown-toggle">
                     <?php
                      $userName= $_SESSION['UserName'];
                    echo '<i class="fas fa-user">Welcome  '.$userName.'</i>';
                  ?>
                  </a>
                  <div class="dropdown-menu">
                     <a href="profile.php" class="dropdown-item">
                        <i class="fas fa-user-circle"></i>
                        Profile</a>
                     <a href="settings.php" class="dropdown-item">
                        <i class="fas fa-cog"></i>
                        Settings</a>
                  </div>
               </li>
               <li class="nav-item">
                  <a href="login.php" class="nav-link">
                     <i class="fas fa user-time"></i>Logout
                  </a>
               </li>
            </ul>
         </div>
      </div>
   </nav>

   <!-- Header -->

   <header id="main-header" class="py-2 bg-warning text-white">
      <div class="container">
         <div class="row">
            <div class="col-med-6">
               <h1><i class="fas fa-users"></i> Students</h1>
            </div>
         </div>
      </div>
   </header>
   <!-- Search -->
   <section id="search" class="py-4 mb-4 bg-light">
      <div class="container">
         <div class="row">
            <div class="col-md-6 ml-auto">

            </div>
         </div>
      </div>
      </div>
   </section>

   <!-- students -->
   <section id="users">
      <div class="container">
         <div class="row">
            <div class="col">
               <div class="card">
                  <div class="card-header">
                     <h4>All Students</h4>
                  </div>
                  <table class="table table-striped">
                     <thead class="thead-dark">
                        <tr>
                           <th>#</th>
                           <th>Name</th>
                           <th>Email</th>
                           <th>Academic Number</th>
                           <th>Branch Name</th>
                           <th>Major Name</th>
                           <th>Phone Number</th>
                        </tr>
                     </thead>

                     <?php 
	$querySelect = "select UserName,UserEmail,AcademicNumber,BranchName,MajorName,UserPhone from users where SignType='S'";
	$runQuery =	mysqli_query($connectiontodb,$querySelect);
	$index = 1;
	while($eachRow = mysqli_fetch_array($runQuery)){
	$userName = $eachRow[0];
  $userEmail = $eachRow[1];
  $acadmicNumber = $eachRow[2];
  $branchName = $eachRow[3];
  $majorName = $eachRow[4];
  $userPhone = $eachRow[5];
 	echo "
		<tr>
		<td>$index</td>
		<td>$userName</td>
    <td>$userEmail</td>
    <td>$acadmicNumber</td>
		<td>$branchName</td>
    <td>$majorName</td>
    <td>$userPhone</td>
    </tr>";
    $index++;
	}
	
	?>
                  </table>

               </div>
            </div>
         </div>
      </div>
   </section>
   <!-- Footer fixed-bottom -->
   <footer id="main-footer" class="bg-dark text-white mt-2 p-4" style="bottom: 0;width: 100%; ">
      <div class="container">
         <div class="row">
            <div class="col">
               <p class="lead text-center">
                  ODAS Copyright &copy;<span id="year"></span>
               </p>
            </div>
         </div>
      </div>
   </footer>

   <script src="http://code.jquery.com/jquery-3.3.1.min.js"
      integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
   <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"
      integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous">
   </script>
   <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"
      integrity="sha384-smHYKdLADwkXOn1EmN1qk/HfnUcbVRZyYmZ4qpPea6sjB/pTJ0euyQp0Mk8ck+5T" crossorigin="anonymous">
   </script>

   <script>
   // Get the current year for the copyright
   $('#year').text(new Date().getFullYear());
   </script>
</body>

</html>