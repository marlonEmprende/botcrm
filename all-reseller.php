<?php
include("include/conn.php");
include("include/function.php");
$login = cekSession();
if ($login != 1) {
  redirect("login.php");
}
?>
<!DOCTYPE html>
<html class="loading" lang="en" data-textdirection="ltr">

<head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
  <meta name="description"
    content="Chameleon Admin is a modern Bootstrap 4 webapp &amp; admin dashboard html template with a large number of components, elegant design, clean and organized code.">
  <meta name="keywords"
    content="admin template, Chameleon admin template, dashboard template, gradient admin template, responsive admin template, webapp, eCommerce dashboard, analytic dashboard">
  <meta name="author" content="ThemeSelect">
  <title id="title"></title>
  <link rel="apple-touch-icon" href="assets/images/ico/apple-icon-120.png">
  <link rel="shortcut icon" type="image/x-icon" href="assets/images/ico/favicon.ico">
  <link href="https://fonts.googleapis.com/css?family=Muli:300,300i,400,400i,600,600i,700,700i%7CComfortaa:300,400,700"
    rel="stylesheet">
  <link href="https://maxcdn.icons8.com/fonts/line-awesome/1.1/css/line-awesome.min.css" rel="stylesheet">
  <!-- BEGIN VENDOR CSS-->
  <link rel="stylesheet" type="text/css" href="assets/css/vendors.css">
  <!-- END VENDOR CSS-->
  <!-- BEGIN CHAMELEON  CSS-->
  <link rel="stylesheet" type="text/css" href="assets/css/app-lite.css">
  <!-- END CHAMELEON  CSS-->
  <!-- BEGIN Page Level CSS-->
  <link rel="stylesheet" type="text/css" href="assets/css/core/menu/menu-types/vertical-menu.css">
  <link rel="stylesheet" type="text/css" href="assets/css/core/colors/palette-gradient.css">
  <!-- END Page Level CSS-->
  <!-- BEGIN Custom CSS-->
  <link rel="stylesheet" type="text/css" href="assets/css/core/colors/palette-gradient.css">
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">

  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css" />
  <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@10/dist/sweetalert2.min.css">
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
  <!-- END Custom CSS-->
