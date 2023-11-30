<?php
// Include PHPMailer
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'assets\phpmailer\phpmailer\src\Exception.php';
require 'assets\phpmailer\phpmailer\src\PHPMailer.php';
require 'assets\phpmailer\phpmailer\src\SMTP.php';

// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get the user's email address from the form
    $email = $_POST['email'];

    // Generate a random password
    $newPassword = generateRandomPassword();

    $isAdmin = checkUserRole($email, 'SUPER ADMIN');

    if ($isAdmin) {
        // Update the user's password in the database (you should replace this with your database update logic)
        // $hashPassword = password_hash($newPassword, PASSWORD_DEFAULT);
        $hashPassword = sha1($newPassword);
        $success = updatePasswordInDatabase($email, $hashPassword);

        if ($success) {
            // Send the new password via email
            $mail = new PHPMailer(true);

            try {
                // Server settings
                $mail->SMTPDebug = 0;                      //Enable verbose debug output
                $mail->isSMTP();                                            //Send using SMTP
                $mail->Host       = 'smtp.gmail.com';                    //Set the SMTP server to send through
                $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
                $mail->Username   = 'fourjshrmsys.notify@gmail.com';                     //SMTP username
                $mail->Password   = 'hgirsgnzuruzmyrr';                               //SMTP password
                $mail->SMTPSecure = 'tls';         //Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` also accepted
                $mail->Port       = 587;                                   //TCP port to connect to

                // Disable certificate verification
                $mail->SMTPOptions = array(
                    'ssl' => array(
                        'verify_peer' => false,
                        'verify_peer_name' => false,
                        'allow_self_signed' => true
                    )
                );

                // Set the email subject and body
                $mail->setFrom('fourjshrmsys.notify@gmail.com', 'Four Js HRM System');
                $mail->addAddress($email);
                $mail->Subject = 'Password Reset';
                $mail->Body = 'Your new password is: ' . $newPassword;

                // Send the email
                $mail->send();

                // Redirect to a confirmation page
                redirect(base_url() . 'login', 'refresh');
            } catch (Exception $e) {
                echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
            }
        } else {
            // Handle the case where the email is not found in the database
            echo "Email address not found.";
        }
    } else {
        // Handle the case where the user is not a SUPER ADMIN
        echo "You do not have permission to reset the password.";
    }
}

// Function to generate a random password
function generateRandomPassword()
{
    // Generate a random string (you can customize the length and characters)
    $characters = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
    $password = '';
    $length = 8;

    for ($i = 0; $i < $length; $i++) {
        $password .= $characters[rand(0, strlen($characters) - 1)];
    }

    return $password;
}

// Function to update the user's password in the database (replace with your database logic)
function updatePasswordInDatabase($email, $newPassword)
{
    // Implement your database update logic here
    // Example using PDO (you can adjust it based on your database library)

    try {
        // Replace 'your_database_host', 'your_database_name', 'your_database_user', and 'your_database_password' with your actual database credentials
        $pdo = new PDO('mysql:host=localhost;dbname=hrsystemci', 'root', '');

        // Prepare the SQL query
        $sql = "UPDATE employee SET em_password = :newPassword WHERE em_email = :email";
        $stmt = $pdo->prepare($sql);

        // Bind parameters
        $stmt->bindParam(':newPassword', $newPassword, PDO::PARAM_STR);
        $stmt->bindParam(':email', $email, PDO::PARAM_STR);

        // Execute the query
        if ($stmt->execute()) {
            return true; // Password updated successfully
        } else {
            return false; // Failed to update password
        }
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
        return false; // Handle database connection error
    }
}

