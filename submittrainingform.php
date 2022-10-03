<?php
session_start();
if (!isset($_SESSION["user_id"])) {
    header("location:index.php");
}
?>
<?php
require_once "conn.php";
if (isset($_SESSION["user_id"])) {
    // $user_ID = $_SESSION['user_id'];
    // $training_title = $_POST['trainingname'];
    // $training_details=$_POST['trainingdetails'];
    // $training_type=$_POST['trainingtype'];
    // $start_date = $_POST['trainingstartdetails'];
    // $end_date = $_POST['trainingenddetails'];
    // $org_institute = $_POST['orgname'];
    // $location_place = $_POST['orgloc'];
    // $fees=$_POST['fee'];
    // $amount = $_POST['feeamount'];
    // $training_mode = $_POST['trainingmode'];
    // $con = new mysqli("localhost", "root", "", "cfees_drdo");
    // $sql = "INSERT INTO training_details (user_id, training_title,training_details, training_type,start_date, end_date, org_institute, institute_address,training_fee,amount, training_mode)
    // VALUES ('$user_ID', '$training_title', '$training_details', '$training_type','$start_date', '$end_date', '$org_institute', '$location_place','$fees','$amount', '$training_mode');";
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
    // $mobile_no = $_POST["MobileNo"];
    // $dob = $_POST["Dateofbirth"];
    // $pin_dop_pis = $_POST["pin"];
    // $internet_email_id = $_POST["internet_email_id"];
    // $gender = $fetch["gen"];
    // $qualification = $_POST["qualification"];
    $fb_review_name = $_POST["fb_review_name"];
    $fb_rating = $_POST["fb_rating"];
    $research_paper = $_POST["Researchpaper"];
    $title_of_paper = $_POST["titleofpaper"];
    $paper_submitted = $_POST["papersubmited"];
    $training_fee = $_POST["fee"];
    $amount = $_POST["feeamount"];
    $cheque_in_favor = $_POST["chequeinfavour"];
    $payable_at = $_POST["Payableat"];
    $last_date_free_submit = $_POST["feelastdate"];
    $con = new mysqli("localhost", "root", "", "cfees");
    if($last_date_free_submit==NULL){
        $sql = "INSERT INTO training_details 
        (user_id, training_title, training_details, training_type, training_type_detail, start_date,
        end_date, org_institute, institute_address, training_mode, research_paper, title_of_paper, paper_submitted,
        training_fee, amount, cheque_in_favour, payable_at, is_confirmed,is_feedback,feedback,feedback_rating)
        VALUES ($user_id, '$training_title', '$training_details', '$training_type', '$training_type_detail',
        '$start_date', '$end_date', '$org_institute', '$institute_address', '$training_mode', '$research_paper', '$title_of_paper',
        '$paper_submitted', '$training_fee', $amount, '$cheque_in_favor', '$payable_at', 'YES','YES','$fb_review_name','$fb_rating');";    
    }
    else{
        $sql = "INSERT INTO training_details 
        (user_id, training_title, training_details, training_type, training_type_detail, start_date,
        end_date, org_institute, institute_address, training_mode, research_paper, title_of_paper, paper_submitted,
        training_fee, amount, cheque_in_favour, payable_at, last_date_fee_submission, is_confirmed,is_feedback,feedback,feedback_rating)
        VALUES ($user_id, '$training_title', '$training_details', '$training_type', '$training_type_detail',
        '$start_date', '$end_date', '$org_institute', '$institute_address', '$training_mode', '$research_paper', '$title_of_paper',
        '$paper_submitted', '$training_fee', $amount, '$cheque_in_favor', '$payable_at', '$last_date_free_submit',
        'YES','YES','$fb_review_name','$fb_rating');";    
    }
    if ($con->query($sql) == true) {
        header("location:form.php");
    } else {
        echo "ERROR: $sql <br> $con->error";
    }
}
?>

?>