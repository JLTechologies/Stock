<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="shortcut icon" href="../favicon.jpg" type="image/x-icon">
  <?php
  include('../../config.php');
  include('../authentication.php');
  include('../server.php');

  if (isset($_GET['logout'])) {
    session_destroy();
  }

  include('../queries.php');

  $name = mysqli_query($conn, $sitename);
  if (! $name) {
    die('Could not load sitename: '.mysqli_error($conn));
  }
  while($row = mysqli_fetch_assoc($name)) {?>
  <title>Admin | <?php $site = htmlspecialchars($row['sitename']); echo $site ;?></title>
  <?php }
  ?>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome Icons -->
  <link rel="stylesheet" href="../plugins/fontawesome-free/css/all.min.css">
  <!-- SweetAlert2 -->
  <link rel="stylesheet" href="../plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css">
  <!-- Toastr -->
  <link rel="stylesheet" href="../plugins/toastr/toastr.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="../css/adminlte.min.css">
</head>
<body class="hold-transition sidebar-mini">
<div class="wrapper">

  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
      </li>
    </ul>

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
      <!-- Navbar Search -->
      <li class="nav-item">
        <a class="nav-link" href="../">
          <i class="fas fa-th-large"></i>
        </a>
      </li>
    </ul>
  </nav>
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="../index.php" class="brand-link">
      <img src="../favicon.jpg" alt="Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
      <span class="brand-text font-weight-light"><?php echo $site; ?></span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">

      <!-- Sidebar Menu -->
      <nav class="mt-2">
      <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
          <li class="nav-item">
            <a href="../" class="nav-link">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
                Dashboard
              </p>
            </a>
          </li>
		  <li class="nav-item">
            <a href="./" class="nav-link active">
              <i class="nav-icon fas fa-users-cog"></i>
              <p>
                Locations
              </p>
            </a>
          </li>
		  <li class="nav-item">
            <a href="./cowcodes.php" class="nav-link">
              <i class="nav-icon fas fa-users-cog"></i>
              <p>
                Cow-Codes
              </p>
            </a>
          </li>
          <li class="nav-item">
			<a href="../categories/" class="nav-link">
				<i class="nav-icon fas fa-th"></i>
				<p>
					Categories
				</p>
			</a>
			</li>
      <li class="nav-item">
			<a href="../brands/" class="nav-link">
				<i class="nav-icon fas fa-th"></i>
				<p>
					Brands
				</p>
			</a>
			</li>
      <li class="nav-item">
			<a href="../brands/contact/" class="nav-link">
				<i class="nav-icon fas fa-th"></i>
				<p>
					Contacts
				</p>
			</a>
			</li>
      <li class="nav-item">
			<a href="../measurements/" class="nav-link">
				<i class="nav-icon fas fa-th"></i>
				<p>
					Measurements
				</p>
			</a>
			</li>
		  <li class="nav-item menu-closed">
        <a href="#" class="nav-link">
          <i class="nav-icon fas fa-tree"></i>
            <p>
              Items
              <i class="fas fa-angle-left right"></i>
            </p>
        </a>
        <ul class="nav nav-treeview">
            <li class="nav-item">
              <a href="./" class="nav-link">Complete List</a>
            </li>
          <?php
          $getroot = mysqli_query($conn, $rootcategories);

          if (! $getroot) {
            die('Could not fetch data: '.mysqi_error($conn));
          }

          while ($row2 = mysqli_fetch_assoc($getroot)) {
            ?>
            <li class="nav-item">
              <a href="./list.php?id=<?php echo htmlspecialchars($row2['categoryid']);?>" class="nav-link" <?php if(htmlspecialchars($row2['active']) == 'false') 
              {?>
              hidden
              <?php };
              ?>><?php echo htmlspecialchars($row2['name']);?></a>
            </li>
          <?php };
          ?>
        </ul>
      </li>
      <li class="nav-item">
			<a href="../users/" class="nav-link">
				<i class="nav-icon fas fa-th"></i>
				<p>
					Users
				</p>
			</a>
			</li>
      <li class="nav-item">
			<a href="../users/groups/" class="nav-link">
				<i class="nav-icon fas fa-th"></i>
				<p>
					Groups
				</p>
			</a>
			</li>
			<li class="nav-item">
			<a href="../settings.php" class="nav-link">
				<i class="nav-icon fas fa-th"></i>
				<p>
					Settings
				</p>
			</a>
			</li>
      <?php if (isset($_SESSION['email'])): ?>
      <li class="nav-item">
			<a href="./index.php?logout='1'" class="nav-link">
				<i class="nav-icon fas fa-th"></i>
				<p>
					Logout
				</p>
			</a>
			</li>
      <?php endif ?>
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Dashboard</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="./">Admin</a></li>
              <li class="breadcrumb-item"><a href="../">Dashboard</a></li>
              <li class="breadcrumb-item">Locations</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <div class="content">
      <div class="container-fluid">
        <?php include ('../errors.php'); ?>
        <div class="row">
          <!-- notification message -->
  	<?php if (isset($_SESSION['success'])) : ?>
      <div class="error success" >
      	<h3>
          <?php 
          	echo $_SESSION['success'];
            unset($_SESSION["success"]);
          ?>
      	</h3>
      </div>
  	<?php endif ?>
     <div class="col-lg-6">
            <div class="card">
              <div class="card-body table-responsive p-0">
                <table class="table">
                  <thead>
                    <tr>
                      <th>Index</th>
                      <th>Name</th>
                      <th>Address</th>
                      <th>Edit</th>
                      <th>Remove</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                      $getlocations = mysqli_query($conn, $locations);

                      if (! $getlocations) {
                        die('Could not fetch data: '.mysqli_error($conn));
                      }

                      while($row = mysqli_fetch_assoc($getlocations)) {
                        ?>
                        <tr class="align-middle">
                          <td class="text-center"><?php echo htmlspecialchars($row['locationID']);?></td>
                          <td class="text-center"><?php echo htmlspecialchars($row['locationname']);?></td>
                          <td class="text-center"><?php echo htmlspecialchars($row['street']);?> <?php echo htmlspecialchars($row['number']);?> / <?php echo htmlspecialchars($row['addition']);?> , <?php echo htmlspecialchars($row['zipcode']);?> <?php echo htmlspecialchars($row['city']);?> <?php echo htmlspecialchars($row['nicename']);?></td>
                          <td>
                            <form action="./edit.php?id=<?php echo htmlspecialchars($row['locationID']);?>" method="post">
                              <input type="hidden" name="editlocation" value="<?php echo htmlspecialchars($row['locationID']);?>"/>
                              <button type="submit" class="btn btn-warning btn-block" name="editlocation">Edit Location</button>
                            </form>
                          </td>
                          <td>
                            <form action="./index.php" method="post">
                              <input type="hidden" name="location_remove" value="<?php echo htmlspecialchars($row['locationID']);?>"/>
                              <button type="submit" class="btn btn-danger btn-block" name="locationremove">Remove Location</button>
                            </form>
                          </td>        
                     <?php };
                    ?>
                  </tbody>
                </table>
              </div>
            </div>
          </div>
          <div class="col-md-6">
            <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">Add Location</h3>
              </div>
              <form action="./index.php" method="post">
                <div class="card-body">
                  <div class="form-group">
                    <label for="locationname">Name</label>
                    <input type="text" class="form-control" id="locationname" name="locationname" placeholder="Enter Location Name">
                  </div>
                  <div class="form-group">
                    <label for="locationstreet">Street</label>
                    <input type="text" class="form-control" id="locationstreet" name="locationstreet" placeholder="Enter Location Street">
                  </div>
                  <div class="form-group">
                    <label for="locationnumber">Number</label>
                    <input type="text" class="form-control" id="locationnumber" name="locationnumber" placeholder="Enter Location Number">
                  </div> 
                  <div class="form-group">
                    <label for="locationaddition">Addition</label>
                    <input type="text" class="form-control" id="locationaddition" name="locationaddition" placeholder="Enter Location Addition">
                  </div> 
                  <div class="form-group">
                    <label for="locationzipcode">Zipcode</label>
                    <input type="text" class="form-control" id="locationzipcode" name="locationzipcode" placeholder="Enter Location Zipcode">
                  </div> 
                  <div class="form-group">
                    <label for="locationcity">City</label>
                    <input type="text" class="form-control" id="locationcity" name="locationcity" placeholder="Enter Location City">
                  </div> 
                  <div class="form-group">
                    <label for="locationstate">State</label>
                    <input type="text" class="form-control" id="locationstate" name="locationstate" placeholder="Enter Location State">
                  </div>
                  <div class="form-group">
                    <label for="locationcountry">Country</label>
                    <select class="custom-select form-control border border-width-2" id="locationcountry" name="locationcountry">
                      <?php
                        $getcountries = mysqli_query($conn, $countries);

                        if (! $getcountries) {
                          die('Could not fetch data: '.mysqli_error($conn));
                        }
                        while ($row1 = mysqli_fetch_assoc($getcountries)) {?>
                          <option value="<?php echo htmlspecialchars($row1['countryid']) ;?>"><?php echo htmlspecialchars($row1['nicename']);?></option>
                        <?php };
                        ?>
                    </select>
                  </div>
                </div>
                <div class="card-footer">
                  <button type="submit" class="btn btn-primary btn-block" name="locationadd">Add Location</button>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div><!-- /.container-fluid -->
      <div class="modal fade" id="editlocation">
        <div class="modal-dialog">
          <div class="modal-content bg-warning">
            <div class="modal-header">
              <h4 class="modal-title">Edit Location</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
            <form action="./index.php" method="post">
              <?php if (isset($_POST['passedit'])) {
                $editlocationid = mysqli_real_escape_string($conn, $_POST['passedit']);

                $getlocationinfo = "SELECT * FROM locations WHERE locationID = $editlocationid";
                $getinfo = mysqli_query($conn, $getlocationinfo);
                if (! $getinfo) {
                  die('Could not fetch data:' .mysqli_error($conn));
                }
                while ($row4 = mysqli_fetch_assoc($getinfo)) {
                  $locationname2 = htmlspecialchars($row4['locationname']);
                  $locationstreet2 = htmlspecialchars($row4['street']);
                  $locationnumber2 = htmlspecailchars($row4['number']);
                  $locationaddition2 = htmlspecialchars($row4['addition']);
                  $locationzipcode2 = htmlspecialchars($row4['zipcode']);
                  $locationcity2 = htmlspecialchars($row4['city']);
                  $locationstate2 =htmlspecialchars($row4['state']);
                  $locationcountry2 = htmlspecialchars($row4['countryID']);
                  ?>
                <div class="card-body">
                  <div class="form-group">
                    <label for="locationname">Name</label>
                    <input type="text" class="form-control" id="locationname" name="locationname" placeholder="<?php echo $locationname2;?>">
                  </div>
                  <div class="form-group">
                    <label for="locationstreet">Street</label>
                    <input type="text" class="form-control" id="locationstreet" name="locationstreet" placeholder="<?php echo $locationstreet2;?>">
                  </div>
                  <div class="form-group">
                    <label for="locationnumber">Number</label>
                    <input type="text" class="form-control" id="locationnumber" name="locationnumber" placeholder="<?php echo $locationnumber2;?>">
                  </div> 
                  <div class="form-group">
                    <label for="locationaddition">Addition</label>
                    <input type="text" class="form-control" id="locationaddition" name="locationaddition" placeholder="<?php echo $locationaddition2;?>">
                  </div> 
                  <div class="form-group">
                    <label for="locationzipcode">Zipcode</label>
                    <input type="text" class="form-control" id="locationzipcode" name="locationzipcode" placeholder="<?php echo $locationzipcode2;?>">
                  </div> 
                  <div class="form-group">
                    <label for="locationcity">City</label>
                    <input type="text" class="form-control" id="locationcity" name="locationcity" placeholder="<?php echo $locationcity2;?>">
                  </div> 
                  <div class="form-group">
                    <label for="locationstate">State</label>
                    <input type="text" class="form-control" id="locationstate" name="locationstate" placeholder="<?php echo $locationstate2;?>">
                  </div>
                  <div class="form-group">
                    <label for="locationcountry">Country</label>
                    <select class="custom-select form-control border border-width-2" id="locationcountry" name="locationcountry">
                      <?php
                        $getcountries = mysqli_query($conn, $countries);

                        if (! $getcountries) {
                          die('Could not fetch data: '.mysqli_error($conn));
                        }
                        while ($row3 = mysqli_fetch_assoc($getcountries)) {?>
                          <option value="<?php echo htmlspecialchars($row3['countryid']) ;?>"><?php echo htmlspecialchars($row3['nicename']);?></option>
                        <?php };
                        ?>
                    </select>
                  </div>
                </div>
                <?php }

              }
              ?>
              </form>
            </div>
            <div class="modal-footer justify-content-between">
              <button type="button" class="btn btn-outline-dark" data-dismiss="modal">Close</button>
              <button type="button" class="btn btn-outline-dark" name="edit_location">Save changes</button>
            </div>
          </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
      </div>
      <!-- /.modal -->


    </div>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

  <!-- Main Footer -->
  <footer class="main-footer">
    <!-- Default to the left -->
	<?php include('../footer.php'); ?>
  </footer>
</div>
<!-- ./wrapper -->

<!-- REQUIRED SCRIPTS -->

<!-- jQuery -->
<script src="../plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="../plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- SweetAlert2 -->
<script src="../plugins/sweetalert2/sweetalert2.min.js"></script>
<!-- Toastr -->
<script src="../plugins/toastr/toastr.min.js"></script>
<!-- AdminLTE App -->
<script src="../js/adminlte.min.js"></script>
</body>
</html>
