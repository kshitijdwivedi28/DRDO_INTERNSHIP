<!DOCTYPE html>
<html>
<?php
session_start();
if (!isset($_SESSION["user_id"])) {
    header("location:index.php");
}
?>

<head>
    <title>Training Application</title>
    <link rel="stylesheet" type="text/css" href="css/style1.css">
    <meta charset="UTF-8" name="viewport" content="width=device-width, initial-scale=1" />
    <img src="Images/bg1.jpg" alt="backgorund" class="background">
    <style>
    .hidden {
        display: none;
    }

    .row {
        margin: 1em 0;
    }
    </style>
</head>

<body>
    <section>
        <img src="Images/Header.png" alt="backgorund" class="headerpic">
    </section>
    <div class="logout">
        <a href="logout.php">लॉगआउट/Logout</a>
    </div>
    <div class="back">
        <a href="index.php">Back</a>
    </div>
    <br><br>
    <div class="form">
        <form method="POST" action="submitform.php">
            <fieldset>

                <?php
                require "conn.php";
                ($query = mysqli_query(
                    $conn,
                    "SELECT * FROM `id_emp` WHERE  `id`='$_SESSION[user_id]'"
                )) or die(mysqli_error());
                $fetch = mysqli_fetch_array($query);
                ($query1 = mysqli_query(
                    $conn,
                    "SELECT ID.desig_fullname FROM id_desig ID WHERE ID.id = (SELECT IDE.desig_id FROM id_emp IDE WHERE IDE.id = $_SESSION[user_id]);"
                )) or die(mysqli_error());
                $fetch1 = mysqli_fetch_array($query1);
                ($query2 = mysqli_query(
                    $conn,
                    "SELECT IDG.name,IDG.ad_id FROM id_group IDG WHERE IDG.id = (SELECT IDE.group_id FROM id_emp IDE WHERE IDE.id = '$_SESSION[user_id]');"
                )) or die(mysqli_error());
                $fetch2 = mysqli_fetch_array($query2);
                $gender = $fetch["gen"];
                $desgName = $fetch1["desig_fullname"];
                $groupName = $fetch2["name"];
                $groupadID = $fetch2["ad_id"];
                $name = $fetch["user_name"];
                $fname = $fetch["first_name"];
                $lname = $fetch["last_name"];
                $name1 = $fname . " " . $lname;
                $des_id = $fetch["desig_id"];
                $grp_id = $fetch["group_id"];

                echo "<h1>आवेदन पत्र/Application Form</h1><hr><br>";
                echo "<div>
                        <label>आवेदक का नाम/Applicant Name :</label>
                        <input type='text' name='username' class='form-control'  value='$name1'  disabled />
                        </div>";
                echo "<div>
                        <label>पदनाम/Designation Name :</label>
                        <input type='text' name='designame' class='form-control' placeholder='$desgName' disabled />
                        </div>";
                echo "<div>
                        <label>विभाग का नाम/Group Name :</label>
                        <input type='text' name='grpname' class='form-control' placeholder='$groupName' disabled />
                        </div>";
                echo "<div>
                        <label>लिंग/Gender :</label>
                        <input type='text' name='gender' class='form-control' placeholder='$gender' disabled />
                </div>";
                include_once "conn.php";
                $userId = $_SESSION["user_id"];
                $query = "SELECT * from `training_details` 
                          WHERE `user_id`= $userId 
                          AND `is_confirmed` = 'YES' 
                          ORDER BY `end_date` DESC  
                          LIMIT 5 ";

                // $query ="SELECT * from `training_details`
                // WHERE `user_id` = $userId
                // AND `is_confirmed` = 'yes'
                // AND `training_id` < (SELECT training_id FROM application)
                // ORDER BY `end_date` DESC  LIMIT 5 ";
                $result = Mysqli_query($conn, $query);
                ?>
                <br>
                <table width="100%" border="1">
                    <tr>
                        <th colspan="4" style="color:#0f0fa3">पिछले प्रशिक्षण/Previous Trainings</th>
                    </tr>
                    <t>
                        <th width="25%" style="color:#cc0000">प्रशिक्षण शीर्षक/Training Title</th>
                        <th width="25%" style="color:#cc0000">प्रशिक्षण प्रकार/Training Type</th>
                        <th width="25%" style="color:#cc0000">आरंभ करने की तिथि/From Date</th>
                        <th width="25%" style="color:#cc0000">अंतिम तिथि/To Date</th>
                    </t>
                    <?php while ($row = mysqli_fetch_assoc($result)) { ?>
                    <tr>
                        <td style="text-align: center;" width=" 25%"><?php echo $row[
                            "training_title"
                        ]; ?></td>
                        <td style="text-align: center;" width="25%"><?php echo $row[
                            "training_type"
                        ]; ?></td>
                        <td style="text-align: center;" width="25%"><?php echo $row[
                            "start_date"
                        ]; ?></td>
                        <td style="text-align: center;" width="25%"><?php echo $row[
                            "end_date"
                        ]; ?></td>
                    </tr>
                    <?php } ?>
                </table>
                <br>
                <center><a href="./training.php">पिछला प्रशिक्षण जोड़ें/Add Previous Training</a></center>
                <br>
                <br>
                <br>
                <?php
                echo "<div>
                <label>जन्म तिथि/Date Of Birth :</label>
        <input type='date' name='Dateofbirth' class='form-control' required />
        </div>";
                echo "<div>
                <label>इंटरनेट ईमेल आईडी/Internet Email ID :</label>
                <input type='text' name='internet_email_id' class='form-control' placeholder='Enter your Internet Email ID' required/>
       </div>";
                echo "<div>
                            <label>द्रोणा ईमेल आईडी/DRONA Email ID :</label>
                            <input type='text' name='drona_email_id' class='form-control' placeholder='Enter your DRONA Email ID'/>
                </div>";
                echo "<div>
       <label>मोबाइल नंबर/Mobile Number :</label>
      <input type='text' name='MobileNo' class='form-control' placeholder='Enter your Mobile Number' required/>
      </div>";
                echo "<div>
      <label>पिन डीओपी (पीआईएस)/PIN DOP (PIS) :</label>
      <input type='text' name='pin' class='form-control' placeholder='Enter your PIN DOP (PIS)' required/>
