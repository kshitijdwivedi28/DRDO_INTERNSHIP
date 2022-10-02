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
        <form method="POST" action="application.php">
            <fieldset>
                <legend
                    style="margin-left: 75px; padding: 10px; color: white; text-transform: uppercase; font-size: 1.6em">
                    समीक्षा के लिए लंबित आवेदन/Pending Applications to Review</legend>
                <table width="100%" border="1">
                    <!-- <tr>
                        <th colspan="5">आवेदनों की समीक्षा की जानी चाहिए/Applications need to be reviewed</th>
                    </tr> -->
                    <t>
                        <br>
                        <th style="color:#cc0000">चुनिये/<br>Select</th>
                        <th style="color:#cc0000">आवेदन पहचान पत्र/<br>Application Id</th>
                        <th style="color:#cc0000">आवेदक का नाम/<br>Applicant Name</th>
                        <th style="color:#cc0000">पद/<br>Designation</th>
                        <th style="color:#cc0000">प्रशिक्षण शीर्षक/<br>Training Title</th>
                        <th style="color:#cc0000">प्रशिक्षण प्रकार/<br>Training Type</th>
                    </t>
                    <?php
             require "conn.php";
             $query = "SELECT * from `application`";
             $result = Mysqli_query($conn, $query);
             while ($row = mysqli_fetch_assoc($result)) { ?>

                    <?php if (
            $row["ad_gh_review"] == 0 &&
            $row["ad_gh_id"] == $_SESSION["user_id"]
        ) {
            ($query2 = mysqli_query(
                $conn,
                "SELECT ID.desig_fullname FROM id_desig ID WHERE ID.id = (SELECT IDE.desig_id FROM id_emp IDE WHERE IDE.id = $row[user_id]);"
            )) or die(mysqli_error());
            $fetch2 = mysqli_fetch_array($query2);
            echo "<input type='hidden' name='level' value='1' required />";
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
            ?>
                    <tr>
                        <td><?php
                $appID = $row["application_id"];
                echo "<input type='radio' name='application' value=$appID>";
                ?></td>
                        <td><?php echo $row["application_id"]; ?></td>
                        <td><?php echo $fetch1["first_name"]; ?></td>
                        <td><?php echo $fetch2["desig_fullname"]; ?></td>
                        <td><?php echo $fetch["training_details"]; ?></td>
                        <td><?php echo $fetch["training_type"]; ?></td>

                    </tr>

                    <?php
        } elseif (
            $_SESSION["user_id"] == 230 &&
            $row["head_tcp_hr"] == 0 &&
            $row["ad_gh_review"] == 1 &&
            $row["ad_status"] == "RECOMMENDED"
        ) {
            ($query2 = mysqli_query(
                $conn,
                "SELECT ID.desig_fullname FROM id_desig ID WHERE ID.id = (SELECT IDE.desig_id FROM id_emp IDE WHERE IDE.id = $row[user_id]);"
            )) or die(mysqli_error());
            $fetch2 = mysqli_fetch_array($query2);
            echo "<input type='hidden' name='level' value='2' required />";
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
            ?>
                    <tr>
                        <td><?php
                    $appID = $row["application_id"];
                    echo "<input type='radio' name='application' value=$appID>";
                    ?></td>
                        <td><?php echo $row["application_id"]; ?></td>
                        <td><?php echo $fetch1["first_name"]; ?></td>
                        <td><?php echo $fetch2["desig_fullname"]; ?></td>
                        <td><?php echo $fetch["training_details"]; ?></td>
                        <td><?php echo $fetch["training_type"]; ?></td>

                    </tr>

                    <?php
        } elseif (
            $_SESSION["user_id"] == 114 &&
            $row["ad_tcp_hr"] == 0 &&
            $row["head_tcp_hr"] == 1 &&
            $row["head_tcp_hr_status"] == "RECOMMENDED"
        ) {
            ($query2 = mysqli_query(
                $conn,
                "SELECT ID.desig_fullname FROM id_desig ID WHERE ID.id = (SELECT IDE.desig_id FROM id_emp IDE WHERE IDE.id = $row[user_id]);"
            )) or die(mysqli_error());
            $fetch2 = mysqli_fetch_array($query2);
            echo "<input type='hidden' name='level' value='3' required />";
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
            ?>
                    <tr>
                        <td><?php
                    $appID = $row["application_id"];
                    echo "<input type='radio' name='application' value=$appID>";
                    ?></td>
                        <td><?php echo $row["application_id"]; ?></td>
                        <td><?php echo $fetch1["first_name"]; ?></td>
                        <td><?php echo $fetch2["desig_fullname"]; ?></td>
                        <td><?php echo $fetch["training_details"]; ?></td>
                        <td><?php echo $fetch["training_type"]; ?></td>

                    </tr>

                    <?php
        } elseif (
            $_SESSION["user_id"] == 264 &&
            $row["director"] == 0 &&
            $row["ad_tcp_hr"] == 1 &&
            $row["ad_tcp_hr_status"] == "RECOMMENDED"
        ) {
            ($query2 = mysqli_query(
                $conn,
                "SELECT ID.desig_fullname FROM id_desig ID WHERE ID.id = (SELECT IDE.desig_id FROM id_emp IDE WHERE IDE.id = $row[user_id]);"
            )) or die(mysqli_error());
            $fetch2 = mysqli_fetch_array($query2);
            echo "<input type='hidden' name='level' value='4' required />";
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
            ?>
                    <tr>
                        <td><?php
                    $appID = $row["application_id"];
                    echo "<input type='radio' name='application' value=$appID>";
                    ?></td>
                        <td><?php echo $row["application_id"]; ?></td>
                        <td><?php echo $fetch1["first_name"]; ?></td>
                        <td><?php echo $fetch2["desig_fullname"]; ?></td>
                        <td><?php echo $fetch["training_details"]; ?></td>
                        <td><?php echo $fetch["training_type"]; ?></td>

                    </tr>

                    <?php
        } ?>
                    <?php }
             ?>
                </table>

                </legend>
                <br>
                <br>
                <button name="login">समीक्षा पूर्ण/<br>Reviewal Complete</button>
            </fieldset>
        </form>

    </div>
    <br>
    <div class="footer">
        <?php include "footer.php"; ?>
    </div>
</body>

</html>