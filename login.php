<?php
require_once "conn.php";
session_start();
if (isset($_POST["login"])) {
    $username = $_POST["username"];
    //$password = md5($_POST["password"]);
	$password = ($_POST["password"]);

    ($query = mysqli_query(
        $conn,
        "SELECT * FROM `id_emp` WHERE `user_name` = '$username' AND `password` = '$password'"
    )) or die(mysqli_error());
    $fetch = mysqli_fetch_array($query);
    $row = mysqli_num_rows($query);

    if ($row > 0) {
        $_SESSION["user_id"] = $fetch["id"];
        echo "<script>alert('Login Successfully')</script>";
        echo "<script>window.location='home.php'</script>";
    } else {
        echo "<script>alert('Invalid username or password')</script>";
        echo "<script>window.location='index.php'</script>";
    }
}
?>