<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="shortcut icon" href="../../favicon.jpg" type="image/x-icon">
  <?php
  include('../../../config.php');
  include('../../authentication.php');
  $_SESSION['message'] = '';
  $id = $_GET['id'];
  $getgroupperms = "SELECT * FROM permissions INNER JOIN permissionslist on permissions.permissionID = permissionslist.permissionID INNER JOIN groups ON permissions.groupID = groups.groupID WHERE groups.groupID = $id";

  if (isset($_GET['logout'])) {
    session_destroy();
  }
  include('../../queries.php');
  include('../../server.php');

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
  <link rel="stylesheet" href="../../plugins/fontawesome-free/css/all.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="../../css/adminlte.min.css">
  
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
      <img src="../../favicon.jpg" alt="Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
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
            <a href="../../" class="nav-link">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
                Dashboard
              </p>
            </a>
          </li>
		  <li class="nav-item">
            <a href="../../locations/" class="nav-link">
              <i class="nav-icon fas fa-users-cog"></i>
              <p>
                Locations
              </p>
            </a>
          </li>
          <li class="nav-item">
			<a href="../../categories/" class="nav-link">
				<i class="nav-icon fas fa-th"></i>
				<p>
					Categories
				</p>
			</a>
			</li>
      <li class="nav-item">
			<a href="../../brands/" class="nav-link">
				<i class="nav-icon fas fa-th"></i>
				<p>
					Brands
				</p>
			</a>
			</li>
      <li class="nav-item">
			<a href="../../brands/contact/" class="nav-link">
				<i class="nav-icon fas fa-th"></i>
				<p>
					Contacts
				</p>
			</a>
			</li>
      <li class="nav-item">
			<a href="../../measurements/" class="nav-link">
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
          <?php
          $getroot = mysqli_query($conn, $rootcategories);

          if (! $getroot) {
            die('Could not fetch data: '.mysqi_error($conn));
          }

          while ($row2 = mysqli_fetch_assoc($getroot)) {
            ?>
            <li class="nav-item">
              <a href="../../items/list.php?id=<?php echo htmlspecialchars($row2['categoryid']);?>" class="nav-link"><?php echo htmlspecialchars($row2['name']);?></a>
            </li>
          <?php };
          ?>
        </ul>
      </li>
		  <li class="nav-item">
			<a href="../" class="nav-link">
				<i class="nav-icon fas fa-th"></i>
				<p>
					Users
				</p>
			</a>
			</li>
      <li class="nav-item">
			<a href="./" class="nav-link active">
				<i class="nav-icon fas fa-th"></i>
				<p>
					Groups
				</p>
			</a>
			</li>
			<li class="nav-item">
			<a href="../../settings.php" class="nav-link">
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
              <li class="breadcrumb-item"><a href="../../">Admin</a></li>
              <li class="breadcrumb-item"><a href="../../">Dashboard</a></li>
              <li class="breadcrumb-item"><a href="../">Users</a></li>
              <li class="breadcrumb-item active">Groups</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <div class="content">
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
      <div class="container-fluid">
        <div class="row">
    <div class="col-lg-6">
            <div class="card">
              <div class="card-body table-responsive p-0">
                <table class="table">
                  <thead>
                    <tr>
                      <th>Index</th>
                      <th>Name</th>
                      <th>Active</th>
                      <th>Edit</th>
                      <th>Permissions</th>
                      <th>Remove</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                      $getgroups = mysqli_query($conn, $grouplist);

                      if (! $getgroups) {
                        die('Could not fetch data: '.mysqli_error($conn));
                      }

                      while($row = mysqli_fetch_assoc($getgroups)) {
                        ?>
                        <tr class="align-middle">
                          <td class="text-center"><?php echo htmlspecialchars($row['groupID']);?></td>
                          <td class="text-center"><?php echo htmlspecialchars($row['groupname']);?></td>
                          <td class="text-center"><?php echo htmlspecialchars($row['active']);?></td>
                          <td>
                            <form name="group_edit" action="./edit.php?id=<?php echo htmlspecialchars($row['groupID']);?>)" method="post">
                              <input type="hidden" name="groupedit" value="<?php echo htmlspecialchars($row['groupID']);?>"/>
                              <button type="submit" class="btn btn-warning btn-block" value="edit group"></button>
                            </form>
                          </td>
                          <td>
                            <form name="groupperms" action="./perms.php" method="post">
                              <input type="hidden" name="groupperms" value="<?php echo htmlspecialchars($row['groupID']);?>"/>
                              <button type="submit" class="btn btn-warning btn-block" value="edit groupperms"></button>
                            </form>
                          </td>  
                          <td>
                            <form name="groupremove" action="./index.php" method="post">
                              <input type="hidden" name="groupremove" value="<?php echo htmlspecialchars($row['groupID']);?>"/>
                              <button type="submit" class="btn btn-danger btn-block" value="remove group"></button>
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
            <div class="card card-primary input-group">
              <div class="card-header">
                <h3 class="card-title">Add Group</h3>
              </div>
              <form action="./index.php" method="post">
                <div class="card-body">
                  <div class="form-group">
                    <label for="groupname" class="control-label">Name</label>
                    <input type="text" class="form-control" name="groupname" placeholder="Enter Name">
                  </div>
                  <div class="form-group">
                    <label for="groupactive">Group Active</label>
                    <select class="custom-select form-control border border-width-2" name="groupactive">
                      <option value="true">Yes</option>
                      <option value="false">No</option>
                    </select>
                  </div>
                </div>
                <div class="card-footer">
                  <button type="submit" class="btn btn-primary btn-block" name="add_group">Add Group</button>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

  <!-- Main Footer -->
  <footer class="main-footer">
    <!-- Default to the left -->
	<?php include('../../footer.php'); ?>
  </footer>
</div>
<!-- ./wrapper -->

<!-- REQUIRED SCRIPTS -->

<!-- jQuery -->
<script src="../../plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="../../plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="../../js/adminlte.min.js"></script>
<!-- Toaster -->
<script src="../../plguins/toastr/toastr.min.js"></script>
<!-- Sweetalert -->
<script src="../../plugins/sweetalert2/sweetalert2.min.js"></script>

<!-- Required php code -->

</body>
</html>