</head>
<?php
include("include/header.php");
include("include/sidebar.php");
?>
<div class="app-content content">
  <div class="content-wrapper">
    <div class="content-wrapper-before"></div>
    <div class="content-header row">
      <div class="content-header-left col-md-4 col-12 mb-2">
        <h3 class="content-header-title">All Reseller</h3>
      </div>
      <div class="content-header-right col-md-8 col-12">
        <div class="breadcrumbs-top float-md-right">
          <div class="breadcrumb-wrapper mr-1">
            <ol class="breadcrumb">
              <li class="breadcrumb-item"><a href="index.php">Home</a>
              </li>
              <li class="breadcrumb-item active">All Reseller
              </li>
            </ol>
          </div>
        </div>
      </div>
    </div>
    <div class="content-body"><!-- Basic All Licenses start -->


      <!-- Bordered table start -->
      <div class="row">
        <div class="col-12">
          <div class="card">
            <div class="card-header">
              <h4 class="card-title">All Resellers</h4>
              <a class="heading-elements-toggle"><i class="la la-ellipsis-v font-medium-3"></i></a>

            </div>
            <div class="card-content collapse show">
              <div class="card-body">
                <!-- <p class="card-text">Add <code>.table-bordered</code> for borders on all sides of the table and cells.</p> -->
              </div>
              <div class="table-responsive">
                <table class="table table-bordered mb-0" id="resellerTable">
                  <thead>
                    <tr>
                      <th>#</th>
                      <th>Username</th>
                      <th>Name</th>
                      <th>Contact Number</th>
                      <th>Status</th>
                      <th>Start Date</th>
                      <th>Expired Date</th>
                      <th>Owner</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tbody>

                    <?php
                    $iduser = 0;
                    if ($_SESSION['user_type'] == 'admin') {
                      $q = mysqli_query($conn, "SELECT `id`,`username`, `name`, `contact_number`, `password`, `user_type`,`start_date`, `expired_date`, `status`,`admin_id` FROM `admin` WHERE `user_type` = 'reseller' AND `deleted` != 'yes'");
                    } else {
                      $u_id = $_SESSION['id'];
                      $q = mysqli_query($conn, "SELECT `id`,`username`, `name`, `contact_number`, `password`, `user_type`,`start_date`, `expired_date`, `status`,`admin_id` FROM `admin` WHERE `user_type` = 'reseller'AND `admin_id` = '$u_id' AND `deleted` != 'yes'");

                    }
                    while ($row = mysqli_fetch_assoc($q)) {
                      $iduser++;
                      $id = $row['id'];
                      echo '<tr>';
                      echo '<td scope="row">' . $iduser . '</td>';
                      echo '<td>' . $row['username'] . '</td>';
                      echo '<td>' . $row['name'] . '</td>';
                      echo '<td>' . $row['contact_number'] . '</td>';
                      echo '<td>';
                      if ($row['status'] == 'true') {
                        echo '<span class="license-status">Live</span>';
                      } else {
                        echo '<span class="license-status">Expired</span>';
                      }
                      echo '</td>';

                      echo '<td>' . $row['start_date'] . '</td>';
                      echo '<td>' . $row['expired_date'] . '</td>';
                      $admin_id = $row['admin_id'];
                      $admin_query = mysqli_query($conn, "SELECT username FROM admin WHERE id = '$admin_id'");
                      $admin_row = mysqli_fetch_assoc($admin_query);
                      $username = $admin_row['username'] ?? 'N/A';
                      echo '<td>' . $username . '</td>';
                      echo '<td>
            <div class="btn-group mr-1 mb-1">
                <button type="button" class="btn btn-secondary btn-min-width dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">Update</button>
                <div class="dropdown-menu">
                    <a class="dropdown-item activate-btn" href="#" data-id="' . $id . '">Activate</a>
                    <a class="dropdown-item deactivate-btn" href="#" data-id="' . $id . '">Deactivate</a>
                     <div class="dropdown-divider"></div>
                     <a class="dropdown-item change-password-btn" href="#" data-id="' . $id . '">Change Password</a>
                       <div class="dropdown-divider"></div>
                     <a class="dropdown-item activateall-btn" href="#" data-id="' . $id . '">Activate With License</a>
                    <a class="dropdown-item deactivateall-btn" href="#" data-id="' . $id . '">Deactivate With License</a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item delete-btn" href="#" data-id="' . $id . '">Delete</a>
                </div>
            </div>
          </td>';

                      echo '</tr>';
                    }

                    ?>
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
      </div>
      <!-- Bordered table end -->
    </div>
  </div>
</div>
<!-- ////////////////////////////////////////////////////////////////////////////-->


<?php include("include/footer.php"); ?>

<!-- BEGIN VENDOR JS-->
<!-- <script src="assets/vendors/js/vendors.min.js" type="text/javascript"></script> -->
<!-- BEGIN VENDOR JS-->
<!-- BEGIN PAGE VENDOR JS-->
<!-- END PAGE VENDOR JS-->
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js"></script>

<!-- BEGIN CHAMELEON  JS-->
<!-- <script src="assets/js/core/app-menu-lite.js" type="text/javascript"></script> -->
<!-- <script src="assets/js/core/app-lite.js" type="text/javascript"></script> -->
<!-- END CHAMELEON  JS-->
<!-- BEGIN PAGE LEVEL JS-->
<!-- END PAGE LEVEL JS-->
<script>
  $(document).ready(function () {
    $('#title').html('All License');
    $('#resellerTable').DataTable({
      "paging": true, // Enables pagination
      "ordering": true, // Enables sorting
      "searching": true, // Enables searching
      "order": [
        [4, "desc"]
      ], // Default sort by Activation Date in descending order
      "columnDefs": [{
        "orderable": false,
        "targets": 8
      } // Disable sorting on the "Actions" column

      ]
    });

    document.getElementById("sid-all").classList.add("active");
  });
