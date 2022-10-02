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
<link rel="stylesheet" type="text/css" href="css/style.css">
<meta charset="UTF-8" name="viewport" content="width=device-width, initial-scale=1"/>
</head>
<body>
    <div class="form">
    
            <?php
                require'conn.php';
                $query = mysqli_query($conn, "SELECT * FROM `id_emp` WHERE  `id`='$_SESSION[user_id]'") or die(mysqli_error());
                $fetch = mysqli_fetch_array($query);
                
                echo "<h1>WELCOME: ".$fetch['user_name']."</h1>";
            ?>
            <hr>
            <br>
            <br>

            <a href="form.php">Apply</a>
            <hr>
            <a href="status.php">Check Status of your Application</a>
            <hr>
            <a href="pendingrequest.php">Pending Reviewals</a>
            <hr>
            <a href="logout.php">Logout</a>

    </div>
</body>
</html>

