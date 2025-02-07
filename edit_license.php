<?php
include("include/conn.php");
include("include/function.php");

// Check session and redirect if not logged in
$login = cekSession();
if ($login != 1) {
    redirect("login.php");
}

// Fetch license details
if (isset($_GET['id'])) {
    $id = intval($_GET['id']);

    $stmt = $conn->prepare("SELECT `id`, `customer_name`, `whatsapp_number`, `license_key`, `end_date`, `status` FROM `users` WHERE `id` = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();
    $license = $result->fetch_assoc();

    if (!$license) {
        echo "License not found!";
        exit;
    }

    // Extract the end date and calculate validity period
    $end_date = new DateTime($license['end_date']);
    $today = new DateTime();
    $validity = $today->diff($end_date)->days;

} else {
    echo "No license ID provided!";
    exit;
}

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['generate_key'])) {
        // Generate a new license key
        $new_key = generateLicenseKey();

        // Update the database with the new license key
        $stmt = $conn->prepare("UPDATE `users` SET `license_key` = ? WHERE `id` = ?");
        $stmt->bind_param("si", $new_key, $id);
        if ($stmt->execute()) {
            echo "New license key generated successfully!";
            // Reload the page to reflect changes
            header("Location: edit_license.php?id=" . $id);
            exit;
        } else {
            echo "Error generating license key: " . $stmt->error;
        }
    } else {
        // Update license details
        $customer_name = $_POST['customer_name'];
        $whatsapp_number = $_POST['whatsapp_number'];
        $license_key = $_POST['license_key'];
        $end_date = $_POST['end_date'];
        $status = 'true'; // Status is hidden and always set to true
        $datetime = date('Y-m-d H:i:s', strtotime($end_date));
        // Prepare and execute the update query
        $stmt = $conn->prepare("UPDATE `users` SET `customer_name` = ?, `whatsapp_number` = ?, `license_key` = ?, `end_date` = ?, `status` = ? WHERE `id` = ?");
        $stmt->bind_param("sssssi", $customer_name, $whatsapp_number, $license_key, $datetime, $status, $id);

        if ($stmt->execute()) {
            echo "License updated successfully!";
            header("Location: all-licenses.php"); // Redirect to the license list page
            exit;
        } else {
            echo "Error updating license: " . $stmt->error;
        }
    }
}