</script>

<script>
  $(document).ready(function () {
    $('#title').html('All Reseller')
  });
  document.getElementById("sid-all").classList.add("active");
</script>
<script>
  $(document).ready(function () {
    $(document).on('click', '.activate-btn', function () {
      var id = $(this).data('id');
      updateResellerStatus(id, 'true');
    });

    $(document).on('click', '.deactivate-btn', function () {
      var id = $(this).data('id');
      updateResellerStatus(id, 'false');
    });
    // Event listeners
    $(document).on('click', '.activateall-btn', function () {
      var id = $(this).data('id');
      updateResellerallStatus(id, 'true');
    });

    $(document).on('click', '.deactivateall-btn', function () {
      var id = $(this).data('id');
      updateResellerallStatus(id, 'false');
    });
    $(document).on('click', '.delete-btn', function () {
      var id = $(this).data('id');
      deleteReseller(id);
    });
  });

  function updateResellerStatus(id, status) {
    $.ajax({
      url: 'function/update_status.php', // Update this URL to your PHP script
      type: 'POST',
      data: { id: id, status: status },
      success: function (response) {
        Swal.fire({
          title: 'Status Updated',
          text: response.message,
          icon: 'success',
          confirmButtonText: 'OK'
        });
        // Optionally, refresh the page or update the table view
      }
    });
  }

  function updateResellerallStatus(id, status) {
    $.ajax({
      url: 'function/update_statusall.php',
      type: 'POST',
      data: { id: id, status: status },
      dataType: 'json', // Expect JSON response
      success: function (response) {
        Swal.fire({
          title: 'Status Updated',
          text: response.message,
          icon: 'success',
          confirmButtonText: 'OK'
        }).then(() => {
          location.reload();
        });
        // Optionally, refresh the page or update the table view here
      },
      error: function (jqXHR, textStatus, errorThrown) {
        Swal.fire({
          title: 'Error',
          text: 'An error occurred: ' + textStatus,
          icon: 'error',
          confirmButtonText: 'OK'
        }).then(() => {
          location.reload();
        });
      }
    });
  }

  function deleteReseller(id) {
    if (confirm("Are you sure you want to mark this reseller as deleted?")) {
      $.ajax({
        url: 'function/delete_reseller.php',
        type: 'POST',
        data: { id: id },
        dataType: 'json',
        success: function (response) {
          alert(response.message);
          // Optionally, refresh the page or update the table view to reflect the change
          location.reload();
        },
        error: function (jqXHR, textStatus, errorThrown) {
          alert("An error occurred: " + textStatus);
        }
      });
    }
  }

</script>
<script>
  $(document).ready(function () {
    $(document).on('click', '.change-password-btn', function () {
      var id = $(this).data('id');
      var newPassword = generatePassword(); // Generate a new password

      // Call the function to update the password on the server and show the popup
      updatePassword(id, newPassword);
    });
  });

  // Function to generate a random password with digits 1-9 and 0
  function generatePassword() {
    const digits = '1234567890';
    let password = '';
    for (let i = 0; i < 6; i++) { // Set password length as needed (6 characters here)
      password += digits.charAt(Math.floor(Math.random() * digits.length));
    }
    return password;
  }

  // Function to update the password on the server and display the new password in a popup
  function updatePassword(id, newPassword) {
    $.ajax({
      url: 'function/update_password.php', // Endpoint to update the password
      type: 'POST',
      data: { id: id, password: newPassword },
      success: function (response) {
        Swal.fire({
          title: 'New Password Generated',
          text: 'New Password: ' + newPassword,
          icon: 'success',
          confirmButtonText: 'OK'
        });
      },
      error: function (jqXHR, textStatus, errorThrown) {
        alert("An error occurred: " + textStatus);
      }
    });
  }

</script>
</body>

</html>