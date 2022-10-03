<!DOCTYPE html>
<html>
<?php
    session_start();
    if (!isset($_SESSION["user_id"])) {
        header("location:index.php");
    }
    ?>

<head>
    <meta charset="UTF-8" name="viewport" content="width=device-width, initial-scale=1" />
    <style>
    body {
        background-image: url('Images/bg1.jpg');
    }
    </style>
    <meta charset="utf-8">

    <title>Home page</title>

    <link rel="stylesheet" href="css2/style_home.css" />

    <link rel="shortcut icon" href="Images/homepage.png" />


<body>
    <section>
        <img src="Images/Header.png" alt="backgorund" class="headerpic">
    </section>


    <div id="buttons">
        <div id="hey">
            <?php
                require "conn.php";
                ($query = mysqli_query(
                    $conn,
                    "SELECT * FROM `id_emp` WHERE  `id`='$_SESSION[user_id]'"
                )) or die(mysqli_error());
                $fetch = mysqli_fetch_array($query);

                echo "<h2>WELCOME, " . $fetch["first_name"] . "</h2>";
                ?>
        </div>
        <div class="logout">
            <a href="logout.php">लॉगआउट/Logout</a>
        </div>
		<!-- <button><a href="feedback.php">Hello</a></button> -->
        <div class="button-container">

            <div class="image">
                <img src="Images/applyfinal1.png" alt="submit" />
            </div>
            <a href="form.php">
                <button class="image-text">
                    आवेदन करें/Apply
                </button>
            </a>
			
			
            <div class="image2">
                <img src="Images/pprr.png" alt="submit" />
            </div>
            <a href="pendingrequest.php">
                <button class="image2-text" align="center">
                    समीक्षाकर्ता/Reviewals
                </button>
            </a>

            <div class="image3">
                <img src="Images/checkstatusfinal1.png" alt="submit" />
            </div>
            <a href="status.php">
                <button class="image3-text">
                    वर्तमान स्थिति/Current Status
                </button>
            </a>
        </div>
    </div>

    <div class="footer">
        <?php include "footer.php"; ?>
    </div>

</body>
</head>

</html>