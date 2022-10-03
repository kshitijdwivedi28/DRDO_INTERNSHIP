<!DOCTYPE html>
<html>
<?php
session_start();
if (!isset($_SESSION["user_id"])) {
    header("location:index.php");
}
?>
<img src="Images/bg1.jpg" alt="backgorund" class="background">

<head>
    <title>view Application</title>
    <link rel="stylesheet" type="text/css" href="css/style1.css">
    <meta charset="UTF-8" name="viewport" content="width=device-width, initial-scale=1" />
</head>

<body>
    <section>
        <img src="Images/Header.png" alt="backgorund" class="headerpic">
    </section>
    <div class="logout">
        <a href="logout.php">लॉगआउट/Logout</a>
    </div>
    <br><br>
    <div class="form">
        <?php
require_once "conn.php";
if (isset($_SESSION["user_id"])) {

    $application_id = $_POST["application"];

    echo "<h2>आवेदन संख्या/Application No : $application_id </h2>";
    ?>
    <form method="POST" action="feedbackaction.php">
        <fieldset>
            <legend style="padding: 10px; color: white; text-transform: uppercase; font-size: 1.6em">.............</legend>
            <?php
            require "conn.php";
            $query5 = mysqli_query(
                $conn,
                "SELECT * FROM `application` WHERE application_id=$application_id"
            );
            $fetch5 = mysqli_fetch_array($query5);
            $user = $fetch5["user_id"];
            $progid = $fetch5["training_id"];
            $query6 = mysqli_query(
                $conn,
                "SELECT * FROM `training_details` WHERE training_id=$progid"
            );
            $fetch6 = mysqli_fetch_array($query6);
            $trainingTitle = $fetch6["training_title"];
            $trainingDetails = $fetch6["training_details"];
            $trainingType = $fetch6["training_type"];
            $trainingTypeDetails = $fetch6["training_type_detail"];
            $startdate = $fetch6["start_date"];
            $enddate = $fetch6["end_date"];
            $duration = $fetch6["duration"];
            $mobileNo = $fetch6["mobile_no"];
            $dob = $fetch6["dob"];
            $pin = $fetch6["pin_dop_pis"];
            $emailID = $fetch6["drona_email_id"];
            $gender = $fetch6["gender"];
            $qualification = $fetch6["qualification"];
            $research_paper = $fetch6["research_paper"];
            $title_of_paper = $fetch6["title_of_paper"];
            $paper_submitted = $fetch6["paper_submitted"];
            $orginstitute = $fetch6["org_institute"];
            $locinstitute = $fetch6["institute_address"];
            $training_fee = $fetch6["training_fee"];
            $amount = $fetch6["amount"];
            $cheque = $fetch6["cheque_in_favour"];
            $payable = $fetch6["payable_at"];
            $last_date_to_pay = $fetch6["last_date_fee_submission"];
            $remark = $fetch5["applicant_remarks"];
            $acMode = $fetch6["training_mode"];
            ($query = mysqli_query(
                $conn,
                "SELECT * FROM `id_emp` WHERE  `id`=$user"
            )) or die(mysqli_error());
            $fetch = mysqli_fetch_array($query);
            ($query1 = mysqli_query(
                $conn,
                "SELECT ID.desig_fullname FROM id_desig ID WHERE ID.id = (SELECT IDE.desig_id FROM id_emp IDE WHERE IDE.id = $user);"
            )) or die(mysqli_error());
            $fetch1 = mysqli_fetch_array($query1);
            ($query2 = mysqli_query(
                $conn,
                "SELECT IDG.name,IDG.ad_id FROM id_group IDG WHERE IDG.id = (SELECT IDE.group_id FROM id_emp IDE WHERE IDE.id = $user);"
            )) or die(mysqli_error());
            $fetch2 = mysqli_fetch_array($query2);
            $desgName = $fetch1["desig_fullname"];
            $groupName = $fetch2["name"];
            $groupadID = $fetch2["ad_id"];
            $name = $fetch["user_name"];
            $fname = $fetch["first_name"];
            $lname = $fetch["last_name"];
            $name1 = $fname . " " . $lname;
            $des_id = $fetch["desig_id"];
            $grp_id = $fetch["group_id"];
            $adstatus = $fetch5["ad_gh_review"];
            $adreview = $fetch5["ad_status"];
            $tcpgh = $fetch5["head_tcp_hr"];
            $tcpghreview = $fetch5["head_tcp_hr_status"];
            $tcpad = $fetch5["ad_tcp_hr"];
            $tcpadreview = $fetch5["ad_tcp_hr_status"];
            $director = $fetch5["director"];
            $directorreview = $fetch5["director_status"];

            // if ($adstatus == 0) {
            //     echo "<br><br><b>आवेदन की स्थिति/Status of the Application : Pending for reviewal of Group AD.</b><br><br><br> </style>";
            // } elseif ($tcpgh == 0 && $adreview == "RECOMMENDED") {
            //     //matlab ad ne approve kar dia
            //     echo "<br><br><b>आवेदन की स्थिति/Status of the Application : Pending for reviewal of Group Head (TCP/HR Department).</b><br><br><br>";
            // } elseif ($tcpgh == 0 && $adreview == "NOT RECOMMENDED") {
            //     echo "<br><br><b>आवेदन की स्थिति/Status of the Application : Rejected by your department AD.</b><br><br><br>";
            // } elseif ($tcpad == 0 && $tcpghreview == "RECOMMENDED") {
            //     //matlab tcp-gh ne approve kar dia
            //     echo "<br><br><b>आवेदन की स्थिति/Status of the Application : Pending for reviewal of AD (TCP/HR Department).</b><br><br><br>";
            // } elseif ($tcpad == 0 && $tcpghreview == "NOT RECOMMENDED") {
            //     echo "<br><br><b>आवेदन की स्थिति/Status of the Application : Rejected by Group Head (TCP/HR Department).</b><br><br><br>";
            // } elseif ($director == 0 && $tcpadreview == "RECOMMENDED") {
            //     //matlab tcp-ad ne approve kar dia
            //     echo "<br><br><b>आवेदन की स्थिति/Status of the Application : Pending for reviewal of Director Sir/Ma'am.</b><br><br><br>";
            // } elseif ($director == 0 && $tcpadreview == "NOT RECOMMENDED") {
            //     echo "<br><br><b>आवेदन की स्थिति/Status of the Application : Rejected by AD (TCP/HR Department).</b><br><br><br>";
            // } elseif ($director == 1 && $directorreview == "RECOMMENDED") {
            //     //matlab director ne approve kar dia
            //     echo "<br><br><b>आवेदन की स्थिति/Status of the Application : Congratulations! RECOMMENDED By Director.</b><br><br><br>";
            // } elseif ($director == 1 && $directorreview == "Forwarded") {
            //     //matlab director ne approve kar dia
            //     echo "<br><br><b>आवेदन की स्थिति/Status of the Application : Congratulations! Forwarded By Director.</b><br><br><br>";
            // } elseif ($director == 1 && $directorreview == "NOT RECOMMENDED") {
            //     echo "<br><br><b>आवेदन की स्थिति/Status of the Application : Rejected by Director.</b><br><br><br>";
            // }
            echo "<br><br><br>";
            echo "<div>
                        <label>आवेदक का नाम/Applicant Name : </label>" .
                $name1 .
                "
                        <input type='hidden' name='username' class='form-control'  value='$name1'  disabled />
                        </div>";
            echo "<div>
                        <label>पदनाम/Designation Name : </label>" .
                $desgName .
                "
                        <input type='hidden' name='designame' class='form-control' placeholder='$desgName' disabled />
                        </div>";
            echo "<div>
                        <label>विभाग कानाम/Group Name : </label>" .
                $groupName .
                "
                        <input type='hidden' name='grpname' class='form-control' placeholder='$groupName' disabled />
                        </div>";
            echo "<div>
                        <label>मोबाइल नंबर/Mobile Number : </label>" .
                $mobileNo .
                "
                        <input type='hidden' name='training_details' class='form-control' placeholder='$mobileNo' disabled />
                        </div>";
            echo "<div>
                        <label>जन्म तिथि/Date Of Birth : </label>" .
                $dob .
                "
                        <input type='hidden' name='training_details' class='form-control' placeholder='$dob' disabled />
                        </div>";
            echo "<div>
                        <label>पिन डीओपी (पीआईएस)/PIN DOP (PIS) : </label>" .
                $pin .
                "
                        <input type='hidden' name='training_details' class='form-control' placeholder='$pin' disabled />
                        </div>";
            echo "<div>
                        <label>ईमेल आईडी/Email ID : </label>" .
                $emailID .
                "
                        <input type='hidden' name='training_details' class='form-control' placeholder='$emailID' disabled />
                        </div>";
            echo "<div>
                        <label>लिंग/Gender : </label>" .
                $gender .
                "
                        <input type='hidden' name='training_details' class='form-control' placeholder='$gender' disabled />
                        </div>";
            echo "<div>
                        <label>योग्यता/Qualification : </label>" .
                $qualification .
                "
                        <input type='hidden' name='training_details' class='form-control' placeholder='$qualification' disabled />
                        </div>";
            echo "<div>
                        <label>प्रशिक्षण शीर्षक/Training Title : </label>" .
                $trainingTitle .
                "
                        <input type='hidden' name='training_title' class='form-control' placeholder='$trainingTitle' disabled />
                        </div>";
            echo "<div>
                        <label>प्रशिक्षण विवरण/Training Description : </label>" .
                $trainingDetails .
                "
                        <input type='hidden' name='training_details' class='form-control'  placeholder='$trainingDetails' disabled  />
                        </div>";
            echo "<div>
                        <label>आरंभ तिथि/From Date : </label>" .
                $startdate .
                "
                        <input type='hidden' name='training_details' class='form-control'  placeholder='$startdate' disabled  />
                        </div>";
            echo "<div>
                        <label>अंतिम तिथि/To Date : </label>" .
                $enddate .
                "
                        <input type='hidden' name='training_details' class='form-control'  placeholder='$enddate' disabled  />
                        </div>";
            echo "<div>
                        <label>अवधि/Duration(in days) : </label>" .
                $duration .
                "
                        <input type='hidden' name='training_details' class='form-control'  placeholder='$duration' disabled  />
                        </div>";
            echo "<div>
                        <label>प्रशिक्षण प्रारुप/Training Type : </label>" .
                $trainingType .
                "
                        <input type='hidden' name='training_details' class='form-control'  placeholder='$trainingType' disabled  />
                        </div>";
            if ($trainingType == "others") {
                echo "<div>
                        <label>प्रशिक्षण विवरण (अगर अन्य)/Training Type(If Others) : </label>" .
                    $trainingTypeDetails .
                    "
                        <input type='hidden' name='training_details' class='form-control'  placeholder='$trainingTypeDetails' disabled  />
                        </div>";
            }
            echo "<div>
                        <label>प्रशिक्षण प्रणाली/Training Mode : </label>" .
                $acMode .
                "
                        <input type='hidden' name='training_details' class='form-control'  placeholder='$acMode' disabled  />
                        </div>";
            echo "<div>
                        <label>आयोजक संस्थान/Organizing Institute : </label>" .
                $orginstitute .
                "
                        <input type='hidden' name='training_details' class='form-control'  placeholder='$orginstitute' disabled  />
                        </div>";
            echo "<div>
                        <label>संस्थान का पता/Institute Address : </label>" .
                $locinstitute .
                "
                        <input type='hidden' name='training_details' class='form-control'  placeholder='$locinstitute' disabled  />
                        </div>";
            echo "<div>
                        <label>शोध-पत्र/Research paper : </label>" .
                $research_paper .
                "
                        <input type='hidden' name='training_details' class='form-control'  placeholder='$research_paper' disabled  />
                        </div>";
            if ($research_paper == "YES") {
                echo "<div>
                        <label>पत्र का शीर्षक/Title of paper : </label>" .
                    $title_of_paper .
                    "
                        <input type='hidden' name='training_details' class='form-control'  placeholder='$title_of_paper' disabled  />
                        </div>";

                echo "<div>
                        <label>पत्र जमा किया गया?/Is Paper Submited? : </label>" .
                    $paper_submitted .
                    "
                        <input type='hidden' name='training_details' class='form-control'  placeholder='$paper_submitted' disabled  />
                        </div>";
            }
            echo "<div>
                        <label>पंजीकरण शुल्क?/Is Registration Fee? : </label>" .
                $training_fee .
                "
                        <input type='hidden' name='training_details' class='form-control'  placeholder='$training_fee' disabled  />
                        </div>";
            if ($training_fee == "YES") {
                echo "<div>
                        <label>शुल्क (जीएसटी सहित)/Fees(GST Included) : </label>" .
                    $amount .
                    "
                        <input type='hidden' name='training_details' class='form-control'  placeholder='$amount' disabled  />
                        </div>";
                echo "<div>
                        <label>के पक्ष में चेक/Cheque In favour : </label>" .
                    $cheque .
                    "
                        <input type='hidden' name='training_details' class='form-control' placeholder='$cheque' disabled />
                        </div>";
                echo "<div>
                        <label>पर देय/Payable At : </label>" .
                    $payable .
                    "
                        <input type='hidden' name='training_details' class='form-control' placeholder='$payable' disabled />
                        </div>";
                echo "<div>
                        <label>शुल्क जमा करने की अंतिम तिथि/Last Date of Fee Submission : </label>" .
                    $last_date_to_pay .
                    "
                        <input type='hidden' name='training_details' class='form-control' placeholder='$last_date_to_pay' disabled />
                        </div>";
            }
            echo "<div>
                        <label>टिप्पणियाँ (यदि आवश्यक हो)/Remarks : </label>" .
                $remark .
                "
                        <input type='hidden' name='remarks' class='form-control' placeholder='$remark' disabled/>
                        </div>";
			echo "<div>
                        <label>समय/Application Created Time : </label>" .
                $fetch5["time_created"].
                "
                        <input type='hidden' name='remarks' class='form-control' placeholder='$remark' disabled/>
                        </div>";

//             include_once "conn.php";
//             $userId = $_SESSION["user_id"];
//             $application_id = $_POST["application"];
//             // $query ="SELECT * from `training_details` WHERE `user_id`=$user  AND `is_confirmed`='yes' ORDER BY `end_date` DESC  LIMIT 5 ";
//             $query = "SELECT * from `training_details` 
// WHERE `user_id` = $user 
// AND `is_confirmed` = 'yes' 
// AND `training_id` < (SELECT training_id FROM application WHERE application_id = $application_id)
// ORDER BY `end_date` DESC  LIMIT 5 ";
//             $result = Mysqli_query($conn, $query);
// if (isset($_SESSION["user_id"])) {
//     $user_ID = $_SESSION["user_id"];
//     $application_id = $_POST["application"];
//     $con = new mysqli("localhost", "root", "", "cfees");
//     ($query = mysqli_query(
//         $con,
//         "SELECT * FROM `application` WHERE  `application_id`=$application_id"
//     )) or die(mysqli_error());
//     $fetch = mysqli_fetch_array($query);
//     if ($fetch == null) {
//         echo "<h1>Invalid Tracking ID</h1>";
//     } else {
//         $applicant_remarks = $fetch["applicant_remarks"];
//         $application_time = $fetch["time_created"];
//         $ad_review = $fetch["ad_gh_review"];
//         $ad_remarks = $fetch["ad_gh_remarks"];
//         $ad_status = $fetch["ad_status"];
//         $ad_time = $fetch["ad_gh_time"];
//         $htcphr_review = $fetch["head_tcp_hr"];
//         $htcphr_remarks = $fetch["head_tcp_hr_remarks"];
//         $htcphr_status = $fetch["head_tcp_hr_status"];
//         $htcphr_time = $fetch["head_tcp_hr_time"];
//         $adtcphr_review = $fetch["ad_tcp_hr"];
//         $adtcphr_remarks = $fetch["ad_tcp_hr_remarks"];
//         $adtcphr_status = $fetch["ad_tcp_hr_status"];
//         $adtcphr_time = $fetch["ad_tcp_hr_time"];
//         $director_review = $fetch["director"];
//         $director_remarks = $fetch["director_remarks"];
//         $director_status = $fetch["director_status"];
//         $director_time = $fetch["director_time"];
//         ($query1 = mysqli_query(
//             $con,
//             "SELECT IDE.first_name FROM id_emp IDE WHERE id = (SELECT A.user_id FROM Application A WHERE application_id = $application_id);"
//         )) or die(mysqli_error());
//         $fetch1 = mysqli_fetch_array($query1);
//         $applicantName = $fetch1["first_name"];

//         if ($ad_review == 0) {
//             echo "एडी समीक्षा के लिए लंबित/Pending for AD Review" .
//                 "<br><br><hr><br><br>";
//         } else {
//             echo "<span style='color:red;'> एडी टिप्पणी/AD's Remarks : " .
//                 $ad_remarks .
//                 "<br></span>";
//             echo "एडी स्थिति/AD's Status : " . $ad_status . "<br>";
//             echo "एडी टिप्पणी समय/AD's remark time : " .
//                 $ad_time .
//                 "<br><br><hr><br><br>";
//             if ($ad_status == "NOT RECOMMENDED") {
//                 echo "अस्वीकृति के कारण एप्लिकेशन ट्रैकिंग रोक दी गई/Application Tracking Stopped due to Rejection.";
//             } elseif ($htcphr_review == 0) {
//                 echo "हेड टीसीपी और एचआरजी समीक्षा के लिए लंबित/Pending for Head TCP&HRG Review" .
//                     "<br><br><hr><br><br>";
//             } else {
//                 echo "<span style='color:red;'>हेड टीसीपी और एचआरजी रिव्यू टिप्पणी/Head TCP&HRG's Review Remarks : " .
//                     $htcphr_remarks .
//                     " <br></span>";
//                 echo "हेड टीसीपी और एचआरजी समीक्षा स्थिति/Head TCP&HRG's Review Status : " .
//                     $htcphr_status .
//                     "<br>";
//                 echo "हेड टीसीपी और एचआरजी समीक्षा टिप्पणी समय/Head TCP&HRG's Review remark time : " .
//                     $htcphr_time .
//                     "<br><br><hr><br><br>";
//                 if ($htcphr_status == "NOT RECOMMENDED") {
//                     echo "अस्वीकृति के कारण एप्लिकेशन ट्रैकिंग रोक दी गई/Application Tracking Stopped due to Rejection.";
//                 } elseif ($adtcphr_review == 0) {
//                     echo "एडी टीसीपी एचआर समीक्षा के लिए लंबित/Pending for AD TCP HR's Review" .
//                         "<br><br><hr><br><br>";
//                 } else {
//                     echo "<span style='color:red;'> हेड एडी एचआर समीक्षा टिप्पणियां/Head AD HR's Review Remarks : " .
//                         $adtcphr_remarks .
//                         "<br></span>";
//                     echo "हेड एडी एचआर समीक्षा स्थिति/Head AD HR's Review Status : " .
//                         $adtcphr_status .
//                         "<br>";
//                     echo "हेड एडी एचआर समीक्षा टिप्पणी समय/Head AD HR's Review remark time : " .
//                         $adtcphr_time .
//                         "<br><br><hr><br><br>";
//                     if ($adtcphr_status == "NOT RECOMMENDED") {
//                         echo "अस्वीकृति के कारण एप्लिकेशन ट्रैकिंग रोक दी गई/Application Tracking Stopped due to Rejection.";
//                     } elseif ($director_review == 0) {
//                         echo "निदेशक समीक्षा के लिए लंबित/Pending for Director Review" .
//                             "<br><br><hr><br><br>";
//                     } else {
//                         echo "<span style='color:red;'> निदेशक टिप्पणियां/Director's Remarks : " .
//                             $director_remarks .
//                             "<br></span>";
//                         echo "निदेशक समीक्षा स्थिति/Director's Review Status : " .
//                             $director_status .
//                             "<br>";
//                         echo "निदेशक समीक्षा टिप्पणी समय/Director's Review remark time : " .
//                             $director_time .
//                             "<br><br><hr><br><br>";
//                         echo "ट्रैकिंग प्रक्रिया पूरी हुई/Tracking process completed :)";
//                     }
//                 }
//             }
//         }
//     }
// } 
    echo "<hr><hr><br>";
    echo "<div id='fb_review_id'>
    <label> प्रशिक्षण प्रतिपुष्टि/Training Feedback :</label>
    <input type = 'text' name = 'fb_review_name' class = 'form-control' placeholder = 'Enter your feedback of this training' required />
    </div>";
    echo "<div>
    <label>प्रशिक्षण प्रतिपुष्टि रेटिंग/Training Feedback Rating :</label>
    <input type='Radio' name='fb_rating' value='1'>1
    <input type='Radio' name='fb_rating' value='2'>2
    <input type='Radio' name='fb_rating' value='3'>3
    <input type='Radio' name='fb_rating' value='4'>4
    <input type='Radio' name='fb_rating' value='5'>5
    </div>";
    echo "<br><br>
    <button name='login'>जमा करें/<br>submit</button>";
?>
        </fieldset>
</form>





        <?php
} else {
    echo "Invalid state";
}
?>
        <br>
        <div class="footer">
            <?php include "footer.php"; ?>
        </div>

</body>

</html>