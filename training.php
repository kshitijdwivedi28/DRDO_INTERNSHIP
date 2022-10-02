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
    <title>Training Application</title>
    <link rel="stylesheet" type="text/css" href="css/style1.css">
    <meta charset="UTF-8" name="viewport" content="width=device-width, initial-scale=1" />
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
    <br><br>
    <div class="form">
        <form method="POST" action="submittrainingform.php">
            <fieldset>
                <legend style="padding: 10px; color: white; text-transform: uppercase; font-size: 1.6em;">पिछला
                    प्रशिक्षण जोड़ें/Add previous training</legend>
                <?php
                require "conn.php";
                ($query = mysqli_query(
                    $conn,
                    "SELECT * FROM `id_emp` WHERE  `id`='$_SESSION[user_id]'"
                )) or die(mysqli_error());
                $fetch = mysqli_fetch_array($query);
                $gender = $fetch["gen"];

                echo "<br><br>
                <div style = 'display : none'>
                        <label>लिंग/Gender :</label>
                        <input type='text' name='grpname' class='form-control' placeholder='$gender' disabled />
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
                <label>प्रशिक्षण प्ररूप/Training Type :</label>
                <select name='trainingtype' id='Type of operation'>
                <option value='Webinar'>Webinar</option>
                <option value='Workshop'>Workshop</option>
                <option value='MDP'>MDP</option>
                <option value='CEP'>CEP</option>
                <option value='Training'>Training</option>
                <option value='Symposium'>Symposium</option>
                <option value='confrence'>Conference</option>
				<option value='seminar'>Seminar</option>
                <option value='others'>Others</option>
                </select>
                </div>";
                echo "<div  id='others'  class='hidden'>
                <label>प्रशिक्षण विवरण/Training Type (if others) :</label>
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
                <label>आयोजक संस्थान/Organizing Insititute:</label>
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
                echo "<div id='papertitle' class='hidden'>
                         <label>पत्र का शीर्षक/Title Of Paper:</label>
                         <input type='name' name='titleofpaper' class='form-control' placeholder='Enter the Title of your Paper'  />
                         </div>";
                echo "<div  id='papersubmit' class='hidden'>
                         <label>क्या पत्र जमा किया गया?/Is Paper Submitted? :</label>
                        <select name='papersubmited' id='Mode of operation'>
                        <option value='No'>नहीं/NO</option>
                        <option value='yes'>हां/YES</option>
                         </select>
                         </div>";

                echo "<div>
                        <label>क्या पंजीकरण शुल्क है?/Whether Registration Fee? :</label>
                        <input type='Radio' name='fee' value='yes'>हां/YES
                        <input type='Radio' name='fee' value='no'  checked='checked'>नहीं/NO
                        </div>";
                echo "<div id='feeamount' class='hidden'>
                        <label>शुल्क (जीएसटी सहित)/Fees (GST Included) :</label>
                        <input type='float' name='feeamount' class='form-control' value =0 size='50'/>
                        </div>";
                echo "<div  id='checkinfavor'  class='hidden'>
                        <label>के पक्ष में चेक/Cheque in favour :</label>
                        <input type='name' name='chequeinfavour' class='form-control' placeholder='Cheque in favour of' />
                        </div>";
                echo "<div  id='payableat'  class='hidden'>
                        <label>पर देय/Payable at :</label>
                        <input type='name' name='Payableat' class='form-control' placeholder='Payable at' />
                        </div>";
                echo "<div  id='ldate'  class='hidden'>
                        <label>शुल्क जमा करने की अंतिम तिथि/<br>Last Date of Fee Submission :</label>
                        <input type='date' name='feelastdate' class='form-control' />
                        </div>";
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
                ?>
                <br><br>
                <button onClick="trainingAdded()" ; name="login">फार्म जमा करें/<br>Submit Form</button>
                <script>
                function trainingAdded() {
                    alert("Previous training sucessfully added");
                }
                </script>
                </legend>
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
                };
                var radioButtons = Array.from(document.querySelectorAll("input[type='radio']"));
                var selectButtons = Array.from(document.querySelectorAll("select"));
                selectButtons.forEach(function(btn) {
                    btn.addEventListener("click", selectWithText);
                });
                var radioButtons = Array.from(document.querySelectorAll("input[type='radio']"));

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
                        ref.classList.add("hidden");
                    } else if (this.value === 'NO') {
                        incident.classList.add("hidden");
                        description.classList.add("hidden");
                        ref.classList.remove("hidden");
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
            </fieldset>
        </form>
    </div>
    <br>
    <br>
    <div class="footer">
        <?php include "footer.php"; ?>
    </div>
</body>

</html>