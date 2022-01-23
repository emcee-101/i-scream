<?php
session_start();
include_once("includes/connection.php");
include("includes/functions.php");
include("includes/classes/DisplayElements.php");

$con = establish_connection_db();
$user_id = $_SESSION['usr_id'];

$query = mysqli_query($con, "select * from user where user_id='$user_id'");
$array=mysqli_fetch_assoc($query);

$email=$array["mail_address"];
$age = $array["age"];
$membership = $array["isSubscribed"];

if($membership === 1)
{
    echo "Full Membership";
    $membershipText = "Full Membership";
    $membershipAlternative = "No Membership";
}
else
{
    $membershipText = "No Membership";
    $membershipAlternative = "Full Membership";
}

$HTML = new SiteGenerator("Account","background2");
$HTML->generateSiteStart();
$AccountEdit = edit_account($user_id, $_POST);
?>
    <div class="box">

        <h2 id="redfont">Account</h2><br>
        <form method="POST">
        <p>Your current Email: <type="text"> <?php echo $email; ?><br><br>
        New Email:
        <input name="newMail" type="email" required><br><br>
        <input type = submit class ="button button1" name="mailEdit" value = "Edit Email">
        </p>
        </form>
        <br>

        <form method="POST">
        <p>Your current Age: <type="text"> <?php echo $age;?><br><br>
        Change Age:
        <br>
        <input name = "newAge" type = "number" min ="18" max="120" required></input><br><br>
        <input type = submit class ="button button1" name="ageEdit" value = "Edit Age">
        </p>
        </form>
        <br>

        <form method="POST">
        <p>Your current Membership:<br><type="text"><?=$membershipText;?><br><br>
        Change Membership Status:
        <br>
        <input name = "newMembershipStatus" type = "radio" id = "membershipAlternative"required>
        <label for="membershipAlternative"><?=$membershipAlternative;?></label><br><br>
        <input type = submit class ="button button1" name="membershipEdit" value = "Edit Membership">
        </p>
        </form>
        </div>
<?php
require_once("includes/header.php");
require_once("includes/footer.php");
$HTML->generateSiteEnd();?>
