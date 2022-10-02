<?php
session_start();
if (!isset($_SESSION["user_id"])) {
    header("location:index.php");
}
?>
<?php
require_once "conn.php";
if (isset($_SESSION["user_id"])) {
    ($query = mysqli_query(
        $conn,
        "SELECT * FROM `id_emp` WHERE  `id`='$_SESSION[user_id]'"
    )) or die(mysqli_error());
    $fetch = mysqli_fetch_array($query);
    $user_id = $_SESSION["user_id"];
    $training_title = $_POST["training_title"];
    $training_details = $_POST["training_details"];
    $training_type = $_POST["trainingtype"];
    $training_type_detail = $_POST["training_type_details"];
    $start_date = $_POST["trainingstartdetails"];
    $end_date = $_POST["trainingenddetails"];
    $org_institute = $_POST["orgname"];
    $institute_address = $_POST["orgloc"];
    $training_mode = $_POST["trainingmode"];
    $mobile_no = $_POST["MobileNo"];
    $dob = $_POST["Dateofbirth"];
    $pin_dop_pis = $_POST["pin"];
    $drona_email_id = $_POST["EmailId"];
    $gender = $fetch["gen"];
    $qualification = $_POST["qualification"];
    $research_paper = $_POST["Researchpaper"];
    $title_of_paper = $_POST["titleofpaper"];
    $paper_submitted = $_POST["papersubmited"];
    $training_fee = $_POST["fee"];
    $amount = $_POST["feeamount"];
    $cheque_in_favor = $_POST["chequeinfavour"];
    $payable_at = $_POST["Payableat"];
    $last_date_free_submit = $_POST["feelastdate"];
    $applicant_remarks = $_POST["remarks"];
	$duration = (strtotime($end_date)-strtotime($start_date))/(24*60*60);
	$con = new mysqli("localhost", "root", "", "cfees");
    $sql = "INSERT INTO training_details 
    (user_id, training_title, training_details, training_type, training_type_detail, start_date,
    end_date, org_institute, institute_address, training_mode, mobile_no, dob, pin_dop_pis,
    drona_email_id, gender, qualification, research_paper, title_of_paper, paper_submitted,
    training_fee, amount, cheque_in_favour, payable_at, last_date_fee_submission, is_confirmed,duration)
    VALUES ($user_id, '$training_title', '$training_details', '$training_type', '$training_type_detail',
    '$start_date', '$end_date', '$org_institute', '$institute_address', '$training_mode', '$mobile_no', '$dob',
    '$pin_dop_pis', '$drona_email_id', '$gender', '$qualification', '$research_paper', '$title_of_paper',
    '$paper_submitted', '$training_fee', $amount, '$cheque_in_favor', '$payable_at', '$last_date_free_submit',
    'NO','$duration');";
    if ($con->query($sql) == true) {
        ($query = mysqli_query(
            $con,
            "SELECT `training_id` FROM `training_details` WHERE `user_id`=$user_id ORDER BY 1 DESC LIMIT 1"
        )) or die(mysqli_error());
        $fetch = mysqli_fetch_array($query);
        ($query2 = mysqli_query(
            $con,
            "SELECT IDG.gh_id,IDG.ad_id FROM id_group IDG WHERE IDG.id = (SELECT IDE.group_id FROM id_emp IDE WHERE IDE.id = '$_SESSION[user_id]');"
        )) or die(mysqli_error());
        $fetch2 = mysqli_fetch_array($query2);
        $groupadID = $fetch2["ad_id"];
        $groupghID = $fetch2["gh_id"];
        $training_id = $fetch["training_id"];
        if ($groupadID == 0) {
            if ($groupghID == 0) {
                //Bypass incase there is no gh head, no ad in that group.
                $sql = "INSERT INTO application (training_id,user_id,applicant_remarks,time_created,ad_gh_review,ad_gh_remarks,ad_status,ad_gh_time,ad_gh_id) 
                VALUES ('$training_id','$user_id', '$applicant_remarks' ,now(),1,'Bypassed as there is no AD AND Group head in the department','NOT RECOMMENDED',now(),'$_SESSION[user_id]');";
            } else {
                $sql = "INSERT INTO application (training_id,user_id,applicant_remarks,time_created,ad_gh_id) 
                VALUES ('$training_id','$user_id', '$applicant_remarks' ,now(),'$groupghID');";
            }
        } else {
            $sql = "INSERT INTO application (training_id, user_id, applicant_remarks, time_created, ad_gh_id) 
            VALUES ('$training_id','$user_id', '$applicant_remarks' ,now(),'$groupadID');";
        }
        if ($con->query($sql) == true) {
            ($query3 = mysqli_query(
                $con,
                "SELECT `application_id` FROM `application` WHERE `user_id`=$user_id ORDER BY 1 DESC LIMIT 1"
            )) or die(mysqli_error());
            $fetch3 = mysqli_fetch_array($query3);
            $appNo = $fetch3["application_id"];
            echo "<script>
                 alert('Your Application Number is : $appNo');
            </script>";
            echo "<script>window.location='home.php'</script>";
        } else {
        }
    } else {
        echo "ERROR: $sql <br> $con->error";
    }

}
 ?>
