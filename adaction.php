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
    $adreview = $_POST["review"];
    $adstatus = $_POST["status"];
    $con = new mysqli("localhost", "root", "", "cfees");
    $sql = "UPDATE `application` SET `ad_gh_review`=1,`ad_gh_remarks`='$adreview',`ad_status`='$adstatus',`ad_gh_time` = now() WHERE `application_id` = $application;";
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