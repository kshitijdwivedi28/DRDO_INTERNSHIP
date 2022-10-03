<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
    <meta charset="utf-8">
    <title>Login page</title>
    <link rel="stylesheet" href="css2/style_index.css">
</head>

<body>
    <img src="Images/Header.png">
    <img src="css2/hr_logo.png" class="decor">

    <div class="center">
        <h1>उपयोगकर्ता लॉग इन/<br>User Login</h1>

        <form method="POST" action="login.php">
            <div class="txt_field">
                <input type="text" name="username" required>
                <span></span>
                <label>उपयोगकर्ता नाम/Username</label>
            </div>
            <div class="txt_field">
                <input type="password" name="password" required>
                <span></span>
                <label>पासवर्ड/Password</label>
            </div>
            <input type="submit" name="login" value="लॉग इन/Login"><br><br><br>
        </form>


    </div>
    <br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>
    <div class="footer">
        <?php include "footer.php"; ?>
    </div>
</body>

</html>