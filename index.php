<?php
include("include/conn.php");
include("include/function.php");

$login = cekSession();
if ($login != 1) {
    redirect("login.php");
}

$user_id = $_SESSION['id'];
$user_type = $_SESSION['user_type'];

// Function to get counts based on user type
function getCounts($conn, $user_id, $user_type)
{
    $counts = array();

    if ($user_type === 'admin') {
        // Admin dashboard data
        $totalUsersQuery = "SELECT COUNT(*) AS total_users FROM admin";
        $totalLicensesQuery = "SELECT COUNT(*) AS total_licenses FROM users WHERE deleted_key != 'yes'";
        $totalInactiveLicensesQuery = "SELECT COUNT(*) AS total_inactive_licenses FROM users WHERE status = 'false' AND deleted_key != 'yes'";
        $totalActiveLicensesQuery = "SELECT COUNT(*) AS total_active_licenses FROM users WHERE status = 'true' AND deleted_key != 'yes'";

        $totalResellersQuery = "SELECT COUNT(*) AS total_resellers FROM admin WHERE user_type = 'reseller'AND deleted = 'no'";

        $counts['total_users'] = mysqli_fetch_assoc(mysqli_query($conn, $totalUsersQuery))['total_users'];
        $counts['total_licenses'] = mysqli_fetch_assoc(mysqli_query($conn, $totalLicensesQuery))['total_licenses'];
        $counts['total_inactive_licenses'] = mysqli_fetch_assoc(mysqli_query($conn, $totalInactiveLicensesQuery))['total_inactive_licenses'];
        $counts['total_active_licenses'] = mysqli_fetch_assoc(mysqli_query($conn, $totalActiveLicensesQuery))['total_active_licenses'];
        $counts['total_resellers'] = mysqli_fetch_assoc(mysqli_query($conn, $totalResellersQuery))['total_resellers'];
    } elseif ($user_type === 'user') {
        $totalUsersQuery = "
        SELECT COUNT(*) AS total_users 
        FROM admin 
        WHERE admin_id = $user_id OR id = $user_id
    ";

        // Total licenses, including licenses created by the logged-in user and their created users
        $totalLicensesQuery = "
    SELECT COUNT(*) AS total_licenses 
    FROM users 
    WHERE deleted_key != 'yes' 
    AND (user_id = $user_id OR user_id IN (SELECT id FROM admin WHERE admin_id = $user_id AND user_type != 'user'))
";

        // Total inactive licenses for the logged-in user and their created users, excluding user_type = 'user'
        $totalInactiveLicensesQuery = "
    SELECT COUNT(*) AS total_inactive_licenses 
    FROM users 
    WHERE status = 'false' 
    AND deleted_key != 'yes' 
    AND (user_id = $user_id OR user_id IN (SELECT id FROM admin WHERE admin_id = $user_id AND user_type != 'user'))
";

        // Total active licenses for the logged-in user and their created users, excluding user_type = 'user'
        $totalActiveLicensesQuery = "
    SELECT COUNT(*) AS total_active_licenses 
    FROM users 
    WHERE status = 'true' 
    AND deleted_key != 'yes' 
    AND (user_id = $user_id OR user_id IN (SELECT id FROM admin WHERE admin_id = $user_id AND user_type != 'user'))
";

        // Total resellers created by the logged-in user
        $totalResellersQuery = "
        SELECT COUNT(*) AS total_resellers 
        FROM admin 
        WHERE user_type = 'reseller' AND deleted = 'no'
        AND admin_id = $user_id
    ";


        $counts['total_users'] = mysqli_fetch_assoc(mysqli_query($conn, $totalUsersQuery))['total_users'];
        $counts['total_licenses'] = mysqli_fetch_assoc(mysqli_query($conn, $totalLicensesQuery))['total_licenses'];
        $counts['total_inactive_licenses'] = mysqli_fetch_assoc(mysqli_query($conn, $totalInactiveLicensesQuery))['total_inactive_licenses'];
        $counts['total_active_licenses'] = mysqli_fetch_assoc(mysqli_query($conn, $totalActiveLicensesQuery))['total_active_licenses'];
        $counts['total_resellers'] = mysqli_fetch_assoc(mysqli_query($conn, $totalResellersQuery))['total_resellers'];
    } else {
        // Reseller dashboard data
        $totalLicensesQuery = "SELECT COUNT(*) AS total_licenses FROM users WHERE user_id = '$user_id'AND deleted_key != 'yes'";
        $totalInactiveLicensesQuery = "SELECT COUNT(*) AS total_inactive_licenses FROM users WHERE user_id = '$user_id' AND status = 'false' AND deleted_key != 'yes' ";
        $totalActiveLicensesQuery = "SELECT COUNT(*) AS total_active_licenses FROM users WHERE user_id = '$user_id' AND status = 'true'AND deleted_key != 'yes'";

        $counts['total_licenses'] = mysqli_fetch_assoc(mysqli_query($conn, $totalLicensesQuery))['total_licenses'];
        $counts['total_inactive_licenses'] = mysqli_fetch_assoc(mysqli_query($conn, $totalInactiveLicensesQuery))['total_inactive_licenses'];
        $counts['total_active_licenses'] = mysqli_fetch_assoc(mysqli_query($conn, $totalActiveLicensesQuery))['total_active_licenses'];
    }

    return $counts;
}

$dashboardData = getCounts($conn, $user_id, $user_type);
?>