// Function to check the user's role in the database
function checkUserRole($email, $role)
{
    // Implement your database query logic here
    // Example using PDO (you can adjust it based on your database library)

    try {
        // Replace 'your_database_host', 'your_database_name', 'your_database_user', and 'your_database_password' with your actual database credentials
        $pdo = new PDO('mysql:host=localhost;dbname=hrsystemci', 'root', '');

        // Prepare the SQL query
        $sql = "SELECT COUNT(*) FROM employee WHERE em_email = :email AND em_role = :role";
        $stmt = $pdo->prepare($sql);

        // Bind parameters
        $stmt->bindParam(':email', $email, PDO::PARAM_STR);
        $stmt->bindParam(':role', $role, PDO::PARAM_STR);

        // Execute the query
        $stmt->execute();

        // Check if the user has the specified role
        return $stmt->fetchColumn() > 0;
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
        return false; // Handle database connection error
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <!-- Favicon icon -->
    <link rel="icon" type="image/jpg" sizes="16x16" href="assets/images/favicn.jpg">
    <title>FOUR J'S HRM SYSTEM </title>
    <!-- Bootstrap Core CSS -->
    <link href="<?php echo base_url(); ?>assets/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <!-- Custom CSS -->
    <link href="<?php echo base_url(); ?>assets/css/style.css" rel="stylesheet">
    <!-- You can change the theme colors from here -->
    <link href="<?php echo base_url(); ?>assets/css/colors/blue.css" id="theme" rel="stylesheet">
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
<![endif]-->
</head>

<body>
    <!-- ============================================================== -->
    <!-- Preloader - style you can find in spinners.css -->
    <!-- ============================================================== -->
    <div class="preloader">
        <svg class="circular" viewBox="25 25 50 50">
            <circle class="path" cx="50" cy="50" r="20" fill="none" stroke-width="2" stroke-miterlimit="10" />
        </svg>
    </div>
    <!-- ============================================================== -->
    <!-- Main wrapper - style you can find in pages.scss -->
    <!-- ============================================================== -->

    <section id="wrapper" class="login-register login-sidebar" style="background-image:url(<?php echo base_url(); ?>assets/images/background/4jbg.jpg);">

        <div class="login-box card">
            <div class="card-body loginpage">
                <?php if (!empty($this->session->flashdata('feedback'))) { ?>
                    <div class="message">
                        <strong>Danger! </strong><?php echo $this->session->flashdata('feedback') ?>
                    </div>
                <?php
                }
                ?>
                <br>
                <br>
                <br>
                <br>
                <br>
                <form class="form-horizontal form-material" method="post" id="loginform" action="login/Login_Auth" autocomplete="off">
                    <a href="javascript:void(0)" class="text-center db"><br /><img src="<?php echo base_url(); ?>assets/images/four.JPG" width="250px" height="180px" alt="Home" /></a>
                    <div class="form-group m-t-40">
                        <div class="col-xs-12">
                            <input class="form-control" name="email" value="<?php if (isset($_COOKIE['email'])) {
                                                                                echo $_COOKIE['email'];
                                                                            } ?>" type="text" required placeholder="Email">
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-xs-12">
                            <input class="form-control" name="password" value="<?php if (isset($_COOKIE['password'])) {
                                                                                    echo $_COOKIE['password'];
                                                                                } ?>" type="password" required placeholder="Password">
                        </div>
                    </div>
                    <!--<div class="form-check">
                     <input type="checkbox" name="remember" class="form-check-input" id="remember-me">
                     <label class="form-check-label" for="remember-me">Remember Me</label>
                 </div>-->
                    <!-- Link to trigger the modal -->
                    <a href="#" data-toggle="modal" data-target="#forgotPasswordModal">Forgot Password</a>

                    <div class="form-group text-center m-t-20">
                        <div class="col-xs-12">
                            <button class="btn btn-success btn-login btn-block text-uppercase waves-effect waves-light" type="submit">Log In</button>
                        </div>
                    </div>
                    <div class="form-group text-center m-t-20">
                        <div class="col-lg-15 col-md-12">
                            <a href="attendance/">
                                <button type="button" class="btn btn-primary btn-block btn-flat">Employee Attendance</button>
                            </a>
                        </div>
                    </div>
                </form>
                <h1>
                    <center>Four J's General Merchandise HRM SYSTEM</center>
                </h1>
            </div>
        </div>
    </section>
    <!-- Modal -->
    <div class="modal fade" id="forgotPasswordModal" tabindex="-1" role="dialog" aria-labelledby="forgotPasswordModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="forgotPasswordModalLabel">Forgot Password</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <!-- Form to input email -->
                    <form method="post" action="">
                        <div class="form-group">
                            <label for="email">Email:</label>
                            <input type="email" class="form-control" id="email" name="email" required>
                        </div>
                        <button type="submit" class="btn btn-primary">Reset Password</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- ============================================================== -->
    <!-- End Wrapper -->
    <!-- ============================================================== -->
    <!-- ============================================================== -->
    <!-- All Jquery -->
    <!-- ============================================================== -->
    <script src="<?php echo base_url(); ?>assets/plugins/jquery/jquery.min.js"></script>
    <!-- Bootstrap tether Core JavaScript -->
    <script src="<?php echo base_url(); ?>assets/plugins/bootstrap/js/popper.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/plugins/bootstrap/js/bootstrap.min.js"></script>
    <!-- slimscrollbar scrollbar JavaScript -->
    <script src="<?php echo base_url(); ?>assets/js/jquery.slimscroll.js"></script>
    <!--Wave Effects -->
    <script src="<?php echo base_url(); ?>assets/js/waves.js"></script>
    <!--Menu sidebar -->
    <script src="<?php echo base_url(); ?>assets/js/sidebarmenu.js"></script>
    <!--stickey kit -->
    <script src="<?php echo base_url(); ?>assets/plugins/sticky-kit-master/dist/sticky-kit.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/plugins/sparkline/jquery.sparkline.min.js"></script>
    <!--Custom JavaScript -->
    <script src="<?php echo base_url(); ?>assets/js/custom.min.js"></script>
    <!-- ============================================================== -->
    <!-- Style switcher -->
    <!-- ============================================================== -->
    <script src="<?php echo base_url(); ?>assets/plugins/styleswitcher/jQuery.style.switcher.js"></script>
</body>


</html>