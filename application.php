
<!DOCTYPE html>
<html>
<?php
    session_start();
    if(!ISSET($_SESSION['user_id'])){
        header('location:index.php');
    } 
?>
<img src="Images/bg1.jpg" alt="backgorund" class="background">
<head>
<title>Training Application</title>
<link rel="stylesheet" type="text/css" href="css/style1.css">
<meta charset="UTF-8" name="viewport" content="width=device-width, initial-scale=1"/>
</head>
<body><section>
        <img src="Images/Header.png" alt="backgorund" class="headerpic">
        </section>
<div class="form">
<?php
require_once 'conn.php';
if(isset($_SESSION['user_id'])){
    $user_ID = $_SESSION['user_id'];
    $application_id = $_POST['application'];
    if($_POST['level']=='1')  
    {
        //print full application for ad review.
        echo "आवेदन संख्या/Application No : ".$application_id;

?>
            <form method="POST" action="adaction.php">
            <fieldset>
                
            <legend style="text-transform: uppercase; font-size: 1.6em">प्रशिक्षण प्रपत्र/Training form</legend>
            <?php
                require'conn.php';
                $query3 = mysqli_query($conn,"SELECT * FROM `application` WHERE application_id=$application_id");
                $fetch3 = mysqli_fetch_array($query3);
                $user = $fetch3['user_id'];
                $progid = $fetch3['training_id'];
                $query4 = mysqli_query($conn,"SELECT * FROM `training_details` WHERE training_id=$progid");
                $fetch4 = mysqli_fetch_array($query4);
                $trainingTitle= $fetch4['training_title'];
                $trainingDetails= $fetch4['training_details'];
                $trainingType= $fetch4['training_type'];
                $trainingTypeDetails=$fetch4['training_type_detail'];
                $duration=$fetch4['duration'];
                $mobileNo=$fetch4['mobile_no'];
                $dob=$fetch4['dob'];
                $pin=$fetch4['pin_dop_pis'];
                $internet_email_id=$fetch4['drona_email_id'];
                $gender=$fetch4['gender'];
                $qualification=$fetch4['qualification'];
                $cheque=$fetch4['cheque_in_favour'];
                $payable=$fetch4['payable_at'];
                $last_date_to_pay=$fetch4['last_date_fee_submission'];
                $startdate= $fetch4['start_date'];
                $enddate= $fetch4['end_date'];
                $orginstitute= $fetch4['org_institute'];
                $locinstitute= $fetch4['institute_address'];
                $research_paper=$fetch4['research_paper'];
                $title_of_paper=$fetch4['title_of_paper'];
                $paper_submitted=$fetch4['paper_submitted'];
                $training_fee= $fetch4['training_fee'];
                $amount= $fetch4['amount'];
                $remark = $fetch3['applicant_remarks'];
                $acMode= $fetch4['training_mode'];
                $query = mysqli_query($conn, "SELECT * FROM `id_emp` WHERE  `id`=$user") or die(mysqli_error());
                $fetch = mysqli_fetch_array($query);
                $query1 = mysqli_query($conn, "SELECT ID.desig_fullname FROM id_desig ID WHERE ID.id = (SELECT IDE.desig_id FROM id_emp IDE WHERE IDE.id = $user);") or die(mysqli_error());
                $fetch1 = mysqli_fetch_array($query1);                
                $query2 = mysqli_query($conn, "SELECT IDG.name,IDG.ad_id FROM id_group IDG WHERE IDG.id = (SELECT IDE.group_id FROM id_emp IDE WHERE IDE.id = $user);") or die(mysqli_error());
                $fetch2 = mysqli_fetch_array($query2);
                $desgName = $fetch1['desig_fullname'];
                $groupName = $fetch2['name'];
                $groupadID = $fetch2['ad_id'];
                $name =  $fetch['user_name'];
                $fname =  $fetch['first_name'];
                $lname =  $fetch['last_name'];
                $name1 = $fname." ".$lname;
                $des_id = $fetch['desig_id'];
                $grp_id = $fetch['group_id'];
                
                        
                echo "<br><br><div>
                        <label>आवेदक का नाम/Applicant Name : </label>".$name1."
                        <input type='hidden' name='username' class='form-control'  value='$name1'  disabled />
                        </div>";
                echo "<div>
                        <label>पदनाम/Designation Name : </label>".$desgName."
                        <input type='hidden' name='designame' class='form-control' placeholder='$desgName' disabled />
                        </div>";
                echo "<div>
                        <label>विभाग का नाम/Group Name : </label>".$groupName."
                        <input type='hidden' name='grpname' class='form-control' placeholder='$groupName' disabled />
                        </div>";
                echo "<div>
                        <label>लिंग/Gender : </label>".$gender."
                        <input type='hidden' name='training_details' class='form-control' placeholder='$gender' disabled />
                        </div>";
                echo "<div>
                        <label>मोबाइल नंबर/Mobile Number : </label>".$mobileNo."
                        <input type='hidden' name='training_details' class='form-control' placeholder='$mobileNo' disabled />
                        </div>";
                echo "<div>
                        <label>जन्म तिथि/Date Of Birth : </label>".$dob."
                        <input type='hidden' name='training_details' class='form-control' placeholder='$dob' disabled />
                        </div>";
                echo "<div>
                        <label>पिन डीओपी (पीआईएस)/PIN DOP (PIS) : </label>".$pin."
                        <input type='hidden' name='training_details' class='form-control' placeholder='$pin' disabled />
                        </div>";
                echo "<div>
                        <label>ईमेल आईडी/Email ID : </label>".$internet_email_id."
                        <input type='hidden' name='training_details' class='form-control' placeholder='$internet_email_id' disabled />
                        </div>";
               
                echo "<div>
                        <label>योग्यता/Qualification : </label>".$qualification."
                        <input type='hidden' name='training_details' class='form-control' placeholder='$qualification' disabled />
                        </div><br>";
                echo "<div>
                        <label>प्रशिक्षण शीर्षक/Training Title : </label>".$trainingTitle."
                        <input type='hidden' name='training_title' class='form-control' placeholder='$trainingTitle' disabled />
                        </div>";
                echo "<div>
                        <label>प्रशिक्षण विवरण/Training Details : </label>".$trainingDetails."
                        <input type='hidden' name='training_details' class='form-control'  placeholder='$trainingDetails' disabled  />
                        </div>";
                echo "<div>
                        <label>प्रशिक्षण प्रकार/Training Type : </label>".$trainingType."
                        <input type='hidden' name='training_details' class='form-control'  placeholder='$trainingType' disabled  />
                        </div>";
                echo "<div>
                        <label>प्रशिक्षण विवरण (अगर अन्य)/Training Type(If Others) : </label>".$trainingTypeDetails."
                        <input type='hidden' name='training_details' class='form-control'  placeholder='$trainingTypeDetails' disabled  />
                        </div>";                
                echo "<div>
                        <label>प्रशिक्षण प्रणाली/Training Mode : </label>".$acMode."
                        <input type='hidden' name='training_details' class='form-control'  placeholder='$acMode' disabled  />
                        </div>";
                echo "<div>
                        <label>आयोजक संस्थान/Organizing Institute : </label>".$orginstitute."
                        <input type='hidden' name='training_details' class='form-control'  placeholder='$orginstitute' disabled  />
                        </div>";
                echo "<div>
                        <label>संस्थान का  पता/Institute Address : </label>".$locinstitute."
                        <input type='hidden' name='training_details' class='form-control'  placeholder='$locinstitute' disabled  />
                        </div>";
                echo "<div>
                        <label>आरंभ तिथि/From Date : </label>".$startdate."
                        <input type='hidden' name='training_details' class='form-control'  placeholder='$startdate' disabled  />
                        </div>";
                echo "<div>
                        <label>अंतिम तिथि/To Date : </label>".$enddate."
                        <input type='hidden' name='training_details' class='form-control'  placeholder='$enddate' disabled  />
                        </div>";
                        echo "<div>
                        <label>शोध पत्र/Research Paper : </label>".$research_paper."
                        <input type='hidden' name='training_details' class='form-control'  placeholder='$research_paper' disabled  />
                        </div>";
                        echo "<div>
                        <label>पत्र का शीर्षक/Title Of Paper : </label>".$title_of_paper."
                        <input type='hidden' name='training_details' class='form-control'  placeholder='$title_of_paper' disabled  />
                        </div>";
                        echo "<div>
                        <label>पत्र जमा किया गया?/Is Paper Submited? : </label>".$paper_submitted."
                        <input type='hidden' name='training_details' class='form-control'  placeholder='$paper_submitted' disabled  />
                        </div>";
                
                echo "<div>
                        <label>पंजीकरण शुल्क?/Is Registration Fee?  : </label>".$training_fee."
                        <input type='hidden' name='training_details' class='form-control'  placeholder='$training_fee' disabled  />
                        </div>";
                echo "<div>
                        <label>शुल्क (जीएसटी सहित)/Fees(GST Included) : </label>".$amount."
                        <input type='hidden' name='training_details' class='form-control'  placeholder='$amount' disabled  />
                        </div>";
                echo "<div>
                        <label>के पक्ष में चेक/Cheque In favour : </label>".$cheque."
                        <input type='hidden' name='training_details' class='form-control' placeholder='$cheque' disabled />
                        </div>";
                echo "<div>
                        <label>पर देय/Payable At : </label>".$payable."
                        <input type='hidden' name='training_details' class='form-control' placeholder='$payable' disabled />
                        </div>";
                echo "<div>
                        <label>शुल्क जमा करने की अंतिम तिथि/<br>Last Date of Fee Submission : </label>".$last_date_to_pay."
                        <input type='hidden' name='training_details' class='form-control' placeholder='$last_date_to_pay' disabled />
                        </div>";
                echo "<div>
                        <label>टिप्पणियाँ (यदि आवश्यक हो)/Remarks : </label>".$remark."
                        <input type='hidden' name='remarks' class='form-control' placeholder='$remark' disabled/>
                        </div>";

include_once("conn.php");
$userId =  $_SESSION['user_id'];
// $query ="SELECT * from `training_details` WHERE `user_id`=$user  AND `is_confirmed`='yes' ORDER BY `end_date` DESC  LIMIT 5 ";
$query ="SELECT * from `training_details` 
WHERE `user_id` = $user 
AND `is_confirmed` = 'yes' 
AND `training_id` < (SELECT training_id FROM application WHERE application_id = $application_id)
ORDER BY `end_date` DESC  LIMIT 5 ";

$result =Mysqli_query($conn,$query);
?>
        <br>
        <table  width="100%" border="1">
            <tr>
            <th colspan="4" style="color:#FF0000">पिछला प्रशिक्षण/Previous Training</th>
                           </tr>
                                <t>
                                   <th width="25%" style="color:#FF0000">प्रशिक्षण शीर्षक/Training Title</th>
                                   <th width="25%" style="color:#FF0000">प्रशिक्षण प्रकार/Training Type</th>
                                   <th width="25%" style="color:#FF0000">आरंभ करने की तिथि/From Date</th>
                                   <th width="25%" style="color:#FF0000">अंतिम तिथि/To Date</th>
                                </t>
        <?php
            while($row=mysqli_fetch_assoc($result)){
        ?>  
            <tr >
                <td width="25%"><?php echo $row['training_title']; ?></td>
                <td width="25%"><?php echo $row['training_type']; ?></td>
                <td width="25%"><?php echo $row['start_date']; ?></td>
                <td width="25%"><?php echo $row['end_date']; ?></td>
            </tr>
        <?php 
        }
        ?>
        </table>
        <br/>
        <br/>
            <?php
            echo "<input type='hidden' name='application' class='form-control'  value='$application_id' required/>";
                
            echo "<div>
            <label>आपकी समीक्षा/Your Review :</label>
            <input type='text' name='review' placeholder='Enter your remarks' class='form-control'required size='75' />
            </div>";
            echo "<div>
                <label>आपकी कार्रवाई/Your Action :</label>
                <select name='status' id='Type of operation' required>
                <option value=''>SELECT</option>
                <option value='NOT RECOMMENDED'>NOT RECOMMENDED</option>
                <option value='RECOMMENDED'>RECOMMENDED</option>
                </select>
                </div>";
            ?>


            <br><br>
                <button name="login">जमा करें/<br>submit</button>
            </legend>
            </fieldset>
        </form>
        <?php

    }
    else if($_POST['level']=='2')  
    {
        //print full application for ad review.
        echo "आवेदन संख्या/Application No : ".$application_id;

?>
            <form method="POST" action="ghtcpaction.php">
            <fieldset>
                
            <legend style="text-transform: uppercase; font-size: 1.6em">प्रशिक्षण प्रपत्र/Training form</legend>
            <?php
                require'conn.php';
                $query3 = mysqli_query($conn,"SELECT * FROM `application` WHERE application_id=$application_id");
                $fetch3 = mysqli_fetch_array($query3);
                $user = $fetch3['user_id'];
                $progid = $fetch3['training_id'];
                $query4 = mysqli_query($conn,"SELECT * FROM `training_details` WHERE training_id=$progid");
                $fetch4 = mysqli_fetch_array($query4);
                $trainingTitle= $fetch4['training_title'];
                $trainingDetails= $fetch4['training_details'];
                $trainingType= $fetch4['training_type'];
                $trainingTypeDetails=$fetch4['training_type_detail'];
                $duration=$fetch4['duration'];
                $mobileNo=$fetch4['mobile_no'];
                $dob=$fetch4['dob'];
                $pin=$fetch4['pin_dop_pis'];
                $internet_email_id=$fetch4['drona_email_id'];
                $gender=$fetch4['gender'];
                $qualification=$fetch4['qualification'];
                $cheque=$fetch4['cheque_in_favour'];
                $payable=$fetch4['payable_at'];
                $last_date_to_pay=$fetch4['last_date_fee_submission'];
                $startdate= $fetch4['start_date'];
                $enddate= $fetch4['end_date'];
                $orginstitute= $fetch4['org_institute'];
                $locinstitute= $fetch4['institute_address'];
                $research_paper=$fetch4['research_paper'];
                $title_of_paper=$fetch4['title_of_paper'];
                $paper_submitted=$fetch4['paper_submitted'];
                $training_fee= $fetch4['training_fee'];
                $amount= $fetch4['amount'];

                
                $adremark = $fetch3['ad_gh_remarks'];
                $ad_time = $fetch3['ad_gh_time'];
                $remark = $fetch3['applicant_remarks'];
                $acMode= $fetch4['training_mode'];
                $query = mysqli_query($conn, "SELECT * FROM `id_emp` WHERE  `id`=$user") or die(mysqli_error());
                $fetch = mysqli_fetch_array($query);
                $query1 = mysqli_query($conn, "SELECT ID.desig_fullname FROM id_desig ID WHERE ID.id = (SELECT IDE.desig_id FROM id_emp IDE WHERE IDE.id = $user);") or die(mysqli_error());
                $fetch1 = mysqli_fetch_array($query1);                
                $query2 = mysqli_query($conn, "SELECT IDG.name,IDG.ad_id FROM id_group IDG WHERE IDG.id = (SELECT IDE.group_id FROM id_emp IDE WHERE IDE.id = $user);") or die(mysqli_error());
                $fetch2 = mysqli_fetch_array($query2);
                $desgName = $fetch1['desig_fullname'];
                $groupName = $fetch2['name'];
                $groupadID = $fetch2['ad_id'];
                $name =  $fetch['user_name'];
                $fname =  $fetch['first_name'];
                $lname =  $fetch['last_name'];
                $name1 = $fname." ".$lname;
                $des_id = $fetch['desig_id'];
                $grp_id = $fetch['group_id'];
                
                        
                echo "<br><br><div>
                <label>आवेदक का नाम/Applicant Name : </label>".$name1."
                <input type='hidden' name='username' class='form-control'  value='$name1'  disabled />
                </div>";
        echo "<div>
                <label>पदनाम/Designation Name : </label>".$desgName."
                <input type='hidden' name='designame' class='form-control' placeholder='$desgName' disabled />
                </div>";
        echo "<div>
                <label>विभाग का नाम/Group Name : </label>".$groupName."
                <input type='hidden' name='grpname' class='form-control' placeholder='$groupName' disabled />
                </div>";
        echo "<div>
                <label>लिंग/Gender : </label>".$gender."
                <input type='hidden' name='training_details' class='form-control' placeholder='$gender' disabled />
                </div>";
        echo "<div>
                <label>मोबाइल नंबर/Mobile Number : </label>".$mobileNo."
                <input type='hidden' name='training_details' class='form-control' placeholder='$mobileNo' disabled />
                </div>";
        echo "<div>
                <label>जन्म तिथि/Date Of Birth : </label>".$dob."
                <input type='hidden' name='training_details' class='form-control' placeholder='$dob' disabled />
                </div>";
        echo "<div>
                <label>पिन डीओपी (पीआईएस)/PIN DOP (PIS) : </label>".$pin."
                <input type='hidden' name='training_details' class='form-control' placeholder='$pin' disabled />
                </div>";
        echo "<div>
                <label>ईमेल आईडी/Email ID : </label>".$internet_email_id."
                <input type='hidden' name='training_details' class='form-control' placeholder='$internet_email_id' disabled />
                </div>";
       
        echo "<div>
                <label>योग्यता/Qualification : </label>".$qualification."
                <input type='hidden' name='training_details' class='form-control' placeholder='$qualification' disabled />
                </div><br>";
        echo "<div>
                <label>प्रशिक्षण शीर्षक/Training Title : </label>".$trainingTitle."
                <input type='hidden' name='training_title' class='form-control' placeholder='$trainingTitle' disabled />
                </div>";
        echo "<div>
                <label>प्रशिक्षण विवरण/Training Details : </label>".$trainingDetails."
                <input type='hidden' name='training_details' class='form-control'  placeholder='$trainingDetails' disabled  />
                </div>";
        echo "<div>
                <label>प्रशिक्षण प्रारुप/Training Type : </label>".$trainingType."
                <input type='hidden' name='training_details' class='form-control'  placeholder='$trainingType' disabled  />
                </div>";
        echo "<div>
                <label>प्रशिक्षण विवरण (अगर अन्य)/Training Type(If Others) : </label>".$trainingTypeDetails."
                <input type='hidden' name='training_details' class='form-control'  placeholder='$trainingTypeDetails' disabled  />
                </div>";                
        echo "<div>
                <label>प्रशिक्षण प्रणाली/Training Mode : </label>".$acMode."
                <input type='hidden' name='training_details' class='form-control'  placeholder='$acMode' disabled  />
                </div>";
        echo "<div>
                <label>आयोजक संस्थान/Organizing Institute : </label>".$orginstitute."
                <input type='hidden' name='training_details' class='form-control'  placeholder='$orginstitute' disabled  />
                </div>";
        echo "<div>
                <label>संस्थान का  पता/Institute Address : </label>".$locinstitute."
                <input type='hidden' name='training_details' class='form-control'  placeholder='$locinstitute' disabled  />
                </div>";
        echo "<div>
                <label>आरंभ तिथि/From Date : </label>".$startdate."
                <input type='hidden' name='training_details' class='form-control'  placeholder='$startdate' disabled  />
                </div>";
        echo "<div>
                <label>अंतिम तिथि/To Date : </label>".$enddate."
                <input type='hidden' name='training_details' class='form-control'  placeholder='$enddate' disabled  />
                </div>";
                echo "<div>
                <label>शोध पत्र/Research Paper : </label>".$research_paper."
                <input type='hidden' name='training_details' class='form-control'  placeholder='$research_paper' disabled  />
                </div>";
                echo "<div>
                <label>पत्र का शीर्षक/Title Of Paper : </label>".$title_of_paper."
                <input type='hidden' name='training_details' class='form-control'  placeholder='$title_of_paper' disabled  />
                </div>";
                echo "<div>
                <label>पत्र जमा किया गया?/Is Paper Submited? : </label>".$paper_submitted."
                <input type='hidden' name='training_details' class='form-control'  placeholder='$paper_submitted' disabled  />
                </div>";
        
        echo "<div>
                <label>पंजीकरण शुल्क?/Is Registration Fee?  : </label>".$training_fee."
                <input type='hidden' name='training_details' class='form-control'  placeholder='$training_fee' disabled  />
                </div>";
        echo "<div>
                <label>शुल्क (जीएसटी सहित)/Fees(GST Included) : </label>".$amount."
                <input type='hidden' name='training_details' class='form-control'  placeholder='$amount' disabled  />
                </div>";
        echo "<div>
                <label>के पक्ष में चेक/Cheque In favour : </label>".$cheque."
                <input type='hidden' name='training_details' class='form-control' placeholder='$cheque' disabled />
                </div>";
        echo "<div>
                <label>पर देय/Payable At : </label>".$payable."
                <input type='hidden' name='training_details' class='form-control' placeholder='$payable' disabled />
                </div>";
        echo "<div>
                <label>शुल्क जमा करने की अंतिम तिथि/<br>Last Date of Fee Submission : </label>".$last_date_to_pay."
                <input type='hidden' name='training_details' class='form-control' placeholder='$last_date_to_pay' disabled />
                </div>";
        echo "<div>
                <label>टिप्पणियाँ (यदि आवश्यक हो)/Remarks : </label>".$remark."
                <input type='hidden' name='remarks' class='form-control' placeholder='$remark' disabled/>
                </div>";

include_once("conn.php");
$userId =  $_SESSION['user_id'];
$query ="SELECT * from `training_details` WHERE `user_id`=$user  AND `is_confirmed`='yes' ORDER BY `end_date` DESC  LIMIT 5 ";
$result =Mysqli_query($conn,$query);
?>
        <br>
        <table  width="100%" border="1">
            <tr>
            <th colspan="4" style="color:#FF0000">पिछला प्रशिक्षण/Previous Training</th>
                           </tr>
                                <t>
                                   <th width="25%" style="color:#FF0000">प्रशिक्षण शीर्षक/Training Title</th>
                                   <th width="25%" style="color:#FF0000">प्रशिक्षण प्रकार/Training Type</th>
                                   <th width="25%" style="color:#FF0000">आरंभ करने की तिथि/From Date</th>
                                   <th width="25%" style="color:#FF0000">अंतिम तिथि/To Date</th>
                                </t>
        <?php
            while($row=mysqli_fetch_assoc($result)){
        ?>  
            <tr >
                <td width="25%"><?php echo $row['training_title']; ?></td>
                <td width="25%"><?php echo $row['training_type']; ?></td>
                <td width="25%"><?php echo $row['start_date']; ?></td>
                <td width="25%"><?php echo $row['end_date']; ?></td>
            </tr>
        <?php 
        }
        ?>
        </table>
        <br/>
        <br/>
            <?php
            echo "<div>
            <label>विभाग एडी टिप्पणी/Group AD Remarks : </label>".$adremark."
            <input type='hidden' name='remarks' class='form-control' placeholder='$adremark' disabled/>
            </div>";
            echo "<div>
            <label>विभाग एडी टिप्पणी समय/Group AD remark time : </label>".$ad_time."
            <input type='hidden' name='remarks' class='form-control' placeholder='$ad_time' disabled/>
            </div><br>";
            
            echo "<input type='hidden' name='application' class='form-control'  value='$application_id' required/>";
                
            echo "<div>
            <label>आपकी समीक्षा/Your Review :</label>
            <input type='text' name='review' placeholder='Enter your remarks' class='form-control'required size='75' />
            </div>";
            echo "<div>
                <label>आपकी कार्रवाई/Your Action :</label>
                <select name='status' id='Type of operation' required>
                <option value=''>SELECT</option>
                <option value='NOT RECOMMENDED'>NOT RECOMMENDED</option>
                <option value='RECOMMENDED'>RECOMMENDED</option>
                </select>
                </div>";
            ?>


            <br><br>
                <button name="login">जमा करें/<br>submit</button>
            </legend>
            </fieldset>
        </form>
        <?php

    }  
    else if($_POST['level']=='3')  
    {
        //print full application for ad review.
        echo "आवेदन संख्या/Application No : ".$application_id;

?>
            <form method="POST" action="adtcpaction.php">
            <fieldset>
                
            <legend style="text-transform: uppercase; font-size: 1.6em">प्रशिक्षण प्रपत्र/Training form</legend>
            <?php
                require'conn.php';
                $query3 = mysqli_query($conn,"SELECT * FROM `application` WHERE application_id=$application_id");
                $fetch3 = mysqli_fetch_array($query3);
                $user = $fetch3['user_id'];
                $progid = $fetch3['training_id'];
                $query4 = mysqli_query($conn,"SELECT * FROM `training_details` WHERE training_id=$progid");
                $fetch4 = mysqli_fetch_array($query4);
                $trainingTitle= $fetch4['training_title'];
                $trainingDetails= $fetch4['training_details'];
                $trainingType= $fetch4['training_type'];
                $trainingTypeDetails=$fetch4['training_type_detail'];
                $duration=$fetch4['duration'];
                $mobileNo=$fetch4['mobile_no'];
                $dob=$fetch4['dob'];
                $pin=$fetch4['pin_dop_pis'];
                $internet_email_id=$fetch4['drona_email_id'];
                $gender=$fetch4['gender'];
                $qualification=$fetch4['qualification'];
                $cheque=$fetch4['cheque_in_favour'];
                $research_paper=$fetch4['research_paper'];
                $title_of_paper=$fetch4['title_of_paper'];
                $paper_submitted=$fetch4['paper_submitted'];
                $payable=$fetch4['payable_at'];
                $last_date_to_pay=$fetch4['last_date_fee_submission'];

                $startdate= $fetch4['start_date'];
                $enddate= $fetch4['end_date'];
                $orginstitute= $fetch4['org_institute'];
                $locinstitute= $fetch4['institute_address'];
                $training_fee= $fetch4['training_fee'];
                $amount= $fetch4['amount'];
                $adremark = $fetch3['ad_gh_remarks'];
                $ad_time = $fetch3['ad_gh_time'];
                $ghtcpremark = $fetch3['head_tcp_hr_remarks'];
                $ghtcp_time = $fetch3['head_tcp_hr_time'];
                $remark = $fetch3['applicant_remarks'];
                $acMode= $fetch4['training_mode'];
                $query = mysqli_query($conn, "SELECT * FROM `id_emp` WHERE  `id`=$user") or die(mysqli_error());
                $fetch = mysqli_fetch_array($query);
                $query1 = mysqli_query($conn, "SELECT ID.desig_fullname FROM id_desig ID WHERE ID.id = (SELECT IDE.desig_id FROM id_emp IDE WHERE IDE.id = $user);") or die(mysqli_error());
                $fetch1 = mysqli_fetch_array($query1);                
                $query2 = mysqli_query($conn, "SELECT IDG.name,IDG.ad_id FROM id_group IDG WHERE IDG.id = (SELECT IDE.group_id FROM id_emp IDE WHERE IDE.id = $user);") or die(mysqli_error());
                $fetch2 = mysqli_fetch_array($query2);
                $desgName = $fetch1['desig_fullname'];
                $groupName = $fetch2['name'];
                $groupadID = $fetch2['ad_id'];
                $name =  $fetch['user_name'];
                $fname =  $fetch['first_name'];
                $lname =  $fetch['last_name'];
                $name1 = $fname." ".$lname;
                $des_id = $fetch['desig_id'];
                $grp_id = $fetch['group_id'];
                
                        
            echo "<br><br><div>
                        <label>आवेदक का नाम/Applicant Name : </label>".$name1."
                        <input type='hidden' name='username' class='form-control'  value='$name1'  disabled />
                        </div>";
                echo "<div>
                        <label>पदनाम/Designation Name : </label>".$desgName."
                        <input type='hidden' name='designame' class='form-control' placeholder='$desgName' disabled />
                        </div>";
                echo "<div>
                        <label>विभाग का नाम/Group Name : </label>".$groupName."
                        <input type='hidden' name='grpname' class='form-control' placeholder='$groupName' disabled />
                        </div>";
                echo "<div>
                        <label>लिंग/Gender : </label>".$gender."
                        <input type='hidden' name='training_details' class='form-control' placeholder='$gender' disabled />
                        </div>";
                echo "<div>
                        <label>मोबाइल नंबर/Mobile Number : </label>".$mobileNo."
                        <input type='hidden' name='training_details' class='form-control' placeholder='$mobileNo' disabled />
                        </div>";
                echo "<div>
                        <label>जन्म तिथि/Date Of Birth : </label>".$dob."
                        <input type='hidden' name='training_details' class='form-control' placeholder='$dob' disabled />
                        </div>";
                echo "<div>
                        <label>पिन डीओपी (पीआईएस)/PIN DOP (PIS) : </label>".$pin."
                        <input type='hidden' name='training_details' class='form-control' placeholder='$pin' disabled />
                        </div>";
                echo "<div>
                        <label>ईमेल आईडी/Email ID : </label>".$internet_email_id."
                        <input type='hidden' name='training_details' class='form-control' placeholder='$internet_email_id' disabled />
                        </div>";
               
                echo "<div>
                        <label>योग्यता/Qualification : </label>".$qualification."
                        <input type='hidden' name='training_details' class='form-control' placeholder='$qualification' disabled />
                        </div><br>";
                echo "<div>
                        <label>प्रशिक्षण शीर्षक/Training Title : </label>".$trainingTitle."
                        <input type='hidden' name='training_title' class='form-control' placeholder='$trainingTitle' disabled />
                        </div>";
                echo "<div>
                        <label>प्रशिक्षण विवरण/Training Details : </label>".$trainingDetails."
                        <input type='hidden' name='training_details' class='form-control'  placeholder='$trainingDetails' disabled  />
                        </div>";
                echo "<div>
                        <label>प्रशिक्षण प्रकार/Training Type : </label>".$trainingType."
                        <input type='hidden' name='training_details' class='form-control'  placeholder='$trainingType' disabled  />
                        </div>";
                echo "<div>
                        <label>प्रशिक्षण विवरण (अगर अन्य)/Training Type(If Others) : </label>".$trainingTypeDetails."
                        <input type='hidden' name='training_details' class='form-control'  placeholder='$trainingTypeDetails' disabled  />
                        </div>";                
                echo "<div>
                        <label>प्रशिक्षण प्रणाली/Training Mode : </label>".$acMode."
                        <input type='hidden' name='training_details' class='form-control'  placeholder='$acMode' disabled  />
                        </div>";
                echo "<div>
                        <label>आयोजक संस्थान/Organizing Institute : </label>".$orginstitute."
                        <input type='hidden' name='training_details' class='form-control'  placeholder='$orginstitute' disabled  />
                        </div>";
                echo "<div>
                        <label>संस्थान का  पता/Institute Address : </label>".$locinstitute."
                        <input type='hidden' name='training_details' class='form-control'  placeholder='$locinstitute' disabled  />
                        </div>";
                echo "<div>
                        <label>आरंभ तिथि/From Date : </label>".$startdate."
                        <input type='hidden' name='training_details' class='form-control'  placeholder='$startdate' disabled  />
                        </div>";
                echo "<div>
                        <label>अंतिम तिथि/To Date : </label>".$enddate."
                        <input type='hidden' name='training_details' class='form-control'  placeholder='$enddate' disabled  />
                        </div>";
                        echo "<div>
                        <label>शोध पत्र/Research Paper : </label>".$research_paper."
                        <input type='hidden' name='training_details' class='form-control'  placeholder='$research_paper' disabled  />
                        </div>";
                        echo "<div>
                        <label>पत्र का शीर्षक/Title Of Paper : </label>".$title_of_paper."
                        <input type='hidden' name='training_details' class='form-control'  placeholder='$title_of_paper' disabled  />
                        </div>";
                        echo "<div>
                        <label>पत्र जमा किया गया?/Is Paper Submited? : </label>".$paper_submitted."
                        <input type='hidden' name='training_details' class='form-control'  placeholder='$paper_submitted' disabled  />
                        </div>";
                
                echo "<div>
                        <label>पंजीकरण शुल्क?/Is Registration Fee?  : </label>".$training_fee."
                        <input type='hidden' name='training_details' class='form-control'  placeholder='$training_fee' disabled  />
                        </div>";
                echo "<div>
                        <label>शुल्क (जीएसटी सहित)/Fees(GST Included) : </label>".$amount."
                        <input type='hidden' name='training_details' class='form-control'  placeholder='$amount' disabled  />
                        </div>";
                echo "<div>
                        <label>के पक्ष में चेक/Cheque In favour : </label>".$cheque."
                        <input type='hidden' name='training_details' class='form-control' placeholder='$cheque' disabled />
                        </div>";
                echo "<div>
                        <label>पर देय/Payable At : </label>".$payable."
                        <input type='hidden' name='training_details' class='form-control' placeholder='$payable' disabled />
                        </div>";
                echo "<div>
                        <label>शुल्क जमा करने की अंतिम तिथि/<br>Last Date of Fee Submission : </label>".$last_date_to_pay."
                        <input type='hidden' name='training_details' class='form-control' placeholder='$last_date_to_pay' disabled />
                        </div>";
                echo "<div>
                        <label>टिप्पणियाँ (यदि आवश्यक हो)/Remarks : </label>".$remark."
                        <input type='hidden' name='remarks' class='form-control' placeholder='$remark' disabled/>
                        </div>";

include_once("conn.php");
$userId =  $_SESSION['user_id'];
$query ="SELECT * from `training_details` WHERE `user_id`=$user  AND `is_confirmed`='yes' ORDER BY `end_date` DESC  LIMIT 5 ";
$result =Mysqli_query($conn,$query);
?>
        <br>
        <table  width="100%" border="1">
            <tr>
            <th colspan="4" style="color:#FF0000">पिछला प्रशिक्षण/Previous Training</th>
                           </tr>
                                <t>
                                   <th width="25%" style="color:#FF0000">प्रशिक्षण शीर्षक/Training Title</th>
                                   <th width="25%" style="color:#FF0000">प्रशिक्षण प्रकार/Training Type</th>
                                   <th width="25%" style="color:#FF0000">आरंभ करने की तिथि/From Date</th>
                                   <th width="25%" style="color:#FF0000">अंतिम तिथि/To Date</th>
                                </t>
        <?php
            while($row=mysqli_fetch_assoc($result)){
        ?>  
            <tr >
                <td width="25%"><?php echo $row['training_title']; ?></td>
                <td width="25%"><?php echo $row['training_type']; ?></td>
                <td width="25%"><?php echo $row['start_date']; ?></td>
                <td width="25%"><?php echo $row['end_date']; ?></td>
            </tr>
        <?php 
        }
        ?>
        </table>
        <br/>
        <br/>
            <?php
            echo "<div>
            <label>विभाग एडी टिप्पणी/Group AD Remarks : </label>".$adremark."
            <input type='hidden' name='remarks' class='form-control' placeholder='$adremark' disabled/>
            </div>";
            echo "<div>
            <label>विभाग एडी टिप्पणी समय/Group AD remark time : </label>".$ad_time."
            <input type='hidden' name='remarks' class='form-control' placeholder='$ad_time' disabled/>
            </div><br>";
            echo "<div>
            <label>जीएच टीसीपी टिप्पणी/GH TCP Remarks : </label>".$ghtcpremark."
            <input type='hidden' name='remarks' class='form-control' placeholder='$ghtcpremark' disabled/>
            </div>";
            echo "<div>
            <label>जीएच टीसीपी टिप्पणी समय/GH TCP Remarks time : </label>".$ghtcp_time."
            <input type='hidden' name='remarks' class='form-control' placeholder='$ghtcp_time' disabled/>
            </div><br>";
            
            echo "<input type='hidden' name='application' class='form-control'  value='$application_id' required/>";
                
            echo "<div>
            <label>आपकी समीक्षा/Your Review :</label>
            <input type='text' name='review' placeholder='Enter your remarks' class='form-control'required size='75' />
            </div>";
            echo "<div>
                <label>आपकी कार्रवाई/Your Action :</label>
                <select name='status' id='Type of operation' required>
                <option value=''>SELECT</option>
                <option value='NOT RECOMMENDED'>NOT RECOMMENDED</option>
                <option value='RECOMMENDED'>RECOMMENDED</option>
                </select>
                </div>";
            ?>


            <br><br>
                <button name="login">जमा करें/<br>submit</button>
            </legend>
            </fieldset>
        </form>
        <?php

    }  
    else if($_POST['level']=='4')  
    {
        //print full application for ad review.
        echo "आवेदन संख्या/Application No : ".$application_id;

?>
            <form method="POST" action="director.php">
            <fieldset>
                
            <legend style="text-transform: uppercase; font-size: 1.6em">प्रशिक्षण प्रपत्र/Training form</legend>
            <?php
                require'conn.php';
                $query3 = mysqli_query($conn,"SELECT * FROM `application` WHERE application_id=$application_id");
                $fetch3 = mysqli_fetch_array($query3);
                $user = $fetch3['user_id'];
                $progid = $fetch3['training_id'];
                $query4 = mysqli_query($conn,"SELECT * FROM `training_details` WHERE training_id=$progid");
                $fetch4 = mysqli_fetch_array($query4);
                $trainingTitle= $fetch4['training_title'];
                $trainingDetails= $fetch4['training_details'];
                $trainingType= $fetch4['training_type'];
                $trainingTypeDetails=$fetch4['training_type_detail'];
                $duration=$fetch4['duration'];
                $mobileNo=$fetch4['mobile_no'];
                $dob=$fetch4['dob'];
                $pin=$fetch4['pin_dop_pis'];
                $internet_email_id=$fetch4['drona_email_id'];
                $gender=$fetch4['gender'];
                $qualification=$fetch4['qualification'];
                $cheque=$fetch4['cheque_in_favour'];
                $research_paper=$fetch4['research_paper'];
                $title_of_paper=$fetch4['title_of_paper'];
                $paper_submitted=$fetch4['paper_submitted'];
                $payable=$fetch4['payable_at'];
                $last_date_to_pay=$fetch4['last_date_fee_submission'];

                $startdate= $fetch4['start_date'];
                $enddate= $fetch4['end_date'];
                $orginstitute= $fetch4['org_institute'];
                $locinstitute= $fetch4['institute_address'];
                $training_fee= $fetch4['training_fee'];
                $amount= $fetch4['amount'];
                $adremark = $fetch3['ad_gh_remarks'];
                $ad_time = $fetch3['ad_gh_time'];
                $ghtcpremark = $fetch3['head_tcp_hr_remarks'];
                $ghtcp_time = $fetch3['head_tcp_hr_time'];
                $adtcpremark = $fetch3['ad_tcp_hr_remarks'];
                $adtcp_time = $fetch3['ad_tcp_hr_time'];
               
                $remark = $fetch3['applicant_remarks'];
                $acMode= $fetch4['training_mode'];
                $query = mysqli_query($conn, "SELECT * FROM `id_emp` WHERE  `id`=$user") or die(mysqli_error());
                $fetch = mysqli_fetch_array($query);
                $query1 = mysqli_query($conn, "SELECT ID.desig_fullname FROM id_desig ID WHERE ID.id = (SELECT IDE.desig_id FROM id_emp IDE WHERE IDE.id = $user);") or die(mysqli_error());
                $fetch1 = mysqli_fetch_array($query1);                
                $query2 = mysqli_query($conn, "SELECT IDG.name,IDG.ad_id FROM id_group IDG WHERE IDG.id = (SELECT IDE.group_id FROM id_emp IDE WHERE IDE.id = $user);") or die(mysqli_error());
                $fetch2 = mysqli_fetch_array($query2);
                $desgName = $fetch1['desig_fullname'];
                $groupName = $fetch2['name'];
                $groupadID = $fetch2['ad_id'];
                $name =  $fetch['user_name'];
                $fname =  $fetch['first_name'];
                $lname =  $fetch['last_name'];
                $name1 = $fname." ".$lname;
                $des_id = $fetch['desig_id'];
                $grp_id = $fetch['group_id'];
 
                echo "<br><br><div>
                <label>आवेदक का नाम/Applicant Name : </label>".$name1."
                <input type='hidden' name='username' class='form-control'  value='$name1'  disabled />
                </div>";
        echo "<div>
                <label>पदनाम/Designation Name : </label>".$desgName."
                <input type='hidden' name='designame' class='form-control' placeholder='$desgName' disabled />
                </div>";
        echo "<div>
                <label>विभाग का नाम/Group Name : </label>".$groupName."
                <input type='hidden' name='grpname' class='form-control' placeholder='$groupName' disabled />
                </div>";
        echo "<div>
                <label>लिंग/Gender : </label>".$gender."
                <input type='hidden' name='training_details' class='form-control' placeholder='$gender' disabled />
                </div>";
        echo "<div>
                <label>मोबाइल नंबर/Mobile Number : </label>".$mobileNo."
                <input type='hidden' name='training_details' class='form-control' placeholder='$mobileNo' disabled />
                </div>";
        echo "<div>
                <label>जन्म तिथि/Date Of Birth : </label>".$dob."
                <input type='hidden' name='training_details' class='form-control' placeholder='$dob' disabled />
                </div>";
        echo "<div>
                <label>पिन डीओपी (पीआईएस)/PIN DOP (PIS) : </label>".$pin."
                <input type='hidden' name='training_details' class='form-control' placeholder='$pin' disabled />
                </div>";
        echo "<div>
                <label>ईमेल आईडी/Email ID : </label>".$internet_email_id."
                <input type='hidden' name='training_details' class='form-control' placeholder='$internet_email_id' disabled />
                </div>";
       
        echo "<div>
                <label>योग्यता/Qualification : </label>".$qualification."
                <input type='hidden' name='training_details' class='form-control' placeholder='$qualification' disabled />
                </div><br>";
        echo "<div>
                <label>प्रशिक्षण शीर्षक/Training Title : </label>".$trainingTitle."
                <input type='hidden' name='training_title' class='form-control' placeholder='$trainingTitle' disabled />
                </div>";
        echo "<div>
                <label>प्रशिक्षण विवरण/Training Details : </label>".$trainingDetails."
                <input type='hidden' name='training_details' class='form-control'  placeholder='$trainingDetails' disabled  />
                </div>";
        echo "<div>
                <label>प्रशिक्षण प्रकार/Training Type : </label>".$trainingType."
                <input type='hidden' name='training_details' class='form-control'  placeholder='$trainingType' disabled  />
                </div>";
        echo "<div>
                <label>प्रशिक्षण विवरण (अगर अन्य)/Training Type(If Others) : </label>".$trainingTypeDetails."
                <input type='hidden' name='training_details' class='form-control'  placeholder='$trainingTypeDetails' disabled  />
                </div>";                
        echo "<div>
                <label>प्रशिक्षण प्रणाली/Training Mode : </label>".$acMode."
                <input type='hidden' name='training_details' class='form-control'  placeholder='$acMode' disabled  />
                </div>";
        echo "<div>
                <label>आयोजक संस्थान/Organizing Institute : </label>".$orginstitute."
                <input type='hidden' name='training_details' class='form-control'  placeholder='$orginstitute' disabled  />
                </div>";
        echo "<div>
                <label>संस्थान का  पता/Institute Address : </label>".$locinstitute."
                <input type='hidden' name='training_details' class='form-control'  placeholder='$locinstitute' disabled  />
                </div>";
        echo "<div>
                <label>आरंभ तिथि/From Date : </label>".$startdate."
                <input type='hidden' name='training_details' class='form-control'  placeholder='$startdate' disabled  />
                </div>";
        echo "<div>
                <label>अंतिम तिथि/To Date : </label>".$enddate."
                <input type='hidden' name='training_details' class='form-control'  placeholder='$enddate' disabled  />
                </div>";
                echo "<div>
                <label>शोध पत्र/Research Paper : </label>".$research_paper."
                <input type='hidden' name='training_details' class='form-control'  placeholder='$research_paper' disabled  />
                </div>";
                echo "<div>
                <label>पत्र का शीर्षक/Title Of Paper : </label>".$title_of_paper."
                <input type='hidden' name='training_details' class='form-control'  placeholder='$title_of_paper' disabled  />
                </div>";
                echo "<div>
                <label>पत्र जमा किया गया?/Is Paper Submited? : </label>".$paper_submitted."
                <input type='hidden' name='training_details' class='form-control'  placeholder='$paper_submitted' disabled  />
                </div>";
        
        echo "<div>
                <label>पंजीकरण शुल्क?/Is Registration Fee?  : </label>".$training_fee."
                <input type='hidden' name='training_details' class='form-control'  placeholder='$training_fee' disabled  />
                </div>";
        echo "<div>
                <label>शुल्क (जीएसटी सहित)/Fees(GST Included) : </label>".$amount."
                <input type='hidden' name='training_details' class='form-control'  placeholder='$amount' disabled  />
                </div>";
        echo "<div>
                <label>के पक्ष में चेक/Cheque In favour : </label>".$cheque."
                <input type='hidden' name='training_details' class='form-control' placeholder='$cheque' disabled />
                </div>";
        echo "<div>
                <label>पर देय/Payable At : </label>".$payable."
                <input type='hidden' name='training_details' class='form-control' placeholder='$payable' disabled />
                </div>";
        echo "<div>
                <label>शुल्क जमा करने की अंतिम तिथि/<br>Last Date of Fee Submission : </label>".$last_date_to_pay."
                <input type='hidden' name='training_details' class='form-control' placeholder='$last_date_to_pay' disabled />
                </div>";
        echo "<div>
                <label>टिप्पणियाँ (यदि आवश्यक हो)/Remarks : </label>".$remark."
                <input type='hidden' name='remarks' class='form-control' placeholder='$remark' disabled/>
                </div>";

include_once("conn.php");
$userId =  $_SESSION['user_id'];
$query ="SELECT * from `training_details` WHERE `user_id`=$user  AND `is_confirmed`='yes' ORDER BY `end_date` DESC  LIMIT 5 ";
$result =Mysqli_query($conn,$query);
?>
        <br>
        <table  width="100%" border="1">
            <tr>
                <th colspan="4" style="color:#FF0000">पिछला प्रशिक्षण/Previous Training</th>
                           </tr>
                                <t>
                                   <th width="25%" style="color:#FF0000">प्रशिक्षण शीर्षक/Training Title</th>
                                   <th width="25%" style="color:#FF0000">प्रशिक्षण प्रकार/Training Type</th>
                                   <th width="25%" style="color:#FF0000">आरंभ करने की तिथि/From Date</th>
                                   <th width="25%" style="color:#FF0000">अंतिम तिथि/To Date</th>
                                </t>
        <?php
            while($row=mysqli_fetch_assoc($result)){
        ?>  
            <tr >
                <td width="25%"><?php echo $row['training_title']; ?></td>
                <td width="25%"><?php echo $row['training_type']; ?></td>
                <td width="25%"><?php echo $row['start_date']; ?></td>
                <td width="25%"><?php echo $row['end_date']; ?></td>
            </tr>
        <?php 
        }
        ?>
        </table>
        <br/>
        <br/>
            <?php
            echo "<div>
            <label>विभाग एडी टिप्पणी/Group AD Remarks : </label>".$adremark."
            <input type='hidden' name='remarks' class='form-control' placeholder='$adremark' disabled/>
            </div>";
            echo "<div>
            <label>विभाग एडी टिप्पणी समय/Group AD remark time : </label>".$ad_time."
            <input type='hidden' name='remarks' class='form-control' placeholder='$ad_time' disabled/>
            </div><br>";
          
            
            echo "<div>
            <label>जीएच टीसीपी टिप्पणी/GH TCP Remarks : </label>".$ghtcpremark."
            <input type='hidden' name='remarks' class='form-control' placeholder='$ghtcpremark' disabled/>
            </div>";
            echo "<div>
            <label>जीएच टीसीपी टिप्पणी समय/GH TCP Remarks time : </label>".$ghtcp_time."
            <input type='hidden' name='remarks' class='form-control' placeholder='$ghtcp_time' disabled/>
            </div><br>";
            echo "<div>
            <label>एडी टीसीपी टिप्पणी/AD TCP Remarks : </label>".$adtcpremark."
            <input type='hidden' name='remarks' class='form-control' placeholder='$adtcpremark' disabled/>
            </div><br>";
            echo "<div>
            <label>एडी टीसीपी टिप्पणी समय/AD TCP Remarks time : </label>".$adtcp_time."
            <input type='hidden' name='remarks' class='form-control' placeholder='$adtcp_time' disabled/>
            </div><br>";
            
            echo "<input type='hidden' name='application' class='form-control'  value='$application_id' required/>";
                
            echo "<div>
            <label> आपकी समीक्षा/Your Review :</label>
            <input type='text' name='review' placeholder='Enter your remarks' class='form-control'required size='75' />
            </div>";
            echo "<div>
                <label>आपकी कार्रवाई/Your Action :</label>
                <select name='status' id='Type of operation' required>
                <option value=''>SELECT</option>
                <option value='NOT RECOMMENDED'>NOT RECOMMENDED</option>
                <option value='FORWARDED'>FORWARDED TO DG SAM, DRDO HQR</option>
                <option value='RECOMMENDED'>RECOMMENDED</option>
                </select>
                </div>";
            ?>


            <br><br>
                <button name="login">जमा करें/<br>submit</button>
            </legend>
            </fieldset>
        </form>
        <?php

    }  

    else{
        echo "Invalid state";
    }   
    
}
?>
    
    </div>
</body>
</html>

