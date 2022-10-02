<!DOCTYPE html>
<html>
<?php
    session_start();
    if(!ISSET($_SESSION['user_id'])){
        header('location:index.php');
    }
?>

<head>
    <title>Training Application</title>
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
    <div class="form">
        <form method="POST" action="trackform.php">
            <fieldset>
                <br>
                <legend style="padding: 10px; color: white; text-transform: uppercase; font-size: 1.6em">
                    आवेदन की
                    स्थिति/Application Status</legend>
                <?php
require_once 'conn.php';
if(isset($_SESSION['user_id'])){
    $user_ID = $_SESSION['user_id'];
    $appNo = $_POST['appNo'];
    $con = new mysqli("localhost", "root", "", "cfees");
    $query = mysqli_query($con, "SELECT * FROM `application` WHERE  `application_id`=$appNo") or die(mysqli_error());
    $fetch = mysqli_fetch_array($query);
    if($fetch ==null)
     echo"<h1>अमान्य ट्रैकिंग आईडी/Invalid Tracking ID</h1>";
    else{    
    $applicant_remarks  =$fetch['applicant_remarks'];
    $application_time =$fetch['time_created'];
    $ad_review  =$fetch['ad_gh_review'];
    $ad_remarks  =$fetch['ad_gh_remarks'];
    $ad_status = $fetch['ad_status'];
    $ad_time = $fetch['ad_gh_time'];
    $htcphr_review  =$fetch['head_tcp_hr'];
    $htcphr_remarks  =$fetch['head_tcp_hr_remarks'];
    $htcphr_status = $fetch['head_tcp_hr_status'];
    $htcphr_time = $fetch['head_tcp_hr_time'];
    $adtcphr_review  =$fetch['ad_tcp_hr'];
    $adtcphr_remarks  =$fetch['ad_tcp_hr_remarks'];
    $adtcphr_status = $fetch['ad_tcp_hr_status'];
    $adtcphr_time = $fetch['ad_tcp_hr_time'];
    $director_review  =$fetch['director'];
    $director_remarks  =$fetch['director_remarks'];
    $director_status = $fetch['director_status'];
    $director_time = $fetch['director_time'];
    $query1 = mysqli_query($con, "SELECT IDE.first_name FROM id_emp IDE WHERE id = (SELECT A.user_id FROM Application A WHERE application_id = $appNo);") or die(mysqli_error());
    $fetch1 = mysqli_fetch_array($query1);
    $applicantName = $fetch1['first_name'];
    echo "आपका आवेदन संख्या है/Your Application no is : ".$appNo."<br><br><hr><br><br>";
    echo "आवेदक का नाम/Applicant Name : ".$applicantName."<br>";
    echo "आवेदक टिप्पणी/Applicant Remarks : ".$applicant_remarks."<br>";
    echo "आवेदन जमा किया गया/Application Submitted : ".$application_time."<br><br><hr><br><br>";

    if($ad_review==0){
        echo "एडी समीक्षा के लिए लंबित/Pending for AD Review"."<br><br><hr><br><br>";
    }
    else{
        echo "एडी टिप्पणी/AD Remarks : ".$ad_remarks."<br>";
        echo "एडी स्थिति/AD Status : ".$ad_status."<br>";
        echo "एडी टिप्पणी समय/AD remark time : ".$ad_time."<br><br><hr><br><br>";
        if ($ad_status=="NOT RECOMMENDED"){
            echo "अस्वीकृति के कारण एप्लिकेशन ट्रैकिंग रोक दी गई/Application Tracking Stopped due to Rejection.";
        }    
        else if($htcphr_review==0){
            echo "हेड टीसीपी एचआर समीक्षा के लिए लंबित/Pending for Head TCP HR Review"."<br><br><hr><br><br>";
        }
        else{
            echo "हेड टीसीपी एचआर रिव्यू टिप्पणी/Head TCP HR Review Remarks : ".$htcphr_remarks."<br>";
            echo "हेड टीसीपी एचआर समीक्षा स्थिति/Head TCP HR Review Status : ".$htcphr_status."<br>";
            echo "हेड टीसीपी एचआर समीक्षा टिप्पणी समय/Head TCP HR Review remark time : ".$htcphr_time."<br><br><hr><br><br>";
            if ($htcphr_status=="NOT RECOMMENDED"){
                echo "अस्वीकृति के कारण एप्लिकेशन ट्रैकिंग रोक दी गई/Application Tracking Stopped due to Rejection.";
            }    
            else if($adtcphr_review==0){
                echo "एडी टीसीपी एचआर समीक्षा के लिए लंबित/Pending for AD TCP HR Review"."<br><br><hr><br><br>";
            }
            else{
                echo "हेड एडी एचआर समीक्षा टिप्पणियां/Head AD HR Review Remarks : ".$adtcphr_remarks."<br>";
                echo "हेड एडी एचआर समीक्षा स्थिति/Head AD HR Review Status : ".$adtcphr_status."<br>";
                echo "हेड एडी एचआर समीक्षा टिप्पणी समय/Head AD HR Review remark time : ".$adtcphr_time."<br><br><hr><br><br>";
                if ($adtcphr_status=="NOT RECOMMENDED"){
                    echo "अस्वीकृति के कारण एप्लिकेशन ट्रैकिंग रोक दी गई/Application Tracking Stopped due to Rejection.";
                }    
                else if($director_review==0){
                    echo "निदेशक समीक्षा के लिए लंबित/Pending for Director Review"."<br><br><hr><br><br>";
                }
                else{
                    echo "निदेशक टिप्पणियां/Director Remarks : ".$director_remarks."<br>";
                    echo "निदेशक समीक्षा स्थिति/Director Review Status : ".$director_status."<br>";
                    echo "निदेशक समीक्षा टिप्पणी समय/Director Review remark time : ".$director_time."<br><br><hr><br><br>";
                    echo "ट्रैकिंग प्रक्रिया पूरी हुई/Tracking process completed :)";
                }
            }
        }
    }
}
}
?>
                <a href="logout.php">लॉग आउट/Log-out</a>
    </div>
</body>

</html>