<!DOCTYPE html>
<html class="loading" lang="en" data-textdirection="ltr">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    <meta name="description" content="Dashboard">
    <meta name="keywords" content="admin template, dashboard, metrics">
    <meta name="author" content="ThemeSelect">
    <title>Dashboard</title>
    <link rel="apple-touch-icon" href="assets/images/ico/apple-icon-120.png">
    <link rel="shortcut icon" type="image/x-icon" href="assets/images/ico/favicon.ico">
    <link
        href="https://fonts.googleapis.com/css?family=Muli:300,300i,400,400i,600,600i,700,700i%7CComfortaa:300,400,700"
        rel="stylesheet">
    <link href="https://maxcdn.icons8.com/fonts/line-awesome/1.1/css/line-awesome.min.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="assets/css/vendors.css">
    <link rel="stylesheet" type="text/css" href="assets/css/app-lite.css">
    <link rel="stylesheet" type="text/css" href="assets/css/core/menu/menu-types/vertical-menu.css">
    <link rel="stylesheet" type="text/css" href="assets/css/core/colors/palette-gradient.css">
</head>

<body>
    <?php include("include/header.php"); ?>
    <?php include("include/sidebar.php"); ?>

    <div class="app-content content">
        <div class="content-wrapper">
            <div class="content-wrapper-before"></div>
            <div class="content-header row">
                <div class="content-header-left col-md-4 col-12 mb-2">
                    <h3 class="content-header-title">Dashboard</h3>
                </div>
            </div>
            <div class="content-body">
                <div class="row">
                    <?php if ($user_type === 'admin') { ?>
                        <div class="col-md-3">
                            <div class="card">
                                <div class="card-content">
                                    <div class="card-body">
                                        <a href="">
                                            <h4 class="card-title">Total Users</h4>
                                            <p class="card-text"><?php echo $dashboardData['total_users']; ?></p>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="card">
                                <div class="card-content">
                                    <div class="card-body">
                                        <a href="all-licenses.php">
                                            <h4 class="card-title">Total Licenses</h4>
                                            <p class="card-text"><?php echo $dashboardData['total_licenses']; ?></p>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="card">
                                <div class="card-content">
                                    <div class="card-body">
                                        <a href="all-inactivelicenses.php">
                                            <h4 class="card-title">Total Inactive Licenses</h4>
                                            <p class="card-text"><?php echo $dashboardData['total_inactive_licenses']; ?>
                                            </p>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="card">
                                <div class="card-content">
                                    <div class="card-body">
                                        <a href="all-activelicenses.php">
                                            <h4 class="card-title">Total Active Licenses</h4>
                                            <p class="card-text"><?php echo $dashboardData['total_active_licenses']; ?></p>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="card">
                                <div class="card-content">
                                    <div class="card-body">
                                        <a href="all-reseller.php">
                                            <h4 class="card-title">Total Resellers</h4>
                                            <p class="card-text"><?php echo $dashboardData['total_resellers']; ?></p>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php } elseif ($user_type === 'user') { ?>
                        <div class="col-md-3">
                            <div class="card">
                                <div class="card-content">
                                    <div class="card-body">
                                        <a href="">
                                            <h4 class="card-title">Total Users</h4>
                                            <p class="card-text"><?php echo $dashboardData['total_users']; ?></p>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="card">
                                <div class="card-content">
                                    <div class="card-body">
                                        <a href="all-licenses.php">
                                            <h4 class="card-title">Total Licenses</h4>
                                            <p class="card-text"><?php echo $dashboardData['total_licenses']; ?></p>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="card">
                                <div class="card-content">
                                    <div class="card-body">
                                        <a href="all-inactivelicenses.php">
                                            <h4 class="card-title">Total Inactive Licenses</h4>
                                            <p class="card-text"><?php echo $dashboardData['total_inactive_licenses']; ?>
                                            </p>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="card">
                                <div class="card-content">
                                    <div class="card-body">
                                        <a href="all-activelicenses.php">
                                            <h4 class="card-title">Total Active Licenses</h4>
                                            <p class="card-text"><?php echo $dashboardData['total_active_licenses']; ?></p>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="card">
                                <div class="card-content">
                                    <div class="card-body">
                                        <a href="all-reseller.php">
                                            <h4 class="card-title">Total Resellers</h4>
                                            <p class="card-text"><?php echo $dashboardData['total_resellers']; ?></p>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>

                    <?php } else { ?>
                        <div class="col-md-4">
                            <div class="card">
                                <div class="card-content">
                                    <div class="card-body">
                                        <a href="all-licenses.php">
                                            <h4 class="card-title">Total Licenses Created</h4>
                                            <p class="card-text"><?php echo $dashboardData['total_licenses']; ?></p>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="card">
                                <div class="card-content">
                                    <div class="card-body">
                                        <a href="all-inactivelicenses.php">
                                            <h4 class="card-title">Total Inactive Licenses</h4>
                                            <p class="card-text"><?php echo $dashboardData['total_inactive_licenses']; ?>
                                            </p>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="card">
                                <div class="card-content">
                                    <div class="card-body">
                                        <a href="all-activelicenses.php">
                                            <h4 class="card-title">Total Active Licenses</h4>
                                            <p class="card-text"><?php echo $dashboardData['total_active_licenses']; ?></p>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php } ?>
                </div>
            </div>
        </div>
    </div>
    <?php include("include/footer.php"); ?>

    <script src="assets/vendors/js/vendors.min.js" type="text/javascript"></script>
    <script src="assets/js/core/app-menu-lite.js" type="text/javascript"></script>
    <script src="assets/js/core/app-lite.js" type="text/javascript"></script>
</body>

</html>