function generateLicenseKey()
{
    $chars = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
    $key = '';
    for ($i = 0; $i < 4; $i++) {
        $key .= implode('', array_map(function () use ($chars) {
            return $chars[random_int(0, strlen($chars) - 1)];
        }, range(1, 4)));
        if ($i < 3) {
            $key .= '-';
        }
    }
    return $key;
}
?>
<!DOCTYPE html>
<html lang="en" data-textdirection="ltr">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    <meta name="description" content="Chameleon Admin - Edit License">
    <meta name="keywords"
        content="admin template, Chameleon admin template, dashboard template, gradient admin template, responsive admin template, webapp, eCommerce dashboard, analytic dashboard">
    <meta name="author" content="ThemeSelect">
    <title>Edit License</title>
    <link rel="apple-touch-icon" href="assets/images/ico/apple-icon-120.png">
    <link rel="shortcut icon" type="image/x-icon" href="assets/images/ico/favicon.ico">
    <link
        href="https://fonts.googleapis.com/css?family=Muli:300,300i,400,400i,600,600i,700,700i%7CComfortaa:300,400,700"
        rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="assets/css/vendors.css">
    <link rel="stylesheet" type="text/css" href="assets/css/app-lite.css">
    <link rel="stylesheet" type="text/css" href="assets/css/core/menu/menu-types/vertical-menu.css">
    <link rel="stylesheet" type="text/css" href="assets/css/core/colors/palette-gradient.css">
    <style>
        .form-group {
            margin-bottom: 15px;
        }

        .form-group label {
            display: block;
            margin-bottom: 5px;
        }

        .form-group input,
        .form-group select {
            width: calc(100% - 120px);
            /* Adjust width to leave space for the button */
            padding: 8px;
            box-sizing: border-box;
            display: inline-block;
        }

        .btn-submit,
        .btn-generate {
            padding: 10px 10px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 16px;
            display: inline-block;
            vertical-align: middle;
        }

        .btn-submit {
            background-color: #007bff;
            color: #fff;
        }

        .btn-submit:hover {
            background-color: #0056b3;
        }

        .btn-generate {
            background-color: #28a745;
            color: #fff;
            width: 100px;
            /* Adjust button width */
            margin-left: 10px;
        }

        .btn-generate:hover {
            background-color: #218838;
        }

        .input-container {
            position: relative;
        }

        .hidden {
            display: none;
        }
    </style>
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
                <h3 class="content-header-title">Edit License</h3>
            </div>
            <div class="content-header-right col-md-8 col-12">
                <div class="breadcrumbs-top float-md-right">
                    <div class="breadcrumb-wrapper mr-1">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                            <li class="breadcrumb-item"><a href="index.php">All Licenses</a></li>
                            <li class="breadcrumb-item active">Edit License</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
        <div class="content-body">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">Edit License Details</h4>
                            <a class="heading-elements-toggle"><i class="la la-ellipsis-v font-medium-3"></i></a>
                        </div>
                        <div class="card-content collapse show">
                            <div class="card-body">
                                <form method="post" action="">
                                    <div class="form-group">
                                        <label for="customer_name">Client Name:</label>
                                        <input type="text" id="customer_name" name="customer_name"
                                            value="<?php echo htmlspecialchars($license['customer_name']); ?>" required>
                                    </div>

                                    <div class="form-group">
                                        <label for="whatsapp_number">Whatsapp Number:</label>
                                        <input type="text" id="whatsapp_number" name="whatsapp_number"
                                            value="<?php echo htmlspecialchars($license['whatsapp_number']); ?>"
                                            required>
                                    </div>

                                    <div class="form-group input-container">
                                        <label for="license_key">License Key:</label>
                                        <input type="text" id="license_key" name="license_key"
                                            value="<?php echo htmlspecialchars($license['license_key']); ?>" required>
                                        <button type="button" class="btn-generate" id="generate_key">Generate</button>
                                    </div>

                                    <fieldset class="form-group">
                                        <h6 class="card-title">Select End Date and Time</h6>
                                        <input type="datetime-local" class="form-control" id="end_date" name="end_date" value="<?php echo htmlspecialchars($license['end_date']); ?>"
                                            required>
                                    </fieldset>


                                    <!-- Status hidden input -->
                                    <input type="hidden" name="status" value="true">

                                    <button type="submit" class="btn-submit">Update License</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Edit License end -->
        </div>
    </div>
</div>
<!-- ////////////////////////////////////////////////////////////////////////////-->
<?php include("include/footer.php"); ?>
<!-- BEGIN VENDOR JS-->
<script src="assets/vendors/js/vendors.min.js" type="text/javascript"></script>
<!-- BEGIN VENDOR JS-->
<!-- BEGIN CHAMELEON JS-->
<script src="assets/js/core/app-menu-lite.js" type="text/javascript"></script>
<script src="assets/js/core/app-lite.js" type="text/javascript"></script>
<!-- END CHAMELEON JS-->

<script>
    // Generate new license key and set it in the license key input field
    document.getElementById('generate_key').addEventListener('click', function () {
        function generateLicenseKey() {
            const chars = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
            let key = '';
            for (let i = 0; i < 4; i++) {
                key += Array.from({ length: 4 }, () => chars.charAt(Math.floor(Math.random() * chars.length))).join('');
                if (i < 3) {
                    key += '-';
                }
            }
            return key;
        }
        document.getElementById('license_key').value = generateLicenseKey();
    });
</script>
<script>
    document.addEventListener("DOMContentLoaded", function () {
        const endDateInput = document.getElementById("end_date");
        if (!endDateInput.value) {  // If no date-time is set, set the current date and time
            const now = new Date();
            const year = now.getFullYear();
            const month = String(now.getMonth() + 1).padStart(2, '0'); // Months are zero-indexed
            const day = String(now.getDate()).padStart(2, '0');
            const hours = String(now.getHours()).padStart(2, '0');
            const minutes = String(now.getMinutes()).padStart(2, '0');

            const formattedDateTime = `${year}-${month}-${day}T${hours}:${minutes}`; // Format: YYYY-MM-DDTHH:MM
            endDateInput.value = formattedDateTime;
        }
    });
</script>
</body>

</html>