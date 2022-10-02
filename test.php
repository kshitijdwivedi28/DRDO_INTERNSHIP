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
    <style>
    <button>margin-left:10%;
    </button>
    </style>
    <title>Training Application</title>
    <link rel="stylesheet" type="text/css" href="css/style1.css">
    <meta charset="UTF-8" name="viewport" content="width=device-width, initial-scale=1" />
</head>

<body>
    <section>
        <img src="Images/Header.png" alt="backgorund" class="headerpic">
    </section>
    <div class="logout">
        <a href="logout.php">??????/Logout</a>
    </div>
    <br>
    <div class="form" style="width:90vw; margin-top:200px;">

        <form style=" width:90vw;" method="POST" action="viewapplication.php">

            <fieldset style="width:90vw; margin:20px">
                <legend style="padding: 10px; color: white;text-transform: uppercase; font-size: 1.6em">??? ?????/
                    ALL Applications</legend>

                <input style="float:right; width:100px; height:30px; color:red;" type="reset" value="Clear All Filters">
                <input style="float:right; width:250px; height:30px;" type="text" id="myInput" onKeyUp="myFunction()"
                    placeholder="User name, Training name, Training Type">
                <input style="float:right; width:100px; height:30px;" type="text" id="myGender" onKeyUp="myFunction1()"
                    placeholder="Gender">
                <input style="float:right; width:100px; height:30px;" type="text" id="duration" onKeyUp="myFunction2()"
                    placeholder="Duration">
                <input style="float:right; width:100px; height:30px;" type="date" id="edate" onChange="myFunction3()">
                <input style="float:right; width:100px; height:30px;" type="date" id="sdate">

                <t>
                    <table id="myTable" width="100%" border="1">
                        <th style="color:#cc0000">????? ??????/<br>Application Id</th>
                        <th style="color:#cc0000">????? ?? ???/<br>Applicant Name</th>
                        <th style="color:#cc0000">??/<br>Designation</th>
                        <th style="color:#cc0000">????/<br>Gender</th>
                        <th style="color:#cc0000">????????? ??????/<br>Training Title</th>
                        <th style="color:#cc0000">????????? ??????/<br>Training Type</th>
                        <th style="color:#cc0000">???? ???? ?? ????/<br>Start Date<br>(YYYY-MM-DD)</th>
                        <th style="color:#cc0000">????? ????/<br>End Date<br>(YYYY-MM-DD)</th>
                        <th style="color:#cc0000">????/<br>Duration(Days)</th>
                        <th style="color:#cc0000">??????/<br>Status</th>
                        <th style="color:#cc0000">????? ?????/<br>View Application</th>
                </t>
                <?php
                require "conn.php";
                $query =
                    "SELECT * from `application` ORDER BY application_id DESC";
                $result = Mysqli_query($conn, $query);
                while ($row = mysqli_fetch_assoc($result)) { ?>

                <?php
                ($query = mysqli_query(
                    $conn,
                    "SELECT * FROM `training_details` WHERE  `training_id`='$row[training_id]'"
                )) or die(mysqli_error());
                $fetch = mysqli_fetch_array($query);
                ($query1 = mysqli_query(
                    $conn,
                    "SELECT `first_name` FROM `id_emp` WHERE  `id`='$fetch[user_id]'"
                )) or die(mysqli_error());
                
                $fetch1 = mysqli_fetch_array($query1);
                (
                    $query2 = mysqli_query(
                        $conn,
                        "SELECT ID.desig_fullname 
                        FROM id_desig ID 
                        WHERE ID.id = ( SELECT IDE.desig_id 
                                        FROM id_emp IDE 
                                        WHERE IDE.id = $fetch[user_id]
                                    );"
                    )) or die(mysqli_error());
                    
                $fetch2 = mysqli_fetch_array($query2);
                ?>
                <tr>
                    <?php
                    $appID = $row["application_id"];
                    $query3 = mysqli_query(
                        $conn,
                        "SELECT IDG.gh_id FROM id_group IDG WHERE IDG.id = 1 or IDG.name LIKE '%DIRECTOR%';"
                    );
                    $fetch3 = mysqli_fetch_array($query3);
                    $id_director = $fetch3["gh_id"];
                    $query3 = mysqli_query(
                        $conn,
                        "SELECT IDG.ad_id FROM id_group IDG WHERE IDG.id = 2;"
                    );
                    $fetch3 = mysqli_fetch_array($query3);
                    $id_adtcphr = $fetch3["ad_id"];
                    $query3 = mysqli_query(
                        $conn,
                        "SELECT IDG.gh_id FROM id_group IDG WHERE IDG.id = 2;"
                    );
                    $fetch3 = mysqli_fetch_array($query3);
                    $id_ghtcphr = $fetch3["gh_id"];
                    $appId = (int) $row["application_id"];
                    $query3 = mysqli_query(
                        $conn,
                        "SELECT ad_gh_id FROM application WHERE application_id = $appId"
                    );
                    $fetch3 = mysqli_fetch_array($query3);
                    $id_adgh = $fetch3["ad_gh_id"];
                    $query3 = mysqli_query(
                        $conn,
                        "SELECT user_id FROM application WHERE application_id = $appId"
                    );
                    $fetch3 = mysqli_fetch_array($query3);
                    $id_user = $fetch3["user_id"];
                    if (
                        $_SESSION["user_id"] == $id_director ||
                        $_SESSION["user_id"] == $id_adtcphr ||
                        $_SESSION["user_id"] == $id_ghtcphr
                    ) { ?>
                    <td style="text-align: center;"><?php echo $row["application_id"]; ?></td>
                    <td style="text-align: center;"><?php echo $fetch1["first_name"]; ?></td>
                    <td style="text-align: center;"><?php echo $fetch2["desig_fullname"]; ?></td>
                    <td style="text-align: center;"><?php echo $fetch["gender"]; ?></td>
                    <td style="text-align: center;"><?php echo $fetch["training_details"]; ?></td>
                    <td style="text-align: center;"><?php echo $fetch["training_type"]; ?></td>
                    <td style="text-align: center;"><?php echo $fetch["start_date"]; ?></td>
                    <td style="text-align: center;"><?php echo $fetch["end_date"]; ?></td>
                    <td style="text-align: center;"><?php echo $fetch["duration"]; ?></td>
                    <td style="text-align: center;"><?php
                    if($row['director']==1 && $row['director_status']=="RECOMMENDED"){
                        echo "Recommended";
                    }
                    else if($row['director']==1 && $row['director_status']=="FORWARDED"){
                        echo "Forwarded";
                    }
                    else if($row['ad_status']=="NOT RECOMMENDED" || $row['head_tcp_hr_status']=="NOT RECOMMENDED" || $row['ad_tcp_hr_status']=="NOT RECOMMENDED" || $row['director_status']=="NOT RECOMMENDED"){
                        echo "Not Recommended";
                    }
                    else{
                        echo "Processing";
                    }
                    ?></td>
                    <td style="text-align: center;">
                        <?php $appID = $row["application_id"]; echo "<input type='radio' name='application' value=$appID>";?>
                        <?php } 
                    elseif ($id_adgh == $_SESSION["user_id"]) 
                    { ?>
                    <td style="text-align: center;"><?php echo $row["application_id"]; ?></td>
                    <td style="text-align: center;"><?php echo $fetch1["first_name"]; ?></td>
                    <td style="text-align: center;"><?php echo $fetch2["desig_fullname"]; ?></td>
                    <td style="text-align: center;"><?php echo $fetch["gender"]; ?></td>
                    <td style="text-align: center;"><?php echo $fetch["training_details"]; ?></td>
                    <td style="text-align: center;"><?php echo $fetch["training_type"]; ?></td>
                    <td style="text-align: center;"><?php echo $fetch["start_date"]; ?></td>
                    <td style="text-align: center;"><?php echo $fetch["end_date"]; ?></td>
                    <td style="text-align: center;"><?php echo $fetch["duration"]; ?></td>
                    <td style="text-align: center;"><?php
                    if($row['director']==1 && $row['director_status']=="RECOMMENDED"){
                        echo "Recommended";
                    }
                    else if($row['director']==1 && $row['director_status']=="FORWARDED"){
                        echo "Forwarded";
                    }
                    else if($row['ad_status']=="NOT RECOMMENDED" || $row['head_tcp_hr_status']=="NOT RECOMMENDED" || $row['ad_tcp_hr_status']=="NOT RECOMMENDED" || $row['director_status']=="NOT RECOMMENDED"){
                        echo "Not Recommended";
                    }
                    else{
                        echo "Processing";
                    }
                    ?></td>
                    <td style="text-align: center;"><?php
                    $appID = $row["application_id"];
                    echo "<input type='radio' name='application' value=$appID>";
                    ?>
                        <?php } elseif ($id_user == $_SESSION["user_id"]) { ?>
                    <td style="text-align: center;"><?php echo $row["application_id"]; ?></td>
                    <td style="text-align: center;"><?php echo $fetch1["first_name"]; ?></td>
                    <td style="text-align: center;"><?php echo $fetch2["desig_fullname"]; ?></td>
                    <td style="text-align: center;"><?php echo $fetch["gender"]; ?></td>
                    <td style="text-align: center;"><?php echo $fetch["training_details"]; ?></td>
                    <td style="text-align: center;"><?php echo $fetch["training_type"]; ?></td>
                    <td style="text-align: center;"><?php echo $fetch["start_date"]; ?></td>
                    <td style="text-align: center;"><?php echo $fetch["end_date"]; ?></td>
                    <td style="text-align: center;"><?php echo $fetch["duration"]; ?></td>
                    <td style="text-align: center;"><?php
                    if($row['director']==1 && $row['director_status']=="RECOMMENDED"){
                        echo "Recommended";
                    }
                    else if($row['director']==1 && $row['director_status']=="FORWARDED"){
                        echo "Forwarded";
                    }
                    else if($row['ad_status']=="NOT RECOMMENDED" || $row['head_tcp_hr_status']=="NOT RECOMMENDED" || $row['ad_tcp_hr_status']=="NOT RECOMMENDED" || $row['director_status']=="NOT RECOMMENDED"){
                        echo "Not Recommended";
                    }
                    else{
                        echo "Processing";
                    }
                    ?></td>
                    <td style="text-align: center;"><?php
                    $appID = $row["application_id"];
                    echo "<input type='radio' name='application' value=$appID>";
                    ?> <?php }
                    ?></td>
                </tr>
                <?php }
                ?>
                </table>
                <br><br>
                </legend>
                <button style="margin-left : 625px" ; name="login">????? ?????/View details</button>
            </fieldset>
        </form>

    </div>
    <br>
    <div class="footer">
        <?php include "footer.php"; ?>
    </div>
</body>

</html>