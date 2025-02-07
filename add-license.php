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
    <meta name="description" content="Chameleon Admin is a modern Bootstrap 4 webapp &amp; admin dashboard html template with a large number of components, elegant design, clean and organized code.">
    <meta name="keywords" content="admin template, Chameleon admin template, dashboard template, gradient admin template, responsive admin template, webapp, eCommerce dashboard, analytic dashboard">
    <meta name="author" content="ThemeSelect">
    <title id="title"></title>
    <link rel="apple-touch-icon" href="assets/images/ico/apple-icon-120.png">
    <link rel="shortcut icon" type="image/x-icon" href="assets/images/ico/favicon.ico">
    <link href="https://fonts.googleapis.com/css?family=Muli:300,300i,400,400i,600,600i,700,700i%7CComfortaa:300,400,700" rel="stylesheet">
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
    <!-- END Custom CSS-->
</head>
<?php
include("include/header.php");
include("include/sidebar.php");
?>
<style>
    #response-message {
        text-align: center;
        /* Center-align the text horizontally */
        padding: 20px;
        /* Add padding for spacing */
        border: 1px solid #ddd;
        /* Add a border */
        border-radius: 5px;
        /* Round the corners */
        margin-top: 20px;
        /* Add some margin to separate it from other elements */
        font-size: 18px;
        /* Set the font size */
        font-weight: bold;
        /* Make the text bold */
    }

    /* Style for success messages */
    .success {
        background-color: #4CAF50;
        /* Green background color */
        color: #fff;
        /* White text color */
        border: 2px solid #45A049;
        /* Green border */
    }

    /* Style for error messages */
    .error {
        background-color: #FF5733;
        /* Red background color */
        color: #fff;
        /* White text color */
        border: 2px solid #D73925;
        /* Red border */
    }
</style>

<div class="app-content content">
    <div class="content-wrapper">
        <div class="content-wrapper-before"></div>
        <div class="content-header row">
            <div class="content-header-left col-md-4 col-12 mb-2">
                <h3 class="content-header-title">Add License For User</h3>
            </div>
            <div class="content-header-right col-md-8 col-12">
                <div class="breadcrumbs-top float-md-right">
                    <div class="breadcrumb-wrapper mr-1">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="index.php">Home</a>
                            </li>
                            <li class="breadcrumb-item active">Add License
                            </li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
        <div class="content-body"><!-- Basic Inputs start -->

            <div class="col-xl-12 col-lg-12 col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Add License</h4>
                    </div>
                    <div class="card-block">
                        <form id="generate">
                            <div class="card-body">
                                <fieldset class="form-group">
                                    <h6 class="card-title">Enter Whatsapp Number (With Country Code)</h6>
                                    <input type="number" class="form-control" id="wnumber" name="wnumber">
                                </fieldset>
                                <fieldset class="form-group">
                                    <h6 class="card-title">Enter Client Name</h6>
                                    <input type="text" class="form-control" id="cname" name="cname">
                                </fieldset>
                                <!-- <fieldset class="form-group">
                                    <h6 class="card-title">Enter Client Email</h6>
                                    <input type="text" class="form-control" id="email" name="email">
                                </fieldset> -->
                                <fieldset class="form-group">
                                    <h6 class="card-title">Select End Date</h6>
                                    <input type="date" class="form-control" id="end-date" name="end-date">
                                </fieldset>
                                <fieldset class="form-group">
                                    <button type="button" id="generate-license" class="btn btn-info btn-min-width mr-1 mb-1">Generate License</button>
                                </fieldset>
                            </div>
                        </form>
                        <div id="response-message"></div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>
<!-- ////////////////////////////////////////////////////////////////////////////-->

<?php include("include/footer.php"); ?>
<!-- BEGIN VENDOR JS-->
<script src="assets/vendors/js/vendors.min.js" type="text/javascript"></script>
<!-- BEGIN VENDOR JS-->
<!-- BEGIN PAGE VENDOR JS-->
<!-- END PAGE VENDOR JS-->
<!-- BEGIN CHAMELEON  JS-->
<script src="assets/js/core/app-menu-lite.js" type="text/javascript"></script>
<script src="assets/js/core/app-lite.js" type="text/javascript"></script>
<!-- END CHAMELEON  JS-->
<!-- BEGIN PAGE LEVEL JS-->
<script src="assets/vendors/js/forms/tags/form-field.js" type="text/javascript"></script>
<!-- END PAGE LEVEL JS-->

<script>
    $(document).ready(function() {
        $('#title').html('Add License')
    });
    document.getElementById("sid-add").classList.add("active");
</script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function() {
        $('#generate-license').click(function() {
            // Get form data
            var wnumber = $('#wnumber').val();
            var endDate = $('#end-date').val();
            var cname = $('#cname').val();
            // var email = $('#email').val();

            // Check for empty or null values
            // if (!wnumber || !endDate || !cname || !email) {
                if (!wnumber || !endDate || !cname ) {

                var errorMessage = "Please fill in all required fields.";
                $('#response-message').html('<div class="error">' + errorMessage + '</div>');
                return;
            }

            // Calculate the validity in days from today to the selected end date
            var today = new Date();
            var endDateObj = new Date(endDate);
            var validity = Math.ceil((endDateObj - today) / (1000 * 60 * 60 * 24)); // Calculate days

            // Send AJAX request to your PHP script
            $.ajax({
                type: 'POST',
                url: 'function/generate-license.php', // Replace with the correct path to your PHP script
                data: {
                    wnumber: wnumber,
                    validity: validity,
                    cname: cname
                },
                success: function(response) {
                    if (response.status === true) {
                        $('#response-message').html('<div class="success">' + response.message + '</div>');
                    } else {
                        $('#response-message').html('<div class="error">' + response.message + '</div>');
                    }
                },
                error: function() {
                    $('#response-message').html('<div class="error">An error occurred while processing your request.</div>');
                }
            });
        });
    });
</script>

</body>

</html>
