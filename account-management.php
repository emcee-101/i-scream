<?php
session_start();
include_once("includes/connection.php");
include("includes/classes/DisplayElements.php");
include("includes/functions.php");
$user_data = check_login();

$con = establish_connection_db();
$user_id = $_SESSION['usr_id'];


$email = mysqli_query($con, "select mail_address from user where user_id='$user_id' ");
$email = mysqli_fetch_assoc($email);

$email = $email["mail_address"];
$password = mysqli_query($con, "select password from user where user_id='$user_id' ");
$password = mysqli_fetch_assoc($password);

$password = $password["password"];
$age = mysqli_query($con, "select age from user where user_id='$user_id' ");
$age = mysqli_fetch_assoc($age);
$age = $age["age"];

$membership = mysqli_query($con, "select isSubscribed from user where user_id='$user_id' ");
$membership = mysqli_fetch_assoc($membership);
$membership = $membership["isSubscribed"];

$membership == 1? $membershipText = "Full Membership": $membershipText = "No Membership";
print_edit_message();
$HTML = new SiteGenerator("Account","background2");
$HTML->generateSiteStart();
?>
        <div class="box">
        <h2 id="redfont">Account</h2>
        <form method="POST">

        <p>Email:<br>  <p type="text" name="email"> <?php echo $email; ?>  </p>  <br></p>
        <p>Age: <br> <p type="date" name="Age"> <?php echo $age; ?> </p> <br> </p>
        <p>Membership: <p type="text" name="membership"> <?php echo $membershipText; ?>  </p> <br><br></p>

            
        <p><a href="editaccount.php" input class="button button1">Edit Profile </a><br><br>
        <p><a href="editpassword.php" input class="button button1">Change Password</a></p><br>

        </form>
        </div>

<?php
require_once("includes/header.php");
require_once("includes/footer.php");
$HTML->generateSiteEnd();
?>