</div>";
                echo "<div>
        <label>योग्यता/Qualification :</label>
        <input type='name' name='qualification' class='form-control' placeholder='Enter your Qualification' required />
        </div>";
                echo "<div>
                <label>प्रशिक्षण शीर्षक/Training Title :</label>
                <input type='text' name='training_title' class='form-control' placeholder='Enter The Training Name' required />
                </div>";
                echo "<div>
                <label>प्रशिक्षण विवरण/Training Description :</label>
                <input type='text' name='training_details' class='form-control' placeholder='Enter the Training Details' required />
                </div>";

                echo "<div>
                <label>प्रशिक्षण प्रारुप/Training Type :</label>
                <select name='trainingtype' id='Type of operation'>
                <option value='Webinar'>Webinar</option>
                <option value='Confrence'>Confrence cum Exhibition</option>
                <option value='Exhibition'>Exhibition</option>
                <option value='Workshop'>Workshop</option>
                <option value='MDP'>M D P</option>
                <option value='CEP'>C E P</option>
                <option value='Training'>Training</option>
                <option value='Symposium'>Symposium</option>
                <option value='confrence'>Confrence</option>
                <option value='others'>Others</option>
                </select>
                </div>";
                echo "<div id='others'  class='hidden'>
                <label>प्रशिक्षण विवरण (अगर अन्य)/Training Type (if others) :</label>
                <input type='text' name='training_type_details' class='form-control' placeholder='Enter the Training Type'/>
                </div>";

                echo "<div>
                <label>प्रशिक्षण प्रणाली/Training Mode :</label>
                <select name='trainingmode' id='Mode of operation'>
                <option value='offline'>Offline</option>
                <option value='online'>Online</option>
                </select>
                </div>";
                echo "<div>
                <label>आयोजक संस्थान/Organizing Institute :</label>
                <input type='text' name='orgname' class='form-control' placeholder='Enter the Organizing Institute Name' required />
                </div>";
                echo "<div>
                <label>संस्थान का पता/Institute Address :</label>
                <input type='text' name='orgloc' class='form-control' placeholder='Address of the Institute' required />
                </div>";

                echo "<div>
                         <label>आरंभ तिथि/From Date :</label>
                        <input type='date' id='sdate' name='trainingstartdetails' class='form-control' required />
                        </div>";
                echo "<div>
                        <label>अंतिम तिथि/To Date :</label>
                        <input type='date' id='edate' name='trainingenddetails' onchange='myChangeFunction()' class='form-control'required />
                        </div>";
                echo "<div>
                         <label>क्या आप पत्र/पेपर प्रस्तुति के लिए जा रहे हैं?<br>Are you going for Paper presentation? :</label>
                         <input type='Radio' name='Researchpaper' value='YES'>हां/YES
                         <input type='Radio' name='Researchpaper' value='NO' checked='checked'>नहीं/NO
                         </div>";
                echo "<div id='papertitle'  class='hidden'>
                         <label>पत्र का शीर्षक/Title Of Paper :</label>
                         <input type='name' name='titleofpaper' class='form-control' placeholder='Enter the Title of your Paper'  />
                         </div>";
                echo "<div  id='papersubmit' class='hidden' >
                         <label>क्या पत्र जमा किया गया?/Is Paper Submitted? :</label>
                        <select name='papersubmited' id='Mode of operation'>
                        <option value='No'>नहीं/NO</option>
                        <option value='yes'>हां/YES</option> 
                         </select>
                         </div>";

                echo "<div>
                         <label>क्या पंजीकरण शुल्क है?/Whether Registration Fee? :</label>
                         <input type='Radio' name='fee' value='yes'>हां/YES
                         <input type='Radio' name='fee' value='no' checked='checked'>नहीं/NO
                         </div>";
                echo "<div id='feeamount'  class='hidden'>
                         <label>शुल्क (जीएसटी सहित)/Fees(GST Included) :</label>
                         <input type='float' name='feeamount' class='form-control' value =0 size='50'/>
                         </div>";
                echo "<div  id='checkinfavor'  class='hidden'>
                         <label>के पक्ष में चेक/Cheque In favour :</label>
                         <input type='name' name='chequeinfavour' class='form-control' placeholder='Cheque in favour of' />
                         </div>";
                echo "<div  id='payableat'  class='hidden'>
                         <label>पर देय/Payable At :</label>
                         <input type='name' name='Payableat' class='form-control' placeholder='Payable at' />
                         </div>";
                echo "<div  id='ldate'  class='hidden'>
                         <label>शुल्क जमा करने की अंतिम तिथि/<br>Last Date of Fee Submission :</label>
                         <input type='date' name='feelastdate' class='form-control' />
                         </div>";
                echo "<div>
                        <label>टिप्पणियाँ (यदि आवश्यक हो)/Remarks (if needed) :</label>
                        <input type='text' name='remarks' class='form-control' placeholder='Any remarks' size='50'/>
                        </div>";
                ?>
                <script>
                function myChangeFunction() {
                    table = document.getElementById("sdate").value;
                    table1 = document.getElementById("edate").value;
                    fromdate = new Date(table);
                    todate = new Date(table1);
                    var total_seconds = (todate - fromdate) / 1000;
                    if (total_seconds < 0) {
                        document.getElementById("edate").value = null;
                        alert("Invalid Date");
                    }
                    var days_difference = Math.floor(total_seconds / (60 * 60 * 24));
                    days_difference = "Duration of training: " + days_difference + " Days";
                    console.log(days_difference);
                    //document.getElementById("duration").innerHTML=days_difference;
                };
                var radioButtons = Array.from(document.querySelectorAll("input[type='radio']"));
                var selectButtons = Array.from(document.querySelectorAll("select"));
                selectButtons.forEach(function(btn) {
                    btn.addEventListener("click", selectWithText);
                });

                radioButtons.forEach(function(btn) {
                    btn.addEventListener("click", radioWithText);
                });

                function selectWithText() {
                    var other = document.getElementById('others');

                    if (this.value === 'others') {
                        console.log(5);
                        other.classList.remove("hidden");
                    } else {
                        console.log(1);
                        other.classList.add("hidden");
                    }
                }

                function radioWithText() {
                    var incident = document.getElementById('papersubmit');
                    var description = document.getElementById('papertitle');
                    var amount = document.getElementById('feeamount');
                    var checkinfavor = document.getElementById('checkinfavor');
                    var payat = document.getElementById('payableat');
                    var ldate = document.getElementById('ldate');

                    if (this.value === 'YES') {
                        incident.classList.remove("hidden");
                        description.classList.remove("hidden");
                    } else if (this.value === 'NO') {
                        incident.classList.add("hidden");
                        description.classList.add("hidden");
                    } else if (this.value === 'yes') {
                        amount.classList.remove("hidden");
                        checkinfavor.classList.remove("hidden");
                        payat.classList.remove("hidden");
                        ldate.classList.remove("hidden");
                    } else {
                        amount.classList.add("hidden");
                        checkinfavor.classList.add("hidden");
                        payat.classList.add("hidden");
                        ldate.classList.add("hidden");
                    }
                }
                </script>
                <button name="login">फार्म जमा करें/<br>Submit Form</button>
                </legend>
            </fieldset>
        </form>
        <br>
        <div class="footer">
            <?php include "footer.php"; ?>
        </div>
    </div>
</body>

</html>