<?php
session_start();
if (!isset($_SESSION["user_id"])) {
    header("location:index.php");
}
?>
<?php
require_once "conn.php";
if (isset($_SESSION["user_id"])) {
    $application = $_POST["application"];
    echo "$application";
    $fb_review = $_POST["fb_review_name"];
    $fb_rating = $_POST["fb_rating"];
    $con = new mysqli("localhost", "root", "", "cfees");
    $sql = "UPDATE `training_details` SET `is_feedback`='yes',`feedback`='$fb_review',
    `feedback_rating`='$fb_rating' WHERE `training_id` = (SELECT training_id from application WHERE application_id=$application);";
    if ($con->query($sql) == true) {
        echo "<script>
        alert('Your Remarks are saved succesfully');
   </script>";
        echo "<script>window.location='home.php'</script>";
    } else {
        echo "ERROR: $sql <br> $con->error";
    }
}
 ?>